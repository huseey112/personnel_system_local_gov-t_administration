
<?php require_once __DIR__ . '/../includes/auth.php'; if($_SERVER['REQUEST_METHOD']!=='POST'){ header('Location: manage.php'); exit; } $emp_id=intval($_POST['emp_id']??0); if(!$emp_id) header('Location: manage.php');
try{ $pdo->exec("ALTER TABLE employees ADD COLUMN IF NOT EXISTS biometric_verified TINYINT(1) DEFAULT 0"); } catch(Exception $e) {}
$pdo->prepare('UPDATE employees SET biometric_verified=1 WHERE emp_id=?')->execute([$emp_id]); audit_log($pdo,'personnel',$_SESSION['user_id']??null,'biometric_verified','employees',$emp_id); header('Location: manage.php'); exit; ?>