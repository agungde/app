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
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <div class="">        <div  class="bg-light p-3 mb-3">
                        <div class="container-fluid">
                            <div class="row ">
                                <div class="col ">
                                    <h4 class="record-title"><?php
                                        if(!empty($_GET['print'])){
                                        echo "Print Resep Obat";
                                        }else{
                                        if(!empty($_GET['view'])){
                                        echo "Detile Resep Obat";
                                        }else{
                                        echo "Proses Resep Obat";
                                        }
                                        }
                                    ?></h4>
                                </div>
                                <div class="col-md-12 comp-grid">
                                </div>
                            </div>
                        </div>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <div class=""><div class="container-fluid">
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
                        $sql = mysqli_query($koneksi,"select * from resep_obat WHERE id_resep_obat='$original_plaintext'");
                        while ($row=mysqli_fetch_array($sql)){
                        $rekam=$row['no_rekam_medis'];
                        $tgl=$row['tanggal'];
                        $nama_dokter=$row['nama_dokter'];
                        }
                        $sqlcek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");
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
                                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Nama Dokter</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $nama_dokter;?></td> </tr>
                                </table>
                                <?php
                                }else{
                                if(isset($_POST['proses'])){
                                $idresep = $_POST['proses'];
                                $oid = $_POST['oid'];
                                //echo "$uname";
                                if(!empty($oid)){
                                for($a = 0; $a < count($oid); $a++){
                                if(!empty($oid[$a])){
                                $oids = $oid[$a];
                                mysqli_query($koneksi,"update data_resep set setatus='Closed' where id_obat='$oids'");
                                }
                                }
                                }
                                mysqli_query($koneksi,"update resep_obat set date_update='".date("Y-m-d H:i:s")."', operator='".USER_ID."', setatus='Closed', action='Closed' where id_resep_obat='$idresep'"); 
                                ?>
                                <script language="JavaScript">
                                    alert('Proses Resep Obat Closed Berhasil');
                                    document.location='<?php print_link("resep_obat"); ?>';
                                </script>
                                <?php 
                                }
                                //  mysqli_query($koneksi,"select * from data_resep WHERE no_rekam_medis='$precord' and setatus='Register'");
                                else{
                                ?>
                                <script language="JavaScript">
                                    alert('Dilarang Akses Add Langsung');
                                    document.location='<?php print_link(""); ?>';
                                </script>
                                <?php 
                                }
                                }?>
                            </div></div>
                            <?php $this :: display_page_errors(); ?>
                            <div  class="bg-light p-3 animated fadeIn page-content">
                                <?php
                                $key="dermawangroup";
                                $plaintext1 = "$id_user";
                                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                                $iv = openssl_random_pseudo_bytes($ivlen);
                                $ciphertext_raw1 = openssl_encrypt($plaintext1, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                                $hmac = hash_hmac('sha256', $ciphertext_raw1, $key, $as_binary=true);
                                $ciphertext1 = base64_encode( $iv.$hmac.$ciphertext_raw1 );
                                ?>
                                <form action="<?php  print_link("data_resep/proses?csrf_token=$csrf_token");?>" method="POST">
                                    <table class="table table-bordered" id="dynamicTable" class="table  table-striped table-sm text-left">  
                                        <tr>
                                            <th style="background-color: #228b22; color:#fff;">Nama Obat</th>
                                            <th style="background-color: #228b22; color:#fff;">Aturan Minum</th>
                                            <th width="4%" style="background-color: #228b22; color:#fff;">Jumlah</th>
                                        </tr>
                                        <?php
                                        if(!empty($_GET['resep'])){
                                        $resepget=$_GET['resep'];
                                        if($resepget=="Luar"){
                                        $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext' and tebus_resep='Luar'");
                                        }else{
                                        $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");  
                                        }
                                        }else{
                                        $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");
                                        }
                                        while ($data=mysqli_fetch_array($cek2)){
                                        ?>  <tr>   <input type="hidden" name="oid[]" value="<?php echo $data['id_obat']; ?>"/>
                                            <td><?php echo $data['nama_obat']; ?></td>  
                                            <td><?php echo $data['aturan_minum']; ?></td> 
                                            <td><?php echo $data['jumlah']; ?></td>  
                                        </tr> 
                                        <?php }
                                        ?>
                                    </table> 
                                    <?php
                                    $key="dermawangroup";
                                    $plaintext = "$original_plaintext";
                                    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                                    $iv = openssl_random_pseudo_bytes($ivlen);
                                    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                                    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                                    $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                                    ?>
                                    <script type="text/javascript">     
                                        function PrintDiv() {    
                                        var divToPrint = document.getElementById('divToPrint');
                                        var popupWin = window.open('<?php  print_link("data_resep/proses?csrf_token=$csrf_token&precord=$ciphertext&print=$ciphertext&resep=Luar&proses=print");?>', '_blank');
                                        popupWin.document.open();
                                        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                                            popupWin.document.close();
                                            }
                                        </script>
                                        <div align="center" id="divToPrint" style="display:none;">
                                            <div  align="center" style="width:300px;height:auto;">
                                                <?php $id_user = "".USER_ID;
                                                $dbhost  = "".DB_HOST;
                                                $dbuser  = "".DB_USERNAME;
                                                $dbpass  = "".DB_PASSWORD;
                                                $dbname  = "".DB_NAME;
                                                //$koneksi=open_connection();
                                                $koneksi = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
                                                if(!empty($_GET['precord'])){
                                                $ciphertext = $_GET['precord'];
                                                $ciphertext=str_replace(' ', '+', $ciphertext);
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
                                                $sql = mysqli_query($koneksi,"select * from resep_obat WHERE id_resep_obat='$original_plaintext'");
                                                while ($row=mysqli_fetch_array($sql)){
                                                $rekam=$row['no_rekam_medis'];
                                                $tgl=$row['tanggal'];
                                                $nama_dokter=$row['nama_dokter'];
                                                }
                                                $sqlcek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");
                                                while ($row2=mysqli_fetch_array($sqlcek2)){
                                                $norekam=$row2['no_rekam_medis'];
                                                $alamat=$row2['alamat'];
                                                $nama_pasien=$row2['nama_pasien'];
                                                $tanggal_lahir=$row2['tanggal_lahir'];
                                                $tanggal=$row2['tanggal'];
                                                $umur=$row2['umur'];
                                                }
                                                ?>
                                                <!DOCTYPE html>
                              <head>
	<title><?php echo $this->report_title; ?></title>
	<style>
		@page {
			margin: 0px;
			font-family: Arial, Helvetica, sans-serif;
		}

		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0px;
			padding: 0px;
			font-family: Arial, Helvetica, sans-serif;
		}

		small {
			font-size: 12px;
			color: #888;
		}

		.ajax-page-load-indicator {
			display: none;
			visibility: hidden;
		}

		#report-header {
			position: relative;
			border-top: 2px solid #0066cc;
			border-bottom: 5px solid #0066cc;
			background: #fafafa;
			padding: 10px;
		}
		
		#report-header table{
			margin:0;
		}
		
		#report-header .sub-title {
			font-size: small;
			color: #888;
		}

		#report-header img {
			height: 50px;
			width: 50px;
		}

		#report-title {
			background: #fafafa;
			margin-top: 20px;
			margin-bottom: 20px;
			padding: 10px 20px;
			font-size: 24px;
		}
		#report-body{
			padding: 20px;
		}

		#report-footer {
			padding: 10px;
			background: #fafafa;
			border-top: 2px solid #0066cc;
			position: absolute;
			bottom: 0;
			left:0;
			width: 98%;
			overflow: hidden;
			margin: 0 auto;
		}
		
		#report-footer table{
			margin: 0;
			overflow: hidden;
		}

		table,
		.table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 1rem;
			border-collapse: collapse;
		}

		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #eceeef;
		}

		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #eceeef;
		}

		.table tbody+tbody {
			border-top: 2px solid #eceeef;
		}

		.table .table {
			background-color: #fff;
		}

		.table-sm th,
		.table-sm td {
			padding: 0.3rem;
		}

		.table-bordered {
			border: 1px solid #eceeef;
		}

		.table-bordered th,
		.table-bordered td {
			border: 1px solid #eceeef;
		}

		.table-bordered thead th,
		.table-bordered thead td {
			border-bottom-width: 2px;
		}

		.table-striped tbody tr:nth-of-type(odd) {
			background-color: rgba(0, 0, 0, 0.05);
		}

		.table-hover tbody tr:hover {
			background-color: rgba(0, 0, 0, 0.075);
		}

		.table-active,
		.table-active>th,
		.table-active>td {
			background-color: rgba(0, 0, 0, 0.075);
		}

		.table-hover .table-active:hover {
			background-color: rgba(0, 0, 0, 0.075);
		}

		.table-hover .table-active:hover>td,
		.table-hover .table-active:hover>th {
			background-color: rgba(0, 0, 0, 0.075);
		}

		.table-success,
		.table-success>th,
		.table-success>td {
			background-color: #dff0d8;
		}

		.table-hover .table-success:hover {
			background-color: #d0e9c6;
		}

		.table-hover .table-success:hover>td,
		.table-hover .table-success:hover>th {
			background-color: #d0e9c6;
		}

		.table-info,
		.table-info>th,
		.table-info>td {
			background-color: #d9edf7;
		}

		.table-hover .table-info:hover {
			background-color: #c4e3f3;
		}

		.table-hover .table-info:hover>td,
		.table-hover .table-info:hover>th {
			background-color: #c4e3f3;
		}

		.table-warning,
		.table-warning>th,
		.table-warning>td {
			background-color: #fcf8e3;
		}

		.table-hover .table-warning:hover {
			background-color: #faf2cc;
		}

		.table-hover .table-warning:hover>td,
		.table-hover .table-warning:hover>th {
			background-color: #faf2cc;
		}

		.table-danger,
		.table-danger>th,
		.table-danger>td {
			background-color: #f2dede;
		}

		.table-hover .table-danger:hover {
			background-color: #ebcccc;
		}

		.table-hover .table-danger:hover>td,
		.table-hover .table-danger:hover>th {
			background-color: #ebcccc;
		}

		.thead-inverse th {
			color: #fff;
			background-color: #292b2c;
		}

		.thead-default th {
			color: #464a4c;
			background-color: #eceeef;
		}

		.table-inverse {
			color: #fff;
			background-color: #292b2c;
		}

		.table-inverse th,
		.table-inverse td,
		.table-inverse thead th {
			border-color: #fff;
		}

		.table-inverse.table-bordered {
			border: 0;
		}

		.table-responsive {
			display: block;
			width: 100%;
			overflow-x: auto;
			-ms-overflow-style: -ms-autohiding-scrollbar;
		}

		.table-responsive.table-bordered {
			border: 0;
		}
                                                        </style>
                                                    </head>
                                                    <body>
                                                        <div id="report-header">
                                                            <?php
                                                            $query = mysqli_query($koneksi, "select * from data_clinik")
                                                            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($koneksi));
                                                            $rows = mysqli_num_rows($query);
                                                            if ($rows <> 0) {
                                                            $data       = mysqli_fetch_assoc($query);
                                                            $nama_clinik = $data['nama_clinik'];
                                                            $alamat_clinik= $data['alamat_clinik'];
                                                            $email= $data['email'];
                                                            $phone= $data['phone'];
                                                        echo "$nama_clinik</br>$alamat_clinik</br>$email</br>$phone";
                                                        }else{
                                                        echo "Print Resep Obat";
                                                        }
                                                        ?>
                                                   
<table class="table table-sm">
			<tr>
				<td align="left" valign="middle" width="30">
					<img width="60" height="40" src="<?php print_link("assets/images/logo.png") ?>" />
				</td>
				<td align="left" valign="middle">
					
				<th align="left" valign="middle">
					<h3 class="title">Clinik Medicplus</h3>
					<small class="sub-title">jl raya hasanudin jakarta phone 021 7407750 </small>
				</th>
			</tr>
		</table>





												   </div>
                                                    <div id="report-body">
                                                        <div class="ajax-page-load-indicator" style="display:none">
                                                            <div class="text-center d-flex justify-content-center load-indicator">
                                                                <span class="loader mr-3"></span>
                                                                <span class="font-weight-bold">Loading...</span>
                                                            </div>
                                                        </div>
                                                        <table id="report-strip">
                                                            <tr><td><b>Tanggal</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $tanggal;?></td> </tr>
                                                            <tr><td><b>No Rekam</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $norekam;?></td> </tr>
                                                            <tr><td><b>Nama Pasien</b></td> <td>&nbsp;:&nbsp;</td> <td><?php echo $nama_pasien;?></td>
                                                                <tr><td><b>Alamat</b></td> <td>&nbsp;:&nbsp;</td> <td><?php echo $alamat;?></td>
                                                                    <tr><td><b>Tgl Lahir</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $tanggal_lahir;?></td> </tr>
                                                                    <tr><td><b>Umur</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $umur;?></td> </tr>
                                                                    <tr><td><b>Nama Dokter</b></td> <td>&nbsp;:&nbsp;</td><td><?php echo $nama_dokter;?></td> </tr>
                                                                </table>
                                                                <table  align="left" id="report-strip">
                                                                    <thead align="left">
                                                                        <tr>
                                                                            <th  align="left">Nama Obat</th>
                                                                            <th  align="left" style="width:120px;">Aturan Minum</th>
                                                                            <th  align="left" width="auto">QTY</th>
                                                                        </tr></thead>
                                                                        <tbody class="page-data" id="page-data-list-page-ai3xsqp1b4me">
                                                                            <!--record-->
                                                                            <?php
                                                                            if(!empty($_GET['resep'])){
                                                                            $resepget=$_GET['resep'];
                                                                            if($resepget=="Luar"){
                                                                            $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext' and tebus_resep='Luar'");
                                                                            }else{
                                                                            $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");  
                                                                            }
                                                                            }else{
                                                                            $cek2 = mysqli_query($koneksi,"select * from data_resep WHERE id_resep_obat='$original_plaintext'");
                                                                            }
                                                                            while ($data=mysqli_fetch_array($cek2)){
                                                                            ?>  <tr>   <input type="hidden" name="oid[]" value="<?php echo $data['id_obat']; ?>"/>
                                                                                <td><?php echo $data['nama_obat']; ?></td>  
                                                                                <td><?php echo $data['aturan_minum']; ?></td> 
                                                                                <td><?php echo $data['jumlah']; ?></td>  
                                                                            </tr> 
                                                                            <?php }
                                                                        ?></tbody>
                                                                    </table>                              
                                                                </div>
                                                            </body>
                                                        </html>
                                                        <?php }
                                                        ?>  
                                                    </div>
                                                </div>
                                                <?php
                                                if(!empty($_GET['print'])){
                                                if(!empty($_GET['resep'])){
                                                ?> 
                                                <input type="button" class="btn btn-sm btn-info has-tooltip"value="Print Resep Obat Luar" onclick="PrintDiv();" />
                                                <?php
                                                }else{
                                                ?>
                                                <input type="button" class="btn btn-sm btn-info has-tooltip"value="Print Copy Resep" onclick="PrintDiv();" />
                                                <?php
                                                }
                                                }else{
                                                if(!empty($_GET['view'])){
                                                // echo "Detile Resep Obat";
                                                }else{
                                                ?>
                                                <button type="submit" class="btn btn-success" name="proses" value="<?php echo $original_plaintext;?>">Proses Resep Obat Closed</button>
                                                <?php
                                                }
                                                }        
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
