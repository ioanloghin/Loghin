<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include_once("../../module/e_403.php"));
}
//
//
//
//------------------------------------------------------------------------------------------------------------------------ //
function CheckPasswordStrength($password) 
{ 
     
    $strength = 0; 
    $patterns = array('#[a-z]#','#[A-Z]#','#[0-9]#','/[¬!"£$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/'); 
    foreach($patterns as $pattern) 
    { 
        if(preg_match($pattern,$password,$matches)) 
        { 
            $strength++; 
        } 
    } 
    return $strength; 
     
    // 1 - weak 
    // 2 - not weak 
    // 3 - acceptable 
    // 4 - strong 
} 

/*
usage :
	CheckPasswordStrength('password'); //1 
	CheckPasswordStrength('Password'); //2 
	CheckPasswordStrength('P4ssword'); //3 
	CheckPasswordStrength('P4ssw()rd'); //4
*/
//------------------------------------------------------------------------------------------------------------------------ //
//:::UPDATE[2012-03-20]::: A nu se indeparta!
?>