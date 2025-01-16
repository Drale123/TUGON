<?php
// Include the database connection file
require 'dbconnect.php';

try {
    $resources = $pdo->query("SELECT * FROM resource_list ORDER BY resource_id ASC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$errorMessage = '';
$successMessage = '';

// Function to check if resource already exists
function resourceExists($pdo, $resourceName) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM resource_list WHERE resource_name = :resource_name");
    $stmt->execute([':resource_name' => $resourceName]);
    return $stmt->fetchColumn() > 0;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_id']) && !empty($_POST['update_id'])) {
        // Update existing resource
        $updateId = $_POST['update_id'];
        $updateName = $_POST['resource_name'];
        $updateAmount = (int)$_POST['resource_amount'];

        try {
            $stmt = $pdo->prepare("UPDATE resource_list SET resource_name = :resource_name, resource_amount = :resource_amount WHERE resource_id = :resource_id");
            $stmt->execute([
                ':resource_name' => $updateName,
                ':resource_amount' => $updateAmount,
                ':resource_id' => $updateId,
            ]);
            $successMessage = "Resource successfully updated!";
        } catch (PDOException $e) {
            $errorMessage = "Error updating resource: " . $e->getMessage();
        }
    } elseif (isset($_POST['resource_name'], $_POST['resource_amount'])) {
        // Add new resource
        $resourceName = $_POST['resource_name'];
        $resourceAmount = (int)$_POST['resource_amount'];

        if (resourceExists($pdo, $resourceName)) {
            $errorMessage = "Resource already exists.";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO resource_list (resource_name, resource_amount) VALUES (:resource_name, :resource_amount)");
                $stmt->execute([
                    ':resource_name' => $resourceName,
                    ':resource_amount' => $resourceAmount,
                ]);
                $successMessage = "Resource successfully added!";
            } catch (PDOException $e) {
                $errorMessage = "Error adding resource: " . $e->getMessage();
            }
        }
    } elseif (isset($_POST['delete_id'])) {
        // Delete resource
        $deleteId = $_POST['delete_id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM resource_list WHERE resource_id = :resource_id");
            $stmt->execute([':resource_id' => $deleteId]);
            $successMessage = "Resource successfully deleted.";
        } catch (PDOException $e) {
            $errorMessage = "Error deleting resource: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JavaScript Links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        /* Button styling */
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
        .action-btn span {
            display: block;
            margin-left: 0.3em;
            transition: all 0.3s ease-in-out;
        }
        .action-btn svg {
            display: block;
            transform-origin: center center;
            transition: transform 0.3s ease-in-out;
        }
        .action-btn:hover .svg-wrapper {
            animation: fly-1 0.6s ease-in-out infinite alternate;
        }
        .action-btn:hover svg {
            transform: translateX(1.2em) rotate(45deg) scale(1.1);
        }
        .action-btn:hover span {
            transform: translateX(5em);
        }
        .action-btn:active {
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
        .status-badge {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 8px;
        }
        .status-high { background-color: green; color: white; }
        .status-medium { background-color: orange; color: white; }
        .status-low { background-color: red; color: white; }
        .status-none { background-color: gray; color: white; }
        
        .modal-content {
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-title {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Resource Tracker</h2>
        
        <button type="button" class="btn btn-dark btn-sm py-1 rounded-0" data-bs-toggle="modal" data-bs-target="#resourceModal" id="addNewReportBtn">
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

   
    <table id="resourceTable" class="table table-striped table-bordered">
        <thead>
            <tr class="text-center" >
                <th class="text-center">#</th>
                <th class="text-center">Name of Resource</th>
                <th class="text-center">Amount in Stock</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th> <!-- New Actions Column -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resources as $resource): ?>
            <tr>
                <td><?= htmlspecialchars($resource['resource_id']) ?></td>
                <td><?= htmlspecialchars($resource['resource_name']) ?></td>
                <td ><?= htmlspecialchars($resource['resource_amount']) ?></td>
                <td class="text-center">
                    <?php
                    $amount = $resource['resource_amount'];
                    if ($amount > 800) {
                        echo '<span class="status-badge status-high">High Supply</span>';
                    } elseif ($amount > 400) {
                        echo '<span class="status-badge status-medium">Moderate Supply</span>';
                    } elseif ($amount > 0) {
                        echo '<span class="status-badge status-low">Low Supply</span>';
                    } else {
                        echo '<span class="status-badge status-none">No Supply</span>';
                    }
                    ?>
                </td>
                <!-- Actions Column -->
                <td class="d-flex justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionDropdown<?= $resource['resource_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="actionDropdown<?= $resource['resource_id'] ?>">
                            <!-- Edit Action -->
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resourceModal" 
                                data-id="<?= $resource['resource_id'] ?>"
                                data-name="<?= $resource['resource_name'] ?>"
                                data-amount="<?= $resource['resource_amount'] ?>"
                                onclick="populateEditForm(this)">
                                    Edit
                                </a>
                            </li>

                            <!-- Delete Action -->
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" 
                                    data-id="<?= $resource['resource_id'] ?>"
                                    data-name="<?= $resource['resource_name'] ?>"
                                    data-amount="<?= $resource['resource_amount'] ?>"
                                    onclick="setDeleteDetails(this)">
                                Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit Resource -->
<div class="modal fade" id="resourceModal" tabindex="-1" aria-labelledby="resourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resourceModalLabel">Add Resource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" id="update_id" name="update_id">
                    <div class="mb-3">
                        <label for="resource_name" class="form-label">Resource Name</label>
                        <input type="text" class="form-control" id="resource_name" name="resource_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="resource_amount" class="form-label">Resource Amount</label>
                        <input type="number" class="form-control" id="resource_amount" name="resource_amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Resource</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#resourceTable').DataTable();
    });


    function setDeleteDetails(button) {
        const incidentId = button.getAttribute('data-id');
        document.getElementById('deleteId').value = incidentId;
    }
</script>

<script>
    function populateEditForm(button) {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const amount = button.getAttribute('data-amount');

        // Populate the form fields
        document.getElementById('update_id').value = id;
        document.getElementById('resource_name').value = name;
        document.getElementById('resource_amount').value = amount;

        // Update the modal title
        document.getElementById('resourceModalLabel').textContent = "Edit Resource";
    }

    function resetForm() {
        document.getElementById('update_id').value = '';
        document.getElementById('resource_name').value = '';
        document.getElementById('resource_amount').value = '';
        document.getElementById('resourceModalLabel').textContent = "Add Resource";
    }
</script>


</body>
</html>
