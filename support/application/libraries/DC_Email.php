<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DC_Email extends CI_Email {
    private $log = './application/logs/send_mail.log';

    public function __construct() {
        parent::__construct();
        $CI =& get_instance();
        $CI->load->helper('file');
    }

    public function send_mail($to, $subject, $message, $type = TEXT_EMAIL_TYPE, $from = DC_SMTP_USER) {
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => DC_SMTP_HOST ,
            'smtp_user' => $from ,
            'smtp_pass' => DC_SMTP_PASS ,
            'smtp_port' => DC_SMTP_PORT ,
            'mailtype' => $type ,
        );
        $name = 'DigiCare Technology Limited';

        $this->initialize($config);
        $this->set_newline("\r\n");
        $this->from($from, $name);
        $this->to($to);
        $this->subject($subject);
        $this->message($message);
        $result = $this->send();
        $time = date("Y/m/d h:i:s", time());
        if ($result == true) {
            write_file($this->log, "$time Send mail <$subject> to $to successed\r\n", 'a');
        } else {
            write_file($this->log, "$time Send mail <$subject> to $to failed\r\n", 'a');
        }
        return $result;
    }
}

/* End of file Someclass.php */
