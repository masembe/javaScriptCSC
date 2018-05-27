<?php
require_once('Models/Data.php');
class AdvertData extends Data {

    protected $_id, $_title, $_price, $_description, $_image,$_ad_status,$_ad_type,$_expiry_date;

    public function __construct($dbRow) {

	parent::__construct($dbRow['email']);
        $this->_id = $dbRow['ad_id'];
        $this->_title = $dbRow['ad_title'];
        $this->_price = $dbRow['price'];
        $this->_description = $dbRow['ad_description'];
        $this->_image = $dbRow['ad_photo']; 
        if($dbRow['ad_status']==='T')
            $this->_ad_status="Negotiable";
        else
            $this->_ad_status="Non-negotiable";

        $this->_ad_type = $dbRow['ad_type'];
        $this->_expiry_date = $dbRow['expiry_date'];
    }


    public function getExpiryDate()
    {
        return $this->_expiry_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }


    /**
     * @return mixed
     */
    public function getAdStatus()
    {
        return $this->_ad_status;
    }


    /**
     * @return mixed
     */
    public function getAdType()
    {
        return $this->_ad_type;
    }


}


