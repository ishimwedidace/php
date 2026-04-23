<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">System Management</div>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="logiout.php">logout</a></li>
           
        </ul>
    </nav>
<div class="main-content">

<div class="sidebar">
    <h2><i class="bi bi-border-width"></i> Manage</h2>

    <a href="remove.php">
        <i class="bi bi-trash"></i> Remove Product
    </a>

    <a href="add.php">
        <i class="bi bi-plus-circle"></i> Add Product
    </a>

    <a href="report.php">
        <i class="bi bi-bar-chart"></i> Reports
    </a>

    <a href="settings.php">
        <i class="bi bi-gear-wide"></i> Settings
    </a>
</div>





    <!-- Welcome -->
    <div class="header">
        <h1>Welcome Back 👋</h1>
        <p>Manage your system </p>
    </div>

    <!-- Cards -->
    <div class="cards">

        <div class="card">
            <div class="icon">🛒</div>
            <h2>Stock out</h2>
            <p>Process and manage product sales quickly.</p>
            <button><a href="stockout.php">Open</a></button>
        </div>

        <div class="card">
            <div class="icon">➕</div>
            <h2>Stock in</h2>
            <p>Add and organize new products </p>
            <button><a href="stockin.php">Add</a></button>
        </div>

        <div class="card">
            <div class="icon">📊</div>
            <h2>Reports</h2>
            <p>Track performance and sales analytics.</p>
            <button><a href="report.php">View</a></button>
        </div>

    </div>



<footer class="footer">

    <div class="footer-container">
        

        <!-- Contact -->
        <div class="footer-section">
            <h3>Contact</h3>
          <h3> <p>Email: info@managesys.com</p></h3> 
           <h3>   <p>Phone: +250 788 000 000</p></h3> 
             <h3> <p>Location: Kigali, Rwanda</p></h3> 
        </div>

        <!-- Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="admin.php">Dashboard</a>
            <a href="report.php">Reports</a>
            <a href="setting.php">Settings</a>
        </div>

        <!-- Social Media -->
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    
 </div>
</footer>
 <!-- Bottom -->
    <div class="footer-bottom">
      <center><p>© 2026 ManageSys | All Rights Reserved</p></center>  
    
 </div>

 <?php
  include"connection.php";
  session_start();
  if(!isset($_POST['username'])){
    header("location:login.php");
  }
 ?>
</body>
</html>