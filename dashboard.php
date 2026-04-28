<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$page = isset($_GET["page"]) ? $_GET["page"] : "home";

if ($page === "logout") {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Top Bar -->
<div class="topbar">
    <div class="logo">LOGO</div>
    <div class="user-name"><?php echo htmlspecialchars($username); ?></div>
</div>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Dashboard</h3>
        <a href="dashboard.php" class="<?php echo $page === 'home' ? 'active' : ''; ?>">Home</a>
        <a href="dashboard.php?page=reports" class="<?php echo $page === 'reports' ? 'active' : ''; ?>">Reports</a>
        <a href="dashboard.php?page=user" class="<?php echo $page === 'user' ? 'active' : ''; ?>">User</a>
        <a href="dashboard.php?page=logout" class="logout">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">

        <?php if ($page === "home"): ?>
            <h2>Welcome back!</h2>
            <div class="welcome-card">
                <strong>Hello, <?php echo htmlspecialchars($username); ?>!</strong>
                <p>Use the sidebar to navigate to Reports or your User profile.</p>
            </div>

        <?php elseif ($page === "reports"): ?>
            <h2>Reports</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3>Sales by Category</h3>
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-card">
                    <h3>Monthly Revenue</h3>
                    <canvas id="barChart"></canvas>
                </div>
            </div>

        <?php elseif ($page === "user"): ?>
            <h2>User</h2>
            <div class="user-card">
                <div class="avatar"><?php echo strtoupper(substr($username, 0, 1)); ?></div>
                <div class="user-field">
                    <span class="label">Username</span>
                    <span class="value"><?php echo htmlspecialchars($username); ?></span>
                </div>
                <div class="user-field">
                    <span class="label">Full Name</span>
                    <span class="value">John Doe</span>
                </div>
                <div class="user-field">
                    <span class="label">Email</span>
                    <span class="value">johndoe@example.com</span>
                </div>
                <div class="user-field">
                    <span class="label">Role</span>
                    <span class="value">Admin</span>
                </div>
                <div class="user-field">
                    <span class="label">Member Since</span>
                    <span class="value">January 2024</span>
                </div>
                <div class="user-field">
                    <span class="label">Status</span>
                    <span class="value" style="color:#16a34a;">Active</span>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php if ($page === "reports"): ?>
<script>
    new Chart(document.getElementById("pieChart"), {
        type: "pie",
        data: {
            labels: ["Electronics", "Clothing", "Food", "Books", "Other"],
            datasets: [{
                data: [35, 25, 20, 12, 8],
                backgroundColor: ["#4f46e5","#7c3aed","#a78bfa","#c4b5fd","#e0e7ff"]
            }]
        },
        options: { plugins: { legend: { position: "bottom" } } }
    });

    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: ["Jan","Feb","Mar","Apr","May","Jun"],
            datasets: [{
                label: "Revenue ($)",
                data: [12000, 19000, 14000, 22000, 17000, 25000],
                backgroundColor: "#4f46e5",
                borderRadius: 4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
<?php endif; ?>

</body>
</html>
