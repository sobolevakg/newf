<?php
namespace Newfinder\Models;

use Phalcon\Db\Column;
use Phalcon\Db\Adapter\Pdo\Mysql;
use function var_dump;

class Session extends BaseAdvertModel
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
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $user_id;
    
     /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $session_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("session");
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'session';
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
     * Method to set the value of field session_id
     *
     * @param integer $session_id
     *
     * @return $this
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;

        return $this;
    }

     /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

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

}

