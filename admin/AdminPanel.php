<?php
  require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/AdminPanel.css" />
  </head>
  <body>
    <div class="sidebar">
      <h2><a href="/newnews">New News</a></h2>
      <a href="AdminPanel.php">📊 Dashboard</a>
      <a href="manage_news.php">📰 Manage News</a>
      <a href="manage_user.php">👥 Manage Users</a>
      <a href="manage_message.php">✉️ User Messages</a>
      <div class="logout-btn">
        <a href="logout.php">🔓 Logout</a>
      </div>
    </div>

    <div class="main-content">
      <h1>📊 Dashboard</h1>

      <div class="dashboard-cards">
        <div class="card">
          <i class="fas fa-newspaper"></i>
          <h3>Total News</h3>
          <p>150 Articles</p>
        </div>
        <div class="card">
          <i class="fas fa-users"></i>
          <h3>Registered Users</h3>
          <p>1,200 Users</p>
        </div>
        <div class="card">
          <i class="fas fa-envelope"></i>
          <h3>New Messages</h3>
          <p>25 Messages</p>
        </div>
        <div class="card">
          <i class="fas fa-chart-line"></i>
          <h3>Site Visits</h3>
          <p>45,000 Visits</p>
        </div>
      </div>

      <div class="recent-activity">
        <h3>Recent Activity</h3>
        <ul class="activity-list">
          <li>📰 Admin added a new news article.</li>
          <li>👥 A new user registered.</li>
          <li>✉️ Admin replied to a user message.</li>
          <li>🔄 System update completed successfully.</li>
        </ul>
      </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>
</html>
