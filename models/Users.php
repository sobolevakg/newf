<?php
namespace Newfinder\Models;

use Phalcon\Db\Column;
use Phalcon\Db\Adapter\Pdo\Mysql;
use function var_dump;

class Users extends BaseAdvertModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;
    
    
    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $username;
    
     /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $password;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active;

     /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $role_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $email;

    protected $role_name;

    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSource("users");
	$this->belongsTo(
            'role_id',
            '\Newfinder\Models\Roles',
            'id',
            array('alias' => 'Roles')
        );
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }
    
 
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
    
     /**
     * Method to set the value of field username
     *
     * @param integer $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

     /**
     * Method to set the value of field email
     *
     * @param integer $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

     /**
     * Method to set the value of field email
     *
     * @param integer $email
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

     /**
     * Method to set the value of field email
     *
     * @param integer $email
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

     /**
     * Method to set the value of field email
     *
     * @param integer $email
     * @return $this
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

        return $this;
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

    public function getMetaTitle()
    {
        
    }

    public function getObjectUrl()
    {

    }

    public function search(array $params = []): array
    {
        $conditions = [];
        $binds = [];
        $bindTypes = [];

        if (isset($params['name'])) {
            $conditions[] = 'Users.name LIKE :name:';
            $binds['name'] = '%' . $params['name'] . '%';
            $bindTypes['name'] = Column::BIND_PARAM_STR;
        }

        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSizes = $this->getDI()->get('config')['application']['cabinethousingComplexPageSize'];

        if (isset($params['pageSize'])) {
            $offset = ($page - 1) * $params['pageSize'];
        }

     
            $resultSet = $this::query()
                ->columns([
                    'Newfinder\Models\Users.id', 
                    'Newfinder\Models\Users.username', 
                    'Newfinder\Models\Users.email', 
                    'Newfinder\Models\Roles.name as role_name'
                ])
                ->innerJoin('Newfinder\Models\Roles', 'Newfinder\Models\Roles.id = Newfinder\Models\Users.role_id')
                ->limit($params['pageSize'],$offset) 
                ->execute();  

            $count = self::count();
            $advs = $resultSet->toArray();
            $result = [
                'advs' => $advs,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];
            

        return $result;
    }

    public function get($id)
    {
        $resultSet = $this::query()
                ->columns([
                    'Newfinder\Models\Users.id', 
                    'Newfinder\Models\Users.username', 
                    'Newfinder\Models\Users.email',    
                    'Newfinder\Models\Users.active', 
                    'Newfinder\Models\Roles.name as role_name'
                ])
                ->innerJoin('Newfinder\Models\Roles', 'Newfinder\Models\Roles.id = Newfinder\Models\Users.role_id')
                ->where("Newfinder\Models\Users.id = :id:", ['id' => (int)$id])
                ->execute();  

        if($resultSet){
            $resultSet = $resultSet->toArray();
            
        }
        return $resultSet;
    }
 
}

