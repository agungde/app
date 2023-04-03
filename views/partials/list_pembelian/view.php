<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("list_pembelian/add");
$can_edit = ACL::is_allowed("list_pembelian/edit");
$can_view = ACL::is_allowed("list_pembelian/view");
$can_delete = ACL::is_allowed("list_pembelian/delete");
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
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  List Pembelian</h4>
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
                        $rec_id = (!empty($data['id_list_beli']) ? urlencode($data['id_list_beli']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <?php Html::ajaxpage_spinner(); ?>
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_list_beli">
                                        <th class="title"> Id List Beli: </th>
                                        <td class="value"> <?php echo $data['id_list_beli']; ?></td>
                                    </tr>
                                    <tr  class="td-nama_suplier">
                                        <th class="title"> Nama Suplier: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_suplier']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="nama_suplier" 
                                                data-title="Enter Nama Suplier" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nama_suplier']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-alamat">
                                        <th class="title"> Alamat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
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
                                    <tr  class="td-phone">
                                        <th class="title"> Phone: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['phone']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="phone" 
                                                data-title="Enter Phone" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['phone']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_invoice">
                                        <th class="title"> No Invoice: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_invoice']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="no_invoice" 
                                                data-title="Enter No Invoice" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_invoice']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cara_bayar">
                                        <th class="title"> Cara Bayar: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['cara_bayar']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="cara_bayar" 
                                                data-title="Enter Cara Bayar" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['cara_bayar']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_jatuh_tempo">
                                        <th class="title"> Tgl Jatuh Tempo: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tgl_jatuh_tempo']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="tgl_jatuh_tempo" 
                                                data-title="Enter Tgl Jatuh Tempo" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tgl_jatuh_tempo']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_obat">
                                        <th class="title"> Nama Obat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_obat']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="nama_obat" 
                                                data-title="Enter Nama Obat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nama_obat']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jumlah">
                                        <th class="title"> Jumlah: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jumlah']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="jumlah" 
                                                data-title="Enter Jumlah" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jumlah']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-satuan">
                                        <th class="title"> Satuan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['satuan']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="satuan" 
                                                data-title="Enter Satuan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['satuan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-harga_beli">
                                        <th class="title"> Harga Beli: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['harga_beli']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="harga_beli" 
                                                data-title="Enter Harga Beli" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['harga_beli']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-harga_jual">
                                        <th class="title"> Harga Jual: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['harga_jual']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="harga_jual" 
                                                data-title="Enter Harga Jual" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['harga_jual']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-total_harga">
                                        <th class="title"> Total Harga: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_harga']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="total_harga" 
                                                data-title="Enter Total Harga" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['total_harga']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_expired">
                                        <th class="title"> Tgl Expired: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tgl_expired']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="tgl_expired" 
                                                data-title="Enter Tgl Expired" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tgl_expired']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-user_entry">
                                        <th class="title"> User Entry: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                                                data-pk="<?php echo $data['id_list_beli'] ?>" 
                                                data-url="<?php print_link("list_pembelian/editfield/" . urlencode($data['id_list_beli'])); ?>" 
                                                data-name="user_entry" 
                                                data-title="Enter User Entry" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['user_entry']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("list_pembelian/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("list_pembelian/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
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
