<?php 
/**
 * Data_resep Page Controller
 * @category  Controller
 */
class Data_resepController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "data_resep";
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
		$fields = array("data_resep.id_data_resep", 
			"data_resep.date_created", 
			"data_resep.no_rekam_medis", 
			"data_resep.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"data_resep.nama_dokter", 
			"data_resep.nama_pasien", 
			"data_resep.alamat", 
			"data_resep.tanggal_lahir", 
			"data_resep.umur", 
			"data_resep.nama_obat", 
			"data_resep.aturan_minum", 
			"data_resep.jumlah", 
			"data_resep.setatus", 
			"data_resep.action");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				data_resep.id_data_resep LIKE ? OR 
				data_resep.id_obat LIKE ? OR 
				data_resep.date_created LIKE ? OR 
				data_resep.tanggal LIKE ? OR 
				data_resep.no_rekam_medis LIKE ? OR 
				data_resep.nama_poli LIKE ? OR 
				data_resep.nama_dokter LIKE ? OR 
				data_resep.nama_pasien LIKE ? OR 
				data_resep.alamat LIKE ? OR 
				data_resep.tanggal_lahir LIKE ? OR 
				data_resep.umur LIKE ? OR 
				data_resep.nama_obat LIKE ? OR 
				data_resep.aturan_minum LIKE ? OR 
				data_resep.jumlah LIKE ? OR 
				data_resep.setatus LIKE ? OR 
				data_resep.action LIKE ? OR 
				data_resep.id_resep_obat LIKE ? OR 
				data_resep.date_updated LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "data_resep/search.php";
		}
		$db->join("data_poli", "data_resep.nama_poli = data_poli.id_poli", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("data_resep.id_data_resep", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Data Resep";
		$view_name = (is_ajax() ? "data_resep/ajax-list.php" : "data_resep/list.php");
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
		$fields = array("data_resep.date_created", 
			"data_resep.id_data_resep", 
			"data_resep.no_rekam_medis", 
			"data_resep.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"data_resep.nama_dokter", 
			"data_resep.nama_pasien", 
			"data_resep.alamat", 
			"data_resep.tanggal_lahir", 
			"data_resep.umur", 
			"data_resep.nama_obat", 
			"data_resep.aturan_minum", 
			"data_resep.jumlah", 
			"data_resep.setatus", 
			"data_resep.action");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("data_resep.id_data_resep", $rec_id);; //select record based on primary key
		}
		$db->join("data_poli", "data_resep.nama_poli = data_poli.id_poli", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Data Resep";
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
		return $this->render_view("data_resep/view.php", $record);
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
			$fields = $this->fields = array("id_obat","no_rekam_medis","tanggal","nama_poli","nama_dokter","nama_pasien","alamat","tanggal_lahir","umur","nama_obat","aturan_minum","jumlah","setatus");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_obat' => 'required|numeric',
				'no_rekam_medis' => 'required',
				'tanggal' => 'required',
				'nama_poli' => 'required',
				'nama_dokter' => 'required',
				'nama_pasien' => 'required',
				'alamat' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'nama_obat' => 'required',
				'aturan_minum' => 'required',
				'jumlah' => 'required',
				'setatus' => 'required',
			);
			$this->sanitize_array = array(
				'id_obat' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'nama_dokter' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'nama_obat' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'setatus' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("data_resep");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Data Resep";
		$this->render_view("data_resep/add.php");
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
		$fields = $this->fields = array("id_data_resep","id_obat","no_rekam_medis","tanggal","nama_poli","nama_dokter","nama_pasien","alamat","tanggal_lahir","umur","nama_obat","aturan_minum","jumlah","setatus");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_obat' => 'required|numeric',
				'no_rekam_medis' => 'required',
				'tanggal' => 'required',
				'nama_poli' => 'required',
				'nama_dokter' => 'required',
				'nama_pasien' => 'required',
				'alamat' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'nama_obat' => 'required',
				'aturan_minum' => 'required',
				'jumlah' => 'required',
				'setatus' => 'required',
			);
			$this->sanitize_array = array(
				'id_obat' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'nama_dokter' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'nama_obat' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'setatus' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("data_resep.id_data_resep", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("data_resep");
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
						return	$this->redirect("data_resep");
					}
				}
			}
		}
		$db->where("data_resep.id_data_resep", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Data Resep";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("data_resep/edit.php", $data);
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
		$fields = $this->fields = array("id_data_resep","id_obat","no_rekam_medis","tanggal","nama_poli","nama_dokter","nama_pasien","alamat","tanggal_lahir","umur","nama_obat","aturan_minum","jumlah","setatus");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_obat' => 'required|numeric',
				'no_rekam_medis' => 'required',
				'tanggal' => 'required',
				'nama_poli' => 'required',
				'nama_dokter' => 'required',
				'nama_pasien' => 'required',
				'alamat' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'nama_obat' => 'required',
				'aturan_minum' => 'required',
				'jumlah' => 'required',
				'setatus' => 'required',
			);
			$this->sanitize_array = array(
				'id_obat' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'nama_dokter' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'nama_obat' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'setatus' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("data_resep.id_data_resep", $rec_id);;
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
		$db->where("data_resep.id_data_resep", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("data_resep");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function proses($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_obat","no_rekam_medis","tanggal","nama_poli","nama_dokter","nama_pasien","alamat","tanggal_lahir","umur","nama_obat","aturan_minum","jumlah","setatus","date_created","action","id_resep_obat","date_updated");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_obat' => 'required|numeric',
				'no_rekam_medis' => 'required',
				'tanggal' => 'required',
				'nama_poli' => 'required',
				'nama_dokter' => 'required',
				'nama_pasien' => 'required',
				'alamat' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'nama_obat' => 'required',
				'aturan_minum' => 'required',
				'jumlah' => 'required',
				'setatus' => 'required',
				'date_created' => 'required',
				'action' => 'required',
				'id_resep_obat' => 'required|numeric',
				'date_updated' => 'required',
			);
			$this->sanitize_array = array(
				'id_obat' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'nama_dokter' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'nama_obat' => 'sanitize_string',
				'aturan_minum' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'setatus' => 'sanitize_string',
				'date_created' => 'sanitize_string',
				'action' => 'sanitize_string',
				'id_resep_obat' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("data_resep");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Data Resep";
		$this->render_view("data_resep/proses.php");
	}
}
