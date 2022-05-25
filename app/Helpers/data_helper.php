<?php

if(!function_exists('send')) {

    function send($data){
        echo json_encode($data);
        exit;
    }

}

if(!function_exists('success')) {

    function success($data=[]){
        send(array_merge([
            'success' => true
        ],$data));
    }

}


if(!function_exists('error')) {

    function error($data=[]){
        send(array_merge([
            'success' => false
        ],$data));
    }

}

if(!function_exists('show_404')){

    function show_404(){
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        exit;
    }
}

if(!function_exists('last_query')){

    function last_query($builder){
        return $builder->getLastQuery();
    }

}

if(!function_exists('is_ajax')){

    function is_ajax(){

        $request =  \Config\Services::request();

        return $request->isAJAX();

    }

}

if(!function_exists('uri_segment')) {

    function uri_segment($segment){

        $request =  \Config\Services::request();

        return $request->uri->getSegment($segment);
    }

}

if(!function_exists('unserialized_array')) {

    function unserialized_array($serializedArr){

        $fields = [];

        foreach ($serializedArr as $item) {
            $fields[$item['name']] = $item['value'];
        }

        return (object) $fields;

    }

}


if(!function_exists('is_admin')) {

    function is_admin(){

        $session = \Config\Services::session();

        if($session->get('user') && ($session->get('user')->user_type == 'super' || $session->get('user')->user_type == 'admin')){
            return true;
        } else {
            return false;
        }

    }

}

if(!function_exists('is_super_admin')) {

    function is_super_admin(){

        $session = \Config\Services::session();

        if($session->get('user') && $session->get('user')->user_type == 'super'){
            return true;
        } else {
            return false;
        }

    }

}

if(!function_exists('is_teacher')) {

    function is_teacher(){

        $session = \Config\Services::session();

        if($session->get('user') && $session->get('user')->user_type == 'teacher'){
            return true;
        } else {
            return false;
        }

    }

}

if(!function_exists('is_student')) {

    function is_student(){

        $session = \Config\Services::session();

        if($session->get('user') && ($session->get('user')->user_type == 'user')){
            return true;
        } else {
            return false;
        }

    }

}


if(!function_exists('notify')) {

    function notify($from,$to,$message){

        $notify = new \App\Models\NotificationsModel();

        if($notify->insert([
            'from' => $from,
            'user_id' => $to,
            'notification' => $message
        ])){
            return true;
        } else {
            return false;
        }

    }

}

if(!function_exists('list_time')) {

    function list_time($default = '00:00:00', $interval = '+30 minutes')
    {

        $output = '';

        $current = strtotime('00:00');
        $end = strtotime('23:59');

        while ($current <= $end) {
            $time = date('H:i:s', $current);
            $sel = ($time == $default) ? ' selected' : '';

            $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) . '</option>';
            $current = strtotime($interval, $current);
        }

        return $output;
    }

}

if(!function_exists('list_booking_time')) {

    function list_booking_time($first = false, $day, $default = '00:00:00', $interval = '+30 minutes')
    {

        $output = '';

        $current = strtotime($day." ".$default);
        $end = strtotime($day." ".'23:59:00');


        while ($current <= $end) {

            $time = date('F j, Y H:i:s', $current);
            $date = user_local_time($time);
            $local_to_uk = local_to_uk($time);

            $output .= "<button value='".($first ? $time : $local_to_uk->format('F j, Y H:i:s'))."' class='btn btn-secondary btn-block btn-large btn-book'>" . ($first ? $date->format('h.i A') : date('h.i A',$current)). '</button>';
            $current = strtotime($interval, $current);
        }

        return $output;
    }

}

if(!function_exists('local_to_uk')) {
    function local_to_uk($date) {

        $session = \Config\Services::session();
        $utz = $session->get('user')->timezone ? $session->get('user')->timezone : 'Europe/London';
        date_default_timezone_set($utz);

        $tz = new DateTimeZone("Europe/London");
        $date = new DateTime($date);
        $date->setTimezone($tz);

        return $date;
    }
}

if(!function_exists('user_local_time')) {

    function user_local_time($date){

        $session = \Config\Services::session();
        $utz = $session->get('user')->timezone ? $session->get('user')->timezone : 'Europe/London';
        $tz = new DateTimeZone($utz);
        $date = new DateTime($date);
        $date->setTimezone($tz);

        return $date;
    }

}

if(!function_exists('uk_time')) {

    function uk_time($date){

        $session = \Config\Services::session();

        $tz = new DateTimeZone('Europe/London');
        $date = new DateTime($date);
        $date->setTimezone($tz);

        return $date;
    }

}

if(!function_exists('diplay_date')) {

    function diplay_date($date='now'){
        return date("F j, Y g:i A",strtotime($date));
    }

}