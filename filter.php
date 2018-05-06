<?php    
 $dbHost = "localhost";    
 $dbUser = "root";    
 $dbPass = "smartjiwo";    
 $dbName = "bpjs";    

 // membuat koneksi mysql    
 $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);    

 // mengecek koneksi mysql    
 if ($conn->connect_error) die("Koneksi Gagal: " . $conn->connect_error);    
 else echo "Koneksi Database ".$dbName." Berhasil ...<br/><br/>";     

 //membuat query membaca record dari tabel User     
 $query="SELECT DISTINCT bpjs1, nama1 FROM visit";     

 //menjalankan query     
 if ($conn->query($query)) {     
 $result=$conn->query($query);     
 } else die ("Error menjalankan query". mysqli_error());     

 //mengecek record kosong    
 if ($result->num_rows > 0) {    

  // menampilkan data   
  echo "Nama Pengunjung yang kembali= <br/>";    
  while($row = $result->fetch_assoc()) {    
    echo $row["bpjs1"] .  $row["nama1"] ."<br/>";
	     
    }    
 }    
 else echo "Tidak ada Record didalam tabel";     

 // menutup koneksi mysql    
 $conn->close();    
 ?>