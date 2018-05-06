<script type="text/javascript">
$(function() {
	$("#theTable tr:even").addClass("stripe1");
	$("#theTable tr:odd").addClass("stripe2");
	$("#theTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
function editRow(ID){
	var id = ID;
	var pilih = confirm('Data yang akan mengubah  = '+id+ '?');
	if (pilih==true) {
	$.ajax({
		type	: "POST",
		url		: "modul/visit/cari.php",
		data	: "id="+id,
		dataType : "json",				  
		success	: function(data){
			$("#nomor").val(ID);
			$("#identitas").val(data.id);
			$("#anggota").val(data.nama);
			$("#jk").val(data.jk);
			$("#tempat").val(data.tempat);
			$("#tgl").val(data.tgl);
			$("#alamat").val(data.alamat);
			$("#hp").val(data.hp);
			
			$("#nomor").attr("disabled",true);
			$('#form_input').dialog('open');
			return false;
		}
	});
	}
}
function deleteRow(ID) {
	var id	= ID;
   var pilih = confirm('Data yang akan dihapus  = '+id+ '?');
	if (pilih==true) {
		$.ajax({
			type	: "POST",
			url		: "modul/visit/hapus.php",
			data	: "id="+id,
			success	: function(data){
				$("#tampil_data").load("modul/visit/tampil_data.php");
			}
		});
	}
}
</script>
<link rel="stylesheet" href="bootstrap.min.css"/>
<?php 

		
       
// www.contoh-ta.com
//author : asep setiawan & Team
include 'koneksi.php';
ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$cari	= $_GET['cari'];

$where	= " WHERE bpjs1 LIKE '%$cari%' OR nama1 LIKE '%$cari%'";

echo "<table id='theTable' width='100%'>
		<tr>
			<th width='5%'>No.</th>
			<th>No Bpjs</th>
			<th>Nama Peserta</th>
			<th>Status</th>
			<th>Faskes Tk-I</th>
			<th width='10%'>Aksi</th>
		</tr>";
	$sql	= "SELECT * 
				FROM visit
				$where
				ORDER BY bpjs1";
	$query	= mysql_query($sql);
	
	$no=1;
	while($rows=mysql_fetch_array($query)){
		echo "<tr>
				<td align='center'>$no</td>
				<td align='center'>$rows[bpjs1]</td>
				<td>$rows[nama1]</td>
				<td align='center'>$rows[status1]</td>
				<td >$rows[faskes1]</td>
				<td align='center'>
				<a href='javascript:editRow(\"{$rows[bpjs1]}\")'>Edit</a>
				<a href='javascript:deleteRow(\"{$rows[bpjs1]}\")'>Hapus</a>			
				</td>
			</tr>";
	$no++;
	}
	
echo "</table>";

?>