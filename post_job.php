<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '../db_connect.php';

if ($_POST) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $expiry_date = $_POST['expiry_date'];
    $application_email = $_POST['application_email'];
    $application_link = $_POST['application_link'];
    $job_image = $_POST['job_image'];
    $original_link = $_POST['original_link'];
    $requirements = $_POST['requirements'];
    
    $sql = "INSERT INTO jobs (title, description, company, location, expiry_date, application_email, application_link, job_image, original_link, requirements) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $company, $location, $expiry_date, $application_email, $application_link, $job_image, $original_link, $requirements]);
    
    $success = "Job posted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post New Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Job Board Admin</a>
            <a href="../index.php" class="btn btn-light">View Website</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Post New Job</h1>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Job Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Company *</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Location *</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Expiry Date *</label>
                        <input type="date" name="expiry_date" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label>Job Description *</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label>Requirements (Education, Experience, etc.)</label>
                <textarea name="requirements" class="form-control" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Application Email</label>
                        <input type="email" name="application_email" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Application Link</label>
                        <input type="url" name="application_link" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Job Image URL</label>
                        <input type="url" name="job_image" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label>Original Advertisement URL</label>
                        <input type="url" name="original_link" class="form-control">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Post Job</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>