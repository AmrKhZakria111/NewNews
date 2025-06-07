<?php
include 'db_connection.php';  
 
$sql = "SELECT id, username, email, role, status FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="AdminPanel.html">📊 Dashboard</a>
    <a href="manage_news.html">📰 Manage News</a>
    <a href="manage_user.php">👥 Manage Users</a>
    <a href="manage_massseges.html">✉️ User Messages</a>
    <div class="logout-btn">
      <a href="#">🔓 Logout</a>
    </div>
  </div>

  <div class="main-content">
    <h1>👥 Manage Users</h1>

    <div class="actions">
      <button class="btn btn-success add-btn"><i class="fas fa-user-plus"></i> Add User</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["role"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>
                        <a href='edit_user.php?id=" . $row["id"] . "' class='action-btn edit-btn'>Edit</a>
                        <a href='delete_user.php?id=" . $row["id"] . "' class='action-btn delete-btn'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>

<?php
$conn->close();
?>
