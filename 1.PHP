<?php

include 'Login/config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="Login/style.css">

    <title>Login</title>
    
    <style>
        /* Popup Styles */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <div class="input-group">
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
        </div>
        <div class="input-group">
            <button name="submit" class="btn" onclick="showPopup('success')">Login</button>
        </div>
        <p class="login-register-text">Don't have an account? <a href="Login/register.php">Register Here</a>.</p>
    </form>
</div>

<!-- Success Popup -->
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="hidePopup('success')">&times;</span>
        <p>Login Successful!</p>
    </div>
</div>

<!-- Error Popup -->
<div id="errorPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="hidePopup('error')">&times;</span>
        <p>Woops! Email or Password is Wrong.</p>
    </div>
</div>

<script>
    // Function to show popups
    function showPopup(popupId) {
        var popup = document.getElementById(popupId + 'Popup');
        popup.style.display = 'block';
    }

    // Function to hide popups
    function hidePopup(popupId) {
        var popup = document.getElementById(popupId + 'Popup');
        popup.style.display = 'none';
    }
</script>

</body>
</html>
