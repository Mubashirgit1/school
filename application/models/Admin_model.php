<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
	 
    public function get($id = null,$type=null) {

        $this->db->select( 'admin.*,admin_permissions.*' )
                ->join( 'admin_permissions', 'admin_permissions.admin_id = admin.id' )
                ->from( 'admin' );

        if ($id != null) {
            $this->db->where('admin.id', $id);
        } else {
            $this->db->order_by('admin.id');
        }
        
        if($type != null){
            $this->db->where('admin.role', 'admin_main');
        }

        $query = $this->db->get();
        // var_dump($this->db->last_query());exit;

        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array(); 
        }

    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('admin');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('admin', $data);
        } else {
            $this->db->insert('admin', $data);
        }
        
        return $this->db->insert_id();

    }

    public function add_permission($data) {
         
        if (isset($data['admin_id'])) {
            $this->db->where('admin_id', $data['admin_id']);
            $this->db->delete('admin_permissions');
            $this->db->insert('admin_permissions', $data);
        }

    }	 
	 
    public function checkLogin($data) { 
        $this->db->select('id, username, password');
        $this->db->from('admin');
        $this->db->where('email', $data['username']);
        $this->db->where('password', MD5($data['password']));
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_user_information($email) {
        $this->db->select( 'admin.*,admin_permissions.delete_fee,admin_permissions.other_voucher_fine,admin_permissions.academics,admin_permissions.arrears_adjust,admin_permissions.balancesheet_figures,admin_permissions.daily_delete,admin_permissions.fine,admin_permissions.submission,admin_permissions.school_message,admin_permissions.voucher_details,admin_permissions.expiry_date,admin_permissions.admin_fee_message,admin_permissions.advance_leave,admin_permissions.vr_due_fine,admin_permissions.admission_roll' )
                ->join( 'admin_permissions', 'admin_permissions.admin_id = admin.id' )
                ->from( 'admin' );
        $condition = "email =" . "'" . $email . "'";
        
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function change_password($data) {
        $condition = "id =" . "'" . $data['id'] . "'";
        $this->db->select('password');
        $this->db->from('admin');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkOldPass($data) {
        $this->db->where('id', $data['user_id']);
        $this->db->where('password', $data['current_pass']);
        $this->db->where('email', $data['user_email']);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function saveNewPass($data) {
        $this->db->where('id', $data['id']);
        $query = $this->db->update('admin', $data); 
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function saveForgotPass($data) {
        $this->db->where('email', $data['email']);
        $query = $this->db->update('admin', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }    

    public function addReceipt($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('fee_receipt_no', $data);
        } else {
            $this->db->insert('fee_receipt_no', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    public function getMonthlyCollection() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount+amount_fine-amount_discount) as amount,MONTH(date) as month ,YEAR(date) as year FROM student_fees where YEAR(date) BETWEEN " . $this->db->escape($data_first) . " and " . $this->db->escape($data_second) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMonthlyExpense() {
        $data = explode("-", $this->current_session_name);
        $data_first = $data[0];
        $data_second = substr($data_first, 0, 2) . $data[1];
        $this->start_month;
        $sql = "SELECT SUM(amount) as amount,MONTH(date) as month ,YEAR(date) as year FROM expenses where YEAR(date) BETWEEN " . $this->db->escape($data_first) . " and " . $this->db->escape($data_second) . " GROUP BY MONTH(date)";
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

    public function getCollectionbyDay($date) {
        $sql = 'SELECT SUM(amount+amount_fine-amount_discount) as amount FROM student_fees where date=' . $this->db->escape($date);
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getExpensebyDay($date) {
        $sql = 'SELECT SUM(amount) as amount FROM expenses where date=' . $this->db->escape($date);
        
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

}
