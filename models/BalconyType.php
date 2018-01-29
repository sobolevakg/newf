<?php
namespace Newfinder\Models;

class BalconyType extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $short_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $description;

    /**
     *
     * @var tinyint
     * @Column(type="tinyint", length=3, nullable=false)
     */
    public $is_active;

    /**
     *
     * @var int
     * @Column(type="int", length=11, nullable=false)
     */
    public $order_number;
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("balcony_types");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'balcony_types';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BalconyType[]|BalconyType|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BalconyType|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public $cache_key_prefix = 'newf:dic:balcony_types:';
    public $cache_lifetime = 60 * 60 * 24 * 30;

    public function get(int $id): array
    {
        /**
         * @var $memcache \Phalcon\Cache\Backend\Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        $cacheKey = sprintf("%s%d", $this->cache_key_prefix, $id);

        if ($memcache->exists($cacheKey) && !isset($_GET['_cc'])) {
            return json_decode($memcache->get($cacheKey), true);
        } else {
            $data = $this->getDI()->get('db')->fetchAll("SELECT * FROM balcony_types");
            $return = [];
            foreach ($data as $d) {
                $k = sprintf("%s%d", $this->cache_key_prefix, $d['id']);
                $memcache->save($k, json_encode($d), $this->cache_lifetime);
                if ((int)$d['id'] == $id) {
                    $return = $d;
                }
            }
            return $return;
        }
        return [];
    }

}
