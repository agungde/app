<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pembelian/add");
$can_edit = ACL::is_allowed("pembelian/edit");
$can_view = ACL::is_allowed("pembelian/view");
$can_delete = ACL::is_allowed("pembelian/delete");
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
                    <h4 class="record-title">View  Pembelian</h4>
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
                        $rec_id = (!empty($data['id_pembelian']) ? urlencode($data['id_pembelian']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_pembelian">
                                        <th class="title"> Id Pembelian: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_pembelian']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="id_pembelian" 
                                                data-title="Enter Id Pembelian" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_pembelian']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_suplier">
                                        <th class="title"> Id Suplier: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['id_suplier']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="id_suplier" 
                                                data-title="Enter Id Suplier" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['id_suplier']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_suplier">
                                        <th class="title"> Nama Suplier: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_suplier']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
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
                                    <tr  class="td-tgl_pembelian">
                                        <th class="title"> Tgl Pembelian: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tgl_pembelian']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="tgl_pembelian" 
                                                data-title="Enter Tgl Pembelian" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tgl_pembelian']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kode_barang">
                                        <th class="title"> Kode Barang: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['kode_barang']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="kode_barang" 
                                                data-title="Enter Kode Barang" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['kode_barang']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_barang">
                                        <th class="title"> Nama Barang: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_barang']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="nama_barang" 
                                                data-title="Enter Nama Barang" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nama_barang']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jumlah">
                                        <th class="title"> Jumlah: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jumlah']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
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
                                    <tr  class="td-harga_beli">
                                        <th class="title"> Harga Beli: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['harga_beli']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
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
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
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
                                    <tr  class="td-discount">
                                        <th class="title"> Discount: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['discount']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="discount" 
                                                data-title="Enter Discount" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['discount']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ppn">
                                        <th class="title"> Ppn: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ppn']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="ppn" 
                                                data-title="Enter Ppn" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ppn']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-total_harga">
                                        <th class="title"> Total Harga: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_harga']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
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
                                    <tr  class="td-operator">
                                        <th class="title"> Operator: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['operator']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="operator" 
                                                data-title="Enter Operator" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['operator']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_created">
                                        <th class="title"> Date Created: </th>
                                        <td class="value"> <?php echo $data['date_created']; ?></td>
                                    </tr>
                                    <tr  class="td-date_updated">
                                        <th class="title"> Date Updated: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_updated']; ?>" 
                                                data-pk="<?php echo $data['id_pembelian'] ?>" 
                                                data-url="<?php print_link("pembelian/editfield/" . urlencode($data['id_pembelian'])); ?>" 
                                                data-name="date_updated" 
                                                data-title="Enter Date Updated" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_updated']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-info"  href="<?php print_link("pembelian/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("pembelian/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
