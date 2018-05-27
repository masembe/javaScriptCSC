<?php

require_once ('Database.php');
require_once ('AccountData.php');


class AccountDataSet {
    protected $_dbHandle, $_dbInstance;


    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }


    // The login function where the password is rehashed and verified.
    public function loginAuthorized($email,$password){
        $sqlQuery="SELECT * FROM Accounts WHERE email='$email';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $row=$statement->fetch();
        $accountData=new AccountData($row);
        $isUser=password_verify($password,$accountData->getPassword());
        return $isUser;
    }

    // gives the object AccountData of the given e-mail
    public function userAccount($email){
        $sqlQuery="SELECT * FROM Accounts WHERE email='$email';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $row=$statement->fetch();
        $accountData=new AccountData($row);
        return $accountData;
    }

    // changes the password of the account assigned to the given email
    public function updateUserPassword($email,$newpassword){
        $password=password_hash($newpassword, PASSWORD_DEFAULT);
        $sqlQuery="UPDATE Accounts SET password = '$password' WHERE email='$email';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $this->loginAuthorized($email, $newpassword);
    }

    // changes the username of the account assigned to the given email
    public function updateUserName($email, $newName){
        $sqlQuery="UPDATE Accounts SET name = '$newName' WHERE email='$email';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }

    // Update information into the database. At the end, the account of the new contributor is finally set
     public function registration($email,$name,$password,$phone_number,$address){
        $encryptedPassword=password_hash($password, PASSWORD_DEFAULT);
        $sqlQuery="INSERT INTO Accounts (email, name, password, phone_number,address,admin) VALUES ('$email', '$name', '$encryptedPassword', '$phone_number','$address','F');";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
     }


     // Delete the account associated to the given e-mail
     public function deleteUser($email){
         $sqlQuery="DELETE FROM Accounts WHERE email='$email';";
         $statement=$this->_dbHandle->prepare($sqlQuery);
         $statement->execute();
     }

    // returns whether the $email is in the database or not
    public function isEmailInDatabase($email){
        $sqlQuery="SELECT * FROM Accounts WHERE email='$email';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $row=$statement->fetch();
        if($row===false) {
            return false;
        }
        return true;
    }



}
