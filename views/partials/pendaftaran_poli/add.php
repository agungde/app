<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Pendaftaran Poli</h4>
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
                <div class="col-md-7 comp-grid">
                    <div class=""><div>
                        <?php
                        $id_user = "".USER_ID;
                        $dbhost  = "".DB_HOST;
                        $dbuser  = "".DB_USERNAME;
                        $dbpass  = "".DB_PASSWORD;
                        $dbname  = "".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        if(!empty($_GET['precord'])){
                        $precord = $_GET['precord'];
                        $encryption="$precord";
                        $ciphering = "AES-128-CTR";
                        // Use OpenSSl Encryption method
                        $iv_length = openssl_cipher_iv_length($ciphering);
                        $options = 0;
                        // Non-NULL Initialization Vector for decryption
                        $decryption_iv = '1234567891011121';
                        // Store the decryption key
                        $decryption_key = "dermawangroup";
                        // Use openssl_decrypt() function to decrypt the data
                        $decryption=openssl_decrypt ($encryption, $ciphering, 
                        $decryption_key, $options, $decryption_iv);
                        $precord="$decryption";
                        $sqlcek1 = mysqli_query($koneksi,"select * from data_pasien WHERE id_pasien='$precord'");
                        while ($row=mysqli_fetch_array($sqlcek1)){
                        $no_rekam_medis=$row['no_rekam_medis'];
                        $nama_pasien=$row['nama_pasien'];
                        $alamat=$row['alamat'];
                        $no_hp=$row['no_hp'];
                        $tanggal_lahir=$row['tanggal_lahir'];
                        $jenis_kelamin=$row['jenis_kelamin'];
                        $email=$row['email'];
                        $umur=$row['umur'];
                        }
                        }else{
                        ?>
                        <script language="JavaScript">
                            alert('Dilarang Akses Add Langsung');
                            document.location='<?php print_link(""); ?>';
                        </script>
                        <?php 
                        $no_rekam_medis="";
                        $nama_pasien="";
                        $alamat="";
                        $no_hp="";
                        $tanggal_lahir="";
                        $email="";
                        $jenis_kelamin="";
                        $umur="";
                        }
                        ?>
                    </div></div>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="pendaftaran_poli-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("pendaftaran_poli/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal"  value="<?php echo date('Y-m-d h:i:s');?>" type="text" placeholder="Enter Tanggal"  readonly required="" name="tanggal"  class="form-control " />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="tanggal_appointment">Tanggal Appointment <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="ctrl-tanggal_appointment" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('tanggal_appointment',date_now()); ?>" type="datetime" name="tanggal_appointment" placeholder="Enter Tanggal Appointment" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="no_rekam_medis">No Rekam Medis <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-no_rekam_medis"  value="<?php echo $no_rekam_medis;?>" type="text" placeholder="Input No Rekam Medis"  readonly required="" name="no_rekam_medis"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="nama_pasien">Nama Pasien <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-nama_pasien"  value="<?php echo $nama_pasien;?>" type="text" placeholder="Input Nama Pasien"  readonly required="" name="nama_pasien"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="no_ktp">No Ktp <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-no_ktp"  value="<?php echo $comp_model->pendaftaran_poli_no_ktp_default_value() ?>" type="text" placeholder="Enter No Ktp"  readonly required="" name="no_ktp"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input id="ctrl-tanggal_lahir"  value="<?php echo $tanggal_lahir;?>" type="text" placeholder="Input Tanggal Lahir"  readonly required="" name="tanggal_lahir"  class="form-control " />
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="tinggi">Tinggi <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-tinggi"  value="<?php  echo $this->set_field_value('tinggi',""); ?>" type="text" placeholder="Enter Tinggi"  required="" name="tinggi"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="berat_badan">Berat Badan <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-berat_badan"  value="<?php  echo $this->set_field_value('berat_badan',""); ?>" type="text" placeholder="Enter Berat Badan"  required="" name="berat_badan"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="tensi">Tensi <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-tensi"  value="<?php  echo $this->set_field_value('tensi',""); ?>" type="text" placeholder="Enter Tensi"  required="" name="tensi"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <input id="ctrl-alamat"  value="<?php echo $alamat;?>" type="text" placeholder="Input Alamat"  readonly required="" name="alamat"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <input id="ctrl-email"  value="<?php echo $email;?>" type="email" placeholder="Enter Email"  readonly required="" name="email"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="keluhan">Keluhan <span class="text-danger">*</span></label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <input id="ctrl-keluhan"  value="<?php  echo $this->set_field_value('keluhan',""); ?>" type="text" placeholder="Enter Keluhan"  required="" name="keluhan"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="nama_poli">Nama Poli <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <select required=""  id="ctrl-nama_poli" data-load-select-options="dokter" name="nama_poli"  placeholder="Select a value ..."    class="custom-select" >
                                                                                                    <option value="">Select a value ...</option>
                                                                                                    <?php 
                                                                                                    $nama_poli_options = $comp_model -> pendaftaran_poli_nama_poli_option_list();
                                                                                                    if(!empty($nama_poli_options)){
                                                                                                    foreach($nama_poli_options as $option){
                                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                    $selected = $this->set_field_selected('nama_poli',$value, "");
                                                                                                    ?>
                                                                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                                                        <?php echo $label; ?>
                                                                                                    </option>
                                                                                                    <?php
                                                                                                    }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="dokter">Dokter <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <select required=""  id="ctrl-dokter" data-load-path="<?php print_link('api/json/pendaftaran_poli_dokter_option_list') ?>" name="dokter"  placeholder="Select a value ..."    class="custom-select" >
                                                                                                    <option value="">Select a value ...</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-jenis_kelamin"  value="<?php echo $jenis_kelamin;?>" type="text" placeholder="Input Jenis Kelamin"  readonly required="" name="jenis_kelamin"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-4">
                                                                                                <label class="control-label" for="no_hp">No Hp <span class="text-danger">*</span></label>
                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="">
                                                                                                    <input id="ctrl-no_hp"  value="<?php echo $no_hp;?>" type="text" placeholder="Input No Hp"  readonly required="" name="no_hp"  class="form-control " />
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="pembayaran">Pembayaran <span class="text-danger">*</span></label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="">
                                                                                                        <select required=""  id="ctrl-pembayaran" name="pembayaran"  placeholder="Select a value ..."    class="custom-select" >
                                                                                                            <option value="">Select a value ...</option>
                                                                                                            <?php 
                                                                                                            $pembayaran_options = $comp_model -> pendaftaran_poli_pembayaran_option_list();
                                                                                                            if(!empty($pembayaran_options)){
                                                                                                            foreach($pembayaran_options as $option){
                                                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                            $selected = $this->set_field_selected('pembayaran',$value, "");
                                                                                                            ?>
                                                                                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                                                                <?php echo $label; ?>
                                                                                                            </option>
                                                                                                            <?php
                                                                                                            }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="penanggung_jawab">Penanggung Jawab <span class="text-danger">*</span></label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="">
                                                                                                        <input id="ctrl-penanggung_jawab"  value="<?php  echo $this->set_field_value('penanggung_jawab',""); ?>" type="text" placeholder="Enter Penanggung Jawab"  required="" name="penanggung_jawab"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <label class="control-label" for="identitas_penanggung_jawab">Identitas Penanggung Jawab <span class="text-danger">*</span></label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="">
                                                                                                            <input id="ctrl-identitas_penanggung_jawab"  value="<?php  echo $this->set_field_value('identitas_penanggung_jawab',""); ?>" type="number" placeholder="Enter Identitas Penanggung Jawab" min="1000000000000000" max="9999999999999999" step="1"  required="" name="identitas_penanggung_jawab"  data-url="api/json/pendaftaran_poli_identitas_penanggung_jawab_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                                                                                                <div class="check-status"></div> 
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-4">
                                                                                                            <label class="control-label" for="user_entry">User Entry <span class="text-danger">*</span></label>
                                                                                                        </div>
                                                                                                        <div class="col-sm-8">
                                                                                                            <div class="">
                                                                                                                <input id="ctrl-user_entry"  value="<?php  echo $this->set_field_value('user_entry',USER_NAME); ?>" type="text" placeholder="Enter User Entry" list="user_entry_list"  readonly required="" name="user_entry"  class="form-control " />
                                                                                                                    <datalist id="user_entry_list">
                                                                                                                        <?php 
                                                                                                                        $user_entry_options = $comp_model -> pendaftaran_poli_user_entry_option_list();
                                                                                                                        if(!empty($user_entry_options)){
                                                                                                                        foreach($user_entry_options as $option){
                                                                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                                        ?>
                                                                                                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                    </datalist>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-4">
                                                                                                                <label class="control-label" for="hasil_laboratorium_radiologi">Hasil Laboratorium Radiologi </label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-8">
                                                                                                                <div class="">
                                                                                                                    <div class="dropzone " input="#ctrl-hasil_laboratorium_radiologi" fieldname="hasil_laboratorium_radiologi"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" filesize="3" maximum="1">
                                                                                                                        <input name="hasil_laboratorium_radiologi" id="ctrl-hasil_laboratorium_radiologi" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('hasil_laboratorium_radiologi',""); ?>" type="text"  />
                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                                                        <div class="form-ajax-status"></div>
                                                                                                        <button class="btn btn-primary" type="submit">
                                                                                                            Submit
                                                                                                            <i class="fa fa-send"></i>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
