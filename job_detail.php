<?php
include 'db_connect.php';

$job_id = $_GET['id'];
$sql = "SELECT * FROM jobs WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$job_id]);
$job = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $job['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Job Board</a>
        </div>
    </nav>

    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary">← Back to Jobs</a>
        
        <div class="card mt-3">
            <div class="card-body">
                <h1><?php echo $job['title']; ?></h1>
                <h4><?php echo $job['company']; ?> - <?php echo $job['location']; ?></h4>
                <p class="text-muted">Posted: <?php echo date('F j, Y', strtotime($job['post_date'])); ?></p>
                
                <h3 class="mt-4">Job Description</h3>
                <p><?php echo nl2br($job['description']); ?></p>
                
                <?php if ($job['requirements']): ?>
                    <h3>Requirements</h3>
                    <p><?php echo nl2br($job['requirements']); ?></p>
                <?php endif; ?>
                
                <?php if ($job['job_image']): ?>
                    <h3>Job Image</h3>
                    <img src="<?php echo $job['job_image']; ?>" class="img-fluid" style="max-width: 300px;">
                <?php endif; ?>
                
                <div class="bg-light p-4 mt-4">
                    <h3>How to Apply</h3>
                    <?php if ($job['application_email']): ?>
                        <p><strong>Email:</strong> <?php echo $job['application_email']; ?></p>
                    <?php endif; ?>
                    <?php if ($job['application_link']): ?>
                        <a href="<?php echo $job['application_link']; ?>" target="_blank" class="btn btn-success">Apply Online</a>
                    <?php endif; ?>
                    <?php if ($job['original_link']): ?>
                        <a href="<?php echo $job['original_link']; ?>" target="_blank" class="btn btn-outline-primary">View Original Advertisement</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>