<?php

function login_funct($ldapu,$ldapp){
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
    return $obj;
}

?>