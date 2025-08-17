
<?php require_once __DIR__ . '/../includes/auth.php'; require_role('Admin');
$msg=''; if($_SERVER['REQUEST_METHOD']==='POST'){ $username=trim($_POST['username']); $fullname=trim($_POST['fullname']); $role=$_POST['role']; $password=$_POST['password'];
if($username && $password){ $hash=password_hash($password, PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO users (username,password,role,fullname) VALUES (?,?,?,?)')->execute([$username,$hash,$role,$fullname]); audit_log($pdo,'admin',$_SESSION['user_id'],'create_user','users',$pdo->lastInsertId()); $msg='Created'; } }
include __DIR__ . '/../includes/header.php'; ?>
<h3>Add User</h3><?php if($msg) echo '<div class="alert alert-success">'.$msg.'</div>'; ?>
<form method="post" class="row g-3"><div class="col-md-4"><label>Username</label><input name="username" class="form-control" required></div>
<div class="col-md-4"><label>Fullname</label><input name="fullname" class="form-control"></div>
<div class="col-md-2"><label>Role</label><select name="role" class="form-select"><option>Admin</option><option>Auditor</option><option>Personnel</option></select></div>
<div class="col-md-2"><label>Password</label><input name="password" type="password" class="form-control" required></div>
<div class="col-12"><button class="btn btn-gold">Create</button></div></form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
