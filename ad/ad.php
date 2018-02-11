<?php

	$ldap_dn = "cn=read-only-admin,dc=example,dc=com"; //utk otentikasi server
	$ldap_password = "password";
	//$ldap_con = ldap_connect("ldap.forumsys.com"); //server link
	$ldap_con = ldap_connect("ldap.forumsys.com");
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3); //set versi protokol

	$attrs = array("uid", "cn", "mail", "telephonenumber");

	if (@ldap_bind($ldap_con, $ldap_dn, $ldap_password)){
		//echo "Bind successful";
		$filter = "(uid=*)";
		$result = ldap_search($ldap_con, "dc=example,dc=com", $filter, $attrs) or exit("Not found");
		$entries = ldap_get_entries($ldap_con, $result);
		array_shift($entries);

		$i = 0;
		print "<pre>";
		foreach ($entries as $u) {
			if(isset($u["uid"][0])) $username = $u["uid"][0]; else $username = 'unknown';
			if(isset($u["cn"][0])) $fullname = $u["cn"][0]; else $fullname = 'unknown';
			if(isset($u["mail"][0])) $email = $u["mail"][0]; else $email = 'unknown';
			if(isset($u["telephonenumber"][0])) $phone = $u["telephonenumber"][0]; else $phone = '0';
			print_r ($username);
			print "<br>";
			print_r ($fullname);
			print "<br>";
			print_r ($email);
			print "<br>";
			print_r ($phone);
			print "<br>";
			$i++;
		}
		
		print "</pre>";
	}
	else{
		echo "An Error Occured";
	}
?>