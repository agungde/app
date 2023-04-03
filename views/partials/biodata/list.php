<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("biodata/add");
$can_edit = ACL::is_allowed("biodata/edit");
$can_view = ACL::is_allowed("biodata/view");
$can_delete = ACL::is_allowed("biodata/delete");
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
                    <h4 class="record-title">Biodata</h4>
                </div>
                <div class="col-sm-3 ">
                    <div class=""> <?php
                        $id_user = "".USER_ID;
                        $dbhost="".DB_HOST;
                        $dbuser="".DB_USERNAME;
                        $dbpass="".DB_PASSWORD;
                        $dbname="".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        $cekdata1="";
                        $sqlcek1 = mysqli_query($koneksi,"select * from biodata WHERE id_user='$id_user'");
                        while ($row1=mysqli_fetch_array($sqlcek1)){
                        $cekdata1=$row1['id_user'];
                        }
                        if($cekdata1==""){
                        $sql = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
                        while ($row=mysqli_fetch_array($sql)){
                        $user_role_id=$row['user_role_id'];
                        }
                        if($user_role_id=="2"){
                        ?>
                        <span><a class="btn btn-sm btn-info has-tooltip"  href="<?php print_link("biodata/add"); ?>">
                            <i class="fa fa-database"></i> Isi Biodata
                        </a></span>
                        <?php
                        }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-12 comp-grid">
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
                    <div class=""><div>
                        <?php
                        $id_user = "".USER_ID;
                        $dbhost="".DB_HOST;
                        $dbuser="".DB_USERNAME;
                        $dbpass="".DB_PASSWORD;
                        $dbname="".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        $norekammedis="";
                        $sqlcek = mysqli_query($koneksi,"select * from biodata WHERE id_user='$id_user'");
                        while ($row=mysqli_fetch_array($sqlcek)){
                        $norekammedis=$row['no_rekam_medis'];
                        $no_rekam_medis=$row['no_rekam_medis'];
                        $nama_pasien=$row['nama'];
                        $alamat=$row['alamat'];
                        $no_hp=$row['no_hp'];
                        $jenis_kelamin=$row['jenis_kelamin'];
                        $tanggal_lahir=$row['tanggal_lahir'];
                        }
                        if($norekammedis==""){
                        }else{
                        $cekapp="";
                        $sqlcek1 = mysqli_query($koneksi,"select * from appointment WHERE no_rekam_medis='$norekammedis'");
                        while ($row1=mysqli_fetch_array($sqlcek1)){
                        $cekapp=$row1['no_rekam_medis'];
                        }  
                        if($cekapp=="")  {
                        $sqlcek2 = mysqli_query($koneksi,"select * from data_pasien WHERE no_rekam_medis='$norekammedis'");
                        while ($row2=mysqli_fetch_array($sqlcek2)){
                        $id_pasien=$row2['id_pasien'];
                        //echo $id_pasien;
                        } 
                        $simple_string = "$id_pasien)";
                        $ciphering = "AES-128-CTR";
                        $iv_length = openssl_cipher_iv_length($ciphering);
                        $options = 0;
                        // Non-NULL Initialization Vector for encryption
                        $encryption_iv = '1234567891011121';
                        // Store the encryption key
                        $encryption_key = "dermawangroup";
                        // Use openssl_encrypt() function to encrypt the data
                        $encryption = openssl_encrypt($simple_string, $ciphering,
                        $encryption_key, $options, $encryption_iv);
                        ?>
                        <span><a class="btn btn-sm btn-info has-tooltip"  href="<?php print_link("appointment/add?csrf_token=$csrf_token&precord=$encryption");?>">
                            <i class="fa fa-database"></i>Daftar Appointment
                        </a></span>
                    </br>
                    <?php  
                    }  
                    }
                ?></br>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div  class="">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid">
                <?php $this :: display_page_errors(); ?>
                <div  class=" animated fadeIn page-content">
                    <div id="biodata-list-records">
                        <div id="page-report-body" class="table-responsive">
                            <?php Html::ajaxpage_spinner(); ?>
                            <table class="table  table-striped table-sm text-left">
                                <thead class="table-header bg-light">
                                    <tr>
                                        <th  class="td-no_ktp"> No Ktp</th>
                                        <th  class="td-nama"> Nama</th>
                                        <th  class="td-alamat"> Alamat</th>
                                        <th  class="td-tanggal_lahir"> Tanggal Lahir</th>
                                        <th  class="td-no_hp"> No Hp</th>
                                        <th  class="td-jenis_kelamin"> Jenis Kelamin</th>
                                        <th  class="td-umur"> Umur</th>
                                        <th  class="td-email"> Email</th>
                                        <th  class="td-photo"> Photo</th>
                                        <th  class="td-date_created"> Date Created</th>
                                        <th  class="td-date_update"> Date Update</th>
                                        <th  class="td-date_updated"> Date Updated</th>
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
                                    $rec_id = (!empty($data['id_biodata']) ? urlencode($data['id_biodata']) : null);
                                    $counter++;
                                    ?>
                                    <tr>
                                        <td class="td-no_ktp">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_ktp']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="no_ktp" 
                                                data-title="Enter No Ktp" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_ktp']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-nama">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="nama" 
                                                data-title="Enter Nama" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nama']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-alamat">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
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
                                        <td class="td-tanggal_lahir">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tanggal_lahir']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="tanggal_lahir" 
                                                data-title="Enter Tanggal Lahir" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_lahir']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-no_hp">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="no_hp" 
                                                data-title="Enter No Hp" 
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
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $jenis_kelamin2); ?>' 
                                                data-value="<?php echo $data['jenis_kelamin']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="jenis_kelamin" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_kelamin']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-umur"> <?php echo $data['umur']; ?></td>
                                        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
                                        <td class="td-photo">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['photo']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
                                                data-name="photo" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['photo']; ?> 
                                            </span>
                                        </td>
                                        <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
                                        <td class="td-date_update">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['date_update']; ?>" 
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
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
                                                data-pk="<?php echo $data['id_biodata'] ?>" 
                                                data-url="<?php print_link("biodata/editfield/" . urlencode($data['id_biodata'])); ?>" 
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
                                        <th class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("biodata/view/$rec_id"); ?>">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("biodata/edit/$rec_id"); ?>">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("biodata/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
                                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("biodata/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
