<?php

require_once "./includes/header.php";

?>


<div class="row">
	<div class="col-md-2">
		<?php require_once "./includes/sidebar.php" ?>
	</div>
	<div class="col-md-10">
		<br>
		<div><strong>Recent Uploads</strong></div>
		<?php (new RecentUploads($con))->generateVideoGrid(); ?>
		<div><strong>Trending</strong></div>
		<?php (new Trending($con))->generateVideoGrid(); ?>
		<div><strong>Most Views</strong></div>
		<?php (new MostViews($con))->generateVideoGrid(); ?>
		<div><strong>Recomended</strong></div>
		<?php (new VideoGrid($con))->generateVideoGrid(); ?>
	</div>
</div>

<?php

require_once "./includes/footer.php";

?>