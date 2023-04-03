<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("penjualan_apotek/add");
$can_edit = ACL::is_allowed("penjualan_apotek/edit");
$can_view = ACL::is_allowed("penjualan_apotek/view");
$can_delete = ACL::is_allowed("penjualan_apotek/delete");
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
$rec_id = (!empty($data['id_jual_apt']) ? urlencode($data['id_jual_apt']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_jual_apt'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("penjualan_apotek/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("penjualan_apotek/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("penjualan_apotek/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
            <?php } ?>
        </th>
        <td class="td-id_jual_apt"><a href="<?php print_link("penjualan_apotek/view/$data[id_jual_apt]") ?>"><?php echo $data['id_jual_apt']; ?></a></td>
        <td class="td-nama_pelanggan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_pelanggan']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                data-name="nama_pelanggan" 
                data-title="Enter Nama Pelanggan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['nama_pelanggan']; ?> 
            </span>
        </td>
        <td class="td-alamat">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['alamat']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
        <td class="td-phone"><a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a></td>
        <td class="td-nama_obat">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nama_obat']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
        <td class="td-jumlah">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['jumlah']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
        <td class="td-aturan_minum">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['aturan_minum']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
        <td class="td-harga">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['harga']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                data-name="harga" 
                data-title="Enter Harga" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['harga']; ?> 
            </span>
        </td>
        <td class="td-total_harga">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_harga']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                data-name="total_harga" 
                data-title="Enter Total Harga" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['total_harga']; ?> 
            </span>
        </td>
        <td class="td-user_entry">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_entry']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
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
        <td class="td-satuan">
            <span <?php if($can_edit){ ?> data-value="<?php echo $data['satuan']; ?>" 
                data-pk="<?php echo $data['id_jual_apt'] ?>" 
                data-url="<?php print_link("penjualan_apotek/editfield/" . urlencode($data['id_jual_apt'])); ?>" 
                data-name="satuan" 
                data-title="Enter Satuan" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" <?php } ?>>
                <?php echo $data['satuan']; ?> 
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
    