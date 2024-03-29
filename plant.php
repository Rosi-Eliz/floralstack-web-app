<!DOCTYPE html>
<html lang="en">
<?php require_once('./php/utilities.php');
    $id = $_GET['id'];
    $plant = getPlant($id);
    $owner = $plant['owner'];
    $owner_name = $owner ? "{$owner['first_name']} {$owner['last_name']}" : "Not assigned";
    $environment = $plant['environment'];
    $environment_name = $environment ? $environment['name'] : "Not assigned";
    $calibrated_sensors = $plant['calibrated_sensors_list'];
    $static_sensors = $plant['static_sensors_list'];
    $description = $plant ? $plant['description'] : "No description";
    
    if(isset($_POST['delete'])) {
        $result = deletePlant($id);
        if ($result) {
            echo '<script>window.location.replace("plants.php");</script>';
        } else {
            alert("Unable to create the plant. Something went wrong!");
        }
    }
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Plant</title>
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
        <?php include 'webUtilities/navigation_bar.php';?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
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
                    <h3 class="text-dark mb-4"><?php echo $plant['name'];?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-xl-4 offset-xl-0">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/plant.svg" width="160" height="160">
                                    <div class="mb-3"></div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center shadow" style="padding: 20px;">
                                    <div class="mb-3"></div><button class="btn btn-primary" onClick="document.location.href='plant-update.php?id=<?php echo $plant['id' ?? ""];?>'" type="button" style="margin: -12px 16px 0px 0px;">Update</button><button class="btn btn-primary" data-toggle="modal" data-target="#deleteModal" type="button" style="margin: -12px 0px 0px 0px;">Delete</button>
                                    <div class="btn-group" role="group"></div>
                                    <div class="btn-toolbar">
                                        <div class="btn-group" role="group"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" id="details-column">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col">
                                        <div class="form-group"><label for="owner_name"><strong>Owner</strong></label></div>
                                        <p><?php echo $owner_name;?></p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="environment"><strong>Environment</strong></label></div>
                                        <p><?php echo $environment_name;?></p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="description"><strong>Description</strong></label></div>
                                        <p><?php echo $description;?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <?php echo populate_static_sensor_table($plant, $static_sensors);?>
                            <?php echo populate_calibrated_sensor_table($plant, $calibrated_sensors);?>
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
                    Are you sure you want to delete this plant?
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
<?php
    
    function populate_static_sensor_table($plant, $static_sensors) {
        $content = "";
        if(!empty($static_sensors)){
        $table_content = "";
        foreach($static_sensors as $static_sensor) {
            $name = $static_sensor['name'];
            $priority = $static_sensor['priority'];
            $output_identifier = $static_sensor['output_identifier'];
            $threshold = $static_sensor['threshold_offset'];
            $unit_of_measurement = $static_sensor['unit_of_measurement'];
            $type = $static_sensor['threshold_type'];

            $sensor_url = getSensorWebPageURL($static_sensor['id'], "static");
            $row_content = <<<EOT
            <tr>
                <td><a href="$sensor_url">$name</td>
                <td>$priority</td>
                <td>$output_identifier</td>
                <td>$threshold</td>
                <td>$unit_of_measurement</td>
                <td>$type</td>
            </tr>
EOT;
            $table_content = $table_content . $row_content;
        }
            
        $content = <<<EOT
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Static Sensors</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th id="static-sensors-header-row">Name</th>
                                <th id="static-sensors-header-row">Priority</th>
                                <th id="static-sensors-header-row">Identifier</th>
                                <th id="static-sensors-header-row">Threshold</th>
                                <th id="static-sensors-header-row">UOM</th>
                                <th id="static-sensors-header-row">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                        $table_content
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
EOT;
        }
        return $content;
    }
    
    function populate_calibrated_sensor_table($plant, $calibrated_sensors){
        $content = "";
        if(!empty($calibrated_sensors)) {
        $table_content = "";
            foreach($calibrated_sensors as $calibrated_sensor) {
                $name = $calibrated_sensor['name'];
                $priority = $calibrated_sensor['priority'];
                $output_identifier = $calibrated_sensor['output_identifier'];
                $range = "{$calibrated_sensor['min_value']} - {$calibrated_sensor['max_value']}";
                $unit_of_measurement = $calibrated_sensor['unit_of_measurement'];
                $type = $calibrated_sensor['threshold_type'];
                $threshold = "{$calibrated_sensor['percentage_threshold']} %";
                $sensor_url = getSensorWebPageURL($calibrated_sensor['id'], "calibrated");
                $row_content = <<<EOT
                <tr>
                    <td><a href="{$sensor_url}">$name</td>
                    <td>$priority</td>
                    <td>$output_identifier</td>
                    <td>$range</td>
                    <td>$unit_of_measurement</td>
                    <td>$type</td>
                    <td>$threshold</td>
                </tr>
EOT;
                $table_content = $table_content . $row_content;
            }
            
            $content = <<<EOT
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 font-weight-bold">Calibrated Sensors</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th id="calibrated-sensors-header-row">Name</th>
                                    <th id="calibrated-sensors-header-row">Priority</th>
                                    <th id="calibrated-sensors-header-row">Identifier</th>
                                    <th id="calibrated-sensors-header-row">Range</th>
                                    <th id="calibrated-sensors-header-row">UOM</th>
                                    <th id="calibrated-sensors-header-row">Type</th>
                                    <th id="calibrated-sensors-header-row">Threshold</th>
                                </tr>
                            </thead>
                            <tbody>
                            $table_content
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
EOT;
        }
        return $content;
    }
?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
