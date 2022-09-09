<?php
if(isset($_POST["type"]) && $_POST["type"] == "list" && $_POST["value"] == "countryAndCollege"){
    header('Content-Type: application/json');
    $list = getCountryAndCollegeList();
    echo json_encode($list);
}
if(isset($_POST["type"]) && $_POST["type"] == "collegeData"){
    header('Content-Type: application/json');
    $list = getCollegeData($_POST["value"],$_POST["query"]);
    echo json_encode($list);
}

function getCollegeData($query, $country){
        $countryStr = $country == "" ? "" : '&country=' . urlencode($country);
        $colleges = file_get_contents('http://universities.hipolabs.com/search?name=' . $query . $countryStr);
        $collegeArray = json_decode($colleges, true);
        return $collegeArray;

}

function getCountryAndCollegeList(){
    $countryJsonFile = 'world_universities.json';
    $countryList = array();
    $collegeList = array();
    $json = file_get_contents($countryJsonFile);
    $countryJsonFile = json_decode($json, true);
    foreach($countryJsonFile as $countryArray){
        if(!in_array($countryArray["country"], $countryList)){
            $countryList[] = $countryArray["country"];
    }
    $collegeList[] = $countryArray["name"];
}
    return array("countries" => $countryList, "colleges" => $collegeList);

}
?>