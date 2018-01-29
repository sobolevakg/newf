<?php
namespace Newfinder\Models;

use DateTime;
use Newfinder\Helpers\StrHelper;
use Phalcon\Db\Column;
use Phalcon\Db\Adapter\Pdo\Mysql;
use function var_dump;

class Review extends BaseAdvertModel
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
     * @var tinyint
     * @Column(type="tinyint", length=1, nullable=false)
     */
    public $publish;
    
     /**
     *
     * @var datetime
     * @Column(type="datetime", nullable=false)
     */
    public $publication_datetime;

     /**
     *
     * @var varchar
     * @Column(type="varchar", length=255, nullable=false)
     */
    public $name_user;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $user_id;  
  
    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
   
    protected $developer_id;

    protected $developer;

    protected $housing_complex_id;

    protected $housing_complex;

    protected $answer;

    
    /**
     *
     * @var text
     * @Column(type="text", nullable=false)
     */
    public $text;
   
    
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("review");
    }
    
    
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'review';
    }
    
    public function getDateFormat()
    {
       return self::dateFormat($this->publication_datetime);
    }

    public function dateFormat($date)
    {
        $arr = [
          'января',
          'февраля',
          'марта',
          'апреля',
          'мая',
          'июня',
          'июля',
          'августа',
          'сентября',
          'октября',
          'ноября',            
          'декабря',
        ];
        
        $date = new DateTime($date);
        $mont = $date->format('m')-1;
        return $date->format('d ').$arr[$mont].' '.$date->format(' Y');
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
     * Method to set the value of field publish
     *
     * @param boolean $publish
     *
     * @return $this
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }

     /**
     * Method to set the value of field publication_datetime
     *
     * @return $this
     */
    public function setPublicationDatetime()
    {
        $this->publication_datetime = date("Y-m-d H:i:s");

        return $this;
    }

     /**
     * Method to set the value of field name_user
     *
     * @param string $name_user
     *
     * @return $this
     */
    public function setNameUser($name_user)
    {
        $this->name_user = $name_user;

        return $this;
    }

     /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     *
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

     /**
     * Method to set the value of field housing_complex_id
     *
     * @param integer $housing_complex_id
     *
     * @return $this
     */
    public function setHousingComplexId($housing_complex_id)
    {
        $this->housing_complex_id = $housing_complex_id;

        return $this;
    }

     /**
     * Method to set the value of field developers_id
     *
     * @param integer $developers_id
     *
     * @return $this
     */
    public function setDevelopersId($developers_id)
    {
        $this->developers_id = $developers_id;

        return $this;
    }

     /**
     * Method to set the value of field text
     *
     * @param text $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

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

    public function getDeveloper()
    {
        return $this->developer;
    }

    public function getDeveloperId()
    {
        return $this->developers_id;
    }

    public function getHousingComplex()
    {
        return $this->housing_complex;
    }

    public function getHousingComplexId()
    {
        return $this->dhousing_complex_id;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getReviewDeveloperList($id, $params): array
    {
        $conditions = [];
        $binds = [];
        $bindTypes = [];
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : $this->getDI()->get('config')['application']['developersPageSize'];
        $offset = ($page - 1) * $pageSize;

        $findParams = [
            'conditions' => "developers_id = :id: AND publish = 1",
            'bind' => ["id" => $id],
            'bindTypes' => [Column::BIND_PARAM_INT],
            'limit' => $pageSize,
            'offset' => $offset,
        ];
        $findParamsCount = array_diff_key($findParams, ['offset' => 1]);

       
        $resultSet = self::find($findParams);
        $count = self::count($findParamsCount);
        $resultSet = $resultSet->toArray();
        if (count($resultSet) > 0) {          
            $answer_model = new  TreePaths();
                foreach ($resultSet as &$adv) {
                    $adv['answer'] = ($answer_model)->getByReview($adv['id']);
                    
                }
            }

            $result = [
                'advs' => $resultSet,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];

        return $result;

    }
    
    public function getReviewHousingComplexList($id, $params): array
    {
        $conditions = [];
        $binds = [];
        $bindTypes = [];
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] : $this->getDI()->get('config')['application']['housingComplexPageSize'];
        $offset = ($page - 1) * $pageSize;

        $findParams = [
            'conditions' => "housing_complex_id = :id: AND publish = 1",
            'bind' => ["id" => $id],
            'bindTypes' => [Column::BIND_PARAM_INT],
            'limit' => $pageSize,
            'offset' => $offset,
        ];
        $findParamsCount = array_diff_key($findParams, ['offset' => 1]);

       
            $resultSet = self::find($findParams);
            $count = self::count($findParamsCount);

             $resultSet = $resultSet->toArray();
        if (count($resultSet) > 0) {          
            $answer_model = new  TreePaths();
                foreach ($resultSet as &$adv) {
                    $adv['answer'] = ($answer_model)->getByReview($adv['id']);
                    
                }
            }

            $result = [
                'advs' => $resultSet,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];

        return $result;

    }

    public function search(array $params = []): array
    {
        
        $conditions = [];
        $binds = [];
        $bindTypes = [];
       
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSizes = $this->getDI()->get('config')['application']['reviewPageSize'];

        if (isset($params['pageSize'])) {
            $offset = ($page - 1) * $params['pageSize'];
        }

        $findParams = [
            'limit' => $params['pageSize'],
            'offset' => $offset,
        ];

        $findParamsCount = array_diff_key($findParams, array_flip(['offset', 'limit']));

        $cacheKey = $this->cacheKey($findParams, 'review');

        /**
         * @var $memcache Libmemcached
         */
        $memcache = $this->getDI()->get('memcache');
        if ($memcache->exists($cacheKey) && !isset($_GET['_cc'])) {
            $result = json_decode($memcache->get($cacheKey), TRUE);
        } else {
            $resultSet = self::find($findParams);
            $count = self::count($findParamsCount);            
            $resultSet = $resultSet->toArray();
            if (count($resultSet) > 0) {            
                $developers_model = new DevelopersModel();
                $housing_complex_model = new HousingComplexModel();
                foreach ($resultSet as &$adv) {
                    if ($adv['developers_id'] > 0) {
                            $adv['developer'] = ($developers_model)->get($adv['developer_id']);
                    }
                    if ($adv['housing_complex_id'] > 0) {
                            $adv['housing_complex'] = ($housing_complex_model)->get($adv['housing_complex_id']);
                    }
                }
            }
            
            $result = [
                'advs' => $resultSet,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];
            $memcache->save($cacheKey, json_encode($result), 60);
        }

        return $result;
    }


    public function get($id): array
    {
        $conditions = 'id = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];

        $resultSet = self::find($findParams);

        $advs = $resultSet->toArray();
        if (count($advs) > 0) {
            $developers_model = new DevelopersModel();
            $housing_complex_model = new HousingComplexModel();
            foreach ($advs as &$adv) {
                if ($adv['developers_id'] > 0) {
                    $adv['developer'] = ($developers_model)->get($adv['developers_id']);
                }
                if ($adv['housing_complex_id'] > 0) {
                     $adv['housing_complex'] = ($housing_complex_model)->get($adv['housing_complex_id']);
                }
                
            }
        }


        return $advs;
    }


    public function getByAncestor($id): array
    {
        $conditions = 'id = :id:';
        $binds['id'] = $id;
        $bindTypes['id'] = Column::BIND_PARAM_INT;


        $findParams = [
            'conditions' => $conditions,
            'bind' => $binds,
            'bindTypes' => $bindTypes
        ];

        $resultSet = self::find($findParams);
        $resultSet = $resultSet->toArray();
        $result = [];
        foreach ($resultSet as &$adv) {
            $adv["publication_datetime"] = self::getDateFormat();
            $result = $adv;
        }

        return $result;
    }

    public function getCountReviewDeveloper($id)
    {
        return self::count("developers_id = $id AND publish = 1");
    }
}

