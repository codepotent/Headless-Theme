<?php

/**
 * -----------------------------------------------------------------------------
 * Purpose: Core headless theme functions.
 * Copyright 2020, Code Potent, https://codepotent.com
 * -----------------------------------------------------------------------------
 */

// Declare the namespace.
namespace CodePotent\Headless;

// Prevent direct access.
if (!defined('ABSPATH')) {
	die();
}

// Load the primary class.
require_once('classes/Headless.class.php');

// Load the update class.
require_once('classes/UpdateClient.class.php');
