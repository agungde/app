<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("hasil_laboratorium/add");
$can_edit = ACL::is_allowed("hasil_laboratorium/edit");
$can_view = ACL::is_allowed("hasil_laboratorium/view");
$can_delete = ACL::is_allowed("hasil_laboratorium/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page ajax-page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Hasil Laboratorium</h4>
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
                <div class="col-sm-10 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_hasil_lab']) ? urlencode($data['id_hasil_lab']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <?php Html::ajaxpage_spinner(); ?>
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-nama_pasien">
                                        <th class="title"> Nama Pasien: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="nama_pasien" 
                                                data-title="Enter Nama Pasien" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nama_pasien']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_rekam_medis">
                                        <th class="title"> No Rekam Medis: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="no_rekam_medis" 
                                                data-title="Enter No Rekam Medis" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_rekam_medis']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-jenis_pemeriksaan">
                                        <th class="title"> Jenis Pemeriksaan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_pemeriksaan']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="jenis_pemeriksaan" 
                                                data-title="Enter Jenis Pemeriksaan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_pemeriksaan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dokter_pengirim">
                                        <th class="title"> Dokter Pengirim: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pengirim']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="dokter_pengirim" 
                                                data-title="Enter Dokter Pengirim" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['dokter_pengirim']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dokter_laboratorium">
                                        <th class="title"> Dokter Laboratorium: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_laboratorium']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="dokter_laboratorium" 
                                                data-title="Enter Dokter Laboratorium" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['dokter_laboratorium']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-diagnosa">
                                        <th class="title"> Diagnosa: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['diagnosa']; ?>" 
                                                data-pk="<?php echo $data['id_hasil_lab'] ?>" 
                                                data-url="<?php print_link("hasil_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                                                data-name="diagnosa" 
                                                data-title="Enter Diagnosa" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['diagnosa']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="fa fa-ban"></i> No Record Found
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class=" ">
                        <?php  
                        $this->render_page("list_hasil_lab/list?limit_count=20" , array( 'show_header' => false )); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
