<?php

require_once "recaptchalib.php";

	
	if ( !$_POST['g-recaptcha-response'] ){
		exit('Заполните капчу');}

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$key = '6Lf3jEYUAAAAAJQ4vi8hmm_HlFD2e_3pE0yD7aIj';
	$query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];

	$data = json_decode(file_get_contents($query));

	if ( $data->success == false){
		exit('Капча введена неверно');}

	header('Content-Type: text/html; charset=UTF-8');
	 if (isset($_POST['cl-name'])) {$cl_name = $_POST['cl-name'];}
     if (isset($_POST['cl-last-name'])) {$cl_last_name = $_POST['cl-last-name'];}
     if (isset($_POST['cl-phone'])) {$cl_phone = $_POST['cl-phone'];}
     if (isset($_POST['cl-mail'])) {$cl_mail = $_POST['cl-mail'];}
     if (isset($_POST['cl-clock'])) {$cl_clock = $_POST['cl-clock'];}
	 if (isset($_POST['cl-date'])) {$cl_date = $_POST['cl-date'];}
     if (isset($_POST['cl-time'])) {$cl_time = $_POST['cl-time'];}
     if (isset($_POST['cl-prim'])) {$cl_prim = $_POST['cl-prim'];}
     if (isset($_POST['cl-uslov'])) {$cl_uslov = $_POST['cl-uslov'];}
     
        // $to - кому отправляем 
        $to = 'mail@olefoto.ru'; 
        // функция, которая отправляет наше письмо
        $subject = 'Заявка!'; //Загаловок сообщения
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Имя: '.$cl_name.'</p>
                        <p>Фамилия: '.$cl_last_name.'</p>
                        <p>телефон: '.$cl_phone.'</p>
                        <p>Email: '.$cl_mail.'</p> 
                        <p>Количество часов: '.$cl_clock.'</p>
                        <p>Дата: '.$cl_date.'</p>
                        <p>Время: '.$cl_time.'</p>
                        <p>Примечание: '.$cl_prim.'</p>                         
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: olefoto <mail@olefoto.ru>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers);
		header("Location: http://www.olefoto.ru/calendar.html");
        exit;
?>

