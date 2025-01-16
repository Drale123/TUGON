<?php
    session_start();


    $page = isset($_GET['page']) ? $_GET['page'] : 'home'; 


    $isLoggedIn = isset($_SESSION['user_id']);
    $userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;


    $showLoginModal = false;
    $showResidentRestrictedModal = false;
    $showUnauthorizedModal = false;


    if ($page === 'resource_tracker') {
        if (!$isLoggedIn) {
            $showLoginModal = true;
        } elseif ($userType !== 'official') {
            $showResidentRestrictedModal = true;
        }
    } elseif ($page === 'incident_report') {
        if (!$isLoggedIn) {
            $showIncidentReportModal = true;
        }
    }


    if ($page === 'incident_report' && $isLoggedIn) {
        if ($userType === 'resident') {
            $incidentPage = 'incident_report.php';
        } elseif ($userType === 'official') {
            $incidentPage = 'incidentreportview.php';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>TUGON</title>
    <style>
        .navbar-nav .nav-link {
            margin: 0 1.5rem;
        }
        .navbar-brand img {
            height: 50px;
        }
        .modal-icon {
            font-size: 3rem;
            color: #dc3545;
        }
        .dropdown {
            text-align: center; 
        }

        .dropdown-menu {
            text-align: center; 
        }

        .nav-item, .dropdown-item {
            display: block;
            text-align: center; 
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="bg-light shadow">
        <nav class="navbar navbar-expand-lg container py-3">
            <a class="navbar-brand mx-auto" href="?page=home">
                <img src="assets/img/logo.png" alt="Logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'home') ? 'active' : '' ?>" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="disasterTrainingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Disasters</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=drought">Drought</a></li>
                            <li><a class="dropdown-item" href="?page=earthquake_preparedness">Earthquakes</a></li>
                            <li><a class="dropdown-item" href="?page=extreme_heat">Extreme Heat</a></li>
                            <li><a class="dropdown-item" href="?page=flood_safety">Flood</a></li>
                            <li><a class="dropdown-item" href="?page=fire_safety">Fires</a></li>
                            <li><a class="dropdown-item" href="?page=heavy_rainfall">Heavy Rainfall</a></li>
                            <li><a class="dropdown-item" href="?page=landslides">Landslides</a></li>
                            <li><a class="dropdown-item" href="?page=storm_surge">Storm Surge</a></li>
                            <li><a class="dropdown-item" href="?page=tsunami">Tsunami</a></li>
                            <li><a class="dropdown-item" href="?page=typhoon_readiness">Typhoons</a></li>
                            <li><a class="dropdown-item" href="?page=volcanic_eruption">Volcanic Eruption</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'emergency_contacts') ? 'active' : '' ?>" href="?page=emergency_contacts">Emergency Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'resource_tracker') ? 'active' : '' ?>" href="?page=resource_tracker">Resource Tracker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'incident_report') ? 'active' : '' ?>" href="?page=incident_report">Incident Report</a>
                    </li>
                </ul>
                <div class="d-flex ms-3">
                    <?php if ($isLoggedIn): ?>
                        <div class="dropdown">
                            <a href="#" id="userDropdown" data-bs-toggle="dropdown" >
                                <i class="ri-user-line fs-4"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($page == 'manage_account') ? 'active' : '' ?>" href="?page=manage_account">Manage Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($page == 'brgy_details') ? 'active' : '' ?>" href="?page=brgy_details">Brgy Information</a>
                                </li>
                                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php">
                            <i class="ri-user-line fs-4"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container my-4">
        <?php
            switch ($page) {
                case 'home':
                    include('home.php');
                    break;
                case 'drought':
                    include('drought.php');
                    break;
                case 'earthquake_preparedness':
                    include('earthquake.php');
                    break;
                case 'extreme_heat':
                    include('extreme_heat.php');
                    break;
                case 'flood_safety':
                    include('flood.php');
                    break;
                case 'fire_safety':
                    include('fire.php');
                    break;
                case 'heavy_rainfall':
                    include('heavy_rainfall.php');
                    break;
                case 'landslides':
                    include('landslides.php');
                    break;
                case 'storm_surge':
                    include('storm_surge.php');
                    break;
                case 'tsunami':
                    include('tsunami.php');
                    break;
                case 'typhoon_readiness':
                    include('typhoon.php');
                    break;
                case 'volcanic_eruption':
                    include('volcanic_eruption.php');
                    break;
                case 'emergency_contacts':
                    include('emergency_contacts.php');
                    break;
                case 'resource_tracker':
                    if ($isLoggedIn && $userType === 'official') {
                        include('resourcetracker.php');
                    } else {
                        $showResidentRestrictedModal = true;
                    }
                    break;
                case 'incident_report':
                    if ($isLoggedIn && isset($incidentPage)) {
                        include($incidentPage);
                    }
                    break;
                case 'manage_account':
                    include('manage_account.php');
                    break;
                case 'brgy_details':
                    include('brgy_details.php');
                    break;
                default:
                    include('home.php');
                    break;
            }
        ?>
    </main>
        
        <!-- MODALS -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if ($showLoginModal): ?>
                    You must log in as a <strong>Barangay Official</strong> to access the Resource Tracker.
                <?php elseif ($showIncidentReportModal): ?>
                    Please log in to access the Incident Report page.
                <?php elseif ($userType === 'resident'): ?>
                    Unable to view content. Please log in as a <strong>Brgy. Official</strong>.
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="residentRestrictedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Access Restricted</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Unable to view content. Please log in as a <strong>Brgy. Official</strong>.
            </div>
            <div class="modal-footer">
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>
</div>


    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logout Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="ri-error-warning-line modal-icon mb-3"></i>
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <a href="logout.php" class="btn btn-danger">Yes</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    <?php if ($showLoginModal): ?>
        new bootstrap.Modal(document.getElementById('loginModal')).show();
    <?php elseif ($showResidentRestrictedModal): ?>
        new bootstrap.Modal(document.getElementById('residentRestrictedModal')).show();
    <?php elseif ($showIncidentReportModal): ?>
        new bootstrap.Modal(document.getElementById('loginModal')).show();
    <?php endif; ?>
</script>


</body>
</html>
