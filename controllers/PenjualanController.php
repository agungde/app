<?php 
/**
 * Penjualan Page Controller
 * @category  Controller
 */
class PenjualanController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "penjualan";
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
		$fields = array("id_penjualan", 
			"tanggal", 
			"nama_pelanggan", 
			"alamat", 
			"kode_barang", 
			"nama_barang", 
			"jumlah", 
			"harga", 
			"total_harga", 
			"discount", 
			"total_bayar", 
			"ppn", 
			"date_created");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				penjualan.id_penjualan LIKE ? OR 
				penjualan.tanggal LIKE ? OR 
				penjualan.nama_pelanggan LIKE ? OR 
				penjualan.alamat LIKE ? OR 
				penjualan.kode_barang LIKE ? OR 
				penjualan.nama_barang LIKE ? OR 
				penjualan.jumlah LIKE ? OR 
				penjualan.harga LIKE ? OR 
				penjualan.total_harga LIKE ? OR 
				penjualan.discount LIKE ? OR 
				penjualan.total_bayar LIKE ? OR 
				penjualan.ppn LIKE ? OR 
				penjualan.id_pelanggan LIKE ? OR 
				penjualan.date_created LIKE ? OR 
				penjualan.nama_poli LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "penjualan/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("penjualan.id_penjualan", ORDER_TYPE);
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
				$record['tanggal'] = format_date($record['tanggal'],'d-m-Y ');
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
		$page_title = $this->view->page_title = "Penjualan";
		$view_name = (is_ajax() ? "penjualan/ajax-list.php" : "penjualan/list.php");
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
		$fields = array("id_penjualan", 
			"tanggal", 
			"nama_pelanggan", 
			"alamat", 
			"kode_barang", 
			"nama_barang", 
			"jumlah", 
			"harga", 
			"total_harga", 
			"discount", 
			"total_bayar", 
			"ppn", 
			"date_created");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("penjualan.id_penjualan", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal'] = format_date($record['tanggal'],'d-m-Y ');
$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
			$page_title = $this->view->page_title = "View  Penjualan";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("penjualan/view.php", $record);
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
			$fields = $this->fields = array("id_penjualan","nama_pelanggan","alamat","kode_barang","nama_barang","jumlah","harga","total_harga","discount","total_bayar","ppn","id_pelanggan","tanggal");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_penjualan' => 'required|numeric',
				'nama_pelanggan' => 'required',
				'alamat' => 'required',
				'kode_barang' => 'required',
				'nama_barang' => 'required',
				'jumlah' => 'required',
				'harga' => 'required',
				'total_harga' => 'required',
				'discount' => 'required',
				'total_bayar' => 'required',
				'ppn' => 'required',
				'id_pelanggan' => 'required|numeric',
				'tanggal' => 'required',
			);
			$this->sanitize_array = array(
				'id_penjualan' => 'sanitize_string',
				'nama_pelanggan' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'kode_barang' => 'sanitize_string',
				'nama_barang' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'total_harga' => 'sanitize_string',
				'discount' => 'sanitize_string',
				'total_bayar' => 'sanitize_string',
				'ppn' => 'sanitize_string',
				'id_pelanggan' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("penjualan");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Penjualan";
		$this->render_view("penjualan/add.php");
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
		$fields = $this->fields = array("id_penjualan","nama_pelanggan","alamat","kode_barang","nama_barang","jumlah","harga","total_harga","discount","total_bayar","ppn","id_pelanggan","tanggal");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_penjualan' => 'required|numeric',
				'nama_pelanggan' => 'required',
				'alamat' => 'required',
				'kode_barang' => 'required',
				'nama_barang' => 'required',
				'jumlah' => 'required',
				'harga' => 'required',
				'total_harga' => 'required',
				'discount' => 'required',
				'total_bayar' => 'required',
				'ppn' => 'required',
				'id_pelanggan' => 'required|numeric',
				'tanggal' => 'required',
			);
			$this->sanitize_array = array(
				'id_penjualan' => 'sanitize_string',
				'nama_pelanggan' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'kode_barang' => 'sanitize_string',
				'nama_barang' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
				'harga' => 'sanitize_string',
				'total_harga' => 'sanitize_string',
				'discount' => 'sanitize_string',
				'total_bayar' => 'sanitize_string',
				'ppn' => 'sanitize_string',
				'id_pelanggan' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("penjualan.id_penjualan", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("penjualan");
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
						return	$this->redirect("penjualan");
					}
				}
			}
		}
		$db->where("penjualan.id_penjualan", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Penjualan";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("penjualan/edit.php", $data);
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
		$db->where("penjualan.id_penjualan", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("penjualan");
	}
}
