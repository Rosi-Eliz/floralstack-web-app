<!DOCTYPE html>
<html lang="en">
<?php require_once('./php/utilities.php');
$environments = getAllEnvironments() ?? null;
$users = getAllUsers() ?? null;

$page = $_GET['page'] ?? 1;
$batch = $_GET['batch'] ?? 20;
    
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
    
$plantsBatch = getPlantsBatch($page, $batch);
$plants = $plantsBatch['plants'];
$lastPage = $plantsBatch['last_page'];
$currentPage = $plantsBatch['current_page'];
$batchSize = $plantsBatch['batch_size'];
$plantsCount = $plantsBatch['plants_count'];


?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Plants</title>
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
                                        <?php echo get_plants($plants); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"><?php echo getDisplayDetails($currentPage, $lastPage ,$batchSize, $plantsCount); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <?php echo getPageControl($currentPage, $lastPage); ?>
                                        </ul>
                                    </nav>
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

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Plant Creation</h5>
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
    function get_plants($plants) {
        
        $table_rows = "";
        foreach ($plants as $result_object) {
        $owner = $result_object["owner"];
        $environment = $result_object["environment"];
        $plant_url = getPlantWebPageURL($result_object["id"]);
        $name = $owner ? "{$owner['first_name']} {$owner['last_name']}" : "Not Assigned";
        $descriptionText = $result_object['description'] ?? "Not Assigned";
        $environmentText = $environment['name'] ?? "Not Assigned";
            
        $table_row = <<<EOT
          <tr>
          <td><img class="rounded-circle mr-2" hidden width="15" height="15" src="assets/img/plant.svg"><a href=$plant_url>$result_object[name]<a/></td>
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
    
    function getDisplayDetails($currentPage, $lastPage ,$batchSize, $plantsCount) {
        $startElement = ($currentPage - 1) * $batchSize + 1;
        $endElement = $startElement + $batchSize - 1;
        $endElement = $endElement < $plantsCount ? $endElement : $plantsCount;
        return "Showing {$startElement} to {$endElement} of {$plantsCount}";
        
    }
    
    function getPageControl($currentPage, $lastPage) {
        $previousClass = $currentPage == 1 ? "page-item disabled" : "page-item";
        $nextClass = $currentPage == $lastPage ? "page-item disabled" : "page-item";
        
        $firstEl;
        $secondEl;
        $thirdEl;
        
        if ($currentPage == 1) {
            $firstEl = ["page-item active", "plants.php?page=1", "1"];
            $secondEl = ["page-item", "plants.php?page=2", "2"];
            $thirdEl = ["page-item", "plants.php?page=3", "3"];
        } elseif ($currentPage == $lastPage) {
            $first = $lastPage - 2;
            $second = $lastPage - 1;
            $third = $lastPage;
            
            $firstEl = ["page-item", "plants.php?page=$first", "$first"];
            $secondEl = ["page-item", "plants.php?page=$second", "$second"];
            $thirdEl = ["page-item active", "plants.php?page=$third", "$third"];
            
        } else {
            $first = $currentPage - 1;
            $second = $currentPage;
            $third = $currentPage + 1;
            
            $firstEl = ["page-item", "plants.php?page=$first", "$first"];
            $secondEl = ["page-item active", "plants.php?page=$second", "$second"];
            $thirdEl = ["page-item", "plants.php?page=$third", "$third"];
        }
        
        $content = <<<EOT
        <li class="$previousClass"><a class="page-link" href="plants.php?page=1" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <li class="$firstEl[0]"><a class="page-link" href="$firstEl[1]">$firstEl[2]</a></li>
        <li class="$secondEl[0]"><a class="page-link" href="$secondEl[1]">$secondEl[2]</a></li>
        <li class="$thirdEl[0]"><a class="page-link" href="$thirdEl[1]">$thirdEl[2]</a></li>
        <li class="$nextClass"><a class="page-link" href="plants.php?page=$lastPage" aria-label="Next"><span aria-hidden="true">»</span></a></li>
EOT;
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
