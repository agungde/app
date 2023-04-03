<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("hasil_radiologi/add");
$can_edit = ACL::is_allowed("hasil_radiologi/edit");
$can_view = ACL::is_allowed("hasil_radiologi/view");
$can_delete = ACL::is_allowed("hasil_radiologi/delete");
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
$rec_id = (!empty($data['id_rad']) ? urlencode($data['id_rad']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_rad'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("hasil_radiologi/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View Hasil Lab
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("hasil_radiologi/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("hasil_radiologi/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-nama_pasien">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
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
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
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
        <td class="td-umur">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
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
        <td class="td-dokter_pengirim">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pengirim']; ?>" 
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
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
        <td class="td-tindakan_radiologi">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tindakan_radiologi']; ?>" 
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
                data-name="tindakan_radiologi" 
                data-title="Enter Tindakan Radiologi" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tindakan_radiologi']; ?> 
            </span>
        </td>
        <td class="td-dokter_radiologi">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_radiologi']; ?>" 
                data-pk="<?php echo $data['id_rad'] ?>" 
                data-url="<?php print_link("hasil_radiologi/editfield/" . urlencode($data['id_rad'])); ?>" 
                data-name="dokter_radiologi" 
                data-title="Enter Dokter Radiologi" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['dokter_radiologi']; ?> 
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
    