<?php 

class Slider_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'slider';
		$this->data['primary_key']	= 'slider_id';
	}
}