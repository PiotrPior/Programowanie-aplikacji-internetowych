<?php
session_start();

// Sprawdzenie czy użytkownik jest zalogowany
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit;
}

$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Apple Style</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="apple-dashboard">
        <!-- Sidebar Navigation -->
        <nav class="apple-sidebar">
            <div class="sidebar-header">
                <div class="apple-logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18.71 19.5C17.88 20.74 17 21.95 15.66 21.97C14.32 22 13.89 21.18 12.37 21.18C10.84 21.18 10.37 21.95 9.09997 22C7.78997 22.05 6.79997 20.68 5.95997 19.47C4.24997 16.96 2.93997 11.69 5.82997 8.58C6.76997 7.53 8.09997 6.95 9.42997 6.95C10.78 6.95 11.9 7.53 12.9 7.53C13.85 7.53 15.32 6.91 16.67 7.27C17.47 7.46 18.87 7.92 19.77 9.12C19.64 9.2 17.49 10.42 17.51 12.94C17.54 16.02 20.19 16.9 20.26 16.92C20.22 17.04 19.75 18.55 18.71 19.5ZM13 3.5C13.73 2.67 14.94 2.04 15.94 2C16.07 3.17 15.6 4.35 14.9 5.19C14.21 6.04 13.07 6.7 11.95 6.61C11.8 5.46 12.36 4.26 13 3.5Z" fill="currentColor"/>
                    </svg>
                </div>
                <h2>Dashboard</h2>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Overview</span>
                </li>
                <li class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </li>
                <li class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </li>
                <li class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </li>
                <li class="menu-item">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                    <span class="notification-badge">3</span>
                </li>
            </ul>
            
            <div class="user-profile">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                    <strong><?php echo htmlspecialchars($username); ?></strong>
                    <span>Administrator</span>
                </div>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="apple-main">
            <header class="main-header">
                <div class="header-left">
                    <h1>Welcome back, <?php echo htmlspecialchars($username); ?>! 👋</h1>
                    <p>Here's what's happening with your account today.</p>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                    <div class="header-actions">
                        <button class="action-btn">
                            <i class="fas fa-plus"></i>
                            New Project
                        </button>
                    </div>
                </div>
            </header>

            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3>24.5K</h3>
                        <p>Page Views</p>
                        <span class="stat-trend positive">+12.4%</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>1,248</h3>
                        <p>Active Users</p>
                        <span class="stat-trend positive">+8.2%</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <h3>324</h3>
                        <p>New Orders</p>
                        <span class="stat-trend positive">+5.7%</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-content">
                        <h3>$12,847</h3>
                        <p>Revenue</p>
                        <span class="stat-trend negative">-2.3%</span>
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Performance Metrics</h3>
                        <select class="chart-filter">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>User Activity</h3>
                        <select class="chart-filter">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </section>

            <!-- Recent Activity -->
            <section class="recent-activity">
                <div class="activity-card">
                    <div class="card-header">
                        <h3>Recent Activity</h3>
                        <a href="#" class="view-all">View All</a>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>New user registration</strong></p>
                                <span>5 minutes ago</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>New order #2841</strong></p>
                                <span>1 hour ago</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Monthly report generated</strong></p>
                                <span>2 hours ago</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>System settings updated</strong></p>
                                <span>4 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="dashboard.js"></script>
</body>
</html>