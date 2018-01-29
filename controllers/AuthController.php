<?php

namespace Newfinder\Modules\Frontend\Controllers;

use Phalcon\Mvc\View;
use Newfinder\Models\AuthModel;
use Phalcon\Http\Response;
use Phalcon\Mvc\Micro\MiddlewareInterface\CorsMiddleware;

class AuthController extends BaseController
{
    public function onConstruct() {
        parent::onConstruct();
    }


    public function signInAction()
    {
       if ($this->request->isAjax()) {
		$model = new AuthModel();
		$result = $model->getAuth();
		return json_encode($result);
	}
	$this->view->setRenderLevel(View::LEVEL_NO_RENDER);
	
    }

    public function rememberPasswordAction()
    {
       if ($this->request->isAjax()) {
		$model = new AuthModel();
		$result = $model->getRememberPassword();
		return json_encode($result);
	}
	$this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }

    public function signUpAction()
    {
       if ($this->request->isAjax()) {
		$model = new AuthModel();
		$result = $model->setSignUp();
		return json_encode($result);
	}
	$this->view->setRenderLevel(View::LEVEL_NO_RENDER);
    }
}
