
Computerized Personnel System - Enterprise (Bootstrap + RBAC + Audit Trail)
=========================================================================

Quick start (XAMPP):
1. Extract this folder to your web server root (e.g., C:\xampp\htdocs\personnel_system_enterprise).
2. Create a MySQL database and user or use root. Update includes/db.php with your DB credentials.
3. Visit http://localhost/personnel_system_enterprise/tools/migrate.php to create tables and seed default users.
   - Admin: username `admin`, password `Admin@123`
   - Auditor: username `auditor`, password `Aud@123`
   - Personnel: username `personnel`, password `Pers@123`
4. Login as Admin: http://localhost/personnel_system_enterprise/index.php
5. Employee portal: register/login via employee_register.php and employee_login.php

Security notes:
- This is a demo starter. Before production: enable HTTPS, set secure cookies, add CSRF protection, tighten input validation, and lock down file uploads.
