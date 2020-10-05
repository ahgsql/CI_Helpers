<?php
/**
 * Created by PhpStorm.
 * User: AliGulec
 * Date: 17.03.2019
 * Time: 12:23
 */

//Destroys current session and redirects to baseurl
function logout(){
    $ci =& get_instance();
    $ci->session->sess_destroy();
    redirect(base_url());
}

// Controls if user Authorized, if not, saves current url path, and later then, you can redirect that page using session variable.
function authControl(){
    $ci =& get_instance();
    if($ci->session->userdata("logged")!="1"){
        $url= base_url(uri_string());
        $ci->session->set_userdata("return",$url);
        redirect(base_url("login"));
        die();
    }
}

// Login Control.. Change users with your users table, change, "user,pass" values with yours. TO_DO: Hashing
function loginControl($user,$pass){

    $ci =& get_instance();
    $userExists=$ci->db->where("user",$user)->get("users")->num_rows();
    if ($userExists<1){
        return false;
    }
    $actual=$ci->db->where("user",$user)->get("users")->row()->pass;
//    if ($ci->password->verify_hash($sifre,$gerceksifre)){
    if ($pass==$actual){
        $ci->session->set_userdata("logged","1");
        $ci->session->set_userdata("user",$user);
        return true;
    }else{
        return false;
    }
}

// Returns current-logged-in user
function sezonuseri(){
    $ci =& get_instance();
    return $ci->session->userdata("user");
}

// Returns current user's fullname
function myName(){
    $ci =& get_instance();
    return $ci->db->where("user",sezonuseri())->get("users")->row()->fullname;
}

// Returns current user's ID
function myId(){
    $ci =& get_instance();
    return $ci->db->where("user",sezonuseri())->get("users")->row()->id;
}
// Returns given user's fullname

function usersName($kadi){
    $ci =& get_instance();
    return $ci->db->where("user",$kadi)->get("users")->row()->fullname;
}