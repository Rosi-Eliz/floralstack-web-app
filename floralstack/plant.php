<!DOCTYPE html>
<html lang="en">
<?php require_once('./php/utilities.php');
    $id = $_GET['id'];
    $plant = getPlant($id);
    $owner = $plant['owner'];
    $environment = $plant['environment'];
    $calibrated_sensors = $plant['calibrated_sensors_list'];
    $static_sensors = $plant['static_sensors_list'];
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
                    <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="entities.html"><i class="fas fa-user"></i><span>Entities</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="table.html"><i class="fas fa-table"></i><span>Plants</span></a></li>
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
                    <h3 class="text-dark mb-4"><?php echo $plant['name'] ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-xl-4 offset-xl-0">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/plant.svg" width="160" height="160">
                                    <div class="mb-3"></div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center shadow" style="padding: 20px;">
                                    <div class="mb-3"></div><button class="btn btn-primary" type="button" style="margin: -12px 16px 0px 0px;">Update</button><button class="btn btn-primary" type="button" style="margin: -12px 0px 0px 0px;">Delete</button>
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
                                        <p><?php echo "${owner['first_name']} {$owner['last_name']}" ?></p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="environment"><strong>Environment</strong></label></div>
                                        <p><?php echo $environment['name'] ?></p>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="description"><strong>Description</strong></label></div>
                                        <p><?php echo $plant['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <?php echo populate_static_sensor_table($plant, $static_sensors) ?>
                            <?php echo populate_calibrated_sensor_table($plant, $calibrated_sensors) ?>
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

            $row_content = <<<EOT
            <tr>
                <td>$name</td>
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
        if(!empty($calibrated_sensors)){
        $table_content = "";
            foreach($calibrated_sensors as $calibrated_sensor) {
                $name = $calibrated_sensor['name'];
                $priority = $calibrated_sensor['priority'];
                $output_identifier = $calibrated_sensor['output_identifier'];
                $range = "{$calibrated_sensor['min_value']} - {$calibrated_sensor['max_value']}";
                $unit_of_measurement = $calibrated_sensor['unit_of_measurement'];
                $type = $calibrated_sensor['threshold_type'];
                $threshold = "{$calibrated_sensor['percentage_threshold']} %";
                $row_content = <<<EOT
                <tr>
                    <td>$name</td>
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
