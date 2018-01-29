<?php

namespace Newfinder\Modules\Cabinet\Controllers;

use Newfinder\Models\Users;
use Newfinder\Models\Session;

class SessionController extends ControllerBase
{

    public function onConstruct() {
        parent::onConstruct();
    }

    private function _registerSession(Users $user)
    {
        
	    $session = $this->di->get('session');

         if($user->roles->liberties == "Admin"){
            $sesion_model = new Session();
            $sesion_model->setSessionId($session->getId()); 
            $sesion_model->setUserId($user->id); 
            if (!$sesion_model->create()) {
                return false;
            }
        }

            $session->set("auth", [
		    "id" => $user->id,
		    "name" => $user->username,
		    "role" => $user->roles->liberties
	    ]);

    }

    public function redirectErrors()
    {
        $this->dispatcher->forward([
               			'controller' => 'errors', 
                        'action' =>   'show401'
                        ]);
    }

    public function startAction()
    {
	    if(!$this->session->has("auth")){
		    if ($this->request->isPost()) {
		        $email = $this->request->getPost('email');
		        $password = $this->request->getPost('password');
		        $user = Users::findFirst([
		            "(email = :email: OR username = :email:) AND active = 'Y'",
		            'bind' => ['email' => $email]
		        ]);
		        if ($user != false) {
			        if ($this->security->checkHash($password, $user->password)) {
		                	$this->_registerSession($user);
		                	return $this->response->redirect('cabinet');
			        }
		        }else{
		     	    $this->security->hash(rand());
		        }
		    }
            $this->redirectErrors();
	    }else{
            	return $this->response->redirect('cabinet/housing_complex');
	    }
    }

    public function endAction()
    {
        $user = $this->session->get('auth');
        if($user["role"] == "Admin"){
            $session_data = Session::findFirst('user_id=' . (int)$user['id']);
             if($session_data){
                if (!$session_data->delete()) {
                        die(var_dump($session_data->getMessages()));
                    }
             }
        }
        $this->session->remove('auth');
        return $this->response->redirect('/cabinet');
    }
}
