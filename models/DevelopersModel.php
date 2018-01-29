<?php

namespace Newfinder\Models;

use Newfinder\Helpers\StrHelper;
use Phalcon\Db\Column;

class DevelopersModel extends BaseAdvertModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $slug;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $address;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=true)
     */
    public $phone;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $created_year;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $icon;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $name_forms;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sob_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $relevance;

    /**
     * Method to set the value of field relevance
     *
     * @param integer $relevance
     *
     * @return $this
     */
    public function setRelevance($relevance)
    {
        $this->relevance = $relevance;

        return $this;
    }

    /**
     * Returns the value of field relevance
     *
     * @return integer
     */
    public function getRelevance()
    {
        return $this->relevance;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("developers");

    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'developers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developers[]|Developers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public function getHousingComplexList()
    {
        $developer_id = $this->id;
	$result = [];
        $housing_complex = HousingComplexModel::find(
            [
                "developer_id = '$developer_id'",
                'limit' => 3
            ]
        );
	$count = HousingComplexModel::count("developer_id = '$developer_id'");
	$count = ($count-3);
	if(count($housing_complex) > 0){
		$result = [
			'list' => $housing_complex,
			'count' => (int)$count,
			'title' => (new StrHelper())->trans($count, ['новостройка', 'новостройки', 'новостроек', 'новостройка'], false)
		];
	}
        return $result;
    }

    public function getDevelopersHousingComplexList($slug, $params) :array
    {
        $developer_id = self::findFirst("slug = '$slug'")->id;
        $conditions = [];
        $binds = [];
        $bindTypes = [];
        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] :
        $this->getDI()->get('config')['application']['developersPageSize'];

        $offset = ($page - 1) * $pageSize;
        $housing_complex = new HousingComplexModel();
        $findParams = [
            'conditions' => 'developer_id = :developer_id:',
            'bind' => ['developer_id' => $developer_id],
            'bindTypes' => Column::BIND_PARAM_INT,
            'limit' => $pageSize,
            'order' => 'relevance DESC',
            'offset' => $offset
        ];

	$findParamsCount = array_diff_key($findParams, ['offset' => 1]);
        $resultSet = $housing_complex::find($findParams);
        $count = $housing_complex::count($findParamsCount);
        $advs = $resultSet->toArray();

        $result = [
            'advs' => $advs,
            'meta' => [
                'total' => (int)$count,
            ],
        ];

        return $result;
    }

    public function getHousingComplexCountList()
    {
        $developer_id = $this->id;

        $rowcount = HousingComplexModel::count("developer_id = $developer_id");
        if ($rowcount > 3) {
            $rowcount = $rowcount - 3;
            return $rowcount." " . (new StrHelper())->trans($rowcount, ['новостройка', 'новостройки', 'новостроек', 'новостройка'], false);
        }
        return $rowcount." ".(new StrHelper())->trans($rowcount, ['новостройка', 'новостройки', 'новостроек', 'новостройка'], false);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Developers|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
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

    public function getObjectUrl()
    {

    }

    public $cache_key_prefix = 'newf:dic:developers:';

    public $cache_lifetime = 60 * 60 * 24 * 7;

    public function get($id): array
    {
        $memcache = $this->getDI()->get('memcache');
        $searchParamsCacheKey = sprintf("%s%d", $this->cache_key_prefix, $id);

        if ($memcache->exists($searchParamsCacheKey) && !isset($_GET['_cc'])) {
            return json_decode($memcache->get($searchParamsCacheKey), true);
        } else {
            $developers = $this->getDI()->get('db')->fetchAll("SELECT * FROM developers WHERE id='$id'");
            $returnDeveloper = [];
            foreach ($developers as $d) {
                $k = sprintf("%s%d", $this->cache_key_prefix, $d['slug']);
                $memcache->save($k, json_encode($d), $this->cache_lifetime);
                $returnDeveloper = $d;
            }


            return $returnDeveloper;
        }
        return [];
    }

    public function getBySlug($slug): array
    {
        $memcache = $this->getDI()->get('memcache');
        $searchParamsCacheKey = sprintf("%s%d", $this->cache_key_prefix, $slug);

        $developers = $this->getDI()->get('db')->fetchAll("SELECT * FROM developers WHERE slug='$slug'");
        $returnDeveloper = [];
        foreach ($developers as $d) {
            $k = sprintf("%s%d", $this->cache_key_prefix, $d['slug']);
            $memcache->save($k, json_encode($d), $this->cache_lifetime);
            $returnDeveloper = $d;
        }
        return $developers;
    }

    public function search(array $params = []): array
    {
        $conditions = [];
        $binds = [];
        $bindTypes = [];;
        if (isset($params['name'])) {
            $conditions[] = 'name LIKE :name:';
            $binds['name'] = '%' . $params['name'] . '%';
            $bindTypes['name'] = Column::BIND_PARAM_STR;
        }

        $page = isset($params['page']) ? $params['page'] : 1;
        $pageSize = isset($params['pageSize']) ? $params['pageSize'] :
            $this->getDI()->get('config')['application']['developersPageSize'];
        $offset = ($page - 1) * $pageSize;

        $findParams = [
            'conditions' => implode(' AND ', $conditions),
            'bind' => $binds,
            'bindTypes' => $bindTypes,
            'limit' => $pageSize,
            'order' => 'relevance DESC',
            'offset' => $offset,
        ];
        $findParamsCount = array_diff_key($findParams, ['offset' => 1]);

        $searchParamsCacheKey = $this->cacheKey($findParams, 'developers');

        $memcache = $this->getDI()->get('memcache');
        if ($memcache->exists($searchParamsCacheKey) && !isset($_GET['_cc'])) {
            $result = json_decode($memcache->get($searchParamsCacheKey), TRUE);
        } else {
            $resultSet = self::find($findParams);
            $count = self::count($findParamsCount);

            $advs = $resultSet->toArray();


            $result = [
                'advs' => $advs,
                'meta' => [
                    'total' => (int)$count,
                ],
            ];
            $memcache->save($searchParamsCacheKey, json_encode($result), 60);
        }

        return $result;
    }

    public function getCountSell()
    {

	$memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.developers.count_sell_".$this->id;
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
            $count_sell = $this->getDI()->get('db')->fetchColumn(sprintf("SELECT COUNT(*) AS count from ads 
                                                                    LEFT JOIN housing_complex 
                                                                    ON ads.housing_complex_id = housing_complex.id 
                                                                    WHERE housing_complex.developer_id = %d ", $this->id));
            $lifetime = $this->getDI()->get('config')['application']['developers_stat_lifetime'];
            $count_sell = $count_sell." " . (new StrHelper())->trans($count_sell, ['квартира', 'квартиры', 'квартир', 'квартира'], false);
            $memcache->save($cacheKey, $count_sell, $lifetime);

        } else {
            $count_sell = $memcache->get($cacheKey);
        }


        return $count_sell;
    }


    public function getReviewCount()
    {

        $memcache = $this->getDI()->get('memcache');
        $cacheKey = "newf.developers.count_review_".$this->id;
        $cachecount = $memcache->get($cacheKey);

        if (!$cachecount) {
            $review_model = new Review();
            $count_review = ($review_model)->getCountReviewDeveloper($this->id);
            $lifetime = $this->getDI()->get('config')['application']['developers_stat_lifetime'];
            $count_review = $count_review." " . (new StrHelper())->trans($count_review, ['отзыв', 'отзыва', 'отзывов', 'отзыв'], false);
            $memcache->save($cacheKey, $count_review, $lifetime);

        } else {
            $count_review = $memcache->get($cacheKey);
        }


        return $count_review;
    }
    public function calcRelevance()
    {
        $bin = [];

        $bin[] = (int)(!empty($this->icon));
        $bin[] = (int)(!empty($this->address));
        $bin[] = (int)(!empty($this->phone));
        $bin[] = (int)(!empty($this->url));

        return bindec(implode('', $bin));
    }

    public function getDevelopersList()
    {

        $developers = $this->getDI()->get('db')->fetchAll("SELECT name AS value, id from developers");

        return json_encode($developers);

    }
}
