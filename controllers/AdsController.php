<?php

namespace Newfinder\Modules\Frontend\Controllers;


use Phalcon\Mvc\View;
use Newfinder\Models\Ads;

use function array_filter;

class AdsController extends BaseController
{
    public function onConstruct()
    {
        parent::onConstruct();
        $js = $this->assets->collection('js');
        $js->addJs('js/lib/fotorama.js');
        $this->view->showHeaderTitle = false;
    }

    public function infrastructureAction()
    {
       	$this->view->disable();
        $ads = new Ads();
        if ($this->request->isAjax()) {
		$result['data'] = $ads->getInfrastructure($this->request->getPost('geo'));
		echo json_encode($result);
	}
    }

}
