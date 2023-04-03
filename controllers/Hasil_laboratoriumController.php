<?php 
/**
 * Hasil_laboratorium Page Controller
 * @category  Controller
 */
class Hasil_laboratoriumController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "hasil_laboratorium";
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
		$fields = array("nama_pasien", 
			"no_rekam_medis", 
			"dokter_pengirim", 
			"jenis_pemeriksaan", 
			"dokter_laboratorium", 
			"diagnosa");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				hasil_laboratorium.nama_pasien LIKE ? OR 
				hasil_laboratorium.no_rekam_medis LIKE ? OR 
				hasil_laboratorium.hasil LIKE ? OR 
				hasil_laboratorium.nilai_rujukan LIKE ? OR 
				hasil_laboratorium.dokter_pengirim LIKE ? OR 
				hasil_laboratorium.action LIKE ? OR 
				hasil_laboratorium.hasil_pemeriksaan LIKE ? OR 
				hasil_laboratorium.id_hasil_lab LIKE ? OR 
				hasil_laboratorium.id_list LIKE ? OR 
				hasil_laboratorium.jenis_pemeriksaan LIKE ? OR 
				hasil_laboratorium.dokter_laboratorium LIKE ? OR 
				hasil_laboratorium.diagnosa LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "hasil_laboratorium/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("hasil_laboratorium.id_hasil_lab", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Hasil Laboratorium";
		$view_name = (is_ajax() ? "hasil_laboratorium/ajax-list.php" : "hasil_laboratorium/list.php");
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
		$fields = array("nama_pasien", 
			"no_rekam_medis", 
			"jenis_pemeriksaan", 
			"dokter_pengirim", 
			"dokter_laboratorium", 
			"diagnosa");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("hasil_laboratorium.id_hasil_lab", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Hasil Laboratorium";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("hasil_laboratorium/view.php", $record);
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
			$fields = $this->fields = array("no_rekam_medis","nama_pasien","jenis_pemeriksaan","dokter_pengirim","dokter_laboratorium","diagnosa");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'jenis_pemeriksaan' => 'required',
				'dokter_pengirim' => 'required',
				'dokter_laboratorium' => 'required',
				'diagnosa' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'dokter_pengirim' => 'sanitize_string',
				'dokter_laboratorium' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					// insert List_hasil_lab record
					$list_hasil_lab_controller = new List_hasil_labController;
					$list_hasil_lab_controller->return_value = true; // return value instead of view
					$hasil_laboratorium_formdata = $formdata['list_hasil_lab'];
					$list_hasil_lab_controller_rec_id = $list_hasil_lab_controller->add($hasil_laboratorium_formdata, $rec_id);
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("hasil_laboratorium");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$this->render_view("hasil_laboratorium/add.php");
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
		$fields = $this->fields = array("no_rekam_medis","nama_pasien","hasil_pemeriksaan","hasil","jenis_pemeriksaan","dokter_pengirim","id_hasil_lab","id_list","dokter_laboratorium","diagnosa");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'hasil_pemeriksaan' => 'required',
				'hasil' => 'required',
				'jenis_pemeriksaan' => 'required',
				'dokter_pengirim' => 'required',
				'id_hasil_lab' => 'required|numeric',
				'dokter_laboratorium' => 'required',
				'diagnosa' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'hasil_pemeriksaan' => 'sanitize_string',
				'hasil' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'dokter_pengirim' => 'sanitize_string',
				'id_hasil_lab' => 'sanitize_string',
				'dokter_laboratorium' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("hasil_laboratorium.id_hasil_lab", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("hasil_laboratorium");
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
						return	$this->redirect("hasil_laboratorium");
					}
				}
			}
		}
		$db->where("hasil_laboratorium.id_hasil_lab", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Hasil Laboratorium";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("hasil_laboratorium/edit.php", $data);
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
		$fields = $this->fields = array("no_rekam_medis","nama_pasien","hasil_pemeriksaan","hasil","jenis_pemeriksaan","dokter_pengirim","id_hasil_lab","id_list","dokter_laboratorium","diagnosa");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'hasil_pemeriksaan' => 'required',
				'hasil' => 'required',
				'jenis_pemeriksaan' => 'required',
				'dokter_pengirim' => 'required',
				'id_hasil_lab' => 'required|numeric',
				'dokter_laboratorium' => 'required',
				'diagnosa' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'hasil_pemeriksaan' => 'sanitize_string',
				'hasil' => 'sanitize_string',
				'jenis_pemeriksaan' => 'sanitize_string',
				'dokter_pengirim' => 'sanitize_string',
				'id_hasil_lab' => 'sanitize_string',
				'dokter_laboratorium' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("hasil_laboratorium.id_hasil_lab", $rec_id);;
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
		$db->where("hasil_laboratorium.id_hasil_lab", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("hasil_laboratorium");
	}
}
