<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("appointment/add");
$can_edit = ACL::is_allowed("appointment/edit");
$can_view = ACL::is_allowed("appointment/view");
$can_delete = ACL::is_allowed("appointment/delete");
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
$rec_id = (!empty($data['id_appointment']) ? urlencode($data['id_appointment']) : null);
$counter++;
?>
<tr>
    <td class="td-tanggal_appoitment">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_appoitment']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
            data-name="tanggal_appoitment" 
            data-title="Enter Tanggal Appoitment" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['tanggal_appoitment']; ?> 
        </span>
    </td>
    <td class="td-nama_pasien">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-no_antri_poli"> <?php echo $data['no_antri_poli']; ?></td>
    <td class="td-alamat">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-nama_poli">
        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
            <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
        </a>
    </td>
    <td class="td-dokter">
        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_dokter/view/" . urlencode($data['dokter'])) ?>">
            <i class="fa fa-eye"></i> <?php echo $data['data_dokter_nama_dokter'] ?>
        </a>
    </td>
    <td class="td-no_hp">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_hp']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-jenis_kelamin">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['jenis_kelamin']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-tanggal_lahir">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_lahir']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-setatus"> <?php echo $data['setatus']; ?></td>
    <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
    <td class="td-keluhan">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['keluhan']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
        <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $pembayaran); ?>' 
            data-value="<?php echo $data['pembayaran']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-date_update">
        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['date_update']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-tinggi">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tinggi']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <td class="td-umur">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
            data-pk="<?php echo $data['id_appointment'] ?>" 
            data-url="<?php print_link("appointment/editfield/" . urlencode($data['id_appointment'])); ?>" 
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
    <th class="td-btn">
        <?php if($can_view){ ?>
        <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("appointment/view/$rec_id"); ?>">
            <i class="fa fa-eye"></i> View
        </a>
        <?php } ?>
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("appointment/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <?php } ?>
        <?php if($can_delete){ ?>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("appointment/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
