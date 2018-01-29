<?php

namespace Newfinder\Models;

class GeoPlace extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $country_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $okrug_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $aorder;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=true)
     */
    protected $region_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $slug;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    protected $old_slug;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $not_unique;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_active;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $del_date;

    /**
     *
     * @var string
     * @Column(type="string", length=13, nullable=true)
     */
    protected $kladr_code;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field country_id
     *
     * @param integer $country_id
     * @return $this
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * Method to set the value of field okrug_id
     *
     * @param integer $okrug_id
     * @return $this
     */
    public function setOkrugId($okrug_id)
    {
        $this->okrug_id = $okrug_id;

        return $this;
    }

    /**
     * Method to set the value of field aorder
     *
     * @param integer $aorder
     * @return $this
     */
    public function setAorder($aorder)
    {
        $this->aorder = $aorder;

        return $this;
    }

    /**
     * Method to set the value of field region_id
     *
     * @param integer $region_id
     * @return $this
     */
    public function setRegionId($region_id)
    {
        $this->region_id = $region_id;

        return $this;
    }

    /**
     * Method to set the value of field area_id
     *
     * @param integer $area_id
     * @return $this
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Method to set the value of field old_slug
     *
     * @param string $old_slug
     * @return $this
     */
    public function setOldSlug($old_slug)
    {
        $this->old_slug = $old_slug;

        return $this;
    }

    /**
     * Method to set the value of field not_unique
     *
     * @param integer $not_unique
     * @return $this
     */
    public function setNotUnique($not_unique)
    {
        $this->not_unique = $not_unique;

        return $this;
    }

    /**
     * Method to set the value of field is_active
     *
     * @param integer $is_active
     * @return $this
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Method to set the value of field del_date
     *
     * @param string $del_date
     * @return $this
     */
    public function setDelDate($del_date)
    {
        $this->del_date = $del_date;

        return $this;
    }

    /**
     * Method to set the value of field kladr_code
     *
     * @param string $kladr_code
     * @return $this
     */
    public function setKladrCode($kladr_code)
    {
        $this->kladr_code = $kladr_code;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field country_id
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Returns the value of field okrug_id
     *
     * @return integer
     */
    public function getOkrugId()
    {
        return $this->okrug_id;
    }

    /**
     * Returns the value of field aorder
     *
     * @return integer
     */
    public function getAorder()
    {
        return $this->aorder;
    }

    /**
     * Returns the value of field region_id
     *
     * @return integer
     */
    public function getRegionId()
    {
        return $this->region_id;
    }

    /**
     * Returns the value of field area_id
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the value of field old_slug
     *
     * @return string
     */
    public function getOldSlug()
    {
        return $this->old_slug;
    }

    /**
     * Returns the value of field not_unique
     *
     * @return integer
     */
    public function getNotUnique()
    {
        return $this->not_unique;
    }

    /**
     * Returns the value of field is_active
     *
     * @return integer
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Returns the value of field del_date
     *
     * @return string
     */
    public function getDelDate()
    {
        return $this->del_date;
    }

    /**
     * Returns the value of field kladr_code
     *
     * @return string
     */
    public function getKladrCode()
    {
        return $this->kladr_code;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource("geo_place");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'geo_place';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GeoPlace[]|GeoPlace|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GeoPlace|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
