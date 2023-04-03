<?php 
/**
 * Appointment Page Controller
 * @category  Controller
 */
class AppointmentController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "appointment";
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
		$fields = array("appointment.tanggal_appoitment", 
			"appointment.id_appointment", 
			"appointment.nama_pasien", 
			"appointment.no_rekam_medis", 
			"appointment.no_antri_poli", 
			"appointment.alamat", 
			"appointment.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"appointment.dokter", 
			"data_dokter.nama_dokter AS data_dokter_nama_dokter", 
			"appointment.no_hp", 
			"appointment.jenis_kelamin", 
			"appointment.tanggal_lahir", 
			"appointment.setatus", 
			"appointment.date_created", 
			"appointment.keluhan", 
			"appointment.pembayaran", 
			"appointment.date_update", 
			"appointment.date_updated", 
			"appointment.tinggi", 
			"appointment.berat_badan", 
			"appointment.tensi", 
			"appointment.umur");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				appointment.tanggal_appoitment LIKE ? OR 
				appointment.id_appointment LIKE ? OR 
				appointment.id_user LIKE ? OR 
				appointment.nama_pasien LIKE ? OR 
				appointment.no_rekam_medis LIKE ? OR 
				appointment.no_antri_poli LIKE ? OR 
				appointment.alamat LIKE ? OR 
				appointment.nama_poli LIKE ? OR 
				appointment.dokter LIKE ? OR 
				appointment.no_hp LIKE ? OR 
				appointment.jenis_kelamin LIKE ? OR 
				appointment.tanggal_lahir LIKE ? OR 
				appointment.setatus LIKE ? OR 
				appointment.date_created LIKE ? OR 
				appointment.keluhan LIKE ? OR 
				appointment.pembayaran LIKE ? OR 
				appointment.date_update LIKE ? OR 
				appointment.date_updated LIKE ? OR 
				appointment.tinggi LIKE ? OR 
				appointment.berat_badan LIKE ? OR 
				appointment.tensi LIKE ? OR 
				appointment.umur LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "appointment/search.php";
		}
		$db->join("data_poli", "appointment.nama_poli = data_poli.id_poli", "INNER");
		$db->join("data_dokter", "appointment.dokter = data_dokter.id_dokter", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("appointment.id_appointment", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Appointment";
		$view_name = (is_ajax() ? "appointment/ajax-list.php" : "appointment/list.php");
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
		$fields = array("appointment.id_appointment", 
			"appointment.tanggal_appoitment", 
			"appointment.nama_pasien", 
			"appointment.no_rekam_medis", 
			"appointment.alamat", 
			"appointment.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"appointment.dokter", 
			"data_dokter.nama_dokter AS data_dokter_nama_dokter", 
			"appointment.no_antri_poli", 
			"appointment.no_hp", 
			"appointment.jenis_kelamin", 
			"appointment.tanggal_lahir", 
			"appointment.setatus", 
			"appointment.date_created", 
			"appointment.keluhan", 
			"appointment.pembayaran", 
			"appointment.date_update", 
			"appointment.date_updated", 
			"appointment.tinggi", 
			"appointment.berat_badan", 
			"appointment.tensi", 
			"appointment.umur");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("appointment.id_appointment", $rec_id);; //select record based on primary key
		}
		$db->join("data_poli", "appointment.nama_poli = data_poli.id_poli", "INNER");
		$db->join("data_dokter", "appointment.dokter = data_dokter.id_dokter", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Appointment";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("appointment/view.php", $record);
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
			$fields = $this->fields = array("tanggal_appoitment","nama_pasien","no_rekam_medis","alamat","pembayaran","keluhan","nama_poli","dokter","no_hp","jenis_kelamin","tanggal_lahir","date_update","date_updated","tinggi","berat_badan","tensi","umur");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_appoitment' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'pembayaran' => 'required',
				'keluhan' => 'required',
				'nama_poli' => 'required',
				'dokter' => 'required',
				'no_hp' => 'required',
				'jenis_kelamin' => 'required',
				'tanggal_lahir' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'umur' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_appoitment' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'umur' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute before adding record
		$id_user = "".USER_ID;
$dbhost  = "".DB_HOST;
$dbuser  = "".DB_USERNAME;
$dbpass  = "".DB_PASSWORD;
$dbname  = "".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$sekarang       = gmdate("Y-m-d", time() + 60 * 60 * 7);
$no_rekam_medis = trim($_POST['no_rekam_medis']);
$nama_poli      = trim($_POST['nama_poli']);
$tanggal        = trim($_POST['tanggal_appointment']);
 $queryb = mysqli_query($koneksi, "select * from pendaftaran_poli WHERE no_rekam_medis='$no_rekam_medis' and tanggal='$tanggal' and nama_poli='$nama_poli'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
  // ambil jumlah baris data hasil query
  $rowsb = mysqli_num_rows($queryb);
  // cek hasil query
  // jika "no_antrian" sudah ada
  if ($rowsb <> 0) {
        $this->set_flash_msg("Data Pasien Sudah Terdaftar ", "warning");
 return  $this->redirect("pendaftaran_poli");
  }else{
  }
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$db->rawQuery("UPDATE appointment SET setatus='Register' WHERE id_appointment='$rec_id'");
$id_user = "".USER_ID;
$dbhost  = "".DB_HOST;
$dbuser  = "".DB_USERNAME;
$dbpass  = "".DB_PASSWORD;
$dbname  = "".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$sqlcek1 = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
while ($row=mysqli_fetch_array($sqlcek1)){
$cekdata1 = $row['user_role_id'];
if($cekdata1=="2"){
mysqli_query($koneksi,"UPDATE appointment SET id_user='$id_user' WHERE id_appointment='$rec_id'");
}
}
  // membuat "no_antrian"
  // sql statement untuk menampilkan data "no_antrian" terakhir pada tabel "tbl_antrian" berdasarkan "tanggal"
  $tglpesan = trim($_POST['tanggal_appointment']);
  $query = mysqli_query($koneksi, "SELECT max(no_antri_poli) as nomor from pendaftaran_poli WHERE nama_poli='$nama_poli' and tanggal='$tglpesan'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil jumlah baris data hasil query
  $rows = mysqli_num_rows($query);
  // cek hasil query
  // jika "no_antrian" sudah ada
  if ($rows <> 0) {
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
    // "no_antrian" = "no_antrian" yang terakhir + 1
    $no_antrian = $data['nomor'] + 1;
  }
  // jika "no_antrian" belum ada
  else {
    // "no_antrian" = 1
    $no_antrian = 1;
  }
$no_antri_poli = $no_antrian;
mysqli_query($koneksi,"INSERT INTO `pendaftaran_poli` (`pembayaran`,`keluhan`,`nama_pasien`, `nama_poli`, `dokter`, `no_rekam_medis`, `no_hp`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `tanggal`, `no_antri_poli`, `setatus`) VALUES ('".$_POST['pembayaran']."','".$_POST['keluhan']."','".$_POST['nama_pasien']."', '".$_POST['nama_poli']."', '".$_POST['dokter']."', '".$_POST['no_rekam_medis']."', '".$_POST['no_hp']."', '".$_POST['alamat']."', '".$_POST['jenis_kelamin']."', '".$_POST['tanggal_lahir']."', '".$_POST['tanggal_appointment']."', '$no_antri_poli', 'Register')"); 
$db->rawQuery("UPDATE appointment SET no_antri_poli='$no_antri_poli' WHERE id_appointment='$rec_id'");
 mysqli_query($koneksi, "UPDATE data_pasien SET umur='$umurnya'WHERE id_pasien='$no_rekam_medis'");
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("appointment");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Appointment";
		$this->render_view("appointment/add.php");
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
		$fields = $this->fields = array("id_appointment","tanggal_appoitment","nama_pasien","no_rekam_medis","alamat","pembayaran","keluhan","nama_poli","dokter","no_hp","jenis_kelamin","tanggal_lahir","date_update","date_updated","tinggi","berat_badan","tensi","umur");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal_appoitment' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'pembayaran' => 'required',
				'keluhan' => 'required',
				'nama_poli' => 'required',
				'dokter' => 'required',
				'no_hp' => 'required',
				'jenis_kelamin' => 'required',
				'tanggal_lahir' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'umur' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_appoitment' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'umur' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("appointment.id_appointment", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
			$id_user = "".USER_ID;
$dbhost  = "".DB_HOST;
$dbuser  = "".DB_USERNAME;
$dbpass  = "".DB_PASSWORD;
$dbname  = "".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$no_antri_poli = "";
$sqlcek2       = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE nama_poli='".$_POST['nama_poli']."' and tanggal='".$_POST['tanggal_appointment']."'");
while ($row2=mysqli_fetch_array($sqlcek2)){
    $no_antri_poli= $row2['no_antri_poli'];
}
$no_antri_poli = $no_antri_poli + 1;
		# End of after update statement
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("appointment");
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
						return	$this->redirect("appointment");
					}
				}
			}
		}
		$db->where("appointment.id_appointment", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Appointment";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("appointment/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_appointment","tanggal_appoitment","nama_pasien","no_rekam_medis","alamat","pembayaran","keluhan","nama_poli","dokter","no_hp","jenis_kelamin","tanggal_lahir","date_update","date_updated","tinggi","berat_badan","tensi","umur");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal_appoitment' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'pembayaran' => 'required',
				'keluhan' => 'required',
				'nama_poli' => 'required',
				'dokter' => 'required',
				'no_hp' => 'required',
				'jenis_kelamin' => 'required',
				'tanggal_lahir' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'umur' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal_appoitment' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'umur' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("appointment.id_appointment", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
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
		$db->where("appointment.id_appointment", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("appointment");
	}
}
