function inputUserValidation() {
	var nama = document.forms["input-user"]["nama"].value;
	var username = document.forms["input-user"]["username"].value;
	var mail = document.forms["input-user"]["mail"].value;
	var password = document.forms["input-user"]["pass"].value;
	var password2 = document.forms["input-user"]["retype-pass"].value;
	var atpos = mail.indexOf("@");
    var dotpos = mail.lastIndexOf(".");

    if (nama == "") {
        alert("Nama harus di isi");
        document.forms["input-user"]["nama"].focus();
        return false;
    } else if (username == "") {
        alert("Username harus diisi");
        document.forms["input-user"]["username"].focus();
        return false;
    }  else if (mail == "") {
        alert("Alamat E-mail harus diisi");
        document.forms["input-user"]["mail"].focus();
        return false;
    } else if (password == "") {
        alert("Password tidak boleh kosong");
        document.forms["input-user"]["pass"].focus();
        return false;
    } else if (password2 == "") {
        alert("Masukkan validasi password");
        document.forms["input-user"]["retype-pass"].focus();
        return false;
    } else if (password2 != password) {
        alert("Validasi password salah");
        document.forms["input-user"]["retype-pass"].focus();
        return false;
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Alamat E-mail tidak valid");
        document.forms["input-user"]["mail"].focus();
        return false;
    } else {
    	return true;
    }
}

function inputSewaValidation() {
	var username = document.forms["sewa"]["user"].value;
	var kamar = document.forms["sewa"]["kamar"].value;
	var tanggal = document.forms["sewa"]["checkin"].value;

    if (username == "") {
        alert("Kolom username harus diisi");
        document.forms["sewa"]["user"].focus();
        return false;
    } else if (kamar == "") {
        alert("Kamar harus dipilih!");
        document.forms["sewa"]["kamar"].focus();
        return false;
    } else if (tanggal == "") {
        alert("Pilih tanggal Check in !");
        document.forms["sewa"]["checkin"].focus();
        return false;
    } else {
    	return true;
    }
}
