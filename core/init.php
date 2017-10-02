<?php

// Error Reporting - Production Value
// error_reporting(0);

// Error Reporting - Development Value
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Date and Time
date_default_timezone_set("Australia/Sydney");

// Database Connection
require 'database/connect.php';

// Functions
require 'functions/general.php';

// Session Start
session_start();

