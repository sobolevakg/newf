<?php
namespace Newfinder\Models;

use Phalcon\Db\Column;
use Phalcon\Db\Adapter\Pdo\Mysql;
use function var_dump;

class TreePaths extends BaseAdvertModel
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
    public $ancestor;
    
     /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $descendant;

    protected $answer_info;

    public function getAnswerInfo()
    {
        return $this->answer_info;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("TreePaths");
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'TreePaths';
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
     * Method to set the value of field descendant
     *
     * @param integer $descendant
     *
     * @return $this
     */
    public function setDescendant($descendant)
    {
        $this->descendant = $descendant;

        return $this;
    }

     /**
     * Method to set the value of field ancestor
     *
     * @param integer $ancestor
     * @return $this
     */
    public function setAncestor($ancestor)
    {
        $this->ancestor = $ancestor;

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

    public function getByReview($id): array
    {
        $conditions = 'descendant = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];

        $resultSet = self::find($findParams);
        $result = [];
        $advs = $resultSet->toArray();
        if (count($advs) > 0) {
            $review_model = new Review();
            foreach ($advs as &$adv) {
                if ($adv['descendant'] > 0) {
                    $adv['answer_info'] = ($review_model)->getByAncestor($adv['ancestor']);
                }
                $result = $adv;

            }
        }

        return $result;
    }

 
}

