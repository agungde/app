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
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-date_created">
                                        <th class="title"> Date Created: </th>
                                        <td class="value"> <?php echo $data['date_created']; ?></td>
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
                                    <tr  class="td-jasa_dokter">
                                        <th class="title"> Jasa Dokter: </th>
                                        <td class="value"><?php echo $data['jasa_dokter']; ?></td>
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
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/transaksi_clinik_metode_pembayaran_option_list'); ?>' 
                                                data-value="<?php echo $data['metode_pembayaran']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="metode_pembayaran" 
                                                data-title="Enter Metode Pembayaran" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['metode_pembayaran']; ?> 
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
                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                            <a class="btn  btn-sm btn-primary export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                </a>
                            </div>
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
