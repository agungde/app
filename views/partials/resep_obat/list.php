<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("resep_obat/add");
$can_edit = ACL::is_allowed("resep_obat/edit");
$can_view = ACL::is_allowed("resep_obat/view");
$can_delete = ACL::is_allowed("resep_obat/delete");
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
                    <h4 class="record-title">Resep Obat</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("resep_obat/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Resep Obat 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('resep_obat'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('resep_obat'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('resep_obat'); ?>">
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
                            <div id="resep_obat-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <?php Html::ajaxpage_spinner(); ?>
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th  class="td-date_created"> Date Created</th>
                                                <th  class="td-tanggal"> Tanggal</th>
                                                <th  class="td-no_rekam_medis"> No Rekam Medis</th>
                                                <th  class="td-nama_pasien"> Nama Pasien</th>
                                                <th  class="td-tanggal_lahir"> Tanggal Lahir</th>
                                                <th  class="td-umur"> Umur</th>
                                                <th  class="td-alamat"> Alamat</th>
                                                <th  class="td-setatus"> Status</th>
                                                <th  class="td-pembayaran"> Pembayaran</th>
                                                <th  class="td-action"> Action</th>
                                                <th  class="td-nama_poli"> Nama Poli</th>
                                                <th  class="td-nama_dokter"> Nama Dokter</th>
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
                                            $rec_id = (!empty($data['id_resep_obat']) ? urlencode($data['id_resep_obat']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <td class="td-date_created"> <span><?php echo $data['date_created']; ?></span></td>
                                                <td class="td-tanggal">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
                                                <td class="td-no_rekam_medis">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
                                                <td class="td-nama_pasien">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
                                                <td class="td-tanggal_lahir"> <span><?php echo $data['tanggal_lahir']; ?></span></td>
                                                <td class="td-umur">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
                                                        data-name="umur" 
                                                        data-title="Enter Umur" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['umur']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-alamat">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
                                                <td class="td-setatus"> <span><?php echo $data['setatus']; ?></span></td>
                                                <td class="td-pembayaran"> <span><?php echo $data['pembayaran']; ?></span></td>
                                                <td class="td-action"><span>
                                                    <?php
                                                    $key="dermawangroup";
                                                    $plaintext = "$rec_id";
                                                    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                                                    $iv = openssl_random_pseudo_bytes($ivlen);
                                                    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                                                    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                                                    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                                                    if($data['pembayaran']=="Lunas"){
                                                    if($data['action']=="Closed"){
                                                    //echo $data['action'];
                                                    ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&print=$ciphertext&copy=$ciphertext&proses=print");?>"
                                                    <i class="fa fa-print "></i>PrintResep</a>  
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext");?>"
                                                    <i class="fa fa-send"></i>Proses Resep</a>  
                                                    <?php } }else{
                                                    if($user_role_id=="3"){
                                                    ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&view=$ciphertext");?>"
                                                    <i class="fa fa-send"></i>Lihat Resep</a> <?php
                                                    }
                                                    }
                                                    if($data['pembayaran']=="Luar"){
                                                    if($user_role_id=="3"){
                                                    }else{
                                                    ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&print=$ciphertext&resep=Luar&proses=print");?>"
                                                    <i class="fa fa-print "></i>Print Resep</a>  
                                                    <?php } } 
                                                    ?> 
                                                </span></td>
                                                <td class="td-nama_poli">
                                                    <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
                                                        <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
                                                    </a>
                                                </td>
                                                <td class="td-nama_dokter">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_dokter']; ?>" 
                                                        data-pk="<?php echo $data['id_resep_obat'] ?>" 
                                                        data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
                                                        data-name="nama_dokter" 
                                                        data-title="Enter Nama Dokter" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['nama_dokter']; ?> 
                                                    </span>
                                                </td>
                                                <th class="td-btn">
                                                    <?php if($can_edit){ ?>
                                                    <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("resep_obat/edit/$rec_id"); ?>">
                                                        <i class="fa fa-edit"></i> proces
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
