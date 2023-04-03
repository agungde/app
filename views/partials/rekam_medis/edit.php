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
                    <h4 class="record-title">Edit  Rekam Medis</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("rekam_medis/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
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
                                                <label class="control-label" for="no_rekam_medis">No Rekam Medis <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-no_rekam_medis"  value="<?php  echo $data['no_rekam_medis']; ?>" type="text" placeholder="Enter No Rekam Medis"  readonly required="" name="no_rekam_medis"  class="form-control " />
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
                                                        <input id="ctrl-nama_pasien"  value="<?php  echo $data['nama_pasien']; ?>" type="text" placeholder="Enter Nama Pasien"  readonly required="" name="nama_pasien"  class="form-control " />
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
                                                            <input id="ctrl-jenis_kelamin"  value="<?php  echo $data['jenis_kelamin']; ?>" type="text" placeholder="Enter Jenis Kelamin"  readonly required="" name="jenis_kelamin"  class="form-control " />
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
                                                                <input id="ctrl-tanggal_lahir"  value="<?php  echo $data['tanggal_lahir']; ?>" type="text" placeholder="Enter Tanggal Lahir"  readonly required="" name="tanggal_lahir"  class="form-control " />
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
                                                                    <input id="ctrl-umur"  value="<?php  echo $data['umur']; ?>" type="text" placeholder="Enter Umur"  readonly required="" name="umur"  class="form-control " />
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
                                                                        <input id="ctrl-tinggi"  value="<?php  echo $data['tinggi']; ?>" type="text" placeholder="Enter Tinggi"  readonly required="" name="tinggi"  class="form-control " />
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
                                                                            <input id="ctrl-berat_badan"  value="<?php  echo $data['berat_badan']; ?>" type="text" placeholder="Enter Berat Badan"  readonly required="" name="berat_badan"  class="form-control " />
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
                                                                                <input id="ctrl-tensi"  value="<?php  echo $data['tensi']; ?>" type="text" placeholder="Enter Tensi"  readonly required="" name="tensi"  class="form-control " />
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
                                                                                    <input id="ctrl-alamat"  value="<?php  echo $data['alamat']; ?>" type="text" placeholder="Enter Alamat"  readonly required="" name="alamat"  class="form-control " />
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
                                                                                        <input id="ctrl-keluhan"  value="<?php  echo $data['keluhan']; ?>" type="text" placeholder="Enter Keluhan"  readonly required="" name="keluhan"  class="form-control " />
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
                                                                                                $field_value = $data['persetujuan_tindakan'];
                                                                                                if(!empty($persetujuan_tindakan_options)){
                                                                                                foreach($persetujuan_tindakan_options as $option){
                                                                                                $value = $option['value'];
                                                                                                $label = $option['label'];
                                                                                                $selected = ( $value == $field_value ? 'selected' : null );
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
                                                                                            $arrRec = explode(',', $data['tindakan']);
                                                                                            if(!empty($tindakan_options)){
                                                                                            foreach($tindakan_options as $option){
                                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                            $checked = (in_array($value , $arrRec) ? 'checked' : null);
                                                                                            ?>
                                                                                            <label class="custom-control custom-checkbox custom-control-inline option-btn">
                                                                                                <input id="ctrl-tindakan" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value; ?>" type="checkbox"  name="tindakan[]" required="" />
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
                                                                                                $arrRec = explode(',', $data['nama_pemeriksaan_lab']);
                                                                                                if(!empty($nama_pemeriksaan_lab_options)){
                                                                                                foreach($nama_pemeriksaan_lab_options as $option){
                                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                $checked = (in_array($value , $arrRec) ? 'checked' : null);
                                                                                                ?>
                                                                                                <label class="custom-control custom-checkbox custom-control-inline option-btn">
                                                                                                    <input id="ctrl-nama_pemeriksaan_lab" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value; ?>" type="checkbox"  name="nama_pemeriksaan_lab[]" />
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
                                                                                                    <input id="ctrl-rujukan"  value="<?php  echo $data['rujukan']; ?>" type="text" placeholder="Enter Rujukan"  required="" name="rujukan"  class="form-control " />
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
                                                                                            <div class="form-group ">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-4">
                                                                                                        <label class="control-label" for="dokter_pemeriksa">Dokter Pemeriksa <span class="text-danger">*</span></label>
                                                                                                    </div>
                                                                                                    <div class="col-sm-8">
                                                                                                        <div class="">
                                                                                                            <input id="ctrl-dokter_pemeriksa"  value="<?php  echo $data['dokter_pemeriksa']; ?>" type="text" placeholder="Enter Dokter Pemeriksa"  readonly required="" name="dokter_pemeriksa"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <input id="ctrl-nama_poli"  value="<?php  echo $data['nama_poli']; ?>" type="hidden" placeholder="Enter Nama Poli"  readonly required="" name="nama_poli"  class="form-control " />
                                                                                                    <input id="ctrl-resep_obat"  value="<?php  echo $data['resep_obat']; ?>" type="hidden" placeholder="Enter Resep Obat"  readonly required="" name="resep_obat"  class="form-control " />
                                                                                                        <input id="ctrl-pembayaran"  value="<?php  echo $data['pembayaran']; ?>" type="hidden" placeholder="Enter Pembayaran"  required="" name="pembayaran"  class="form-control " />
                                                                                                            <div class="form-group ">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-4">
                                                                                                                        <label class="control-label" for="user_entry">User Entry <span class="text-danger">*</span></label>
                                                                                                                    </div>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <div class="">
                                                                                                                            <input id="ctrl-user_entry"  value="<?php  echo $data['user_entry']; ?>" type="text" placeholder="Enter User Entry"  readonly required="" name="user_entry"  class="form-control " />
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
                                                                                                                                <input id="ctrl-jenis_tindakan_lab"  value="<?php  echo $data['jenis_tindakan_lab']; ?>" type="text" placeholder="Enter Jenis Tindakan Lab"  required="" name="jenis_tindakan_lab"  class="form-control " />
                                                                                                                                </div>
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
