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
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid">
                    <div class="card ">
                        <div class="card-header p-0 pt-2 px-2">
                            <ul class="nav  nav-tabs   ">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#TabPage-1-Page1" role="tab" aria-selected="true">
                                        rekam medis add
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#TabPage-1-Page2" role="tab" aria-selected="true">
                                        daftar ke laboratorium
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active fade" id="TabPage-1-Page1" role="tabpanel">
                                </div>
                                <div class="tab-pane  fade" id="TabPage-1-Page2" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 comp-grid">
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
                        $ciphertext = $_GET['precord'];
                        $ciphertext=str_replace(' ', '+', $ciphertext);
                        $resep=$ciphertext;
                        $key="dermawangroup";
                        $c = base64_decode($ciphertext);
                        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                        $iv = substr($c, 0, $ivlen);
                        $hmac = substr($c, $ivlen, $sha2len=32);
                        $ciphertext_raw = substr($c, $ivlen+$sha2len);
                        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
                        {
                        // echo $original_plaintext."\n";
                        }
                        //echo $ciphertext;
                        $sqlcek2 = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE id_pendaftaran_poli='$original_plaintext'");
                        while ($row2=mysqli_fetch_array($sqlcek2)){
                        $norekam=$row2['no_rekam_medis'];
                        $tanggal=$row2['tanggal'];
                        $nama_poli=$row2['nama_poli'];
                        $keluhan=$row2['keluhan'];
                        $pembayaran=$row2['pembayaran'];
                        }
                        $queryb = mysqli_query($koneksi, "select * from resep_obat WHERE no_rekam_medis='$norekam' and tanggal='$tanggal' and nama_poli='$nama_poli'")
                        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
                        // ambil jumlah baris data hasil query
                        $rowsb = mysqli_num_rows($queryb);
                        // cek hasil query
                        // jika "no_antrian" sudah ada
                        if ($rowsb <> 0) {
                        }else{
                        ?> 
                        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Isi Resep" href="<?php  print_link("rekam_medis/resep?precord=$resep");?>">
                        <i class="fa fa-folder-open "></i>Isi Resep</a>
                        &nbsp; Isi Resep Obat Terlebihdahulu. Baru Bisa Submit Rekam Medis
                        <?php
                        }
                        $sqlcek1 = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE id_pendaftaran_poli='$original_plaintext'");
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
                        if(!empty($_GET['resep'])){ 
                        $sql = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE id_pendaftaran_poli='$original_plaintext'");
                        while ($row=mysqli_fetch_array($sql)){
                        $no_rekam_medis=$row['no_rekam_medis'];
                        $nama_pasien=$row['nama_pasien'];
                        $alamat=$row['alamat'];
                        $no_hp=$row['no_hp'];
                        $tanggal_lahir=$row['tanggal_lahir'];
                        $jenis_kelamin=$row['jenis_kelamin'];
                        $email=$row['email'];
                        $umur=$row['umur'];
                        }
                        //echo $_GET['resep'];
                        }
                        }else{
                        if(isset($_POST['resep_obat'])){
                        $precord=$_POST['resep_obat'];
                        $idpoli=$_POST['id_pendaftaran_poli'];
                        $key="dermawangroup";
                        $plaintext = "$idpoli";
                        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                        $iv = openssl_random_pseudo_bytes($ivlen);
                        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                        if($precord=="True"){}else{
                        ?>
                        <script language="JavaScript">
                            alert('Isi Resep Obat Terlebihdahulu!!');
                            document.location='<?php print_link("rekam_medis/add?csrf_token=$csrf_token&precord=$ciphertext"); ?>';
                        </script>
                        <?php 
                        }
                        }else{
                        ?>
                        <script language="JavaScript">
                            alert('Dilarang Akses Add Langsung');
                            document.location='<?php print_link(""); ?>';
                        </script>
                        <?php 
                        }
                        }
                        /////////////////////////////////////////////////
                        $sqlcek3 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
                        while ($row3=mysqli_fetch_array($sqlcek3)){
                        $nama_dokter=$row3['nama_dokter'];
                        $nama_poli=$row3['specialist'];
                        }
                        ?>
                    </div></div>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="rekam_medis-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("rekam_medis/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal"  value="<?php echo $tanggal;?>" type="text" placeholder="Enter Tanggal"  readonly required="" name="tanggal"  class="form-control " />
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
                                                    <input id="ctrl-no_rekam_medis"  value="<?php echo $no_rekam_medis;?>" type="text" placeholder="Enter No Rekam Medis"  readonly required="" name="no_rekam_medis"  class="form-control " />
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
                                                        <input id="ctrl-nama_pasien"  value="<?php echo $nama_pasien;?>" type="text" placeholder="Enter Nama Pasien"  readonly required="" name="nama_pasien"  class="form-control " />
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
                                                            <input id="ctrl-jenis_kelamin"  value="<?php echo $jenis_kelamin;?>" type="text" placeholder="Enter Jenis Kelamin"  readonly required="" name="jenis_kelamin"  class="form-control " />
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
                                                                <input id="ctrl-tanggal_lahir"  value="<?php echo $tanggal_lahir;?>" type="text" placeholder="Enter Tanggal Lahir"  readonly required="" name="tanggal_lahir"  class="form-control " />
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
                                                                <label class="control-label" for="umur">Umur <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-umur"  value="<?php echo $umur;?>" type="text" placeholder="Enter Umur"  readonly required="" name="umur"  class="form-control " />
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
                                                                        <input id="ctrl-tinggi"  value="<?php echo $comp_model->rekam_medis_tinggi_default_value() ?>" type="text" placeholder="Enter Tinggi"  readonly required="" name="tinggi"  class="form-control " />
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
                                                                            <input id="ctrl-berat_badan"  value="<?php echo $comp_model->rekam_medis_berat_badan_default_value() ?>" type="text" placeholder="Enter Berat Badan"  readonly required="" name="berat_badan"  class="form-control " />
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
                                                                                <input id="ctrl-tensi"  value="<?php echo $comp_model->rekam_medis_tensi_default_value() ?>" type="text" placeholder="Enter Tensi"  readonly required="" name="tensi"  class="form-control " />
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
                                                                                    <input id="ctrl-keluhan"  value="<?php echo $keluhan;?>" type="text" placeholder="Enter Keluhan"  readonly required="" name="keluhan"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <select required="" data-endpoint="<?php print_link('api/json/rekam_medis_diagnosa_option_list') ?>" id="ctrl-diagnosa" name="diagnosa"  placeholder="type kode N18 or text  influenza..."    class="selectize-ajax" >
                                                                                            <option value="">type kode N18 or text  influenza...</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="persetujuan_tindakan">Persetujuan Tindakan <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <select required=""  id="ctrl-persetujuan_tindakan" name="persetujuan_tindakan"  placeholder="Select a value ..."    class="custom-select" >
                                                                                            <option value="">Select a value ...</option>
                                                                                            <?php
                                                                                            $persetujuan_tindakan_options = Menu :: $persetujuan_tindakan;
                                                                                            if(!empty($persetujuan_tindakan_options)){
                                                                                            foreach($persetujuan_tindakan_options as $option){
                                                                                            $value = $option['value'];
                                                                                            $label = $option['label'];
                                                                                            $selected = $this->set_field_selected('persetujuan_tindakan', $value, "");
                                                                                            ?>
                                                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                                                <?php echo $label ?>
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
                                                                                    <label class="control-label" for="tindakan">Tindakan <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <?php 
                                                                                        $tindakan_options = $comp_model -> rekam_medis_tindakan_option_list();
                                                                                        if(!empty($tindakan_options)){
                                                                                        $ci = 0;
                                                                                        foreach($tindakan_options as $option){
                                                                                        $ci++;
                                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                        $checked = $this->set_field_checked('tindakan', $value, "");
                                                                                        ?>
                                                                                        <label class="custom-control custom-checkbox custom-control-inline">
                                                                                            <input id="ctrl-tindakan" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="tindakan[]"   required="" />
                                                                                                <span class="custom-control-label"><?php echo $label; ?></span>
                                                                                            </label>
                                                                                            <?php
                                                                                            }
                                                                                            }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="nama_pemeriksaan_lab">Nama Pemeriksaan Lab </label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <?php 
                                                                                            $nama_pemeriksaan_lab_options = $comp_model -> rekam_medis_nama_pemeriksaan_lab_option_list();
                                                                                            if(!empty($nama_pemeriksaan_lab_options)){
                                                                                            $ci = 0;
                                                                                            foreach($nama_pemeriksaan_lab_options as $option){
                                                                                            $ci++;
                                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                            $checked = $this->set_field_checked('nama_pemeriksaan_lab', $value, "");
                                                                                            ?>
                                                                                            <label class="custom-control custom-checkbox custom-control-inline">
                                                                                                <input id="ctrl-nama_pemeriksaan_lab" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="checkbox" name="nama_pemeriksaan_lab[]"   />
                                                                                                    <span class="custom-control-label"><?php echo $label; ?></span>
                                                                                                </label>
                                                                                                <?php
                                                                                                }
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-4">
                                                                                            <label class="control-label" for="rujukan">Rujukan <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-rujukan"  value="<?php  echo $this->set_field_value('rujukan',""); ?>" type="text" placeholder="Enter Rujukan"  required="" name="rujukan"  class="form-control " />
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
                                                                                        <div class="form-group ">
                                                                                            <div class="row">
                                                                                                <div class="col-sm-4">
                                                                                                    <label class="control-label" for="dokter_pemeriksa">Dokter Pemeriksa <span class="text-danger">*</span></label>
                                                                                                </div>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="">
                                                                                                        <input id="ctrl-dokter_pemeriksa"  value="<?php  echo $this->set_field_value('dokter_pemeriksa',"$nama_dokter"); ?>" type="text" placeholder="Enter Dokter Pemeriksa"  readonly required="" name="dokter_pemeriksa"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input id="ctrl-nama_poli"  value="<?php echo $nama_poli;?>" type="hidden" placeholder="Enter Nama Poli"  readonly required="" name="nama_poli"  class="form-control " />
                                                                                                <input id="ctrl-resep_obat"  value="<?php if(!empty($_GET['resep'])){ echo $_GET['resep'];}?>" type="hidden" placeholder="Enter Resep Obat"  readonly required="" name="resep_obat"  class="form-control " />
                                                                                                    <input id="ctrl-pembayaran"  value="<?php echo $pembayaran;?>" type="hidden" placeholder="Enter Pembayaran"  required="" name="pembayaran"  class="form-control " />
                                                                                                        <div class="form-group ">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-4">
                                                                                                                    <label class="control-label" for="user_entry">User Entry <span class="text-danger">*</span></label>
                                                                                                                </div>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <div class="">
                                                                                                                        <input id="ctrl-user_entry"  value="<?php  echo $this->set_field_value('user_entry',USER_NAME); ?>" type="text" placeholder="Enter User Entry"  readonly required="" name="user_entry"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="jenis_tindakan_lab">Jenis Tindakan Lab <span class="text-danger">*</span></label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="">
                                                                                                                            <input id="ctrl-jenis_tindakan_lab"  value="<?php  echo $this->set_field_value('jenis_tindakan_lab',""); ?>" type="text" placeholder="Enter Jenis Tindakan Lab"  required="" name="jenis_tindakan_lab"  class="form-control " />
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
                                                                                    <?php
                                                                                    if( $show_header == true ){
                                                                                    ?>
                                                                                    <div  class="bg-light p-3 mb-3">
                                                                                        <div class="container">
                                                                                            <div class="row ">
                                                                                                <div class="col ">
                                                                                                    <h4 class="record-title">Add New Rekam Medis</h4>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </section>
