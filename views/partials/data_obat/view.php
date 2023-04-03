<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("data_obat/add");
$can_edit = ACL::is_allowed("data_obat/edit");
$can_view = ACL::is_allowed("data_obat/view");
$can_delete = ACL::is_allowed("data_obat/delete");
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
                    <h4 class="record-title">View  Data Obat</h4>
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
                        $rec_id = (!empty($data['id_obat']) ? urlencode($data['id_obat']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-nama_obat">
                                        <th class="title"> Nama Obat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_obat']; ?>" 
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
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
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
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
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
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
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
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
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
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
                                    <tr  class="td-date_created">
                                        <th class="title"> Date Created: </th>
                                        <td class="value"> <?php echo $data['date_created']; ?></td>
                                    </tr>
                                    <tr  class="td-date_update">
                                        <th class="title"> Date Update: </th>
                                        <td class="value"> <?php echo $data['date_update']; ?></td>
                                    </tr>
                                    <tr  class="td-user_entry">
                                        <th class="title"> User Entry: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                                                data-pk="<?php echo $data['id_obat'] ?>" 
                                                data-url="<?php print_link("data_obat/editfield/" . urlencode($data['id_obat'])); ?>" 
                                                data-name="user_entry" 
                                                data-title="Enter User Entry" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
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
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-info"  href="<?php print_link("data_obat/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("data_obat/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
