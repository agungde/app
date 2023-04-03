<?php 
/**
 * List_pejualan_aptk Page Controller
 * @category  Controller
 */
class List_pejualan_aptkController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "list_pejualan_aptk";
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
		$fields = array("id_list_jual", 
			"nama_pelanggan", 
			"alamat", 
			"phone", 
			"jumlah", 
			"satuan", 
			"harga", 
			"aturan_minum", 
			"user_entry");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				list_pejualan_aptk.id_list_jual LIKE ? OR 
				list_pejualan_aptk.nama_pelanggan LIKE ? OR 
				list_pejualan_aptk.alamat LIKE ? OR 
				list_pejualan_aptk.phone LIKE ? OR 
				list_pejualan_aptk.jumlah LIKE ? OR 
				list_pejualan_aptk.satuan LIKE ? OR 
				list_pejualan_aptk.harga LIKE ? OR 
				list_pejualan_aptk.aturan_minum LIKE ? OR 
				list_pejualan_aptk.user_entry LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "list_pejualan_aptk/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("list_pejualan_aptk.id_list_jual", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "List Pejualan Aptk";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "list_pejualan_aptk/ajax-list.php" : "list_pejualan_aptk/list.php");
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
		$this->redirect("list_pejualan_aptk");
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
		$fields = array("id_list_jual", 
			"nama_pelanggan", 
			"alamat", 
			"phone", 
			"jumlah", 
			"satuan", 
			"harga", 
			"aturan_minum", 
			"user_entry");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("list_pejualan_aptk.id_list_jual", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  List Pejualan Aptk";
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
		return $this->render_view("list_pejualan_aptk/view.php", $record);
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
			$fields = $this->fields = array("nama_pelanggan","alamat","phone","jumlah","satuan","harga","aturan_minum","user_entry");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama_pelanggan' => 'required',
				'alamat' => 'required',
				'phone' => 'required',
				'jumlah' => 'required',
				'satuan' => 'required',
				'harga' => 'required',
				'aturan_minum' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pelanggan' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'phone' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("list_pejualan_aptk");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New List Pejualan Aptk";
		$this->render_view("list_pejualan_aptk/add.php");
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
		$fields = $this->fields = array("id_list_jual","nama_pelanggan","alamat","phone","jumlah","satuan","harga","aturan_minum","user_entry");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nama_pelanggan' => 'required',
				'alamat' => 'required',
				'phone' => 'required',
				'jumlah' => 'required',
				'satuan' => 'required',
				'harga' => 'required',
				'aturan_minum' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pelanggan' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'phone' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("list_pejualan_aptk.id_list_jual", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("list_pejualan_aptk");
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
						return	$this->redirect("list_pejualan_aptk");
					}
				}
			}
		}
		$db->where("list_pejualan_aptk.id_list_jual", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  List Pejualan Aptk";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("list_pejualan_aptk/edit.php", $data);
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
		$fields = $this->fields = array("id_list_jual","nama_pelanggan","alamat","phone","jumlah","satuan","harga","aturan_minum","user_entry");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nama_pelanggan' => 'required',
				'alamat' => 'required',
				'phone' => 'required',
				'jumlah' => 'required',
				'satuan' => 'required',
				'harga' => 'required',
				'aturan_minum' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'nama_pelanggan' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'phone' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'satuan' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("list_pejualan_aptk.id_list_jual", $rec_id);;
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
		$db->where("list_pejualan_aptk.id_list_jual", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("list_pejualan_aptk");
	}
}
