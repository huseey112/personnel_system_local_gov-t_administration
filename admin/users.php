
<?php
require_once __DIR__ . '/../includes/auth.php'; require_role('Admin');
$stmt = $pdo->query('SELECT user_id, username, role, fullname FROM users ORDER BY user_id DESC'); $users=$stmt->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<h3>Users</h3>
<a class="btn btn-gold mb-3" href="user_add.php">Add User</a>
<div class="card p-3">
<table class="table"><thead><tr><th>ID</th><th>Username</th><th>Fullname</th><th>Role</th><th>Action</th></tr></thead><tbody>
<?php foreach($users as $u): ?><tr><td><?=$u['user_id']?></td><td><?=htmlspecialchars($u['username'])?></td><td><?=htmlspecialchars($u['fullname'])?></td><td><?=htmlspecialchars($u['role'])?></td>
<td><a class="btn btn-sm btn-outline-primary" href="user_edit.php?id=<?=$u['user_id']?>">Edit</a> <a class="btn btn-sm btn-outline-danger" href="user_delete.php?id=<?=$u['user_id']?>" onclick="return confirm('Delete?')">Delete</a></td></tr><?php endforeach; ?>
</tbody></table></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
