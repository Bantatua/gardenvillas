<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/css/bootstrap.min.css">
  <style>
body {
  background-image: url('garden.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

.container {
  width: 600px;
  margin: 0 auto;
  margin-top: 200px;
  text-align: center;
  color: #fff;
}

.card-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
}

.card {
  width: 300px;
  background-color: #f8f8f8;
  border: 1px solid #ccc;
  margin: 10px;
  cursor: pointer;
  border-radius: 10px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
}

.card-body {
  padding: 30px;
}

.card-title {
  font-size: 24px;
  margin-bottom: 20px;
  color: #333;
}

.btn-card {
  font-size: 18px;
  color: #333;
  text-decoration: none;
}

.btn-card:hover {
  text-decoration: none;
}
</STYLE>
</head>
<body>
  <div class="container">
    <div class="card-wrapper">
      <div class="card" onclick="window.location='./resident-side/login.php';">
        <div class="card-body">
          <h2 class="card-title">Resident Login</h2>
        </div>
      </div>
      <div class="card" onclick="window.location='./try-for-side/index.php';">
        <div class="card-body">
          <h2 class="card-title">Official Login</h2>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
