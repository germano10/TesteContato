<?php
class Sistema{

	public function set($var,$valor){
		$this->$var = $valor;
		return $this;
	}

	public function get($var){
		return $this->$var;
	}
}

?>