<!doctype html>
<html>
    <head>
        <title>Toke Kambing</title>
        <link rel="stylesheet" href="bootstrap.min.css"/>
		<link rel="stylesheet" href="tabela.css"/>
    </head>
    <body>
        <?php 
		ini_set('display_errors', 0);
		error_reporting(0);
//        includekan fungsi paginasi
        include 'pagination.php';
//        koneksi ke database
        $koneksi = mysql_connect('localhost', 'root', 'smartjiwo');
        $db = mysql_select_db('bpjs');
        
//        query
        $sql =  "SELECT * FROM semua ORDER BY NO_ID";
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
        <div class="container" style="margin-top: 50px">
          <table class="table table-bordered">
            <thead>
                    <tr>
						<td height="10"></td>
						
                        <td width="54" height="10" align="center">NO</td>
						<td width="86" height="10" align="center">IDBPJS</td>
						<td width="47" height="10" align="center">KTP</td>
						<td width="47" height="10" align="center">NPP</td>
						<td width="58" height="10" align="center">NAMA</td>
						<td width="88" height="10" align="center">HUBKLRG</td>
						<td width="90" height="10" align="center">TGLLAHIR</td>
						<td width="49" height="10" align="center">TMT</td>
						<td width="90" height="10" align="center">FASUMUM</td>
						<td width="77" height="10" align="center">FASGIGI</td>
						<td width="76" height="10" align="center">STATUS</td>
						<td width="49" height="10" align="center">GAJI</td>
						<td width="61" height="10" align="center">IURAN</td>
						<td width="79" height="10" align="center">TGLTEG</td>
						<td width="89" height="10" align="center">SUBTANSI</td>
						<td width="77" height="10" align="center">NKARTU</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while(($count<$rpp) && ($i<$tcount)) {
                        mysql_data_seek($result,$i);
                        $data = mysql_fetch_array($result);
                    ?>
                    <tr>
							<td width="35" height="12">
                            <?php echo ++$no_urut;?> 
							</td>
													
							<td height="12"><?php echo $data ['NO_ID']; ?></td>
							<td height="12"><?php echo $data ['BPJS']; ?></td>
							<td height="12"><?php echo $data ['NIK']; ?></td>
							<td height="12"><?php echo $data ['NPP']; ?></td>
							<td height="12"><?php echo $data ['NAMA']; ?></td>
							<td height="12"><?php echo $data ['HUB_KLRG']; ?></td>
							<td height="12"><?php echo $data ['TGL_LAHIR']; ?></td>
							<td height="12"><?php echo $data ['TMT']; ?></td>
							<td height="12"><?php echo $data ['FAS_TK1']; ?></td>
							<td height="12"><?php echo $data ['FAS_GIGI']; ?></td>
							<td height="12"><?php echo $data ['STATUS']; ?></td>
							<td height="12"><?php echo $data ['IURAN']; ?></td>
							<td height="12"><?php echo $data ['TGL_REG']; ?></td>
							<td height="12"><?php echo $data ['NAMA_INSTANSI']; ?></td>
							<td height="12"><?php echo $data ['BAGIAN']; ?></td>
							<td height="12"><?php echo $data ['KETERANGAN']; ?></td>
							
														
                        
                        <td width="120" class="text-center">
                            <a href="#"> Edit</a> |
                            <a href="#">Delete</a>
                       
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
    </body>
</html>

<!--harviacode.com-->