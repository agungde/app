<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("list_hasil_lab/add");
$can_edit = ACL::is_allowed("list_hasil_lab/edit");
$can_view = ACL::is_allowed("list_hasil_lab/view");
$can_delete = ACL::is_allowed("list_hasil_lab/delete");
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
$rec_id = (!empty($data['id_list']) ? urlencode($data['id_list']) : null);
$counter++;
?>
<tr>
    <td class="td-nama_pemeriksaan">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pemeriksaan']; ?>" 
            data-pk="<?php echo $data['id_list'] ?>" 
            data-url="<?php print_link("list_hasil_lab/editfield/" . urlencode($data['id_list'])); ?>" 
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
    <td class="td-hasil">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil']; ?>" 
            data-pk="<?php echo $data['id_list'] ?>" 
            data-url="<?php print_link("list_hasil_lab/editfield/" . urlencode($data['id_list'])); ?>" 
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
            data-pk="<?php echo $data['id_list'] ?>" 
            data-url="<?php print_link("list_hasil_lab/editfield/" . urlencode($data['id_list'])); ?>" 
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
