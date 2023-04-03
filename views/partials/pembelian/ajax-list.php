<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pembelian/add");
$can_edit = ACL::is_allowed("pembelian/edit");
$can_view = ACL::is_allowed("pembelian/view");
$can_delete = ACL::is_allowed("pembelian/delete");
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
$rec_id = (!empty($data['id_pembelian']) ? urlencode($data['id_pembelian']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pembelian'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <th class="td-sno"><?php echo $counter; ?></th>
        <td class="td-id_pembelian"><a href="<?php print_link("pembelian/view/$data[id_pembelian]") ?>"><?php echo $data['id_pembelian']; ?></a></td>
        <td class="td-id_suplier"> <?php echo $data['id_suplier']; ?></td>
        <td class="td-nama_suplier"> <?php echo $data['nama_suplier']; ?></td>
        <td class="td-tgl_pembelian"> <?php echo $data['tgl_pembelian']; ?></td>
        <td class="td-kode_barang"> <?php echo $data['kode_barang']; ?></td>
        <td class="td-nama_barang"> <?php echo $data['nama_barang']; ?></td>
        <td class="td-jumlah"> <?php echo $data['jumlah']; ?></td>
        <td class="td-harga_beli"> <?php echo $data['harga_beli']; ?></td>
        <td class="td-harga_jual"> <?php echo $data['harga_jual']; ?></td>
        <td class="td-discount"> <?php echo $data['discount']; ?></td>
        <td class="td-ppn"> <?php echo $data['ppn']; ?></td>
        <td class="td-total_harga"> <?php echo $data['total_harga']; ?></td>
        <td class="td-operator"> <?php echo $data['operator']; ?></td>
        <td class="td-date_created"> <?php echo $data['date_created']; ?></td>
        <td class="td-date_updated"> <?php echo $data['date_updated']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("pembelian/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("pembelian/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pembelian/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
    