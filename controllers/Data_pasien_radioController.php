<?php 
/**
 * Data_pasien_radio Page Controller
 * @category  Controller
 */
class Data_pasien_radioController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "data_pasien_radio";
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
		$fields = array("id_pasien_radio", 
			"no_rekam_medis", 
			"no_ktp", 
			"nama_pasien", 
			"tanggal_lahir", 
			"no_hp", 
			"alamat", 
			"jenis_kelamin", 
			"umur", 
			"email", 
			"photo", 
			"date_created", 
			"user_entry");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				data_pasien_radio.id_pasien_radio LIKE ? OR 
				data_pasien_radio.id_user LIKE ? OR 
				data_pasien_radio.no_rekam_medis LIKE ? OR 
				data_pasien_radio.no_ktp LIKE ? OR 
				data_pasien_radio.nama_pasien LIKE ? OR 
				data_pasien_radio.tanggal_lahir LIKE ? OR 
				data_pasien_radio.no_hp LIKE ? OR 
				data_pasien_radio.alamat LIKE ? OR 
				data_pasien_radio.jenis_kelamin LIKE ? OR 
				data_pasien_radio.umur LIKE ? OR 
				data_pasien_radio.email LIKE ? OR 
				data_pasien_radio.photo LIKE ? OR 
				data_pasien_radio.date_created LIKE ? OR 
				data_pasien_radio.action LIKE ? OR 
				data_pasien_radio.user_entry LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "data_pasien_radio/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("data_pasien_radio.id_pasien_radio", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Data Pasien Radio";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "data_pasien_radio/ajax-list.php" : "data_pasien_radio/list.php");
		$this->render_view($view_name, $data);
	}
	/**
     * Load csv|json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv','json'))){
				$this->set_flash_msg("File format not supported", "danger");
			}
			else{
			$file_path = $_FILES['file']['tmp_name'];
				if(!empty($file_path)){
					$request = $this->request;
					$db = $this->GetModel();
					$tablename = $this->tablename;
					if($ext == "csv"){
						$options = array('table' => $tablename, 'fields' => '', 'delimiter' => ',', 'quote' => '"');
						$data = $db->loadCsvData($file_path , $options , false);
					}
					else{
						$data = $db->loadJsonData($file_path, $tablename , false);
					}
					if($db->getLastError()){
						$this->set_flash_msg($db->getLastError(), "danger");
					}
					else{
						$this->set_flash_msg("Data imported successfully", "success");
					}
				}
				else{
					$this->set_flash_msg("Error uploading file", "success");
				}
			}
		}
		else{
			$this->set_flash_msg("No file selected for upload", "warning");
		}
		$this->redirect("data_pasien_radio");
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
		$fields = array("id_pasien_radio", 
			"no_rekam_medis", 
			"no_ktp", 
			"nama_pasien", 
			"tanggal_lahir", 
			"no_hp", 
			"alamat", 
			"jenis_kelamin", 
			"umur", 
			"email", 
			"photo", 
			"date_created", 
			"user_entry");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("data_pasien_radio.id_pasien_radio", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Data Pasien Radio";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("data_pasien_radio/view.php", $record);
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
			$fields = $this->fields = array("no_rekam_medis","no_ktp","nama_pasien","tanggal_lahir","no_hp","alamat","jenis_kelamin","umur","email","photo","user_entry");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'no_ktp' => 'required|numeric',
				'nama_pasien' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required|numeric',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'umur' => 'required',
				'email' => 'required|valid_email',
				'photo' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'no_ktp' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'email' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("data_pasien_radio");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Data Pasien Radio";
		$this->render_view("data_pasien_radio/add.php");
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
		$fields = $this->fields = array("id_pasien_radio","no_rekam_medis","no_ktp","nama_pasien","tanggal_lahir","no_hp","alamat","jenis_kelamin","umur","email","photo","user_entry");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'no_ktp' => 'required|numeric',
				'nama_pasien' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required|numeric',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'umur' => 'required',
				'email' => 'required|valid_email',
				'photo' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'no_ktp' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'email' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("data_pasien_radio.id_pasien_radio", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("data_pasien_radio");
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
						return	$this->redirect("data_pasien_radio");
					}
				}
			}
		}
		$db->where("data_pasien_radio.id_pasien_radio", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Data Pasien Radio";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("data_pasien_radio/edit.php", $data);
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
		$fields = $this->fields = array("id_pasien_radio","no_rekam_medis","no_ktp","nama_pasien","tanggal_lahir","no_hp","alamat","jenis_kelamin","umur","email","photo","user_entry");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'no_ktp' => 'required|numeric',
				'nama_pasien' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required|numeric',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'umur' => 'required',
				'email' => 'required|valid_email',
				'photo' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'no_ktp' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'email' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("data_pasien_radio.id_pasien_radio", $rec_id);;
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
		$db->where("data_pasien_radio.id_pasien_radio", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("data_pasien_radio");
	}
}
