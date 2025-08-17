
<?php require_once __DIR__ . '/../includes/auth.php'; if(!isset($_SESSION['role']) || ($_SESSION['role']!=='Personnel' && $_SESSION['role']!=='Admin')){ http_response_code(403); echo 'Forbidden'; exit; } include __DIR__ . '/../includes/header.php';
$emps = $pdo->query('SELECT emp_id, staff_no, firstname, lastname, job_title FROM employees ORDER BY emp_id DESC')->fetchAll();
?>
<h3>Personnel - Staff Management</h3>
<div class="card p-3"><table class="table"><thead><tr><th>#</th><th>Staff No</th><th>Name</th><th>Job</th><th>Biometric</th></tr></thead><tbody><?php foreach($emps as $e): ?><tr><td><?=$e['emp_id']?></td><td><?=htmlspecialchars($e['staff_no'])?></td><td><?=htmlspecialchars($e['firstname'].' '.$e['lastname'])?></td><td><?=htmlspecialchars($e['job_title'])?></td><td><form method="post" action="biometric_verify.php"><input type="hidden" name="emp_id" value="<?=$e['emp_id']?>"><button class="btn btn-sm btn-outline-primary">Verify</button></form></td></tr><?php endforeach; ?></tbody></table></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>