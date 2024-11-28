<div id="notification" class="notification"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const notification = document.getElementById('notification');
    <?php if(isset($_SESSION['message'])): ?>
        notification.textContent = "<?php echo $_SESSION['message']; ?>";
        notification.classList.add("<?php echo $_SESSION['message_type']; ?>", "show");
        setTimeout(() => notification.classList.remove("show"), 3000); // Hide after 3 seconds
    <?php unset($_SESSION['message']); endif; ?>
});
</script>
