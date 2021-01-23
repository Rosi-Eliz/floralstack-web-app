<?php
    define("API_ROOT", "http://localhost:8080");
    define("WEB_ROOT", "http://localhost:8000");
    define("PLANTS_ENDPOINT", "/api/plants");
    define("DELETE_PLANTS_ENDPOINT", PLANTS_ENDPOINT . "/delete");
    define("SENSORS_ENDPOINT", "/api/sensors");
    define("CALIBRATED_SENSORS_ENDPOINT", SENSORS_ENDPOINT . "/calibrated");
    define("STATIC_SENSORS_ENDPOINT", SENSORS_ENDPOINT . "/static");
    define("DELETE_SENSORS_ENDPOINT", SENSORS_ENDPOINT . "/delete");
    define("ENVIRONMENTS_ENDPOINT", "/api/environments");
    define("USERS_ENDPOINT", "/api/users");

    define("HOME_WEB_PAGE", WEB_ROOT . "/plants.php");
    define("PLANT_WEB_PAGE", WEB_ROOT . "/plant.php");
    define("SENSOR_WEB_PAGE", WEB_ROOT . "/sensor.php");
    define("PLANT_UPDATE_WEB_PAGE", WEB_ROOT . "/plant-update.php");
    ?>
