<?php
require('dbconnect.php');

try {
    // Fetch barangay details
    $query = "SELECT * FROM brgy_detail LIMIT 1";
    $stmt = $pdo->query($query);
    $barangay_data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching barangay details: " . $e->getMessage());
}

$barangay_name = $barangay_data['barangay_name'] ?? 'Barangay Name';
$city_name = $barangay_data['city_name'] ?? 'City/Municipality';
$province_name = $barangay_data['province_name'] ?? 'Province';
$barangay_logo = $barangay_data['barangay_logo'] ?? 'default_logo.png'; // Fallback if no logo is found

// Fetch the latest incident report
try {
    $incidentQuery = "SELECT 
                        incident_id,
                        incident_datetime::date AS date_of_incident,
                        TO_CHAR(incident_datetime, 'HH12:MI AM') AS time_of_incident,
                        location,
                        COALESCE(incident_type, custom_incident_type) AS incident_type,
                        created_at::date AS date_issued,
                        TO_CHAR(created_at, 'HH12:MI AM') AS time_issued,
                        description
                      FROM incident_lists
                      ORDER BY created_at DESC
                      LIMIT 1";
    $stmt = $pdo->query($incidentQuery);
    $incident_data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching incident details: " . $e->getMessage());
}

// Fetch supporting files for the latest incident
$supporting_files = [];
if (!empty($incident_data['incident_id'])) {
    try {
        $filesQuery = "SELECT supporting_files FROM incident_lists WHERE incident_id = :incident_id";
        $filesStmt = $pdo->prepare($filesQuery);
        $filesStmt->execute([':incident_id' => $incident_data['incident_id']]);
        $supporting_files = $filesStmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching supporting files: " . $e->getMessage());
    }
}

// Set fallback values if no data is found
$date_of_incident = $incident_data['date_of_incident'] ?? 'N/A';
$time_of_incident = $incident_data['time_of_incident'] ?? 'N/A';
$location = $incident_data['location'] ?? 'N/A';
$incident_type = $incident_data['incident_type'] ?? 'N/A';
$date_issued = $incident_data['date_issued'] ?? 'N/A';
$time_issued = $incident_data['time_issued'] ?? 'N/A';
$description = $incident_data['description'] ?? 'No description available.';

// Fetch all incidents for listing
try {
    $incidents = $pdo->query("SELECT * FROM incident_list ORDER BY incident_datetime DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$successMessage = null; 
$errorMessage = null;  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $incidentId = $_POST['delete_id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM incident_list WHERE incident_id = :incident_id");
            $stmt->bindParam(':incident_id', $incidentId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $successMessage = "Incident report successfully deleted.";
            } else {
                $errorMessage = "Incident report deletion failed. Please try again.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    } else {
        $reporterName = $_POST['reporter_name'] ?? null;
        $incidentType = $_POST['incident_type'] ?? null;
        $customIncidentType = $_POST['custom_incident_type'] ?? null;
        $incidentDatetime = $_POST['incident_datetime'] ?? null;
        $location = $_POST['location'] ?? null;
        $description = $_POST['description'] ?? null;
        $supportingFiles = isset($_FILES['supporting_files']) && $_FILES['supporting_files']['tmp_name'] ? file_get_contents($_FILES['supporting_files']['tmp_name']) : null;

        try {
            $query = "INSERT INTO incident_list 
                (reporter_name, incident_type, custom_incident_type, incident_datetime, location, description, supporting_files) 
                VALUES 
                (:reporter_name, :incident_type, :custom_incident_type, :incident_datetime, :location, :description, :supporting_files)";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':reporter_name', $reporterName);
            $stmt->bindParam(':incident_type', $incidentType);
            $stmt->bindParam(':custom_incident_type', $customIncidentType);
            $stmt->bindParam(':incident_datetime', $incidentDatetime);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':supporting_files', $supportingFiles, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                $successMessage = "Incident report successfully added.";
            } else {
                $errorMessage = "Failed to submit the incident report. Please try again.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report || Brgy. Official </title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        #logo-img {
            width: 100px;
            height: 100px;
            object-fit: scale-down;
            object-position: center center;
            border: 1px solid var(--bs-dark);
            border-radius: 50%;
        }
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border-bottom: none;
        }
        .header-text {
            text-align: center;
        }
        .action-btn {
            font-family: inherit;
            font-size: 17px;
            background: royalblue;
            color: white;
            padding: 0.5em 0.8em;
            display: flex;
            align-items: center;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
        }
        .action-btn:hover {
            background: #0056b3;
        }
        .status-badge {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 8px;
        }
        .modal-content {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }


        .submit-btn {
            position: relative;
            bottom: 0;
            right: 0;
            font-family: inherit;
            font-size: 17px;
            background: royalblue;
            color: white;
            padding: 0.5em 0.8em;
            display: flex;
            align-items: center;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s;
            cursor: pointer;
        }
        .submit-btn span {
            display: block;
            margin-left: 0.3em;
            transition: all 0.3s ease-in-out;
        }
        .submit-btn svg {
            display: block;
            transform-origin: center center;
            transition: transform 0.3s ease-in-out;
        }
        .submit-btn:hover .svg-wrapper {
            animation: fly-1 0.6s ease-in-out infinite alternate;
        }
        .submit-btn:hover svg {
            transform: translateX(1.2em) rotate(45deg) scale(1.1);
        }
        .submit-btn:hover span {
            transform: translateX(5em);
        }
        .submit-btn:active {
            transform: scale(0.95);
        }
        @keyframes fly-1 {
            from {
                transform: translateY(0.1em);
            }
            to {
                transform: translateY(-0.1em);
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Incident Reports</h2>
        <button type="button" class="btn btn-dark btn-sm py-1 rounded-0" data-bs-toggle="modal" data-bs-target="#incidentModal" id="addNewReportBtn">
            Add New
        </button>
    </div>


    <?php if ($successMessage): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($successMessage) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <?php if ($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($errorMessage) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table id="incidentTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th class="text-center">Incident Type</th>
                <th class="text-center">Date</th>
                <th class="text-center">Location</th>
                <th class="text-center">Description</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($incidents)): ?>
                <?php foreach ($incidents as $index => $incident): ?>
                    <tr>
                        <td><?= htmlspecialchars($index + 1) ?></td>
                        <td><?= htmlspecialchars($incident['reporter_name']) ?></td>
                        <td><?= htmlspecialchars($incident['incident_type'] ?: $incident['custom_incident_type']) ?></td>
                        <td><?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($incident['incident_datetime']))) ?></td>
                        <td><?= htmlspecialchars($incident['location']) ?></td>
                        <td><?= htmlspecialchars($incident['description']) ?></td>
                        <td class="d-flex justify-content-center">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionDropdown<?= $incident['incident_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionDropdown<?= $incident['incident_id'] ?>">
                                <!-- Edit Action -->
                                <!-- <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#incidentModal" 
                                        data-id="<?= $incident['incident_id'] ?>"
                                        data-name="<?= $incident['reporter_name'] ?>"
                                        data-type="<?= $incident['incident_type'] ?: $incident['custom_incident_type'] ?>"
                                        data-datetime="<?= $incident['incident_datetime'] ?>"
                                        data-location="<?= $incident['location'] ?>"
                                        data-description="<?= $incident['description'] ?>"
                                        onclick="populateEditForm(this)">
                                        Edit
                                    </a>
                                </li> -->
                                <!-- Delete Action -->
                                 <li>
                                 <a class="dropdown-item" href="#" id="viewButton" data-bs-toggle="modal" data-bs-target="#incidentReportModal">
                                    View
                                </a>

                                 </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                        data-id="<?= $incident['incident_id'] ?>"
                                        data-name="<?= $incident['reporter_name'] ?>"
                                        data-type="<?= $incident['incident_type'] ?: $incident['custom_incident_type'] ?>"
                                        onclick="setDeleteDetails(this)">
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No incidents reported yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="incidentReportModal" tabindex="-1" aria-labelledby="incidentReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Logo -->
                    <img
                    style="position: absolute;
                    top:20;
                    right: 600px;"

                     id="logo-img" src="logo/<?= htmlspecialchars($barangay_logo) ?>" alt="Barangay Logo" class="logo">
                    
                    <!-- Text -->
                    <div class="header-text text-center">
                        <h5 class="fw-bold mb-1">REPUBLIC OF THE PHILIPPINES</h5>
                        <h6 class="fw-semibold mb-1">PROVINCE OF <?= htmlspecialchars($province_name) ?></h6>
                        <p class="mb-1"><?= htmlspecialchars($city_name) ?></p>
                        <p class="fw-semibold mb-0"><?= htmlspecialchars($barangay_name) ?></p>
                    </div>
                </div>
                <div class="modal-body">
                    <!-- Full-width horizontal line -->
                    <hr class="full-width">

                    <!-- Section Header -->
                    <h6 class="text-center">INCIDENTS MONITORED</h6>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 30%;">DATE OF INCIDENT</th>
                                    <td><?= htmlspecialchars($date_of_incident) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">TIME OF INCIDENT</th>
                                    <td><?= htmlspecialchars($time_of_incident) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">LOCATION OF INCIDENT</th>
                                    <td><?= htmlspecialchars($location) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">INCIDENT TYPE</th>
                                    <td><?= htmlspecialchars($incident_type) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">DATE ISSUED</th>
                                    <td><?= htmlspecialchars($date_issued) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">TIME ISSUED</th>
                                    <td><?= htmlspecialchars($time_issued) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">INCIDENT DESCRIPTION</th>
                                    <td><?= nl2br(htmlspecialchars($description)) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">SUPPORTING IMAGES</th>
                                    <td>
                                        <?php if (!empty($supporting_files)): ?>
                                            <div class="d-flex flex-wrap gap-3">
                                                <?php foreach ($supporting_files as $file): ?>
                                                    <img src="uploads/<?= htmlspecialchars($file['supporting_files']) ?>" 
                                                        alt="Supporting Image" 
                                                        class="img-thumbnail" 
                                                        style="width: 150px; height: 150px; object-fit: cover;">
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <p>No supporting images available.</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-auto me-1">
                        <button class="btn btn-sm btn-success rounded-0" id='print_data' type="button"><i class="fa fa-print"></i> Print</button>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal for Add/Edit Resource -->
<div class="modal fade" id="incidentModal" tabindex="-1" aria-labelledby="incidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incidentModalLabel">Submit an Incident Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="incidentForm" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="reporterName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="reporter_name" id="reporterName" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label for="incidentType" class="form-label">Incident Type</label>
                        <select class="form-select" name="incident_type" id="incidentType" required>
                            <option value="">Choose...</option>
                            <option value="drought">Drought</option>
                            <option value="earthquake">Earthquake</option>
                            <option value="extreme-heat">Extreme Heat</option>
                            <option value="flood">Flood</option>
                            <option value="fire">Fire</option>
                            <option value="heavy-rainfall">Heavy Rainfall</option>
                            <option value="landslide">Landslide</option>
                            <option value="storm-surge">Storm Surge</option>
                            <option value="tsunami">Tsunami</option>
                            <option value="typhoon">Typhoon</option>
                            <option value="volcanic-eruption">Volcanic Eruption</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3" id="otherIncidentTypeDiv" style="display: none;">
                        <label for="customIncidentType" class="form-label">Specify Other Incident Type</label>
                        <input type="text" class="form-control" name="custom_incident_type" id="customIncidentType" placeholder="Enter the incident type">
                    </div>

                    <div class="mb-3">
                        <label for="incidentDatetime" class="form-label">Date and Time of Incident</label>
                        <input type="datetime-local" class="form-control" name="incident_datetime" id="incidentDatetime" required>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" placeholder="Enter the location of the incident" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Incident Description</label>
                        <textarea class="form-control" name="description" id="description" rows="2" placeholder="Describe the incident in detail" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="supportingFiles" class="form-label">Upload Supporting Files</label>
                        <input type="file" class="form-control" name="supporting_files" id="supportingFiles" multiple>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="submit-btn">
                            <div class="svg-wrapper-1">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                    </svg>
                                </div>
                            </div>
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Confirm Deletion -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="confirmDeleteMessage">
                Are you sure you want to delete this incident report?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" id="deleteForm">
                    <input type="hidden" name="delete_id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        $('#incidentTable').DataTable();

        $('#incidentType').on('change', function () {
            if ($(this).val() === 'other') {
                $('#otherIncidentTypeDiv').show();
            } else {
                $('#otherIncidentTypeDiv').hide();
                $('#customIncidentType').val('');
            }
        });
    });
</script>

<script>
    document.getElementById('incidentType').addEventListener('change', function () {
        const otherIncidentTypeDiv = document.getElementById('otherIncidentTypeDiv');
        if (this.value === 'other') {
            otherIncidentTypeDiv.style.display = 'block';
            document.getElementById('customIncidentType').required = true;
        } else {
            otherIncidentTypeDiv.style.display = 'none';
            document.getElementById('customIncidentType').required = false;
        }
    });
</script>

<script>
    function setDeleteDetails(button) {
        const incidentId = button.getAttribute('data-id');
        document.getElementById('deleteId').value = incidentId;
    }
</script>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('print_data').addEventListener('click', function () {
                var modalContent = document.querySelector('.modal-content').cloneNode(true);
                var printWindow = window.open('', '_blank', 'width=1000,height=900,top=50,left=250');
                printWindow.document.write(`<!DOCTYPE html>
                    <html>
                        <head>
                            <title>Incident Report</title>
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
                            <style>
                                body { font-family: Arial, sans-serif; }
                                .modal-header {   justify-content: center; text-align: center; border-bottom: none; }
                                .modal-footer { display: none; }
                            </style>
                        </head>
                        <body>
                            <div class="container mt-5">
                                ${modalContent.outerHTML}
                            </div>
                        </body>
                    </html>`);
                printWindow.document.close();
                setTimeout(function () {
                    printWindow.print();
                    setTimeout(function () {
                        printWindow.close();
                    }, 200);
                }, 500);
            });
        });
    </script>
    
</body>
</html>
