<?php

class TinTuc{
	public $id;
	public $ten_the_loai;
	public $tieu_de;
	public $hinh_anh;
	public $tom_tat;
	public $noi_dung;
	public $ngay_tao;

	public function __construct($id,$ten_the_loai,$tieu_de,$hinh_anh,$tom_tat,$noi_dung,$ngay_tao){
		this->id=$id;
		this->ten_the_loai=$ten_the_loai;
		this->tieu_de=$tieu_de;
		this->hinh_anh=$hinh_anh;
		this->tom_tat=$tom_tat;
		this->noi_dung=$noi_dung;
		this->ngay_tao=$ngay_tao;
	}

	public function __toString(){
		return $tieu_de." Nội dung: ".$noi_dung;
	}
}

?>