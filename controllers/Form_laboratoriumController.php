<?php 
/**
 * Form_laboratorium Page Controller
 * @category  Controller
 */
class Form_laboratoriumController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "form_laboratorium";
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
		$fields = array("tanggal", 
			"nama_pasien", 
			"no_rekam_medis", 
			"alamat", 
			"no_hp", 
			"keluhan", 
			"jenis_pemeriksaan", 
			"dokter_pemeriksa", 
			"nama_poli", 
			"hasil_pemeriksaan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				form_laboratorium.tanggal LIKE ? OR 
				form_laboratorium.nama_pasien LIKE ? OR 
				form_laboratorium.no_rekam_medis LIKE ? OR 
				form_laboratorium.alamat LIKE ? OR 
				form_laboratorium.no_hp LIKE ? OR 
				form_laboratorium.keluhan LIKE ? OR 
				form_laboratorium.jenis_pemeriksaan LIKE ? OR 
				form_laboratorium.nama_pemeriksaan LIKE ? OR 
				form_laboratorium.dokter_pemeriksa LIKE ? OR 
				form_laboratorium.nama_poli LIKE ? OR 
				form_laboratorium.action LIKE ? OR 
				form_laboratorium.nilai_rujukan LIKE ? OR 
				form_laboratorium.hasil_pemeriksaan LIKE ? OR 
				form_laboratorium.id_form_lab LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "form_laboratorium/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("form_laboratorium.id_form_lab", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "pendaftaran Lab";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "form_laboratorium/ajax-list.php" : "form_laboratorium/list.php");
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
		$fields = array("form_laboratorium.tanggal", 
			"form_laboratorium.nama_pasien", 
			"form_laboratorium.no_rekam_medis", 
			"form_laboratorium.alamat", 
			"form_laboratorium.no_hp", 
			"form_laboratorium.keluhan", 
			"form_laboratorium.jenis_pemeriksaan", 
			"form_laboratorium.dokter_pemeriksa", 
			"data_dokter.nama_dokter AS data_dokter_nama_dokter", 
			"form_laboratorium.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"form_laboratorium.hasil_pemeriksaan");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("form_laboratorium.id_form_lab", $rec_id);; //select record based on primary key
		}
		$db->join("data_dokter", "form_laboratorium.dokter_pemeriksa = data_dokter.username", "INNER");
		$db->join("data_poli", "form_laboratorium.nama_poli = data_poli.id_poli", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View pendaftaran lab";
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
		return $this->render_view("form_laboratorium/view.php", $record);
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
			$fields = $this->fields = array("tanggal","nama_pasien","no_rekam_medis","alamat","no_hp","keluhan","jenis_pemeriksaan","hasil_pemeriksaan","nama_poli","dokter_pemeriksa");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'no_hp' => 'required',
				'keluhan' => 'required',
				'hasil_pemeriksaan' => 'required',
				'nama_poli' => 'required',
				'dokter_pemeriksa' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'hasil_pemeriksaan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("rekam_medis/add?csrf_token=ac4987bda9ed7b661654de287a2f61b3&precord=QZ6l7xVWACIbUiwepPu5P18pIaar+jpGG7ZTuPA+IZzTw8ZCHTPtIsJgOHSt95i839PuOZHj1S9BhScC+ZkszQ==");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New daftar lab";
		$this->render_view("form_laboratorium/add.php");
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
		$fields = $this->fields = array("tanggal","nama_pasien","no_rekam_medis","alamat","no_hp","keluhan","jenis_pemeriksaan","nama_pemeriksaan","hasil_pemeriksaan","nilai_rujukan","nama_poli","dokter_pemeriksa");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'no_hp' => 'required',
				'keluhan' => 'required',
				'nama_pemeriksaan' => 'required',
				'hasil_pemeriksaan' => 'required',
				'nilai_rujukan' => 'required',
				'nama_poli' => 'required',
				'dokter_pemeriksa' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'nama_pemeriksaan' => 'sanitize_string',
				'hasil_pemeriksaan' => 'sanitize_string',
				'nilai_rujukan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("form_laboratorium.id_form_lab", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("hasil_laboratorium/list");
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
						return	$this->redirect("hasil_laboratorium/list");
					}
				}
			}
		}
		$db->where("form_laboratorium.id_form_lab", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Daftar Lab";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("form_laboratorium/edit.php", $data);
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
		$fields = $this->fields = array("tanggal","nama_pasien","no_rekam_medis","alamat","no_hp","keluhan","jenis_pemeriksaan","nama_pemeriksaan","hasil_pemeriksaan","nilai_rujukan","nama_poli","dokter_pemeriksa");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'nama_pasien' => 'required',
				'no_rekam_medis' => 'required',
				'alamat' => 'required',
				'no_hp' => 'required',
				'keluhan' => 'required',
				'nama_pemeriksaan' => 'required',
				'hasil_pemeriksaan' => 'required',
				'nilai_rujukan' => 'required',
				'nama_poli' => 'required',
				'dokter_pemeriksa' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'nama_pemeriksaan' => 'sanitize_string',
				'hasil_pemeriksaan' => 'sanitize_string',
				'nilai_rujukan' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("form_laboratorium.id_form_lab", $rec_id);;
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
		$db->where("form_laboratorium.id_form_lab", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("form_laboratorium");
	}
}
