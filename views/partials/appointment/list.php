<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("appointment/add");
$can_edit = ACL::is_allowed("appointment/edit");
$can_view = ACL::is_allowed("appointment/view");
$can_delete = ACL::is_allowed("appointment/delete");
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
                    <h4 class="record-title">Appointment</h4>
                </div>
                <div class="col-sm-4 ">
                    <div class=""><div>
                        <?php
                        $id_user = "".USER_ID;
                        $dbhost="".DB_HOST;
                        $dbuser="".DB_USERNAME;
                        $dbpass="".DB_PASSWORD;
                        $dbname="".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        $cekdata1="";
                        $sqlcek1 = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
                        while ($row1=mysqli_fetch_array($sqlcek1)){
                        $cekdata1=$row1['user_role_id'];
                        }
                        if($cekdata1=="2"){
                    echo"</br></br>";
                    } else{
                    ?>
                    <form  class="search" action="<?php print_link("appointment"); ?>" method="get">
                        <div class="input-group">
                            <input value="" class="form-control" type="text" name="search"  placeholder="Search" />
                            <div class="input-group-append">
                                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php }?>
            </div>
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
                            <a class="text-decoration-none" href="<?php print_link('appointment'); ?>">
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
                            <a class="text-decoration-none" href="<?php print_link('appointment'); ?>">
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
                    <div id="appointment-list-records">
                        <div id="page-report-body" class="table-responsive">
                            <?php Html::ajaxpage_spinner(); ?>
                            <table class="table  table-striped table-sm text-left">
                                <thead class="table-header bg-light">
                                    <tr>
                                        <th  class="td-tanggal_appoitment"> Tanggal Appoitment</th>
                                        <th  class="td-nama_pasien"> Nama Pasien</th>
                                        <th  class="td-no_rekam_medis"> No Rekam Medis</th>
                                        <th  class="td-no_antri_poli"> No Antri Poli</th>
                                        <th  class="td-alamat"> Alamat</th>
                                        <th  class="td-nama_poli"> Nama Poli</th>
                                        <th  class="td-dokter"> Dokter</th>
                                        <th  class="td-no_hp"> No Hp</th>
                                        <th  class="td-jenis_kelamin"> Jenis Kelamin</th>
                                        <th  class="td-tanggal_lahir"> Tanggal Lahir</th>
                                        <th  class="td-setatus"> Setatus</th>
                                        <th  class="td-date_created"> Date Created</th>
                                        <th  class="td-keluhan"> Keluhan</th>
                                        <th  class="td-pembayaran"> Pembayaran</th>
                                        <th  class="td-date_update"> Date Update</th>
                                        <th  class="td-date_updated"> Date Updated</th>
                                        <th  class="td-tinggi"> Tinggi</th>
                                        <th  class="td-berat_badan"> Berat Badan</th>
                                        <th  class="td-tensi"> Tensi</th>
                                        <th  class="td-umur"> Umur</th>
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
                                    $rec_id = (!empty($data['id_appointment']) ? urlencode($data['id_appointment']) : null);
                                    $counter++;
                                    ?>
                                    <tr>
                                        <td class="td-tanggal_appoitment">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_appoitment']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="tanggal_appoitment" 
                                                data-title="Enter Tanggal Appoitment" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_appoitment']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-nama_pasien">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="nama_pasien" 
                                                data-title="Input Nama Pasien" 
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
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="no_rekam_medis" 
                                                data-title="Input No Rekam Medis" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_rekam_medis']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-no_antri_poli"> <?php echo $data['no_antri_poli']; ?></td>
                                        <td class="td-alamat">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="alamat" 
                                                data-title="Input Alamat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['alamat']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-nama_poli">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
                                            </a>
                                        </td>
                                        <td class="td-dokter">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_dokter/view/" . urlencode($data['dokter'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['data_dokter_nama_dokter'] ?>
                                            </a>
                                        </td>
                                        <td class="td-no_hp">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="no_hp" 
                                                data-title="Input No Hp" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_hp']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-jenis_kelamin">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kelamin']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="jenis_kelamin" 
                                                data-title="Input Jenis Kelamin" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_kelamin']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-tanggal_lahir">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_lahir']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="tanggal_lahir" 
                                                data-title="Input Tanggal Lahir" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_lahir']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-setatus"> <?php echo $data['setatus']; ?></td>
                                        <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
                                        <td class="td-keluhan">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keluhan']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="keluhan" 
                                                data-title="Enter Keluhan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['keluhan']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-pembayaran">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $pembayaran); ?>' 
                                                data-value="<?php echo $data['pembayaran']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="pembayaran" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['pembayaran']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-date_update">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_update']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="date_update" 
                                                data-title="Enter Date Update" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['date_update']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-date_updated">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_updated']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
                                        <td class="td-tinggi">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tinggi']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="tinggi" 
                                                data-title="Enter Tinggi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tinggi']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-berat_badan">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['berat_badan']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="berat_badan" 
                                                data-title="Enter Berat Badan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['berat_badan']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-tensi">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tensi']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
                                                data-name="tensi" 
                                                data-title="Enter Tensi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tensi']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-umur">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
                                                data-pk="<?php echo $data['id_appointment'] ?>" 
                                                data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
                                        <th class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("appointment/view/$rec_id"); ?>">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("appointment/edit/$rec_id"); ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("appointment/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
                                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("appointment/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                            <i class="fa fa-times"></i> Delete Selected
                                        </button>
                                        <?php } ?>
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
