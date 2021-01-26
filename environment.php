<!DOCTYPE html>
<html>
<?php
    require_once('./php/utilities.php');
    $id = $_GET['id'];
    $environment = getEnvironment($id);
    $name = $environment['name'];
    $description = $environment['description'];

    $plants = getAllPlantsForEnvironment($id);

    function populatePlants($plants){
         $table_rows = "";
        foreach ($plants as $result_object) {
        $plant_name = $result_object['name'];
        $plant_url = getPlantWebPageURL($result_object["id"]);
        $owner = $result_object["owner"];
        $owner_url = getUserWebPageURL($owner['id']);
        $owner_name = $owner ? "{$owner['first_name']} {$owner['last_name']}" : "Not Assigned";
        $creation_date = $result_object['creation_date'];
        $descriptionText = $result_object['description'] ?? "Not Assigned";

        $table_row = <<<EOT
          <tr>
          <td><img class="rounded-circle mr-2" width="30" height="30" src="assets/img/plant.svg"><a href="$plant_url">$plant_name</td>
          <td>$descriptionText</td>
          <td><a href="$owner_url">$owner_name</td>
          <td>$creation_date</td>
          </tr>
EOT;
            $table_rows .= $table_row;
        }
        return $table_rows;
    }

    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Environment</title>
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
            <div id="content" style="margin-bottom: 0;">
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
                    <h3 class="text-dark mb-4"><?php echo $name; ?></h3>
                    <div class="col" style="margin-bottom: 0px;">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="col">
                                    <div class="form-group"><label for="description"><strong>Description</strong></label></div>
                                    <p><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow"></div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-left text-primary d-xl-flex mb-auto align-items-xl-center m-0 font-weight-bold" style="color: var(--blue);filter: hue-rotate(0deg) saturate(0%);margin: 3px 0px 0px 0px;margin-top: -11px;">Owned Plants</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead id="header-1">
                                            <tr>
                                                <th id="owner_plants_column">Name</th>
                                                <th id="owner_plants_column">Description</th>
                                                <th id="owner_plants_column">Owner</th>
                                                <th id="owner_plants_column">Creation Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo populatePlants($plants); ?>
                                        </tbody>
                                    </table>
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
