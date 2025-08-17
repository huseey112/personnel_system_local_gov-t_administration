
<?php
session_start();
require 'includes/db.php';
require 'includes/auth.php';
if(!isset($_SESSION['user_type'])) header('Location: index.php');
include 'includes/header.php';

$totalStaff = $pdo->query('SELECT COUNT(*) FROM employees')->fetchColumn();
$totalUsers = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$pendingLeaves = $pdo->query("SELECT COUNT(*) FROM leaves WHERE status='Pending'")->fetchColumn();

$recentLogins = $pdo->query("SELECT user_type, user_id, action, ip_address, created_at FROM audit_log WHERE action LIKE '%login%' ORDER BY created_at DESC LIMIT 6")->fetchAll();
?>
<h2>Dashboard</h2>
<div class="row g-3 mb-4">
  <div class="col-md-3"><div class="card p-3"><div class="stat-title">Employees</div><div class="stat-value"><?=number_format($totalStaff)?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div class="stat-title">System Users</div><div class="stat-value"><?=number_format($totalUsers)?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div class="stat-title">Pending Leaves</div><div class="stat-value"><?=number_format($pendingLeaves)?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div class="stat-title">Recent Logins</div>
    <?php foreach($recentLogins as $r): ?>
      <div class="small"><?=htmlspecialchars($r['user_type'])?> @ <?=htmlspecialchars($r['created_at'])?></div>
    <?php endforeach; ?>
  </div></div>
</div>
<?php include 'includes/footer.php'; ?>
