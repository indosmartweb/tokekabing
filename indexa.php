<?php require_once('conect_rec.php'); 
include "conn.php";
?>
<?php

ini_set('display_errors', 0);
error_reporting(0);
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec_view = 25;
$pageNum_rec_view = 0;
if (isset($_GET['pageNum_rec_view'])) {
  $pageNum_rec_view = $_GET['pageNum_rec_view'];
}
$startRow_rec_view = $pageNum_rec_view * $maxRows_rec_view;

mysql_select_db($database_conect_rec, $conect_rec);
$query_rec_view = "SELECT * FROM visit ORDER BY tgl ASC";
$query_limit_rec_view = sprintf("%s LIMIT %d, %d", $query_rec_view, $startRow_rec_view, $maxRows_rec_view);
$rec_view = mysql_query($query_limit_rec_view, $conect_rec) or die(mysql_error());
$row_rec_view = mysql_fetch_assoc($rec_view);

if (isset($_GET['totalRows_rec_view'])) {
  $totalRows_rec_view = $_GET['totalRows_rec_view'];
} else {
  $all_rec_view = mysql_query($query_rec_view);
  $totalRows_rec_view = mysql_num_rows($all_rec_view);
}
$totalPages_rec_view = ceil($totalRows_rec_view/$maxRows_rec_view)-1;$maxRows_rec_view = 25;
$pageNum_rec_view = 0;
if (isset($_GET['pageNum_rec_view'])) {
  $pageNum_rec_view = $_GET['pageNum_rec_view'];
}
$startRow_rec_view = $pageNum_rec_view * $maxRows_rec_view;

mysql_select_db($database_conect_rec, $conect_rec);
$query_rec_view = "SELECT * FROM visit ";
$query_limit_rec_view = sprintf("%s LIMIT %d, %d", $query_rec_view, $startRow_rec_view, $maxRows_rec_view);
$rec_view = mysql_query($query_limit_rec_view, $conect_rec) or die(mysql_error());
$row_rec_view = mysql_fetch_assoc($rec_view);

if (isset($_GET['totalRows_rec_view'])) {
  $totalRows_rec_view = $_GET['totalRows_rec_view'];
} else {
  $all_rec_view = mysql_query($query_rec_view);
  $totalRows_rec_view = mysql_num_rows($all_rec_view);
}
$totalPages_rec_view = ceil($totalRows_rec_view/$maxRows_rec_view)-1;

$queryString_rec_view = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_view") == false && 
        stristr($param, "totalRows_rec_view") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_view = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_view = sprintf("&totalRows_rec_view=%d%s", $totalRows_rec_view, $queryString_rec_view);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO visit (id, bpjs1, nama1, status1, faskes1, tgl) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['bpjs1'], "text"),
                       GetSQLValueString($_POST['nama1'], "text"),
                       GetSQLValueString($_POST['status1'], "text"),
                       GetSQLValueString($_POST['faskes1'], "text"),
					   GetSQLValueString($_POST['tgl'], "text"));

$insertSQL1 = sprintf("REPLACE INTO rating (no_id, bpjs1, nama1, status1, faskes1, tgl) VALUES (%s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($_POST['no_id'], "text"),
					   GetSQLValueString($_POST['bpjs1'], "text"),
					   GetSQLValueString($_POST['nama1'], "text"),
                       GetSQLValueString($_POST['status1'], "text"),
                       GetSQLValueString($_POST['faskes1'], "text"),
					   GetSQLValueString($_POST['tgl'], "text"));
  mysql_select_db($database_conect_rec, $conect_rec);
  $Result1 = mysql_query($insertSQL, $conect_rec) or die(mysql_error());
  $Result1 = mysql_query($insertSQL1, $conect_rec) or die(mysql_error());
  
  
  header("location:index.php?Sukses");
}


?>
 


<!doctype html>

<html>

<head>
<meta charset="utf-8">
<title>APLIKASI TOKE KAMBING</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
    <script src="process.js"></script> <!-- Load file process.js -->
    <script language="javascript" src="json2.js"></script>
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
    
  <div class="content">
    <h2>PENCARIAN DATA PESERTA BPJS</h2>
    
    <form name="form1" method="post" action="">
    </form>
    <form method="post" name="form2" action="
	<?php echo $editFormAction; ?>">
    
    <p>
    <table width="460" height="215" align="Left" cellpadding="0">
        <tr valign="baseline">
          <td width="106" height="31" align="left" nowrap>CARI NO BPJS</td>
          <td width="346">: <input name="TBPJS" type="text" class="align"  id="TBPJS" size="14" maxlength="16" >
            <button type="button" id="btn-search">Cari</button></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">ID</td>
          <td>: 
          <input name="id" type="text" id="id" value="" align= "center" size="6" readonly>
          <input name="no_id" type="text" id="no_id" value="" align= "center" size="6" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">NO BPJS</td>
          <td>:          
          <input name="bpjs1" type="text" id="bpjs1" value="" align= "center" size="14" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">NAMA</td>
          <td>:
          
          <input name="nama1" type="text" id="nama1" value="" size="32" maxlength="35" readonly></td>
        </tr>
        <tr valign="baseline">
          <td align="left" nowrap>NIK</td>
          <td>:
         <input name="nik1" type="text" id="nik1" value="" size="18" maxlength="18" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">STATUS</td>
          <td>: <input name="status1" type="text" id="status1" value="" size="18" maxlength="18" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">FASKES Tk I</td>
          <td>:          
          
          <input name="faskes1" type="text" id="faskes1" value="" size="40" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">TGL</td>
          <td>: <input name="tgl" type="text"  id="tgl" value="<?php echo gmdate("d/m/Y") ;?> "size="10" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">&nbsp;</td>
          <td> <input type="submit" value="Simpan"></td>
        </tr>
      </table>
      </p>
      <input type="hidden" name="MM_insert" value="form2">
    </form>
   
    <br>
    <p>&nbsp;</p>
    <p>
    <br>&nbsp;</br>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><br>
    </p>
    <p><br>
    </p>
    <h2>&nbsp;</h2>
    <div align="left" id="judul">
      <hr>
      <h2>Jumlah Data Kunjungan Pasien Bulan <?php echo gmdate("F Y")?>  - Total : <?php echo $totalRows_rec_view ?> Pengunjung</h2>
    </div>
    <div align="Left">
      <table width="1020 px" border="1" cellpadding="2" cellspacing="0">
        <tr>
          <td width="33" height="5" align="center" nowrap="nowrap" bgcolor="#CCCCCC"><div align="center">NO</div></td>
          <td width="110" align="left" bgcolor="#CCCCCC"><div align="center">NO BPJS</div></td>
          <td width="302" align="left" bgcolor="#CCCCCC"><div align="center">N A M A</div></td>
          <td width="136" align="left" bgcolor="#CCCCCC"><div align="center">STATUS</div></td>
          <td width="250" align="left" bgcolor="#CCCCCC"><div align="center">F A S K E S Tk. I</div></td>
          <td width="95" align="left" bgcolor="#CCCCCC"> <div align="center">TANGGAL</div></td>
        </tr>
        <?php do { ?>
          <tr div class ="container">
            <td width="33" align="center" valign="middle"  nowrap="nowrap" bgcolor="#FFFFFF"><div align="center"><?php echo $row_rec_view['id']; ?></div></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><?php echo $row_rec_view['bpjs1']; ?></div></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $row_rec_view['nama1']; ?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $row_rec_view['status1']; ?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo $row_rec_view['faskes1']; ?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><?php echo $row_rec_view['tgl']; ?></div></td>
          </tr>
          <?php } while ($row_rec_view = mysql_fetch_assoc($rec_view)); ?>
      </table>
    </div>
<p>&nbsp;    </p>
<p>Tersimpan : <?php echo ($startRow_rec_view + 1) ?>  sampai  .<?php echo min($startRow_rec_view + $maxRows_rec_view, $totalRows_rec_view) ?> .dari  <?php echo $totalRows_rec_view ?>
</p>
<p>
  <!-- end .content --></div>
  <div class="footer">
   <p>Footer</p> 
  <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php

mysql_free_result($rec_view);

?>

