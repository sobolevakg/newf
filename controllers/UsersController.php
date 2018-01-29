<?php
namespace Newfinder\Modules\Cabinet\Controllers;
use Newfinder\Library\DataProvider\UsersDataProvider;
use Newfinder\Models\Users;
use Newfinder\Models\Roles;
use Newfinder\Models\Session;
use Phalcon\Mvc\View;
use Phalcon\Db\Column;
class UsersController extends ControllerBase
{
    public function onConstruct() {
        parent::onConstruct();
    }
    public function indexAction()
    {
        $searchParams = [
            'pageSize' => $this->getDI()->get('config')['application']['cabinethousingComplexPageSize'],
            'page' => isset($_GET['page']) ? $_GET['page'] : 1,
        ];
        $dataProvider = new UsersDataProvider();
        $collection = $dataProvider->getList($searchParams, FALSE);
        $this->view->setVars(
            [
                'pageSize' => $searchParams['pageSize'],
                'advCollection' => $collection,
            ]
        );
    }
    public function editAction($id)
    {
        $dataProvider = new UsersDataProvider();
        $collection = $dataProvider->get($id);
	    $roles_model = new Roles();
	    $roles = $roles_model->getAll();
        $this->session->set("prevPg", $_SERVER['HTTP_REFERER']);
        $this->view->setVars(
            [
                'object' => $collection,
		        'roles' => $roles
            ]
        );
    }
    public function newAction()
    {
        $roles_model = new Roles();
	    $roles = $roles_model->getAll();
        $this->view->setVars(
            [
		        'roles' => $roles
            ]
        );
    }
    public function updateAction($id)
    {
        $model = new Users();
	    $users = Users::findFirst('id=' . (int)$id);
        $role_id_old = $users->role_id;
        $this->view->disable();
        if ($this->request->isPost()) {           
            $role = Roles::findFirst([
                'conditions' => 'name = :name:',
                'columns' => 'id',
                'bind' => ['name' => $this->request->getPost('role')],
                'bindTypes' => [Column::BIND_PARAM_STR]
            ])->id;
            $users->setRoleId($role);
            $users->setUserName($this->request->getPost('username'));
            $users->setEmail($this->request->getPost('email'));
            $users->setActive($this->request->getPost('active')); 
            if(!empty($this->request->getPost('password'))){
                $users->setPassword($this->security->hash($this->request->getPost('password')));
            }
            if($role < $role_id_old){
                   $session_data = Session::findFirst('user_id=' . (int)$id);
                   if($session_data){
                        $session = $this->di->get('session');
                        $session->setId($session_data->session_id);
                        $session->destroy();
                        if (!$session_data->delete()) {
                            die(var_dump($session_data->getMessages()));
                        }
                   }
                }        
            if (!$users->update()) {
                echo "К сожалению, возникли следующие проблемы: ";
                var_dump($model);
                foreach ($model->getMessages() as $message) {
                    echo $message->getMessage(), "<br/>";
                }
            } else {                  
                if ($this->session->has("prevPg")) {
                    return $this->response->redirect($this->session->get("prevPg"), TRUE);
                } else {
                    return $this->response->redirect('cabinet/users');
                }
            }
        }
    }
    public function saveAction()
    {
        $this->view->disable();
        $users = new Users();
        if ($this->request->isPost()) {           
            $role = Roles::findFirst([
                'conditions' => 'name = :name:',
                'columns' => 'id',
                'bind' => ['name' => $this->request->getPost('role')],
                'bindTypes' => [Column::BIND_PARAM_STR]
            ])->id;
            $users->setUserName($this->request->getPost('username'));
            $users->setEmail($this->request->getPost('email'));
            $users->setActive($this->request->getPost('active'));
            $users->setPassword($this->security->hash($this->request->getPost('password')));
            $users->setRoleId($role);
            if (!$users->create()) {
                echo "К сожалению, возникли следующие проблемы: ";
                foreach ($users->getMessages() as $message) {
                    echo $message->getMessage(), "<br/>";
                }
            }else{
		        if ($this->session->has("prevPg")) {
                    return $this->response->redirect($this->session->get("prevPg"), TRUE);
                } else {
                    return $this->response->redirect('cabinet/users');
                }
	        }
        }
    }
}
