
<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/db.php';

function require_login() {
    if (!isset($_SESSION['user_type'])) {
        header('Location: /personnel_system_enterprise/index.php'); exit;
    }
}

function require_role($role) {
    if (!isset($_SESSION['role'])) { header('Location: /personnel_system_enterprise/index.php'); exit; }
    if ($_SESSION['role'] !== $role && $_SESSION['role'] !== 'Admin') {
        http_response_code(403); echo '<h3>Forbidden</h3>'; exit;
    }
}

function audit_log($pdo, $user_type, $user_id, $action, $target_table = null, $target_id = null) {
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $stmt = $pdo->prepare('INSERT INTO audit_log (user_type, user_id, action, target_table, target_id, ip_address) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$user_type, $user_id, $action, $target_table, $target_id, $ip]);
    } catch (Exception $e) {
        // silent fail
    }
}
?>