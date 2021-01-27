<!DOCTYPE html>
<html>
<?php
    require_once('./php/utilities.php');

    function populateTable()
    {
        $overview = getOverview();
        $plants_count = $overview['plants_count'];
        $users_count = $overview['users_count'];
        $environments_count = $overview['environments_count'];
        $static_sensors_count = $overview['static_sensors_count'];
        $calibrated_sensors_count = $overview['calibrated_sensors_count'];
        $actuators_count = $overview['actuators_count'];

        $content = <<<EOT
        <tr>
        <td>Plants</td>
        <td>$plants_count</td>
        </tr>
        <tr>
        <td>Users</td>
        <td>$users_count</td>
        </tr>
        <tr>
        <td>Environments</td>
        <td>$environments_count</td>
        </tr>
        <tr>
        <td>Static sensors</td>
        <td>$static_sensors_count</td>
        </tr>
        <tr>
        <td>Calibrated sensors</td>
        <td>$calibrated_sensors_count</td>
        </tr>
        <tr>
        <td>Actuators</td>
        <td>$actuators_count</td>
        </tr>
EOT;
        return $content;
    }
    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Floralstack</title>
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
                    <h3 class="text-dark mb-4">Dashboard</h3>
                    <div class="col" style="margin-bottom: 34px;">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-left text-primary d-xl-flex mb-auto align-items-xl-center m-0 font-weight-bold" style="color: var(--blue);filter: hue-rotate(0deg) saturate(0%);margin: 3px 0px 0px 0px;margin-top: -11px;">Overview</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead id="header-1">
                                            <tr>
                                                <th id="environments_column">Entity</th>
                                                <th id="environments_column">Records</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo populateTable(); ?>
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
