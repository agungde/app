<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("data_pasien_radio/add");
$can_edit = ACL::is_allowed("data_pasien_radio/edit");
$can_view = ACL::is_allowed("data_pasien_radio/view");
$can_delete = ACL::is_allowed("data_pasien_radio/delete");
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
$rec_id = (!empty($data['id_pasien_radio']) ? urlencode($data['id_pasien_radio']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pasien_radio'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("data_pasien_radio/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("data_pasien_radio/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("data_pasien_radio/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-no_rekam_medis">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
        <td class="td-no_ktp">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_ktp']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
                data-name="no_ktp" 
                data-title="Enter No Ktp" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['no_ktp']; ?> 
            </span>
        </td>
        <td class="td-nama_pasien">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
        <td class="td-tanggal_lahir">
            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                data-value="<?php echo $data['tanggal_lahir']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
                data-name="tanggal_lahir" 
                data-title="Enter Tanggal Lahir" 
                data-placement="left" 
                data-toggle="click" 
                data-type="flatdatetimepicker" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['tanggal_lahir']; ?> 
            </span>
        </td>
        <td class="td-no_hp">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
                data-name="no_hp" 
                data-title="Enter No Hp" 
                data-placement="left" 
                data-toggle="click" 
                data-type="number" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['no_hp']; ?> 
            </span>
        </td>
        <td class="td-alamat">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
        <td class="td-jenis_kelamin">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kelamin']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
        <td class="td-umur">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
        <td class="td-photo">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['photo']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
                data-name="photo" 
                data-title="Browse..." 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['photo']; ?> 
            </span>
        </td>
        <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
        <td class="td-user_entry">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                data-pk="<?php echo $data['id_pasien_radio'] ?>" 
                data-url="<?php print_link("data_pasien_radio/editfield/" . urlencode($data['id_pasien_radio'])); ?>" 
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
    