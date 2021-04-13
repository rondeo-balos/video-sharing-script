<?php

require_once "./includes/config.php";
require_once "./includes/classes/Website.php";
require_once "./includes/classes/User.php";

$website = new Website($config);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php $website->title() ?> <?php $website->tagline() ?></title>
		<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
		<script src="./assets/jquery.min.js"></script>
		<script src="./assets/popper.min.js"></script>
		<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

			<!-- Brand/logo -->
			<a class="navbar-brand" href="#">
				<?php $website->title() ?>
			</a>

			<form class="form-inline ml-auto mr-auto" action="/action_page.php">
				<input class="form-control" type="text" placeholder="Search">
				<button class="btn btn-success" type="submit">Search</button>
			</form>

			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="#">Link 1</a>
				</li>
			</ul>

		</nav>