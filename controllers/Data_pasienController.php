<?php 
/**
 * Data_pasien Page Controller
 * @category  Controller
 */
class Data_pasienController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "data_pasien";
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
		$fields = array("id_pasien", 
			"date_created", 
			"no_rekam_medis", 
			"nama_pasien", 
			"no_ktp", 
			"jenis_kelamin", 
			"tanggal_lahir", 
			"umur", 
			"alamat", 
			"action", 
			"no_hp", 
			"email", 
			"photo", 
			"user_entry");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				data_pasien.id_pasien LIKE ? OR 
				data_pasien.date_created LIKE ? OR 
				data_pasien.no_rekam_medis LIKE ? OR 
				data_pasien.nama_pasien LIKE ? OR 
				data_pasien.no_ktp LIKE ? OR 
				data_pasien.jenis_kelamin LIKE ? OR 
				data_pasien.tanggal_lahir LIKE ? OR 
				data_pasien.umur LIKE ? OR 
				data_pasien.alamat LIKE ? OR 
				data_pasien.action LIKE ? OR 
				data_pasien.no_hp LIKE ? OR 
				data_pasien.email LIKE ? OR 
				data_pasien.photo LIKE ? OR 
				data_pasien.id_user LIKE ? OR 
				data_pasien.user_entry LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "data_pasien/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("data_pasien.id_pasien", ORDER_TYPE);
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
		if(	!empty($records)){
			foreach($records as &$record){
				$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
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
		$page_title = $this->view->page_title = "Data Pasien";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "data_pasien/ajax-list.php" : "data_pasien/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * Load csv data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv'))){
				$this->set_flash_msg("File format not supported", "danger");
			}
			else{
			$file_path = $_FILES['file']['tmp_name'];
				if(!empty($file_path)){
					$request = $this->request;
					$db = $this->GetModel();
					$tablename = $this->tablename;
					$options = array('table' => $tablename, 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
					if($db->getLastError()){
						$this->set_flash_msg($db->getLastError(), "danger");
					}
					else{
						$this->set_flash_msg("Data imported successfully", "success");
					}
				}
				else{
					$this->set_flash_msg("Error uploading file", "danger");
				}
			}
		}
		else{
			$this->set_flash_msg("No file selected for upload", "warning");
		}
		$this->redirect("data_pasien");
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
		$fields = array("id_pasien", 
			"date_created", 
			"no_rekam_medis", 
			"nama_pasien", 
			"jenis_kelamin", 
			"no_ktp", 
			"tanggal_lahir", 
			"umur", 
			"no_hp", 
			"alamat", 
			"email", 
			"photo", 
			"action", 
			"user_entry");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("data_pasien.id_pasien", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
$record['tanggal_lahir'] = format_date($record['tanggal_lahir'],'d-m-Y');
			$page_title = $this->view->page_title = "View  Data Pasien";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("data_pasien/view.php", $record);
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
			$fields = $this->fields = array("no_ktp","nama_pasien","tanggal_lahir","no_hp","alamat","jenis_kelamin","email","photo","user_entry");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_ktp' => 'required|numeric|max_numeric,9999999999999999|min_numeric,1000000000000000',
				'nama_pasien' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'email' => 'required|valid_email',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'no_ktp' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'email' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("no_ktp", $modeldata['no_ktp']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['no_ktp']." Already exist!";
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("nama_pasien", $modeldata['nama_pasien']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['nama_pasien']." Already exist!";
			} 
			if($this->validated()){
		# Statement to execute before adding record
		$nama_pasien   = $_POST['nama_pasien'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$cek           = $db->rawQuery("select * from data_pasien WHERE nama_pasien='$nama_pasien' and tanggal_lahir='$tanggal_lahir'");
if($cek){
    $this->set_flash_msg("Data Pasien Sudah Ada ", "warning");
 return  $this->redirect("data_pasien/add");
}
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$db->rawQuery("UPDATE data_pasien SET no_rekam_medis='RMP$rec_id' WHERE id_pasien='$rec_id'");
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
$db->rawQuery("UPDATE data_pasien SET umur='$umurnya' WHERE id_pasien='$rec_id'");
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("data_pasien");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Data Pasien";
		$this->render_view("data_pasien/add.php");
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
		$fields = $this->fields = array("id_pasien","no_ktp","nama_pasien","tanggal_lahir","no_hp","alamat","jenis_kelamin","email","photo","user_entry");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_ktp' => 'required|numeric|max_numeric,9999999999999999|min_numeric,1000000000000000',
				'nama_pasien' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'email' => 'required|valid_email',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'no_ktp' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'email' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['no_ktp'])){
				$db->where("no_ktp", $modeldata['no_ktp'])->where("id_pasien", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['no_ktp']." Already exist!";
				}
			}
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['nama_pasien'])){
				$db->where("nama_pasien", $modeldata['nama_pasien'])->where("id_pasien", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['nama_pasien']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("data_pasien.id_pasien", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("data_pasien");
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
						return	$this->redirect("data_pasien");
					}
				}
			}
		}
		$db->where("data_pasien.id_pasien", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Data Pasien";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("data_pasien/edit.php", $data);
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
		$db->where("data_pasien.id_pasien", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("data_pasien");
	}
}
