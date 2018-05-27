<?php

require_once('Models/Data.php');
class AccountData extends Data {

    protected $_name,$_password,$_admin, $_phone_number, $_address;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow['email']);
        $this->_name = $dbRow['name'];
        $this->_password = $dbRow['password'];
        $this->_phone_number=$dbRow['phone_number'];
        $this->_address = $dbRow['address'];
        $this->_admin=$dbRow['admin'];

    }

    /**
     * @return mixed respective values of the fields listed above.
     * In other words returns the getters for the said fields.
     *
     */
    

    public function getPassword() {
        return $this->_password;
    }

    public function getName() {
        return $this->_name;
    }

    public function getAdminStatus() {
        return $this->_admin;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function getPhoneNumber(){
        return $this->_phone_number;
    }



}

