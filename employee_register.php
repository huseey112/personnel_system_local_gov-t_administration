
<?php session_start(); require 'includes/db.php'; require 'includes/auth.php'; $error=''; if($_SERVER['REQUEST_METHOD']==='POST'){
  $staff_no=trim($_POST['staff_no']); $firstname=trim($_POST['firstname']); $lastname=trim($_POST['lastname']); $email=trim($_POST['email']); $password=trim($_POST['password']);
  if(!$staff_no || !$email || !$password){ $error='Please complete required fields.'; }
  else{
    $exists=$pdo->prepare('SELECT emp_id FROM employees WHERE staff_no=? OR email=?'); $exists->execute([$staff_no,$email]);
    if($exists->fetch()){ $error='Staff no or email already exists.'; }
    else{ $hash=password_hash($password,PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO employees (staff_no, firstname, lastname, email, status, password_hash) VALUES (?,?,?,?,"Active",?)')->execute([$staff_no,$firstname,$lastname,$email,$hash]); $id=$pdo->lastInsertId(); audit_log($pdo,'employee',$id,'employee_register'); $_SESSION['emp_id']=$id; $_SESSION['user_type']='employee'; header('Location: employee_dashboard.php'); exit; }
  }
}
include 'includes/header.php'; ?>
<div class="row justify-content-center"><div class="col-md-7"><div class="card p-4"><h4>Employee Register</h4><?php if($error) echo '<div class="alert alert-danger">'.htmlspecialchars($error).'</div>'; ?>
<form method="post" class="row g-3"><div class="col-md-4"><label>Staff No</label><input name="staff_no" class="form-control" required></div>
<div class="col-md-4"><label>First name</label><input name="firstname" class="form-control"></div>
<div class="col-md-4"><label>Last name</label><input name="lastname" class="form-control"></div>
<div class="col-md-6"><label>Email</label><input name="email" type="email" class="form-control" required></div>
<div class="col-md-6"><label>Password</label><input name="password" type="password" class="form-control" required></div>
<div class="col-12"><button class="btn btn-gold">Create Account</button></div></form></div></div></div>
<?php include 'includes/footer.php'; ?>