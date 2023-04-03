<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pendaftaran_poli/add");
$can_edit = ACL::is_allowed("pendaftaran_poli/edit");
$can_view = ACL::is_allowed("pendaftaran_poli/view");
$can_delete = ACL::is_allowed("pendaftaran_poli/delete");
?>
<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['id_pendaftaran_poli']) ? urlencode($data['id_pendaftaran_poli']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pendaftaran_poli'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("pendaftaran_poli/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("pendaftaran_poli/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pendaftaran_poli/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id_pendaftaran_poli"><a href="<?php print_link("pendaftaran_poli/view/$data[id_pendaftaran_poli]") ?>"><?php echo $data['id_pendaftaran_poli']; ?></a></td>
        <td class="td-nama_poli">
            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pendaftaran_poli_nama_poli_option_list'); ?>' 
                data-value="<?php echo $data['nama_poli']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="nama_poli" 
                data-title="Select a value ..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_poli']; ?> 
            </span>
        </td>
        <td class="td-dokter">
            <span <?php if($can_edit){ ?> data-source='<?php 
                $dependent_field = (!empty($data['nama_poli']) ? urlencode($data['nama_poli']) : null);
                print_link('api/json/pendaftaran_poli_dokter_option_list/'.$dependent_field); 
                ?>' 
                data-value="<?php echo $data['dokter']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="dokter" 
                data-title="Select a value ..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="select" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['dokter']; ?> 
            </span>
        </td>
        <td class="td-nama_pasien">
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
        <td class="td-no_rekam_medis">
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
        <td class="td-no_hp">
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
        <td class="td-alamat">
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
        <td class="td-jenis_kelamin">
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
        <td class="td-setatus"> <?php echo $data['setatus']; ?></td>
        <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
        <td class="td-no_antri_poli"> <?php echo $data['no_antri_poli']; ?></td>
        <td class="td-tanggal">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="tanggal" 
                data-title="Enter Tanggal" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tanggal']; ?> 
            </span>
        </td>
        <td class="td-tanggal_lahir">
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
        <td class="td-action"> <?php echo $data['action']; ?></td>
        <td class="td-umur"> <?php echo $data['umur']; ?></td>
        <td class="td-keluhan">
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
        <td class="td-pembayaran">
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
        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
        <td class="td-id_appointment"> <?php echo $data['id_appointment']; ?></td>
        <td class="td-user_entry">
            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/pendaftaran_poli_user_entry_option_list'); ?>' 
                data-value="<?php echo $data['user_entry']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="user_entry" 
                data-title="Enter User Entry" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['user_entry']; ?> 
            </span>
        </td>
        <td class="td-date_update"> <?php echo $data['date_update']; ?></td>
        <td class="td-date_updated"> <?php echo $data['date_updated']; ?></td>
        <td class="td-penanggung_jawab">
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
        <td class="td-identitas_penanggung_jawab">
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
        <td class="td-tinggi">
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
        <td class="td-berat_badan">
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
        <td class="td-tensi">
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
        <td class="td-tanggal_appointment">
            <span <?php if($can_edit){ ?> data-flatpickr="{altFormat: 'd-m-Y H:i:s', minDate: '', maxDate: ''}" 
                data-source='<?php print_link('api/json/pendaftaran_poli_tanggal_appointment_option_list'); ?>' 
                data-value="<?php echo $data['tanggal_appointment']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="tanggal_appointment" 
                data-title="Enter Tanggal Appointment" 
                data-placement="left" 
                data-toggle="click" 
                data-type="flatdatetimepicker" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tanggal_appointment']; ?> 
            </span>
        </td>
        <td class="td-no_ktp">
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
        <td class="td-hasil_laboratorium_radiologi">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil_laboratorium_radiologi']; ?>" 
                data-pk="<?php echo $data['id_pendaftaran_poli'] ?>" 
                data-url="<?php print_link("pendaftaran_poli/editfield/" . urlencode($data['id_pendaftaran_poli'])); ?>" 
                data-name="hasil_laboratorium_radiologi" 
                data-title="Browse..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['hasil_laboratorium_radiologi']; ?> 
            </span>
        </td>
    </tr>
    <?php 
    }
    ?>
    <?php
    } else {
    ?>
    <td class="no-record-found col-12" colspan="100">
        <h4 class="text-muted text-center ">
            No Record Found
        </h4>
    </td>
    <?php
    }
    ?>
    