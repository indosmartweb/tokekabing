<?php
require_once('conect_rec.php'); 
require_once('Connections/con_rat.php');
include "conn.php";
?>

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