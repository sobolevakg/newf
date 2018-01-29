<?php

namespace Newfinder\Modules\Cabinet\Controllers;

use Newfinder\Library\DataProvider\HousingComplexDataProvider;
use Newfinder\Models\HousingComplexModel;
use Newfinder\Models\DevelopersModel;
use Phalcon\Mvc\View;

class HousingComplexController extends ControllerBase
{
    public function indexAction()
    {
        if (!empty($_GET['table'])) {
            $search_geo = [
                "table" => $_GET['table'],
                "value" => $_GET['value'],
                "where" => $_GET['where']
            ];
            $model = new HousingComplexModel();
            $result = $model->getGeoSearch($search_geo);
            $this->view->setRenderLevel(
                View::LEVEL_NO_RENDER
            );
            return $result;
        }
        $searchParams = [
            'pageSize' => $this->getDI()->get('config')['application']['cabinethousingComplexPageSize'],
            'page' => isset($_GET['page']) ? $_GET['page'] : 1,

        ];


        $dataProvider = new HousingComplexDataProvider();
        $collection = $dataProvider->getList($searchParams, FALSE);
        $this->view->setVars(
            [
                'pageSize' => $searchParams['pageSize'],
                'advCollection' => $collection,
            ]
        );
    }

    public function editAction($slug)
    {
        $dataProvider = new HousingComplexDataProvider();
        $model = new HousingComplexModel();
	$developers = new DevelopersModel();
        $regions = $model->getGeoRegion();
        $metro = $model->getGeoMetro();
        $road = $model->getGeoRoad();
	$developers_list = $developers->getDevelopersList();
        $collection = $dataProvider->getBySlug($slug, FALSE);
        $this->session->set("prevPg", $_SERVER['HTTP_REFERER']);
        $this->view->setVars(
            [
                'slug' => $slug,
                'object' => $collection,
                'region' => $regions,
                'metro' => $metro,
                'road' => $road,
		'developers' => $developers,
		'developers_list' => $developers_list
            ]
        );
    }

    public function updateAction($id)
    {
        $model = new HousingComplexModel();
        $cabinet = HousingComplexModel::findFirst('id=' . (int)$id);
        $this->view->disable();
        if ($this->request->isPost()) {
            $cabinet->setGeoRegionName($this->request->getPost('geo_region_name'));
            $cabinet->setGeoRegionSlug($this->request->getPost('geo_region_slug'));
            $cabinet->setGeoRegionId((empty($this->request->getPost('geo_region_id')) ? null : $this->request->getPost('geo_region_id')));
            $cabinet->setGeoAreaName($this->request->getPost('geo_area_name'));
            $cabinet->setGeoAreaSlug($this->request->getPost('geo_area_slug'));
            $cabinet->setGeoAreaId((empty($this->request->getPost('geo_area_id')) ? null : $this->request->getPost('geo_area_id')));
            $cabinet->setGeoPlaceName($this->request->getPost('geo_place_name'));
            $cabinet->setGeoPlaceSlug($this->request->getPost('geo_place_slug'));
            $cabinet->setGeoPlaceId((empty($this->request->getPost('geo_place_id')) ? null : $this->request->getPost('geo_place_id')));
            $cabinet->setGeoDistrictName($this->request->getPost('geo_district_name'));
            $cabinet->setGeoDistrictSlug($this->request->getPost('geo_district_slug'));
            $cabinet->setGeoDistrictId((empty($this->request->getPost('geo_district_id')) ? null : $this->request->getPost('geo_district_id')));
            $cabinet->setGeoHighwayName($this->request->getPost('geo_highway_name'));
            $cabinet->setGeoHighwaySlug($this->request->getPost('geo_highway_slug'));
            $cabinet->setGeoHighwayId((empty($this->request->getPost('geo_highway_id')) ? null : $this->request->getPost('geo_highway_id')));
            $cabinet->setGeoStreetName($this->request->getPost('geo_street_name'));
            $cabinet->setGeoStreetSlug($this->request->getPost('geo_street_slug'));
            $cabinet->setGeoStreetId((empty($this->request->getPost('geo_street_id')) ? null : $this->request->getPost('geo_street_id')));
            $cabinet->setGeoSubwayStationId((empty($this->request->getPost('geo_subway_station_id')) ? null : $this->request->getPost('geo_subway_station_id')));
            $cabinet->setGeoSubwayStationName($this->request->getPost('geo_subway_station_name'));
            $cabinet->setGeoSubwayStationSlug($this->request->getPost('geo_subway_station_slug'));
            $cabinet->setGeoSublocalityName($this->request->getPost('geo_sublocality_name'));
            $cabinet->setGeoSublocalitySlug($this->request->getPost('geo_sublocality_slug'));
            $cabinet->setGeoSublocalityId((empty($this->request->getPost('geo_sublocality_id')) ? null : $this->request->getPost('geo_sublocality_id')));
            $cabinet->setGeoMkadRemoteness((empty($this->request->getPost('geo_mkad_remoteness')) ? null : $this->request->getPost('geo_mkad_remoteness')));
            $cabinet->setGeoSubwayWalkAccess((empty($this->request->getPost('geo_subway_station_walk_access')) ? null : $this->request->getPost('geo_subway_station_walk_access')));
            $cabinet->setGeoSubwayTransportAccess((empty($this->request->getPost('geo_subway_station_transport_access')) ? null : $this->request->getPost('geo_subway_station_transport_access')));
            $cabinet->setGeoBuildingName($this->request->getPost('geo_building_name'));
            $cabinet->setGeoLatitude($this->request->getPost('geo_latitude'));
            $cabinet->setGeoLongitude($this->request->getPost('geo_longitude'));
            $cabinet->setPriceFrom((empty($this->request->getPost('price_from')) ? 0 : $this->request->getPost('price_from')));
            $cabinet->setPriceTo((empty($this->request->getPost('price_to')) ? 0 : $this->request->getPost('price_to')));
            $cabinet->setTotalSquareFrom($this->request->getPost('total_square_from'));
            $cabinet->setTotalSquareTo($this->request->getPost('total_square_to'));
            $cabinet->setDeveloperId((empty($this->request->getPost('developer_id')) ? null : $this->request->getPost('developer_id')));
            $cabinet->setNote($this->request->getPost('note'));
            $cabinet->setIsCustomEdit(1);
            if (!$cabinet->update()) {
                echo "К сожалению, возникли следующие проблемы: ";
                var_dump($model);
                foreach ($model->getMessages() as $message) {
                    echo $message->getMessage(), "<br/>";
                }
            } else {
                if ($this->session->has("prevPg")) {
                    return $this->response->redirect($this->session->get("prevPg"), TRUE);
                } else {
                    return $this->response->redirect('cabinet/housing_complex');
                }
            }

        }

    }

}
