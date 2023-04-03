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
                    <h4 class="record-title">Add New Transaksi Clinik</h4>
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
                        if(!empty($_GET['precord'])){
                        }else{
                        ?>
                        <script language="JavaScript">
                            alert('Dilarang Akses Add Langsung');
                            document.location='<?php print_link(""); ?>';
                        </script>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
                <?php $this :: display_page_errors(); ?>
                <div  class="bg-light p-3 animated fadeIn page-content">
                    <form id="transaksi_clinik-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("transaksi_clinik/add?csrf_token=$csrf_token") ?>" method="post">
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input id="ctrl-tanggal"  value="<?php  echo $this->set_field_value('tanggal',""); ?>" type="text" placeholder="Enter Tanggal"  readonly required="" name="tanggal"  class="form-control " />
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
                                                <input id="ctrl-no_rekam_medis"  value="<?php  echo $this->set_field_value('no_rekam_medis',""); ?>" type="text" placeholder="Enter No Rekam Medis"  readonly required="" name="no_rekam_medis"  class="form-control " />
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
                                                    <input id="ctrl-nama_pasien"  value="<?php  echo $this->set_field_value('nama_pasien',""); ?>" type="text" placeholder="Enter Nama Pasien"  readonly required="" name="nama_pasien"  class="form-control " />
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
                                                        <input id="ctrl-keluhan"  value="<?php  echo $this->set_field_value('keluhan',""); ?>" type="text" placeholder="Enter Keluhan"  readonly required="" name="keluhan"  class="form-control " />
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
                                                            <input id="ctrl-diagnosa"  value="<?php  echo $this->set_field_value('diagnosa',""); ?>" type="text" placeholder="Enter Diagnosa"  readonly required="" name="diagnosa"  class="form-control " />
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
                                                                <input id="ctrl-dokter_pemeriksa"  value="<?php  echo $this->set_field_value('dokter_pemeriksa',""); ?>" type="text" placeholder="Enter Dokter Pemeriksa"  readonly required="" name="dokter_pemeriksa"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="keterangan_resep">Keterangan Resep <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-keterangan_resep"  value="<?php  echo $this->set_field_value('keterangan_resep',""); ?>" type="text" placeholder="Enter Keterangan Resep"  readonly required="" name="keterangan_resep"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="resep_obat">Resep Obat <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-resep_obat"  value="<?php  echo $this->set_field_value('resep_obat',""); ?>" type="text" placeholder="Enter Resep Obat"  readonly required="" name="resep_obat"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="keterangan_tindakan">Keterangan Tindakan <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-keterangan_tindakan"  value="<?php  echo $this->set_field_value('keterangan_tindakan',""); ?>" type="text" placeholder="Enter Keterangan Tindakan"  readonly required="" name="keterangan_tindakan"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="biaya_tindakan">Biaya Tindakan <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-biaya_tindakan"  value="<?php  echo $this->set_field_value('biaya_tindakan',""); ?>" type="number" placeholder="Enter Biaya Tindakan" step="1"  readonly required="" name="biaya_tindakan"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <div class="row">
                                                                            <div class="col-sm-4">
                                                                                <label class="control-label" for="jasa_dokter">Jasa Dokter <span class="text-danger">*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="">
                                                                                    <input id="ctrl-jasa_dokter"  value="<?php  echo $this->set_field_value('jasa_dokter',""); ?>" type="text" placeholder="Enter Jasa Dokter"  readonly required="" name="jasa_dokter"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <div class="row">
                                                                                <div class="col-sm-4">
                                                                                    <label class="control-label" for="total_biaya">Total Biaya <span class="text-danger">*</span></label>
                                                                                </div>
                                                                                <div class="col-sm-8">
                                                                                    <div class="">
                                                                                        <input id="ctrl-total_biaya"  value="<?php  echo $this->set_field_value('total_biaya',""); ?>" type="number" placeholder="Enter Total Biaya" step="1"  readonly required="" name="total_biaya"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <div class="row">
                                                                                    <div class="col-sm-4">
                                                                                        <label class="control-label" for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                                                                                    </div>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="">
                                                                                            <input id="ctrl-metode_pembayaran"  value="<?php  echo $this->set_field_value('metode_pembayaran',""); ?>" type="text" placeholder="Enter Metode Pembayaran" list="metode_pembayaran_list"  readonly required="" name="metode_pembayaran"  class="form-control " />
                                                                                                <datalist id="metode_pembayaran_list">
                                                                                                    <?php 
                                                                                                    $metode_pembayaran_options = $comp_model -> transaksi_clinik_metode_pembayaran_option_list();
                                                                                                    if(!empty($metode_pembayaran_options)){
                                                                                                    foreach($metode_pembayaran_options as $option){
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
                                                                                            <label class="control-label" for="setatus_tagihan">Setatus Tagihan <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <select required=""  id="ctrl-setatus_tagihan" name="setatus_tagihan"  placeholder="Select a value ..."    class="custom-select" >
                                                                                                    <option value="">Select a value ...</option>
                                                                                                    <?php
                                                                                                    $setatus_tagihan_options = Menu :: $setatus_tagihan;
                                                                                                    if(!empty($setatus_tagihan_options)){
                                                                                                    foreach($setatus_tagihan_options as $option){
                                                                                                    $value = $option['value'];
                                                                                                    $label = $option['label'];
                                                                                                    $selected = $this->set_field_selected('setatus_tagihan', $value, "");
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
                                                                                            <label class="control-label" for="user_entry">User Entry <span class="text-danger">*</span></label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="">
                                                                                                <select required=""  id="ctrl-user_entry" name="user_entry"  placeholder="Select a value ..."    class="selectize" >
                                                                                                    <option value="">Select a value ...</option>
                                                                                                    <?php 
                                                                                                    $user_entry_options = $comp_model -> transaksi_clinik_user_entry_option_list();
                                                                                                    if(!empty($user_entry_options)){
                                                                                                    foreach($user_entry_options as $option){
                                                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                                    $selected = $this->set_field_selected('user_entry',$value, USER_NAME);
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
