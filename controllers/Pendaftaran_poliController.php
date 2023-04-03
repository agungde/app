<?php 
/**
 * Pendaftaran_poli Page Controller
 * @category  Controller
 */
class Pendaftaran_poliController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pendaftaran_poli";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("pendaftaran_poli.id_pendaftaran_poli", 
			"pendaftaran_poli.date_created", 
			"pendaftaran_poli.tanggal_appointment", 
			"pendaftaran_poli.no_antri_poli", 
			"pendaftaran_poli.no_rekam_medis", 
			"pendaftaran_poli.nama_pasien", 
			"pendaftaran_poli.no_ktp", 
			"pendaftaran_poli.setatus", 
			"pendaftaran_poli.action", 
			"pendaftaran_poli.jenis_kelamin", 
			"pendaftaran_poli.tanggal_lahir", 
			"pendaftaran_poli.umur", 
			"pendaftaran_poli.tinggi", 
			"pendaftaran_poli.berat_badan", 
			"pendaftaran_poli.tensi", 
			"pendaftaran_poli.email", 
			"pendaftaran_poli.no_hp", 
			"pendaftaran_poli.alamat", 
			"pendaftaran_poli.keluhan", 
			"pendaftaran_poli.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"pendaftaran_poli.dokter", 
			"data_dokter.nama_dokter AS data_dokter_nama_dokter", 
			"pendaftaran_poli.pembayaran", 
			"pendaftaran_poli.user_entry", 
			"pendaftaran_poli.penanggung_jawab", 
			"pendaftaran_poli.identitas_penanggung_jawab", 
			"pendaftaran_poli.hasil_laboratorium_radiologi");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	$sekarang = gmdate("Y-m-d", time() + 60 * 60 * 7);
$id_user = "".USER_ID;
$dbhost="".DB_HOST;
$dbuser="".DB_USERNAME;
$dbpass="".DB_PASSWORD;
$dbname="".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
 $sql = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
    while ($row=mysqli_fetch_array($sql)){
   $user_role_id = $row['user_role_id'];
   }
 if($user_role_id=="3"){
 $sql1 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
  while ($row1=mysqli_fetch_array($sql1)){
  $specialist = $row1['specialist'];
  }
$db->where("specialist='$specialist' and tanggal='$sekarang' and setatus='Register'");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pendaftaran_poli.tanggal LIKE ? OR 
				pendaftaran_poli.id_pendaftaran_poli LIKE ? OR 
				pendaftaran_poli.date_created LIKE ? OR 
				pendaftaran_poli.tanggal_appointment LIKE ? OR 
				pendaftaran_poli.no_antri_poli LIKE ? OR 
				pendaftaran_poli.no_rekam_medis LIKE ? OR 
				pendaftaran_poli.nama_pasien LIKE ? OR 
				pendaftaran_poli.no_ktp LIKE ? OR 
				pendaftaran_poli.setatus LIKE ? OR 
				pendaftaran_poli.action LIKE ? OR 
				pendaftaran_poli.jenis_kelamin LIKE ? OR 
				pendaftaran_poli.tanggal_lahir LIKE ? OR 
				pendaftaran_poli.umur LIKE ? OR 
				pendaftaran_poli.tinggi LIKE ? OR 
				pendaftaran_poli.berat_badan LIKE ? OR 
				pendaftaran_poli.tensi LIKE ? OR 
				pendaftaran_poli.email LIKE ? OR 
				pendaftaran_poli.no_hp LIKE ? OR 
				pendaftaran_poli.alamat LIKE ? OR 
				pendaftaran_poli.keluhan LIKE ? OR 
				pendaftaran_poli.nama_poli LIKE ? OR 
				pendaftaran_poli.dokter LIKE ? OR 
				pendaftaran_poli.pembayaran LIKE ? OR 
				pendaftaran_poli.id_appointment LIKE ? OR 
				pendaftaran_poli.user_entry LIKE ? OR 
				pendaftaran_poli.date_update LIKE ? OR 
				pendaftaran_poli.date_updated LIKE ? OR 
				pendaftaran_poli.penanggung_jawab LIKE ? OR 
				pendaftaran_poli.identitas_penanggung_jawab LIKE ? OR 
				pendaftaran_poli.hasil_laboratorium_radiologi LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pendaftaran_poli/search.php";
		}
		$db->join("data_poli", "pendaftaran_poli.nama_poli = data_poli.id_poli", "INNER");
		$db->join("data_dokter", "pendaftaran_poli.dokter = data_dokter.id_dokter", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("no_antri_poli", "ASC");
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->pendaftaran_poli_tanggal_appointment)){
			$val = $request->pendaftaran_poli_tanggal_appointment;
			$db->where("DATE(pendaftaran_poli.tanggal_appointment)", $val , "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
$record['tanggal_appointment'] = format_date($record['tanggal_appointment'],'d-m-Y H:i:s');
$record['tanggal_lahir'] = format_date($record['tanggal_lahir'],'d-m-Y');
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Pendaftaran Poli";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "pendaftaran_poli/ajax-list.php" : "pendaftaran_poli/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("pendaftaran_poli.id_pendaftaran_poli", 
			"pendaftaran_poli.tanggal_appointment", 
			"pendaftaran_poli.date_created", 
			"pendaftaran_poli.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"pendaftaran_poli.dokter", 
			"data_dokter.nama_dokter AS data_dokter_nama_dokter", 
			"pendaftaran_poli.nama_pasien", 
			"pendaftaran_poli.no_ktp", 
			"pendaftaran_poli.no_rekam_medis", 
			"pendaftaran_poli.no_hp", 
			"pendaftaran_poli.alamat", 
			"pendaftaran_poli.jenis_kelamin", 
			"pendaftaran_poli.no_antri_poli", 
			"pendaftaran_poli.tanggal_lahir", 
			"pendaftaran_poli.umur", 
			"pendaftaran_poli.setatus", 
			"pendaftaran_poli.keluhan", 
			"pendaftaran_poli.pembayaran", 
			"pendaftaran_poli.email", 
			"pendaftaran_poli.user_entry", 
			"pendaftaran_poli.penanggung_jawab", 
			"pendaftaran_poli.identitas_penanggung_jawab", 
			"pendaftaran_poli.tinggi", 
			"pendaftaran_poli.berat_badan", 
			"pendaftaran_poli.tensi", 
			"pendaftaran_poli.hasil_laboratorium_radiologi");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pendaftaran_poli.id_pendaftaran_poli", $rec_id);; //select record based on primary key
		}
		$db->join("data_poli", "pendaftaran_poli.nama_poli = data_poli.id_poli", "INNER");
		$db->join("data_dokter", "pendaftaran_poli.dokter = data_dokter.id_dokter", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_appointment'] = format_date($record['tanggal_appointment'],'d-m-Y H:i:s');
$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
$record['tanggal_lahir'] = format_date($record['tanggal_lahir'],'d-m-Y');
			$page_title = $this->view->page_title = "View  Pendaftaran Poli";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("pendaftaran_poli/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("tanggal","tanggal_appointment","no_rekam_medis","nama_pasien","no_ktp","tanggal_lahir","tinggi","berat_badan","tensi","alamat","email","keluhan","nama_poli","dokter","jenis_kelamin","no_hp","pembayaran","penanggung_jawab","identitas_penanggung_jawab","user_entry","hasil_laboratorium_radiologi");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'tanggal_appointment' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'no_ktp' => 'required',
				'tanggal_lahir' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'alamat' => 'required',
				'email' => 'required|valid_email',
				'keluhan' => 'required',
				'nama_poli' => 'required',
				'dokter' => 'required',
				'jenis_kelamin' => 'required',
				'no_hp' => 'required',
				'pembayaran' => 'required',
				'penanggung_jawab' => 'required',
				'identitas_penanggung_jawab' => 'required|numeric|max_numeric,9999999999999999|min_numeric,1000000000000000',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'tanggal_appointment' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_ktp' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'email' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'penanggung_jawab' => 'sanitize_string',
				'identitas_penanggung_jawab' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
				'hasil_laboratorium_radiologi' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("identitas_penanggung_jawab", $modeldata['identitas_penanggung_jawab']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['identitas_penanggung_jawab']." Already exist!";
			} 
			if($this->validated()){
		# Statement to execute before adding record
		$id_user = "".USER_ID;
$dbhost="".DB_HOST;
$dbuser="".DB_USERNAME;
$dbpass="".DB_PASSWORD;
$dbname="".DB_NAME;
//$koneksi=open_connection();
$koneksi        = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$sekarang       = date("Y-m-d");
$no_rekam_medis = trim($_POST['no_rekam_medis']);
$nama_poli      = trim($_POST['nama_poli']);
$tanggal        = trim($_POST['tanggal']);
$thn = substr($tanggal, 0, 10);
$sql = mysqli_query($koneksi,"select * from data_poli WHERE id_poli='$nama_poli'");
while ($row=mysqli_fetch_array($sql)){
    $quota_pasien = $row['quota_pasien'];
    $namapoli     = $row['nama_poli'];
}
 $queryb = mysqli_query($koneksi, "select * from pendaftaran_poli WHERE no_rekam_medis='$no_rekam_medis' and tanggal='$sekarang' and nama_poli='$nama_poli'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
  // ambil jumlah baris data hasil query
  $rowsb = mysqli_num_rows($queryb);
  // cek hasil query
  // jika "no_antrian" sudah ada
  if ($rowsb <> 0) {
      $datab   = mysqli_fetch_assoc($queryb);
      $setatus = $datab['setatus'];
          if($setatus=="Closed" or $setatus=="Register" ){
          $this->set_flash_msg("Data Pasien Sudah Terdaftar ", "warning");
 return  $this->redirect("pendaftaran_poli");
  }else{ 
    $query = mysqli_query($koneksi, "SELECT max(no_antri_poli) as nomor from pendaftaran_poli WHERE nama_poli='$nama_poli' and tanggal='$sekarang'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
  $rows = mysqli_num_rows($query);
  if ($rows <> 0) {
    $data       = mysqli_fetch_assoc($query);
    $no_antrian = $data['nomor'] + 1;
    if ($no_antrian > $quota_pasien){
    $this->set_flash_msg("Quota Pasien ($namapoli) Sudah Penuh ", "warning");
 return  $this->redirect("pendaftaran_poli");
    }else {}
  }else {}
}
        $this->set_flash_msg("Data Pasien Sudah Terdaftar ", "warning");
 return  $this->redirect("pendaftaran_poli");
  }else{
  }
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$id_user = "".USER_ID;
$dbhost="".DB_HOST;
$dbuser="".DB_USERNAME;
$dbpass="".DB_PASSWORD;
$dbname="".DB_NAME;
//$koneksi=open_connection();
$koneksi        = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
//$sekarang       = date("Y-m-d");
$no_rekam_medis = trim($_POST['no_rekam_medis']);
$tanggal        = trim($_POST['tanggal']);
$nama_poli      = trim($_POST['nama_poli']);
$sekarang = gmdate("Y-m-d", time() + 60 * 60 * 7);
    $thn  = substr($_POST['tanggal_lahir'], 0, 4);
    $taun = date("Y");
    $umur = $taun - $thn;
    $umur = substr($umur, 0, 2);
function hitung_umur($thn){
    $birthDate = new DateTime($thn);
    $today = new DateTime("today");
    if ($birthDate > $today) { 
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    return $y."Tahun ".$m."Bulan ".$d."Hari";
}
$umurnya=hitung_umur("1980-12-01");
  // membuat "no_antrian"
  // sql statement untuk menampilkan data "no_antrian" terakhir pada tabel "tbl_antrian" berdasarkan "tanggal"
  $query = mysqli_query($koneksi, "SELECT max(no_antri_poli) as nomor from pendaftaran_poli WHERE nama_poli='$nama_poli' and tanggal='$sekarang'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
  // ambil jumlah baris data hasil query
  $rows = mysqli_num_rows($query);
  // cek hasil query
  // jika "no_antrian" sudah ada
  if ($rows <> 0) {
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
    // "no_antrian" = "no_antrian" yang terakhir + 1
    $no_antrian = $data['nomor'] + 1;
    $db->rawQuery("UPDATE pendaftaran_poli SET setatus='Register', umur='$umurnya', no_antri_poli='$no_antrian' WHERE id_pendaftaran_poli='$rec_id'");
  }
  // jika "no_antrian" belum ada
  else {
    // "no_antrian" = 1
    $no_antrian = 1;
    $db->rawQuery("UPDATE pendaftaran_poli SET setatus='Register', umur='$umurnya', no_antri_poli='$no_antrian' WHERE id_pendaftaran_poli='$rec_id'");
  }
    mysqli_query($koneksi, "UPDATE data_pasien SET umur='$umurnya'WHERE id_pasien='$no_rekam_medis'");
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("pendaftaran_poli");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Pendaftaran Poli";
		$this->render_view("pendaftaran_poli/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_pendaftaran_poli","tanggal","tanggal_appointment","no_rekam_medis","nama_pasien","no_ktp","tanggal_lahir","tinggi","berat_badan","tensi","alamat","email","keluhan","nama_poli","dokter","setatus","jenis_kelamin","no_hp","pembayaran","penanggung_jawab","identitas_penanggung_jawab","user_entry","hasil_laboratorium_radiologi");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'tanggal_appointment' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'no_ktp' => 'required',
				'tanggal_lahir' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'alamat' => 'required',
				'email' => 'required|valid_email',
				'keluhan' => 'required',
				'nama_poli' => 'required',
				'dokter' => 'required',
				'setatus' => 'required',
				'jenis_kelamin' => 'required',
				'no_hp' => 'required',
				'pembayaran' => 'required',
				'penanggung_jawab' => 'required',
				'identitas_penanggung_jawab' => 'required|numeric|max_numeric,9999999999999999|min_numeric,1000000000000000',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'tanggal_appointment' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_ktp' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'email' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter' => 'sanitize_string',
				'setatus' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'penanggung_jawab' => 'sanitize_string',
				'identitas_penanggung_jawab' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
				'hasil_laboratorium_radiologi' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['identitas_penanggung_jawab'])){
				$db->where("identitas_penanggung_jawab", $modeldata['identitas_penanggung_jawab'])->where("id_pendaftaran_poli", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['identitas_penanggung_jawab']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("pendaftaran_poli.id_pendaftaran_poli", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("pendaftaran_poli");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("pendaftaran_poli");
					}
				}
			}
		}
		$db->where("pendaftaran_poli.id_pendaftaran_poli", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Pendaftaran Poli";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pendaftaran_poli/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("pendaftaran_poli.id_pendaftaran_poli", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("pendaftaran_poli");
	}
}
