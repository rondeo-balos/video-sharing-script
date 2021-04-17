<?php

require_once "./includes/header.php";

?>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
<?php

if(isset($_GET["v"])){
	$id = base64_decode($_GET["v"]);
	$sql = "SELECT ID FROM videos WHERE ID = $id";
	$query = $con->query($sql);
	if($query->num_rows <= 0)
		header("Location: index.php");
	echo (new VideoGridItem($con, $id, true))->generateVideoGridItem();
}else
	header("Location: index.php");

?>
			</div>
			<div class="col-md-3">
				<?php require_once "./includes/sidebar-right.php"; ?>
			</div>
		</div>
	</div>
<?php

require_once "./includes/footer.php";

?>