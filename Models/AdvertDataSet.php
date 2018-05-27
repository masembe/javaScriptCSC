<?php

require_once ('Database.php');
require_once('AdvertData.php');

class AdvertDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllAdverts() {
        $sqlQuery = 'SELECT * FROM ad';
        if(isset($_GET['sort']) ) {
            if ($_GET['sort'] == "priceDesc") {
                $sqlQuery .= " ORDER BY price DESC"; //this filters the ads by price descending
            }
            elseif ($_GET['sort'] == "priceAsc") {
                $sqlQuery .= " ORDER BY price ASC"; //this filters ads by price in ascending order
            } elseif ($_GET['sort'] == "name(A-Z)") {
                $sqlQuery .= " ORDER BY ad_title ASC"; //this filters the ads by titles ascending
            } elseif ($_GET['sort'] == "name(Z-A)") {
                $sqlQuery .= " ORDER BY ad_title DESC"; //this filters ads by title in descending order
            } elseif ($_GET['sort'] == "negotiable") {
                $sqlQuery .= "  WHERE ad_status = 'T'";//This filters all the negotiable products
            } elseif ($_GET['sort'] == "nonnegotiable") {
                $sqlQuery .= " WHERE ad_status = 'F'";//This filters all the non-negotiable products
            }
        }
        else {

            $sqlQuery = 'SELECT * FROM ad';
        }
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AdvertData($row);
        }
        return $dataSet;
    }

    public function addAdvert($title,$type,$description,$status,$photo,$price,$email,$expiry_date)
    {

            $query = "INSERT INTO ad (ad_title, ad_type,price , ad_status, ad_photo, ad_description,email,expiry_date) VALUES ('$title' , '$type','$price' ,'$status', '$photo', '$description', '$email','$expiry_date')";
            $statement = $this->_dbHandle->prepare($query);

           // echo $query;

            $statement->execute();
           // var_dump($statement);

            $this->_dbHandle = null;

    }


    public function watchlist($id, $email) {
        $sqlQuery = "INSERT INTO Watchlist (ad_id, email) VALUES('$id','$email')";

        echo $sqlQuery;  //helpful for debugging to see what SQL query has been created
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement
    }

    public function fetchWatchlist($email) {
        $sqlQuery = 'SELECT * FROM ad WHERE ad_id IN(SELECT ad_id FROM Watchlist WHERE email="'. $email. '")';  //Using an inner join and foreign key from the watchlist and ad table it shows the details of the ad.

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new advertData($row);
        }


        return $dataSet;  // return an array of Watchlist objects
    }

//Deletes items from watchlist by referring to the watchlist id as the primary key
    public function deleteFromWatchlist($delete_id){
    $sqlQuery = "DELETE FROM Watchlist WHERE ad_id='".$delete_id."'";
    $statement = $this->_dbHandle->prepare($sqlQuery);
    $statement->execute(); // execute the PDO statement
}

//Deletes ads from the database on button click
    public function deleteAd($adId){
        $sqlQuery="DELETE FROM ad WHERE ad_id ='$adId';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }

//Deletes ads when the expiry date comes after the current date
    public function deleteExpiredAd($current_date){
        $sqlQuery="DELETE FROM ad WHERE expiry_date <'$current_date';";
        $statement=$this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
    }

    // returns all the ads that contains $title in their title,type or description
    public function fetchAdsBySearch($title){
        $sqlQuery="SELECT * FROM ad WHERE ad_title LIKE '%$title%' OR ad_type LIKE '%$title%' OR ad_description LIKE '%$title%' ;";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AdvertData($row);
        }
        return $dataSet;
    }
    
    // returns a specific ad by its id
    public function fetchAdsById($adId){
        $sqlQuery="SELECT * FROM ad WHERE ad_id ='$adId';";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AdvertData($row);
        }
        return $dataSet;
    }

    public function suggestions($searchTerm)
    {
        $query = "SELECT ad_title FROM ad WHERE ad_title LIKE'%$searchTerm%'";
        try {
            $statement = $this->_dbHandle->prepare($query);
            $statement->execute();
            $loop = 0;


            //This while loop keeps storing fetched data while there is more to retrieve
            while ($data = $statement->fetch()) {
                $name[$loop] = $this->extractvalues($data);
                $loop = $loop + 1;
                //Go through the matching details, loading them into objects
            }


        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $dbHandle = null;
        return $name;
    }

//This function is for the extraction of all advert data from the array details. The values are stored in a search function class object which is then returned.
    public function extractvalues($data)
    {
        $adnames = $data[0];
        return $adnames;
    }

    public function fetchHint($suggestion)
    {
        $sqlQuery = " SELECT * FROM ad WHERE ad_title LIKE '%$suggestion%'";

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare PDO statement
        $statement->execute(); // execute the PDO statement



        $dataSet = [];

        while ($row = $statement->fetch()) {
            array_push($dataSet, $row);
        }


        return $dataSet;  // return an array of WISHLIST objects
    }

}


