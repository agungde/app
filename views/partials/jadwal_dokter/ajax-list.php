<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("jadwal_dokter/add");
$can_edit = ACL::is_allowed("jadwal_dokter/edit");
$can_view = ACL::is_allowed("jadwal_dokter/view");
$can_delete = ACL::is_allowed("jadwal_dokter/delete");
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
$rec_id = (!empty($data['id_jadwal_dokter']) ? urlencode($data['id_jadwal_dokter']) : null);
$counter++;
?>
<tr>
    <td class="td-nama_dokter">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_dokter']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="nama_dokter" 
            data-title="Enter Nama Dokter" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['nama_dokter']; ?> 
        </span>
    </td>
    <td class="td-specialist">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['specialist']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="specialist" 
            data-title="Enter Specialist" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['specialist']; ?> 
        </span>
    </td>
    <td class="td-hari_praktek">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['hari_praktek']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="hari_praktek" 
            data-title="Enter Hari Praktek" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['hari_praktek']; ?> 
        </span>
    </td>
    <td class="td-jam_praktek">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['jam_praktek']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="jam_praktek" 
            data-title="Enter Jam Praktek" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['jam_praktek']; ?> 
        </span>
    </td>
    <td class="td-operator">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['operator']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="operator" 
            data-title="Enter Operator" 
            data-placement="left" 
            data-toggle="click" 
            data-type="number" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['operator']; ?> 
        </span>
    </td>
    <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
    <td class="td-date_update">
        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['date_update']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="date_update" 
            data-title="Enter Date Update" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['date_update']; ?> 
        </span>
    </td>
    <td class="td-date_updated">
        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['date_updated']; ?>" 
            data-pk="<?php echo $data['id_jadwal_dokter'] ?>" 
            data-url="<?php print_link("jadwal_dokter/editfield/" . urlencode($data['id_jadwal_dokter'])); ?>" 
            data-name="date_updated" 
            data-title="Enter Date Updated" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['date_updated']; ?> 
        </span>
    </td>
    <th class="td-btn">
        <?php if($can_view){ ?>
        <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("jadwal_dokter/view/$rec_id"); ?>">
            <i class="fa fa-eye"></i> View
        </a>
        <?php } ?>
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("jadwal_dokter/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <?php } ?>
        <?php if($can_delete){ ?>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("jadwal_dokter/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
            <i class="fa fa-times"></i>
            Delete
        </a>
        <?php } ?>
    </th>
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
