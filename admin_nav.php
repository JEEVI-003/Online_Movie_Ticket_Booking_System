<!-- admin_nav.php -->
<style>
  .admin-navbar {
    background-color: #1f1f1f;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
  }

  .admin-navbar .logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #4dc3ff;
  }

  .admin-navbar ul {
    list-style: none;
    display: flex;
    gap: 20px;
  }

  .admin-navbar ul li {
    display: inline;
  }

  .admin-navbar ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
  }

  .admin-navbar ul li a:hover {
    color: #4dc3ff;
  }

  @media (max-width: 768px) {
    .admin-navbar {
      flex-direction: column;
      align-items: flex-start;
    }

    .admin-navbar ul {
      flex-direction: column;
      width: 100%;
      margin-top: 10px;
    }

    .admin-navbar ul li {
      width: 100%;
    }
  }
</style>

<nav class="admin-navbar">
  <div class="logo">🎬 Admin Panel</div>
  <ul>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="manage_movies.php">Manage Movies</a></li>
    <li><a href="manage_bookings.php">Manage Bookings</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>
