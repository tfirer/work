<?php

class Eri_compare extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('community/Community_model');
    }

    public function index() {
        $mode = $this->input->post('mode');
        if (FALSE == $mode) {
            $this->_load_community();
            return;
        }
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('selection', 'Selection', 'trim|required');
        $advice = html_escape($this->input->post('advice'));
        if ($this->form_validation->run() == FALSE) {
            $this->_load_community('', $advice);
            return;
        }
        $mail      = $this->input->post('mail');      
        $selection = $this->input->post('selection');
        $token     = md5("$mail$selection$advice");
        if ($this->Community_model->is_duplicitous_post($token)) {
            $this->_load_community('Your advice has already added, thank you', $advice);
            return;
        }

        $data['mail']      = $mail;
        $data['selection'] = $selection;
        $data['token']     = $token;
        $data['advice']    = $advice;
        $data['time']      = time();
        if (isset($_SERVER['REMOTE_ADDR'])) $data['ip'] = $_SERVER['REMOTE_ADDR'];
        if ($this->Community_model->insert($data)) {
            $this->_load_community('Success add your advice, thank you', $advice);
            return;
        } else {
            $this->_load_community('Fail add your advice, please try again, thank you', $advice);
            return;
        }
    }

    private function _load_community($result="", $advice="") {
        $this->load->view('community/eri_compare', array('result' => $result, 'advice' => $advice));
    }

    private function _load_result_view($result = 'Error appear') {
        $this->load->view('result', array('result' => $result));
    }
}
/* End of file */
