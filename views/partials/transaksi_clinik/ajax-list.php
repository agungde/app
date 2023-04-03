<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("transaksi_clinik/add");
$can_edit = ACL::is_allowed("transaksi_clinik/edit");
$can_view = ACL::is_allowed("transaksi_clinik/view");
$can_delete = ACL::is_allowed("transaksi_clinik/delete");
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
        <td class="td-date_created"> <span><?php echo $data['date_created']; ?></span></td>
        <td class="td-nama_pasien">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
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
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
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
        <td class="td-keterangan_resep">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keterangan_resep']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="keterangan_resep" 
                data-title="Enter Keterangan Resep" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['keterangan_resep']; ?> 
            </span>
        </td>
        <td class="td-resep_obat"><span>Rp. <?php echo number_format($data['resep_obat'],0,",",".");?></span></td>
        <td class="td-keterangan_tindakan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['keterangan_tindakan']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="keterangan_tindakan" 
                data-title="Enter Keterangan Tindakan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['keterangan_tindakan']; ?> 
            </span>
        </td>
        <td class="td-biaya_tindakan"> <span>Rp.<?php echo number_format($data['biaya_tindakan'],0,",",".");?></span></td>
        <td class="td-jasa_dokter"> <span>Rp.<?php echo number_format($data['jasa_dokter'],0,",",".");?></span></td>
        <td class="td-total_biaya"> <span>Rp.<?php echo number_format($data['total_biaya'],0,",",".");?></span>
        </td>
        <td class="td-metode_pembayaran">
            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/transaksi_clinik_metode_pembayaran_option_list'); ?>' 
                data-value="<?php echo $data['metode_pembayaran']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="metode_pembayaran" 
                data-title="Enter Metode Pembayaran" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['metode_pembayaran']; ?> 
            </span>
        </td>
        <td class="td-dokter_pemeriksa">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['dokter_pemeriksa']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("transaksi_clinik/editfield/" . urlencode($data['id'])); ?>" 
                data-name="dokter_pemeriksa" 
                data-title="Enter Dokter Pemeriksa" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['dokter_pemeriksa']; ?> 
            </span>
        </td>
        <td class="td-setatus_tagihan"> <span><?php 
            $encryption=$rec_id;
            if($data['setatus_tagihan'] =="Proses"){
            ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Proses Tagihan" href="<?php  print_link("transaksi_clinik/edit/$encryption");?>">
            <i class="fa fa-open "></i>proses</a>
            <?php
            }else{
            ?>
            <i class="fa fa-close "></i>selesai
            <?php
            }
        ?></span>
    </td>
    <th class="td-btn">
        <?php if($can_view){ ?>
        <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("transaksi_clinik/view/$rec_id"); ?>">
            <i class="fa fa-eye"></i> View
        </a>
        <?php } ?>
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("transaksi_clinik/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> Edit
        </a>
        <?php } ?>
        <?php if($can_delete){ ?>
        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("transaksi_clinik/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
