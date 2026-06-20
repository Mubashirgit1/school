<?php

class Transactions_model extends CI_Model
{
    public function get( $date = null, $date_from = null, $date_to = null )
    {
        $sql = "SELECT `name`, SUM(`amount`) AS amount, `type`, `transaction_date`, head FROM ( ( SELECT 'Fee Payment Received' AS name, `total_paid_fee` AS amount, 'in' AS type, `payment_date` AS transaction_date, 'fee' AS head FROM `student_fee_payments` ) UNION ALL ( SELECT expense_head.exp_category AS name, expenses.amount AS amount, 'out' AS type, expenses.date AS transaction_date, 'expense' AS head FROM `expenses` INNER JOIN expense_head ON expense_head.id = expenses.exp_head_id ) UNION ALL ( SELECT 'Teacher Salary Payments' as name, `paid_salary` as amount, 'out' as type, `teacher_salary_payment_date` AS transaction_date, 'salary' AS head FROM teacher_salary_payments ) UNION ALL ( SELECT inventory_head.inventory_title AS name, inventory_stock.amount AS amount, 'out' AS type, DATE(inventory_stock.created_at) AS transaction_date, 'inventory' AS head FROM `inventory_stock` INNER JOIN inventory_head ON inventory_head.id = inventory_stock.inventory_head_id ) UNION ALL ( SELECT 'Staff Salary Payment' AS name, `paid_salary` AS amount, 'out' AS type, `payment_date` AS transaction_date, 'staff_salary' AS head FROM staff_salary_payments ) ) t";
        $bind = [];

        if ( $date !== null || $date_from !== null || $date_to !== null ) {
            $sql .= " WHERE ";

            if ( $date_from !== null && $date_to !== null ) {
                $date_from = date( "Y-m-d", strtotime( $date_from ) );
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
                $sql .= "t.transaction_date >= " . $this->db->escape( $date_from.' 00:00:00' ) . " AND t.transaction_date <= " . $this->db->escape( $date_to.' 23:59:59' );
            } else {
                $sql .= "t.transaction_date = " . $this->db->escape( $date );
            }
        }

        $sql .= " GROUP BY t.name ORDER BY t.transaction_date ASC";

        $q = $this->db->query( $sql, $bind );

        if ( $q->num_rows() > 0 ) {
            
            return $q->result_array();
        } else {
            return false;
        }
    }

    public function get3( $date = null, $date_from = null, $date_to = null )
    {
        $sql = "SELECT `name`, SUM(`amount`) AS amount, `type`, `transaction_date`, head FROM ( ( SELECT expense_head.exp_category AS name, expenses.amount AS amount, 'out' AS type, expenses.date AS transaction_date, 'expense' AS head FROM `expenses` INNER JOIN expense_head ON expense_head.id = expenses.exp_head_id ) UNION ALL ( SELECT 'Teacher Salary Payments' as name, `paid_salary` as amount, 'out' as type, `teacher_salary_payment_date` AS transaction_date, 'salary' AS head FROM teacher_salary_payments ) UNION ALL ( SELECT inventory_head.inventory_title AS name, inventory_stock.amount AS amount, 'out' AS type, DATE(inventory_stock.created_at) AS transaction_date, 'inventory' AS head FROM `inventory_stock` INNER JOIN inventory_head ON inventory_head.id = inventory_stock.inventory_head_id ) UNION ALL ( SELECT 'Staff Salary Payment' AS name, `paid_salary` AS amount, 'out' AS type, `payment_date` AS transaction_date, 'staff_salary' AS head FROM staff_salary_payments ) ) t";
        $bind = [];

        if ( $date !== null || $date_from !== null || $date_to !== null ) {
            $sql .= " WHERE ";

            if ( $date_from !== null && $date_to !== null ) {
                $date_from = date( "Y-m-d", strtotime( $date_from ) );
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
                $sql .= "t.transaction_date >= " . $this->db->escape( $date_from.' 00:00:00' ) . " AND t.transaction_date <= " . $this->db->escape( $date_to.' 23:59:59' );
            } else {
                $sql .= "t.transaction_date = " . $this->db->escape( $date );
            }
        }

        $sql .= " GROUP BY t.name ORDER BY t.transaction_date ASC";

        $q = $this->db->query( $sql, $bind );

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }

    public function get2( $date = null, $date_from = null, $date_to = null )
    {
        $sql = "SELECT `name`, SUM(`amount`) AS amount, `type`, `transaction_date`, head FROM ( ( SELECT 'Fee Payment Received' AS name, `total_paid_fee` AS amount, 'in' AS type, `payment_date` AS transaction_date, 'fee' AS head FROM `student_fee_payments` )  ) t";
        $bind = [];

        if ( $date !== null || $date_from !== null || $date_to !== null ) {
            $sql .= " WHERE ";

            if ( $date_from !== null && $date_to !== null ) {
                $date_from = date( "Y-m-d", strtotime( $date_from ) );
                $date_to = date( 'Y-m-d', strtotime( $date_to ) );
                $sql .= "t.transaction_date >= " . $this->db->escape( $date_from.' 00:00:00' ) . " AND t.transaction_date <= " . $this->db->escape( $date_to.' 23:59:59' );
            } else {
                $sql .= "t.transaction_date = " . $this->db->escape( $date );
            }
        }

        $sql .= " GROUP BY t.name ORDER BY t.transaction_date ASC";

        $q = $this->db->query( $sql, $bind );

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('account');
    }
	
	public function remove_bank($id) {
        $this->db->where('id', $id);
        $this->db->delete('bank_transfer');
    }

    public function get_account($id = null,$type = null,$name = null) {   
	    $this->db->select()->from('account');
        if ($id != null) {
            $this->db->where('account.id', $id);
        } else {
            $this->db->order_by('account.id');
        }
		if ($type != null) {
            $this->db->where('account.type', $type);
        }
        if ($name != null) {
            $this->db->where('account.name', $name);
        }
	    $query = $this->db->get();
        if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
    }
	
    public function get_bank_transfer($id = null,$date_from = null,$date_to = null) {        
           $this->db->select( '*' )
            ->from( 'bank_transfer' );
	
	    if ($id != null) {
            $this->db->where('bank_transfer.id', $id);
        } else {
            $this->db->order_by('bank_transfer.id');
        }
		
		if ( $date_from !== null ) {
            $this->db->where( 'bank_transfer.date >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }

        if ( $date_to !== null ) {
            $this->db->where( 'bank_transfer.date <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }

        $query = $this->db->get();
			
        $result = $query->result_array(); 
        
		$array = array();
		foreach($result as $key => $res){
		
		$array[$key]['id'] = $res['id'];
		$array[$key]['description'] = $res['description'];
		$array[$key]['amount'] = $res['amount'];
		$array[$key]['name'] = $res['name'];
		$array[$key]['type'] = $res['type'];
		$array[$key]['date'] = $res['date'];
		$array[$key]['debit']     = $this->transactions_model->get_account($res['debit']);
		$array[$key]['credit']     = $this->transactions_model->get_account($res['credit']);
		}
		    
			return $array;
		
    }

    public function get_bank($id = null,$date_from = null,$date_to = null) {        
           $this->db->select( '*' )
            ->from( 'bank_transfer' );
	
	    if ($id != null) {
            $this->db->where('bank_transfer.id', $id);
        } else {
            $this->db->order_by('bank_transfer.id');
        }
		
        $query = $this->db->get();
			
        $result = $query->row_array(); 
		
		return $result;
		
    }
	 
	public function get_payment_type($id = null) {        
           $this->db->select( '*' )
            ->from( 'payment_type' );
	
	    if ($id != null) {
            $this->db->where('payment_type.id', $id);
        } else {
            $this->db->order_by('payment_type.id');
        }
		
        $query = $this->db->get();
			
         if ($id != null) {
            return $query->row_array(); 
        } else {
            return $query->result_array(); 
        }
		
    }

    public function get_account_transfer($id = null,$date_from = null,$date_to = null) {        
        $this->db->select()->from('account');
        if ($id != null) {
            $this->db->where('account.id', $id);
        } else {
            $this->db->order_by('account.id');
        }
		
		
        $query = $this->db->get();
            
	    $result = $query->result_array();
	   
	    $array = array();
		foreach($result as $key => $res){
            $array[$key]['id'] = $res['id'];
            $array[$key]['name'] = $res['name'];
            $array[$key]['opening_account'] = $res['opening_account'];
            $array[$key]['date'] = $res['date'];		
            $array[$key]['debit']     = $this->get_transfer($res['id'],'debit',$date_from,$date_to);
            $array[$key]['credit']     = $this->get_transfer($res['id'],'credit',$date_from,$date_to );	
		}
		
		return $array;
		
   }

    public function get_account_transfer_id($id = null,$date_from = null,$date_to = null) {        
        $this->db->select()->from('account');
        if ($id != null) {
            $this->db->where('account.id', $id);
        } else {
            $this->db->order_by('account.id');
        }
		$query = $this->db->get();
	    $result = $query->row_array();
	    $result['debit']     = $this->transactions_model->get_transfer_id($result['id'],$date_from,$date_to);
	    return $result;
		
   }

    public function get_transfer_id($id = null,$date_from = null,$date_to = null ) {   
	       $this->db->select( '*' )
            ->from( 'bank_transfer' );
	    if ($id != null && $date_from !=null && $date_to != null ) {
		$where = ' ( date BETWEEN "'. date('Y-m-d', strtotime($date_from)). '" and "'. date('Y-m-d', strtotime($date_to )).'" ) and ( credit= "'.$id.'" or debit= "'.$id.'" ) ';	
		$this->db->where($where);
		} elseif($id != null ) {
			$this->db->where('bank_transfer.id',$id);
		}else{
		    $this->db->order_by('bank_transfer.id');
			}
	    $query = $this->db->get();
        $result = $query->result_array(); 
		return $result;
    }
 
	public function get_transfer($id = null,$type= null ,$date_from = null,$date_to = null ) {   
           $this->db->select( '*' )
            ->from( 'bank_transfer' );
	    if ($id != null) {
	    if ($type != null && $type == 'debit') {
	        $this->db->where('bank_transfer.debit', $id);
		}else{
	        $this->db->where('bank_transfer.credit', $id);
		}
		if ( $date_from !== null ) {
            $this->db->where( 'bank_transfer.date >=', date( 'Y-m-d', strtotime( $date_from ) ) );
        }
        if ( $date_to !== null ) {
            $this->db->where( 'bank_transfer.date <=', date( 'Y-m-d', strtotime( $date_to ) ) );
        }
	    } else {
            $this->db->order_by('bank_transfer.id');
        }
	    $query = $this->db->get();
        $result = $query->result_array(); 
		return $result;
    }

    public function add_account($data) {
	    if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('account', $data); 
	    } else {
            $this->db->insert('account', $data); 
            return $this->db->insert_id();
        }
    }
	
    public function add_transfer($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('bank_transfer', $data); 
        } else {
            $this->db->insert('bank_transfer', $data); 
            return $this->db->insert_id();
        }
    }
	
    public function getStockHeadName( $hid )
    {
        $result = $this->db->select( 'inventory_title' )->from( 'inventory_head' )->where( 'id', $hid )->get();
        return $result->result();
    }
}