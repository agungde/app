<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("resep_obat/add");
$can_edit = ACL::is_allowed("resep_obat/edit");
$can_view = ACL::is_allowed("resep_obat/view");
$can_delete = ACL::is_allowed("resep_obat/delete");
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
$rec_id = (!empty($data['id_resep_obat']) ? urlencode($data['id_resep_obat']) : null);
$counter++;
?>
<tr>
    <td class="td-date_created"> <span><?php echo $data['date_created']; ?></span></td>
    <td class="td-tanggal">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['tanggal']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <td class="td-no_rekam_medis">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['no_rekam_medis']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <td class="td-nama_pasien">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pasien']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <td class="td-tanggal_lahir"> <span><?php echo $data['tanggal_lahir']; ?></span></td>
    <td class="td-umur">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['umur']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <td class="td-alamat">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <td class="td-setatus"> <span><?php echo $data['setatus']; ?></span></td>
    <td class="td-pembayaran"> <span><?php echo $data['pembayaran']; ?></span></td>
    <td class="td-action"><span>
        <?php
        $key="dermawangroup";
        $plaintext = "$rec_id";
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        if($data['pembayaran']=="Lunas"){
        if($data['action']=="Closed"){
        //echo $data['action'];
        ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&print=$ciphertext&copy=$ciphertext&proses=print");?>"
        <i class="fa fa-print "></i>PrintResep</a>  
        <?php
        }else{
        ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext");?>"
        <i class="fa fa-send"></i>Proses Resep</a>  
        <?php } }else{
        if($user_role_id=="3"){
        ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&view=$ciphertext");?>"
        <i class="fa fa-send"></i>Lihat Resep</a> <?php
        }
        }
        if($data['pembayaran']=="Luar"){
        if($user_role_id=="3"){
        }else{
        ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal"  href="<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&print=$ciphertext&resep=Luar&proses=print");?>"
        <i class="fa fa-print "></i>Print Resep</a>  
        <?php } } 
        ?> 
    </span></td>
    <td class="td-nama_poli">
        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
            <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
        </a>
    </td>
    <td class="td-nama_dokter">
        <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_dokter']; ?>" 
            data-pk="<?php echo $data['id_resep_obat'] ?>" 
            data-url="<?php print_link("resep_obat/editfield/" . urlencode($data['id_resep_obat'])); ?>" 
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
    <th class="td-btn">
        <?php if($can_edit){ ?>
        <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("resep_obat/edit/$rec_id"); ?>">
            <i class="fa fa-edit"></i> proces
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
