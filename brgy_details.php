<?php
require_once 'dbconnect.php';

$successMessage = "";
$errorMessage = "";
$data_exists = false;

// Fetch existing data
try {
    $query = "SELECT * FROM brgy_detail LIMIT 1"; // Limit to one record for simplicity
    $stmt = $pdo->query($query);
    $barangay_data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($barangay_data) {
        $data_exists = true; // Set flag if data exists
    }
} catch (PDOException $e) {
    $errorMessage = "Error fetching data: " . $e->getMessage();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $barangay_name = $_POST['barangay_name'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'logo/' . basename($file_name);

    // Handle file upload
    if (!empty($file_name) && !move_uploaded_file($tempname, $folder)) {
        $errorMessage = "Failed to upload logo.";
    } else {
        try {
            if ($data_exists) {
                // Update the existing record
                $query = "UPDATE brgy_detail 
                          SET barangay_name = :barangay_name, 
                              city_name = :city_name, 
                              province_name = :province_name, 
                              barangay_logo = :barangay_logo 
                          WHERE barangay_id = :barangay_id";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':barangay_name' => $barangay_name,
                    ':city_name' => $city,
                    ':province_name' => $province,
                    ':barangay_logo' => $file_name ? $file_name : $barangay_data['barangay_logo'],
                    ':barangay_id' => $barangay_data['barangay_id'],
                ]);
                $successMessage = "Barangay details updated successfully.";
            } else {
                // Insert a new record
                $query = "INSERT INTO brgy_detail (barangay_name, city_name, province_name, barangay_logo) 
                          VALUES (:barangay_name, :city_name, :province_name, :barangay_logo)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':barangay_name' => $barangay_name,
                    ':city_name' => $city,
                    ':province_name' => $province,
                    ':barangay_logo' => $file_name,
                ]);
                $successMessage = "Barangay details saved successfully.";
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
    <title>Barangay and System Information Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="icon" type="image/x-icon" href="assets/img/logo.ico">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        #logo-img {
            width: 100px;
            height: 100px;
            object-fit: scale-down;
            background: var(--bs-light);
            object-position: center center;
            border: 1px solid var(--bs-dark);
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div class="container py-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Barangay Information</h3>
        </div>
        <div class="card-body">
            <!-- Display success or error messages -->
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

            <form id="sys-info" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="barangay_name" class="form-label">Barangay Name</label>
                    <input type="text" id="barangay_name" name="barangay_name" class="form-control" 
                           value="<?= $data_exists ? htmlspecialchars($barangay_data['barangay_name']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City/Municipality</label>
                    <input type="text" id="city" name="city" class="form-control" 
                           value="<?= $data_exists ? htmlspecialchars($barangay_data['city_name']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" id="province" name="province" class="form-control" 
                           value="<?= $data_exists ? htmlspecialchars($barangay_data['province_name']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" id="logo" name="image" class="form-control" accept="image/*">
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <?php
                    $query = "SELECT * FROM brgy_detail";
                    $stmt = $pdo->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <img src="logo/<?= htmlspecialchars($row['barangay_logo']) ?>" id="logo-img" alt="Logo">
                    <?php } ?>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
