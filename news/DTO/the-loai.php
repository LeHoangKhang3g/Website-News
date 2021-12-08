<?php

class TheLoai{
	public $id;
	public $ten;

	public function __construct($id,$ten){
		this->id=$id;
		this->ten=$ten;
	}
	public function __toString(){
		return $ten;
	}
}

?>