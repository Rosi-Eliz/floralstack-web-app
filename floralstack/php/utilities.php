<?php
    // General Utilities
    
    include('./php/definitions.php');
    function alert($message) {
        echo '<script>alert("' . $message . '")</script>';
    }
    
    // Web redirections
    
    function getPlantWebPageURL($id) {
        return PLANT_WEB_PAGE . "?id={$id}";
    }

    
    // Backend invocations
        
    function createPlant($name, $description) {
        $url = API_ROOT . PLANTS_ENDPOINT;
        $data = array('name' => $name, 'description' => $description);
        return makePostRequest($url, $data);
    }
    
    function getAllPlants() {
        $url = API_ROOT . PLANTS_ENDPOINT;
        return getRequest($url);
    }
    
    function getPlant($id) {
        $url = API_ROOT . PLANTS_ENDPOINT . "/{$id}";
        return getRequest($url);
    }

    function getAllUnattachedStaticSensors(){
        $url = API_ROOT . SENSORS_ENDPOINT . "/static-unattached";
        return getRequest($url);
    }

    function getAllUnattachedCalibratedSensors(){
        $url = API_ROOT . SENSORS_ENDPOINT . "/calibrated-unattached";
        return getRequest($url);
    }

    function getAllEnvironments(){
        $url = API_ROOT . ENVIRONMENTS_ENDPOINT;
        return getRequest($url);
    }

    function getAllUsers(){
        $url = API_ROOT . USERS_ENDPOINT;
        return getRequest($url);
    }

    function postUpdatePlant($id, $name, $description, $environment_id, $owner_id){
        $url = API_ROOT . PLANTS_ENDPOINT . "/update";
        $data = array('id' => $id,
            'name' => $name,
            'description' => $description,
            'environment_id' => $environment_id,
            'owner_id' => $owner_id);
     return makePostRequest($url, $data);
    }


// Network layer
    
    function makePostRequest($url, $data) {
        $options = array(
                         'http' => array(
                                         'header'  => "Content-type: application/json\r\n",
                                         'method'  => 'POST',
                                         'content' => json_encode($data)
                                         )
                         );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        $status_line = $http_response_header[0];

        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        return $status === "200";
    }
    
    function getRequest($url) {
        $response = file_get_contents($url);
        $decoded_response = json_decode($response, true);
        return $decoded_response;
    }
    
    ?>
