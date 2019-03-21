<?php 
function SendMail($emailTo,$message,$sub){

  $CI =& get_instance();
    $CI->load->library('email'); // load library 

    //Configure email library

    /*define('SMTP_HOST','mail.web-informatica.com');
    define('SMTP_PORT',587);
    define('SMTP_USER','envios2@web-informatica.com');
    define('SMTP_PASS','EnV!0SW3b');
    define('PROTOCOL','smtp');*/



    $configGmail = array(
        'protocol' => 'mail',
        'smtp_host' => 'mail.web-informatica.com',
        'smtp_port' => 587,
        'smtp_user' => 'envios2@web-informatica.com',
        'smtp_pass' => 'EnV!0SW3b',
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'newline' => "\r\n"
    ); 

    $CI->email->initialize($configGmail);

    $CI->email->from('secure@miratask.com', 'Miratask System');
    $CI->email->to($emailTo);
    //$this->email->cc('another@another-example.com');
    //$this->email->bcc('them@their-example.com');

    $CI->email->subject($sub);
    $CI->email->message($message);

    $CI->email->send();
}

function MailTask($emailTo){

    $CI =& get_instance();
    $CI->load->library('email'); // load library 

    $message = "You have a new Task";

    $sub = "New Task";

    //Configure email library

    $configGmail = array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.web-informatica.com',
        'smtp_port' => 587,
        'smtp_user' => 'envios2@web-informatica.com',
        'smtp_pass' => 'EnV!0SW3b',
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'newline' => "\r\n"
    ); 

    $CI->email->initialize($configGmail);

    $CI->email->from('secure@miralawgroup.com', 'Miralawgroup');
    $CI->email->to($emailTo);
    //$this->email->cc('another@another-example.com');
    //$this->email->bcc('them@their-example.com');

    $CI->email->subject($sub);
    $CI->email->message($message);

    $CI->email->send();
}


?>