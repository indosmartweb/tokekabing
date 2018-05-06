function search(){
	$("#loading").show(); // Tampilkan loadingnya
	
	$.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: "search.php", // Isi dengan url/path file php yang dituju
        data: {TBPJS : $("#TBPJS").val()}, // data yang akan dikirim ke file proses
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
		},
		success: function(response){ // Ketika proses pengiriman berhasil
            $("#loading").hide(); // Sembunyikan loadingnya
            
            if(response.status == "success"){ // Jika isi dari array status adalah success
				//$("#iBPJS1").val(response.BPJS1); // set textbox dengan id BPJS
				//$("#iNAMA").val(response.NAMA); // set textbox dengan id nama
				//$("#iNIK").val(response.NIK); // set textbox dengan id jenis kelamin
				//$("#iSTATUS").val(response.STATUS); // set textbox dengan id telepon
				//$("#iFAS_TK1").val(response.FAS_TK1); // set textbox dengan id alamat
				$("#bpjs1").val(response.bpjs1);
				$("#nama1").val(response.nama1);
				$("#nik1").val(response.nik1);
				$("#status1").val(response.status1);
				$("#faskes1").val(response.faskes1);				
				
			}else{ // Jika isi dari array status adalah failed
				alert("Pastikan Data atau isian diisi, Tidak Ditemukan");
			}
		},
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
			alert(xhr.responseText);
        }
    });
}

$(document).ready(function(){
	$("#loading").hide(); // Sembunyikan loadingnya
	
    $("#btn-search").click(function(){ // Ketika user mengklik tombol Cari
        search(); // Panggil function search
    });
    	
    $("#BPJS").keyup(function(){ // Ketika user menekan tombol di keyboard
		if(event.keyCode == 13){ // Jika user menekan tombol ENTER
		search(); // Panggil function search
		}
	});
});
