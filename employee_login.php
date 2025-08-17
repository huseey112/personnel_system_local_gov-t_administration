
<?php session_start(); require 'includes/db.php'; require 'includes/auth.php'; $error=''; if($_SERVER['REQUEST_METHOD']==='POST'){
  $email=trim($_POST['email']); $password=trim($_POST['password']);
  $stmt=$pdo->prepare('SELECT emp_id, firstname, lastname, password_hash, status FROM employees WHERE email=? LIMIT 1'); $stmt->execute([$email]); $emp=$stmt->fetch();
  if($emp && password_verify($password,$emp['password_hash']) && $emp['status']!=='Inactive'){ $_SESSION['emp_id']=$emp['emp_id']; $_SESSION['user_type']='employee'; $_SESSION['emp_name']=$emp['firstname'].' '.$emp['lastname']; audit_log($pdo,'employee',$emp['emp_id'],'employee_login'); header('Location: employee_dashboard.php'); exit; } else { $error='Invalid login or disabled.'; }
}
include 'includes/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-5"><div class="card p-4"><h4>Employee Login</h4><?php if($error) echo '<div class="alert alert-danger">'.htmlspecialchars($error).'</div>'; ?>
<form method="post"><div class="mb-3"><label>Email</label><input name="email" type="email" class="form-control" required></div><div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div><button class="btn btn-gold w-100">Sign in</button></form></div></div></div>
<?php include 'includes/footer.php'; ?>