<?php require_once('Connections/conect_rec.php'); ?>
<!DOCTYPE html>
<?php
require_once('Connections/conect_rec.php');
require_once('conect_rec.php'); 
require_once('Connections/con_rat.php');
include "conn.php";

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<style type="text/css">
	body {
	background-image: url();
}
    </style>
<script src="jquery-2.2.4.min.js"></script> <!-- Load library jquery -->
<script src="process.js"></script> <!-- Load file process.js -->
<script language="javascript" src="json2.js"></script>
<meta charset="utf-8">
</head>
<body>
<div class="wrap">
		<div class="header">
        <a href="#"><img src="images/baner.jpg" alt="Insert Logo Here" name="Insert_logo" width="1024" height="170" id="Insert_logo" style="background-color: #C6D580; display: block;"/></a>
		</div>
		<div class="menu">
        <div class="transparent">
 
</div>

        <a href="#"></a>
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
            
  <div class="content">
    <div>
           <div class="clear"></div> 
	</div>
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
//$totalPages_rec_view = ceil($totalRows_rec_view/$maxRows_rec_view = 10;
$pageNum_rec_view = 0;
if (isset($_GET['pageNum_rec_view'])) {
  $pageNum_rec_view = $_GET['pageNum_rec_view'];
}
$startRow_rec_view = $pageNum_rec_view * $maxRows_rec_view;

mysql_select_db($database_conect_rec, $conect_rec);
$query_rec_view = "SELECT * FROM visit WHERE bulans = 'May' ORDER BY tgl ASC";
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

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conect_rec, $conect_rec);
$query_Recordset1 = "SELECT bpjs1, nama1, status1, faskes1, tgl, bulans, tahuns FROM visit WHERE bulans = 'April' ORDER BY tgl ASC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conect_rec) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

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
  $insertSQL = sprintf("INSERT INTO visit (id, bpjs1, nama1, status1, faskes1, tgl, tgls, bulans, tahuns) VALUES (%s,%s,%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['bpjs1'], "text"),
                       GetSQLValueString($_POST['nama1'], "text"),
                       GetSQLValueString($_POST['status1'], "text"),
                       GetSQLValueString($_POST['faskes1'], "text"),
					   GetSQLValueString($_POST['tgl'], "text"),
					   GetSQLValueString($_POST['tgls'], "text"),
					   GetSQLValueString($_POST['bulans'], "text"),
					   GetSQLValueString($_POST['tahuns'], "text"));

$insertSQL1 = sprintf("REPLACE INTO rating (no_id, bpjs1, nama1, status1, faskes1, tgl, tgls, bulans, tahuns) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
					   GetSQLValueString($_POST['no_id'], "text"),
					   GetSQLValueString($_POST['bpjs1'], "text"),
					   GetSQLValueString($_POST['nama1'], "text"),
                       GetSQLValueString($_POST['status1'], "text"),
                       GetSQLValueString($_POST['faskes1'], "text"),
					   GetSQLValueString($_POST['tgl'], "text"),
					   GetSQLValueString($_POST['tgls'], "text"),
					   GetSQLValueString($_POST['bulans'], "text"),
					   GetSQLValueString($_POST['tahuns'], "text"));
  mysql_select_db($database_conect_rec, $conect_rec);
  $Result1 = mysql_query($insertSQL, $conect_rec) or die(mysql_error());
  $Result1 = mysql_query($insertSQL1, $conect_rec) or die(mysql_error());
  
  
  header("location:index.php?Sukses");
}


?>
</p>
ddd
<form method="post" name="form2" action="
	<?php echo $editFormAction; ?>">  
			    <table width="497" height="228" align="Left" cellpadding="0">
        <tr valign="baseline">
          <td width="127" height="28" align="left" nowrap>CARI NO BPJS</td>
          <td width="302">: <input name="TBPJS" type="text" class="align"  id="TBPJS" size="14" maxlength="16" >
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
          <td>: <input name="tgl" type="text"  id="tgl" value="<?php echo gmdate("d/m/Y") ;?>"size="10" readonly>
            <input name="tgls" type="text"  id="tgls" value="<?php echo gmdate("d") ;?> "size="4" readonly>
			<input name="bulans" type="text"  id="bulans" value="<?php echo gmdate("M") ;?> "size="10" readonly>
          <input name="tahuns" type="text"  id="tahuns" value="<?php echo gmdate("Y") ;?> "size="4" readonly></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="left">&nbsp;</td>
          <td> <div align="center">
            <input type="submit" value="Simpan">
          </div></td>
        </tr>
      </table>
      </p>
      <p>
        <input type="hidden" name="MM_insert" value="form2">
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      


  </form>
            
            <p><br>
    <br>
            <br>
    Angka Kunjungan Pasien<br>
    <label><u><strong>Jumlah Kunjungan Pasien Bulan <?php echo gmdate("F Y")?>  - Total : <?php echo $totalRows_rec_view ?> Kunjungan, Kontak Rate  <?php echo $totalRows_Recordset1?></strong></u></label>
             <br>
            </p>
            <p>
              <?php 

		ini_set('display_errors', 0);
		error_reporting(0);
//        includekan fungsi paginasi
        include 'pagination.php';
//        koneksi ke database
        $koneksi = mysql_connect('localhost', 'root', 'smartjiwo');
        $db = mysql_select_db('toke');
        
//        query
        $sql =  "SELECT * FROM visit ORDER BY id";
        $result = mysql_query($sql);
        
        //pagination config start
        $rpp = 20; // jumlah record per halaman
        $reload = "index.php?pagination=true";
        $page = intval($_GET["page"]);
        if($page<=0) $page = 1;  
        $tcount = mysql_num_rows($result);
        $tpages = ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
        $count = 0;
        $i = ($page-1)*$rpp;
        $no_urut = ($page-1)*$rpp;
        //pagination config end
        ?>
</p>
            <p>
              <link rel="stylesheet" type="text/css" href="tabela.css">
			  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
            <div " style="margin-top: 5px;">
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <table width="75%" class="table table-bordered">
          <thead>
                    <tr>
                        <th>NO</th>
						<th height="8" align="center">BPJS</th>
						<th height="8" align="center">NAMA</th>
                        <th height="8" align="center">STATUS</th>
                        <th height="8" align="center">FASKES TK I</th>
                        <th height="8" align="center">TGL</th>

		    </tr>
                </thead>
                <tbody>
                    <?php
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
                    ?>
                    <tr>
							<td width="48" height="12">
                            <?php echo ++$no_urut;?> 
							</td>
													
							
							<td ><?php echo $data ['bpjs1']; ?></td>
							<td ><?php echo $data ['nama1']; ?></td>
							<td ><?php echo $data ['status1']; ?></td>
							<td ><?php echo $data ['faskes1']; ?></td>
							<td ><?php echo $data ['tgl']; ?></td>
							
                            
                       
                    </tr>
                    <?php
                        $i++; 
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
            
              <p>&nbsp;</p>
              <table border="1" cellpadding="1" cellspacing="1">
                <tr>
                  <td>id</td>
                  <td>bpjs1</td>
                  <td>nama1</td>
                  <td>status1</td>
                  <td>faskes1</td>
                  <td>tgl</td>
                  
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_rec_view['id']; ?></td>
                    <td><?php echo $row_rec_view['bpjs1']; ?></td>
                    <td><?php echo $row_rec_view['nama1']; ?></td>
                    <td><?php echo $row_rec_view['status1']; ?></td>
                    <td><?php echo $row_rec_view['faskes1']; ?></td>
                    <td><?php echo $row_rec_view['tgl']; ?></td>
                    
                  </tr>
                  <?php } while ($row_rec_view = mysql_fetch_assoc($rec_view)); ?>
              </table>
              <p>&nbsp;</p>
              <table border="1" cellpadding="1" cellspacing="1">
                <tr>
                  <td>bpjs1</td>
                  <td>nama1</td>
                  <td>status1</td>
                  <td>faskes1</td>
                  <td>tgl</td>
                  <td>bulans</td>
                  <td>tahuns</td>
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_Recordset1['bpjs1']; ?></td>
                    <td><?php echo $row_Recordset1['nama1']; ?></td>
                    <td><?php echo $row_Recordset1['status1']; ?></td>
                    <td><?php echo $row_Recordset1['faskes1']; ?></td>
                    <td><?php echo $row_Recordset1['tgl']; ?></td>
                    <td><?php echo $row_Recordset1['bulans']; ?></td>
                    <td><?php echo $row_Recordset1['tahuns']; ?></td>
                  </tr>
                  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
              </table>
<p>&nbsp;</p>
              <p>&nbsp;</p>
              <div>
              <div align="center"><?php echo paginate_one($reload, $page, $tpages); ?></div>
            </div>
            </p>
            </div>
		
        </div>
		<div class="clear"></div>
		<div class="footer">
			<p>footer </p>
			<p>&nbsp;</p>
		</div>
	</div>
</body>
</html>
<?php
mysql_free_result($rec_view);

mysql_free_result($Recordset1);
?>
