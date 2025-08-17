
<?php require_once __DIR__ . '/../includes/auth.php'; require_role('Auditor'); include __DIR__ . '/../includes/header.php';
$duplicates = $pdo->query("SELECT firstname, lastname, COUNT(*) c FROM employees GROUP BY firstname, lastname HAVING c>1")->fetchAll();
$missing = $pdo->query("SELECT * FROM employees WHERE hire_date IS NULL OR hire_date='0000-00-00'")->fetchAll();
$dup_contact = $pdo->query("SELECT phone,email,COUNT(*) c FROM employees GROUP BY phone,email HAVING c>1")->fetchAll();
?>
<h3>Auditor Reports</h3>
<div class="card p-3 mb-3"><h5>Duplicate Names</h5><?php if(!$duplicates) echo '<div class="text-muted">None</div>'; else foreach($duplicates as $d) echo '<div>'.htmlspecialchars($d['firstname'].' '.$d['lastname']).' ('.$d['c'].')</div>'; ?></div>
<div class="card p-3 mb-3"><h5>Missing Hire Date</h5><?php if(!$missing) echo '<div class="text-muted">None</div>'; else foreach($missing as $m) echo '<div>'.htmlspecialchars($m['staff_no'].' - '.$m['firstname'].' '.$m['lastname']).'</div>'; ?></div>
<div class="card p-3 mb-3"><h5>Duplicate Contacts</h5><?php if(!$dup_contact) echo '<div class="text-muted">None</div>'; else foreach($dup_contact as $d) echo '<div>'.htmlspecialchars($d['phone'].' / '.$d['email']).' ('.$d['c'].')</div>'; ?></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>