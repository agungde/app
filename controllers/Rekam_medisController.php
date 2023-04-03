<?php 
/**
 * Rekam_medis Page Controller
 * @category  Controller
 */
class Rekam_medisController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "rekam_medis";
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
		$fields = array("rekam_medis.id_rekam_medis", 
			"rekam_medis.date_created", 
			"rekam_medis.no_rekam_medis", 
			"rekam_medis.nama_pasien", 
			"rekam_medis.tinggi", 
			"rekam_medis.berat_badan", 
			"rekam_medis.tensi", 
			"rekam_medis.jenis_kelamin", 
			"rekam_medis.tanggal_lahir", 
			"rekam_medis.umur", 
			"rekam_medis.tindakan", 
			"rekam_medis.nama_pemeriksaan_lab", 
			"rekam_medis.keluhan", 
			"rekam_medis.diagnosa", 
			"rekam_medis.rujukan", 
			"rekam_medis.resep_obat", 
			"rekam_medis.persetujuan_tindakan", 
			"rekam_medis.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"rekam_medis.dokter_pemeriksa", 
			"rekam_medis.user_entry", 
			"rekam_medis.hasil_laboratorium_radiologi", 
			"rekam_medis.jenis_tindakan_lab");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				rekam_medis.id_rekam_medis LIKE ? OR 
				rekam_medis.date_created LIKE ? OR 
				rekam_medis.no_rekam_medis LIKE ? OR 
				rekam_medis.nama_pasien LIKE ? OR 
				rekam_medis.tinggi LIKE ? OR 
				rekam_medis.berat_badan LIKE ? OR 
				rekam_medis.tensi LIKE ? OR 
				rekam_medis.jenis_kelamin LIKE ? OR 
				rekam_medis.tanggal_lahir LIKE ? OR 
				rekam_medis.alamat LIKE ? OR 
				rekam_medis.no_hp LIKE ? OR 
				rekam_medis.umur LIKE ? OR 
				rekam_medis.tindakan LIKE ? OR 
				rekam_medis.nama_pemeriksaan_lab LIKE ? OR 
				rekam_medis.keluhan LIKE ? OR 
				rekam_medis.diagnosa LIKE ? OR 
				rekam_medis.rujukan LIKE ? OR 
				rekam_medis.resep_obat LIKE ? OR 
				rekam_medis.tanggal LIKE ? OR 
				rekam_medis.email LIKE ? OR 
				rekam_medis.persetujuan_tindakan LIKE ? OR 
				rekam_medis.nama_poli LIKE ? OR 
				rekam_medis.dokter_pemeriksa LIKE ? OR 
				rekam_medis.setatus_tagihan LIKE ? OR 
				rekam_medis.id_pendaftaran_poli LIKE ? OR 
				rekam_medis.pembayaran LIKE ? OR 
				rekam_medis.date_updated LIKE ? OR 
				rekam_medis.user_entry LIKE ? OR 
				rekam_medis.hasil_laboratorium_radiologi LIKE ? OR 
				rekam_medis.id_lab LIKE ? OR 
				rekam_medis.jenis_tindakan_lab LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "rekam_medis/search.php";
		}
		$db->join("data_poli", "rekam_medis.nama_poli = data_poli.id_poli", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("rekam_medis.id_rekam_medis", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->rekam_medis_nama_poli)){
			$val = $request->rekam_medis_nama_poli;
			$db->where("rekam_medis.nama_poli", $val , "=");
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
		$page_title = $this->view->page_title = "Rekam Medis";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$view_name = (is_ajax() ? "rekam_medis/ajax-list.php" : "rekam_medis/list.php");
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
		$fields = array("rekam_medis.id_rekam_medis", 
			"rekam_medis.no_rekam_medis", 
			"rekam_medis.nama_pasien", 
			"rekam_medis.alamat", 
			"rekam_medis.no_hp", 
			"rekam_medis.keluhan", 
			"rekam_medis.tindakan", 
			"rekam_medis.nama_pemeriksaan_lab", 
			"rekam_medis.diagnosa", 
			"rekam_medis.rujukan", 
			"rekam_medis.email", 
			"rekam_medis.persetujuan_tindakan", 
			"rekam_medis.nama_poli", 
			"data_poli.nama_poli AS data_poli_nama_poli", 
			"rekam_medis.dokter_pemeriksa", 
			"rekam_medis.resep_obat", 
			"rekam_medis.jenis_kelamin", 
			"rekam_medis.tanggal_lahir", 
			"rekam_medis.umur", 
			"rekam_medis.date_created", 
			"rekam_medis.pembayaran", 
			"rekam_medis.date_updated", 
			"rekam_medis.user_entry", 
			"rekam_medis.tinggi", 
			"rekam_medis.berat_badan", 
			"rekam_medis.tensi", 
			"rekam_medis.hasil_laboratorium_radiologi", 
			"rekam_medis.id_lab", 
			"rekam_medis.jenis_tindakan_lab");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("rekam_medis.id_rekam_medis", $rec_id);; //select record based on primary key
		}
		$db->join("data_poli", "rekam_medis.nama_poli = data_poli.id_poli", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['tanggal_lahir'] = format_date($record['tanggal_lahir'],'d-m-Y');
$record['date_created'] = format_date($record['date_created'],'d-m-Y H:i:s');
			$page_title = $this->view->page_title = "View  Rekam Medis";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("rekam_medis/view.php", $record);
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
			$fields = $this->fields = array("tanggal","no_rekam_medis","nama_pasien","jenis_kelamin","tanggal_lahir","umur","tinggi","berat_badan","tensi","keluhan","diagnosa","persetujuan_tindakan","tindakan","nama_pemeriksaan_lab","rujukan","hasil_laboratorium_radiologi","dokter_pemeriksa","nama_poli","resep_obat","pembayaran","user_entry","jenis_tindakan_lab");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'jenis_kelamin' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'keluhan' => 'required',
				'diagnosa' => 'required',
				'persetujuan_tindakan' => 'required',
				'tindakan' => 'required',
				'rujukan' => 'required',
				'dokter_pemeriksa' => 'required',
				'nama_poli' => 'required',
				'resep_obat' => 'required',
				'pembayaran' => 'required',
				'user_entry' => 'required',
				'jenis_tindakan_lab' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'persetujuan_tindakan' => 'sanitize_string',
				'tindakan' => 'sanitize_string',
				'nama_pemeriksaan_lab' => 'sanitize_string',
				'rujukan' => 'sanitize_string',
				'hasil_laboratorium_radiologi' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
				'jenis_tindakan_lab' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
$id_user = "".USER_ID;
$dbhost  = "".DB_HOST;
$dbuser  = "".DB_USERNAME;
$dbpass  = "".DB_PASSWORD;
$dbname  = "".DB_NAME;
//$koneksi=open_connection();
$koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
$no_rekam_medis = $_POST['no_rekam_medis'];
$tanggal        = $_POST['tanggal'];
$nama_poli      = $_POST['nama_poli'];
$result         = mysqli_query($koneksi, "SELECT SUM(total_bayar) AS tot FROM penjualan WHERE id_pelanggan='$no_rekam_medis' and tanggal='$tanggal' and nama_poli='$nama_poli'"); 
$row            = mysqli_fetch_assoc($result); 
$sum            = $row['tot'];
$rowid          = 1;
$resulti        = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_pelanggan='$no_rekam_medis' and tanggal='$tanggal' and nama_poli='$nama_poli'"); 
while ($row=mysqli_fetch_array($resulti)){
    $nambar = $row['nama_barang'];
if($rowid=="1"){
  $db->rawQuery("UPDATE rekam_medis SET resep_obat='".$row['nama_barang']."' WHERE id_rekam_medis='$rec_id'");
  }else{
 $resultii = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id_rekam_medis='$rec_id'"); 
 while ($rowi=mysqli_fetch_array($resultii)){
     $namabar = $rowi['resep_obat'];
      $koma     = ",";
 $isiresep = "$namabar$koma  $nambar";
    $db->rawQuery("UPDATE rekam_medis SET resep_obat='$isiresep' WHERE id_rekam_medis='$rec_id'"); 
}  
}
    $rowid = $rowid + 1;
}
$kettindakan = "";
$totharga    = "0";
    $cektindakan = $_POST['tindakan'];
    if(!empty( $cektindakan)){
        for($a = 0; $a < count( $cektindakan); $a++){
            if(!empty( $cektindakan[$a])){
                $idtin =  $cektindakan[$a];
 $res = mysqli_query($koneksi, "SELECT * FROM list_biaya_tindakan WHERE id='$idtin'"); 
 while ($rowii=mysqli_fetch_array($res)){
     $biaya_tindakan = $rowii['harga'];
     $tindakan       = $rowii['nama_tindakan'];
 }
  $totharga    = $totharga +  $biaya_tindakan;
if($kettindakan==""){
$kettindakan = "$tindakan";
}else{
    $kettindakan = "$kettindakan $tindakan";
}
            }
        }
    }
$db->rawQuery("UPDATE rekam_medis SET setatus_tagihan='Open', tindakan='$kettindakan' WHERE id_rekam_medis='$rec_id'");
 $resi = mysqli_query($koneksi, "SELECT * FROM data_dokter WHERE id_user='$id_user'"); 
 while ($rowii=mysqli_fetch_array($resi)){
     $jasa_poli = $rowii['jasa_poli'];
 }
 $total_biaya = $sum + $jasa_poli + $totharga;
 mysqli_query($koneksi,"INSERT INTO `transaksi_clinik` (`total_biaya`,`keterangan_resep`,`jasa_dokter`,`keterangan_tindakan`,`biaya_tindakan`,`metode_pembayaran`,`id_rekam_medis`, `no_rekam_medis`, `tanggal`, `nama_pasien`, `alamat`, `keluhan`, `diagnosa`, `dokter_pemeriksa`, `resep_obat`, `setatus_tagihan`) VALUES ('$total_biaya','$isiresep','$jasa_poli','$kettindakan','$totharga','".$_POST['pembayaran']."','$rec_id', '".$_POST['no_rekam_medis']."', '".$_POST['tanggal']."', '".$_POST['nama_pasien']."', '".$_POST['alamat']."', '".$_POST['keluhan']."', '".$_POST['diagnosa']."', '".$_POST['dokter_pemeriksa']."', '$sum', 'Proses')"); 
$id_daftar = trim($_POST['id_pendaftaran_poli']);
mysqli_query($koneksi,"UPDATE pendaftaran_poli SET setatus='Closed' WHERE id_pendaftaran_poli='$id_daftar'");
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("rekam_medis");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Rekam Medis";
		$this->render_view("rekam_medis/add.php");
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
		$fields = $this->fields = array("id_rekam_medis","tanggal","no_rekam_medis","nama_pasien","jenis_kelamin","tanggal_lahir","umur","tinggi","berat_badan","tensi","alamat","keluhan","diagnosa","persetujuan_tindakan","tindakan","nama_pemeriksaan_lab","rujukan","hasil_laboratorium_radiologi","dokter_pemeriksa","nama_poli","resep_obat","pembayaran","user_entry","jenis_tindakan_lab");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'tanggal' => 'required',
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'jenis_kelamin' => 'required',
				'tanggal_lahir' => 'required',
				'umur' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'alamat' => 'required',
				'keluhan' => 'required',
				'diagnosa' => 'required',
				'persetujuan_tindakan' => 'required',
				'tindakan' => 'required',
				'rujukan' => 'required',
				'dokter_pemeriksa' => 'required',
				'nama_poli' => 'required',
				'resep_obat' => 'required',
				'pembayaran' => 'required',
				'user_entry' => 'required',
				'jenis_tindakan_lab' => 'required',
			);
			$this->sanitize_array = array(
				'tanggal' => 'sanitize_string',
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'persetujuan_tindakan' => 'sanitize_string',
				'tindakan' => 'sanitize_string',
				'nama_pemeriksaan_lab' => 'sanitize_string',
				'rujukan' => 'sanitize_string',
				'hasil_laboratorium_radiologi' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
				'jenis_tindakan_lab' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("rekam_medis.id_rekam_medis", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("rekam_medis");
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
						return	$this->redirect("rekam_medis");
					}
				}
			}
		}
		$db->where("rekam_medis.id_rekam_medis", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Rekam Medis";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("rekam_medis/edit.php", $data);
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
		$db->where("rekam_medis.id_rekam_medis", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("rekam_medis");
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function resep($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("no_rekam_medis","nama_pasien","alamat","no_hp","tindakan","keluhan","diagnosa","resep_obat","tanggal","email","persetujuan_tindakan","dokter_pemeriksa","jenis_kelamin","umur","setatus_tagihan","date_created","tanggal_lahir","id_pendaftaran_poli","nama_poli","rujukan","pembayaran","date_updated","user_entry","tinggi","berat_badan","tensi","hasil_laboratorium_radiologi","id_lab","nama_pemeriksaan_lab","jenis_tindakan_lab");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_rekam_medis' => 'required',
				'nama_pasien' => 'required',
				'alamat' => 'required',
				'no_hp' => 'required|numeric',
				'tindakan' => 'required',
				'keluhan' => 'required',
				'diagnosa' => 'required',
				'resep_obat' => 'required',
				'tanggal' => 'required',
				'email' => 'required|valid_email',
				'persetujuan_tindakan' => 'required',
				'dokter_pemeriksa' => 'required',
				'jenis_kelamin' => 'required',
				'umur' => 'required',
				'setatus_tagihan' => 'required',
				'date_created' => 'required',
				'tanggal_lahir' => 'required',
				'id_pendaftaran_poli' => 'required|numeric',
				'nama_poli' => 'required',
				'rujukan' => 'required',
				'pembayaran' => 'required',
				'date_updated' => 'required',
				'user_entry' => 'required',
				'tinggi' => 'required',
				'berat_badan' => 'required',
				'tensi' => 'required',
				'hasil_laboratorium_radiologi' => 'required',
				'id_lab' => 'required|numeric',
				'nama_pemeriksaan_lab' => 'required',
				'jenis_tindakan_lab' => 'required',
			);
			$this->sanitize_array = array(
				'no_rekam_medis' => 'sanitize_string',
				'nama_pasien' => 'sanitize_string',
				'alamat' => 'sanitize_string',
				'no_hp' => 'sanitize_string',
				'tindakan' => 'sanitize_string',
				'keluhan' => 'sanitize_string',
				'diagnosa' => 'sanitize_string',
				'resep_obat' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'email' => 'sanitize_string',
				'persetujuan_tindakan' => 'sanitize_string',
				'dokter_pemeriksa' => 'sanitize_string',
				'jenis_kelamin' => 'sanitize_string',
				'umur' => 'sanitize_string',
				'setatus_tagihan' => 'sanitize_string',
				'date_created' => 'sanitize_string',
				'tanggal_lahir' => 'sanitize_string',
				'id_pendaftaran_poli' => 'sanitize_string',
				'nama_poli' => 'sanitize_string',
				'rujukan' => 'sanitize_string',
				'pembayaran' => 'sanitize_string',
				'date_updated' => 'sanitize_string',
				'user_entry' => 'sanitize_string',
				'tinggi' => 'sanitize_string',
				'berat_badan' => 'sanitize_string',
				'tensi' => 'sanitize_string',
				'hasil_laboratorium_radiologi' => 'sanitize_string',
				'id_lab' => 'sanitize_string',
				'nama_pemeriksaan_lab' => 'sanitize_string',
				'jenis_tindakan_lab' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("rekam_medis");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Rekam Medis";
		$this->render_view("rekam_medis/resep.php");
	}
}
