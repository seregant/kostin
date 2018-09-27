function showForm(){
	var x = document.getElementById('loginform');
	var y = document.getElementById('regLink');
	if (x.style.display == 'inline') {
		x.style.display = 'none';
		y.style.display = 'inline'
	} else {
		x.style.display = 'inline';
		y.style.display = 'none'
	}

}


function showFeatured(){
var x =  document.getElementById('featuredMenu');
var y =  document.getElementById('categoriesMenu');
var z =  document.getElementById('infoMenu');

y.style.display = 'none';
z.style.display = 'none';

	if (x.style.display == 'inline') {
		x.style.display = 'none';
	} else {
		x.style.display = 'inline';
	}
}

function showCategories(){
var x =  document.getElementById('featuredMenu');
var y =  document.getElementById('categoriesMenu');
var z =  document.getElementById('infoMenu');

x.style.display = 'none';
z.style.display = 'none';

	if (y.style.display == 'inline') {
		y.style.display = 'none';
	} else {
		y.style.display = 'inline';
	}
}

function showInfo(){
var x =  document.getElementById('featuredMenu');
var y =  document.getElementById('categoriesMenu');
var z =  document.getElementById('infoMenu');

x.style.display = 'none';
y.style.display = 'none';

	if (z.style.display == 'inline') {
		z.style.display = 'none';
	} else {
		z.style.display = 'inline';
	}
}

function collapseAll() {

	var x =  document.getElementById('featuredMenu');
	var y =  document.getElementById('categoriesMenu');
	var z =  document.getElementById('infoMenu');
	x.style.display = 'none';
	y.style.display = 'none';
	z.style.display = 'none';	
}

function resetFilter(){
	document.getElementById("filterForm").reset();
}


function showFilter(){
	var filter = document.getElementById("filterbox");

	if (filter.style.display == 'inline'){
		filter.style.display = 'none';
	} else {
		filter.style.display = 'inline';
	}

	
}


function loadData() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      showData(this);
    }
  };
  xmlhttp.open("GET", "data.xml", true);
  xmlhttp.send();
}

function inputUserValidation() {
	var nama = document.forms["registrasi"]["nama"].value;
	var username = document.forms["registrasi"]["username"].value;
	var mail = document.forms["registrasi"]["mail"].value;
	var password = document.forms["registrasi"]["pass"].value;
	var password2 = document.forms["registrasi"]["retype-pass"].value;
	var atpos = mail.indexOf("@");
    var dotpos = mail.lastIndexOf(".");

    var usernameData = ["<?php echo 'test';?>"];

    if (nama == "") {
        alert("Nama harus di isi");
        document.forms["registrasi"]["nama"].focus();
        return false;
    } else if (username == "") {
        alert("Alamat harus diisi");
        document.forms["registrasi"]["username"].focus();
        return false;
    }  else if (mail == "") {
        alert("Alamat E-mail harus diisi");
        document.forms["registrasi"]["mail"].focus();
        return false;
    } else if (password == "") {
        alert("Password tidak boleh kosong");
        document.forms["registrasi"]["pass"].focus();
        return false;
    } else if (password2 == "") {
        alert("Masukkan validasi password");
        document.forms["registrasi"]["retype-pass"].focus();
        return false;
    } else if (password2 != password) {
        alert("Validasi password salah");
        document.forms["registrasi"]["retype-pass"].focus();
        return false;
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Alamat E-mail tidak valid");
        document.forms["registrasi"]["mail"].focus();
        return false;
    } else {
    	return true;
    }
}
