<?php 

class Penghuni_asrama_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penghuni_asrama';
		$this->data['primary_key']	= 'pa_id';
	}

	public function count_all_asrama(){
		return $this->db->query("SELECT (CASE WHEN asrama_id LIKE 'AA%' THEN 'Apartemen Putri'
			WHEN asrama_id LIKE 'AB%' THEN 'Apartemen Putra'
			WHEN asrama_id LIKE 'BA%' THEN 'Rusunawa Putra'
			WHEN asrama_id LIKE 'BB%' THEN 'Rusunawa Lama Putri'
			WHEN asrama_id LIKE 'BC%' THEN 'Rusunawa Baru Putri'
			WHEN asrama_id LIKE 'CA%' THEN 'Asrama Lahat'
			WHEN asrama_id LIKE 'CB%' THEN 'Asrama Muara Enim'
			WHEN asrama_id LIKE 'CC%' THEN 'Asrama Muba'
			WHEN asrama_id LIKE 'CD%' THEN 'Asrama Musi Rawas'
			WHEN asrama_id LIKE 'CE%' THEN 'Asrama OKI'
			WHEN asrama_id LIKE 'CF%' THEN 'Asrama OKU'
			WHEN asrama_id LIKE 'CG%' THEN 'Asrama Palembang'
			END) as plan_grp, COUNT(*) as total
			FROM penghuni_asrama WHERE pa_status_sewa='masuk'
			GROUP by (CASE WHEN asrama_id LIKE 'AA%' THEN 'Apartemen Putri'
			WHEN asrama_id LIKE 'AB%' THEN 'Apartemen Putra'
			WHEN asrama_id LIKE 'BA%' THEN 'Rusunawa Putra'
			WHEN asrama_id LIKE 'BB%' THEN 'Rusunawa Lama Putri'
			WHEN asrama_id LIKE 'BC%' THEN 'Rusunawa Baru Putri'
			WHEN asrama_id LIKE 'CA%' THEN 'Asrama Lahat'
			WHEN asrama_id LIKE 'CB%' THEN 'Asrama Muara Enim'
			WHEN asrama_id LIKE 'CC%' THEN 'Asrama Muba'
			WHEN asrama_id LIKE 'CD%' THEN 'Asrama Musi Rawas'
			WHEN asrama_id LIKE 'CE%' THEN 'Asrama OKI'
			WHEN asrama_id LIKE 'CF%' THEN 'Asrama OKU'
			WHEN asrama_id LIKE 'CG%' THEN 'Asrama Palembang'
			END)")->result();
	}
}