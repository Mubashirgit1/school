<?php

class Staff_model extends CI_Model
{

    public $table_name = 'staff';

    public function __construct()
    {
        parent::__construct();

        //$this->keepUpdatingStaffSalary();
    }

    public function get( $id = null, $name = null )
    {
        $this->db->select( "*" )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'name', 'ASC' );
        }

        if ( $name !== null ) {
            $this->db->like( 'name', $name, 'both' );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            $rows = $q->result_array();
            for ( $i = 0; $i < count( $rows ); $i++ ) {
                $rows[$i]['staff_department_details'] = $this->staff_departments_model->get( $rows[$i]['staff_department_id'] );
            }

            if ( $id !== null ) {
                return $rows[0];
            } else {
                return $rows;
            }

        } else {
            return false;
        }
    }
	
	 public function get2( $id = null, $name = null, $staff_type=null )
    {
        $this->db->select( "*" )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'name', 'ASC' );
        }

        if ( $name !== null ) {
            $this->db->like( 'name', $name, 'both' );
        }

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            $rows = $q->result_array();
            for ( $i = 0; $i < count( $rows ); $i++ ) {
                $rows[$i]['staff_department_details'] = $this->staff_departments_model->get( $rows[$i]['staff_department_id'] );
            }
			
			
			
		if ( $staff_type  == 'active' ) {
			
	    $this->db->where( 'active', 1 );
		}else{
		$this->db->where( 'active', 0 );
		}

            if ( $id !== null ) {
                return $rows[0];
            } else {
                return $rows;
            }

        } else {
            return false;
        }
    }
	
	
	public function resign( $id )
    {
			
        $this->db->trans_start();
        $date = date('Y-m-d',strtotime('first day of +1 month'));
        $data = array(
            'active' => 0,
            'updated_at' => $date,
        );
        $this->db->where( 'id', $id );
        $this->db->update( 'staff', $data );
        $data1 = array(
            'is_active'     => 'no',
        );
        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'staff' );
        $this->db->update( 'users',$data1 );
        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            return false;
        } else {
            return true;
        }
    }



    public function rejoin( $id )
    {
		
		
			
        $this->db->trans_start();
        $date = date('Y-m-d',now());
        $data = array(
            'active' => 1,
            'updated_at' => $date,
			'joining_date' => $date,
			
        );
        $this->db->where( 'id', $id );
        $this->db->update( 'staff', $data );
        $data1 = array(
            'is_active'     => 'yes',
        );
        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'staff' );
        $this->db->update( 'users',$data1 );
        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            return false;
        } else {
            return true;
        }
    }

	
	public function getTotalStaff()
    {
        $sql = "SELECT count(*) as `total_staff` FROM `staff`";
        $query = $this->db->query( $sql );
        return $query->row();
    }

    public function last_payment( $staff_id = null, $date = null )
    {
        $this->db->select( "*" )
            ->from( 'staff_salary_payments' )
            ->order_by( 'payment_date', 'desc' )
            ->limit( 1 );

        if ( $staff_id !== null ) {
            $this->db->where( 'staff_id', $staff_id );
        }

        if ( $date !== null ) {
            $this->db->like( 'payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $q = $this->db->get();

        return $q->row_array();
    }
   
    public function add( $data )
    {
		
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'staff', $data );
        } else {
            $this->db->insert( 'staff', $data );
            return $this->db->insert_id();
        }
    }

    public function payment_get( $staff_id = null, $date = null )
    {
        $this->db->select( "*" )
            ->from( 'staff_salary_payments' )
            ->order_by( 'payment_date', 'desc' );
        

        if ( $staff_id !== null ) {
            $this->db->where( 'staff_id', $staff_id );
        }

        if ( $date !== null ) {
            $this->db->like( 'payment_date', date( 'Y-m-', strtotime( $date ) ), 'after' );
        }

        $q = $this->db->get();

        return $q->row_array();
    }

    public function sum_staff_salary()
    {
        $q = $this->db->select_sum( 'salary', 'salary_sum' )
            ->select_sum( 'due_salary', 'due_salary_sum' )
            ->from( $this->table_name )
            ->get();

        $sm = $q->row_array();

        return $sm;
    }

    public function keepUpdatingStaffSalary()
    {

        $q = $this->db->select( "*" )
            ->from( 'staff' )
            ->where( "YEAR(`salary_update_date`) <", date( 'Y', now() ) )
            ->or_where( 'MONTH(`salary_update_date`) <', date( 'm', now() ) )
            ->get();

        if ( $q->num_rows() > 0 ) {

            $rows = $q->result_array();

            foreach ( $rows as $row ) {

                $salary = intval( $row['salary'] );
                $due_salary = intval( $row['due_salary'] );

                $due_salary += $salary;

                $this->db->update( 'staff', [
                    'due_salary' => $due_salary,
                    'salary_update_date' => date( 'Y-m-01', now() )
                ], [
                    'id' => $row['id']
                ] );

            }

        }
    }

}