<?php

class Subscribe_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        return $this->db->insert('t_subscribes', $data);
    }
    
    public function is_email_register($email) {
        $this->db->where('mail', $email);
        if ($this->db->get('t_subscribes')->num_rows() > 0)
            return true;
        return false;
    }
    
    public function get_subscribe_mails() {
        $result = array();
        $this->db->select('mail');
        $query = $this->db->get(T_SUBSCRIBES);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $result[] = $row->mail;
            }
        }
        return $result;
    }

    public function get_indiegogo_user_mails() {
        $result = array();
        $this->db->select('email');
        $query = $this->db->get(T_INDIEGOGO);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $result[] = $row->email;
            }
        }
        return $result;
    }
    
    public function get_indiegogo_mails_and_pledge_id() {
        $result = array();
        $this->db->select('email, pledge_id, perk');
        $this->db->where('perk !=', 'International Shipping');
        $this->db->where('perk !=', 'Hong Kong SAR Shipping');
        $this->db->where('perk !=', 'Friendly Sponsorship');
        //$this->db->where('pledge_id', '4955825');
        $this->db->where('pledge_id', '23458');
        $query = $this->db->get(T_INDIEGOGO);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function get_indiegogo_mails_and_pledge_id_by_id($id) {
        $this->db->select('email, pledge_id, perk');
        $this->db->where('pledge_id', $id);
        $query = $this->db->get(T_INDIEGOGO);
        return $query->row();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                if (md5($row->pledge_id) == $id) return $row;
            }
        }
        return $result;
    }
}

/* End of file */
