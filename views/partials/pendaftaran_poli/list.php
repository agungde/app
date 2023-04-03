<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pendaftaran_poli/add");
$can_edit = ACL::is_allowed("pendaftaran_poli/edit");
$can_view = ACL::is_allowed("pendaftaran_poli/view");
$can_delete = ACL::is_allowed("pendaftaran_poli/delete");
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
                    <h4 class="record-title"><div>
                        <?php
                        $id_user = "".USER_ID;
                        $dbhost="".DB_HOST;
                        $dbuser="".DB_USERNAME;
                        $dbpass="".DB_PASSWORD;
                        $dbname="".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        $sql = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
                        while ($row=mysqli_fetch_array($sql)){
                        $user_role_id=$row['user_role_id'];
                        //$nama_poli=$row['nama_poli'];
                        }
                        if($user_role_id=="3"){
                        $sql1 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
                        while ($row1=mysqli_fetch_array($sql1)){
                        $specialist=$row1['specialist'];
                        //$nama_poli=$row['nama_poli'];
                        }
                        $sql2 = mysqli_query($koneksi,"select * from data_poli WHERE id_poli='$specialist'");
                        while ($row2=mysqli_fetch_array($sql2)){
                        $nama_poli=$row2['nama_poli'];
                        }   
                        ?>
                        <div align="left"><h4 class="record-title">Pasien Poli <?php echo $nama_poli;?></h4> </div>
                        <?php
                        }else{
                        ?>
                        <h4 class="record-title">Pendaftaran Poli</h4>
                        <?php
                        }
                        ?>  
                    </div>
                </h4>
            </div>
            <div class="col-md-4 comp-grid">
                <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                    <form  class="search" action="<?php print_link('pendaftaran_poli/List'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <hr />
                        <div class="form-group text-center">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 comp-grid">
                    <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                        <div class="card mb-3">
                            <div class="card-header h4 h4">Filter by Tanggal Appointment</div>
                            <div class="p-2">
                                <input class="form-control datepicker"  value="<?php echo $this->set_field_value('pendaftaran_poli_tanggal_appointment') ?>" type="datetime"  name="pendaftaran_poli_tanggal_appointment" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3 ">
                        <?php if($can_add){ ?>
                        <a  class="btn btn btn-primary my-1" href="<?php print_link("data_pasien/list?poli=true") ?>">
                            <i class="fa fa-plus"></i>                              
                            Add  Pasien  Poli 
                        </a>
                        <?php } ?>
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
                                        <a class="text-decoration-none" href="<?php print_link('pendaftaran_poli'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('pendaftaran_poli'); ?>">
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
                        <div class="filter-tags mb-2">
                            <?php
                            if(!empty($_GET['pendaftaran_poli_tanggal_appointment'])){
                            ?>
                            <div class="filter-chip card bg-light">
                                <b>Pendaftaran Poli Tanggal Appointment :</b> 
                                <?php
                                $date_val = get_value('pendaftaran_poli_tanggal_appointment');
                                $formated_date = "";
                                if(str_contains('-to-', $date_val)){
                                //if value is a range date
                                $vals = explode('-to-' , str_replace(' ' , '' , $date_val));
                                $startdate = $vals[0];
                                $enddate = $vals[1];
                                $formated_date = format_date($startdate, 'jS F, Y') . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, 'jS F, Y');
                                }
                                elseif(str_contains(',', $date_val)){
                                //multi date values
                                $vals = explode(',' , str_replace(' ' , '' , $date_val));
                                $formated_arrs = array_map(function($date){return format_date($date, 'jS F, Y');}, $vals);
                                $formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
                                }
                                else{
                                $formated_date = format_date($date_val, 'jS F, Y');
                                }
                                echo  $formated_date;
                                $remove_link = unset_get_value('pendaftaran_poli_tanggal_appointment', $this->route->page_url);
                                ?>
                                <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                    &times;
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div  class=" animated fadeIn page-content">
                            <div id="pendaftaran_poli-list-records">
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
                                                <th  class="td-date_created"> Tanggal Berobat</th>
                                                <th  class="td-tanggal_appointment"> Tanggal Appointment</th>
                                                <th  class="td-no_antri_poli"> No Antri Poli</th>
                                                <th  class="td-no_rekam_medis"> No Rekam Medis</th>
                                                <th  class="td-nama_pasien"> Nama Pasien</th>
                                                <th  class="td-no_ktp"> No Ktp</th>
                                                <th  class="td-setatus"> Status</th>
                                                <th  class="td-action"> Action</th>
                                                <th  class="td-jenis_kelamin"> Jenis Kelamin</th>
                                                <th  class="td-tanggal_lahir"> Tanggal Lahir</th>
                                                <th  class="td-umur"> Umur</th>
                                                <th  class="td-tinggi"> Tinggi</th>
                                                <th  class="td-berat_badan"> Berat Badan</th>
                                                <th  class="td-tensi"> Tensi</th>
                                                <th  class="td-email"> Email</th>
                                                <th  class="td-no_hp"> No Hp</th>
                                                <th  class="td-alamat"> Alamat</th>
                                                <th  class="td-keluhan"> Keluhan</th>
                                                <th  class="td-nama_poli"> Nama Poli</th>
                                                <th  class="td-dokter"> Dokter</th>
                                                <th  class="td-pembayaran"> Pembayaran</th>
                                                <th  class="td-user_entry"> User Entry</th>
                                                <th  class="td-penanggung_jawab"> Penanggung Jawab</th>
                                                <th  class="td-identitas_penanggung_jawab"> Identitas Penanggung Jawab</th>
                                                <th  class="td-hasil_laboratorium_radiologi"> Hasil Lab</th>
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
                                            $rec_id = (!empty($data['id_pendaftaran_poli']) ? urlencode($data['id_pendaftaran_poli']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pendaftaran_poli'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <td class="td-date_created">
                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['date_created'])) ?>">
                                                            <i class="fa fa-eye"></i> <?php echo $data['date_created'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="td-tanggal_appointment">
                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['tanggal_appointment'])) ?>">
                                                            <i class="fa fa-eye"></i> <?php echo $data['tanggal_appointment'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="td-no_antri_poli">
                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['no_antri_poli'])) ?>">
                                                            <i class="fa fa-eye"></i> <?php echo $data['no_antri_poli'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="td-no_rekam_medis"> <?php echo $data['no_rekam_medis']; ?></td>
                                                    <td class="td-nama_pasien"> <?php echo $data['nama_pasien']; ?></td>
                                                    <td class="td-no_ktp"> <?php echo $data['no_ktp']; ?></td>
                                                    <td class="td-setatus">
                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("resep_obat/view/" . urlencode($data['setatus'])) ?>">
                                                            <i class="fa fa-eye"></i> <?php echo $data['setatus'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="td-action"> <span>
                                                        <?php
                                                        $sekarang = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                                        $id_user = "".USER_ID;
                                                        $dbhost="".DB_HOST;
                                                        $dbuser="".DB_USERNAME;
                                                        $dbpass="".DB_PASSWORD;
                                                        $dbname="".DB_NAME;
                                                        //$koneksi=open_connection();
                                                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                                                        $sql = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
                                                        while ($row=mysqli_fetch_array($sql)){
                                                        $user_role_id = $row['user_role_id'];
                                                        }
                                                        if($user_role_id=="3"){
                                                        $sql1 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
                                                        while ($row1=mysqli_fetch_array($sql1)){
                                                        $specialist = $row1['specialist'];
                                                        }
                                                        ?>
                                                        <?php
                                                        $key="dermawangroup";
                                                        $plaintext = "$rec_id";
                                                        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                                                        $iv = openssl_random_pseudo_bytes($ivlen);
                                                        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                                                        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                                                        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                                                        ?>
                                                        <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("rekam_medis/add?csrf_token=$csrf_token&precord=$ciphertext");?>"
                                                        <i class="fa fa-send"></i>Tindakan Dan Resep</a>
                                                        <?php
                                                        //$db->where("specialist='$specialist' and tanggal='$sekarang'");
                                                        }
                                                        ?>
                                                    </span></td>
                                                    <td class="td-jenis_kelamin"> <?php echo $data['jenis_kelamin']; ?></td>
                                                    <td class="td-tanggal_lahir"> <?php echo $data['tanggal_lahir']; ?></td>
                                                    <td class="td-umur"> <?php echo $data['umur']; ?></td>
                                                    <td class="td-tinggi"> <?php echo $data['tinggi']; ?></td>
                                                    <td class="td-berat_badan"> <?php echo $data['berat_badan']; ?></td>
                                                    <td class="td-tensi"> <?php echo $data['tensi']; ?></td>
                                                    <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
                                                    <td class="td-no_hp"> <?php echo $data['no_hp']; ?></td>
                                                    <td class="td-alamat"> <?php echo $data['alamat']; ?></td>
                                                    <td class="td-keluhan"> <?php echo $data['keluhan']; ?></td>
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
                                                    <td class="td-pembayaran"> <?php echo $data['pembayaran']; ?></td>
                                                    <td class="td-user_entry">
                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['user_entry'])) ?>">
                                                            <i class="fa fa-eye"></i> <?php echo $data['user_entry'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="td-penanggung_jawab"> <?php echo $data['penanggung_jawab']; ?></td>
                                                    <td class="td-identitas_penanggung_jawab"> <?php echo $data['identitas_penanggung_jawab']; ?></td>
                                                    <td class="td-hasil_laboratorium_radiologi"><?php Html :: page_img($data['hasil_laboratorium_radiologi'],50,50,1); ?></td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("pendaftaran_poli/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("pendaftaran_poli/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pendaftaran_poli/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("pendaftaran_poli/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                                                                </div>
                                                            </div>
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
