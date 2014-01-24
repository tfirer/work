<?php

class Show extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('community/Community_model');
    }

    public function index() {
        $this->_load_community($this->Community_model->dump_communities());
    }

    private function _load_community($communities, $result="") {
        $data = array('result' => $result);
        if ($communities != null) {
            $data['communities'] = $communities;
        }
        $this->load->view('community/show_community', $data);
    }
}
/* End of file */
