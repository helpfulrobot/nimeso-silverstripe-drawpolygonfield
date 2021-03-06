<?php
class DrawPolygonField extends HiddenField {
	
	public $baseImages;
	public $width;
	public $height;
	
	public function __construct($name, $title = "", $value = "", $width = 1140, $height = 600, $baseImages = null) {
		$this->width = $width;
		$this->height = $height;
		$this->baseImages = $baseImages;
		parent::__construct($name, $title, $value);
	}
	
	public function Field($properties = array()) {
		
		//Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
		$jsvars = array(
			"Name" => $this->name
		);
		Requirements::javascript("drawpolygonfield/javascript/drawpolygonfield.js", $jsvars);
		Requirements::css("drawpolygonfield/css/drawpolygonfield.css");

		$content = parent::Field();
		
		$imgStr = "";
		if(count($this->baseImages) > 0){
			$numUp = 0;
			foreach ($this->baseImages as $baseImage) {
				$imgStr .= "<img class='level_".$numUp."' src='".$baseImage->URL."'/>";
				$numUp++;
			}
		}
		$content .= "<hr><h4>Preview</h4><p>Click in the region below to start defining a area</p><div class='stacked-images'>".$imgStr."<canvas id='".$this->name."PolyCanvas' width=".$this->width." height=".$this->height."></canvas></div><div class='PolyActions'><button id='clearpoly' class='btn'>Clear Canvas</button></div><hr>";
		
		return $content;
	}
	
}

