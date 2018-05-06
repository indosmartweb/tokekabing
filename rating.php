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

$maxRows_rec_rat = 25;
$pageNum_rec_rat = 0;
if (isset($_GET['pageNum_rec_rat'])) {
  $pageNum_rec_rat = $_GET['pageNum_rec_rat'];
}
$startRow_rec_rat = $pageNum_rec_rat * $maxRows_rec_rat;

mysql_select_db($database_conect_rec, $conect_rec);

$query_rec_rat = "SELECT rating.no_id, rating.bpjs1, rating.nama1, rating.status1, rating.faskes1, rating.tgl FROM rating";

$query_limit_rec_rat = sprintf("%s LIMIT %d, %d", $query_rec_rat, $startRow_rec_rat, $maxRows_rec_rat);
$rec_rat = mysql_query($query_limit_rec_rat, $conect_rec) or die(mysql_error());
$row_rec_rat = mysql_fetch_assoc($rec_rat);

if (isset($_GET['totalRows_rec_rat'])) {
  $totalRows_rec_rat = $_GET['totalRows_rec_rat'];
} else {
  $all_rec_rat = mysql_query($query_rec_rat);
  $totalRows_rec_rat = mysql_num_rows($all_rec_rat);
}
$totalPages_rec_rat = ceil($totalRows_rec_rat/$maxRows_rec_rat)-1;

?>
<?php require_once('conect_rec.php'); 
include "conn.php";
?>
<!doctype html>

<html>

<head>
<meta charset="utf-8">
<title>APLIKASI TOKE KAMBING</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="table.css">
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
				<li><a href="rating.php">Kontak Rate</a></li>
				<li><a href="#">Kunjungan</a></li>
				<li><a href="#">Hal-3</a></li>
				<li><a href="#">Hal-4</a></li>
    </ul>
</div>
    
  <div class="content" id="tabel">
    <h2 align="center">JUMLAH KONTAK RATE    </h2>
    <table width="1020 px" align="center" cellspacing='0'>
		<thead>
			<tr>
				
                <th width="29" height="20" align="center">NO</th>
				<th width="102" height="20">NOMOR BPJS</th>
				<th width="335" height="20">NAMA PESERTA</th>
				<th width="139" height="20">STATUS</th>
                <th width="311" height="20">FASKES TK-1</th>
                <th width="90" height="20">TANGGAL</th>
			</tr>
           
		</thead>
		<tbody>
        
         <?php do { ?>
         
			<tr>
              
              <td height="20"><?php echo $row_rec_rat['no_id'];?></td>
			  <td height="20"><?php echo $row_rec_rat['bpjs1'];?></td>
			  <td height="20"><?php echo $row_rec_rat['nama1'];?></td>
			  <td height="20"><?php echo $row_rec_rat['status1'];?></td>
              <td height="20"><?php echo $row_rec_rat['faskes1'];?></td>
              <td width="90" height="20" align="left"><?php echo $row_rec_rat['tgl']; ?></td>
              
			</tr>
           
            <?php } while ($row_rec_rat = mysql_fetch_assoc($rec_rat)); ?>	
           
		</tbody>
       	</table>
  </div>
  <p>
      <br>&nbsp;</br>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>

</p>
    <hr>
    <p>
    <input name="month" type="text" class="header" id="month" value=" Jumlah Data Kontak Rate Bulan <?php echo gmdate("F Y")?> di Poliklinik Medan" size="62" readonlyreadonly9>
  <p>    
    <p>
  <!-- end .content --></div>
  <div class="footer">
   <p>Footer</p> 
   
    <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
</html>
<?php
mysql_free_result($rec_rat);




?>

