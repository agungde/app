<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Resep Obat </h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <div class=""><div>
                        <?php
                        $id_user = "".USER_ID;
                        $dbhost  = "".DB_HOST;
                        $dbuser  = "".DB_USERNAME;
                        $dbpass  = "".DB_PASSWORD;
                        $dbname  = "".DB_NAME;
                        //$koneksi=open_connection();
                        $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                        if(!empty($_GET['precord'])){
                        $ciphertext = $_GET['precord'];
                        $ciphertext=str_replace(' ', '+', $ciphertext);
                        $resep=$ciphertext;
                        $key="dermawangroup";
                        $c = base64_decode($ciphertext);
                        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                        $iv = substr($c, 0, $ivlen);
                        $hmac = substr($c, $ivlen, $sha2len=32);
                        $ciphertext_raw = substr($c, $ivlen+$sha2len);
                        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                        if (hash_equals($hmac, $calcmac))// timing attack safe comparison
                        {
                        // echo $original_plaintext."\n";
                        }
                        $precord="$original_plaintext";
                        $sqlcek2 = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE id_pendaftaran_poli='$precord'");
                        while ($row2=mysqli_fetch_array($sqlcek2)){
                        $norekam=$row2['no_rekam_medis'];
                        $alamat=$row2['alamat'];
                        $nama_pasien=$row2['nama_pasien'];
                        $tanggal_lahir=$row2['tanggal_lahir'];
                        $tanggal=$row2['tanggal'];
                        $umur=$row2['umur'];
                        }
                        ?>
                        <table > 
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Tanggal</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $tanggal;?></td> </tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>No Rekam</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $norekam;?></td> </tr>
                            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Nama Pasien</b></td> <td>&nbsp;:&nbsp;</td> <td><?php echo $nama_pasien;?></td>
                                <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Alamat</b></td> <td>&nbsp;:&nbsp;</td> <td><?php echo $alamat;?></td>
                                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Tgl Lahir</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $tanggal_lahir;?></td> </tr>
                                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Umur</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $umur;?></td> </tr>
                                </table>
                                <?php
                                }else{
                                if(isset($_POST['precod'])){
                                $precodback = $_POST['precodback'];
                                $uname  = $_POST['name'];
                                $idpoli = $_POST['precod'];
                                $aturan = $_POST['aturan'];
                                $qty    = $_POST['qty'];
                                $sqlcek3 = mysqli_query($koneksi,"select * from data_dokter WHERE id_user='$id_user'");
                                while ($row3=mysqli_fetch_array($sqlcek3)){
                                $nama_dokter=$row3['nama_dokter'];
                                }            
                                $sql = mysqli_query($koneksi,"select * from pendaftaran_poli WHERE id_pendaftaran_poli='$idpoli'");
                                while ($row=mysqli_fetch_array($sql)){
                                $no_rekam_medis=$row['no_rekam_medis'];
                                $alamat=$row['alamat'];
                                $nama_pasien=$row['nama_pasien'];
                                $tanggal=$row['tanggal'];
                                $nama_poli=$row['nama_poli'];
                                $tanggal_lahir=$row['tanggal_lahir'];
                                $phone=$row['no_hp'];
                                }   
                                $thn  = substr($tanggal_lahir, 0, 4);
                                $taun = date("Y");
                                $umur = $taun - $thn;
                                $umur = substr($umur, 0, 2);
                                function hitung_umur($thn){
                                $birthDate = new DateTime($thn);
                                $today = new DateTime("today");
                                if ($birthDate > $today) { 
                                exit("0 tahun 0 bulan 0 hari");
                                }
                                $y = $today->diff($birthDate)->y;
                                $m = $today->diff($birthDate)->m;
                                $d = $today->diff($birthDate)->d;
                                return $y."Tahun ".$m."Bulan ".$d."Hari";
                                }
                                $umurnya=hitung_umur("1980-12-01"); 
                                mysqli_query($koneksi,"INSERT INTO `resep_obat` (`id_pendaftaran_poli`,`no_rekam_medis`, `tanggal`, `nama_poli`, `nama_pasien`, `alamat`, `tanggal_lahir`, `umur`, `nama_dokter`,`setatus`) VALUES ('$idpoli','$no_rekam_medis', '$tanggal', '$nama_poli', '$nama_pasien', '$alamat', '$tanggal_lahir', '$umurnya', '$nama_dokter', 'Register')");  
                                $query = mysqli_query($koneksi, "select * from resep_obat WHERE id_pendaftaran_poli='$idpoli'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
                                $rows = mysqli_num_rows($query);
                                if ($rows <> 0) {
                                $data = mysqli_fetch_assoc($query);
                                $idresepobat=$data['id_resep_obat'];
                                }else{
                                }  
                                if(!empty($uname)){
                                for($a = 0; $a < count($uname); $a++){
                                if(!empty($uname[$a])){
                                $unames  = $uname[$a];
                                $aturans = $aturan[$a];
                                $qtys    = $qty[$a];
                                $sqlcek4 = mysqli_query($koneksi,"select * from data_obat WHERE id_obat='$unames'");
                                while ($row4=mysqli_fetch_array($sqlcek4)){
                                $nama_obat=$row4['nama_obat'];
                                $satuan=$row4['satuan'];
                                $jumlah=$row4['jumlah'];
                                $harga_jual=$row4['harga_jual'];
                                $isi_nama="$nama_obat ($satuan)";
                                }            
                                $stoks=$jumlah - 1;          
                                mysqli_query($koneksi,"INSERT INTO `data_resep` (`id_resep_obat`,`id_obat`, `no_rekam_medis`, `tanggal`, `nama_poli`, `nama_pasien`, `alamat`, `tanggal_lahir`, `umur`, `nama_dokter`, `nama_obat`, `aturan_minum`, `jumlah`, `setatus`) VALUES ('$idresepobat','$unames', '$no_rekam_medis', '$tanggal', '$nama_poli', '$nama_pasien', '$alamat', '$tanggal_lahir', '$umurnya', '$nama_dokter', '$isi_nama', '$aturans', '$qtys', 'Register')"); 
                                $totharga=$harga_jual * $qtys;
                                mysqli_query($koneksi,"INSERT INTO `penjualan` (`nama_poli`,`id_pelanggan`, `tanggal`, `nama_pelanggan`, `alamat`, `nama_barang`, `jumlah`, `harga`, `total_harga`, `total_bayar`) VALUES ('$nama_poli','$no_rekam_medis', '$tanggal', '$nama_pasien', '$alamat', '$nama_obat', '$qtys', '$harga_jual', '$totharga', '$totharga')");  
                                //////////////////////////////////////////
                                mysqli_query($koneksi,"UPDATE data_obat SET jumlah='$stoks' WHERE id_obat='$unames'");
                                //////////////////////////////////////////
                                }
                                }
                                }
                                $queryb = mysqli_query($koneksi, "select * from pelanggan WHERE id_pelanggan='$no_rekam_medis'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
                                // ambil jumlah baris data hasil query
                                $rowsb = mysqli_num_rows($queryb);
                                // cek hasil query
                                // jika "no_antrian" sudah ada
                                if ($rowsb <> 0) {}else{
                                mysqli_query($koneksi,"INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `phone`) VALUES ('$no_rekam_medis', '$nama_pasien', '$alamat',  '$phone')");    
                                }   
                                ?>
                                <script language="JavaScript">
                                    alert('Resep Obat Berhasil Di Simpan');
                                    document.location='<?php print_link("rekam_medis/add?csrf_token=$csrf_token&precord=$precodback&resep=True"); ?>';
                                </script>
                                <?php 
                                }else{
                                ?>
                                <script language="JavaScript">
                                    alert('Dilarang Akses Add Langsung');
                                    document.location='<?php print_link(""); ?>';
                                </script>
                                <?php 
                                }
                                }
                                ?>
                            </div></div>
                            <?php $this :: display_page_errors(); ?>
                            <div  class="bg-light p-3 animated fadeIn page-content">
                                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                                <form action="<?php  print_link("rekam_medis/resep?csrf_token=$csrf_token");?>" method="POST">
                                    <table class="table table-bordered" id="dynamicTable" class="table  table-striped table-sm text-left">  
                                        <input type="hidden" name="precod" value="<?php echo $precord;?>"/>
                                            <input type="hidden" name="precodback" value="<?php echo $resep;?>"/>
                                                <tr>
                                                    <th style="background-color: #228b22; color:#fff;">Nama Obat</th>
                                                    <th style="background-color: #228b22; color:#fff;">Aturan Minum</th>
                                                    <th width="4%" style="background-color: #228b22; color:#fff;">Jumlah</th>
                                                    <th style="background-color: #228b22; color:#fff;">Action</th>
                                                </tr>
                                                <tr>  
                                                    <td>
                                                        <select name="name[]" class="form-control" required="">
                                                            <option value="">Pilih Nama Obat</option>
                                                            <?php
                                                            $sql = mysqli_query($koneksi,"select * from data_obat");
                                                            while ($row=mysqli_fetch_array($sql)){
                                                            $id_obat=$row['id_obat'];
                                                            $nama_obat=$row['nama_obat'];
                                                            $satuan=$row['satuan'];
                                                            $jumlah=$row['jumlah'];
                                                            echo"<option value=\"$id_obat\" title=\"Setok sisa $jumlah\">$nama_obat ($satuan sisa $jumlah)</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>  
                                                    <td><input type="text" required="" name="aturan[]" placeholder="Enter Aturan Minum" class="form-control" /></td>  
                                                    <td><input type="text" required="" name="qty[]" placeholder="QTY" class="form-control" /></td>  
                                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                                </tr>  
                                            </table> 
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </form>
                                        <script type="text/javascript">
                                            var i = 0;
                                            $("#add").click(function(){
                                            ++i;
                                            $("#dynamicTable").append('<tr><td><?php
                                                echo "<select name=\"name[]\" class=\"form-control\" required=\"\">";
                                                    echo "<option value=\"\">Pilih Nama Obat</option>";
                                                    $sql11 = mysqli_query($koneksi,"select * from data_obat");
                                                    while ($row11=mysqli_fetch_array($sql11)){
                                                    $id_obat11=$row11['id_obat'];
                                                    $nama_obat11=$row11['nama_obat'];
                                                    $satuan11=$row11['satuan'];
                                                    $jumlahs=$row11['jumlah'];
                                                    echo"<option value=\"$id_obat11\" title=\"Setok sisa $jumlah\">$nama_obat11 ($satuan11  setok $jumlahs)</option>";
                                                    }
                                                    //  echo "<option value=\"airport1\">Airport1</option>";
                                                    //echo " <option value=\"airport2\">Airport2</option>";
                                                echo " </select>";
                                            ?></td><td><input type="text" required=\"\" name="aturan[]" placeholder="Enter Aturan Minum" class="form-control" /></td><td><input type="text" required=\"\" name="qty[]" placeholder="QTY" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
                                            // $("#dynamicTable").append('<tr><td><input type="text" name="name[]" placeholder="Enter Nama Obat" class="form-control" /></td><td><input type="text" name="type[]" placeholder="Enter Type Obat" class="form-control" /></td><td><input type="text" name="aturan[]" placeholder="Enter Aturan Minum" class="form-control" /></td><td><input type="text" name="aqty[]" placeholder="Enter Jumlah" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
                                            });
                                            $(document).on('click', '.remove-tr', function(){  
                                            $(this).parents('tr').remove();
                                            });  
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
