<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("form_radiologi/add");
$can_edit = ACL::is_allowed("form_radiologi/edit");
$can_view = ACL::is_allowed("form_radiologi/view");
$can_delete = ACL::is_allowed("form_radiologi/delete");
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
$rec_id = (!empty($data['id_form_radio']) ? urlencode($data['id_form_radio']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_form_radio'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("form_radiologi/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("form_radiologi/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("form_radiologi/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-tanggal">
            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                data-value="<?php echo $data['tanggal']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
                data-name="tanggal" 
                data-title="Enter Tanggal" 
                data-placement="left" 
                data-toggle="click" 
                data-type="flatdatetimepicker" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tanggal']; ?> 
            </span>
        </td>
        <td class="td-nama_pasien">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-no_rekam_medis">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-alamat">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-no_hp">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
                data-name="no_hp" 
                data-title="Enter No Hp" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['no_hp']; ?> 
            </span>
        </td>
        <td class="td-keluhan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keluhan']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-jenis_pemeriksaan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_pemeriksaan']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-nama_pemeriksaan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pemeriksaan']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
                data-name="nama_pemeriksaan" 
                data-title="Enter Nama Pemeriksaan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_pemeriksaan']; ?> 
            </span>
        </td>
        <td class="td-dokter_pemeriksa">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
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
        <td class="td-nama_poli">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_poli']; ?>" 
                data-pk="<?php echo $data['id_form_radio'] ?>" 
                data-url="<?php print_link("form_radiologi/editfield/" . urlencode($data['id_form_radio'])); ?>" 
                data-name="nama_poli" 
                data-title="Enter Nama Poli" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_poli']; ?> 
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
    