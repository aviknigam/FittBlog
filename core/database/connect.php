<?php

$conn = mysqli_connect("localhost", "root", "", "fitness");

//  localhost
// Custom Error Message when downtime

if (!$conn) {
	die('<div style="font-size: 20px; font-weight: bold; text-align: center; margin-top: 100px;">Website is down at the moment. Please <a style="text-decoration: none;" href="https://www.fittblog.com" style="color:blue;">try again</a> after a few minutes. Error code: 001x</div>');
}


