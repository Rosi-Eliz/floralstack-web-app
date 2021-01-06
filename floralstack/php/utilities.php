<?php
    include('./php/definitions.php');
    function alert($message) {
        echo '<script>alert("' . $message . '")</script>';
    }
    
    function createPlant($name, $description) {
        $url = API_ROOT . PLANTS_ENDPOINT;
        $data = array('name' => $name, 'description' => $description);
        return makePostRequest($url, $data);
    }
    
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
    ?>
