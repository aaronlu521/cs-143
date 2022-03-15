<?php
error_reporting(E_ALL);

// display error messages in the output page
ini_set("display_errors", "1");

// log error messages in /tmp/php-error.log
ini_set("log_errors", "1");
ini_set("error_log", "/tmp/php-error.log");


// set the Content-Type header to JSON, 
// so that the client knows that we are returning JSON data
header('Content-Type: application/json');

/*
   Send the following fake JSON as the result
   {  "id": $id,
      "givenName": { "en": "A. Michael" },
      "familyName": { "en": "Spencer" },
      "affiliations": [ "UCLA", "White House" ]
   }
*/

$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$id = intval($_GET['id']);

$query = "SELECT * FROM Laureates WHERE id=$id";
$rs = $db->query($query);

while ($row = $rs->fetch_assoc()) { 
    $givenName = $row['givenName']; 
    $familyName = $row['familyName'];
    $gender = $row['gender'];
    $birthDate = $row['birthDate'];
    $city = $row['city'];
    $country = $row['country'];
}
$city1 = ["en" => $city];
$country1 = ["en" => $country];
$familyName1 = ["en" => $familyName];
$givenName1 = ["en" => $givenName];

$prizeQuery = "SELECT * FROM Prize WHERE id= $id";
$rsPrize = $db->query($prizeQuery);
$prizes = array();
while ($rowPrize = $rsPrize->fetch_assoc()) { 
    $awardYear= $rowPrize['awardYear']; 
    $category = $rowPrize['category'];
    $sortOrder = $rowPrize['sortOrder'];
    $affilQuery = "SELECT * FROM Associate WHERE id = $id AND awardYear = ".$awardYear." AND category = '".$category."'";
    $rsAffil = $db->query($affilQuery);
    $affiliates = array();
    while ($row = $rsAffil->fetch_assoc()) {
        $name = $row['name']; 
        $affilCity = $row['city'];
        $affilCountry = $row['country'];
        $affil[] =
        [
            "name" => (object) [ "en" => $name ],
            "city" => (object) [ "en" => $affilCity ],
            "country" => (object) [ "en" =>  $affilCountry ]
        ];
        $affiliates = array_merge($affiliates, $affil);
        
    }  
    $tempArray = 
    [
        "awardYear" => $awardYear,
        "category" => (object) [
            "en" => $category
        ],
        "sortOrder" => $sortOrder,

        "affiliations" => $affiliates
    ];
    $prizes = array_merge($prizes, $tempArray);


}

$outputArray;
$outputArray["id"] = strval($id);
if($familyName == null and $gender == null) {
    $outputArray["orgName"] = $givenName1; 
    if($birthDate != null || $city != null || $country != null ) {
        $birthArray;
        if($birthDate != null) {
            $birthArray["date"] = $birthDate; 
        } 
        if($city != null || $country != null) {
            $birthPlaceArray;
            if($city != null)
                $birthPlaceArray["city"] = $city1;
            if($country != null)
                $birthPlaceArray["country"] = $country1;
            $birthArray["place"] = $birthPlaceArray; 
        }
        
        $outputArray["founded"] = $birthArray;
        
    }
    $outputArray["nobelPrizes"] = [$prizes];  
}
else {
    if($givenName != null) {
        $outputArray["givenName"] = $givenName1; 
    }
    if($familyName != null) {
        $outputArray["familyName"] = $familyName1; 
    }
    if($gender != null) {
        $outputArray["gender"] = $gender; 
    }
    if($birthDate != null || $city != null || $country != null ) {
        $birthArray;
        if($birthDate != null) {
            $birthArray["date"] = $birthDate; 
        } 
        if($city != null || $country != null) {
            $birthPlaceArray;
            if($city != null)
                $birthPlaceArray["city"] = $city1;
            if($country != null)
                $birthPlaceArray["country"] = $country1;
            $birthArray["place"] = $birthPlaceArray; 
        }

        $outputArray["birth"] = $birthArray;
        
    }
    $outputArray["nobelPrizes"] = [$prizes];

}


$output = (object) $outputArray;
    
echo json_encode($output, JSON_PRETTY_PRINT);

?>