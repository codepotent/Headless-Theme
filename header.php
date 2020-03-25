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
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
