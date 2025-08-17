
<?php
session_start();
require 'includes/db.php';
require 'includes/auth.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $username = trim($_POST['username']); $password = trim($_POST['password']);
  $stmt = $pdo->prepare('SELECT user_id, username, password, role, fullname FROM users WHERE username=? LIMIT 1');
  $stmt->execute([$username]); $u = $stmt->fetch();
  if($u && password_verify($password, $u['password'])){
    $_SESSION['user_id'] = $u['user_id']; $_SESSION['username']=$u['username']; $_SESSION['role']=$u['role']; $_SESSION['user_type']='admin';
    audit_log($pdo, 'admin', $u['user_id'], 'admin_login');
    header('Location: dashboard.php'); exit;
  } else { $error = 'Invalid credentials'; }
}
include 'includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card p-4 shadow-sm">
      <h4>Admin Login</h4>
      <?php if($error): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
      <form method="post">
        <div class="mb-3"><label>Username</label><input name="username" class="form-control" required></div>
        <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div>
        <button class="btn btn-gold w-100">Sign in</button>
      </form>
    </div>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
