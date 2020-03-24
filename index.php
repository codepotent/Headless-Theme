<?php

// Declare the namespace.
namespace CodePotent\Headless;

// Prevent direct access.
if (!defined('ABSPATH')) {
	die();
}

// Handle redirects.
if ($_SERVER['REQUEST_URI'] !== get_site_url(null, '', 'relative').'/') {
	header('Location: '.site_url());
	exit;
}

// Print header.
get_header();

// Do any custom code here.

// Print footer.
get_footer();