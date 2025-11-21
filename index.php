<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Job Board</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Find Your Dream Job</h1>
        
        <!-- Search Form -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="search" placeholder="Search by job title, company, or location..." 
                           class="form-control" value="<?php echo $_GET['search'] ?? ''; ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search Jobs</button>
                </div>
            </div>
        </form>

        <!-- Job Listings -->
        <?php
        $search = $_GET['search'] ?? '';
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if ($search) {
            $sql = "SELECT * FROM jobs WHERE title LIKE ? OR company LIKE ? OR location LIKE ? ORDER BY post_date DESC LIMIT $limit OFFSET $offset";
            $stmt = $pdo->prepare($sql);
            $search_term = "%$search%";
            $stmt->execute([$search_term, $search_term, $search_term]);
        } else {
            $sql = "SELECT * FROM jobs ORDER BY post_date DESC LIMIT $limit OFFSET $offset";
            $stmt = $pdo->query($sql);
        }
        
        $jobs = $stmt->fetchAll();
        
        foreach ($jobs as $job) {
            echo "
            <div class='card mb-3'>
                <div class='card-body'>
                    <h3>{$job['title']}</h3>
                    <p><strong>Company:</strong> {$job['company']}</p>
                    <p><strong>Location:</strong> {$job['location']}</p>
                    <p><strong>Posted:</strong> " . date('M j, Y', strtotime($job['post_date'])) . "</p>
                    <a href='job_detail.php?id={$job['id']}' class='btn btn-primary'>View Details</a>
                </div>
            </div>
            ";
        }

        // Pagination
        if ($search) {
            $count_sql = "SELECT COUNT(*) FROM jobs WHERE title LIKE ? OR company LIKE ? OR location LIKE ?";
            $count_stmt = $pdo->prepare($count_sql);
            $count_stmt->execute([$search_term, $search_term, $search_term]);
        } else {
            $count_sql = "SELECT COUNT(*) FROM jobs";
            $count_stmt = $pdo->query($count_sql);
        }
        $total_jobs = $count_stmt->fetchColumn();
        $total_pages = ceil($total_jobs / $limit);

        if ($total_pages > 1) {
            echo '<nav><ul class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active = $i == $page ? 'active' : '';
                echo "<li class='page-item $active'><a class='page-link' href='?page=$i&search=" . urlencode($search) . "'>$i</a></li>";
            }
            echo '</ul></nav>';
        }
        ?>
        
        <div class="mt-4">
            <a href="admin/login.php" class="btn btn-secondary">Admin Login</a>
        </div>
    </div>
</body>
</html>