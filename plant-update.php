<!DOCTYPE html>
<html>

<?php require_once('./php/utilities.php');
$id = '';
if(isset($_GET['id']))
    $id = $_GET['id'];
$plant = getPlant($id);
$owner = $plant['owner'] ?? null;
$environment = $plant['environment'] ?? null;
$calibrated_sensors = $plant['calibrated_sensors_list'] ?? null;
$static_sensors = $plant['static_sensors_list'] ?? null;
$static_unattached_sensors = getAllUnattachedStaticSensors();
$calibrated_unattached_sensors = getAllUnattachedCalibratedSensors();
$environments = getAllEnvironments() ?? null;
$users = getAllUsers() ?? null;

if(isset($_POST['update_details'])) {
    $name = htmlspecialchars($_REQUEST['name']);
    $description = htmlspecialchars($_REQUEST['description']);
    $environment_id = htmlspecialchars($_REQUEST['environment']);
    $owner_id = htmlspecialchars($_REQUEST['owner']);
    $environment_id = $environment_id ? $environment_id : null;
    $owner_id = $owner_id ? $owner_id : null;

    $result = postUpdatePlant($id, $name, $description, $environment_id, $owner_id);
    if ($result) {
        echo '<script>window.location.replace("plants.php");</script>';
    } else {
        alert("Unable to update the plant. Something went wrong!");
    }
}

if(isset($_POST['attach_static_sensor'])) {
    $sensor_id = $_POST['attach_static_sensor'];
    $result = attachStaticSensor($id, $sensor_id);
    if ($result) {
        header("Refresh:0");
    } else {
        alert("Unable to update the plant. Something went wrong!");
    }
}

if(isset($_POST['attach_calibrated_sensor'])) {
    $sensor_id = $_POST['attach_calibrated_sensor'];
    $result = attachCalibratedSensor($id, $sensor_id);
    if ($result) {
        header("Refresh:0");
    } else {
        alert("Unable to update the plant. Something went wrong!");
    }
}

if(isset($_POST['detach_static_sensor'])) {
    $sensor_id = $_POST['detach_static_sensor'];
    $result = detachStaticSensor($id, $sensor_id);
    if ($result) {
        header("Refresh:0");
    } else {
        alert("Unable to update the plant. Something went wrong!");
    }
}

if(isset($_POST['detach_calibrated_sensor'])) {
    $sensor_id = $_POST['detach_calibrated_sensor'];
    $result = detachCalibratedSensor($id, $sensor_id);
    if ($result) {
        header("Refresh:0");
    } else {
        alert("Unable to update the plant. Something went wrong!");
    }
}

function getEnvironmentOptions($environments, $selected_environment){
    $selected_name = $selected_environment['name'] ?? "None";
    $selected_id = $selected_environment['id'] ?? 0;
    $content = "<option value=\"$selected_id\" selected>$selected_name</option>";
    if ($selected_id != 0)
        $content = $content . "<option value=\"0\">None</option>";
    foreach($environments as $iterated_environment)
    {
        $iterated_name = $iterated_environment['name'] ?? "None";
        $iterated_id = $iterated_environment['id'] ?? 0;
        if($iterated_id == $selected_id)
            continue;
        $content = $content . "<option value=\"$iterated_id\">$iterated_name</option>";
    }
    return $content;
}

function getUsersOptions($users, $selected_user){
    $selected_name = "None";
    $selected_id = $selected_user['id'] ?? 0;
    if($selected_id != 0 )
        $selected_name = "{$selected_user['first_name']} {$selected_user['last_name']}";
    $content = "<option value=\"$selected_id\" selected>$selected_name</option>";
    if ($selected_id != 0)
        $content = $content . "<option value=\"0\">None</option>";
    foreach($users as $iterated_user)
    {
        $iterated_name = "None";
        $iterated_id = $iterated_user['id'] ?? 0;
        if($iterated_id == $selected_id)
            continue;
        elseif($iterated_id != 0 )
            $iterated_name = "{$iterated_user['first_name']} {$iterated_user['last_name']}";

        $content = $content . "<option value=\"$iterated_id\">$iterated_name</option>";
    }
    return $content;
}

function populateStaticSensors($static_sensors, $unattached_static_sensors){
    $content = "";
    if(!empty($static_sensors)) {
        foreach ($static_sensors as $iterated_sensor) {
            $iterated_name = $iterated_sensor['name'];
            $iterated_id = $iterated_sensor['id'];
            $iterated_identifier = $iterated_sensor['output_identifier'] ?? 0;
            $content = $content . "<tr>";
            $content = $content . "<td>$iterated_name</td>";
            $content = $content . "<td>$iterated_identifier</td>";
            $content = $content . "<td><form method=\"post\"><button class=\"btn btn-danger\" type=\"submit\" name=\"detach_static_sensor\" value=\"$iterated_id\" >Detach</button></form></td>";
            $content = $content . "</tr>";
        }
    }
    if(!empty($unattached_static_sensors)) {
        foreach ($unattached_static_sensors as $iterated_sensor) {
            $iterated_name = $iterated_sensor['name'];
            $iterated_id = $iterated_sensor['id'];
            $iterated_identifier = $iterated_sensor['output_identifier'] ?? 0;
            $content = $content . "<tr>";
            $content = $content . "<td>$iterated_name</td>";
            $content = $content . "<td>$iterated_identifier</td>";
            $content = $content . "<td><form method=\"post\"><button class=\"btn btn-success\" type=\"submit\" name=\"attach_static_sensor\" value=\"$iterated_id\">Attach</button></form></td>";
            $content = $content . "</tr>";
        }
    }
    return $content;
}

function populateCalibratedSensors($calibrated_sensors, $unattached_calibrated_sensors){
    $content = "";
    if(!empty($calibrated_sensors)) {
        foreach ($calibrated_sensors as $iterated_sensor) {
            $iterated_name = $iterated_sensor['name'];
            $iterated_id = $iterated_sensor['id'];
            $iterated_identifier = $iterated_sensor['output_identifier'] ?? 0;
            $content = $content . "<tr>";
            $content = $content . "<td>$iterated_name</td>";
            $content = $content . "<td>$iterated_identifier</td>";
            $content = $content . "<td><form method=\"post\"><button class=\"btn btn-danger\" type=\"submit\" name=\"detach_calibrated_sensor\" value=\"$iterated_id\">Detach</button></form></td>";
            $content = $content . "</tr>";
        }
    }
    if(!empty($unattached_calibrated_sensors)) {
        foreach ($unattached_calibrated_sensors as $iterated_sensor) {
            $iterated_name = $iterated_sensor['name'];
            $iterated_id = $iterated_sensor['id'];
            $iterated_identifier = $iterated_sensor['output_identifier'] ?? 0;
            $content = $content . "<tr>";
            $content = $content . "<td>$iterated_name</td>";
            $content = $content . "<td>$iterated_identifier</td>";
            $content = $content . "<td><form method=\"post\"><button class=\"btn btn-success\" type=\"submit\" name=\"attach_calibrated_sensor\" value=\"$iterated_id\">Attach</button></form></td>";
            $content = $content . "</tr>";
        }
    }
    return $content;
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Plant Update</title>
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
                               <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"></a>
                                   <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in">
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
                <h3 class="text-dark mb-4">Update Plant&nbsp;</h3>
                <div class="row mb-3">
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Details</p>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><label for="name"><strong>Name</strong></label><input class="form-control" type="text" name="name" required value="<?php echo $plant['name'] ?>"></div>
                                                <div class="form-group"><label for="environment"><strong>Environment</strong></label><select name="environment" class="form-control">
                                                        <optgroup label="Select an environment">
                                                            <?php echo getEnvironmentOptions($environments, $environment); ?>
                                                        </optgroup>
                                                    </select></div>
                                                <div class="form-group"><label for="owner"><strong>Owner</strong></label><select name="owner" class="form-control">
                                                        <optgroup label="Select an owner">
                                                           <?php echo getUsersOptions($users, $owner); ?>
                                                        </optgroup>
                                                    </select></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><label for="description"><strong>Description</strong></label></div><textarea class="form-control" name="description" ><?php echo $plant['description'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-primary" type="submit" name="update_details">Update</button></div>
                                </form>
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
                <div class="row">
                    <div class="col">
                        <div class="card shadow mb-4"
                            <?php
                            if(empty($static_sensors) && empty($static_unattached_sensors)) {
                                echo "hidden";
                            }
                            ?>
                        >
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Static Sensors</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th id="sensor-item-title">Name</th>
                                            <th id="sensor-item-title">Output Identifier</th>
                                            <th id="sensor-item-action"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo populateStaticSensors($static_sensors, $static_unattached_sensors); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow mb-4"
                            <?php
                            if(empty($calibrated_sensors) && empty($calibrated_unattached_sensors)) {
                                echo "hidden";
                            }
                            ?>
                        >
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Calibrated Sensors</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th id="sensor-item-title-1">Name</th>
                                            <th id="sensor-item-title-2">Output Identifier</th>
                                            <th id="sensor-item-action-1"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo populateCalibratedSensors($calibrated_sensors, $calibrated_unattached_sensors); ?>
                                        </tbody>
                                    </table>
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
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
</body>

</html>
