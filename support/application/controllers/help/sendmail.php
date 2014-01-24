<?php

class Sendmail extends CI_Controller {
    public $res = array('errorCode' =>0, 'errorMessage' => "", 'result' => "");

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->model('help/Subscribe_model');
    }

    public function index() {
        $mode = $this->input->post("mode");
        if (FALSE == $mode) {
            $this->_load_blank_view();
            return;
        }
        
        $this->form_validation->set_rules('mail_subject', 'Mail subject', 'trim|required');
        $this->form_validation->set_rules('mail_content', 'Mail content', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->_load_blank_view();
            return;
        }

        $mail_subject = $this->input->post('mail_subject');
        $mail_content = $this->input->post('mail_content');
        $mail_from = $this->input->post('mail_from');
        $mail_to_group = $this->input->post('mail_to_group');
        if (FALSE == $mail_subject) {
            $mail_subject = 'DIGICare news';
        }
        if (FALSE == $mail_from) {
            $mail_from = DC_SMTP_USER;
        }
        if (FALSE != $mail_content) {
            $result = $this->send_mail($mail_from, $mail_to_group, $mail_subject, $mail_content);
            $this->_load_result_view('Finish sending mail');
        } else {
            $this->load->view('help/edit_mail');
        }
    }

    private function send_mail($mail_from, $to_group, $mail_subject, $mail_content) {
        $result = true;
        if ('subscribe' == $to_group) $mails = $this->Subscribe_model->get_subscribe_mails();
        else if ('indiegogo' == $to_group) $mails = $this->Subscribe_model->get_indiegogo_user_mails();
        else $mails = array('qingliangdeng@digi-care.com', 'jimmyliao@digi-care.com', 'jameslai@digi-care.com');
        foreach ($mails as $mail) {
            //$result = $this->email->send_mail($mail, $mail_subject, $mail_content, HTML_EMAIL_TYPE, $mail_from);
        }
        return $result;
    }
    
    private function _load_blank_view() {
        $this->load->view('help/edit_mail', array('result' => ''));
    }

    private function _load_result_view($result) {
        $this->load->view('help/edit_mail', array('result' => $result));
    }
}


/* End of file */
