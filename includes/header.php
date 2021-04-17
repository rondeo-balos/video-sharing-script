<?php

require_once "./includes/config.php";
require_once "./includes/classes/Website.php";
require_once "./includes/classes/User.php";
require_once "./includes/classes/VideoGrid.php";
require_once "./includes/classes/VideoGrid/Trending.php";
require_once "./includes/classes/VideoGrid/MostViews.php";
require_once "./includes/classes/VideoGrid/RecentUploads.php";

$website = new Website($config);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php $website->title() ?> <?php $website->tagline() ?></title>
		<link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/font-awesome/css/solid.min.css">
		<link rel="stylesheet" href="./assets/font-awesome/css/fontawesome.min.css">
		<script src="./assets/jquery.min.js"></script>
		<script src="./assets/popper.min.js"></script>
		<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
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
			.img-box{
				background-position: center;
				background-repeat: no-repeat;
				background-attachment: cover;
				height: 150px;
				background-size: 100% auto;
			}
			.video-grid{
				margin-bottom: 30px;
			}
			.video-grid *{
				color: <?php $website->text_color() ?> !important;
				text-decoration: none !important;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
			<div class="container">
				<!-- Brand/logo -->
				<!--<a href="javascript:void(0);">☰</a> &nbsp;-->
				<a class="navbar-brand" href="index.php">
					<?php $website->title() ?>
				</a>

				<form class="form-inline w-75 mr-auto ml-auto" action="/action_page.php">
					<div class="input-group w-100">
						<input class="form-control" style="flex: 1" type="text" placeholder="Search">
						<div class="input-group-append">
							<button class="btn btn-success" type="submit">Search</button>
						</div>
					</div>
				</form>

				<ul class="navbar-nav">
					
					<?php if(User::isLoggedIn()): ?>
						<li class="nav-item dropdown">
							<a class="nav-link" href="javascript:void(0);" id="accountPopup" data-toggle="dropdown"><?php echo User::getProfileAvatar("30",array("class"=>"rounded-circle")); ?></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="http://en.gravatar.com/">Account</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Your Channel</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Your Subscription</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">Logout</a>
							</div>
						</li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php"><?php echo User::getProfileAvatar("30",array("class"=>"rounded-circle")); ?></a>
						</li>
					<?php endif; ?>
					
				</ul>
			</div>
		</nav>

		<div class="container-fluid" id="content">