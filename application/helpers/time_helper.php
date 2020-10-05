<?php
// Return how many hours have passed given $start time.
function hourPassed($start){
    $timestamp = strtotime($start);
    return intval(time()-$timestamp)/3600;
}

// Returns Turkish date
function turkcetarih($format="j F Y , l", $datetime = 'now',$kisa=false){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    if($kisa){
        return $z;
    }else{
        return $z." GÜNÜ, SAAT ".date("H:i:s",strtotime($datetime));
    }
}

// Converts given date with given str formats
function convertDate($date,$reverse=false,$from='Y-m-d',$to='d/m/Y'){
    if($reverse){
        return date_format(date_create_from_format($to, $date), $from);
    }else{
        return date_format(date_create_from_format($from, $date), $to);
    }

}

// If days is true, returns how many days passed, if false, returns true if given date has passed.
function hasPassed($date,$days=false){
    $sorguzaman=strtotime($date);
    if($days){
        return round((time() - $sorguzaman )/ (60 * 60 * 24));
    }
    return (time()>$sorguzaman?true:false);
}

// Returns given date with string format
function timetoStr($datetime = 'now')
{
    return strftime('%d %B %Y %A ', strtotime($datetime));
}