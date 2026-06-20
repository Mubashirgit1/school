<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Inventoryitem_model extends CI_Model {
	
		public function get($id = null) {
	        $this->db->select('inventory_items.id,inventory_items.quantity,inventory_items.amount,inventory_items.note,inventory_head.inventory_title,inventory_items.inv_head_id')->from('inventory_items');
	        $this->db->join('inventory_head', 'inventory_items.inv_head_id = inventory_head.id');
	        if ($id != null) {
	            $this->db->where('inventory_items.id', $id);
	        } else {
	            $this->db->order_by('inventory_items.id', 'DESC');
	        }
	        $this->db->limit('20');
	        $query = $this->db->get();
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

	        // getting expense details
	        $inv_det = $this->get($id);
	        // get ammount
	        $inv_amount = $inv_det['amount'];
	        $inv_amount = 0 - $inv_amount;
	        // update transaction in with the amount
	        
	        //$this->transaction_model->addTransaction( "Removed (" . $exp_det['name'] . ") expense", 0, $exp_amount );

	        // default code
	        $this->db->where('id', $id);
	        $this->db->delete('inventory_items');
	    }

	    /**
	     * This function will take the post data passed from the controller
	     * If id is present, then it will do an update
	     * else an insert. One function doing both add and edit.
	     * @param $data
	     */
	    public function add( $data ) {
	        if ( isset( $data['id'] ) ) {
	            $this->db->where( 'id', $data['id'] );
	            $this->db->update( 'inventory_items', $data );
	        } else {

	            $inventory_head = $this->inventoryhead_model->get( $data['inv_head_id'] );
	            $inv_id = $data['inv_head_id'];
	            $stk_data = array(
	            	'inventory_head_id' => $inv_id,
	            	'quantity' => $data['quantity'],
					'amount' => $data['amount'],
					
	            	'type' => 'addition'
	            );
	            $this->inventoryhead_model->addStock($stk_data);

	            //$_transaction_name = $inventory_head['inventory_title'];
	            // adding expense to the transactions table
	            //$this->transaction_model->addTransaction( $_transaction_name, 0, $data['amount'] );

	            // default
	            $query = $this->db->query("SELECT * FROM inventory_items WHERE `inv_head_id` = '$inv_id'");
	            
	            if($query->num_rows() == 0) {
					$this->db->insert( 'inventory_items', $data );
	            } else {
	            	$this->db->query("UPDATE inventory_items SET `quantity` = (quantity + '".$data['quantity']."'), `amount` = (amount + '".$data['amount']."'), `note` = '".$data['note']."'  WHERE `inv_head_id` = '".$data['inv_head_id']."' ");
	            }
	            
	            return $this->db->insert_id();
	        }
	    }

	    public function issueItem($data) {
	    	$item_id = $data['inv_head_id'];

	    	$queryd = $this->db->query("SELECT * FROM inventory_items WHERE `inv_head_id` = '$item_id'");
	    	$qrow = $queryd->row_array();
	    	
	    	if($qrow['quantity'] > 0) {
			$this->db->query("UPDATE inventory_items SET `quantity` = (quantity - '".$data['quantity']."') WHERE `inv_head_id` = '".$data['inv_head_id']."' ");

		    	$inv_id = $data['inv_head_id'];
	            $stk_data = array(
	            	'inventory_head_id' => $inv_id,
	            	'quantity' => $data['quantity'],
	            	'amount' => '0',
	            	'type' => 'deduction'
	            );
            	$this->inventoryhead_model->addStock($stk_data);
            	return true;
	    	} else {
	    		return false;
	    	}

	    	
	    }

	    public function check_Exits_group($data) {
	        $this->db->select('*');
	        $this->db->from('expenses');
	        $this->db->where('session_id', $this->current_session);
	        $this->db->where('feetype_id', $data['feetype_id']);
	        $this->db->where('class_id', $data['class_id']);
	        $this->db->limit(1);
	        $query = $this->db->get();
	        if ($query->num_rows() == 1) {
	            return false;
	        } else {
	            return true;
	        }
	    }
	
	}
	
	/* End of file Inventoryitem_model.php */
	/* Location: ./application/models/Inventoryitem_model.php */
?>