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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_con_rat, $con_rat);
$query_Recordset1 = "SELECT * FROM rating WHERE tgl LIKE '%04/2018%' ORDER BY tgl ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $con_rat) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html>
<?php
require_once('conect_rec.php'); 
require_once('Connections/con_rat.php');
include "conn.php";
include "hitung.php";
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
    <script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
    <script src="process.js"></script> <!-- Load file process.js -->
    <script language="javascript" src="json2.js"></script>
</head>
<body>
<div class="wrap">
		<div class="header">			
			<a href="#"><img src="images/baner.jpg" alt="Insert Logo Here" name="Insert_logo" width="1024" height="170" id="Insert_logo" style="background-color: #C6D580; display:block;"/></a>
		</div>
		<div class="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="ratting.php">Kontak Rate</a></li>
				<li><a href="input.php">Input Faskes</a></li>
				<li><a href="Rprt_bulanan.php">Lap Bulanan</a></li>
				<li><a href="#">Javascript</a></li>				
			</ul>
		</div>
		<div class="badan">			
			<div class="sidebar">
				sidebar
				<ul>
					<li><a href="#">Tutorial HTML dasar</a></li>
					<li><a href="#">Tutorial CSS dasar</a></li>
					<li><a href="#">Tutorial PHP dasar</a></li>
					<li><a href="#">Tutorial JQuery dasar</a></li>
					<li>te</li>
					<li>te</li>
					<li></li>
					<li></li>
					<li></li>				
				</ul>
			</div>
          <div> 
          </div> 
		  <div class="content">
		    <p><br>
              content <br>
            Jumlah Kunjungan Pasien Bulan <?php echo gmdate("F Y")?>  - Total : <?php echo $totalRows_rec_view ?> Kunjungan, Kontak Rate  <?php echo $totalRows_Recordset1 ?></p>
		    <p>            
		    <p>
<p>                        
            <table width="777" class="table table-bordered">
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
            </p>
            
            <p>
              <link rel="stylesheet" type="text/css" href="tabela.css">
		    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">            
		</p>
        
        </div>
       
        </div>
        
		<div class="clear"></div>
        <div class="footer">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>footer </p>
		 </div>	
		</div>
        
	</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
