<!DOCTYPE html>
<html lang="en">
  

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="table.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

  <?php
  session_start();
  require('../configs/config.php');


  // Check if user is authenticated
  if (!isset($_SESSION['user_role'])) {
    // User is not logged in, redirect to the login page
    header("Location: index.php");
    exit;
  }

  // Get the user's role from the session
  $userRole = $_SESSION['user_role'];

  // Define sidebar links based on user roles
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
    foreach ($links as $url => $link) {
      $activeClass = '';
      if (basename($_SERVER['PHP_SELF']) === $url) {
        $activeClass = 'active';
      }
      $output .= '<li class="' . $activeClass . '"><a href="' . $url . '"><i class="' . $link['icon'] . '"></i><span class="links_name">' . $link['label'] . '</span></a></li>';
    }
    return $output;
  }

  ?>

  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-home'></i>
      <div class="logo_name">Garden Villas III</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <?php echo generateSidebarLinks($sidebarLinks[$userRole]); ?>
    </ul>
    <div class="role-name">
      <span class="role"><?php echo ucfirst($userRole); ?></span>
    </div>
  </div>
  <div class="home-section">
   
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.min.js"></script>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search icon
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the icons class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the icons class
      }
    }
  </script>
</body>

</html>
