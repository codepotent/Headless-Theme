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

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo('site_name'); ?></title>
<?php wp_head(); ?>
</head>
<body>
