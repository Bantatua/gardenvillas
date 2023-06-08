<?php
session_start();
require('../configs/config.php');

// Check if the user is authenticated
if (!isset($_SESSION['user_role'])) {
  // User is not logged in, redirect to the login page
  header("Location: index.php");
  exit;
}

// Get the user's role from the session
$userRole = $_SESSION['user_role'];

// Define the sidebar links based on user roles
$sidebarLinks = array(
    'president' => array(
        'dashboard.php' => array(
            'icon' => 'bx bx-grid-alt',
            'label' => 'Dashboard'
        ),
        'residents.php' => array(
            'icon' => 'bx bx-user',
            'label' => 'Residents'
        ),
        'meeting_records.php' => array(
            'icon' => 'bx bx-file',
            'label' => 'Meeting Records'
        ),
        'booking.php' => array(
            'icon' => 'bx bx-calendar',
            'label' => 'Booking'
        ),
        'account.php' => array(
            'icon' => 'bx bxs-user-account',
            'label' => 'Account'
        ),
        'logout.php' => array(
            'icon' => 'bx bx-power-off',
            'label' => 'Logout'
        )
        ),
    
  'vicepresident' => array(
    'dashboard.php' => array(
      'icon' => 'bx bx-grid-alt',
      'label' => 'Dashboard'
    ),
    'financial_reports.php' => array(
      'icon' => 'bx bx-chart',
      'label' => 'Financial Reports'
    ),
    'account.php' => array(
      'icon' => 'bx bxs-user-account',
      'label' => 'Account'
    ),
    'logout.php' => array(
      'icon' => 'bx bx-power-off',
      'label' => 'Logout'
    )
  ),
  'secretary' => array(
    'dashboard.php' => array(
      'icon' => 'bx bx-grid-alt',
      'label' => 'Dashboard'
    ),
    'meeting_records.php' => array(
      'icon' => 'bx bx-file',
      'label' => 'Meeting Records'
    ),
    'residents.php' => array(
      'icon' => 'bx bx-user',
      'label' => 'Residents'
    ),
    'account.php' => array(
      'icon' => 'bx bxs-user-account',
      'label' => 'Account'
    ),
    'logout.php' => array(
      'icon' => 'bx bx-power-off',
      'label' => 'Logout'
    )
  )
);

// Function to generate sidebar links based on user role
function generateSidebarLinks($links)
{
  global $userRole;
  $output = '';
  foreach ($links[$userRole] as $url => $link) {
    $activeClass = '';
    if (basename($_SERVER['PHP_SELF']) === $url) {
      $activeClass = 'active';
    }
    $output .= '<li class="nav-item">
        <a href="' . $url . '" class="nav-link ' . $userRole . ' ' . $activeClass . '">
          <i class="' . $link['icon'] . '"></i>
          <span class="links_name">' . $link['label'] . '</span>
        </a>
      </li>';
  }
  return $output;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Bootstrap JS (required dependencies) -->


  <link rel="stylesheet" type="text/css" href="../calendar.css">
  <link rel="stylesheet" href="side.css">

  <title>Booking</title>
</head>
<body>
<div class="sidenav">
    <div class="logo-details">
      <i class="bx bx-home"></i>
      <span class="logo_name">Garden Villas III</span>
    </div>
    <ul class="nav flex-column">
    <?php echo generateSidebarLinks($sidebarLinks); ?>
  </ul>
  </div>
  <div class="home-section">
  <i class="bx bx-menu" id="btn"></i>
  <div class="text fw-bold" style="margin-left: 70px; margin-top:25px"><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></div>
  <div id="calendar">
        <div class="month">
            <ul>
                <li class="prev">&#10094;</li>
                <li class="next">&#10095;</li>
                <li>June 2023</li>
            </ul>
        </div>

        <ul class="weekdays">
            <li>Monday</li>
            <li>Tuesday</li>
            <li>Wednesday</li>
            <li>Thursday</li>
            <li>Friday</li>
            <li>Saturday</li>
            <li>Sunday</li>
        </ul>

        <ul class="days">
            <!-- Days of the month will be populated here -->
        </ul>
    </div>

    <!-- Booking request form -->
    <div id="booking-form">
        <h2>Make a Booking Request</h2>
        <form action="process_booking.php" method="POST">
            <label for="start-date">Start Date:</label>
            <input type="date" name="start_date" id="start-date" required><br>

            <label for="end-date">End Date:</label>
            <input type="date" name="end_date" id="end-date" required><br>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required><br>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea><br>

            <input type="submit" value="Submit">
        </form>
    </div>





</div>
<script>
    
   let sidebar = document.querySelector(".sidenav");
let menuBtn = document.querySelector("#btn");

menuBtn.addEventListener("click", () => {
  sidebar.classList.toggle("minimized");
  menuBtnChange();
});

function menuBtnChange() {
  if (sidebar.classList.contains("minimized")) {
    menuBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else {
    menuBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
}


 </script>
  
</body>
</html>