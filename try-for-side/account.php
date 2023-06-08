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
            'label' => 'Pending Account'
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


  <link rel="stylesheet" type="text/css" href="../dashboard.css">
  <link rel="stylesheet" href="side.css">

  <title>Dashboard</title>
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

  <div class="container">
    <h2>Pending Registrations</h2>

    <?php
      // Database connection parameters
      $servername = "localhost";
      $dbname = "gardenvillas_db";
      $username = "root";
      $password = "";

      try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      
        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch pending registrations from the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE status = 'Pending'");
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) > 0) {
          echo '<table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>House Ownership Type</th>
                <th>Block</th>
                <th>Lot</th>
                <th>Username</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';

          foreach ($result as $row) {
            $userId = $row['id'];
            $name = $row['name'];
            $ownershipType = $row['house_ownership_type'];
            $block = $row['block'];
            $lot=$row['lot'];
            $username = $row['username'];

            echo '<tr>
              <td>' . $name . '</td>
              <td>' . $ownershipType . '</td>
              <td>' . $block . '</td>
              <td>' . $lot . '</td>

              <td>' . $username . '</td>
              <td>
                <form method="POST" action="../resident-side/approve_registration.php">
                  <input type="hidden" name="user_id" value="' . $userId . '">
                  <button type="submit" name="approve" class="btn btn-success">Approve</button>
                  <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                </form>
              </td>
            </tr>';
          }

          echo '</tbody></table>';
        } else {
          echo "No pending registrations.";
        }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

      // Close the database connection
      $conn = null;
    ?>

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