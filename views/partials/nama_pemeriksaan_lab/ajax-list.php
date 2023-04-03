<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("nama_pemeriksaan_lab/add");
$can_edit = ACL::is_allowed("nama_pemeriksaan_lab/edit");
$can_view = ACL::is_allowed("nama_pemeriksaan_lab/view");
$can_delete = ACL::is_allowed("nama_pemeriksaan_lab/delete");
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
$rec_id = (!empty($data['id_jenis']) ? urlencode($data['id_jenis']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_jenis'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("nama_pemeriksaan_lab/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("nama_pemeriksaan_lab/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("nama_pemeriksaan_lab/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id_jenis"><a href="<?php print_link("nama_pemeriksaan_lab/view/$data[id_jenis]") ?>"><?php echo $data['id_jenis']; ?></a></td>
        <td class="td-tanggal">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal']; ?>" 
                data-pk="<?php echo $data['id_jenis'] ?>" 
                data-url="<?php print_link("nama_pemeriksaan_lab/editfield/" . urlencode($data['id_jenis'])); ?>" 
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
        <td class="td-nama_pemeriksaan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pemeriksaan']; ?>" 
                data-pk="<?php echo $data['id_jenis'] ?>" 
                data-url="<?php print_link("nama_pemeriksaan_lab/editfield/" . urlencode($data['id_jenis'])); ?>" 
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
        <td class="td-nilai_rujukan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nilai_rujukan']; ?>" 
                data-pk="<?php echo $data['id_jenis'] ?>" 
                data-url="<?php print_link("nama_pemeriksaan_lab/editfield/" . urlencode($data['id_jenis'])); ?>" 
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
        <td class="td-user_entry">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                data-pk="<?php echo $data['id_jenis'] ?>" 
                data-url="<?php print_link("nama_pemeriksaan_lab/editfield/" . urlencode($data['id_jenis'])); ?>" 
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
    