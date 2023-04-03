<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("data_clinik/add");
$can_edit = ACL::is_allowed("data_clinik/edit");
$can_view = ACL::is_allowed("data_clinik/view");
$can_delete = ACL::is_allowed("data_clinik/delete");
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
$rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("data_clinik/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("data_clinik/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("data_clinik/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id"><a href="<?php print_link("data_clinik/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
        <td class="td-nama_clinik">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_clinik']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("data_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="nama_clinik" 
                data-title="Enter Nama Clinik" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_clinik']; ?> 
            </span>
        </td>
        <td class="td-alamat_clinik">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat_clinik']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("data_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="alamat_clinik" 
                data-title="Enter Alamat Clinik" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['alamat_clinik']; ?> 
            </span>
        </td>
        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
        <td class="td-phone"><a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a></td>
        <td class="td-operator">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['operator']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("data_clinik/editfield/" . urlencode($data['id'])); ?>" 
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
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("data_clinik/editfield/" . urlencode($data['id'])); ?>" 
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
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("data_clinik/editfield/" . urlencode($data['id'])); ?>" 
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
    