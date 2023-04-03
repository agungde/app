<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("form_laboratorium/add");
$can_edit = ACL::is_allowed("form_laboratorium/edit");
$can_view = ACL::is_allowed("form_laboratorium/view");
$can_delete = ACL::is_allowed("form_laboratorium/delete");
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
$rec_id = (!empty($data['id_form_lab']) ? urlencode($data['id_form_lab']) : null);
$counter++;
?>
<tr>
    <td class="td-tanggal">
        <span <?php if($can_edit){ ?> data-flatpickr="{altFormat: 'D\d-m-Y', enableTime: false, minDate: '', maxDate: ''}" 
            data-value="<?php echo $data['tanggal']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="tanggal" 
            data-title="Enter Tanggal" 
            data-placement="left" 
            data-toggle="click" 
            data-type="flatdatetimepicker" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['tanggal']; ?> 
        </span>
    </td>
    <td class="td-nama_pasien">
        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_nama_pasien_option_list'); ?>' 
            data-value="<?php echo $data['nama_pasien']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="nama_pasien" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['nama_pasien']; ?> 
        </span>
    </td>
    <td class="td-no_rekam_medis">
        <span <?php if($can_edit){ ?> data-source='<?php 
            $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
            print_link('api/json/form_laboratorium_no_rekam_medis_option_list/'.$dependent_field); 
            ?>' 
            data-value="<?php echo $data['no_rekam_medis']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="no_rekam_medis" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="selectize" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable selectize" <?php } ?>>
            <?php echo $data['no_rekam_medis']; ?> 
        </span>
    </td>
    <td class="td-alamat">
        <span <?php if($can_edit){ ?> data-source='<?php 
            $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
            print_link('api/json/form_laboratorium_alamat_option_list/'.$dependent_field); 
            ?>' 
            data-value="<?php echo $data['alamat']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="alamat" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['alamat']; ?> 
        </span>
    </td>
    <td class="td-no_hp">
        <span <?php if($can_edit){ ?> data-source='<?php 
            $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
            print_link('api/json/form_laboratorium_no_hp_option_list/'.$dependent_field); 
            ?>' 
            data-value="<?php echo $data['no_hp']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="no_hp" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['no_hp']; ?> 
        </span>
    </td>
    <td class="td-keluhan">
        <span <?php if($can_edit){ ?> data-source='<?php 
            $dependent_field = (!empty($data['nama_pasien']) ? urlencode($data['nama_pasien']) : null);
            print_link('api/json/form_laboratorium_keluhan_option_list/'.$dependent_field); 
            ?>' 
            data-value="<?php echo $data['keluhan']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="keluhan" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['keluhan']; ?> 
        </span>
    </td>
    <td class="td-jenis_pemeriksaan">
        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("form_laboratorium/view/" . urlencode($data['jenis_pemeriksaan'])) ?>">
            <i class="fa fa-eye"></i> <?php echo $data['jenis_pemeriksaan'] ?>
        </a>
    </td>
    <td class="td-dokter_pemeriksa">
        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_dokter_pemeriksa_option_list'); ?>' 
            data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="dokter_pemeriksa" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="selectize" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable selectize" <?php } ?>>
            <?php echo $data['dokter_pemeriksa']; ?> 
        </span>
    </td>
    <td class="td-nama_poli">
        <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/form_laboratorium_nama_poli_option_list'); ?>' 
            data-value="<?php echo $data['nama_poli']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="nama_poli" 
            data-title="Select a value ..." 
            data-placement="left" 
            data-toggle="click" 
            data-type="select" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['nama_poli']; ?> 
        </span>
    </td>
    <td class="td-hasil_pemeriksaan">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['hasil_pemeriksaan']; ?>" 
            data-pk="<?php echo $data['id_form_lab'] ?>" 
            data-url="<?php print_link("form_laboratorium/editfield/" . urlencode($data['id_fprm_lab'])); ?>" 
            data-name="hasil_pemeriksaan" 
            data-title="Enter Hasil Pemeriksaan" 
            data-placement="left" 
            data-toggle="click" 
            data-type="text" 
            data-mode="popover" 
            data-showbuttons="left" 
            class="is-editable" <?php } ?>>
            <?php echo $data['hasil_pemeriksaan']; ?> 
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
