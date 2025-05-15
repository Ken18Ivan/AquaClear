<?php
// /Frontend/signup.php
$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart AquaClear | Sign Up</title>
  <!-- SweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
  <!-- Background video -->
  <video autoplay muted loop id="bg-video">
    <source src="assets/bg-water.mp4" type="video/mp4"/>
  </video>
  <div class="overlay"></div>

  <!-- Signup Form -->
  <div class="glass-container">
    <form action="../Backend/api/signup.php" method="POST" class="glass-form">
      <h2>Create Account</h2>
      <div class="form-group">
        <input type="text" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="text" name="full_name" placeholder="Full Name" required>
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn-submit">Sign Up</button>
      <p>Already have an account? <a href="login.html">Log in</a></p>
    </form>
  </div>

  <!-- SweetAlert2 Script -->
  <script>
    const status = "<?= $status ?>";
    if (status === "success") {
      Swal.fire({
        icon: 'success',
        title: 'Account Created',
        text: 'You can now log in.',
        confirmButtonText: 'Go to Login'
      }).then(() => {
        window.location.href = 'login.html';
      });
    } else if (status === "exists") {
      Swal.fire({
        icon: 'warning',
        title: 'Already Registered',
        text: 'That email or username is taken.'
      });
    } else if (status === "error") {
      Swal.fire({
        icon: 'error',
        title: 'Signup Failed',
        text: 'Please try again later.'
      });
    }
  </script>
</body>
</html>