
<?php session_start(); require 'includes/db.php'; require 'includes/auth.php'; if(!isset($_SESSION['emp_id'])) header('Location: employee_login.php'); $emp_id=$_SESSION['emp_id'];
$emp = $pdo->prepare('SELECT * FROM employees WHERE emp_id=?'); $emp->execute([$emp_id]); $e=$emp->fetch();
$leaves = $pdo->prepare('SELECT * FROM leaves WHERE emp_id=? ORDER BY leave_id DESC'); $leaves->execute([$emp_id]); $lv=$leaves->fetchAll();
include 'includes/header.php'; ?>
<h3>My Profile</h3>
<div class="row"><div class="col-md-6"><div class="card p-3"><p><strong>Name:</strong> <?=htmlspecialchars($e['firstname'].' '.$e['lastname'])?></p><p><strong>Staff No:</strong> <?=htmlspecialchars($e['staff_no'])?></p><p><strong>Email:</strong> <?=htmlspecialchars($e['email'])?></p></div></div>
<div class="col-md-6"><div class="card p-3"><h5>Leave Requests</h5><a class="btn btn-primary btn-sm mb-2" href="employee_leave_apply.php">Apply Leave</a>
<table class="table"><thead><tr><th>#</th><th>Type</th><th>From</th><th>To</th><th>Status</th></tr></thead><tbody><?php foreach($lv as $r): ?><tr><td><?=$r['leave_id']?></td><td><?=htmlspecialchars($r['leave_type'])?></td><td><?=htmlspecialchars($r['start_date'])?></td><td><?=htmlspecialchars($r['end_date'])?></td><td><?=htmlspecialchars($r['status'])?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
<?php include 'includes/footer.php'; ?>