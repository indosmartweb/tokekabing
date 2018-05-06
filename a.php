<div align="center"><strong>REKAP DATA PENJUALAN</strong><br />
</div>
<form id="form1" name="form1" method="post" action="?proses=cetak">
Tampil Data : 

<select name="bln1" id="bln1">
<option	 value="01"	>	Januari	</option>
<option	 value="02"	>	Februari	</option>
<option	 value="03"	>	Maret	</option>
<option	 value="04"	>	April	</option>
<option	 value="05"	>	Mei	</option>
<option	 value="06"	>	Juni	</option>
<option	 value="07"	>	Juli	</option>
<option	 value="08"	>	Agustus	</option>
<option	 value="09"	>	September	</option>
<option	 value="10"	>	Oktober	</option>
<option	 value="11"	>	Nopember	</option>
<option	 value="12"	>	Desember	</option>

</select>

<select name="thn1" id="thn1">
<? for($i=2012;$i<=date("Y");$i++){ ?>
<option><?=$i?></option>
<? } ?>
</select>
<input type="submit" name="Submit" value="Tampilkan" />
</form>
<?
$proses=$_GET['proses'];

$bln1=$_POST['bln1'];
$thn1=$_POST['thn1'];
if($proses=='cetak'){
?> 
<table width="488" border="0" cellpadding="3" cellspacing="1" bgcolor="#33CCFF">
<tr>
<td align="center" valign="middle" bgcolor="#71DCFF"><strong>Tanggal</strong></td>
<td align="center" valign="middle" bgcolor="#71DCFF"><strong>Nama Barang </strong></td>
<td align="center" valign="middle" bgcolor="#71DCFF"><strong>Harga Satuan </strong></td>
<td align="center" valign="middle" bgcolor="#71DCFF"><strong>Jumlah Terjual </strong></td>
<td align="center" valign="middle" bgcolor="#71DCFF"><strong>Total </strong></td>
</tr>
<?
include "koneksi.php";
$ambildata=mysql_query("SELECT * FROM visit WHERE tgl >= '$bln1-$thn1'");
$cekdata=mysql_num_rows($ambildata);
if($cekdata=='0'){
echo "Maaf Data Yang anda cari tidak ada";
}
while($cetakdata=mysql_fetch_array($ambildata)){
?><tr>

<td bgcolor="#FFFFFF"><?=$cetakdata[nama_barang]?></td>
<td bgcolor="#FFFFFF"><?=$cetakdata[harga_satuan]?></td>
<td bgcolor="#FFFFFF"><?=$cetakdata[jumlah_terjual]?></td>
<td bgcolor="#FFFFFF"><?=$cetakdata[harga_satuan]*$cetakdata[jumlah_terjual]?></td>
</tr>
<? } ?>
</table>
<? }
 ?>