# Patient Management System


A web-based application for managing patient records, designed for healthcare professionals to efficiently handle patient data with search, add, and delete functionalities.

![Demo Screenshot](https://github.com/user-attachments/assets/3f7bcc82-816a-4890-9df4-28c75e7a9528) <!-- Replace with actual screenshot -->

## Features

- 🔍 Fuzzy search using Levenshtein distance algorithm
- ➕ Add new patients with validation
- 📋 View patient list with sorting
- 🗑️ Delete patients with confirmation
- 📱 Responsive design with Bootstrap
- 🔒 Input validation for names and file numbers
- 🔄 AJAX-based operations for smooth UX

## Technologies Used

- PHP 7.4+
- MySQL
- HTML5
- CSS3
- JavaScript (jQuery)
- Bootstrap 5.3

## Installation

1. **Requirements**
   - Web server (Apache/Nginx)
   - PHP 7.4+
   - MySQL 5.7+

2. **Database Setup**
   ```sql
   CREATE DATABASE patient_db;
   USE patient_db;
   
   CREATE TABLE patients (
     patient_id INT PRIMARY KEY AUTO_INCREMENT,
     first_name VARCHAR(50),
     second_name VARCHAR(50),
     last_name VARCHAR(50),
     file_number VARCHAR(20) UNIQUE
   );
   ```

3. **Configuration**
   - Create `db.php` with database credentials:
   ```php
   <?php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "patient_db";
   
   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   ?>
   ```

4. **Install Dependencies**
   - Bootstrap 5.3
   - jQuery 3.7
   - Place all files in your web server's root directory

## Usage

1. **Search Patients**
   - Visit `search.html`
   - Type full or partial patient name
   - Results update in real-time

2. **Add New Patient**
   - Navigate to `add-page.html`
   - Enter full name (2 or 3 parts)
   - Input unique file number
   - Click ADD button

3. **Manage Patients**
   - Access `data.php` to view all patients
   - Delete patients with confirmation dialog
   - Automatic sorting by first name

## Project Structure

```
patient-management-system/
├── data.php            # Main patient listing
├── search.php          # Search functionality
├── add-patient.php     # Patient creation handler
├── delete.php          # Patient deletion handler
├── db.php              # Database configuration
├── app.js              # Main application logic
├── search.html         # Search interface
├── add-page.html       # Add patient interface
├── data-style.css      # Listing page styles
├── search-style.css    # Search/add page styles
└── bootstrap-5.3.1-dist/ # Bootstrap files
```

## Dependencies

- [Bootstrap 5.3](https://getbootstrap.com/)
- [jQuery 3.7](https://jquery.com/)
- MySQL

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Acknowledgments

- Bootstrap team for responsive UI components
- jQuery team for JS utilities
- PHP community for server-side scripting capabilities
```
