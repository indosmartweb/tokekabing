<form name="form1" method="post" action="">
   <p>Bulan
     <select name="bulan" onChange="<?php
  $bulan = $_POST['bulan'];
  $query = "SELECT * FROM visit WHERE tgl=$bulan";
  $result = mysqli_query($link, $query);
?>">
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
       <option value="12">November</option>
       <option value="12">Desember</option>
     </select>



   </p>
   <p>&nbsp;</p>

<h2>Pengurutan</h2>
    <table border="1" width="500px">      
 
<?php
require_once('koneksi.php');
$query1="select * from visit order by tgl ";
 
$pola='asc';
$polabaru='asc';
if(isset($_GET['orderby'])){
  $orderby=$_GET['orderby'];
  $pola=$_GET['pola'];
   
  $query1="SELECT * FROM  visit order by $orderby $pola ";
  if($pola=='asc'){
    $polabaru='desc';
     
  }else{
    $polabaru='asc';
  }
}
?>
<th>
        <td><a href='view_finance.php?orderby=tgl&pola=<?=$polabaru;?>'>Tgl</a></td>
        <td><a href='view_finance.php?orderby=nama1&pola=<?=$polabaru;?>'>Nama</a></td>
        <td>IPK</td><td>Jurusan</a></td>
</th>
         
<?php
//query database 
$result=mysql_query($query1) or die(mysql_error());
$no=1; //penomoran 
 
 
while($rows=mysql_fetch_object($result)){
      ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $rows -> tgl;?></td>
        <td><?php echo $rows -> nama1;?></td>
        <td align='right'><?php	echo $rows -> tgl;?></td>
        <td><?php echo $rows -> bpjs1;?></td>
      </tr>
      <?php
$no++;
}?>
    </table>