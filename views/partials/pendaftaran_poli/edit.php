<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Pendaftaran Poli</h4>
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
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pendaftaran_poli/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal"  value="<?php  echo $data['tanggal']; ?>" type="text" placeholder="Enter Tanggal"  readonly required="" name="tanggal"  class="form-control " />
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
                                                    <input id="ctrl-tanggal_appointment" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['tanggal_appointment']; ?>" type="datetime" name="tanggal_appointment" placeholder="Enter Tanggal Appointment" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
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
                                                        <input id="ctrl-no_rekam_medis"  value="<?php  echo $data['no_rekam_medis']; ?>" type="text" placeholder="Input No Rekam Medis"  readonly required="" name="no_rekam_medis"  class="form-control " />
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
                                                            <input id="ctrl-nama_pasien"  value="<?php  echo $data['nama_pasien']; ?>" type="text" placeholder="Input Nama Pasien"  readonly required="" name="nama_pasien"  class="form-control " />
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
                                                                <input id="ctrl-no_ktp"  value="<?php  echo $data['no_ktp']; ?>" type="text" placeholder="Enter No Ktp"  readonly required="" name="no_ktp"  class="form-control " />
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
                                                                    <input id="ctrl-tanggal_lahir"  value="<?php  echo $data['tanggal_lahir']; ?>" type="text" placeholder="Input Tanggal Lahir"  readonly required="" name="tanggal_lahir"  class="form-control " />
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
                                                                        <input id="ctrl-tinggi"  value="<?php  echo $data['tinggi']; ?>" type="text" placeholder="Enter Tinggi"  required="" name="tinggi"  class="form-control " />
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
                                                                            <input id="ctrl-berat_badan"  value="<?php  echo $data['berat_badan']; ?>" type="text" placeholder="Enter Berat Badan"  required="" name="berat_badan"  class="form-control " />
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
                                                                                <input id="ctrl-tensi"  value="<?php  echo $data['tensi']; ?>" type="text" placeholder="Enter Tensi"  required="" name="tensi"  class="form-control " />
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
                                                                                    <input id="ctrl-alamat"  value="<?php  echo $data['alamat']; ?>" type="text" placeholder="Input Alamat"  readonly required="" name="alamat"  class="form-control " />
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
                                                                                        <input id="ctrl-email"  value="<?php  echo $data['email']; ?>" type="email" placeholder="Enter Email"  readonly required="" name="email"  class="form-control " />
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
                                                                                            <input id="ctrl-keluhan"  value="<?php  echo $data['keluhan']; ?>" type="text" placeholder="Enter Keluhan"  required="" name="keluhan"  class="form-control " />
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
                                                                                                    $rec = $data['nama_poli'];
                                                                                                    $nama_poli_options = $comp_model -> pendaftaran_poli_nama_poli_option_list();
                                                                                                    if(!empty($nama_poli_options)){
                                                                                                    foreach($nama_poli_options as $option){
                                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                                                                    ?>
                                                                                                    <option 
                                                                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                                                                                    <?php
                                                                                                    $rec = $data['dokter'];
                                                                                                    $dokter_options = $comp_model -> pendaftaran_poli_dokter_option_list($data['nama_poli']);
                                                                                                    if(!empty($dokter_options)){
                                                                                                    foreach($dokter_options as $option){
                                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                                                                    ?>
                                                                                                    <option 
                                                                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                                                                            <label class="control-label" for="setatus">Setatus <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <input id="ctrl-setatus"  value="<?php  echo $data['setatus']; ?>" type="text" placeholder="Enter Setatus" list="setatus_list"  required="" name="setatus"  class="form-control " />
                                                                                                    <datalist id="setatus_list">
                                                                                                        <?php 
                                                                                                        $setatus_options = $comp_model -> pendaftaran_poli_setatus_option_list();
                                                                                                        if(!empty($setatus_options)){
                                                                                                        foreach($setatus_options as $option){
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
                                                                                                <label class="control-label" for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                                <div class="">
                                                                                                    <input id="ctrl-jenis_kelamin"  value="<?php  echo $data['jenis_kelamin']; ?>" type="text" placeholder="Input Jenis Kelamin"  readonly required="" name="jenis_kelamin"  class="form-control " />
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
                                                                                                        <input id="ctrl-no_hp"  value="<?php  echo $data['no_hp']; ?>" type="text" placeholder="Input No Hp"  readonly required="" name="no_hp"  class="form-control " />
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
                                                                                                                $rec = $data['pembayaran'];
                                                                                                                $pembayaran_options = $comp_model -> pendaftaran_poli_pembayaran_option_list();
                                                                                                                if(!empty($pembayaran_options)){
                                                                                                                foreach($pembayaran_options as $option){
                                                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                                                                ?>
                                                                                                                <option 
                                                                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                                                                                            <input id="ctrl-penanggung_jawab"  value="<?php  echo $data['penanggung_jawab']; ?>" type="text" placeholder="Enter Penanggung Jawab"  required="" name="penanggung_jawab"  class="form-control " />
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
                                                                                                                <input id="ctrl-identitas_penanggung_jawab"  value="<?php  echo $data['identitas_penanggung_jawab']; ?>" type="number" placeholder="Enter Identitas Penanggung Jawab" min="1000000000000000" max="9999999999999999" step="1"  required="" name="identitas_penanggung_jawab"  data-url="api/json/pendaftaran_poli_identitas_penanggung_jawab_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
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
                                                                                                                    <input id="ctrl-user_entry"  value="<?php  echo $data['user_entry']; ?>" type="text" placeholder="Enter User Entry" list="user_entry_list"  readonly required="" name="user_entry"  class="form-control " />
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
                                                                                                                            <input name="hasil_laboratorium_radiologi" id="ctrl-hasil_laboratorium_radiologi" class="dropzone-input form-control" value="<?php  echo $data['hasil_laboratorium_radiologi']; ?>" type="text"  />
                                                                                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <?php Html :: uploaded_files_list($data['hasil_laboratorium_radiologi'], '#ctrl-hasil_laboratorium_radiologi'); ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-ajax-status"></div>
                                                                                                        <div class="form-group text-center">
                                                                                                            <button class="btn btn-primary" type="submit">
                                                                                                                Update
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
