
<?php require_once __DIR__ . '/../includes/auth.php'; require_role('Admin'); $id=intval($_GET['id']??0); $msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){ $username=trim($_POST['username']); $fullname=trim($_POST['fullname']); $role=$_POST['role']; $pdo->prepare('UPDATE users SET username=?, role=?, fullname=? WHERE user_id=?')->execute([$username,$role,$fullname,$id]); if(!empty($_POST['password'])) $pdo->prepare('UPDATE users SET password=? WHERE user_id=?')->execute([password_hash($_POST['password'], PASSWORD_DEFAULT), $id]); audit_log($pdo,'admin',$_SESSION['user_id'],'edit_user','users',$id); $msg='Saved'; }
$user=$pdo->prepare('SELECT * FROM users WHERE user_id=?'); $user->execute([$id]); $u=$user->fetch(); include __DIR__ . '/../includes/header.php';
?>
<h3>Edit User</h3><?php if($msg) echo '<div class="alert alert-success">'.$msg.'</div>'; ?>
<form method="post" class="row g-3"><div class="col-md-4"><label>Username</label><input name="username" class="form-control" value="<?=htmlspecialchars($u['username'])?>" required></div>
<div class="col-md-4"><label>Fullname</label><input name="fullname" class="form-control" value="<?=htmlspecialchars($u['fullname'])?>"></div>
<div class="col-md-2"><label>Role</label><select name="role" class="form-select"><option <?= $u['role']=='Admin'?'selected':'' ?>>Admin</option><option <?= $u['role']=='Auditor'?'selected':'' ?>>Auditor</option><option <?= $u['role']=='Personnel'?'selected':'' ?>>Personnel</option></select></div>
<div class="col-md-2"><label>New password</label><input name="password" type="password" class="form-control"></div>
<div class="col-12"><button class="btn btn-gold">Save</button></div></form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
