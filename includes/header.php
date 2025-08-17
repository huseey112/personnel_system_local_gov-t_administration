
<?php if(session_status()===PHP_SESSION_NONE) session_start(); ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personnel System Enterprise</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="/personnel_system_enterprise/assets/css/style.css" rel="stylesheet">
</head><body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/personnel_system_enterprise/dashboard.php">
      <div class="brand-badge">LG</div><div class="ms-2">LocalGov - Personnel</div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['role']) && $_SESSION['role']=='Admin'): ?>
          <li class="nav-item"><a class="nav-link" href="/personnel_system_enterprise/admin/users.php">Manage Users</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='employee'): ?>
          <li class="nav-item"><a class="nav-link" href="/personnel_system_enterprise/employee_dashboard.php">My Profile</a></li>
        <?php endif; ?>
        <?php if(isset($_SESSION['user_type'])||isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="/personnel_system_enterprise/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/personnel_system_enterprise/index.php">Admin Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid mt-4">
