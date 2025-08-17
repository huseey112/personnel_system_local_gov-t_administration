
<?php require_once __DIR__ . '/../includes/db.php';
try{
  $pdo->exec("CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'Admin',
    fullname VARCHAR(150)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS employees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    staff_no VARCHAR(30) NOT NULL UNIQUE,
    firstname VARCHAR(100),
    lastname VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    phone VARCHAR(50),
    address VARCHAR(255),
    qualification VARCHAR(150),
    job_title VARCHAR(100),
    department_id INT,
    status VARCHAR(50) DEFAULT 'Active',
    password_hash VARCHAR(255),
    hire_date DATE,
    biometric_verified TINYINT(1) DEFAULT 0
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS leaves (
    leave_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT,
    leave_type VARCHAR(100),
    start_date DATE,
    end_date DATE,
    days INT,
    status VARCHAR(50) DEFAULT 'Pending',
    applied_date DATETIME,
    INDEX(emp_id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT,
    position VARCHAR(120),
    grade_level VARCHAR(50),
    start_date DATE,
    status VARCHAR(50) DEFAULT 'Active'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS salaries (
    salary_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT,
    basic DECIMAL(12,2) DEFAULT 0,
    allowances DECIMAL(12,2) DEFAULT 0,
    deductions DECIMAL(12,2) DEFAULT 0,
    effective_date DATE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  $pdo->exec("CREATE TABLE IF NOT EXISTS audit_log (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(20),
    user_id INT,
    action VARCHAR(255),
    target_table VARCHAR(100),
    target_id INT,
    ip_address VARCHAR(45),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

  // seed admin/auditor/personnel if not exists
  $c = $pdo->prepare('SELECT COUNT(*) FROM users WHERE username=?');
  $c->execute(['admin']); if($c->fetchColumn()==0){ $p = password_hash('Admin@123', PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO users (username,password,role,fullname) VALUES (?,?,?,?)')->execute(['admin',$p,'Admin','System Administrator']); }
  $c->execute(['auditor']); if($c->fetchColumn()==0){ $p = password_hash('Aud@123', PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO users (username,password,role,fullname) VALUES (?,?,?,?)')->execute(['auditor',$p,'Auditor','Audit Officer']); }
  $c->execute(['personnel']); if($c->fetchColumn()==0){ $p = password_hash('Pers@123', PASSWORD_DEFAULT); $pdo->prepare('INSERT INTO users (username,password,role,fullname) VALUES (?,?,?,?)')->execute(['personnel',$p,'Personnel','Personnel Officer']); }

  echo "Migration completed. Admin: admin/Admin@123, Auditor: auditor/Aud@123, Personnel: personnel/Pers@123";
} catch(Exception $e){ echo 'Migration error: '.$e->getMessage(); }
?>