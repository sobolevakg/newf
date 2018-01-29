<?php
namespace Newfinder\Models;

use Phalcon\Mvc\Model;

/**
 * Class BaseAdvertModel
 */
abstract class BaseAdvertModel extends Model
{

    /**
     * Здесь хранятся вычисляемые атрибуты объекта.
     * @var array
     */
    protected $attributes = [];

    /**
     * @return mixed
     */
    abstract public function prepare();

    /**
     * Возвращает заголовок объявления.
     * @return string
     */
    abstract public function getTitle();

    // /**
    //  * Возвращает краткий заголовок объявления.
    //  * @return string
    //  */
    // abstract public function getTitleShort();

    // /**
    //  * Возвращает расширенный заголовок объявления.
    //  * @return string|null
    //  */
    // abstract public function getTitleFull();

    /**
     * Возвращает контент мета тега description.
     * @return string|null
     */
    abstract public function getMetaDescription();

    /**
     * Возвращает контент мета тега keywords.
     * @return string|null
     */
    abstract public function getMetaKeywords();

    /**
     * Возвращает урл на страницу объекта.
     * @return string|null
     */
    abstract public function getObjectUrl();

    // /**
    //  * Возвращает ссылку на поиск похожих объявлений.
    //  * @return string|null
    //  */
    // abstract public function relativeAdvertsUrl();

    /**
     * Возвращает атрибуты объекта в виде массива.
     * @return array
     */
    public function getArray($columns = NULL)
    {
        return get_object_vars($this);
    }

    /**
     * @param array|null $params
     * @return $this
     */
    public function init(array $params = null)
    {
        if (!is_null($params)) {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
            $this->prepare();
        }
        return $this;
    }

    public function cacheKey(array $searchParams, string $prefix = ''): string
    {
        if (isset($searchParams['bindTypes'])) {
            unset($searchParams['bindTypes']);
        }
        return sprintf("newf%s.search.%s", !empty($prefix) ? ".$prefix" : '', sha1(json_encode($searchParams)));
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $nameChunks = array_map('strtolower', preg_split('/(?=[A-Z])/', $name));
        if ($nameChunks[0] == 'get') {
            unset($nameChunks[0]);
            $attrName = implode('_', $nameChunks);
            if (property_exists($this, $attrName)) {
                return $this->$attrName;
            }
        }
    }
}
