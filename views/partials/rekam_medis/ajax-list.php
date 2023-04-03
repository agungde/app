<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("rekam_medis/add");
$can_edit = ACL::is_allowed("rekam_medis/edit");
$can_view = ACL::is_allowed("rekam_medis/view");
$can_delete = ACL::is_allowed("rekam_medis/delete");
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
$rec_id = (!empty($data['id_rekam_medis']) ? urlencode($data['id_rekam_medis']) : null);
$counter++;
?>
<tr>
    <?php if($can_delete){ ?>
    <th class=" td-checkbox">
        <label class="custom-control custom-checkbox custom-control-inline">
            <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_rekam_medis'] ?>" type="checkbox" />
                <span class="custom-control-label"></span>
            </label>
        </th>
        <?php } ?>
        <td class="td-date_created">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['date_created'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['date_created'] ?>
            </a>
        </td>
        <td class="td-no_rekam_medis"> <?php echo $data['no_rekam_medis']; ?></td>
        <td class="td-nama_pasien"> <?php echo $data['nama_pasien']; ?></td>
        <td class="td-tinggi"> <?php echo $data['tinggi']; ?></td>
        <td class="td-berat_badan"> <?php echo $data['berat_badan']; ?></td>
        <td class="td-tensi"> <?php echo $data['tensi']; ?></td>
        <td class="td-jenis_kelamin"> <?php echo $data['jenis_kelamin']; ?></td>
        <td class="td-tanggal_lahir">
            <span title="<?php echo human_datetime($data['tanggal_lahir']); ?>" class="has-tooltip">
                <?php echo relative_date($data['tanggal_lahir']); ?>
            </span>
        </td>
        <td class="td-umur"> <?php echo $data['umur']; ?></td>
        <td class="td-tindakan">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['tindakan'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['tindakan'] ?>
            </a>
        </td>
        <td class="td-nama_pemeriksaan_lab"> <?php echo $data['nama_pemeriksaan_lab']; ?></td>
        <td class="td-keluhan"> <?php echo $data['keluhan']; ?></td>
        <td class="td-diagnosa"><a href="<?php print_link("--diagnosa--") ?>"><?php echo $data['diagnosa']; ?></a></td>
        <td class="td-rujukan">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['rujukan'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['rujukan'] ?>
            </a>
        </td>
        <td class="td-resep_obat">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['resep_obat'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['resep_obat'] ?>
            </a>
        </td>
        <td class="td-persetujuan_tindakan"> <?php echo $data['persetujuan_tindakan']; ?></td>
        <td class="td-nama_poli">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("data_poli/view/" . urlencode($data['nama_poli'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['data_poli_nama_poli'] ?>
            </a>
        </td>
        <td class="td-dokter_pemeriksa"> <?php echo $data['dokter_pemeriksa']; ?></td>
        <td class="td-user_entry">
            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("rekam_medis/view/" . urlencode($data['user_entry'])) ?>">
                <i class="fa fa-eye"></i> <?php echo $data['user_entry'] ?>
            </a>
        </td>
        <td class="td-hasil_laboratorium_radiologi"><?php Html :: page_img($data['hasil_laboratorium_radiologi'],50,50,1); ?></td>
        <td class="td-jenis_tindakan_lab"> <?php echo $data['jenis_tindakan_lab']; ?></td>
        <th class="td-btn">
            <?php if($can_view){ ?>
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("rekam_medis/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <?php } ?>
            <?php if($can_edit){ ?>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("rekam_medis/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <?php } ?>
            <?php if($can_delete){ ?>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("rekam_medis/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
    