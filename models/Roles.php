<?php
namespace Newfinder\Models;

use Phalcon\Db\Column;
use Phalcon\Db\Adapter\Pdo\Mysql;
use function var_dump;

class Roles extends BaseAdvertModel
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
    public $name;
    
     /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    public $liberties;


    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSource("users_roles");
	$this->hasMany(
            'id',
            '\Newfinder\Models\Users',
            'role_id'
        );
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users_roles';
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

     /**
     * Method to set the value of field liberties
     *
     * @param string $liberties
     * @return $this
     */
    public function setLiberties($liberties)
    {
        $this->liberties = $liberties;

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

    public function getAll()
    {
        $result = $this::query()
                ->columns([
                    'name as value', 
                    'id'
                ])
                ->execute();  
        if (count($result) > 0){
            $result = $result->toArray();
        }

        return json_encode($result);
    }

 
}

