<?php require_once('Connections/conect_rec.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO semua (NO_ID, BPJS, NIK, NPP, NAMA, HUB_KLRG, TGL_LAHIR, TMT, FAS_TK1, FAS_GIGI, STATUS, IURAN, TGL_REG, NAMA_INSTANSI, BAGIAN, KETERANGAN, APH) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['NO_ID'], "int"),
                       GetSQLValueString($_POST['BPJS'], "text"),
                       GetSQLValueString($_POST['NIK'], "text"),
                       GetSQLValueString($_POST['NPP'], "text"),
                       GetSQLValueString($_POST['NAMA'], "text"),
                       GetSQLValueString($_POST['HUB_KLRG'], "text"),
                       GetSQLValueString($_POST['TGL_LAHIR'], "text"),
                       GetSQLValueString($_POST['TMT'], "text"),
                       GetSQLValueString($_POST['FAS_TK1'], "text"),
                       GetSQLValueString($_POST['FAS_GIGI'], "text"),
                       GetSQLValueString($_POST['STATUS'], "text"),
                       GetSQLValueString($_POST['IURAN'], "text"),
                       GetSQLValueString($_POST['TGL_REG'], "text"),
                       GetSQLValueString($_POST['NAMA_INSTANSI'], "text"),
                       GetSQLValueString($_POST['BAGIAN'], "text"),
                       GetSQLValueString($_POST['KETERANGAN'], "text"),
                       GetSQLValueString($_POST['APH'], "text"));

  mysql_select_db($database_conect_rec, $conect_rec);
  $Result1 = mysql_query($insertSQL, $conect_rec) or die(mysql_error());
}
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
			<a href="#"><img src="images/baner.jpg" width="1024" height="170" id="Insert_logo" style="background-color: #C6D580; display:block;"/></a>
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
              <br>
              content <br>
            Jumlah Kunjungan Pasien Bulan <?php echo gmdate("F Y")?>  - Total : <?php echo $totalRows_rec_view ?> Kunjungan, Kontak Rate  <?php echo $totalRows_Recordset1 ?></p>
            <p>
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              <table width="532" align="left">
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NO ID :</div></td>
                  <td><input type="text" name="NO_ID" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NO BPJS :</div></td>
                  <td><input type="text" name="BPJS" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NIK :</div></td>
                  <td><input type="text" name="NIK" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NPP :</div></td>
                  <td><input type="text" name="NPP" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NAMA :</div></td>
                  <td><input type="text" name="NAMA" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">HUB_KLRG:</div></td>
                  <td><input type="text" name="HUB_KLRG" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">TGL_LAHIR:</div></td>
                  <td><input type="text" name="TGL_LAHIR" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">TMT:</div></td>
                  <td><input type="text" name="TMT" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">FAS_TK1:</div></td>
                  <td><input type="text" name="FAS_TK1" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">FAS_GIGI:</div></td>
                  <td><input type="text" name="FAS_GIGI" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">STATUS:</div></td>
                  <td><input type="text" name="STATUS" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">IURAN:</div></td>
                  <td><input type="text" name="IURAN" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">TGL_REG:</div></td>
                  <td><input type="text" name="TGL_REG" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">NAMA_INSTANSI:</div></td>
                  <td><input type="text" name="NAMA_INSTANSI" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">BAGIAN:</div></td>
                  <td><input type="text" name="BAGIAN" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">KETERANGAN:</div></td>
                  <td><input type="text" name="KETERANGAN" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left">APH:</div></td>
                  <td><input type="text" name="APH" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                  <td nowrap align="right"><div align="left"></div></td>
                  <td><input type="submit" value="Insert record"></td>
                </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form1">
            </form>
            <p>&nbsp;</p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
<p>
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
        <p>footer </p>
		 </div>	
		</div>
        
	</div>
</body>
</html>