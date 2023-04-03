<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("form_laboratorium/add");
$can_edit = ACL::is_allowed("form_laboratorium/edit");
$can_view = ACL::is_allowed("form_laboratorium/view");
$can_delete = ACL::is_allowed("form_laboratorium/delete");
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
                    <h4 class="record-title">Form Laboratorium</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("form_laboratorium/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Form Laboratorium 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('form_laboratorium'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('form_laboratorium'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('form_laboratorium'); ?>">
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
                            <div id="form_laboratorium-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <?php Html::ajaxpage_spinner(); ?>
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th  class="td-tanggal"> Tanggal</th>
                                                <th  class="td-nama_pasien"> Nama Pasien</th>
                                                <th  class="td-no_rekam_medis"> No Rekam Medis</th>
                                                <th  class="td-alamat"> Alamat</th>
                                                <th  class="td-no_hp"> No Hp</th>
                                                <th  class="td-keluhan"> Keluhan</th>
                                                <th  class="td-jenis_pemeriksaan"> Jenis Pemeriksaan</th>
                                                <th  class="td-dokter_pemeriksa"> Dokter Pemeriksa</th>
                                                <th  class="td-nama_poli"> Nama Poli</th>
                                                <th  class="td-hasil_pemeriksaan"> Hasil Pemeriksaan</th>
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
                                            $rec_id = (!empty($data['id_form_lab']) ? urlencode($data['id_form_lab']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <td class="td-tanggal">
                                                    <span <?php if($can_edit){ ?> data-flatpickr="{altFormat: 'D\d-m-Y', enableTime: false, minDate: '', maxDate: ''}" 
                                                        data-value="<?php echo $data['tanggal']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="tanggal" 
                                                        data-title="Enter Tanggal" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="flatdatetimepicker" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['tanggal']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-nama_pasien">
                                                    <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_nama_pasien_option_list'); ?>' 
                                                        data-value="<?php echo $data['nama_pasien']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="nama_pasien" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="select" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['nama_pasien']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-no_rekam_medis">
                                                    <span <?php if($can_edit){ ?> data-source='<?php 
                                                        $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
                                                        print_link('api/json/form_laboratorium_no_rekam_medis_option_list/'.$dependent_field); 
                                                        ?>' 
                                                        data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="no_rekam_medis" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="selectize" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable selectize" <?php } ?>>
                                                        <?php echo $data['no_rekam_medis']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-alamat">
                                                    <span <?php if($can_edit){ ?> data-source='<?php 
                                                        $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
                                                        print_link('api/json/form_laboratorium_alamat_option_list/'.$dependent_field); 
                                                        ?>' 
                                                        data-value="<?php echo $data['alamat']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="alamat" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="select" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['alamat']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-no_hp">
                                                    <span <?php if($can_edit){ ?> data-source='<?php 
                                                        $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
                                                        print_link('api/json/form_laboratorium_no_hp_option_list/'.$dependent_field); 
                                                        ?>' 
                                                        data-value="<?php echo $data['no_hp']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="no_hp" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="select" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['no_hp']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-keluhan">
                                                    <span <?php if($can_edit){ ?> data-source='<?php 
                                                        $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
                                                        print_link('api/json/form_laboratorium_keluhan_option_list/'.$dependent_field); 
                                                        ?>' 
                                                        data-value="<?php echo $data['keluhan']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="keluhan" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="select" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['keluhan']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-jenis_pemeriksaan">
                                                    <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("form_laboratorium/view/" . urlencode($data['jenis_pemeriksaan'])) ?>">
                                                        <i class="fa fa-eye"></i> <?php echo $data['jenis_pemeriksaan'] ?>
                                                    </a>
                                                </td>
                                                <td class="td-dokter_pemeriksa">
                                                    <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_dokter_pemeriksa_option_list'); ?>' 
                                                        data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="dokter_pemeriksa" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="selectize" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable selectize" <?php } ?>>
                                                        <?php echo $data['dokter_pemeriksa']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-nama_poli">
                                                    <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_nama_poli_option_list'); ?>' 
                                                        data-value="<?php echo $data['nama_poli']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="nama_poli" 
                                                        data-title="Select a value ..." 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="select" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['nama_poli']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-hasil_pemeriksaan">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil_pemeriksaan']; ?>" 
                                                        data-pk="<?php echo $data['id_form_lab'] ?>" 
                                                        data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
                                                        data-name="hasil_pemeriksaan" 
                                                        data-title="Enter Hasil Pemeriksaan" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['hasil_pemeriksaan']; ?> 
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
