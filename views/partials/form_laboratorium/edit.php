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
                    <h4 class="record-title">Edit  Form Laboratorium</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("form_laboratorium/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-tanggal" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['tanggal']; ?>" type="datetime" name="tanggal" placeholder="Enter Tanggal" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="D\d-m-Y" data-inline="false" data-no-calendar="false" data-mode="single" />
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
                                                <label class="control-label" for="nama_pasien">Nama Pasien <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-nama_pasien" data-load-select-options="no_rekam_medis,alamat,no_hp,keluhan" name="nama_pasien"  placeholder="Select a value ..."    class="custom-select" >
                                                        <option value="">Select a value ...</option>
                                                        <?php
                                                        $rec = $data['nama_pasien'];
                                                        $nama_pasien_options = $comp_model -> form_laboratorium_nama_pasien_option_list();
                                                        if(!empty($nama_pasien_options)){
                                                        foreach($nama_pasien_options as $option){
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
                                                <label class="control-label" for="no_rekam_medis">No Rekam Medis <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-no_rekam_medis" data-load-path="<?php print_link('api/json/form_laboratorium_no_rekam_medis_option_list') ?>" name="no_rekam_medis"  placeholder="Select a value ..."    class="selectize" >
                                                        <?php
                                                        $rec = $data['no_rekam_medis'];
                                                        $no_rekam_medis_options = $comp_model -> form_laboratorium_no_rekam_medis_option_list($data['nama_pasien']);
                                                        if(!empty($no_rekam_medis_options)){
                                                        foreach($no_rekam_medis_options as $option){
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
                                                <label class="control-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-alamat" data-load-path="<?php print_link('api/json/form_laboratorium_alamat_option_list') ?>" name="alamat"  placeholder="Select a value ..."    class="custom-select" >
                                                        <?php
                                                        $rec = $data['alamat'];
                                                        $alamat_options = $comp_model -> form_laboratorium_alamat_option_list($data['nama_pasien']);
                                                        if(!empty($alamat_options)){
                                                        foreach($alamat_options as $option){
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
                                                <label class="control-label" for="no_hp">No Hp <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-no_hp" data-load-path="<?php print_link('api/json/form_laboratorium_no_hp_option_list') ?>" name="no_hp"  placeholder="Select a value ..."    class="custom-select" >
                                                        <?php
                                                        $rec = $data['no_hp'];
                                                        $no_hp_options = $comp_model -> form_laboratorium_no_hp_option_list($data['nama_pasien']);
                                                        if(!empty($no_hp_options)){
                                                        foreach($no_hp_options as $option){
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
                                                <label class="control-label" for="keluhan">Keluhan <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-keluhan" data-load-path="<?php print_link('api/json/form_laboratorium_keluhan_option_list') ?>" name="keluhan"  placeholder="Select a value ..."    class="custom-select" >
                                                        <?php
                                                        $rec = $data['keluhan'];
                                                        $keluhan_options = $comp_model -> form_laboratorium_keluhan_option_list($data['nama_pasien']);
                                                        if(!empty($keluhan_options)){
                                                        foreach($keluhan_options as $option){
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
                                                <label class="control-label" for="jenis_pemeriksaan">Jenis Pemeriksaan </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <?php
                                                    $jenis_pemeriksaan_options = Menu :: $jenis_pemeriksaan2;
                                                    $field_value = $data['jenis_pemeriksaan'];
                                                    if(!empty($jenis_pemeriksaan_options)){
                                                    foreach($jenis_pemeriksaan_options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if value is among checked options
                                                    $checked = $this->check_form_field_checked($field_value, $value);
                                                    ?>
                                                    <label class="custom-control custom-checkbox custom-control-inline option-btn">
                                                        <input id="ctrl-jenis_pemeriksaan" class="custom-control-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"  name="jenis_pemeriksaan[]" />
                                                            <span class="custom-control-label"><?php echo $label ?></span>
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
                                                    <label class="control-label" for="nama_pemeriksaan">Nama Pemeriksaan <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <select required=""  id="ctrl-nama_pemeriksaan" name="nama_pemeriksaan"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="hasil_pemeriksaan">Hasil Pemeriksaan <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-hasil_pemeriksaan"  value="<?php  echo $data['hasil_pemeriksaan']; ?>" type="text" placeholder="Enter Hasil Pemeriksaan"  required="" name="hasil_pemeriksaan"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="nilai_rujukan">Nilai Rujukan <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-nilai_rujukan"  value="<?php  echo $data['nilai_rujukan']; ?>" type="text" placeholder="Enter Nilai Rujukan"  required="" name="nilai_rujukan"  class="form-control " />
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
                                                                <select required=""  id="ctrl-nama_poli" name="nama_poli"  placeholder="Select a value ..."    class="custom-select" >
                                                                    <option value="">Select a value ...</option>
                                                                    <?php
                                                                    $rec = $data['nama_poli'];
                                                                    $nama_poli_options = $comp_model -> form_laboratorium_nama_poli_option_list();
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
                                                            <label class="control-label" for="dokter_pemeriksa">Dokter Pemeriksa <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <select required=""  id="ctrl-dokter_pemeriksa" name="dokter_pemeriksa"  placeholder="Select a value ..."    class="selectize" >
                                                                    <option value="">Select a value ...</option>
                                                                    <?php
                                                                    $rec = $data['dokter_pemeriksa'];
                                                                    $dokter_pemeriksa_options = $comp_model -> form_laboratorium_dokter_pemeriksa_option_list();
                                                                    if(!empty($dokter_pemeriksa_options)){
                                                                    foreach($dokter_pemeriksa_options as $option){
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
                                            </div>
                                            <div class="form-ajax-status"></div>
                                            <div class="form-group text-center">
                                                <button class="btn btn-primary" type="submit">
                                                    submit
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
