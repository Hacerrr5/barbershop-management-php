# Appointment Management System (with AdminLTE)

This project is an appointment management system developed with PHP and MySQL, running **inside the AdminLTE template** for a modern and user-friendly interface.

---

## Features

- Modern and responsive admin dashboard (AdminLTE)
- Secure admin login and management
- Add, edit, and delete services
- Register and track customers
- Create and view appointments
- Mobile-friendly design

---

## Folder & File Structure

After downloading AdminLTE, **all your project files must be placed inside the main AdminLTE folder**:

```
/adminlte
│
├── adminlte/plugins/        # AdminLTE's JS/CSS plugins
├── adminlte/dist/           # AdminLTE's main CSS/JS files
├── config.php
├── index.php
├── login.php
├── logout.php
├── dashboard.php
├── customers.php
├── services.php
├── appointments.php
├── add_customer.php
├── add_service.php
├── add_appointment.php
├── edit_customer.php
├── edit_service.php
├── edit_appointment.php
├── datatable.sql
└── README.md
```
> **Note:** Place your PHP files and `datatable.sql` directly inside the AdminLTE main directory.

---

## Installation Steps

### 1. Download and Set Up AdminLTE

- Download the latest version of [AdminLTE](https://adminlte.io/).
- Place all AdminLTE files in the **adminlte/** folder on your server.
- Add your PHP files and `datatable.sql` into this folder as well.

### 2. Database Setup

- Import the `datatable.sql` file into your MySQL database using phpMyAdmin or the MySQL command line.
- This will create all necessary tables.

### 3. Database Connection

- Edit `config.php` with your own database credentials:

```php
<?php
$servername = "localhost";
$username = "YOUR_DB_USERNAME";
$password = "YOUR_DB_PASSWORD";
$dbname = "YOUR_DATABASE_NAME";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 4. Create an Initial Admin User

- Manually add an admin user to the `admins` table via phpMyAdmin.
- For security, always store passwords hashed.

### 5. Run the Project

- In your browser, go to `http://localhost/adminlte/`
- Log in and start using the appointment system!

---

## Notes

- **All PHP files and the system must run inside the AdminLTE directory.**
- Make sure your CSS and JS file paths for AdminLTE are correct in your PHP files.
- For production, use proper password hashing and session management.

---

## License

This project is open source and free for any use.

---

## Contact

For questions or contributions, open an issue or contact the maintainer.