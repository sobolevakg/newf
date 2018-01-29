<?php

namespace Newfinder\Modules\Frontend\Controllers;

use Newfinder\Library\DataProvider\DevelopersDataProvider;
use Phalcon\Mvc\View;


use Newfinder\Library\UrlManager;
use function array_filter;

class DevelopersController extends BaseController
{
    public function onConstruct() {
        parent::onConstruct();
        $js = $this->assets->collection('js');
        $js->addJs('js/lib/fotorama.js');
        $this->view->showHeaderTitle = false;
    }

    public function notfound()
    {
           $this->dispatcher->forward(array(
               'controller' => 'error', 'action' =>   'show404')
           );
    }

    public function listAction()
    {

        $urlManager = new UrlManager();
        list($params, $isRedirect) = $urlManager->getSearchParams($this->request->getQuery('_url'), $this->request->getQuery());

        if ($isRedirect) {
            $redirect = $urlManager->buildUrl($params);
            return $this->response->redirect($redirect, false, 301);
        }
        $getPageSizeSelectData = $this->getPageSizeSelectData();

        $pageSize = array_values(array_filter($getPageSizeSelectData, function ($it) {
            return isset($it['default']) && !!$it['default'];
        }))[0]['size'];
        $searchParams = array_merge($params, [
            'page' => isset($_GET['page']) ? $_GET['page'] : 1,
            'pageSize' => $pageSize,
        ]);

        $dataProvider = new DevelopersDataProvider();
        $advertCollection = NULL;
        $collection = $dataProvider->getList($searchParams, FALSE);
        $this->view->setVars(
            [
                'pageSize' => $searchParams['pageSize'],
                'advCollection' => $collection
            ]
        );
       
    }


    public function showAction($slug)
    {
        $searchParams = [
            'pageSize' => 3
        ];
        $dataProvider = new DevelopersDataProvider();
        $advertCollection = NULL;
        $object = $dataProvider->get($slug, FALSE);
        if (count($object->getObjects()) > 0) {
	        $collection = $dataProvider->getReviewList($object->getObjects()[0]->getId(), $searchParams);
	        $housing_complex_list = $dataProvider->getHousingComplexList($slug, $searchParams);
	        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->setVars(
                [
                    'object' => $object,
                    'advCollection' => $collection,
		            'housing_complex_list' => $housing_complex_list
                ]
            );
        }else{
            self::notfound();
        }
       
    }

    public function listhousingcomplexAction($slug)
    {
        $searchParams = [
            'pageSize' => 10,
	        'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $dataProvider = new DevelopersDataProvider();
        $advertCollection = NULL; 
        $object = $dataProvider->get($slug, FALSE);
        if (count($object->getObjects()) > 0) {
            $collection = $dataProvider->getHousingComplexList($slug, $searchParams);
	        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->setVars(
                [
                    'advCollection' => $collection,
                    'pageSize' => $searchParams['pageSize']
                ]
            );
        }else{
            self::notfound();
        }
       
    }

    public function listreviewAction($slug)
    {
        $searchParams = [
            'pageSize' => 10,
	        'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $dataProvider = new DevelopersDataProvider();
        $advertCollection = NULL;
        $object = $dataProvider->get($slug, FALSE);
        if (count($object->getObjects()) > 0) {
            $collection = $dataProvider->getReviewList($object->getObjects()[0]->getId(), $searchParams);
	        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->setVars(
                [   
                    'object' => $object,
                    'advCollection' => $collection,
                    'pageSize' => $searchParams['pageSize']
                ]
            );
        }else{
            self::notfound();
        }
       
    }

    public function listapartAction($slug)
    {
        $searchParams = [
            'pageSize' => 10,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $dataProvider = new DevelopersDataProvider();
        $advertCollection = NULL;
        $object = $dataProvider->get($slug, FALSE);
        if (count($object->getObjects()) > 0) {
            $collection = $dataProvider->getApartList($object->getObjects()[0]->getId(), $searchParams);
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->setVars(
                [   
                    'object' => $object,
                    'advCollection' => $collection,
                    'pageSize' => $searchParams['pageSize']
                ]
            );
        }else{
            self::notfound();
        }
    }
  
}
