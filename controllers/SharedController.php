<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * data_dokter_specialist_option_list Model Action
     * @return array
     */
	function data_dokter_specialist_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_poli AS value,nama_poli AS label FROM data_poli";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * data_pasien_no_ktp_value_exist Model Action
     * @return array
     */
	function data_pasien_no_ktp_value_exist($val){
		$db = $this->GetModel();
		$db->where("no_ktp", $val);
		$exist = $db->has("data_pasien");
		return $exist;
	}

	/**
     * data_pasien_nama_pasien_value_exist Model Action
     * @return array
     */
	function data_pasien_nama_pasien_value_exist($val){
		$db = $this->GetModel();
		$db->where("nama_pasien", $val);
		$exist = $db->has("data_pasien");
		return $exist;
	}

	/**
     * pendaftaran_poli_pembayaran_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_pembayaran_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_bank AS value,nama_bank AS label FROM data_bank ORDER BY nama_bank ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pendaftaran_poli_tanggal_appointment_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_tanggal_appointment_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT tanggal_appointment AS value , tanggal_appointment AS label FROM pendaftaran_poli ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pendaftaran_poli_no_ktp_default_value Model Action
     * @return Value
     */
	function pendaftaran_poli_no_ktp_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT no_ktp AS value,no_ktp AS label FROM data_pasien";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * pendaftaran_poli_nama_poli_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_nama_poli_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_poli AS value,nama_poli AS label FROM data_poli";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pendaftaran_poli_dokter_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_dokter_option_list($lookup_nama_poli){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_dokter AS value,nama_dokter AS label FROM data_dokter WHERE specialist= ?" ;
		$queryparams = array($lookup_nama_poli);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pendaftaran_poli_identitas_penanggung_jawab_value_exist Model Action
     * @return array
     */
	function pendaftaran_poli_identitas_penanggung_jawab_value_exist($val){
		$db = $this->GetModel();
		$db->where("identitas_penanggung_jawab", $val);
		$exist = $db->has("pendaftaran_poli");
		return $exist;
	}

	/**
     * pendaftaran_poli_user_entry_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_user_entry_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT user_entry AS value , user_entry AS label FROM pendaftaran_poli ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pendaftaran_poli_setatus_option_list Model Action
     * @return array
     */
	function pendaftaran_poli_setatus_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT setatus AS value , setatus AS label FROM resep_obat ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_diagnosa_option_list Model Action
     * @return array
     */
	function rekam_medis_diagnosa_option_list($search_text = null){
		$arr = array();
		if(!empty($search_text)){
			$db = $this->GetModel();
			$sqltext = "SELECT  DISTINCT description AS value,description AS label FROM diagnosa WHERE description LIKE ? LIMIT 0,20"    ;
			$queryparams = array("%$search_text%");
			$arr = $db->rawQuery($sqltext, $queryparams);
		}
		return $arr;
	}

	/**
     * rekam_medis_tinggi_default_value Model Action
     * @return Value
     */
	function rekam_medis_tinggi_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT tinggi AS value,tinggi AS label FROM pendaftaran_poli";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * rekam_medis_berat_badan_default_value Model Action
     * @return Value
     */
	function rekam_medis_berat_badan_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT berat_badan AS value,berat_badan AS label FROM pendaftaran_poli";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * rekam_medis_tensi_default_value Model Action
     * @return Value
     */
	function rekam_medis_tensi_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT tensi AS value,tensi AS label FROM pendaftaran_poli";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * rekam_medis_tindakan_option_list Model Action
     * @return array
     */
	function rekam_medis_tindakan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,nama_tindakan AS label FROM list_biaya_tindakan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_nama_pemeriksaan_lab_option_list Model Action
     * @return array
     */
	function rekam_medis_nama_pemeriksaan_lab_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_pemeriksaan AS value,nama_pemeriksaan AS label FROM laboratorium ORDER BY nama_pemeriksaan ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_tindakan_option_list_2 Model Action
     * @return array
     */
	function rekam_medis_tindakan_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT tindakan AS value , tindakan AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_resep_obat_option_list Model Action
     * @return array
     */
	function rekam_medis_resep_obat_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT resep_obat AS value , resep_obat AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_date_created_option_list Model Action
     * @return array
     */
	function rekam_medis_date_created_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT date_created AS value , date_created AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_nama_poli_option_list Model Action
     * @return array
     */
	function rekam_medis_nama_poli_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_poli AS value , id_poli AS label FROM data_poli ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_rujukan_option_list Model Action
     * @return array
     */
	function rekam_medis_rujukan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT rujukan AS value , rujukan AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_user_entry_option_list Model Action
     * @return array
     */
	function rekam_medis_user_entry_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT user_entry AS value , user_entry AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_nama_pemeriksaan_lab_option_list_2 Model Action
     * @return array
     */
	function rekam_medis_nama_pemeriksaan_lab_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT nama_pemeriksaan_lab AS value , nama_pemeriksaan_lab AS label FROM rekam_medis ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_clinik_metode_pembayaran_option_list Model Action
     * @return array
     */
	function transaksi_clinik_metode_pembayaran_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_bank AS value,nama_bank AS label FROM data_bank ORDER BY nama_bank ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * transaksi_clinik_user_entry_option_list Model Action
     * @return array
     */
	function transaksi_clinik_user_entry_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT user_entry AS value,user_entry AS label FROM data_pasien ORDER BY user_entry ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * biodata_no_ktp_value_exist Model Action
     * @return array
     */
	function biodata_no_ktp_value_exist($val){
		$db = $this->GetModel();
		$db->where("no_ktp", $val);
		$exist = $db->has("biodata");
		return $exist;
	}

	/**
     * appointment_nama_poli_option_list Model Action
     * @return array
     */
	function appointment_nama_poli_option_list($lookup_nama_poli){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_dokter AS value,specialist AS label FROM data_dokter WHERE specialist= ?" ;
		$queryparams = array($lookup_nama_poli);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * appointment_dokter_option_list Model Action
     * @return array
     */
	function appointment_dokter_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_dokter AS value,nama_dokter AS label FROM data_dokter";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_login_nama_value_exist Model Action
     * @return array
     */
	function user_login_nama_value_exist($val){
		$db = $this->GetModel();
		$db->where("nama", $val);
		$exist = $db->has("user_login");
		return $exist;
	}

	/**
     * user_login_user_entry_option_list Model Action
     * @return array
     */
	function user_login_user_entry_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT username AS value,username AS label FROM user_login";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_login_email_value_exist Model Action
     * @return array
     */
	function user_login_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user_login");
		return $exist;
	}

	/**
     * user_login_user_role_id_option_list Model Action
     * @return array
     */
	function user_login_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * resep_obat_nama_poli_option_list Model Action
     * @return array
     */
	function resep_obat_nama_poli_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_poli AS value,nama_poli AS label FROM data_poli ORDER BY nama_poli ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * resep_obat_nama_poli_default_value Model Action
     * @return Value
     */
	function resep_obat_nama_poli_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT nama_poli AS value,nama_poli AS label FROM data_poli ORDER BY nama_poli ASC";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * data_resep_nama_poli_option_list Model Action
     * @return array
     */
	function data_resep_nama_poli_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_poli AS value , id_poli AS label FROM data_poli ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * rekam_medis_rekam_medisnama_poli_option_list Model Action
     * @return array
     */
	function rekam_medis_rekam_medisnama_poli_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_poli AS value,nama_poli AS label FROM data_poli";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_datapasien Model Action
     * @return Value
     */
	function getcount_datapasien(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM data_pasien";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pendaftaranpoli Model Action
     * @return Value
     */
	function getcount_pendaftaranpoli(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pendaftaran_poli";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_rekammedis Model Action
     * @return Value
     */
	function getcount_rekammedis(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM rekam_medis";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_transaksiclinik Model Action
     * @return Value
     */
	function getcount_transaksiclinik(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM transaksi_clinik";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_datadokter Model Action
     * @return Value
     */
	function getcount_datadokter(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM data_dokter";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_jadwaldokter Model Action
     * @return Value
     */
	function getcount_jadwaldokter(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM jadwal_dokter";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_resepobat Model Action
     * @return Value
     */
	function getcount_resepobat(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM resep_obat";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pelanggan Model Action
     * @return Value
     */
	function getcount_pelanggan(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pelanggan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pelangganluarapotek Model Action
     * @return Value
     */
	function getcount_pelangganluarapotek(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pelanggan_luar_apotek";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_penjualan Model Action
     * @return Value
     */
	function getcount_penjualan(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM penjualan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pembelian Model Action
     * @return Value
     */
	function getcount_pembelian(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pembelian";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_laporanstokobat Model Action
     * @return Value
     */
	function getcount_laporanstokobat(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM laporan_stok_obat";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
