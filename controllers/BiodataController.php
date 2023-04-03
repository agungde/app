<?php 
/**
 * Biodata Page Controller
 * @category  Controller
 */
class BiodataController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "biodata";
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
		$fields = array("id_biodata", 
			"no_ktp", 
			"nama", 
			"alamat", 
			"tanggal_lahir", 
			"no_hp", 
			"jenis_kelamin", 
			"umur", 
			"email", 
			"photo", 
			"date_created", 
			"date_update", 
			"date_updated");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	 $id_user = "".USER_ID;
 $dbhost="".DB_HOST;
$dbuser="".DB_USERNAME;
$dbpass="".DB_PASSWORD;
$dbname="".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$sqlcek  = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
while ($row=mysqli_fetch_array($sqlcek)){
$cekdata=$row['user_role_id'];
}
if($cekdata=="1" or $cekdata=="4"){
}else{
    $db->where("id_user='". USER_ID . "'");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				biodata.id_biodata LIKE ? OR 
				biodata.id_user LIKE ? OR 
				biodata.no_rekam_medis LIKE ? OR 
				biodata.no_ktp LIKE ? OR 
				biodata.nama LIKE ? OR 
				biodata.alamat LIKE ? OR 
				biodata.tanggal_lahir LIKE ? OR 
				biodata.no_hp LIKE ? OR 
				biodata.jenis_kelamin LIKE ? OR 
				biodata.umur LIKE ? OR 
				biodata.email LIKE ? OR 
				biodata.photo LIKE ? OR 
				biodata.action LIKE ? OR 
				biodata.date_created LIKE ? OR 
				biodata.date_update LIKE ? OR 
				biodata.date_updated LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "biodata/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("biodata.id_biodata", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Biodata";
		$view_name = (is_ajax() ? "biodata/ajax-list.php" : "biodata/list.php");
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
		$fields = array("id_biodata", 
			"no_rekam_medis", 
			"nama", 
			"tanggal_lahir", 
			"no_hp", 
			"alamat", 
			"jenis_kelamin", 
			"umur", 
			"email", 
			"photo", 
			"date_created", 
			"no_ktp", 
			"date_update", 
			"date_updated");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("biodata.id_biodata", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Biodata";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("biodata/view.php", $record);
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
			$fields = $this->fields = array("no_ktp","nama","tanggal_lahir","no_hp","alamat","jenis_kelamin","photo","date_update","date_updated");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_ktp' => 'required',
				'nama' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
			);
			$this->sanitize_array = array(
				'no_ktp' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			$db->where("no_ktp", $modeldata['no_ktp']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['no_ktp']." Already exist!";
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		$id_user = "".USER_ID;
$dbhost="".DB_HOST;
$dbuser="".DB_USERNAME;
$dbpass="".DB_PASSWORD;
$dbname="".DB_NAME;
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
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
$db->rawQuery("UPDATE biodata SET id_user='$id_user', umur='$umurnya' WHERE id_biodata='$rec_id'");
$csls = mysqli_query($koneksi,"select * from user_login where id_userlogin='$id_user'");
while ($rowsls=mysqli_fetch_array($csls )){
    $rolid = trim($rowsls['user_role_id']);
    $email = trim($rowsls['email']);
  }
   if($rolid=="2"){
     mysqli_query($koneksi,"UPDATE biodata SET email='$email' WHERE id_biodata='$rec_id'");
     //  echo $email;
     $email = $email;
     }else{
         $email = $_POST['email'];
     }
     mysqli_query($koneksi,"INSERT INTO `data_pasien` (`no_ktp`,`nama_pasien`, `tanggal_lahir`, `no_hp`, `alamat`, `jenis_kelamin`, `umur`, `email`, `photo`, `id_user`) VALUES ('".$_POST['no_ktp']."','".$_POST['nama']."', '".$_POST['tanggal_lahir']."', '".$_POST['no_hp']."', '".$_POST['alamat']."', '".$_POST['jenis_kelamin']."', '$umurnya', '$email', '".$_POST['photo']."', '$id_user')"); 
$csls = mysqli_query($koneksi,"select * from data_pasien where  id_user='$id_user'");
while ($rowsls=mysqli_fetch_array($csls )){
    $tracesid = trim($rowsls['id_pasien']);
}
$norekammedis = "RMP$tracesid";
mysqli_query($koneksi,"UPDATE data_pasien SET no_rekam_medis='$norekammedis' WHERE id_user='$id_user'");
$db->rawQuery("UPDATE biodata SET no_rekam_medis='$norekammedis' WHERE id_biodata='$rec_id'");
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("biodata");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Biodata";
		$this->render_view("biodata/add.php");
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
		$fields = $this->fields = array("id_biodata","no_ktp","nama","tanggal_lahir","no_hp","alamat","jenis_kelamin","photo","date_update","date_updated");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_ktp' => 'required',
				'nama' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
			);
			$this->sanitize_array = array(
				'no_ktp' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['no_ktp'])){
				$db->where("no_ktp", $modeldata['no_ktp'])->where("id_biodata", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['no_ktp']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("biodata.id_biodata", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("biodata");
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
						return	$this->redirect("biodata");
					}
				}
			}
		}
		$db->where("biodata.id_biodata", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Biodata";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("biodata/edit.php", $data);
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
		$fields = $this->fields = array("id_biodata","no_ktp","nama","tanggal_lahir","no_hp","alamat","jenis_kelamin","photo","date_update","date_updated");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'no_ktp' => 'required',
				'nama' => 'required',
				'tanggal_lahir' => 'required',
				'no_hp' => 'required',
				'alamat' => 'required',
				'jenis_kelamin' => 'required',
				'date_update' => 'required',
				'date_updated' => 'required',
			);
			$this->sanitize_array = array(
				'no_ktp' => 'sanitize_string',
				'nama' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'photo' => 'sanitize_string',
				'date_update' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['no_ktp'])){
				$db->where("no_ktp", $modeldata['no_ktp'])->where("id_biodata", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['no_ktp']." Already exist!";
				}
			} 
			if($this->validated()){
				$db->where("biodata.id_biodata", $rec_id);;
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
		$db->where("biodata.id_biodata", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("biodata");
	}
}
