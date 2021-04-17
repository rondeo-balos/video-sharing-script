<?php

class VideoGrid {
	private $con, $sql;

	public function __construct($con, $sql = "SELECT ID FROM videos ORDER BY RAND() LIMIT 16"){
		$this->con = $con;
		$this->sql = $sql;
	}

	public function generateVideoGrid($single = false){
		$query = $this->con->query($this->sql);

		echo "<div class='row'>";
		while($row = $query->fetch_assoc()){
			echo (new VideoGridItem($this->con, $row["ID"]))->generateVideoGridItem($single);
		}
		echo "</div>";
	}

}

class VideoGridItem {
	private $con, $id, $largemode, $video;

	public function __construct($con, $id, $largemode = false){
		$this->con = $con;
		$this->id = $id;
		$this->largemode = $largemode;
		$this->video = new Video($this->con, $this->id);
	}

	public function generateVideoGridItem($single = false){
		if($this->largemode)
			return $this->generateVideoPlayer();
		ob_start();
		$class = "col-lg-3 col-md-4 col-sm-6";
		if($single)
			$class = "col-md-12";
		?>
			<div class="<?php echo $class ?> video-grid">
				<a href="video-playback.php?v=<?php echo base64_encode($this->id); ?>">
					<div class="img-box" style="background-image: url(<?php echo $this->video->getThumbnail() ?>)"></div>
					<p>
						<strong><?php echo $this->video->getTitle() ?></strong><br>
						<?php echo $this->video->getUploader() ?><br>
						<span><?php echo $this->video->getViews() ?> views</span>
						&nbsp;•&nbsp;
						<span><?php echo $this->video->getTimestamp() ?></span>
					</p>
				</a>
			</div>
		<?php
		return ob_get_clean();
	}

	public function generateVideoPlayer(){
		ob_start();
		?>
			<div class="col-md-12">
				<div class="img-box" style="background-image: url(<?php echo $this->video->getThumbnail() ?>)"></div>
					<p>
						<strong><?php echo $this->video->getTitle() ?></strong><br>
						<?php echo $this->video->getUploader() ?><br>
						<span><?php echo $this->video->getViews() ?> views</span>
						&nbsp;•&nbsp;
						<span><?php echo $this->video->getTimestamp() ?></span>
					</p>
			</div>
		<?php
		return ob_get_clean();
	}

}

class Video {
	private $con, $data;

	public function __construct($con, $id){
		$this->con = $con;
		$sql = "SELECT * FROM videos WHERE ID = $id";
		$query = $con->query($sql);
		$this->data = $query->fetch_assoc();
	}

	public function getTitle(){
		return $this->data["title"];
	}

	public function getUploader(){
		$sql = "SELECT username FROM users WHERE ID = ".$this->data["uploaded_by"];
		$query = $this->con->query($sql);
		return $query->fetch_assoc()["username"];
	}

	public function getViews(){
		return $this->data["views"];
	}

	public function getLikes(){
		return $this->data["likes"];
	}

	public function getComments(){
		return $this->data["comments"];
	}

	public function getThumbnail(){
		return $this->data["thumbnail"];
	}

	public function getTimestamp(){
		$date = $this->data["video_uploaded"];
		return date("M jS, Y", strtotime($date));
	}

}