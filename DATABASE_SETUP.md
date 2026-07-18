# Moodle Database Setup Instructions

## Step 1: Access phpMyAdmin
1. Open browser and go to: `http://localhost/phpmyadmin/`
2. If prompted for username/password:
   - Username: `root`
   - Password: Try these common XAMPP passwords:
     - Leave empty (no password)
     - `root`
     - `xampp`
     - `admin`

## Step 2: Create Database
Once logged into phpMyAdmin:
1. Click "New" in the left sidebar
2. Database name: `moodle_clp`
3. Collation: `utf8mb4_unicode_ci`
4. Click "Create"

## Step 3: Moodle Installation
Go to `http://moodle-clp.local/` and use these settings:
- Database type: `MySQLi`
- Database host: `localhost`
- Database name: `moodle_clp`
- Database user: `root`
- Database password: (your MySQL root password)
- Tables prefix: `mdl_`
- Database port: `3306`
- Data directory: `C:\xampp\Moodle_clp_data`

## Alternative: Reset MySQL Root Password
If you don't know the root password:

1. Stop MySQL from XAMPP Control Panel
2. Open Command Prompt as Administrator
3. Run:
   ```
   cd C:\xampp\mysql\bin
   mysqld --skip-grant-tables
   ```
4. In another Command Prompt window:
   ```
   cd C:\xampp\mysql\bin
   mysql -u root
   ```
5. In MySQL prompt:
   ```sql
   FLUSH PRIVILEGES;
   ALTER USER 'root'@'localhost' IDENTIFIED BY '';
   -- or set a password:
   -- ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';
   EXIT;
   ```
6. Stop the MySQL process with --skip-grant-tables (Ctrl+C or Task Manager)
7. Start MySQL normally from XAMPP Control Panel
