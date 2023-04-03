<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("transaksi_clinik/add");
$can_edit = ACL::is_allowed("transaksi_clinik/edit");
$can_view = ACL::is_allowed("transaksi_clinik/view");
$can_delete = ACL::is_allowed("transaksi_clinik/delete");
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
                    <h4 class="record-title">Transaksi Clinik</h4>
                </div>
                <div class="col-sm-3 ">
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('transaksi_clinik'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('transaksi_clinik'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('transaksi_clinik'); ?>">
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
                            <div id="transaksi_clinik-list-records">
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
                                                <th  class="td-date_created"> Date Created</th>
                                                <th  class="td-nama_pasien"> Nama Pasien</th>
                                                <th  class="td-no_rekam_medis"> No Rekam Medis</th>
                                                <th  class="td-keterangan_resep"> Keterangan Resep</th>
                                                <th  class="td-resep_obat"> Resep Obat</th>
                                                <th  class="td-keterangan_tindakan"> Keterangan Tindakan</th>
                                                <th  class="td-biaya_tindakan"> Biaya Tindakan</th>
                                                <th  class="td-jasa_dokter"> Jasa Dokter</th>
                                                <th  class="td-total_biaya"> Total Biaya</th>
                                                <th  class="td-metode_pembayaran"> Metode Pembayaran</th>
                                                <th  class="td-dokter_pemeriksa"> Dokter Pemeriksa</th>
                                                <th  class="td-setatus_tagihan"> Setatus Tagihan</th>
                                                <th class="td-btn"></th>
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
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <td class="td-date_created"> <span><?php echo $data['date_created']; ?></span></td>
                                                    <td class="td-nama_pasien">
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
                                                    <td class="td-no_rekam_medis">
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
                                                    <td class="td-keterangan_resep">
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
                                                    <td class="td-resep_obat"><span>Rp. <?php echo number_format($data['resep_obat'],0,",",".");?></span></td>
                                                    <td class="td-keterangan_tindakan">
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
                                                    <td class="td-biaya_tindakan"> <span>Rp.<?php echo number_format($data['biaya_tindakan'],0,",",".");?></span></td>
                                                    <td class="td-jasa_dokter"> <span>Rp.<?php echo number_format($data['jasa_dokter'],0,",",".");?></span></td>
                                                    <td class="td-total_biaya"> <span>Rp.<?php echo number_format($data['total_biaya'],0,",",".");?></span>
                                                    </td>
                                                    <td class="td-metode_pembayaran">
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
                                                    <td class="td-dokter_pemeriksa">
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
                                                    <td class="td-setatus_tagihan"> <span><?php 
                                                        $encryption=$rec_id;
                                                        if($data['setatus_tagihan'] =="Proses"){
                                                        ?>
                                                        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Proses Tagihan" href="<?php  print_link("transaksi_clinik/edit/$encryption");?>">
                                                        <i class="fa fa-open "></i>proses</a>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <i class="fa fa-close "></i>selesai
                                                        <?php
                                                        }
                                                    ?></span>
                                                </td>
                                                <th class="td-btn">
                                                    <?php if($can_view){ ?>
                                                    <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("transaksi_clinik/view/$rec_id"); ?>">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_edit){ ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("transaksi_clinik/edit/$rec_id"); ?>">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <?php } ?>
                                                    <?php if($can_delete){ ?>
                                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("transaksi_clinik/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                        <i class="fa fa-times"></i>
                                                        Delete
                                                    </a>
                                                    <?php } ?>
                                                </th>
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
                                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("transaksi_clinik/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                    <i class="fa fa-times"></i> Delete Selected
                                                </button>
                                                <?php } ?>
                                                <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                <a class="btn  btn-sm btn-primary export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                    </a>
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
