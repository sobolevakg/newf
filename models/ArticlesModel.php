<?php
namespace Newfinder\Models;
use Newfinder\Helpers\StrHelper;

class ArticlesModel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;
    
    
    /**
     *
     * @var tinyint
     * @Column(type="tinyint", length=1, nullable=false)
     */
    public $publish;
    
     /**
     *
     * @var datetime
     * @Column(type="datetime", nullable=false)
     */
    public $publication_datetime;
    
    /**
     *
     * @var varchar
     * @Column(type="varchar", length=255, nullable=false)
     */
    public $title;
    
     /**
     *
     * @var varchar
     * @Column(type="varchar", length=255, nullable=false)
     */
    public $short_text;
    
    
    /**
     *
     * @var text
     * @Column(type="text", nullable=false)
     */
    public $text;
    
    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $rubric_id;
    
    /**
     *
     * @var varchar
     * @Column(type="varchar", length=255, nullable=false)
     */
    public $cover;
    
    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $author_id;
    
    
    /**
     *
     * @var varchar
     * @Column(type="varchar", length=255, nullable=false)
     */
    public $tags;
    
    
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("articles");
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'articles';
    }
    
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return HousingComplexStatus[]|HousingComplexStatus|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return HousingComplexStatus|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    
    public $cache_key_prefix = 'newf:dic:articles_main:';
    public $cache_lifetime = 60 * 60 * 24 * 30;
    
    public function getMain(): array
    {
        
        $result = [];
        $data = $this->getDI()->get('db')->fetchAll("SELECT MAX(publication_datetime), MAX(id),rubric_id  FROM articles WHERE publish=1 GROUP BY rubric_id");
        if (count($data) > 0) {
            $model = new StrHelper;
            foreach ($data as $res) {
                    $result[] = $this->getDI()->get('db')->fetchAll("SELECT articles.title, articles.short_text,articles.slug,rubriks.slug AS rubric_slug, rubriks.name, rubriks.icon FROM articles LEFT JOIN rubriks ON rubriks.id = articles.rubric_id WHERE articles.id='".$res['MAX(id)']."'");
                }
        }
        return $result;
    
    }
    
}
