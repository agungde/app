<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pendaftaran_poli/add");
$can_edit = ACL::is_allowed("pendaftaran_poli/edit");
$can_view = ACL::is_allowed("pendaftaran_poli/view");
$can_delete = ACL::is_allowed("pendaftaran_poli/delete");
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
                    <h4 class="record-title">View  Pendaftaran Poli</h4>
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
                        $rec_id = (!empty($data['id_pendaftaran_poli']) ? urlencode($data['id_pendaftaran_poli']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-tanggal_appointment">
                                        <th class="title"> Tanggal Appointment: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['tanggal_appointment'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['tanggal_appointment'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-date_created">
                                        <th class="title"> Tanggal Berobat: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['date_created'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['date_created'] ?>
                                            </a>
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
                                    <tr  class="td-dokter">
                                        <th class="title"> Dokter: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_dokter/view/" . urlencode($data['dokter'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['data_dokter_nama_dokter'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-nama_pasien">
                                        <th class="title"> Nama Pasien: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="nama_pasien" 
                                                data-title="Input Nama Pasien" 
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
                                    <tr  class="td-no_ktp">
                                        <th class="title"> No Ktp: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_ktp']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="no_ktp" 
                                                data-title="Enter No Ktp" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_ktp']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_rekam_medis">
                                        <th class="title"> No Rekam Medis: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="no_rekam_medis" 
                                                data-title="Input No Rekam Medis" 
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
                                    <tr  class="td-no_hp">
                                        <th class="title"> No Hp: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="no_hp" 
                                                data-title="Input No Hp" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['no_hp']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-alamat">
                                        <th class="title"> Alamat: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="alamat" 
                                                data-title="Input Alamat" 
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
                                    <tr  class="td-jenis_kelamin">
                                        <th class="title"> Jenis Kelamin: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kelamin']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="jenis_kelamin" 
                                                data-title="Input Jenis Kelamin" 
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
                                    <tr  class="td-no_antri_poli">
                                        <th class="title"> No Antri Poli: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['no_antri_poli'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['no_antri_poli'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-tanggal_lahir">
                                        <th class="title"> Tanggal Lahir: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_lahir']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="tanggal_lahir" 
                                                data-title="Input Tanggal Lahir" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['tanggal_lahir']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-umur">
                                        <th class="title"> Umur: </th>
                                        <td class="value"> <?php echo $data['umur']; ?></td>
                                    </tr>
                                    <tr  class="td-setatus">
                                        <th class="title"> Setatus: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("resep_obat/view/" . urlencode($data['setatus'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['setatus'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-keluhan">
                                        <th class="title"> Keluhan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keluhan']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
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
                                    <tr  class="td-pembayaran">
                                        <th class="title"> Pembayaran: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pendaftaran_poli_pembayaran_option_list'); ?>' 
                                                data-value="<?php echo $data['pembayaran']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="pembayaran" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['pembayaran']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-email">
                                        <th class="title"> Email: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['email']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="email" 
                                                data-title="Enter Email" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="email" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['email']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-user_entry">
                                        <th class="title"> User Entry: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['user_entry'])) ?>">
                                                <i class="fa fa-eye"></i> <?php echo $data['user_entry'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-penanggung_jawab">
                                        <th class="title"> Penanggung Jawab: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['penanggung_jawab']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="penanggung_jawab" 
                                                data-title="Enter Penanggung Jawab" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['penanggung_jawab']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-identitas_penanggung_jawab">
                                        <th class="title"> Identitas Penanggung Jawab: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-max="9999999999999999" 
                                                data-min="1000000000000000" 
                                                data-value="<?php echo $data['identitas_penanggung_jawab']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                                                data-name="identitas_penanggung_jawab" 
                                                data-title="Enter Identitas Penanggung Jawab" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['identitas_penanggung_jawab']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tinggi">
                                        <th class="title"> Tinggi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tinggi']; ?>" 
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
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
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
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
                                                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                                                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
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
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-info"  href="<?php print_link("pendaftaran_poli/edit/$rec_id"); ?>">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("pendaftaran_poli/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
