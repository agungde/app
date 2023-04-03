<?php 
/**
 * Transaksi_clinik Page Controller
 * @category  Controller
 */
class Transaksi_clinikController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "transaksi_clinik";
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
		$fields = array("date_created", 
			"id", 
			"nama_pasien", 
			"no_rekam_medis", 
			"keterangan_resep", 
			"resep_obat", 
			"keterangan_tindakan", 
			"biaya_tindakan", 
			"jasa_dokter", 
			"total_biaya", 
			"metode_pembayaran", 
			"dokter_pemeriksa", 
			"setatus_tagihan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				transaksi_clinik.date_created LIKE ? OR 
				transaksi_clinik.id LIKE ? OR 
				transaksi_clinik.id_rekam_medis LIKE ? OR 
				transaksi_clinik.tanggal LIKE ? OR 
				transaksi_clinik.nama_pasien LIKE ? OR 
				transaksi_clinik.no_rekam_medis LIKE ? OR 
				transaksi_clinik.alamat LIKE ? OR 
				transaksi_clinik.keluhan LIKE ? OR 
				transaksi_clinik.diagnosa LIKE ? OR 
				transaksi_clinik.keterangan_resep LIKE ? OR 
				transaksi_clinik.resep_obat LIKE ? OR 
				transaksi_clinik.keterangan_tindakan LIKE ? OR 
				transaksi_clinik.biaya_tindakan LIKE ? OR 
				transaksi_clinik.jasa_dokter LIKE ? OR 
				transaksi_clinik.total_biaya LIKE ? OR 
				transaksi_clinik.metode_pembayaran LIKE ? OR 
				transaksi_clinik.dokter_pemeriksa LIKE ? OR 
				transaksi_clinik.date_update LIKE ? OR 
				transaksi_clinik.setatus_tagihan LIKE ? OR 
				transaksi_clinik.date_updated LIKE ? OR 
				transaksi_clinik.user_entry LIKE ? OR 
				transaksi_clinik.action LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "transaksi_clinik/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("transaksi_clinik.id", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Transaksi Clinik";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "transaksi_clinik/ajax-list.php" : "transaksi_clinik/list.php");
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
		$fields = array("id", 
			"date_created", 
			"no_rekam_medis", 
			"nama_pasien", 
			"keterangan_tindakan", 
			"biaya_tindakan", 
			"jasa_dokter", 
			"resep_obat", 
			"total_biaya", 
			"metode_pembayaran", 
			"dokter_pemeriksa", 
			"setatus_tagihan");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("transaksi_clinik.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
			$page_title = $this->view->page_title = "View  Transaksi Clinik";
		$this->view->report_filename = date('d-m-Y') . '-' . $page_title;
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
		return $this->render_view("transaksi_clinik/view.php", $record);
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
			$fields = $this->fields = array("tanggal","no_rekam_medis","nama_pasien","keluhan","diagnosa","dokter_pemeriksa","keterangan_resep","resep_obat","keterangan_tindakan","biaya_tindakan","jasa_dokter","total_biaya","metode_pembayaran","setatus_tagihan","user_entry");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'keluhan' => 'required',
				'diagnosa' => 'required',
				'dokter_pemeriksa' => 'required',
				'keterangan_resep' => 'required',
				'resep_obat' => 'required',
				'keterangan_tindakan' => 'required',
				'biaya_tindakan' => 'required|numeric',
				'jasa_dokter' => 'required',
				'total_biaya' => 'required|numeric',
				'metode_pembayaran' => 'required',
				'setatus_tagihan' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'keterangan_resep' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'keterangan_tindakan' => 'sanitize_string',
				'biaya_tindakan' => 'sanitize_string',
				'jasa_dokter' => 'sanitize_string',
				'total_biaya' => 'sanitize_string',
				'metode_pembayaran' => 'sanitize_string',
				'setatus_tagihan' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("transaksi_clinik");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Transaksi Clinik";
		$this->render_view("transaksi_clinik/add.php");
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
		$fields = $this->fields = array("id","id_rekam_medis","tanggal","no_rekam_medis","nama_pasien","dokter_pemeriksa","keterangan_resep","resep_obat","keterangan_tindakan","biaya_tindakan","jasa_dokter","total_biaya","metode_pembayaran","setatus_tagihan","user_entry");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_rekam_medis' => 'required',
				'tanggal' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'dokter_pemeriksa' => 'required',
				'keterangan_resep' => 'required',
				'resep_obat' => 'required',
				'keterangan_tindakan' => 'required',
				'biaya_tindakan' => 'required|numeric',
				'jasa_dokter' => 'required',
				'total_biaya' => 'required|numeric',
				'metode_pembayaran' => 'required',
				'setatus_tagihan' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'id_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'keterangan_resep' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'keterangan_tindakan' => 'sanitize_string',
				'biaya_tindakan' => 'sanitize_string',
				'jasa_dokter' => 'sanitize_string',
				'total_biaya' => 'sanitize_string',
				'metode_pembayaran' => 'sanitize_string',
				'setatus_tagihan' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("transaksi_clinik.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
		# Statement to execute after adding record
			$db->rawQuery("UPDATE transaksi_clinik SET setatus_tagihan='Close' WHERE id='$rec_id'");
$id_user = "".USER_ID;
$dbhost  = "".DB_HOST;
$dbuser  = "".DB_USERNAME;
$dbpass  = "".DB_PASSWORD;
$dbname  = "".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
mysqli_query($koneksi,"UPDATE resep_obat SET pembayaran='Lunas' WHERE no_rekam_medis='".$_POST['no_rekam_medis']."' and tanggal='".$_POST['tanggal']."'");
		# End of after update statement
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("transaksi_clinik");
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
						return	$this->redirect("transaksi_clinik");
					}
				}
			}
		}
		$db->where("transaksi_clinik.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Transaksi Clinik";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("transaksi_clinik/edit.php", $data);
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
		$fields = $this->fields = array("id","id_rekam_medis","tanggal","no_rekam_medis","nama_pasien","dokter_pemeriksa","keterangan_resep","resep_obat","keterangan_tindakan","biaya_tindakan","jasa_dokter","total_biaya","metode_pembayaran","setatus_tagihan","user_entry");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_rekam_medis' => 'required',
				'tanggal' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'dokter_pemeriksa' => 'required',
				'keterangan_resep' => 'required',
				'resep_obat' => 'required',
				'keterangan_tindakan' => 'required',
				'biaya_tindakan' => 'required|numeric',
				'jasa_dokter' => 'required',
				'total_biaya' => 'required|numeric',
				'metode_pembayaran' => 'required',
				'setatus_tagihan' => 'required',
				'user_entry' => 'required',
			);
			$this->sanitize_array = array(
				'id_rekam_medis' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'keterangan_resep' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'keterangan_tindakan' => 'sanitize_string',
				'biaya_tindakan' => 'sanitize_string',
				'jasa_dokter' => 'sanitize_string',
				'total_biaya' => 'sanitize_string',
				'metode_pembayaran' => 'sanitize_string',
				'setatus_tagihan' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("transaksi_clinik.id", $rec_id);;
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
		$db->where("transaksi_clinik.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("transaksi_clinik");
	}
}
