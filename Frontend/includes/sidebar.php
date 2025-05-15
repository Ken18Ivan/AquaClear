<!-- Sidebar -->
<div class="sidebar">
  <div class="profile-section">
    <img src="../assets/images/avatar.png" alt="Profile Picture" class="profile-picture">
    <h3 class="profile-name"><?php echo $_SESSION['username']; ?></h3>
    <p class="profile-role">Administrator</p>
  </div>
  <ul>
    <li><a href="dashboard.php" class="<?= $currentPage === 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-home"></i> Dashboard</a></li>
    <li><a href="crud.php" class="<?= $currentPage === 'crud.php' ? 'active' : '' ?>"><i class="fas fa-database"></i> Manage Data</a></li>
    <li><a href="feedback.php" class="<?= $currentPage === 'feedback.php' ? 'active' : '' ?>"><i class="fas fa-comment-dots"></i> Feedback</a></li>
    <li><a href="about.php" class="<?= $currentPage === 'about.php' ? 'active' : '' ?>"><i class="fas fa-info-circle"></i> About</a></li>
    <li><a href="contact.php" class="<?= $currentPage === 'contact.php' ? 'active' : '' ?>"><i class="fas fa-envelope"></i> Contact</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</div>
