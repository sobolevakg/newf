<?php
namespace Newfinder\Models;

class HousingComplexStatus extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("housing_complex_status");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'housing_complex_status';
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

    public $cache_key_prefix = 'newf:dic:housing_complex_status:';
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
            $data = $this->getDI()->get('db')->fetchAll("SELECT * FROM housing_complex_status");
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
