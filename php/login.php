<?php

include '../assets/php/config.php';

function login_funct($ldapu,$ldapp){

    $ldp = true;

    if(dbConnect_s('Uloha2')){
	$obj['iddb'] = -1;
        $result = dbStatement("SELECT * FROM student WHERE email='" . $ldapu . "@is.stuba.sk'", true);
	if(sizeof($result) == 0 || $result[0][password] == 0 ){
		$ldp = true;
		if(sizeof($result) != 0){
			$obj['iddb'] = $result[0][id_student];
		}
	}else if($result[0][password] != 0){
		$obj['iddb'] = $result[0][id_student];
		$ldp = false;
		if(strcmp($ldapp,$result[0][password]) == 0){
			$obj['name'] = $result[0][name];
			$obj['surname'] = '';
			$obj['conn'] = true;
		    	$obj['id'] = $result[0][ais_id];
		}
	}
    }
	if($ldp){
		$ldap['host'] = 'ldap://ldap.stuba.sk';
                $dn="uid=$ldapu, ou=People, DC=stuba, DC=sk";
		ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION,3);
		$ldap['conn'] = ldap_connect( $ldap['host']);
                $ldap['bind'] = ldap_bind($ldap['conn'], $dn, $ldapp);
                if( !$ldap['bind'] ){
                    $obj['conn'] = false;
		    $obj['msg'] = ldap_error( $ldap['conn'] );
                }else{
                    $results=ldap_search($ldap['conn'],"ou=People, DC=stuba, DC=sk","uid=$ldapu",array("givenname","surname","mail"));
                    $info=ldap_get_entries($ldap['conn'],$results);
		    $obj['conn'] = true;
		    $obj['id'] = preg_replace("/@is\.stuba\.sk/","",$info[0][mail][0]);
		    $obj['name'] = $info[0][givenname][0];
		    $obj['surname'] = $info[0][sn][0];
                }
	}

	if(dbConnect_s('UlohaAdmin')){
		$result = dbStatement("SELECT * FROM admin WHERE ais='" . $obj['id']. "'", true);
		if(sizeof($result) == 0){
			 $obj['admin'] = false;
		}else{
			$obj['admin'] = true;
		}
	}

    return $obj;
}

?>