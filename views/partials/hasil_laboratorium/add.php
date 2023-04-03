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
                    <h4 class="record-title">Add New Hasil Laboratorium</h4>
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
                        <form id="hasil_laboratorium-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("hasil_laboratorium/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="no_rekam_medis">No Rekam Medis <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-no_rekam_medis"  value="<?php  echo $this->set_field_value('no_rekam_medis',""); ?>" type="text" placeholder="Enter No Rekam Medis"  required="" name="no_rekam_medis"  class="form-control " />
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
                                                    <input id="ctrl-nama_pasien"  value="<?php  echo $this->set_field_value('nama_pasien',""); ?>" type="text" placeholder="Enter Nama Pasien"  required="" name="nama_pasien"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="jenis_pemeriksaan">Jenis Pemeriksaan <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-jenis_pemeriksaan"  value="<?php  echo $this->set_field_value('jenis_pemeriksaan',""); ?>" type="text" placeholder="Enter Jenis Pemeriksaan"  required="" name="jenis_pemeriksaan"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="dokter_pengirim">Dokter Pengirim <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-dokter_pengirim"  value="<?php  echo $this->set_field_value('dokter_pengirim',""); ?>" type="text" placeholder="Enter Dokter Pengirim"  required="" name="dokter_pengirim"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="dokter_laboratorium">Dokter Laboratorium <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-dokter_laboratorium"  value="<?php  echo $this->set_field_value('dokter_laboratorium',""); ?>" type="text" placeholder="Enter Dokter Laboratorium"  required="" name="dokter_laboratorium"  class="form-control " />
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
                                                                    <input id="ctrl-diagnosa"  value="<?php  echo $this->set_field_value('diagnosa',""); ?>" type="text" placeholder="Enter Diagnosa"  required="" name="diagnosa"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-light p-2 subform">
                                                        <h4 class="record-title"></h4>
                                                        <hr />
                                                        <div>
                                                            <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="bg-light"><label for="nama_pemeriksaan">Nama Pemeriksaan</label></th>
                                                                        <th class="bg-light"><label for="hasil">Hasil</label></th>
                                                                        <th class="bg-light"><label for="nilai_rujukan">Nilai Rujukan</label></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    for( $row = 1; $row <= 1; $row++ ){
                                                                    ?>
                                                                    <tr class="input-row">
                                                                        <td>
                                                                            <div id="ctrl-nama_pemeriksaan-row<?php echo $row; ?>-holder" class="">
                                                                                <input id="ctrl-nama_pemeriksaan-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('nama_pemeriksaan',"", $row); ?>" type="text" placeholder="Enter Nama Pemeriksaan"  required="" name="list_hasil_lab[row<?php echo $row ?>][nama_pemeriksaan]"  class="form-control " />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="ctrl-hasil-row<?php echo $row; ?>-holder" class="">
                                                                                    <input id="ctrl-hasil-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('hasil',"", $row); ?>" type="text" placeholder="Enter Hasil"  required="" name="list_hasil_lab[row<?php echo $row ?>][hasil]"  class="form-control " />
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div id="ctrl-nilai_rujukan-row<?php echo $row; ?>-holder" class="">
                                                                                        <input id="ctrl-nilai_rujukan-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('nilai_rujukan',"", $row); ?>" type="text" placeholder="Enter Nilai Rujukan"  required="" name="list_hasil_lab[row<?php echo $row ?>][nilai_rujukan]"  class="form-control " />
                                                                                        </div>
                                                                                    </td>
                                                                                    <th class="text-center">
                                                                                        <button type="button" class="close btn-remove-table-row">&times;</button>
                                                                                    </th>
                                                                                </tr>
                                                                                <?php 
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th colspan="100" class="text-right">
                                                                                        <?php $template_id = "table-row-" . random_str(); ?>
                                                                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-light btn-add-table-row"><i class="fa fa-plus"></i></button>
                                                                                    </th>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                    <div class="form-ajax-status"></div>
                                                                    <button class="btn btn-primary" type="submit">
                                                                        Submit
                                                                        <i class="fa fa-send"></i>
                                                                    </button>
                                                                </div>
                                                                </form><template id="<?php echo $template_id ?>">
                                                                <tr class="input-row">
                                                                    <?php $row = 1; ?>
                                                                    <td>
                                                                        <div id="ctrl-nama_pemeriksaan-row<?php echo $row; ?>-holder" class="">
                                                                            <input id="ctrl-nama_pemeriksaan-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('nama_pemeriksaan',"", $row); ?>" type="text" placeholder="Enter Nama Pemeriksaan"  required="" name="list_hasil_lab[row<?php echo $row ?>][nama_pemeriksaan]"  class="form-control " />
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="ctrl-hasil-row<?php echo $row; ?>-holder" class="">
                                                                                <input id="ctrl-hasil-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('hasil',"", $row); ?>" type="text" placeholder="Enter Hasil"  required="" name="list_hasil_lab[row<?php echo $row ?>][hasil]"  class="form-control " />
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="ctrl-nilai_rujukan-row<?php echo $row; ?>-holder" class="">
                                                                                    <input id="ctrl-nilai_rujukan-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('nilai_rujukan',"", $row); ?>" type="text" placeholder="Enter Nilai Rujukan"  required="" name="list_hasil_lab[row<?php echo $row ?>][nilai_rujukan]"  class="form-control " />
                                                                                    </div>
                                                                                </td>
                                                                                <th class="text-center">
                                                                                    <button type="button" class="close btn-remove-table-row">&times;</button>
                                                                                </th>
                                                                            </tr>
                                                                        </template>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
