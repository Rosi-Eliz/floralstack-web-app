<!DOCTYPE html>
<html lang="en">
<?php require_once('./php/utilities.php');
$environments = getAllEnvironments() ?? null;
$users = getAllUsers() ?? null;

if(isset($_POST['create_plant'])) {
    $name = htmlspecialchars($_REQUEST['name_form']);
    $environment = htmlspecialchars($_REQUEST['environment'] == "0" ? null : $_REQUEST['environment']);
    $owner = htmlspecialchars($_REQUEST['owner'] == "0" ? null : $_REQUEST['owner']);
    $description = htmlspecialchars($_REQUEST['description_form']);

    $result = createPlant($name, $description, $environment, $owner);
    if ($result) {
        header("Refresh:0");
    } else {
        alert("Unable to create the plant. Something went wrong!");
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
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
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button" style="color: var(--white);background: var(--success);border-color: var(--green);"><i class="fas fa-search"></i></button></div>
                            </div>
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
                    <h3 class="text-dark mb-4">Plants</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold" style="color: var(--blue);filter: hue-rotate(0deg) saturate(0%);">List of items</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" >Create</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead id="header">
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Owner</th>
                                            <th>Environment</th>
                                            <th>Creation Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo get_plants(); ?>
                                    </tbody>
                                </table>
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

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_plant_form" method="post" action="">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" placeholder="Enter a name" class="form-control" name="name_form" required>

                            <label for="environment-name" class="col-form-label">Environment:</label>
                            <select name="environment" class="form-control">
                            <optgroup label="Select an environment">
                                <?php echo getEnvironmentOptions($environments, null); ?>
                            </optgroup>
                            </select>

                            <label for="owner-name" class="col-form-label">Owner:</label>
                            <select name="owner" class="form-control">
                                <optgroup label="Select an owner">
                                    <?php echo getUsersOptions($users, null); ?>
                                </optgroup>
                            </select>

                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" placeholder="Enter a description (Optional)" name="description_form" id="description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="create_plant_form" class="btn btn-primary" name="create_plant">Create</button>
                </div>
            </div>
        </div>
    </div>

<?php
    function get_plants() {

        $decoded_response = getAllPlants();
        
        $table_rows = "";
        foreach ($decoded_response as $result_object) {
        $owner = $result_object["owner"];
        $environment = $result_object["environment"];
        $plant_url = getPlantWebPageURL($result_object["id"]);
        $name = $owner ? "{$owner['first_name']} {$owner['last_name']}" : "Not Assigned";
        $descriptionText = $result_object['description'] ?? "Not Assigned";
        $environmentText = $environment['name'] ?? "Not Assigned";
            
        $table_row = <<<EOT
          <tr>
          <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/plant.svg"><a href=$plant_url>$result_object[name]<a/></td>
              <td>$descriptionText</td>
              <td>$name</td>
              <td>$environmentText</td>
              <td>$result_object[creation_date]</td>
          </tr>
EOT;
            $table_rows .= $table_row;
        }
        return $table_rows;
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
?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
