<!DOCTYPE html>
<html>
<?php require_once('./php/utilities.php');
$id = $_GET['id'];
$type = $_GET['type'];
//$referer = $_SERVER["HTTP_REFERER"];

function getSensor($id, $type) {
    switch($type)
    {
        case "static":
            return getStaticSensor($id);

        case "calibrated":
            return getCalibratedSensor($id);

        default:
            return null;
    }
}
$sensor = getSensor($id, $type);
$actuators_list = $sensor['actuators'];

function getDetails($sensor, $type)
{
    switch($type)
    {
        case "static":
            return populateStaticSensor($sensor);

        case "calibrated":
            return populateCalibratedSensor($sensor);

        default:
            return "";
    }
}

function populateCalibratedSensor($sensor)
{
    $name = $sensor['name'];
    $priority = $sensor['priority'];
    $output_identifier = $sensor['output_identifier'];
    $unit_of_measurement = $sensor['unit_of_measurement'];
    $last_measurement_value = $sensor['last_measurement_value'] ?? "Not Available";
    $threshold_type = $sensor['threshold_type'];
    $description = $sensor['description'];
    $max_value = $sensor['max_value'];
    $min_value = $sensor['min_value'];
    $percentage_threshold = $sensor['percentage_threshold'];
    $content = <<<EOT
        <div class="col">
                                        <div class="form-group"><label for="priority"><strong>Priority</strong></label></div>
                                        <p>$priority</p>
                                    </div>
                                    <div class="col-xl-11 offset-xl-0">
                                        <div class="form-group"><label for="identifier"><strong>Identifier</strong></label></div>
                                        <p>$output_identifier</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="unit_of_measurement"><strong>Unit of measurement</strong></label></div>
                                        <p>$unit_of_measurement</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_measurement"><strong>Last measurement</strong></label></div>
                                        <p>$last_measurement_value</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="threshold_type"><strong>Threshold type</strong></label></div>
                                        <p>$threshold_type</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="max_value"><strong>Max Value</strong></label></div>
                                        <p>$max_value</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="min_value"><strong>Min Value</strong></label></div>
                                        <p>$min_value</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="percentage_threshold"><strong>Threshold %</strong><br></label></div>
                                        <p>$percentage_threshold</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="description"><strong>Description</strong></label></div>
                                        <p>$description</p>
                                    </div>
EOT;
    return $content;
}

function populateStaticSensor($sensor)
{  $name = $sensor['name'];
    $priority = $sensor['priority'];
    $output_identifier = $sensor['output_identifier'];
    $unit_of_measurement = $sensor['unit_of_measurement'];
    $last_measurement_value = $sensor['last_measurement_value'] ?? "Not Available";
    $threshold_type = $sensor['threshold_type'];
    $description = $sensor['description'];
    $threshold_offset = $sensor['threshold_offset'];
    $content = <<<EOT
        <div class="col">
                                        <div class="form-group"><label for="priority"><strong>Priority</strong></label></div>
                                        <p>$priority</p>
                                    </div>
                                    <div class="col-xl-11 offset-xl-0">
                                        <div class="form-group"><label for="identifier"><strong>Identifier</strong></label></div>
                                        <p>$output_identifier</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="unit_of_measurement"><strong>Unit of measurement</strong></label></div>
                                        <p>$unit_of_measurement</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="last_measurement"><strong>Last measurement</strong></label></div>
                                        <p>$last_measurement_value</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="threshold_type"><strong>Threshold type</strong></label></div>
                                        <p>$threshold_type</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="threshold_offset"><strong>Threshold offset</strong></label></div>
                                        <p>$threshold_offset</p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="description"><strong>Description</strong></label></div>
                                        <p>$description</p>
                                    </div>
EOT;
    return $content;
}

    function populateActuators($actuators_list)
    {
        $content = "";
        if(empty($actuators_list))
        {
            return $content;
        }
        foreach($actuators_list as $actuator)
        {
            $name = $actuator['name'];
            $identifier = $actuator['input_identifier'];
            $priority = $actuator['priority'];
            $actuator_content = <<<EOT
            <tr>
              <td>$name</td>
              <td>$identifier</td>
              <td>$priority</td>
            </tr>
EOT;
        $content = $content . $actuator_content;
        }
        return $content;
    }

if(isset($_POST['delete'])) {
    $result = deleteSensor($id);
    if ($result) {
        echo("<script>location.href = '".HOME_WEB_PAGE."';</script>");
        exit;
    } else {
        alert("Unable to delete the sensor. Something went wrong!");
    }
}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: linear-gradient(var(--success), var(--success) 0%, rgb(22,150,104) 100%), var(--cyan);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="font-family: Nunito, sans-serif;">
                    <div class="sidebar-brand-icon rotate-n-15"></div>
                    <div class="sidebar-brand-text mx-3"><span class="text-uppercase" style="font-weight: bold;">FLoralstack</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="entities.php"><i class="fas fa-user"></i><span>Entities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="plants.php"><i class="fas fa-table"></i><span>Plants</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"></div>
                        </form>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="d-flex align-items-center dropdown-item" href="#">
                                            <div class="mr-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="d-flex align-items-center dropdown-item" href="#">
                                            <div class="mr-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="d-flex align-items-center dropdown-item" href="#">
                                            <div class="mr-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Admin User</span><img class="border rounded-circle img-profile" src="assets/img/avatars/profile.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Sensor Name</h3>
                    <div class="row mb-3">
                        <div class="col" id="details-column">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Details</h6>
                                </div>
                                <div class="card-body">
                                  <?php echo getDetails($sensor, $type); ?>
                                </div>
                            </div>
                            <div class="card shadow mb-3" <?php
                            if(empty($actuators_list)) {
                                echo "hidden";
                            }
                            ?>>
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 font-weight-bold">Actuators</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th id="actuators-header-row">Name</th>
                                                    <th id="actuators-header-row">Identifier</th>
                                                    <th id="actuators-header-row">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php echo populateActuators($actuators_list); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center shadow" style="padding: 20px;">
                                    <div class="text-left mb-3"><button class="btn btn-primary" type="button" style="margin: 12px 18px 0px 0px;">Update</button><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#deleteModal" style="margin: 10px 0px 0px 0px;">Delete</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row mb-3 d-none">
                                <div class="col">
                                    <div class="card text-white bg-primary shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success shadow">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <p class="m-0">Peformance</p>
                                                    <p class="m-0"><strong>65.2%</strong></p>
                                                </div>
                                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                            </div>
                                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>floralstack 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Deletion Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this sensor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <form method="post">
                        <button type="submit" class="btn btn-danger" name="delete" >Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>