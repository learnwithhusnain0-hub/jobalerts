<?php
session_start();

if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin123') {
    $_SESSION['admin'] = true;
    header('Location: post_job.php');
    exit;
} elseif ($_POST['username']) {
    $error = "Wrong username or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2>Admin Login</h2>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label>Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                
                <div class="mt-3 text-center">
                    <small>Demo: username: <strong>admin</strong>, password: <strong>admin123</strong></small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>