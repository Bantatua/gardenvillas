<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="index.css">

  <title>Document</title>
</head>
<body>
  <div class="sidenav">
    <div class="logo-details">
      <i class="bx bx-home"></i>
      <span class="logo_name">Garden Villas III</span>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="residents.php">
          <i class="bx bx-user"></i>
          <span class="links_name">Residents</span>
        </a>
        <span class="tooltip">Residents</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="calendar.php">
          <i class="bx bxs-calendar"></i>
          <span class="links_name">Calendar</span>
        </a>
        <span class="tooltip">Calendar</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="map.php">
          <i class="bx bx-map"></i>
          <span class="links_name">Map</span>
        </a>
        <span class="tooltip">Map</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="payment.php">
          <i class="bx bx-wallet"></i>
          <span class="links_name">Payments</span>
        </a>
        <span class="tooltip">Payments</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-admin.php">
          <i class="bx bx-user-plus"></i>
          <span class="links_name">Add admin</span>
        </a>
        <span class="tooltip">Add admin</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="account.php">
          <i class="bx bxs-user-account"></i>
          <span class="links_name">Account</span>
        </a>
        <span class="tooltip">Account</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="bx bx-power-off"></i>
          <span class="links_name">Logout</span>
        </a>
        <span class="tooltip">Logout</span>
      </li>
    </ul>
  </div>
  <div class="home-section">
  <i class="bx bx-menu" id="btn"></i>
  <div class="text fw-bold" style="margin-left: 70px; margin-top:25px"><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></div>
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