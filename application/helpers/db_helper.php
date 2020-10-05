<?php

// Returns all data stored in table.
function getTable($table){
    $ci =& get_instance();
    return $ci->db->get($table)->result();
}

// Returns a row with given id in given table
function getRow($table,$id){
    $ci =& get_instance();
    return $ci->db->where("id",$id)->get($table)->row();
}

// Returns All Tables Limited by $allowed array
function tables(){
    $ci =& get_instance();
    $tables= $ci->db->list_tables();
    $allowed=['users','kategoriler'];
    $return=array();
    foreach ($tables as $table) {
        if(in_array($table,$allowed)){
            array_push($return,$table);
        }
    }
    return $return;
}

// Returns all fields in $table
function tabloAlanlari($table){
    $ci =& get_instance();
    return $ci->db->list_fields($table);
}

// Return maximum of field in table
function maxOfField($table, $field){
    $ci =& get_instance();
    return  $ci->db->order_by($field,"desc")->limit(1)->get($table)->row();
}

// Return minimum of field in table
function minOfField($table, $field){
    $ci =& get_instance();
    return $ci->db->order_by($field)->limit(1)->get($table)->row();

}

// Return average of field in table
function avfOfField($table, $field){
    $ci =& get_instance();
    $avg=$ci->db->select_avg($field)->get($table)->row();
    return round($avg->$field,2) ;
}
