<?php require_once('Connections/con_rat.php'); ?>

<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_con_rat, $con_rat);
$query_Recordset1 = "SELECT rating.bpjs1 FROM rating";
$Recordset1 = mysql_query($query_Recordset1, $con_rat) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>APLIKASI TOKE KAMBING</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link href="bootstrap.min.css" rel="stylesheet">
	<!--<script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
    <!--<script src="process.js"></script> <!-- Load file process.js -->
    <!--<script language="javascript" src="json2.js"></script> -->
</head>

<body>
<div class="container">
<div class="header">
<a href="#"><img src="" alt="Insert Logo Here" name="Insert_logo" width="180" height="120" id="Insert_logo" style="background-color: #C6D580; display:block;" /> </a>
<!-- end .header --></div>
<div class="menu">
	<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="rate.php">Kontak Rate</a></li>
				<li><a href="#">Kunjungan</a></li>
				<li><a href="#">Hal-3</a></li>
				<li><a href="#">Hal-4</a></li>
	</ul>
</div>
    
<div class="content" id="tabel">
    <h4 align="center">JUMLAH KONTAK RATE BULAN <?php echo gmdate("F Y")?> SAAT INI : <?php echo $totalRows_Recordset1 ?> </h4>
    <link rel="stylesheet" type="text/css" href="tabela.css">
 <div style="padding: 0 0 px;">
	  <div class="table-responsive">
		<table class="table table-bordered">
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">No. B P J S</th>
						<th class="text-center">N A M A</th>
						<th class="text-center">S T A T U S</th>
						<th class="text-center">FASKES TK-I</th>
						<th class="text-center">TANGGAL</th>
					</tr>
					<?php
					//Include file koneksi.php
					include "koneksi.php";
					
					// Cek apakah terdapat data page pada URL
					$page = (isset($_GET['page']))? $_GET['page'] : 1;
					
					$limit = 20; // Jumlah data per halamannya
					
					// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
					$limit_start = ($page - 1) * $limit;
					
					// Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
					$sql = $pdo->prepare("SELECT * FROM rating LIMIT ".$limit_start.",".$limit);
					$sql->execute(); // Eksekusi querynya
					
					$no = $limit_start + 1; // Untuk penomoran tabel
					while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
					?>
						<tr>
							<td class="align-middle text-center"><?php echo $no; ?></td>
							<td class="align-middle"><?php echo $data['bpjs1']; ?></td>
							<td class="align-middle"><?php echo $data['nama1']; ?></td>
							<td class="align-middle"><?php echo $data['status1']; ?></td>
							<td class="align-middle"><?php echo $data['faskes1']; ?></td>
							<td class="align-middle"><?php echo $data['tgl']; ?></td>
						</tr>
					<?php
						$no++; // Tambah 1 setiap kali looping
					}
					?>
				</table>
				<p>&nbsp;</p>
			</div>
			
			<!--
			-- Buat Paginationnya
			-- Dengan bootstrap, kita jadi dimudahkan untuk membuat tombol-tombol pagination dengan design yang bagus tentunya
			-->
			<ul class="pagination">
				<!-- LINK FIRST AND PREV -->
			    <?php
				if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
				?>
                <li class="disabled"><a href="#">First</a></li>
                <li class="disabled"><a href="#">&laquo;</a></li>
                <?php
				}else{ // Jika page bukan page ke 1
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
                <li><a href="rate.php?page=1">First</a></li>
                <li><a href="rate.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                <?php
				}
				?>
                <!-- LINK NUMBER -->
                <?php
				// Buat query untuk menghitung semua jumlah data
				$sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM rating");
				$sql2->execute(); // Eksekusi querynya
				$get_jumlah = $sql2->fetch();
				
				$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>
                <li<?php echo $link_active; ?>><a href="rate.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
				}
				?>
                <!-- LINK NEXT AND LAST -->
                <?php
				// Jika page sama dengan jumlah page, maka disable link NEXT nya
				// Artinya page tersebut adalah page terakhir 
				if($page == $jumlah_page){ // Jika page terakhir
				?>
                <li class="disabled"><a href="#">&raquo;</a></li>
                <li class="disabled"><a href="#">Last</a></li>
                <?php
				}else{ // Jika Bukan page terakhir
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>
                <li><a href="rate.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                <li><a href="rate.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                <?php
				}
				?>
            </ul>
		</div>   
    
  
  <p>
  <p>
    <input name="month" type="text" class="header" id="month" value=" Jumlah Data Kontak Rate Bulan <?php echo gmdate("F Y")?> di Poliklinik Medan" size="62" readonlyreadonly9></p>
  </div>
 
  <div class="footer">
  <p>Footer</p> 
   
  <!-- end .footer --></div>
  </p>
  <!-- end .container --></div>
  </p> 
   <!-- end .content --></div>
  </p>
  
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
