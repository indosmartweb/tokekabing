<div id="smallRight"><h3 style="background-color:#A6D44D; width: 75%;">Jadwal Dokter</h3>
<table style="border: none;font-size: 12px;color: #5b5b5b;width: 75%; margin: 10px 0 10px 0;">
<tr>
<td colspan="12">
<form method="post" action="">
<select name= "cid">
<option value="01">Januari</option>
<option value="02">Februari</option>
<option value="03">Maret</option>
<option value="04">April</option>
<option value="05">Mei</option>
<option value="06">Juni</option>
<option value="07">Juli</option>
<option value="08">Agustus</option>
<option value="09">September</option>
<option value="10">Oktober</option>
<option value="11">November</option>
<option value="12">Desember</option>
</select>

 <?php
 $a="SELECT * FROM visit WHERE bln1 "; //*SELECT * FROM nama_tabel WHERE MONTHNAME(field_tanggal) = 'November';*//
 $sql=mysql_query($a);
 while($data=mysql_fetch_array($sql)){
 ?>
 <option value="<?php echo $data['tgl']?>"><?php echo $data['tgl']?></option>
 <?php
 }
 ?>
 </select>
 <input type="submit" value="cari"/>
 </form>
 </td>
 </tr>
 </table>
 <table width="75%" style="border: none;font-size: 12px;color: #5b5b5b;width: 75%;margin: 10px 0 10px 0;">
 <tr>
 <td style="border: none;padding: 4px;"><b>Hari</b></td>
 <td style="border: none;padding: 4px;"><b>Jam</b></td>
 <td style="border: none;padding: 4px;"><b>Dokter</b></td>
 <td style="border: none;padding: 4px;"><b>Keterangan</b></td>
 </tr>
 <?php
 if(isset($_POST['cid'])){
 $sql = "select * from jadwal WHERE cid = ".$_POST['cid'];
 $q = mysql_query($sql);
 while($data = mysql_fetch_array($q)){
 ?>
 <tr>
 <td style="border: none;padding: 4px;"><?php echo $data['hari'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['jam'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['dokter'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['keterangan'];?></td>
 </tr>
 <?php
 }
 }
 ?>
  </table>
 </div>