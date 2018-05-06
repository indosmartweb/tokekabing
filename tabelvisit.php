<div content>  
<?php 

		ini_set('display_errors', 0);
		error_reporting(0);
//        includekan fungsi paginasi
        include 'pagination.php';
//        koneksi ke database
        $koneksi = mysql_connect('localhost', 'root', 'smartjiwo');
        $db = mysql_select_db('bpjs');
        
//        query
        $sql =  "SELECT * FROM visit ORDER BY id";
        $result = mysql_query($sql);
        
        //pagination config start
        $rpp = 10; // jumlah record per halaman
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
 
<link rel="stylesheet" type="text/css" href="tabela.css">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">

<div " style="margin-top: 5px;">
  <table width="1020px" class="table table-bordered">
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
            
            <div><?php echo paginate_one($reload, $page, $tpages); ?></div>
  </div>

</div>
