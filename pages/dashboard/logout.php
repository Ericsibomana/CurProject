<?php
require_once __DIR__ . '/../../includes/init.php';

// Start and destroy the session
session_start();
session_unset();
session_destroy();

// Redirect to login page using site base URL
header('Location: ' . SITE_URL . '/admin/login.php');
exit;
?>
