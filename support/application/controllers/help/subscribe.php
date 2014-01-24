<?php

class Subscribe extends CI_Controller {
    public $res = array('errorCode' =>0, 'errorMessage' => "", 'result' => "");

    function __construct() {
        parent::__construct();
        $this->load->model('help/Subscribe_model');
        $this->load->helper(array('string', 'date', 'url'));
        $this->load->library('email');
    }

    public function index() {
        $user_mail = $this->input->get('mail');
        $mode = $this->input->get('mode');

        if (FALSE == $mode) {
            $this->display_form();
            return;
        }

        if ($mode == 'check') {
            $data['mail'] = $user_mail;
            if (FALSE == $this->Subscribe_model->insert($data)) {
                $this->res['errorCode'] = ERR_SERVER_DB;
                $this->res['errorMessage']  = 'SQL excution error';
                $data['result'] = 'Failed, please try again letter';
                $this->load->view('result', $data);
            } else {
                $data['result'] = 'Success, thanks for you subscribing';
                $this->load->view('result', $data);
            }
            return;
        }

        if (FALSE == $user_mail) {
            $this->display_result($user_mail, 'Mail can not be empty.');
            return;
            //$this->res['errorCode'] = ERR_NO_MAIL;
            //$this->res['errorMessage']  = 'Email can not be empty';
            //json_exit($this->res);
        }

        if (FALSE == valid_email($user_mail)) {
            $this->display_result($user_mail, 'Uncorrect mail format.');
            return;
            //$this->res['errorCode'] = ERR_ILLEGAL_MAIL_FORMAT;
            //$this->res['errorMessage']  = 'Illegal email format';
            //json_exit($this->res);
        }

        if ($this->Subscribe_model->is_email_register($user_mail)) {
            $this->display_result($user_mail, 'Your have already subscribed DIGICare.');
            return;
            //$this->res['errorCode'] = ERR_DUPLICATE_MAIL;
            //$this->res['errorMessage']  = 'Email address has been used';
            //json_exit($this->res);
        }

       if( !$this->send_valid_mail($user_mail) ) {
           $this->display_result($user_mail, 'Uncorrect mail format.');
           return;
           //$this->res['errorCode'] = ERR_SEND_EMAIL;
           //$this->res['errorMessage']  = 'Failed to send mail';
           //json_exit($this->res);
       } else {   
           $this->display_result($user_mail, 'Subscribe success, check your mail to confirm.');
           return;
       }
    }
    
    public function send_valid_mail($user_mail) {
        $timestamp = now();
        $token = md5(AUTH_TOKEN_SECRET . $timestamp);
        $url = base_url() . 'help/subscribe?token=' . $token . '&mail=' . $user_mail . '&mode=check';
        $message = "<html><body>You have subscribed DigiCare news. If you don’t want to received the news any more. Please contact <a href='#'>support@digi-care.com</a></br>Thank you.</br><a href='$url'>Click this link to confirm your mail</a></body></html>";
        return
            $this->email->send_mail($user_mail, 'Confirm your subscribe mail', $message, HTML_EMAIL_TYPE);
    }

    private function display_result($mail, $result) {
        $data['message'] = $result;
        $data['type'] = 'result';
        $data['mail'] = $mail;
        $this->load->view('help/subscribe', $data);
    }
    
    private function display_form() {
        $data['type'] = 'form';
        $data['mail'] = '';
        $this->load->view('help/subscribe', $data);
    }
}

/* End of file */
