<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("pendaftaran_poli/add");
$can_edit = ACL::is_allowed("pendaftaran_poli/edit");
$can_view = ACL::is_allowed("pendaftaran_poli/view");
$can_delete = ACL::is_allowed("pendaftaran_poli/delete");
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
$rec_id = (!empty($data['id_pendaftaran_poli']) ? urlencode($data['id_pendaftaran_poli']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_pendaftaran_poli'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <td class="td-date_created">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['date_created'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['date_created'] ?>
            </a>
        </td>
        <td class="td-tanggal_appointment">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['tanggal_appointment'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['tanggal_appointment'] ?>
            </a>
        </td>
        <td class="td-no_antri_poli">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['no_antri_poli'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['no_antri_poli'] ?>
            </a>
        </td>
        <td class="td-no_rekam_medis"> <?php echo $data['no_rekam_medis']; ?></td>
        <td class="td-nama_pasien"> <?php echo $data['nama_pasien']; ?></td>
        <td class="td-no_ktp"> <?php echo $data['no_ktp']; ?></td>
        <td class="td-setatus">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("resep_obat/view/" . urlencode($data['setatus'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['setatus'] ?>
            </a>
        </td>
        <td class="td-action"> <span>
            <?php
            $sekarang = gmdate("Y-m-d", time() + 60 * 60 * 7);
            $id_user = "".USER_ID;
            $dbhost="".DB_HOST;
            $dbuser="".DB_USERNAME;
            $dbpass="".DB_PASSWORD;
            $dbname="".DB_NAME;
            //$koneksi=open_connection();
            $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
            $sql = mysqli_query($koneksi,"select * from user_login WHERE id_userlogin='$id_user'");
            while ($row=mysqli_fetch_array($sql)){
            $user_role_id = $row['user_role_id'];
            }
            if($user_role_id=="3"){
            $sql1 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
            while ($row1=mysqli_fetch_array($sql1)){
            $specialist = $row1['specialist'];
            }
            ?>
            <?php
            $key="dermawangroup";
            $plaintext = "$rec_id";
            $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
            $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
            
            ?>
            <a class="btn btn-sm btn-info has-tooltip"  href="<?php  print_link("rekam_medis/add?csrf_token=$csrf_token&precord=$ciphertext");?>"
            <i class="fa fa-send"></i>Tindakan Dan Resep</a>
            <?php
            //$db->where("specialist='$specialist' and tanggal='$sekarang'");
            }
            ?>
        </span></td>
        <td class="td-jenis_kelamin"> <?php echo $data['jenis_kelamin']; ?></td>
        <td class="td-tanggal_lahir"> <?php echo $data['tanggal_lahir']; ?></td>
        <td class="td-umur"> <?php echo $data['umur']; ?></td>
        <td class="td-tinggi"> <?php echo $data['tinggi']; ?></td>
        <td class="td-berat_badan"> <?php echo $data['berat_badan']; ?></td>
        <td class="td-tensi"> <?php echo $data['tensi']; ?></td>
        <td class="td-email"><a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a></td>
        <td class="td-no_hp"> <?php echo $data['no_hp']; ?></td>
        <td class="td-alamat"> <?php echo $data['alamat']; ?></td>
        <td class="td-keluhan"> <?php echo $data['keluhan']; ?></td>
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
        <td class="td-pembayaran"> <?php echo $data['pembayaran']; ?></td>
        <td class="td-user_entry">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("pendaftaran_poli/view/" . urlencode($data['user_entry'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['user_entry'] ?>
            </a>
        </td>
        <td class="td-penanggung_jawab"> <?php echo $data['penanggung_jawab']; ?></td>
        <td class="td-identitas_penanggung_jawab"> <?php echo $data['identitas_penanggung_jawab']; ?></td>
        <td class="td-hasil_laboratorium_radiologi"><?php Html :: page_img($data['hasil_laboratorium_radiologi'],50,50,1); ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("pendaftaran_poli/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("pendaftaran_poli/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("pendaftaran_poli/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
    