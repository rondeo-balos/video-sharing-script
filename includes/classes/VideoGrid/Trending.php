<?php

class Trending{
	private $videoGrid;

	public function __construct($con){
		$this->videoGrid = new VideoGrid($con, "SELECT ID FROM videos ORDER BY likes DESC LIMIT 16");
	}

	public function generateVideoGrid(){
		return $this->videoGrid->generateVideoGrid();
	}

}