<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("transaksi_clinik/add");
$can_edit = ACL::is_allowed("transaksi_clinik/edit");
$can_view = ACL::is_allowed("transaksi_clinik/view");
$can_delete = ACL::is_allowed("transaksi_clinik/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Transaksi Clinik</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        ?>
                        <div align="center" id="divToPrint" style="display:none;">
                            <div  align="center" >
                                <style>
                                    @page {
                                    margin: 0px;
                                    font-family: Arial, Helvetica, sans-serif;
                                    }
                                    body,
                                    h1,
                                    h2,
                                    h3,
                                    h4,
                                    h5,
                                    h6 {
                                    margin: 0px;
                                    padding: 0px;
                                    font-family: Arial, Helvetica, sans-serif;
                                    }
                                    small {
                                    font-size: 12px;
                                    color: #888;
                                    }
                                    .ajax-page-load-indicator {
                                    display: none;
                                    visibility: hidden;
                                    }
                                    #report-header {
                                    position: relative;
                                    border-top: 3px solid #0066cc;
                                    border-bottom: 3px solid #0066cc;
                                    background: #fafafa;
                                    padding: 10px;
                                    }
                                    #report-strip {
                                    position: relative;
                                    border-bottom: 3px solid #0066cc;
                                    margin-bottom: 5px;
                                    margin-top: 5px;
                                    }
                                    #report-header table{
                                    margin:0;
                                    }
                                    #report-header .sub-title {
                                    font-size: small;
                                    color: #888;
                                    }
                                    #report-header img {
                                    height: 50px;
                                    width: 50px;
                                    }
                                    #report-title {
                                    background: #fafafa;
                                    margin-top: 20px;
                                    margin-bottom: 20px;
                                    padding: 10px 20px;
                                    font-size: 24px;
                                    }
                                    #report-body{
                                    padding: 2px;
                                    }
                                    #report-footer {
                                    padding: 10px;
                                    background: #fafafa;
                                    border-top: 2px solid #0066cc;
                                    position: absolute;
                                    bottom: 0;
                                    left:0;
                                    width: 98%;
                                    overflow: hidden;
                                    margin: 0 auto;
                                    }
                                    #report-footer table{
                                    margin: 0;
                                    overflow: hidden;
                                    }
                                    .table-responsive.table-bordered {
                                    border: 0;
                                    }
                                </style>
                                <?php
                                $counter++;
                                ?>
                                <div id="report-header">
                                    <?php
                                    $id_user = "".USER_ID;
                                    $dbhost  = "".DB_HOST;
                                    $dbuser  = "".DB_USERNAME;
                                    $dbpass  = "".DB_PASSWORD;
                                    $dbname  = "".DB_NAME;
                                    //$koneksi=open_connection();
                                    $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                                    $query = mysqli_query($koneksi, "select * from data_clinik")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
                                    $rows = mysqli_num_rows($query);
                                    if ($rows <> 0) {
                                    $data       = mysqli_fetch_assoc($query);
                                    $nama_clinik = $data['nama_clinik'];
                                    $alamat_clinik= $data['alamat_clinik'];
                                    $email= $data['email'];
                                    $phone= $data['phone'];
                                echo "$nama_clinik</br>$alamat_clinik</br>$email</br>$phone";
                                }else{
                                echo "Print Transaksi Clinik";
                                }
                                ?>
                            </div>
                            <div id="page-report-body" class="">
                                <table class="table table-hover table-borderless table-striped" id="report-strip">
                                    <!-- Table Body Start -->
                                    <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                        <tr  class="td-tanggal">
                                            <th class="title" align="left"> Tanggal: </th>
                                            <td class="value">
                                                <?php echo $data['tanggal']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-no_rekam_medis">
                                            <th class="title" align="left"> No Rekam Medis: </th>
                                            <td class="value">
                                                <?php echo $data['no_rekam_medis']; ?>
                                            </td>
                                        </tr>
                                        <tr  class="td-nama_pasien">
                                            <th class="title" align="left"> Nama Pasien: </th>
                                            <td class="value">
                                                <?php echo $data['nama_pasien']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-alamat">
                                            <th class="title" align="left"> Alamat: </th>
                                            <td class="value">
                                                <?php echo $data['alamat']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-dokter_pemeriksa">
                                            <th class="title" align="left"> Dokter Pemeriksa: </th>
                                            <td class="value"> 
                                                <?php echo $data['dokter_pemeriksa']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-jasa_dokter">
                                            <th class="title" align="left"> Jasa Dokter: </th>
                                            <td class="value">
                                                Rp. <?php echo number_format($data['jasa_dokter'],0,",",".");?>
                                            </td>
                                        </tr>
                                        <tr  class="td-resep_obat">
                                            <th class="title" align="left"> Resep Obat: </th>
                                            <td class="value">
                                                Rp. <?php echo number_format($data['resep_obat'],0,",",".");?>
                                            </td>
                                        </tr>
                                        <tr  class="td-biaya_tindakan">
                                            <th class="title" align="left"> Biaya Tindakan: </th>
                                            <td class="value">
                                                Rp. <?php echo number_format($data['biaya_tindakan'],0,",",".");?>
                                            </td>
                                        </tr>
                                        <tr  class="td-keterangan_tindakan">
                                            <th class="title" align="left"> Keterangan Tindakan: </th>
                                            <td class="value">
                                                <?php echo $data['keterangan_tindakan']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-keterangan_resep">
                                            <th class="title" align="left"> Keterangan Resep: </th>
                                            <td class="value">
                                                <?php echo $data['keterangan_resep']; ?> 
                                            </td>
                                        </tr>
                                        <tr  class="td-total_biaya">
                                            <th class="title" align="left"> Total Biaya: </th>
                                            <td class="value">
                                                Rp. <?php echo number_format($data['total_biaya'],0,",",".");?>
                                            </td>
                                        </tr>
                                        <tr  class="td-metode_pembayaran">
                                            <th class="title" align="left"> Metode Pembayaran: </th>
                                            <td class="value">
                                                <?php echo $data['data_bank_nama_bank'] ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Table Body End -->
                                </table>
                            </div>
                            <div class="p-3 d-flex">
                            </div>
                        </div>
                    </div>
                    <?php
                    $datid=$data['id'];
                    $counter++;
                    ?>
                    <div id="page-report-body" class="">
                        <table class="table table-hover table-borderless table-striped">
                            <!-- Table Body Start -->
                            <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                <tr  class="td-tanggal">
                                    <th class="title"> Tanggal: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="tanggal" 
                                            data-title="Enter Tanggal" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['tanggal']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-no_rekam_medis">
                                    <th class="title"> No Rekam Medis: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="no_rekam_medis" 
                                            data-title="Enter No Rekam Medis" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['no_rekam_medis']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-nama_pasien">
                                    <th class="title"> Nama Pasien: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="nama_pasien" 
                                            data-title="Enter Nama Pasien" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['nama_pasien']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-alamat">
                                    <th class="title"> Alamat: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="alamat" 
                                            data-title="Enter Alamat" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['alamat']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-dokter_pemeriksa">
                                    <th class="title"> Dokter Pemeriksa: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="dokter_pemeriksa" 
                                            data-title="Enter Dokter Pemeriksa" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['dokter_pemeriksa']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-jasa_dokter">
                                    <th class="title"> Jasa Dokter: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['jasa_dokter']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="jasa_dokter" 
                                            data-title="Enter Jasa Dokter" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['jasa_dokter']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-resep_obat">
                                    <th class="title"> Resep Obat: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['resep_obat']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="resep_obat" 
                                            data-title="Enter Resep Obat" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['resep_obat']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-biaya_tindakan">
                                    <th class="title"> Biaya Tindakan: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['biaya_tindakan']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="biaya_tindakan" 
                                            data-title="Enter Biaya Tindakan" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="number" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['biaya_tindakan']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-keterangan_tindakan">
                                    <th class="title"> Keterangan Tindakan: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['keterangan_tindakan']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="keterangan_tindakan" 
                                            data-title="Enter Keterangan Tindakan" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['keterangan_tindakan']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-keterangan_resep">
                                    <th class="title"> Keterangan Resep: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['keterangan_resep']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="keterangan_resep" 
                                            data-title="Enter Keterangan Resep" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['keterangan_resep']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-total_biaya">
                                    <th class="title"> Total Biaya: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_biaya']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="total_biaya" 
                                            data-title="Enter Total Biaya" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="number" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['total_biaya']; ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr  class="td-metode_pembayaran">
                                    <th class="title"> Metode Pembayaran: </th>
                                    <td class="value">
                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_bank/view/" . urlencode($data['metode_pembayaran'])) ?>">
                                            <i class="fa fa-eye"></i> <?php echo $data['data_bank_nama_bank'] ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr  class="td-setatus_tagihan">
                                    <th class="title"> Setatus Tagihan: </th>
                                    <td class="value">
                                        <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $setatus_tagihan); ?>' 
                                            data-value="<?php echo $data['setatus_tagihan']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                            data-name="setatus_tagihan" 
                                            data-title="Select a value ..." 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="select" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo $data['setatus_tagihan']; ?> 
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Table Body End -->
                        </table>
                    </div>
                    <div class="p-3 d-flex">
                    </div>  </br>
                    <input type="button" class="btn btn-sm btn-info has-tooltip"value="Print Transaksi" onclick="PrintDiv();" />
                </br>
                <script type="text/javascript">     
                    function PrintDiv() {    
                    var divToPrint = document.getElementById('divToPrint');
                    var popupWin = window.open('<?php  print_link("transaksi_clinik/print/$datid?print=$csrf_token");?>', '_blank');
                    popupWin.document.open();
                    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                        popupWin.document.close();
                        }
                    </script>
                    <?php 
                    }
                    else{
                    ?>
                    <!-- Empty Record Message -->
                    <div class="text-muted p-3">
                        <i class="fa fa-ban"></i> No Record Found
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            </div>
            </div>
            </div>
            </section>
