<?php

namespace Newfinder\Models;

use Newfinder\Helpers\DataHelper;
use Newfinder\Helpers\StrHelper;
use Newfinder\Library\UrlManager;
use Phalcon\Cache\Backend\Libmemcached;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Db\Column;
use function var_dump;

class HousingComplexModel extends BaseAdvertModel
{
    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $built_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $construction_stage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $developer_id;

    protected $developer;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_region_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_region_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_region_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_area_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_area_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_locality_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_locality_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_locality_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_district_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_district_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_district_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_place_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geo_place_slug;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geo_place_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_sublocality_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_sublocality_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_sublocality_id;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_street_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    protected $geo_street_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_street_id;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    protected $geo_building_name;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=true)
     */
    protected $geo_building_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $geo_building_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_subway_station_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_subway_station_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    protected $geo_subway_station_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $geo_subway_station_line_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geo_subway_station_line_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $geo_subway_walk_access;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $geo_subway_transport_access;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    protected $geo_mkad_remoteness;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_railway_station_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_railway_station_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    protected $geo_railway_station_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_highway_name;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $geo_highway_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    protected $geo_highway_id;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    protected $geo_latitude;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    protected $geo_longitude;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $housing_complex_class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $housing_complex_status_id;

    protected $housing_complex_status_name;

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $newf_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $is_fz214;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $is_mortgage;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $note;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $parking_type_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $photo_list;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $photo_layout_list;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $price_from;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $price_to;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $ready_quarter;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $relevance;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $storeys_count;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $slug;
    protected $total_square_from;
    protected $total_square_to;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $walls_material_type_id;

    /**
     * Method to set the value of field built_type
     *
     * @param integer $built_type
     *
     * @return $this
     */
    public function setBuiltType($built_type)
    {
        $this->built_type = $built_type;

        return $this;
    }

    public function setIsCustomEdit($is_custom_edit)
    {
        $this->is_custom_edit = $is_custom_edit;

        return $this;
    }

    /**
     * Method to set the value of field contruction_stage
     *
     * @param integer $contruction_stage
     *
     * @return $this
     */
    public function setConstructionStage($contruction_stage)
    {
        $this->contruction_stage = $contruction_stage;

        return $this;
    }

    /**
     * Method to set the value of field developer_id
     *
     * @param integer $developer_id
     *
     * @return $this
     */
    public function setDeveloperId($developer_id)
    {
        $this->developer_id = $developer_id;

        return $this;
    }

    public function setDeveloper($developer)
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Method to set the value of field geo_region_name
     *
     * @param string $geo_region_name
     *
     * @return $this
     */
    public function setGeoRegionName($geo_region_name)
    {
        $this->geo_region_name = $geo_region_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_region_slug
     *
     * @param string $geo_region_slug
     *
     * @return $this
     */
    public function setGeoRegionSlug($geo_region_slug)
    {
        $this->geo_region_slug = $geo_region_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_region_id
     *
     * @param integer $geo_region_id
     *
     * @return $this
     */
    public function setGeoRegionId($geo_region_id)
    {
        $this->geo_region_id = $geo_region_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_area_name
     *
     * @param string $geo_area_name
     *
     * @return $this
     */
    public function setGeoAreaName($geo_area_name)
    {
        $this->geo_area_name = $geo_area_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_area_slug
     *
     * @param string $geo_area_slug
     *
     * @return $this
     */
    public function setGeoAreaSlug($geo_area_slug)
    {
        $this->geo_area_slug = $geo_area_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_area_id
     *
     * @param integer $geo_area_id
     *
     * @return $this
     */
    public function setGeoAreaId($geo_area_id)
    {
        $this->geo_area_id = $geo_area_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_locality_name
     *
     * @param string $geo_locality_name
     *
     * @return $this
     */
    public function setGeoLocalityName($geo_locality_name)
    {
        $this->geo_locality_name = $geo_locality_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_locality_slug
     *
     * @param string $geo_locality_slug
     *
     * @return $this
     */
    public function setGeoLocalitySlug($geo_locality_slug)
    {
        $this->geo_locality_slug = $geo_locality_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_locality_id
     *
     * @param integer $geo_locality_id
     *
     * @return $this
     */
    public function setGeoLocalityId($geo_locality_id)
    {
        $this->geo_locality_id = $geo_locality_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_district_name
     *
     * @param string $geo_district_name
     *
     * @return $this
     */
    public function setGeoDistrictName($geo_district_name)
    {
        $this->geo_district_name = $geo_district_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_district_slug
     *
     * @param string $geo_district_slug
     *
     * @return $this
     */
    public function setGeoDistrictSlug($geo_district_slug)
    {
        $this->geo_district_slug = $geo_district_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_district_id
     *
     * @param integer $geo_district_id
     *
     * @return $this
     */
    public function setGeoDistrictId($geo_district_id)
    {
        $this->geo_district_id = $geo_district_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_place_id
     *
     * @param integer $geo_place_id
     *
     * @return $this
     */
    public function setGeoPlaceId($geo_place_id)
    {
        $this->geo_place_id = $geo_place_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_place_slug
     *
     * @param string $geo_place_slug
     *
     * @return $this
     */
    public function setGeoPlaceSlug($geo_place_slug)
    {
        $this->geo_place_slug = $geo_place_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_place_name
     *
     * @param string $geo_place_name
     *
     * @return $this
     */
    public function setGeoPlaceName($geo_place_name)
    {
        $this->geo_place_name = $geo_place_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_sublocality_name
     *
     * @param string $geo_sublocality_name
     *
     * @return $this
     */
    public function setGeoSublocalityName($geo_sublocality_name)
    {
        $this->geo_sublocality_name = $geo_sublocality_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_sublocality_slug
     *
     * @param string $geo_sublocality_slug
     *
     * @return $this
     */
    public function setGeoSublocalitySlug($geo_sublocality_slug)
    {
        $this->geo_sublocality_slug = $geo_sublocality_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_sublocality_id
     *
     * @param integer $geo_sublocality_id
     *
     * @return $this
     */
    public function setGeoSublocalityId($geo_sublocality_id)
    {
        $this->geo_sublocality_id = $geo_sublocality_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_street_name
     *
     * @param string $geo_street_name
     *
     * @return $this
     */
    public function setGeoStreetName($geo_street_name)
    {
        $this->geo_street_name = $geo_street_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_street_slug
     *
     * @param string $geo_street_slug
     *
     * @return $this
     */
    public function setGeoStreetSlug($geo_street_slug)
    {
        $this->geo_street_slug = $geo_street_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_street_id
     *
     * @param integer $geo_street_id
     *
     * @return $this
     */
    public function setGeoStreetId($geo_street_id)
    {
        $this->geo_street_id = $geo_street_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_building_name
     *
     * @param string $geo_building_name
     *
     * @return $this
     */
    public function setGeoBuildingName($geo_building_name)
    {
        $this->geo_building_name = $geo_building_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_building_slug
     *
     * @param string $geo_building_slug
     *
     * @return $this
     */
    public function setGeoBuildingSlug($geo_building_slug)
    {
        $this->geo_building_slug = $geo_building_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_building_id
     *
     * @param integer $geo_building_id
     *
     * @return $this
     */
    public function setGeoBuildingId($geo_building_id)
    {
        $this->geo_building_id = $geo_building_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_station_name
     *
     * @param string $geo_subway_station_name
     *
     * @return $this
     */
    public function setGeoSubwayStationName($geo_subway_station_name)
    {
        $this->geo_subway_station_name = $geo_subway_station_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_station_slug
     *
     * @param string $geo_subway_station_slug
     *
     * @return $this
     */
    public function setGeoSubwayStationSlug($geo_subway_station_slug)
    {
        $this->geo_subway_station_slug = $geo_subway_station_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_station_id
     *
     * @param integer $geo_subway_station_id
     *
     * @return $this
     */
    public function setGeoSubwayStationId($geo_subway_station_id)
    {
        $this->geo_subway_station_id = $geo_subway_station_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_station_line_id
     *
     * @param integer $geo_subway_station_line_id
     *
     * @return $this
     */
    public function setGeoSubwayStationLineId($geo_subway_station_line_id)
    {
        $this->geo_subway_station_line_id = $geo_subway_station_line_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_station_line_name
     *
     * @param string $geo_subway_station_line_name
     *
     * @return $this
     */
    public function setGeoSubwayStationLineName($geo_subway_station_line_name)
    {
        $this->geo_subway_station_line_name = $geo_subway_station_line_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_walk_access
     *
     * @param integer $geo_subway_walk_access
     *
     * @return $this
     */
    public function setGeoSubwayWalkAccess($geo_subway_walk_access)
    {
        $this->geo_subway_walk_access = $geo_subway_walk_access;

        return $this;
    }

    /**
     * Method to set the value of field geo_subway_transport_access
     *
     * @param integer $geo_subway_transport_access
     *
     * @return $this
     */
    public function setGeoSubwayTransportAccess($geo_subway_transport_access)
    {
        $this->geo_subway_transport_access = $geo_subway_transport_access;

        return $this;
    }

    /**
     * Method to set the value of field geo_mkad_remoteness
     *
     * @param integer $geo_mkad_remoteness
     *
     * @return $this
     */
    public function setGeoMkadRemoteness($geo_mkad_remoteness)
    {
        $this->geo_mkad_remoteness = $geo_mkad_remoteness;

        return $this;
    }

    /**
     * Method to set the value of field geo_railway_station_name
     *
     * @param string $geo_railway_station_name
     *
     * @return $this
     */
    public function setGeoRailwayStationName($geo_railway_station_name)
    {
        $this->geo_railway_station_name = $geo_railway_station_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_railway_station_slug
     *
     * @param string $geo_railway_station_slug
     *
     * @return $this
     */
    public function setGeoRailwayStationSlug($geo_railway_station_slug)
    {
        $this->geo_railway_station_slug = $geo_railway_station_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_railway_station_id
     *
     * @param integer $geo_railway_station_id
     *
     * @return $this
     */
    public function setGeoRailwayStationId($geo_railway_station_id)
    {
        $this->geo_railway_station_id = $geo_railway_station_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_highway_name
     *
     * @param string $geo_highway_name
     *
     * @return $this
     */
    public function setGeoHighwayName($geo_highway_name)
    {
        $this->geo_highway_name = $geo_highway_name;

        return $this;
    }

    /**
     * Method to set the value of field geo_highway_slug
     *
     * @param string $geo_highway_slug
     *
     * @return $this
     */
    public function setGeoHighwaySlug($geo_highway_slug)
    {
        $this->geo_highway_slug = $geo_highway_slug;

        return $this;
    }

    /**
     * Method to set the value of field geo_highway_id
     *
     * @param integer $geo_highway_id
     *
     * @return $this
     */
    public function setGeoHighwayId($geo_highway_id)
    {
        $this->geo_highway_id = $geo_highway_id;

        return $this;
    }

    /**
     * Method to set the value of field geo_latitude
     *
     * @param double $geo_latitude
     *
     * @return $this
     */
    public function setGeoLatitude($geo_latitude)
    {
        $this->geo_latitude = $geo_latitude;

        return $this;
    }

    /**
     * Method to set the value of field geo_longitude
     *
     * @param double $geo_longitude
     *
     * @return $this
     */
    public function setGeoLongitude($geo_longitude)
    {
        $this->geo_longitude = $geo_longitude;

        return $this;
    }

    /**
     * Method to set the value of field housing_complex_class_id
     *
     * @param integer $housing_complex_class_id
     *
     * @return $this
     */
    public function setHousingComplexClassId($housing_complex_class_id)
    {
        $this->housing_complex_class_id = $housing_complex_class_id;

        return $this;
    }

    /**
     * Method to set the value of field housing_complex_status_id
     *
     * @param integer $housing_complex_status_id
     *
     * @return $this
     */
    public function setHousingComplexStatusId($housing_complex_status_id)
    {
        $this->housing_complex_status_id = $housing_complex_status_id;

        return $this;
    }

    /**
     * Method to set the value of field housing_complex_status_name
     *
     * @param integer $housing_complex_status_name
     *
     * @return $this
     */
    public function setHousingComplexStatusName($housing_complex_status_name)
    {
        $this->housing_complex_status_name = $housing_complex_status_name;

        return $this;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field newf_id
     *
     * @param integer $newf_id
     *
     * @return $this
     */
    public function setNewfId($newf_id)
    {
        $this->newf_id = $newf_id;

        return $this;
    }

    /**
     * Method to set the value of field is_fz214
     *
     * @param integer $is_fz214
     *
     * @return $this
     */
    public function setIsFz214($is_fz214)
    {
        $this->is_fz214 = $is_fz214;

        return $this;
    }

    /**
     * Method to set the value of field is_mortgage
     *
     * @param integer $is_mortgage
     *
     * @return $this
     */
    public function setIsMortgage($is_mortgage)
    {
        $this->is_mortgage = $is_mortgage;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field note
     *
     * @param string $note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Method to set the value of field parking_type_id
     *
     * @param integer $parking_type_id
     *
     * @return $this
     */
    public function setParkingTypeId($parking_type_id)
    {
        $this->parking_type_id = $parking_type_id;

        return $this;
    }

    /**
     * Method to set the value of field photo_list
     *
     * @param string $photo_list
     *
     * @return $this
     */
    public function setPhotoList($photo_list)
    {
        $this->photo_list = $photo_list;

        return $this;
    }

    /**
     * Method to set the value of field photo_layout_list
     *
     * @param string $photo_layout_list
     *
     * @return $this
     */
    public function setPhotoLayoutList($photo_layout_list)
    {
        $this->photo_layout_list = $photo_layout_list;

        return $this;
    }

    /**
     * Method to set the value of field price_from
     *
     * @param string $price_from
     *
     * @return $this
     */
    public function setPriceFrom($price_from)
    {
        $this->price_from = $price_from;

        return $this;
    }

    /**
     * Method to set the value of field price_to
     *
     * @param string $price_to
     *
     * @return $this
     */
    public function setPriceTo($price_to)
    {
        $this->price_to = $price_to;

        return $this;
    }

    /**
     * Method to set the value of field total_square_from
     *
     * @param string $total_square_from
     *
     * @return $this
     */
    public function setTotalSquareFrom($total_square_from)
    {
        $this->total_square_from = $total_square_from;

        return $this;
    }


    /**
     * Method to set the value of field total_square_to
     *
     * @param string $total_square_to
     *
     * @return $this
     */
    public function setTotalSquareTo($total_square_to)
    {
        $this->total_square_to = $total_square_to;

        return $this;
    }

    /**
     * Method to set the value of field ready_quarter
     *
     * @param integer $ready_quarter
     *
     * @return $this
     */
    public function setReadyQuarter($ready_quarter)
    {
        $this->ready_quarter = $ready_quarter;

        return $this;
    }

    /**
     * Method to set the value of field relevance
     *
     * @param integer $relevance
     *
     * @return $this
     */
    public function setRelevance($relevance)
    {
        $this->relevance = $relevance;

        return $this;
    }

    /**
     * Method to set the value of field storeys_count
     *
     * @param integer $storeys_count
     *
     * @return $this
     */
    public function setStoreysCount($storeys_count)
    {
        $this->storeys_count = $storeys_count;

        return $this;
    }

    /**
     * Method to set the value of field slug
     *
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Method to set the value of field url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Method to set the value of field walls_material_type_id
     *
     * @param integer $walls_material_type_id
     *
     * @return $this
     */
    public function setWallsMaterialTypeId($walls_material_type_id)
    {
        $this->walls_material_type_id = $walls_material_type_id;

        return $this;
    }

    /**
     * Returns the value of field built_type
     *
     * @return integer
     */
    public function getBuiltType()
    {
        return $this->built_type;
    }

    /**
     * Returns the value of field construction_stage
     *
     * @return integer
     */
    public function getConstructionStage()
    {
        return $this->construction_stage;
    }

    /**
     * Returns the value of field developer_id
     *
     * @return integer
     */
    public function getDeveloperId()
    {
        return $this->developer_id;
    }

    /**
     * Returns the value of field developer
     *
     * @return integer
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * Returns the value of field geo_region_name
     *
     * @return string
     */
    public function getGeoRegionName()
    {
        return $this->geo_region_name;
    }

    /**
     * Returns the value of field geo_region_slug
     *
     * @return string
     */
    public function getGeoRegionSlug()
    {
        return $this->geo_region_slug;
    }

    /**
     * Returns the value of field geo_region_id
     *
     * @return integer
     */
    public function getGeoRegionId()
    {
        return $this->geo_region_id;
    }

    /**
     * Returns the value of field geo_area_name
     *
     * @return string
     */
    public function getGeoAreaName()
    {
        return $this->geo_area_name;
    }

    /**
     * Returns the value of field geo_area_slug
     *
     * @return string
     */
    public function getGeoAreaSlug()
    {
        return $this->geo_area_slug;
    }

    /**
     * Returns the value of field geo_area_id
     *
     * @return integer
     */
    public function getGeoAreaId()
    {
        return $this->geo_area_id;
    }

    /**
     * Returns the value of field geo_locality_name
     *
     * @return string
     */
    public function getGeoLocalityName()
    {
        return $this->geo_locality_name;
    }

    /**
     * Returns the value of field geo_locality_slug
     *
     * @return string
     */
    public function getGeoLocalitySlug()
    {
        return $this->geo_locality_slug;
    }

    /**
     * Returns the value of field geo_locality_id
     *
     * @return integer
     */
    public function getGeoLocalityId()
    {
        return $this->geo_locality_id;
    }

    /**
     * Returns the value of field geo_district_name
     *
     * @return string
     */
    public function getGeoDistrictName()
    {
        return $this->geo_district_name;
    }

    /**
     * Returns the value of field geo_district_slug
     *
     * @return string
     */
    public function getGeoDistrictSlug()
    {
        return $this->geo_district_slug;
    }

    /**
     * Returns the value of field geo_district_id
     *
     * @return integer
     */
    public function getGeoDistrictId()
    {
        return $this->geo_district_id;
    }

    /**
     * Returns the value of field geo_place_id
     *
     * @return integer
     */
    public function getGeoPlaceId()
    {
        return $this->geo_place_id;
    }

    /**
     * Returns the value of field geo_place_slug
     *
     * @return string
     */
    public function getGeoPlaceSlug()
    {
        return $this->geo_place_slug;
    }

    /**
     * Returns the value of field geo_place_name
     *
     * @return string
     */
    public function getGeoPlaceName()
    {
        return $this->geo_place_name;
    }

    /**
     * Returns the value of field geo_sublocality_name
     *
     * @return string
     */
    public function getGeoSublocalityName()
    {
        return $this->geo_sublocality_name;
    }

    /**
     * Returns the value of field geo_sublocality_slug
     *
     * @return string
     */
    public function getGeoSublocalitySlug()
    {
        return $this->geo_sublocality_slug;
    }

    /**
     * Returns the value of field geo_sublocality_id
     *
     * @return integer
     */
    public function getGeoSublocalityId()
    {
        return $this->geo_sublocality_id;
    }

    /**
     * Returns the value of field geo_street_name
     *
     * @return string
     */
    public function getGeoStreetName()
    {
        return $this->geo_street_name;
    }

    /**
     * Returns the value of field geo_street_slug
     *
     * @return string
     */
    public function getGeoStreetSlug()
    {
        return $this->geo_street_slug;
    }

    /**
     * Returns the value of field geo_street_id
     *
     * @return integer
     */
    public function getGeoStreetId()
    {
        return $this->geo_street_id;
    }

    /**
     * Returns the value of field geo_building_name
     *
     * @return string
     */
    public function getGeoBuildingName()
    {
        return $this->geo_building_name;
    }

    /**
     * Returns the value of field geo_building_slug
     *
     * @return string
     */
    public function getGeoBuildingSlug()
    {
        return $this->geo_building_slug;
    }

    /**
     * Returns the value of field geo_building_id
     *
     * @return integer
     */
    public function getGeoBuildingId()
    {
        return $this->geo_building_id;
    }

    /**
     * Returns the value of field geo_subway_station_name
     *
     * @return string
     */
    public function getGeoSubwayStationName()
    {
        return $this->geo_subway_station_name;
    }

    /**
     * Returns the value of field geo_subway_station_slug
     *
     * @return string
     */
    public function getGeoSubwayStationSlug()
    {
        return $this->geo_subway_station_slug;
    }

    /**
     * Returns the value of field geo_subway_station_id
     *
     * @return integer
     */
    public function getGeoSubwayStationId()
    {
        return $this->geo_subway_station_id;
    }

    /**
     * Returns the value of field geo_subway_station_line_id
     *
     * @return integer
     */
    public function getGeoSubwayStationLineId()
    {
        return $this->geo_subway_station_line_id;
    }

    /**
     * Returns the value of field geo_subway_station_line_name
     *
     * @return string
     */
    public function getGeoSubwayStationLineName()
    {
        return $this->geo_subway_station_line_name;
    }

    /**
     * Returns the value of field geo_subway_walk_access
     *
     * @return integer
     */
    public function getGeoSubwayWalkAccess()
    {
        return $this->geo_subway_walk_access;
    }

    /**
     * Returns the value of field geo_subway_transport_access
     *
     * @return integer
     */
    public function getGeoSubwayTransportAccess()
    {
        return $this->geo_subway_transport_access;
    }

    /**
     * Returns the value of field geo_mkad_remoteness
     *
     * @return integer
     */
    public function getGeoMkadRemoteness()
    {
        return $this->geo_mkad_remoteness;
    }

    /**
     * Returns the value of field geo_railway_station_name
     *
     * @return string
     */
    public function getGeoRailwayStationName()
    {
        return $this->geo_railway_station_name;
    }

    /**
     * Returns the value of field geo_railway_station_slug
     *
     * @return string
     */
    public function getGeoRailwayStationSlug()
    {
        return $this->geo_railway_station_slug;
    }

    /**
     * Returns the value of field geo_railway_station_id
     *
     * @return integer
     */
    public function getGeoRailwayStationId()
    {
        return $this->geo_railway_station_id;
    }

    /**
     * Returns the value of field geo_highway_name
     *
     * @return string
     */
    public function getGeoHighwayName()
    {
        return $this->geo_highway_name;
    }

    /**
     * Returns the value of field geo_highway_slug
     *
     * @return string
     */
    public function getGeoHighwaySlug()
    {
        return $this->geo_highway_slug;
    }

    /**
     * Returns the value of field geo_highway_id
     *
     * @return integer
     */
    public function getGeoHighwayId()
    {
        return $this->geo_highway_id;
    }

    /**
     * Returns the value of field geo_latitude
     *
     * @return double
     */
    public function getGeoLatitude()
    {
        return $this->geo_latitude;
    }

    /**
     * Returns the value of field geo_longitude
     *
     * @return double
     */
    public function getGeoLongitude()
    {
        return $this->geo_longitude;
    }

    /**
     * Returns the value of field housing_complex_class_id
     *
     * @return integer
     */
    public function getHousingComplexClassId()
    {
        return $this->housing_complex_class_id;
    }

    /**
     * Returns the value of field housing_complex_status_id
     *
     * @return integer
     */
    public function getHousingComplexStatusId()
    {
        return $this->housing_complex_status_id;
    }

    /**
     * Returns the value of field housing_complex_status_name
     *
     * @return integer
     */
    public function getHousingComplexStatusName()
    {
        return $this->housing_complex_status_name;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field newf_id
     *
     * @return integer
     */
    public function getNewfId()
    {
        return $this->newf_id;
    }

    /**
     * Returns the value of field is_fz214
     *
     * @return integer
     */
    public function getIsFz214()
    {
        return $this->is_fz214;
    }

    /**
     * Returns the value of field is_mortgage
     *
     * @return integer
     */
    public function getIsMortgage()
    {
        return $this->is_mortgage;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Returns the value of field parking_type_id
     *
     * @return integer
     */
    public function getParkingTypeId()
    {
        return $this->parking_type_id;
    }

    /**
     * Returns the value of field photo_list
     *
     * @return string
     */
    public function getPhotoList()
    {
        return $this->photo_list;
    }

    /**
     * Returns the value of field photo_layout_list
     *
     * @return string
     */
    public function getPhotoLayoutList()
    {
        return $this->photo_layout_list;
    }

    /**
     * Returns the value of field price_from
     *
     * @return string
     */
    public function getPriceFrom()
    {
        return $this->price_from;
    }

    /**
     * Returns the value of field price_to
     *
     * @return string
     */
    public function getPriceTo()
    {
        return $this->price_to;
    }

    /**
     * Returns the value of field ready_quarter
     *
     * @return integer
     */
    public function getReadyQuarter()
    {
        return $this->ready_quarter;
    }


    /**
     * Returns the value of field relevance
     *
     * @return integer
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * Returns the value of field storeys_count
     *
     * @return integer
     */
    public function getStoreysCount()
    {
        return $this->storeys_count;
    }

    /**
     * Returns the value of field slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the value of field url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns the value of field walls_material_type_id
     *
     * @return integer
     */
    public function getWallsMaterialTypeId()
    {
        return $this->walls_material_type_id;
    }

    public $second_advs_count;

    public function setSecondAdvsCount($second_advs_count)
    {
        $this->second_advs_count = $second_advs_count;
    }

    public function getSecondAdvsCount()
    {
        return $this->second_advs_count;
    }

    public $total_room_count_mask;

    public function setTotalRoomCountMask($total_room_count_mask)
    {
        $this->total_room_count_mask = $total_room_count_mask;
    }

    public function getTotalRoomCountMask()
    {
        return $this->total_room_count_mask;
    }

    public $storey_mask;

    public function setStoreyMask($storey_mask)
    {
        $this->storey_mask = $storey_mask;
    }

    public function getStoreyMask()
    {
        return $this->storey_mask;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("housing_complex");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'housing_complex';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return HousingComplex[]|HousingComplex|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = NULL)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return HousingComplex|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = NULL)
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
        $housing_complex_class = new HousingComplexClass;
        if ($this->housing_complex_class_id > 0) {
            $hc_class = mb_strtolower(($housing_complex_class)->get((int)$this->housing_complex_class_id)['name']);
        }

        switch ($this->geo_region_id) {

            case 77:
                $sublocality = (new StrHelper())->to_prepositional($this->geo_sublocality_name);
                break;
            case 50:
                $sublocality = (new StrHelper())->to_prepositional($this->geo_place_name);
                break;
            case 90:
                $sublocality = (new StrHelper())->to_prepositional($this->geo_area_name);
                break;
            default:
                $sublocality = (new StrHelper())->to_prepositional($this->geo_place_name);

        }

        $result = $this->name;
        if (!empty($hc_class)) {
            $result .= " - жилье " . $hc_class . "-класса";
        }
        $result .= " в " . (new StrHelper())->to_prepositional($this->geo_region_name) . " в " . $sublocality;
        if ($this->geo_subway_walk_access <= 15) {
            $result .= " у станции метро ";
        } else {
            $result .= ". Ближайшая станция метро - ";
        }

        $result .= $this->geo_subway_station_name;

        return $result;
    }

    public function getMetaKeywords()
    {

    }

    public function getMetaTitle()
    {
        switch (true) {
            case strripos($this->geo_place_name, ' д.'):
                $result = "д. " . str_replace('д.', "", $this->geo_place_name);
                break;
            case strripos($this->geo_place_name, ' с.'):
                $result = "с. " . str_replace('с.', "", $this->geo_place_name);
                break;
            case strripos($this->geo_place_name, ' пос.'):
                $result = "пос. " . str_replace('пос.', "", $this->geo_place_name);
                $result .= " в " . (new StrHelper())->to_prepositional($this->geo_region_name);
                break;
            case strripos($this->geo_place_name, ' КП'):
                $result = "коттеджном поселке " . str_replace('КП', "", $this->geo_place_name);
                $result .= " в " . (new StrHelper())->to_prepositional($this->geo_region_name);
                break;
            case $this->geo_region_id == 90:
            case $this->geo_region_id == 77:
                $result = (new StrHelper())->to_prepositional($this->geo_region_name);
                break;
            default:
                $result = (new StrHelper())->to_prepositional($this->geo_place_name);
        }

        return $this->name . " в " . $result . ": обзор жилого комплекса, застройщик, адрес, расположение, фото";
    }

    public function getObjectUrl()
    {
        /*
            switch (true) {
                case strripos($this->geo_place_name, ' д.'):
                    $result = "д. " . str_replace('д.', "", $this->geo_place_name);
                    break;
                case strripos($this->geo_place_name, ' с.'):
                    $result = "с. " . str_replace('с.', "", $this->geo_place_name);
                    break;
                case strripos($this->geo_place_name, ' пос.'):
                    $result = "пос. " . str_replace('пос.', "", $this->geo_place_name);
                    $result .= " в " . (new StrHelper())->to_prepositional($this->geo_region_name);
                    break;
                case strripos($this->geo_place_name, ' КП'):
                    $result = "коттеджном поселке " . str_replace('КП', "", $this->geo_place_name);
                    $result .= " в " . (new StrHelper())->to_prepositional($this->geo_region_name);
                    break;
                case $this->geo_region_id == 90:
                case $this->geo_region_id == 77:
                    $result = (new StrHelper())->to_prepositional($this->geo_region_name);
                    break;
                default:
                    $result = (new StrHelper())->to_prepositional($this->geo_place_name);
            }

            return $this->name . " в " . $result . ": обзор жилого комплекса, застройщик, адрес, расположение, фото";
        */
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

    public function search(array $params = []): array
    {
        $dataHelper = new DataHelper();
        $conditions = [];
        $binds = [];
        $bindTypes = [];
        $order = ['relevance DESC'];

        if (isset($params['region'])) {
            $data = array_values(array_map(function ($it) {
                return $it['id'];
            }, $params['region']));
            $conditions[] = 'geo_region_id IN({geo_region_id:array})';
            $binds['geo_region_id'] = $data;
        }

        if (isset($params['district'])) {
            $data = array_values(array_map(function ($it) {
                return $it['id'];
            }, $params['district']));
            $conditions[] = 'geo_district_id IN({geo_district_id:array})';
            $binds['geo_district_id'] = $data;
        }

        if (isset($params['metro'])) {
            $data = array_values(array_map(function ($it) {
                return $it['id'];
            }, $params['metro']));
            $conditions[] = 'geo_subway_station_id IN({geo_subway_station_id:array})';
            $binds['geo_subway_station_id'] = $data;
        }

        if (isset($params['price_from'])) {
            $conditions[] = 'price_from >= :price_from:';
            $binds['price_from'] = $params['price_from'];
            $bindTypes['price_from'] = Column::BIND_PARAM_INT;
        }
        if (isset($params['price_to'])) {
            $conditions[] = 'price_to <= :price_to:';
            $binds['price_to'] = $params['price_to'];
            $bindTypes['price_to'] = Column::BIND_PARAM_INT;
        }

        if (isset($params['total_square_from'])) {
            $conditions[] = 'total_square_from >= :total_square_from:';
            $binds['total_square_from'] = $params['total_square_from'];
            $bindTypes['total_square_from'] = Column::BIND_PARAM_INT;
        }
        if (isset($params['total_square_to'])) {
            $conditions[] = 'total_square_to <= :total_square_to:';
            $binds['total_square_to'] = $params['total_square_to'];
            $bindTypes['total_square_to'] = Column::BIND_PARAM_INT;
        }
        if (isset($params['total_room_count']) && count($params['total_room_count']) > 0) {
            $cmpInt = $dataHelper->getBinaryInDecForTotalRoomCounts(implode(',', $params['total_room_count']));
            $conditions[] = 'total_room_count_mask & :total_room_count_mask:';
            $binds['total_room_count_mask'] = $cmpInt;
            $bindTypes['total_room_count_mask'] = Column::BIND_PARAM_INT;
        }

        if (isset($params['storey']) && count($params['storey']) > 0) {
            if (in_array('not_first', $params['storey'])) {
                $cmpInt = $dataHelper->getBinaryInDecForStoreys('1');
                $conditions[] = 'storey_mask > 0';
                $conditions[] = 'storey_mask & :storey_mask: > 0';
                $binds['storey_mask'] = $cmpInt;
                $bindTypes['storey_mask'] = Column::BIND_PARAM_INT;
            }
        }
//        die(var_dump($params));
        if (isset($params['building_type']) && count($params['building_type']) > 0) {
            $conditions[] = 'walls_material_type_id IN({walls_material_type_id:array})';
            $binds['walls_material_type_id'] = $params['building_type'];
        }

        if (isset($params['subway_access_type']) && count($params['subway_access_type']) > 0) {
            $subway_access_type = $params['subway_access_type'][0];
            if (in_array($subway_access_type, [1, 2])) {
                $field = [1 => 'geo_subway_walk_access', 2 => 'geo_subway_transport_access'][$subway_access_type];
                $conditions[] = "$field > 0";

                if (isset($params['subway_access']) && count($params['subway_access']) > 0 && $params['subway_access'][0] > 0) {
                    $conditions[] = "$field <= :$field:";
                    $binds[$field] = $params['subway_access'][0];
                    $bindTypes[$field] = Column::BIND_PARAM_INT;
                }
            }
        }


        if (isset($params['mkad_remoteness']) && $params['mkad_remoteness'] > 0) {
            $conditions[] = "geo_mkad_remoteness <= :geo_mkad_remoteness:";
            $binds['geo_mkad_remoteness'] = $params['mkad_remoteness'];
            $bindTypes['geo_mkad_remoteness'] = Column::BIND_PARAM_INT;
        }
        if (isset($params['has_mortgage']) && $params['has_mortgage'] == 1) {
            $conditions[] = "is_mortgage = 1";
        }

        if (isset($params['is_fz_214']) && $params['is_fz_214'] == 1) {
            $conditions[] = "is_fz214 = 1";
        }

        if (isset($params['built_type'])) {
            if ($params['built_type'][0] == 'undone') {
                $conditions[] = 'housing_complex_status_id != :housing_complex_status_id:';
                $binds['housing_complex_status_id'] = 1;
                $bindTypes['housing_complex_status_id'] = Column::BIND_PARAM_INT;
            } elseif ($params['built_type'][0] == 'done') {
                $conditions[] = 'housing_complex_status_id = :housing_complex_status_id:';
                $binds['housing_complex_status_id'] = 1;
                $bindTypes['housing_complex_status_id'] = Column::BIND_PARAM_INT;
            } elseif (is_numeric($params['built_type'][0])) {
                $conditions[] = 'built_type = :built_type:';
                $binds['built_type'] = $params['built_type'][0];
                $bindTypes['built_type'] = Column::BIND_PARAM_INT;
            }
        }

        if (isset($params['name'])) {
            $conditions[] = 'name LIKE :name:';
            #s$conditions[] = 'MATCH(name) AGAINST (:name:)';
            $binds['name'] = '%' . $params['name'] . '%';
            $bindTypes['name'] = Column::BIND_PARAM_STR;
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
            'offset' => $offset,
        ];
        if (count($order) > 0) {
            $findParams['order'] = implode(', ', $order);
        }
        # die(var_dump($findParams));
        $findParamsCount = array_diff_key($findParams, array_flip(['offset', 'limit']));

        $cacheKey = $this->cacheKey($findParams, 'housing_complex');

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

    protected function setSecondAdvsCountToAdvs(&$advs)
    {
        $housingComplexIds = array_filter(array_map(function ($it) {
            return $it['id'];
        }, $advs));

        if (count($housingComplexIds) > 0) {
            /**
             * @var $db Mysql
             */
            $db = $this->getDI()->get('db');

            echo 'SELECT count(*) cnt, housing_complex_id 
          FROM ads 
          WHERE housing_complex_id IN (' . implode(',', $housingComplexIds) . ') 
          GROUP BY housing_complex_id';

            $counts = $db->fetchAll('SELECT count(*) cnt, housing_complex_id 
          FROM ads 
          WHERE housing_complex_id IN (' . implode(',', $housingComplexIds) . ') 
          GROUP BY housing_complex_id', 2);

            if (count($counts) > 0) {
                $_counts = [];
                foreach ($counts as $cnt) {
                    $_counts[$cnt['housing_complex_id']] = $cnt['cnt'];
                }
                if (count($advs) > 0) {
                    foreach ($advs as &$adv) {
                        if (isset($_counts[$adv['id']])) {
                            $adv['second_advs_count'] = $_counts[$adv['id']];
                        }
                    }
                }
            }
        }
    }

    protected function setHousingComplexNameToAdvs(&$advs)
    {
        $housing_complex_model = new HousingComplexStatus();
        if (count($advs) > 0) {
            foreach ($advs as &$adv) {
                if ($adv['housing_complex_status_id'] > 0) {
                    $adv['housing_complex_status_name'] = ($housing_complex_model)->get($adv['housing_complex_status_id'])['name'];
                }
            }
        }
    }

    protected function setDeveloperToAdvs(&$advs)
    {
        $developers_model = new DevelopersModel();
        if (count($advs) > 0) {
            foreach ($advs as &$adv) {
                if ($adv['developer_id'] > 0) {
                    $adv['developer'] = $developers_model->get($adv['developer_id']);
                }
            }
        }
    }

    public function getStat()
    {
        $memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.housing_complex.sdan_count";
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
            $amount["built"] = $this->count("housing_complex_status_id = 1 AND geo_region_id IN (50,77,90)");
            $amount["building"] = $this->count("housing_complex_status_id != 1 AND geo_region_id IN (50,77,90)");
            $lifetime = $this->getDI()->get('config')['application']['housing_complex_stat_lifetime'];
            $serialize_result = serialize($amount);
            $memcache->save($cacheKey, $serialize_result, $lifetime);

        } else {
            $serialize_result = $memcache->get($cacheKey);
            $amount = unserialize($serialize_result);
        }

        return $amount;
    }

    public function get($id): array
    {

        $conditions = 'id = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];

        $resultSet = self::findFirst($findParams);
        $adv = $resultSet->toArray();
        $this->setDeveloperToAdvs($advs);
        $this->setHousingComplexNameToAdvs($advs);


        return $adv;
    }

    public function getBySlug($slug): array
    {
        $conditions = 'slug = :slug:';
        $binds['slug'] = $slug;
        $bindTypes['slug'] = Column::BIND_PARAM_STR;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];

        $resultSet = self::find($findParams);

        $advs = $resultSet->toArray();
        if (count($advs) > 0) {
            $developers_model = new DevelopersModel();
            $housing_complex_model = new HousingComplexStatus();
            $housing_complex_class = new HousingComplexClass();
            foreach ($advs as &$adv) {
                if ($adv['developer_id'] > 0) {
                    $adv['developer'] = ($developers_model)->get($adv['developer_id']);
                }
                if ($adv['housing_complex_status_id'] > 0) {
                    $adv['housing_complex_status_name'] = ($housing_complex_model)->get($adv['housing_complex_status_id'])['name'];
                }
                if ($adv['housing_complex_class_id'] > 0) {
                    $adv['housing_complex_class_name'] = ($housing_complex_class)->get($adv['housing_complex_class_id'])['name'];
                }

                $adv['ads'] = $this->getAds($adv['id']);
            }
        }


        return $advs;
    }

    public function getGeoSearch($search_geo)
    {
        if ($search_geo['table'] == 'geo_administrative_district') {
            $result = $this->getDI()->get('db')->fetchAll(sprintf("SELECT id, name as value, slug FROM %s", $search_geo['table']));
        } else {
            $result = $this->getDI()->get('db')->fetchAll(sprintf("SELECT id, name as value, slug FROM %s WHERE %s = '%s'", $search_geo['table'], $search_geo['where'], $search_geo['value']));
        }
        return json_encode($result);
    }


    public function getGeoRegion()
    {
        $region = $this->getDI()->get('db')->fetchAll("SELECT id, name as value, slug FROM geo_region");
        return json_encode($region);
    }

    public function getGeoMetro()
    {
        $metro = $this->getDI()->get('db')->fetchAll("SELECT id, name as value, slug FROM geo_metro");
        return json_encode($metro);
    }

    public function getGeoRoad()
    {
        $road = $this->getDI()->get('db')->fetchAll("SELECT id, name as value, slug FROM geo_road");
        return json_encode($road);
    }

    public function calcRelevance()
    {
        $bin = [];

        $bin[] = (int)($this->total_square_from > 0);
        $bin[] = (int)(!empty($this->built_type));
        $bin[] = (int)($this->price_from > 0);
        $bin[] = (int)(!empty($this->photo_list));

        return bindec(implode('', $bin));
    }

    public function getSearchUrlBySubwayStation()
    {
        $params = [];
        $params['region'][] = ['id' => $this->geo_region_id];
        if (!empty($this->geo_subway_station_slug)) {
            $params['metro'][] = [
                'id' => $this->geo_subway_station_id,
                'slug' => $this->geo_subway_station_slug
            ];
        }
        return (new UrlManager())->buildUrl($params);
    }

    public function getUrlForDeveloper()
    {
        if ($this->developer) {
            $params = ['slug' => $this->developer['slug']];
            return (new UrlManager())->buildUrlForDeveloper($params);
        }
        return '';
    }

    public function getAds()
    {
        $ads = $this->getDI()->get('db')->fetchAll(sprintf(
            "SELECT total_room_count, MIN(total_square) AS min_total_square, MIN(price) AS min_price, MAX(price) AS max_price 
                      from ads 
                      WHERE housing_complex_id = %d 
                      GROUP BY total_room_count 
                      ORDER BY total_room_count", $this->id));
        return $ads;
    }

    public function getSimilarObject()
    {
	$memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.housing_complex.similar_object_".$this->slug;
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
            $similar = $this->getDI()->get('db')->fetchAll(sprintf("SELECT name, env_type_id,latitude,longitude,
								SQRT(POW(69.1 * (latitude - '%f'), 2) +POW(69.1 * ('%f' - longitude) * COS(latitude/57.3), 2)) AS distance FROM env_objects HAVING distance < 1
								ORDER BY env_type_id", $this->geo_latitude, $this->geo_longitude));
            $lifetime = $this->getDI()->get('config')['application']['housing_complex_stat_lifetime'];
            $serialize_result = serialize($similar);
            $memcache->save($cacheKey, $serialize_result, $lifetime);

        } else {
            $serialize_result = $memcache->get($cacheKey);
            $similar = unserialize($serialize_result);
        }
        
        return $similar;
    }


    public function getSimilar($size, $slug): array
    {

	$memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.housing_complex.similar_".$slug;
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
             $result = [];
        $resultSet = self::find("slug = '$slug'");

        $advs = $resultSet->toArray();
        if (count($advs) > 0) {
            foreach ($advs as &$adv) {
                $findParams = [
                    'conditions' => "SQRT(POW(69.1 * (geo_latitude - :latitude:), 2) +POW(69.1 * (:longitude: - geo_longitude) * COS(geo_latitude/57.3), 2))<1 AND price_to <= :price:",
                    'bind' => ['latitude' => $adv['geo_latitude'], 'longitude' => $adv['geo_longitude'], 'price' => $adv['price_to']],
                    'bindTypes' => ['latitude' => Column::TYPE_FLOAT, 'longitude' => Column::TYPE_FLOAT, 'price' => Column::BIND_PARAM_INT],
                    'limit' => $size
                ];

                $findParamsCount = array_diff_key($findParams, array_flip(['limit']));


                $resultSet = self::find($findParams);
                $count = self::count($findParamsCount);
                $advs = $resultSet->toArray();

                $this->setDeveloperToAdvs($advs);
                $this->setHousingComplexNameToAdvs($advs);
                $this->setSecondAdvsCountToAdvs($advs);

                $result = [
                    'advs' => $advs,
                    'meta' => [
                        'total' => (int)$count,
                    ],
                ];

            }
        }
            $lifetime = $this->getDI()->get('config')['application']['housing_complex_stat_lifetime'];
            $serialize_result = serialize($result);
            $memcache->save($cacheKey, $serialize_result, $lifetime);

        } else {
            $serialize_result = $memcache->get($cacheKey);
            $result = unserialize($serialize_result);
        }

       
        return $result;
    }

    public function getSimilarAds($size, $slug): array
    {

	$memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.housing_complex.similar_ads_".$slug;
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
		$result = [];
		$resultSet = self::find("slug = '$slug'");

		$advs = $resultSet->toArray();
		if (count($advs) > 0) {
		    $ads = new Ads();
		    foreach ($advs as &$adv) {
		        $findParams = [
		            'conditions' => "price <= :price:",
		            'bind' => [
		                'price' => $adv['price_to']
		            ],
		            'bindTypes' => [
		                'price' => Column::BIND_PARAM_INT
		            ],
		            'limit' => 1
		        ];

		        $findParamsCount = array_diff_key($findParams, array_flip(['limit']));
		        $resultSet = $ads::find($findParams);
		        $count = $ads::count($findParamsCount);
		        $advs = $resultSet->toArray();

		        $this->setDeveloperToAdvs($advs);
		        $this->setHousingComplexNameToAdvs($advs);
		        $this->setSecondAdvsCountToAdvs($advs);

		        $result = [
		            'advs' => $advs,
		            'meta' => [
		                'total' => (int)$count,
		            ],
		        ];

		    }
		} 

	    $lifetime = $this->getDI()->get('config')['application']['housing_complex_stat_lifetime'];
            $serialize_result = serialize($result);
            $memcache->save($cacheKey, $serialize_result, $lifetime);

        } else {
            $serialize_result = $memcache->get($cacheKey);
            $result = unserialize($serialize_result);
        }

        return $result;
    }

    public function getIdBySlug($slug)
    {
        $id = $this::findFirst([
            'conditions' => 'slug = :slug:',
            'columns' => 'id',
            'bind' => ['slug' => $slug],
            'bindTypes' => [Column::BIND_PARAM_STR]
        ]);
        return $id->id;
    }


    public function getPriceMin()
    {
        $price_min = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT MIN(price) from ads WHERE housing_complex_id = %d", $this->id));
        return $price_min;
    }

    public function getPriceMax()
    {
        $price_max = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT MAX(price) from ads WHERE housing_complex_id = %d", $this->id));
        return $price_max;
    }

    public function getTotalSquareMin()
    {
        $total_square_min = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT MIN(total_square) from ads WHERE housing_complex_id = %d", $this->id));
        return $total_square_min;
    }

    public function getTotalSquareMax()
    {
        $total_square_max = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT MAX(total_square) from ads WHERE housing_complex_id = %d", $this->id));
        return $total_square_max;
    }


    public function getGeoList()
    {
        $result = $this::find([
            'columns' => 'geo_latitude, geo_longitude, slug, name'
        ]);


        return $result;

    }
}
