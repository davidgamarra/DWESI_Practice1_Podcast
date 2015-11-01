<?php
class FileUpload {

	private $dest = "./";
	private $name = "";
	private $maxSize = 20971520; //20 mb
	private $param, $upError, $size, $tmpName;
	//File Type
	private $allowedExtensions = array(
		"jpg" => 1,
		"gif" => 1,
		"png" => 1,
		"jpeg" => 1,
		"mp3" => 1,
		"wav" => 1
	);
	private $extension;
	
	private $error = false;
	const PRESERVE = 1, REPLACE = 2, RENAME = 3;
	private $policy = self::RENAME;
	
	function __construct($param, $multi = null){
		if($multi !== null){
			if(isset($multi[$param]) && $multi[$param]["name"] !== ""){
				$this->param = $param;
				$this->extension = pathinfo($multi[$this->param]["name"])["extension"];
				$this->name = pathinfo($multi[$this->param]["name"])["filename"];
				$this->upError = $multi[$this->param]["error"];
				$this->size = $multi[$this->param]["size"];
				$this->tmpName = $multi[$this->param]["tmp_name"];
			} else {
				$this->error = true;
			}
		} else {
			if(isset($_FILES[$param]) && $_FILES[$param]["name"] !== ""){
				$this->param = $param;
				$this->extension = pathinfo($_FILES[$this->param]["name"])["extension"];
				$this->name = pathinfo($_FILES[$this->param]["name"])["filename"];
				$this->upError = $_FILES[$this->param]["error"];
				$this->size = $_FILES[$this->param]["size"];
				$this->tmpName = $_FILES[$this->param]["tmp_name"];
			} else {
				$this->error = true;
			}
		}
	}
	
	function getDestination() {
		return $this->dest;
	}
	
	function getName() {
		return $this->name;
	}
	
	function getSize() {
		return $this->size;
	}
	
	function getPolicy() {
		return $this->policy;
	}
	
	function setDestination($value){
		$this->dest = $value;
	}
	
	function setName($value){
		$this->name = $value;
	}
	
	function setSize($value){
		$this->size = $value;
	}
	
	function setPolicy($value){
		$this->policy = $value;
	}
	
	function upload(){
		$name = $this->name;
		if($this->error){
			return -1;
		} else if($this->upError != UPLOAD_ERR_OK) {
			return -2;
		} else if($this->size > $this->maxSize) {
			return -3;
		} else if(!$this->isType($this->extension)){
			return -4;
		} else if(!is_dir($this->dest) || substr($this->dest, -1) !== "/"){
			return -5;
		} else if($this->policy === self::PRESERVE && file_exists($this->dest.$this->name.".".$this->extension)) {
			return -6;
		} else if($this->policy === self::RENAME && file_exists($this->dest.$this->name.".".$this->extension)) {
			$name = $this->nameChange($name);
		}
		return move_uploaded_file($this->tmpName, $this->dest.$name.".".$this->extension);
	}
	
	private function nameChange($name) {
		$i = 0;
		while(file_exists($this->dest.$name."(".$i.").".$this->extension)){
			$i++;
		}
		return $name."(".$i.")";
	}
	
	function addType($type) {
		if(!$this->isType($type)){
			$this->allowedExtensions[$type] = 1;
			return true;
		}
		return false;
	}
	
	function delType($type) {
		if($this->isType($type)){
			unset($this->allowedExtensions[$type]);
			return true;
		}
		return false;
	}
	
	function isType($type) {
		return isset($this->allowedExtensions[$type]);
	}
	
	public static function transformArray($param) {
		$my_files = array();
		for ($i = 0; $i < count($_FILES[$param]['name']); $i++) {
			$my_files[$i][$param]['name'] = $_FILES[$param]['name'][$i];
			$my_files[$i][$param]['type'] = $_FILES[$param]['type'][$i];
			$my_files[$i][$param]['tmp_name'] = $_FILES[$param]['tmp_name'][$i];
			$my_files[$i][$param]['error'] = $_FILES[$param]['error'][$i];
			$my_files[$i][$param]['size'] = $_FILES[$param]['size'][$i];
		}
		return $my_files;
	}
	
}