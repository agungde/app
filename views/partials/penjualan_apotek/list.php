<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("penjualan_apotek/add");
$can_edit = ACL::is_allowed("penjualan_apotek/edit");
$can_view = ACL::is_allowed("penjualan_apotek/view");
$can_delete = ACL::is_allowed("penjualan_apotek/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Penjualan Apotek</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("penjualan_apotek/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Penjualan Apotek 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('penjualan_apotek'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('penjualan_apotek'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('penjualan_apotek'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="penjualan_apotek-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <?php Html::ajaxpage_spinner(); ?>
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-btn"></th>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id_jual_apt"> Id Jual Apt</th>
                                                <th  class="td-nama_pelanggan"> Nama Pelanggan</th>
                                                <th  class="td-alamat"> Alamat</th>
                                                <th  class="td-phone"> Phone</th>
                                                <th  class="td-nama_obat"> Nama Obat</th>
                                                <th  class="td-jumlah"> Jumlah</th>
                                                <th  class="td-aturan_minum"> Aturan Minum</th>
                                                <th  class="td-harga"> Harga</th>
                                                <th  class="td-total_harga"> Total Harga</th>
                                                <th  class="td-user_entry"> User Entry</th>
                                                <th  class="td-satuan"> Satuan</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id_jual_apt']) ? urlencode($data['id_jual_apt']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_jual_apt'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("penjualan_apotek/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("penjualan_apotek/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("penjualan_apotek/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </a>
                                                        <?php } ?>
                                                    </th>
                                                    <td class="td-id_jual_apt"><a href="<?php print_link("penjualan_apotek/view/$data[id_jual_apt]") ?>"><?php echo $data['id_jual_apt']; ?></a></td>
                                                    <td class="td-nama_pelanggan">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pelanggan']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                                                            data-name="nama_pelanggan" 
                                                            data-title="Enter Nama Pelanggan" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['nama_pelanggan']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-alamat">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                    <td class="td-phone"><a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a></td>
                                                    <td class="td-nama_obat">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_obat']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                    <td class="td-jumlah">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['jumlah']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                    <td class="td-aturan_minum">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['aturan_minum']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                                                            data-name="aturan_minum" 
                                                            data-title="Enter Aturan Minum" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['aturan_minum']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-harga">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['harga']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                                                            data-name="harga" 
                                                            data-title="Enter Harga" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['harga']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-total_harga">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_harga']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                    <td class="td-user_entry">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                    <td class="td-satuan">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['satuan']; ?>" 
                                                            data-pk="<?php echo $data['id_jual_apt'] ?>" 
                                                            data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="fa fa-ban"></i> No record found
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("penjualan_apotek/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Delete Selected
                                                    </button>
                                                    <?php } ?>
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
                                                                        <?php Html :: import_form('penjualan_apotek/import_data' , "Import Data", 'CSV , JSON'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->ajax_page = true;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
