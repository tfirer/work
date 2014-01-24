<?php

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('help/Subscribe_model');
   }

    public function index() {
        var_dump($this->Subscribe_model->get_indiegogo_user_mails());
    }
}

/* End of file */
