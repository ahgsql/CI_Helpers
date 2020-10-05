<?php

/**
 * Created by PhpStorm.
 * User: AliGulec
 * Date: 05.10.2020
 * Time: 11:54
 */

// Goes one page backwards
function goback()
{
    redirect($_SERVER['HTTP_REFERER']);
}

// If current url's $n th segment is equal $str, returns true
function currentpage($str, $n = 2)
{
    $ci =& get_instance();
    return ($str == $ci->uri->segment($n) ? true : false);
}

//Creates css gradient from given array
function gradient()
{
    $gradients = array(
        array("#bc4e9c", "#f80759"),
        array("#40E0D0", "#FF8C00", "#FF0080"),
        array("#11998e", "#38ef7d"),
        array("#108dc7", "#ef8e38"),
        array("#FC5C7D", "#6A82FB"),
        array("#FC466B", "#3F5EFB"),
        array("#fffbd5", "#b20a2c"),
        array("#00b09b", "#96c93d"),
        array("#D3CCE3", "#E9E4F0"),
        array("#800080", "#ffc0cb"),
        array("#00F260", "#0575E6"),
        array("#fc4a1a", "#f7b733"),
        array("#74ebd5", "#ACB6E5"),
        array("#ff9966", "#ff5e62"),
        array("#3A1C71", "#D76D77", "#FFAF7B"),

        array("#667db6", "#0082c8", "#0082c8", "#667db6"),
    );

    $gr = $gradients[array_rand($gradients)];
    $renkstr = implode(",", $gr);
    return "background: linear-gradient(to right,  $renkstr);";
}

//For navbar menu items, If current url's $n th segment is equal $str, echoes active.
function activeIfPage($str, $n = 2)
{
    $ci =& get_instance();
    echo($str == $ci->uri->segment($n) ? " active " : " ");
}

// Echoes $str and horizontal line for debugging purposes
function bas($str)
{
    echo $str."<hr>";
}

// Returns between of two strings from haystack string.
function getBetween($str, $start, $end)
{
    $str = ' ' . $str;
    $ini = strpos($str, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($str, $end, $ini) - $ini;
    return substr($str, $ini, $len);
}

// Returns $this->input->post($post);
function postt($post)
{
    $ci =& get_instance();
    return $ci->input->post($post);
}

// Returns true if given post value is exists
function postExists($post)
{
    $ci =& get_instance();
    return ($ci->input->post($post) != null);
}

// Goes given page directly
function goToPage($str)
{
    redirect(base_url($str));
}

// To-do
function createVariables($var)
{
    $boyut = "büyük";
    $dizi = array("renk" => "mavi",
        "boyut" => "orta",
        "şekil" => "küre");
    extract($dizi, EXTR_PREFIX_SAME, "wddx");
}

// Returns SEO-friendly url from given string for non-utg chars. (mainly for Turkish)
function seoUrl($str)
{
    $returnstr = "";
    $turkcefrom = array("/Ğ/", "/Ü/", "/Ş/", "/İ/", "/Ö/", "/Ç/", "/ğ/", "/ü/", "/ş/", "/ı/", "/ö/", "/ç/");
    $turkceto = array("G", "U", "S", "I", "O", "C", "g", "u", "s", "i", "o", "c");
    $fonktmp = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/", " ", $str);
    // Türkçe harfleri ingilizceye çevir
    $fonktmp = preg_replace($turkcefrom, $turkceto, $fonktmp);
    // Birden fazla olan boşlukları tek boşluk yap
    $fonktmp = preg_replace("/ +/", " ", $fonktmp);
    // Boşukları - işaretine çevir
    $fonktmp = preg_replace("/ /", "-", $fonktmp);
    // Tüm beyaz karekterleri sil
    $fonktmp = preg_replace("/\s/", "", $fonktmp);
    // Karekterleri küçült
    $fonktmp = strtolower($fonktmp);
    // Başta ve sonda - işareti kaldıysa yoket
    $fonktmp = preg_replace("/^-/", "", $fonktmp);
    $fonktmp = preg_replace("/-$/", "", $fonktmp);
    $returnstr = $fonktmp;
    return $returnstr;
}

// Saves base64 format in given format
function saveBase64Image($base64Image, $imageDir)
{

    $base64Image = trim($base64Image);
    $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
    $base64Image = str_replace('data:image/jpg;base64,', '', $base64Image);
    $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
    $base64Image = str_replace('data:image/gif;base64,', '', $base64Image);
    $base64Image = str_replace(' ', '+', $base64Image);

    $imageData = base64_decode($base64Image);
    //Set image whole path here
    $filePath = $imageDir;
    file_put_contents($filePath, $imageData);
}

// Returns array of posts values with correct values. Ex. Post values :  "name" : Ali , "age": 28, usage: returnInsert("name,"age")   RETURNS array("name"=>"Ali","age":"28)
function returnInsert(...$var)
{
    $arr = array();
    foreach ($var as $eleman) {
        $arr[$eleman] = postt($eleman);
    }
    return $arr;
}

// Creates unique GUID
function GUID()
{
    return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

// Use this function before every upload process and it creates and gives you date-based upload folder: ex: "uploads/2020/05/"
function UploadFolders()
{
    $yil = date("Y");
    $ay = date("m");
    if (!file_exists('../uploads/' . $yil)) {
        mkdir('../uploads/' . $yil, 0777, true);
    }
    if (!file_exists('../uploads/' . $yil . '/' . $ay)) {
        mkdir('../uploads/' . $yil . '/' . $ay, 0777, true);
    }
    return '../uploads/' . $yil . '/' . $ay;
}

// Returns given file names mime type
function get_mime_type($filename) {
    $idx = explode( '.', $filename );
    $count_explode = count($idx);
    $idx = strtolower($idx[$count_explode-1]);

    $mimet = array(
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'docx' => 'application/msword',
        'xlsx' => 'application/vnd.ms-excel',
        'pptx' => 'application/vnd.ms-powerpoint',


        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    if (isset( $mimet[$idx] )) {
        return $mimet[$idx];
    } else {
        return 'application/octet-stream';
    }
}

// Get Gravatar picture from email
function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

// Generate random string with given length
function generateString($length = 3) {
    $characters = 'aeijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Returns random file from path
function randFile($path){
    $files = glob($path . '/*.*');
    return $files[array_rand($files)];
}

// Returns short version of given string, default max-length is 17
function shorten($str,$len=17){
    if (mb_strlen($str)<$len) return $str;
    return mb_substr($str,0,$len).'..';
}

// Flushes current ob_buffer
function myFlush() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}

// Returns given bytes in accordin B/KB/MB/GB/TB/PB
function returnSize($bytes)
{
    $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++) ;
    return (round($bytes, 2) . " " . $label[$i]);
}

// Returns an array containing HTML elements
function htmlToArray($html)
{
    $re = '/<(?:(?:img)(?=[\s>\/])(?:[^>=]|=(?:\'[^\']*\'|"[^"]*"|[^\'"\s>]*))*\s?\/?>|(a|span|pre|code|strong|b|em|i)(?=[\s>\\\\])(?:[^>=]|=(?:\'[^\']*\'|"[^"]*"|[^\'"\s>]*))*\s?\/?>.*?<\/\1>)|(?:"[^"]*"|[^"<]*)*/si';
    preg_match_all($re, $html, $matches);
    return $matches[0];
}

//Saves given data in a file
function saveData($data){
    $ci =& get_instance();
    $dosyaAdi = $ci->router->method."-" . date("d.m.Y H:i:s") . ".txt";
    $myfile = fopen("data/".$dosyaAdi, "w") or die("Unable to open file!");
    fwrite($myfile, json_encode($data));
    fclose($myfile);

}


function outputProgress($current, $total) {
    echo "<span style='position: absolute;z-index:$current;background:#FFF;'>" . round($current / $total * 100) . "% </span>";
    myFlush();
    sleep(1);
}