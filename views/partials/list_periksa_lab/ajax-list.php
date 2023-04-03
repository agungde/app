<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("list_periksa_lab/add");
$can_edit = ACL::is_allowed("list_periksa_lab/edit");
$can_view = ACL::is_allowed("list_periksa_lab/view");
$can_delete = ACL::is_allowed("list_periksa_lab/delete");
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
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("list_periksa_lab/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("list_periksa_lab/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("list_periksa_lab/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id"><a href="<?php print_link("list_periksa_lab/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
        <td class="td-jenis_pemeriksaan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_pemeriksaan']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("list_periksa_lab/editfield/" . urlencode($data['id'])); ?>" 
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
        <td class="td-hasil">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("list_periksa_lab/editfield/" . urlencode($data['id'])); ?>" 
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
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("list_periksa_lab/editfield/" . urlencode($data['id'])); ?>" 
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
        <td class="td-nama_pemeriksaan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pemeriksaan']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("list_periksa_lab/editfield/" . urlencode($data['id'])); ?>" 
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
    