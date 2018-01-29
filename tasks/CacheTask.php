<?php

namespace Newfinder\Modules\Cli\Tasks;

use Phalcon\Cache\Backend\Libmemcached;
use function is_numeric;
use function readline;

class CacheTask extends BaseTask
{
    public function cacheRedirectsAction()
    {
        $prefix = $this->getDI()->get('config')['application']['geoOldSlugCachePrefix'];
        $tables = ['geo_metro' => 'metro', 'geo_area' => 'area', 'geo_district' => 'district'];

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');

        foreach ($tables as $table => $type) {
            $this->log("Обработка таблицы $table..");
            $data = $this->db->fetchAll("SELECT * FROM $table WHERE old_slug != ''", \PDO::FETCH_ASSOC);
            if (count($data) > 0) {
                foreach ($data as $row) {
                    $key = $prefix . $row['old_slug'];
                    $memcache->save($key, json_encode(['type' => $type, 'data' => $row]), 60 * 60 * 24);
                }
            }
        }

    }

    public function clearRedirectsAction()
    {
        $prefix = $this->getDI()->get('config')['application']['geoOldSlugCachePrefix'];
        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');

        $keys = $memcache->queryKeys($prefix);
        $this->log('Найдено ключей: ' . count($keys));

        if (count($keys) > 0) {
            echo "\n1 - Просмотреть\n2 - удалить\nВаш выбор: ";
            $in = trim(readline());

            if (is_numeric($in)) {
                $choice = (int)$in;
                if ($choice == 1) {
                    echo "\n ";
                    print_r($keys);
                    echo "\n ";
                } elseif ($choice == 2) {
                    foreach ($keys as $k) {
                        $memcache->delete($k);
                    }
                    $this->log('Ключи удалены.');
                }
            }

        }
    }

    public function cacheSimilarObjAction()
    {
        $prefix =  "newf.housing_complex.similar_";

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        $params = $this->db->fetchAll("SELECT geo_latitude, geo_longitude, slug, price_to FROM housing_complex WHERE price_to != 0", \PDO::FETCH_ASSOC);
        foreach ($params as $key => $param) {
            $this->log("Обработка таблицы housing_complex..");
            $data = $this->db->fetchAll(sprintf("SELECT * FROM housing_complex WHERE SQRT(POW(69.1 * (geo_latitude - '%f'), 2) +POW(69.1 * ('%f' - geo_longitude) * COS(geo_latitude/57.3), 2))<1 AND price_to <= '%d' LIMIT 1",$param['geo_latitude'],$param['geo_longitude'] ,$param['price_to'] ), \PDO::FETCH_ASSOC);
            $count = $this->db->fetchColumn(sprintf("SELECT count(*) FROM housing_complex WHERE SQRT(POW(69.1 * (geo_latitude - '%f'), 2) +POW(69.1 * ('%f' - geo_longitude) * COS(geo_latitude/57.3), 2))<1 AND price_to <= '%d'",$param['geo_latitude'],$param['geo_longitude'] ,$param['price_to']  ), \PDO::FETCH_ASSOC);
                    $key = $prefix.$param['slug'];
                    $result = [
		                'advs' => $data,
		                'meta' => [
		                    'total' => $count,
		                ],
		            ];

                    $serialize_result = serialize($result);
                    $memcache->save($key, $serialize_result, 60 * 60 * 24);
              
        }
    }

    public function cacheSimilarAdsAction()
    {
        $prefix =  "newf.housing_complex.similar_ads_";

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        $params = $this->db->fetchAll("SELECT slug, price_to FROM housing_complex WHERE price_to != 0", \PDO::FETCH_ASSOC);
        foreach ($params as $key => $param) {
            $this->log("Обработка таблицы ads..");
            $data = $this->db->fetchAll(sprintf("SELECT * FROM ads WHERE price <= '%d' LIMIT 1",$param['price_to'] ), \PDO::FETCH_ASSOC);
            $count = $this->db->fetchColumn(sprintf("SELECT count(*)  FROM ads WHERE price <= '%d'",$param['price_to'] ), \PDO::FETCH_ASSOC);
                    $key = $prefix.$param['slug'];
                    $result = [
		                'advs' => $data,
		                'meta' => [
		                    'total' => $count,
		                ],
		            ];

                    $serialize_result = serialize($result);
                    $memcache->save($key, $serialize_result, 60 * 60 * 24);
              
        }
    }

}
