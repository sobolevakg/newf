<?php

namespace Newfinder\Models;

use Newfinder\Library\UrlManager;
use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Db\Column;
use Newfinder\Models\HousingComplexModel;

use Phalcon\Mvc\Model\Query;
use function var_dump;

class Ads extends BaseAdvertModel
{

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $address;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $agency;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $apartment_condition_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $balcony_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $building_series_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $building_series_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $building_type_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $create_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $deal_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $electricity_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $elevator_type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $explication;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $external_id;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $external_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $fire_alarm_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $floor_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $gas_type_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_region_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_region_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_region_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_area_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_area_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_locality_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_locality_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_locality_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_district_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_district_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_district_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_sublocality_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_sublocality_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_sublocality_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_street_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $geo_street_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_street_id;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    public $geo_building_name;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    public $geo_building_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $geo_building_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_subway_station_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_subway_station_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $geo_subway_station_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $geo_subway_station_line_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $geo_subway_station_line_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $geo_subway_walk_access;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $geo_subway_transport_access;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $geo_mkad_remoteness;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_railway_station_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_railway_station_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $geo_railway_station_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_highway_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $geo_highway_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $geo_highway_id;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    public $geo_latitude;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    public $geo_longitude;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $heating_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $housing_complex_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $housing_complex_section;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $housing_complex_name;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $is_new_building;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $is_new_msk;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $is_mortgage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $is_rubbish_chute;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $kitchen_square;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $life_square;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $note;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $own_year;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $owners_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $ownership_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $offer_room_count;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    public $phone_list;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $phone_line_type_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $photo_list;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $plumbing_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=true)
     */
    public $price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $price_currency_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $price_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=true)
     */
    public $price_unit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $price_unit_currency_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $price_unit_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $realty_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $registered_habits_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $rent_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $sale_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $security_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $sewerage_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $source_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $status_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $storey;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $storey_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $total_room_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    public $total_square;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $transport_remoteness;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $update_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $walk_remoteness;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $wall_material_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $water_closet_type_id;


    protected $housing_complex;
    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    public $window_overlook_type_id;


    protected $water_closet_type;

    protected $balcony_type;

    protected $elevator_type;

    protected $window_overlook_type;

    protected $phone_line_type;

    protected $apartment_condition_type;

    protected $wall_material_type;

    protected $ownership_type;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("newfinder");
        $this->setSource("ads");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ads';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ads[]|Ads|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Ads|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function prepare()
    {

    }

    public function getTitle()
    {

    }

    public function getMetaDescription()
    {

    }

    public function getMetaKeywords()
    {

    }

    public function getObjectUrl()
    {

    }

    public function getHousingComplex()
    {
        return $this->housing_complex;
    }

    public function getWaterClosetType()
    {
        return $this->water_closet_type;
    }


    public function getBalconyType()
    {
        return $this->balcony_type;
    }

    public function getElevatorType()
    {
        return $this->elevator_type;
    }

    public function getWindowOverlookType()
    {
        return $this->window_overlook_type;
    }

    public function getPhoneLineType()
    {
        return $this->phone_line_type();
    }

    public function getApartmentConditionType()
    {
        return $this->apartment_condition_type;
    }

    public function getWallMaterialType()
    {
        return $this->wall_material_type;
    }

    public function getOwnershipType()
    {
        return $this->ownership_type;
    }

    public function getAddress(): string
    {
        $address = [];
        if (!empty($this->geo_region_name)) {
            $address[] = $this->geo_region_name;
        }
        if (!empty($this->geo_street_name) && ($this->geo_street_name != "-=без улицы=-")) {
            $address[] = $this->geo_street_name;
            if (!empty($this->geo_building_name)) {
                $address[] = $this->geo_building_name;
            }
        }
        return count($address) > 0 ? implode(', ', $address) : '';
    }

    public function getHousingComplexName()
    {
        $housing_complex_id = $this->housing_complex_id;
        $housing_complex_model = new HousingComplexModel();
        $housing_complex = $housing_complex_model::findFirst([
                                        'conditions' => 'id = :id:',
                                        'columns' => 'name',
                                        'bind' => ['id' => $housing_complex_id],
                                        'bindTypes' => [Column::BIND_PARAM_INT],
                                ]);
        return $housing_complex->name;
    }

    public function getPriceFormat()
    {
         return number_format($this->price, 0, ',', ' ');
    }

    public function getPriceUnitFormat()
    {
         return number_format($this->price_unit, 0, ',', ' ');
    }

    public function getMkadRemoteness()
    {
        $housing_complex_id = $this->housing_complex_id;
        $housing_complex_model = new HousingComplexModel();
        $housing_complex = $housing_complex_model::findFirst([
                                        'conditions' => 'id = :id:',
                                        'columns' => 'geo_mkad_remoteness',
                                        'bind' => ['id' => $housing_complex_id],
                                        'bindTypes' => [Column::BIND_PARAM_INT],
                                ]);
        return $housing_complex->geo_mkad_remoteness;
    }

    public $cache_photos = [];

    public function getPhotos(): array
    {
        $result = [];
        if (!empty($this->photo_list)) {
            if (count($this->cache_photos) > 0) {
                $result = $this->cache_photos;
            } else {
                $result = array_filter(array_map('trim', explode(',',
                    $this->photo_list)));
                $this->cache_photos = $result;
            }
        }

        return $result;
    }

    public function getListByHousingComplex($id,$params): array
    {
        
        $binds = [];
        $bindTypes = [];
        $order = ['id DESC']; 
	    $conditions = [];
        

        if (isset($id)) {
            $conditions[] = 'housing_complex_id = :id:';
            $binds['id'] = $id;
            $bindTypes['id'] = Column::BIND_PARAM_INT;
        }


	if (isset($params['rooms'])) {
            $conditions[] = 'total_room_count in (:rooms:)';
            $binds['rooms'] = $params['rooms'];
            $bindTypes['rooms'] = Column::BIND_PARAM_INT;
	}

	if (isset($params['floor'])) {
	 $floor = explode(',', $params['floor']);
		 for ($i = 0; $i <= count($floor); $i++) {
			if($floor[$i] == 0){
			    $conditions[] = 'storey != storey_count';
			}else{
				$conditions[] = 'storey != 1';
			
			}

		 }
	}

        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSizes = $this->getDI()->get('config')['application']['housingComplexPageSize']->toArray();

        if (isset($params['pageSize'])) {
            $offset = ($page - 1) * $params['pageSize'];
        }

        $findParams = [
            'conditions' => implode(' AND ', $conditions),
            'bind' => $binds,
            'bindTypes' => $bindTypes,
            'limit' => $params['pageSize'],
            'offset' => $offset
        ];
        if (count($order) > 0) {
            $findParams['order'] = implode(', ', $order);
        }
        $findParamsCount = array_diff_key($findParams, array_flip(['offset', 'limit']));

        $cacheKey = $this->cacheKey($findParams, 'secondary_buildings'.$id);

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        if ($memcache->exists($cacheKey) && !isset($_GET['_cc'])) {
            $result = json_decode($memcache->get($cacheKey), TRUE);
        } else {
            $resultSet = $this::find($findParams);
            $count = $this::count($findParamsCount);
            $advs = $resultSet->toArray();
//            die(var_dump($advs));

            $this->setDeveloperToAdvs($advs);
            $this->setHousingComplexNameToAdvs($advs);
            $this->setSecondAdvsCountToAdvs($advs);

            $result = [
                'advs' => $advs,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];
            $memcache->save($cacheKey, json_encode($result), 60);
        }

        return $result;
    }

    public function get($id, $id_hc): array
    {
        $conditions[] = 'id = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;

        if (isset($id_hc)) {
            $conditions[] = 'housing_complex_id = :id_hc:';
            $binds['id_hc'] = $id_hc;
            $bindTypes['id_hc'] = Column::BIND_PARAM_INT;
	    }

        $findParams = [
            'conditions' => implode(' AND ', $conditions),
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];
        $resultSet = self::find($findParams);
        $resultSet = $resultSet->toArray();
        if (count($resultSet) > 0) {
            $housing_complex_model = new HousingComplexModel();
            $water_closet_type = new WaterClosetType();
            $balcony_type = new BalconyType();
            $elevator_type = new ElevatorType();
            $window_overlook_type = new WindowOverlookType();
            $phone_line_type = new PhoneLineType();
            $apartment_condition_type = new ApartmentConditionType();
            $walls_material_types = new WallsMaterialTypes();
            $ownership_type = new OwnershipTypes();
            foreach ($resultSet as &$adv) {
                if ($adv['housing_complex_id'] > 0) {
                    $adv['housing_complex'] = ($housing_complex_model)->get($adv['housing_complex_id']);
                }
                if ($adv['water_closet_type_id'] > 0) {
                    $adv['water_closet_type'] = ($water_closet_type)->get($adv['water_closet_type_id'])['name'];
                }
                if($adv['balcony_type_id'] > 0){
                    $adv['balcony_type'] = ($balcony_type)->get($adv['balcony_type_id'])['name'];
                }
                if($adv['elevator_type_id'] > 0){
                    $adv['elevator_type'] = ($elevator_type)->get($adv['elevator_type_id'])['name'];
                }
                if($adv['window_overlook_type_id'] > 0){
                    $adv['window_overlook_type'] = ($window_overlook_type)->get($adv['window_overlook_type_id'])['name'];
                }
                if($adv['phone_line_type_id'] > 0){
                    $adv['phone_line_type'] = ($phone_line_type)->get($adv['phone_line_type_id'])['name'];
                }
                if($adv['apartment_condition_type_id'] > 0){
                    $adv['apartment_condition_type'] = ($apartment_condition_type)->get($adv['apartment_condition_type_id'])['name'];
                }
                if($adv['wall_material_type_id'] > 0){
                    $adv['wall_material_type'] = ($walls_material_types)->get($adv['wall_material_type_id'])['name'];
                }
                if($adv['ownership_type_id'] > 0){
                    $adv['ownership_type'] = ($ownership_type)->get($adv['ownership_type_id'])['name'];
                }
            }
        }

        return $resultSet;
    }

    public function getSimilar($total_room_count, $id): array
    {
        $conditions = [];
        $binds = [];
        $bindTypes = [];

        if (isset($total_room_count)) {
            $conditions[] = 'total_room_count = :total_room_count:';
            $binds['total_room_count'] = $total_room_count;
            $bindTypes['total_room_count'] = Column::BIND_PARAM_INT;
        }

        if (isset($id)) {
            $conditions[] = 'id != :id:';
            $binds['id'] = $id;
            $bindTypes['total_room_count'] = Column::BIND_PARAM_INT;
        }

        $pageSizes = $this->getDI()->get('config')['application']['simialrCardSize'];

        $findParams = [
            'conditions' => implode(' AND ', $conditions),
            'bind' => $binds,
            'bindTypes' => $bindTypes,
            'limit' => 1
        ];
      
        $findParamsCount = array_diff_key($findParams, array_flip(['limit']));

        $cacheKey = $this->cacheKey($findParams, 'ads_similar_'.$id);

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        if ($memcache->exists($cacheKey) && !isset($_GET['_cc'])) {
            $result = json_decode($memcache->get($cacheKey), TRUE);
        } else {
            $resultSet = self::find($findParams);
            $count = self::count($findParamsCount);
            $advs = $resultSet->toArray();

            $result = [
                'advs' => $advs,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];
            $memcache->save($cacheKey, json_encode($result), 60);
        }

        return $result;
    }


    public function getInfrastructure($geo)
    {
	    $memcache = $this->getDI()->get('memcache');        
        $geo_key = implode("_", $geo);
        $cacheKey = "newf.ads.geo_".$geo_key;
        $cachecount = $memcache->get($cacheKey);
        $geo_latitude = $geo[0];
        $geo_longitude = $geo[1];
        if (!$cachecount) {
            $similar = $this->getDI()->get('db')->fetchAll(sprintf("SELECT name, env_type_id,latitude,longitude,
								SQRT(POW(69.1 * (latitude - '%f'), 2) +POW(69.1 * ('%f' - longitude) * COS(latitude/57.3), 2)) AS distance FROM env_objects HAVING distance < 1
								ORDER BY env_type_id", $geo_latitude, $geo_longitude));
            $lifetime = $this->getDI()->get('config')['application']['housing_complex_stat_lifetime'];
            $serialize_result = serialize($similar);
            $memcache->save($cacheKey, $serialize_result, $lifetime);

        } else {
            $serialize_result = $memcache->get($cacheKey);
            $similar = unserialize($serialize_result);
        }
        
        return $similar;
    }

    public function getById($id): array
    {

        $conditions = 'id = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];
        $resultSet = self::find($findParams);
        $returnHousingComplex = [];
        if (count($resultSet) > 0) {
            $resultSet = $resultSet->toArray();
            $housing_complex_model = new HousingComplexModel();
            foreach ($resultSet as &$adv) {              
                if ($adv['housing_complex_id'] > 0) {
                    $adv['housing_complex'] = ($housing_complex_model)->get($adv['housing_complex_id']);
                }
                $returnHousingComplex = $adv;
            }
        }

        return $returnHousingComplex;
    }

    public function getApartDevelopersList($id, $params)
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSizes = $this->getDI()->get('config')['application']['housingComplexPageSize']->toArray();

        if (isset($params['pageSize'])) {
            $offset = ($page - 1) * $params['pageSize'];
        }

        $resultSet = $this->getDI()->get('db')->fetchAll(sprintf("SELECT ads.id FROM ads 
                                                                  LEFT JOIN housing_complex ON housing_complex.id = ads.housing_complex_id
                                                                  WHERE housing_complex.developer_id = %d
                                                                  LIMIT %d OFFSET %d", 
                                                                  $id, $params['pageSize'], $offset));

        $count = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT count(*) FROM ads 
                                                              LEFT JOIN housing_complex on housing_complex.id = ads.housing_complex_id 
                                                              WHERE housing_complex.developer_id = %d", 
                                                              $id));
      
        if($resultSet){
            foreach ($resultSet as $res) {
                $advs[] = $this->getById($res['id']);
            }
        }
         $result = [
                'advs' => $advs,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];

        return $result; 
    }
}
