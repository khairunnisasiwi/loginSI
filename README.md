# loginSI
repository of login app for PT. Semen Indonesia

Database : loginsi.sql
	   connection.php
-----------------------------------------------------------------------
Desain : bootstrap --> instal framework/koneksi internet
	 library jquery --> instal framework/koneksi internet

-----------------------------------------------------------------------

Laman Pengguna 	: loginsi
Laman Admin	: loginsi/admin
Password Admin  : 12345678 --> ganti password di dashboard admin settings
*Simpan password md5

----------KONEKSI------------------------------------------------------
Koneksi ldap	: ldap/ldap_login.php
		  ldap/ldap_addsync.php 
*ubah bagian //KONEKSI LDAP

Koneksi ad	: ad/ad_login.php
		  ad/ad_addsync.php 
*ubah bagian //KONEKSI AD

Koneksi google	: login_google.php
		  add_google.php

*edit api client ID dari credential id google
edit redirect_uri di dalam file dan pada link https://console.developers.google.com*







