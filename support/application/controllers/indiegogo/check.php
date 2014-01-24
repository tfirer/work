<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->model('help/Subscribe_model');
    }

	public function index()
	{
        $data = array();
        $mode  = $this->input->get_post('mode', true);
        $pledge_id = $this->input->get_post('pledge_id', true);
        $email = $this->input->post('email');

        //$this->form_validation->set_rules('shipping_address2', 'Shipping Address2', 'trim|required');

        if ('check' == $mode) {
            $this->_load_email($pledge_id);
            return;
        } else if ('checked' == $mode) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->_load_email($pledge_id);
                return;
            }
            $buyer = $this->_get_buyer_by_email_and_md5_id($email, $pledge_id);
            if ($buyer == null) {
                $this->_load_email($pledge_id, 'Unregisted Email');
                return;
            } else {
                $this->_load_blank_view($this->_get_buyer_by_pledge_id($buyer->pledge_id));
                return;
            }
        } else if ('submit' == $mode) {
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('shipping_address', 'Shipping Address', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->_load_blank_view($this->_get_buyer_by_pledge_id($pledge_id));
                return;
            }
            $data['name'] = html_escape($this->input->post('name'));
            $data['shipping_address'] = html_escape($this->input->post('shipping_address'));
            $data['shipping_address2'] = html_escape($this->input->post('shipping_address2'));
            $data['color_p1'] = (FALSE != $this->input->post('color_p1')) ? html_escape($this->input->post('color_p1')) : "";
            $data['engraving_p1'] = (FALSE != $this->input->post('engraving_p1')) ?  html_escape($this->input->post('engraving_p1')) : "";
            $data['color_p2'] = (FALSE != $this->input->post('color_p2')) ? html_escape($this->input->post('color_p2')) : "";
            $data['engraving_p2'] = (FALSE != $this->input->post('engraving_p2')) ?  html_escape($this->input->post('engraving_p2')) : "";
            $data['color_p3'] = (FALSE != $this->input->post('color_p3')) ? html_escape($this->input->post('color_p3')) : "";
            $data['engraving_p3'] = (FALSE != $this->input->post('engraving_p3')) ?  html_escape($this->input->post('engraving_p3')) : "";
            if ($this->_update_buyer_info($pledge_id, $data)) {
                $this->send_check_mail_by_pledge_id($pledge_id);
                $this->_load_result_view('Success, thank you');
                return;
            } else {
                $this->_load_result_view();
                return;
            }
        } else {
            $this->_load_result_view();
        }
	}

    public function send_check_mail() {
        $buyers = $this->Subscribe_model->get_indiegogo_mails_and_pledge_id();
        $mail_subject = 'Indiegogo Order Confirm of ERI smart wristband from DigiCare';
        foreach ($buyers as $buyer) {
            $show = $this->_load_show($buyer);
            echo $show;
            //$this->email->send_mail($buyer->email, $mail_subject, $show, HTML_EMAIL_TYPE);
        }
        //echo "finished";
    } 

    public function send_check_mail_by_pledge_id($id) {
        $buyer = $this->Subscribe_model->get_indiegogo_mails_and_pledge_id_by_id($id);
        $mail_subject = 'Indiegogo Order Confirm of ERI smart wristband from DigiCare';
        $show = $this->_load_show($buyer);
        $this->email->send_mail($buyer->email, $mail_subject, $show, HTML_EMAIL_TYPE);
    } 

    private function _get_perk_info($perk) {
        $perk_info;
        if ($perk == "ERI") {
            $perk_info = "One of any color ERI with engraving";
        } else if ($perk == "Early Bird") {
            $perk_info = "One Black ERI without engraving";
        } else if ($perk == "Gift") {
            $perk_info = "One of any color ERI without engraving";
        } else if ($perk == "Discoverer") {
            $perk_info = "One Black or White ERI without engraving";
        } else if ($perk == "Fashion Plate") {
            $perk_info = "One of any color ERI without engraving";
        } else if ($perk == "Couple") {
            $perk_info = "Two of any color ERI with engraving";
        } else if ($perk == "Family") {
            $perk_info = "Three of any color ERI with engraving";
        }
        return $perk_info;

    }
    private function _get_buyer_by_pledge_id($pledge_id) {
        $this->db->where('pledge_id', $pledge_id);
        $query = $this->db->get('t_indiegogo_buyer');
        if ($query->num_rows()) return $query->row(); 
        return null;
    }

    private function _get_buyer_by_email_and_md5_id($email, $id) {
        $this->db->where('email', $email);
        $query = $this->db->get('t_indiegogo_buyer');
        if ($query->num_rows()) { 
            foreach ($query->result() as $row) {
                if (md5($row->pledge_id) == $id) return $row;
            }
        }
        return null;
    }

    private function _update_buyer_info($pledge_id, $data) {
        $this->db->where('pledge_id', $pledge_id);
        return $this->db->update('t_indiegogo_buyer', $data);
    }

    private function _load_blank_view($buyer) {
        $data = array('result' => '', 'buyer' => $buyer);
        $this->load->view('indiegogo/base_info', $data);
        if ($buyer->perk == 'ERI') {
            $this->_load_color('p1');
        }
        if ($buyer->perk == 'Gift') {
            $this->_load_color('p1');
        }
        if ($buyer->perk == 'Early Bird') {
            $this->_load_color('p1');
        }
        if ($buyer->perk == 'Fashion Plate') {
            $this->_load_color('p1');
        }
        if ($buyer->perk == 'Discoverer') {
            $this->_load_color('p1');
        }
        if ($buyer->perk == 'Couple') {
            $this->_load_color('p1');
            $this->_load_color('p2');
        }
        if ($buyer->perk == 'Family') {
            $this->_load_color('p1');
            $this->_load_color('p2');
            $this->_load_color('p3');
        }
        $this->load->view('indiegogo/footer');
    }

    private function _load_show($buyer) {
        return $this->load->view('indiegogo/show',
             array(
                'buyer' => $this->_get_buyer_by_pledge_id($buyer->pledge_id),
                'perk_info' => $this->_get_perk_info($buyer->perk)
             ), true);
    }

    private function _load_email($pledge_id, $result="") {
        $this->load->view('indiegogo/email', array('pledge_id' => $pledge_id, 'result' => $result));
    }

    private function _load_color($p) {
        $this->load->view('indiegogo/color', array('p' => $p));
    }

    private function _load_result_view($result = 'Error appear') {
        $this->load->view('result', array('result' => $result));
    }
}

/* End of file home.php */
/* Location: ./application/indiegogo/check.php */
