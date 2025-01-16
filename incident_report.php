<?php
require('dbconnect.php'); // Include the database connection file

$message = null; // Initialize message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $reporterName = $_POST['reporter_name'] ?? null;
    $incidentType = $_POST['incident_type'] ?? null;
    $customIncidentType = $_POST['custom_incident_type'] ?? null;
    $incidentDatetime = $_POST['incident_datetime'] ?? null;
    $location = $_POST['location'] ?? null;
    $description = $_POST['description'] ?? null;
    $filePath = null;

    // Handle file upload
    if (isset($_FILES['supporting_files']) && $_FILES['supporting_files']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['supporting_files']['tmp_name'];
        $fileName = basename($_FILES['supporting_files']['name']);
        $uploadFolder = 'uploads/'; // Define the upload folder
        $filePath = $uploadFolder . $fileName;

        if (!move_uploaded_file($fileTmpPath, $filePath)) {
            $message = "Failed to upload the supporting file.";
            $filePath = null;
        }
    }

    try {
        // Prepare an SQL query to insert data
        $query = "INSERT INTO incident_lists 
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
        $stmt->bindParam(':supporting_files', $filePath);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Your incident report has been successfully submitted!";
        } else {
            $message = "Failed to submit the incident report. Please try again.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report || Resident</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-box {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        .submit-btn {
            font-family: inherit;
            font-size: 17px;
            background: royalblue;
            color: white;
            padding: 0.5em 0.8em;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .submit-btn:hover {
            background: darkblue;
        }
        .alert {
            margin-bottom: 20px;
        }
        .submit-btn {
            position: absolute;
            bottom: 10px;
            right: 20px;
            font-family: inherit;
            font-size: 17px;
            background: royalblue;
            color: white;
            padding: 0.5em 0.8em;
            padding-left: 0.7em;
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
    <div class="form-box">
        <h2 class="mb-4 text-center">Submit an Incident Report</h2>
        <?php if ($message): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="reporterName" class="form-label">Your Name</label>
                <input type="text" class="form-control" name="reporter_name" id="reporterName" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label for="incidentType" class="form-label">Incident Type</label>
                <select class="form-select" name="incident_type" id="incidentType" required>
                    <option value="">Choose...</option>
                    <option value="Drought">Drought</option>
                    <option value="Earthquake">Earthquake</option>
                    <option value="Extreme Heat">Extreme Heat</option>
                    <option value="Flood">Flood</option>
                    <option value="Fire">Fire</option>
                    <option value="Heavy Rainfall">Heavy Rainfall</option>
                    <option value="Landslide">Landslide</option>
                    <option value="Storm Surge">Storm Surge</option>
                    <option value="Tsunami">Tsunami</option>
                    <option value="Typhoon">Typhoon</option>
                    <option value="Volcanic Eruption">Volcanic Eruption</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-3" id="otherIncidentTypeDiv" style="display: none;">
                <label for="otherIncidentType" class="form-label">Specify Other Incident Type</label>
                <input type="text" class="form-control" name="custom_incident_type" id="otherIncidentType" placeholder="Enter the incident type">
            </div>

            <div class="mb-3">
                <label for="incidentDateTime" class="form-label">Date and Time of Incident</label>
                <input type="datetime-local" class="form-control" name="incident_datetime" id="incidentDateTime" required>
            </div>

            <div class="mb-3">
                <label for="incidentLocation" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="incidentLocation" placeholder="Enter the location of the incident" required>
            </div>

            <div class="mb-3">
                <label for="incidentDescription" class="form-label">Incident Description</label>
                <textarea class="form-control" name="description" id="incidentDescription" rows="1" placeholder="Describe the incident in detail" required></textarea>
            </div>

            <div class="mb-5">
                <label for="incidentFile" class="form-label">Upload Supporting Files</label>
                <input type="file" class="form-control" name="supporting_files" id="incidentFile" multiple>
            </div>

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
        </form>
    </div>
</div>

<script>
    document.getElementById('incidentType').addEventListener('change', function () {
        const otherIncidentTypeDiv = document.getElementById('otherIncidentTypeDiv');
        if (this.value === 'Other') {
            otherIncidentTypeDiv.style.display = 'block';
            document.getElementById('otherIncidentType').required = true;
        } else {
            otherIncidentTypeDiv.style.display = 'none';
            document.getElementById('otherIncidentType').required = false;
        }
    });
</script>
</body>
</html>
