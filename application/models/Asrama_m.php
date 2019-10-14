<?php 

class Asrama_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'asrama';
		$this->data['primary_key']	= 'asrama_id';
	}


	public function total_asrama($like){
		return $this->db->query("SELECT (CASE WHEN asrama_status = 'tersedia' THEN 'tersedia'
			WHEN asrama_status = 'rusak' THEN 'rusak'
			WHEN asrama_status = 'isi' THEN 'isi'
			END) as status, COUNT(*) as total
			FROM asrama WHERE asrama_id like '$like'
			GROUP by (CASE WHEN asrama_status = 'tersedia' THEN 'tersedia'
			WHEN asrama_status = 'rusak' THEN 'rusak'
			WHEN asrama_status = 'isi' THEN 'isi'
			END)")->result();
	}

	public function getRusak($like)
	{
		$x = $this->db->query("SELECT * from asrama WHERE asrama_status='rusak' and asrama_id like 'AA%'")->result();
		return $x;
	}
}