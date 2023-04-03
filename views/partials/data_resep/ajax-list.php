<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("data_resep/add");
$can_edit = ACL::is_allowed("data_resep/edit");
$can_view = ACL::is_allowed("data_resep/view");
$can_delete = ACL::is_allowed("data_resep/delete");
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
$rec_id = (!empty($data['id_data_resep']) ? urlencode($data['id_data_resep']) : null);
$counter++;
?>
<tr>
    <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
    <td class="td-no_rekam_medis">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
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
    <td class="td-nama_poli">
        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
            <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
        </a>
    </td>
    <td class="td-nama_dokter">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_dokter']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
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
    <td class="td-nama_pasien">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
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
    <td class="td-alamat">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
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
    <td class="td-tanggal_lahir">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal_lahir']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
            data-name="tanggal_lahir" 
            data-title="Enter Tanggal Lahir" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['tanggal_lahir']; ?> 
        </span>
    </td>
    <td class="td-umur">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
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
    <td class="td-nama_obat">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_obat']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
            data-name="nama_obat" 
            data-title="Enter Nama Obat" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['nama_obat']; ?> 
        </span>
    </td>
    <td class="td-aturan_minum">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['aturan_minum']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
            data-name="aturan_minum" 
            data-title="Enter Aturan Minum" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['aturan_minum']; ?> 
        </span>
    </td>
    <td class="td-jumlah">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['jumlah']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
            data-name="jumlah" 
            data-title="Enter Jumlah" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['jumlah']; ?> 
        </span>
    </td>
    <td class="td-setatus">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['setatus']; ?>" 
            data-pk="<?php echo $data['id_data_resep'] ?>" 
            data-url="<?php print_link("data_resep/editfield/" . urlencode($data['id_data_resep'])); ?>" 
            data-name="setatus" 
            data-title="Enter Setatus" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['setatus']; ?> 
        </span>
    </td>
    <td class="td-action"> <?php echo $data['action']; ?></td>
    <th class="td-btn">
        <?php if($can_view){ ?>
        <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("data_resep/view/$rec_id"); ?>">
            <i class="fa fa-eye"></i> View
        </a>
        <?php } ?>
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("data_resep/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <?php } ?>
        <?php if($can_delete){ ?>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("data_resep/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
