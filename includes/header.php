<?php

require_once "./includes/config.php";
require_once "./includes/classes/Website.php";
require_once "./includes/classes/User.php";
require_once "./includes/classes/Recommended.php";

$website = new Website($config);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php $website->title() ?> <?php $website->tagline() ?></title>
		<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/font-awesome/css/fontawesome.css">
		<script src="./assets/jquery.min.js"></script>
		<script src="./assets/popper.min.js"></script>
		<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="./assets/font-awesome/js/fontawesome.min.js"></script>
		<style type="text/css">
			#content{
				margin-top: 100px;
			}
			.bg-dark{
				background-color: <?php $website->navbar_color() ?> !important;
			}
			.navbar-brand{
				color: <?php $website->title_color() ?> !important;
			}
			.nav-link{
				color: <?php $website->menu_color() ?> !important;
			}
			.modal-header{
				color: #fff;
				background-color: <?php $website->primary_color() ?> !important;
			}
			.btn{
				background-color: <?php $website->primary_color() ?> !important;
				border: none;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="index.php">
					<?php $website->title() ?>
				</a>

				<form class="form-inline ml-auto mr-auto" action="/action_page.php">
					<input class="form-control" type="text" placeholder="Search">
					<button class="btn btn-success" type="submit">Search</button>
				</form>

				<ul class="navbar-nav">
					
					<?php if(User::isLoggedIn()): ?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="accountPopup" data-toggle="dropdown"><?php echo User::getProfileAvatar("40",array("class"=>"rounded-circle")); ?></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="http://en.gravatar.com/">Change Profile Picture</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php"><?php echo User::getProfileAvatar("40",array("class"=>"rounded-circle")); ?></a>
						</li>
					<?php endif; ?>
					
				</ul>
			</div>
		</nav>

		<div class="container" id="content">