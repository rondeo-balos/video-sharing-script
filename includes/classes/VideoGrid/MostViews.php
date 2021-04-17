<?php

class MostViews{
	private $videoGrid;

	public function __construct($con){
		$this->videoGrid = new VideoGrid($con, "SELECT ID FROM videos ORDER BY views DESC LIMIT 16");
	}

	public function generateVideoGrid(){
		return $this->videoGrid->generateVideoGrid();
	}

}