<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("hail_laboratorium/add");
$can_edit = ACL::is_allowed("hail_laboratorium/edit");
$can_view = ACL::is_allowed("hail_laboratorium/view");
$can_delete = ACL::is_allowed("hail_laboratorium/delete");
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
$rec_id = (!empty($data['id_hasillab']) ? urlencode($data['id_hasillab']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_hasillab'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("hail_laboratorium/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("hail_laboratorium/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("hail_laboratorium/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id_hasillab"><a href="<?php print_link("hail_laboratorium/view/$data[id_hasillab]") ?>"><?php echo $data['id_hasillab']; ?></a></td>
        <td class="td-nama_tindakan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_tindakan']; ?>" 
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                data-name="nama_tindakan" 
                data-title="Enter Nama Tindakan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_tindakan']; ?> 
            </span>
        </td>
        <td class="td-hasil">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil']; ?>" 
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                data-name="hasil" 
                data-title="Enter Hasil" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['hasil']; ?> 
            </span>
        </td>
        <td class="td-nilai_rujukan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nilai_rujukan']; ?>" 
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
                data-name="nilai_rujukan" 
                data-title="Enter Nilai Rujukan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nilai_rujukan']; ?> 
            </span>
        </td>
        <td class="td-dokter_pengirim">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pengirim']; ?>" 
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
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
        <td class="td-nama_pasien">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
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
                data-pk="<?php echo $data['id_hasillab'] ?>" 
                data-url="<?php print_link("hail_laboratorium/editfield/" . urlencode($data['id_hasillab'])); ?>" 
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
    