<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("data_pasien/add");
$can_edit = ACL::is_allowed("data_pasien/edit");
$can_view = ACL::is_allowed("data_pasien/view");
$can_delete = ACL::is_allowed("data_pasien/delete");
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
$rec_id = (!empty($data['id_pasien']) ? urlencode($data['id_pasien']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pasien'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <td class="td-date_created"> <span><?php echo $data['date_created']; ?></span></td>
        <td class="td-no_rekam_medis"> <?php echo $data['no_rekam_medis']; ?></td>
        <td class="td-nama_pasien"> <?php echo $data['nama_pasien']; ?></td>
        <td class="td-no_ktp"> <?php echo $data['no_ktp']; ?></td>
        <td class="td-jenis_kelamin"> <?php echo $data['jenis_kelamin']; ?></td>
        <td class="td-tanggal_lahir"> <?php echo $data['tanggal_lahir']; ?></td>
        <td class="td-umur"> <?php echo $data['umur']; ?></td>
        <td class="td-alamat"> <?php echo $data['alamat']; ?></td>
        <td class="td-action"> <span>
            <?php
            $simple_string = "$rec_id)";
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            // Non-NULL Initialization Vector for encryption
            $encryption_iv = '1234567891011121';
            // Store the encryption key
            $encryption_key = "dermawangroup";
            // Use openssl_encrypt() function to encrypt the data
            $encryption = openssl_encrypt($simple_string, $ciphering,
            $encryption_key, $options, $encryption_iv);
            // Display the encrypted string
            //echo "Encrypted String: " . $encryption . "\n";
            if(!empty($_GET['appointment'])){
            ?>
            <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("appointment/add?csrf_token=$csrf_token&precord=$encryption");?>"
            <i class="fa fa-send"></i>Add appointment</a>
            <?php
            }else if(!empty($_GET['poli'])){
            ?>
            <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("pendaftaran_poli/add?csrf_token=$csrf_token&precord=$encryption");?>"
            <i class="fa fa-send"></i>Daftar Ke Poli</a>
            <?php  }else{?>
            <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("pendaftaran_poli/add?csrf_token=$csrf_token&precord=$encryption");?>"
            <i class="fa fa-send"></i>Daftar Ke Poli</a>
            <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("appointment/add?csrf_token=$csrf_token&precord=$encryption");?>"
            <i class="fa fa-send"></i>Add appointment</a>
            <?php
            }
            ?>
        </span></td>
        <td class="td-no_hp"> <?php echo $data['no_hp']; ?></td>
        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
        <td class="td-photo"><?php Html :: page_img($data['photo'],50,50,1); ?></td>
        <td class="td-user_entry"> <?php echo $data['user_entry']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("data_pasien/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("data_pasien/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("data_pasien/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
    