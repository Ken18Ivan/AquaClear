<footer id="footer" class="glass-footer py-4">
    <div class="container text-center">
        <p>&copy; <?php echo date("Y"); ?> Smart AquaClear. All Rights Reserved.</p>
        <p>Powered by Your Company Name</p>
        <div class="footer-links">
            <a href="privacy-policy.php">Privacy Policy</a> |
            <a href="terms.php">Terms of Service</a> |
            <a href="contact.php">Contact</a>
        </div>
    </div>
</footer>

<script>
    // Sidebar toggle
    const toggleSidebar = document.getElementById("toggleSidebar");
    if (toggleSidebar) {
        toggleSidebar.addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar");
            const mainContent = document.querySelector(".main-content");

            sidebar.classList.toggle("collapsed");
            mainContent.classList.toggle("expanded");
        });
    }

    // Profile dropdown
    const profileDropdown = document.getElementById("profileDropdown");
    if (profileDropdown) {
        profileDropdown.addEventListener("click", function (event) {
            event.stopPropagation();
            this.nextElementSibling.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            const dropdowns = document.querySelectorAll(".dropdown-menu");
            dropdowns.forEach(function (dropdown) {
                if (dropdown.classList.contains("show") && !dropdown.parentNode.contains(event.target)) {
                    dropdown.classList.remove("show");
                }
            });
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
