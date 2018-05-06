<?php
include "koneksi.php"; // Load file koneksi.php
$TBPJS = $_POST['TBPJS']; // Ambil data NIS yang dikirim lewat AJAX

$query = mysqli_query($connect, "SELECT * FROM semua WHERE bpjs='".$TBPJS."'"); // Tampilkan data siswa dengan NIS tersebut

$row = mysqli_num_rows($query); // Hitung ada berapa data dari hasil eksekusi $query

if($row > 0){ // Jika data lebih dari 0
	$data = mysqli_fetch_array($query); // ambil data siswa tersebut
	
	// Buat sebuah array
	     $callback = array(
		'status' => 'success', // Set array status dengan success
		'bpjs1'=> $data['BPJS'], //Set array nis dengan isi kolom Nis pada tabel siswa
		'nama1' => $data['NAMA'], // Set array nama dengan isi kolom nama pada tabel siswa
		'nik1' => $data['NIK'], // Set array nama dengan isi kolom nama pada tabel siswa
		'status1' => $data['STATUS'], // Set array jenis_kelamin dengan isi kolom telp pada tabel siswa
		'faskes1' => $data['FAS_TK1'], // Set array jenis_kelamin dengan isi kolom alamat pada tabel siswa

	);
	
	
}else{
	$callback = array('status' => 'failed'); // set array status dengan failed
}

echo json_encode($callback); // konversi varibael $callback menjadi JSON
//echo json_encode(['code'=>404, 'msg'=>$errorMSG]);

?>
