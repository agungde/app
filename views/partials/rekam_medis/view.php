<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("rekam_medis/add");
$can_edit = ACL::is_allowed("rekam_medis/edit");
$can_view = ACL::is_allowed("rekam_medis/view");
$can_delete = ACL::is_allowed("rekam_medis/delete");
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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Rekam Medis</h4>
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
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_rekam_medis']) ? urlencode($data['id_rekam_medis']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-no_rekam_medis">
                                        <th class="title"> No Rekam Medis: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
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
                                    <tr  class="td-nama_pasien">
                                        <th class="title"> Nama Pasien: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
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
                                    <tr  class="td-alamat">
                                        <th class="title"> Alamat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
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
                                    </tr>
                                    <tr  class="td-no_hp">
                                        <th class="title"> No Hp: </th>
                                        <td class="value"> <?php echo $data['no_hp']; ?></td>
                                    </tr>
                                    <tr  class="td-keluhan">
                                        <th class="title"> Keluhan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keluhan']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="keluhan" 
                                                data-title="Enter Keluhan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['keluhan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tindakan">
                                        <th class="title"> Tindakan: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['tindakan'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['tindakan'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_pemeriksaan_lab">
                                        <th class="title"> Nama Pemeriksaan Lab: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['nama_pemeriksaan_lab'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['nama_pemeriksaan_lab'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-diagnosa">
                                        <th class="title"> Diagnosa: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-sourceurl="<?php print_link('api/json/rekam_medis_diagnosa_option_list'); ?>" 
                                                data-source='<?php print_link('api/json/rekam_medis_diagnosa_option_list'); ?>' 
                                                data-value="<?php echo $data['diagnosa']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="diagnosa" 
                                                data-title="type kode N18 or text  influenza..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" <?php } ?>>
                                                <?php echo $data['diagnosa']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rujukan">
                                        <th class="title"> Rujukan: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['rujukan'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['rujukan'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value"> <?php echo $data['email']; ?></td>
                                    </tr>
                                    <tr  class="td-persetujuan_tindakan">
                                        <th class="title"> Persetujuan Tindakan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $persetujuan_tindakan); ?>' 
                                                data-value="<?php echo $data['persetujuan_tindakan']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="persetujuan_tindakan" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['persetujuan_tindakan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_poli">
                                        <th class="title"> Nama Poli: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-dokter_pemeriksa">
                                        <th class="title"> Dokter Pemeriksa: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="dokter_pemeriksa" 
                                                data-title="Enter Dokter Pemeriksa" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['dokter_pemeriksa']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-resep_obat">
                                        <th class="title"> Resep Obat: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['resep_obat'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['resep_obat'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-jenis_kelamin">
                                        <th class="title"> Jenis Kelamin: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kelamin']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="jenis_kelamin" 
                                                data-title="Enter Jenis Kelamin" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_kelamin']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tanggal_lahir">
                                        <th class="title"> Tanggal Lahir: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_lahir']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="tanggal_lahir" 
                                                data-title="Enter Tanggal Lahir" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <span title="<?php echo human_datetime($data['tanggal_lahir']); ?>" class="has-tooltip">
                                                    <?php echo relative_date($data['tanggal_lahir']); ?>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-umur">
                                        <th class="title"> Umur: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="umur" 
                                                data-title="Enter Umur" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['umur']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_created">
                                        <th class="title"> Date Created: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['date_created'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['date_created'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-pembayaran">
                                        <th class="title"> Pembayaran: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['pembayaran']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="pembayaran" 
                                                data-title="Enter Pembayaran" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['pembayaran']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_updated">
                                        <th class="title"> Date Updated: </th>
                                        <td class="value"> <?php echo $data['date_updated']; ?></td>
                                    </tr>
                                    <tr  class="td-user_entry">
                                        <th class="title"> User Entry: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['user_entry'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['user_entry'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-tinggi">
                                        <th class="title"> Tinggi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tinggi']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="tinggi" 
                                                data-title="Enter Tinggi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tinggi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-berat_badan">
                                        <th class="title"> Berat Badan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['berat_badan']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="berat_badan" 
                                                data-title="Enter Berat Badan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['berat_badan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tensi">
                                        <th class="title"> Tensi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tensi']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="tensi" 
                                                data-title="Enter Tensi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tensi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-hasil_laboratorium_radiologi">
                                        <th class="title"> Hasil Laboratorium Radiologi: </th>
                                        <td class="value"><?php Html :: page_img($data['hasil_laboratorium_radiologi'],400,400,1); ?></td>
                                    </tr>
                                    <tr  class="td-id_lab">
                                        <th class="title"> Id Lab: </th>
                                        <td class="value"> <?php echo $data['id_lab']; ?></td>
                                    </tr>
                                    <tr  class="td-jenis_tindakan_lab">
                                        <th class="title"> Jenis Tindakan Lab: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_tindakan_lab']; ?>" 
                                                data-pk="<?php echo $data['id_rekam_medis'] ?>" 
                                                data-url="<?php print_link("rekam_medis/editfield/" . urlencode($data['id_rekam_medis'])); ?>" 
                                                data-name="jenis_tindakan_lab" 
                                                data-title="Enter Jenis Tindakan Lab" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['jenis_tindakan_lab']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-info"  href="<?php print_link("rekam_medis/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("rekam_medis/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                <i class="fa fa-times"></i> Delete
                            </a>
                            <?php } ?>
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
                </div>
            </div>
        </div>
    </div>
</section>
