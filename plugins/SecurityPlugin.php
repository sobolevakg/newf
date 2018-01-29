<?php
namespace Newfinder\Library;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Di;

class SecurityPlugin extends Plugin
{

	public function getAcl()
	{
		if (!isset($this->persistent->acl)) {
			$acl = new AclList();
			$acl->setDefaultAction(Acl::DENY);

			$roles = [
				"users"  => new Role(
					"Users"
				),
				"guests" => new Role(
					"Guests"
				),
				"admin" => new Role(
					"Admin"
				)
			];
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			$privateResources = [
				"review"    => ["edit", "update", "index"],
				"housing_complex" => ["index", "update", "edit"],
				"session" => ["end"],
				"users" => ["index", "edit", "update", "new", "save"]
			];
			foreach ($privateResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			
			$publicResources = [
				"developers"    => ["list", "show", "listhousingcomplex", "listreview"],
				"housing_complex" => ["list", "show", "housingComplexGeoList", "listreview", "secondaryBuildingsList"],
				"auth"   => ["signIn", "rememberPassword", "signUp"],
				"errors"     => ["show401", "show404"],
				"page"    => ["contactsShow"],
				"review" => ["save"],
				"index" => ["index"],
				"session" => ["start"]
			];

			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Resource($resource), $actions);
			}
			
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}
			
			foreach ($privateResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Admin', $resource, $action);
				}
			}
			
			$this->persistent->acl = $acl;
		}
		return $this->persistent->acl;
	}
	
	public function getAclSession(Dispatcher $dispatcher)
	{
		$auth = $this->session->get("auth");
		if (!$auth){
			$role = "Guests";
		} else {
			$role = $auth["role"];
		}
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		$acl = $this->getAcl();

		if (!$acl->isResource($controller)) {
			$dispatcher->forward([
				"controller" => "errors",
				"action"     => "show404"
			]);
			return false;
		}

		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
                        $this->session->remove("auth");
			$dispatcher->forward([
				"controller" => "errors",
				"action"     => "show401"
			]);
			return false;
		}
	}

}
