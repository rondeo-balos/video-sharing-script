<?php

class Website{
	private $config;

	function __construct($config){
		$this->config = $config;
	}

	function title(){
		echo $this->config->site->name;
	}

	function tagline(){
		echo $this->config->site->tagline;
	}

	function primary_color(){
		echo $this->config->site->color->primary;
	}

	function text_color(){
		echo $this->config->site->color->text;
	}

	function navbar_color(){
		echo $this->config->site->color->navbar;
	}

	function menu_color(){
		echo $this->config->site->color->menu;
	}

	function title_color(){
		echo $this->config->site->color->title;
	}

}