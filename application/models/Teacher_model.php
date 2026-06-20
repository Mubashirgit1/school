<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Teacher_model extends CI_Model
{

    public $table_name = "teachers";

    public function __construct()
    {
        parent::__construct();
        //$this->keepUpdatingDueSalaries();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get( $id = null, $teacher_name = null )
    {

        $this->db->select()->from( 'teachers' );
        if ( $id != null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id' );
        }

        if ( $teacher_name !== null ) {
            $this->db->like( 'name', $teacher_name, 'both' );
        }
        $this->db->where( 'active', 1 );
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
    public function get3( $id = null, $teacher_name = null )
    {
        $this->db->select()->from( 'teachers' );
        if ( $id != null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id' );
        }

       $this->db->where( 'active', 1 );
	   
        if ( $teacher_name !== null ) {
            $this->db->like( 'name', $teacher_name, 'both' );
        }
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function get2( $id = null, $teacher_name = null, $teacher_type  )
    {
        $this->db->select()->from( 'teachers' );
        if ( $id != null ) {
            $this->db->where( 'id', $id );
        } else {
            $this->db->order_by( 'id' );
        }
       if ( $teacher_type  == 'active' ) {
			
	    $this->db->where( 'active', 1 );
		}else{
		
		$this->db->where( 'active', 0 );
		
			
	   }
		
	
	 
	    if ( $teacher_name !== null ) {
            $this->db->like( 'name', $teacher_name, 'both' );
        }
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
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
        $this->db->update( 'teachers', $data );
        $data1 = array(
            'is_active'     => 'no',
        );
        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'teacher' );
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
			'joining_date'=> $date,
        );
        $this->db->where( 'id', $id );
        $this->db->update( 'teachers', $data );
        $data1 = array(
            'is_active'     => 'yes',
        );
        $this->db->where( 'user_id', $id );
        $this->db->where( 'role', 'teacher' );
        $this->db->update( 'users',$data1 );
        $this->db->trans_complete();

        if ( $this->db->trans_status() === FALSE ) {
            return false;
        } else {
            return true;
        }
    }


    public function TGetid()
    {
        $this->db->select_max('teacher_id');
        $result = $this->db->get('teachers')->row();  
        return $result->teacher_id;
    }

    public function getTeacher( $id = null )
    {
        $this->db->select( 'teachers.*,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`' );
        $this->db->from( 'teachers' );
        $this->db->join( 'users', 'users.user_id = teachers.id', 'inner' );
        $this->db->where( 'users.role', 'teacher' );
        $query = $this->db->get();
        if ( $id != null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }


    public function getLibraryTeacher()
    {
        $this->db->select( 'teachers.*, IFNULL(libarary_members.id,0) as `libarary_member_id`, IFNULL(libarary_members.library_card_no,0) as `library_card_no`' )->from( 'teachers' );

        $this->db->join( 'libarary_members', 'libarary_members.member_id = teachers.id and libarary_members.member_type = "teacher"', 'left' );

        $this->db->order_by( 'teachers.id' );

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'teachers' );
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add( $data )
    {
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'teachers', $data );
        } else {
            $this->db->insert( 'teachers', $data );
            return $this->db->insert_id();
        }
    }
	
	
	
       public function updateteacher($data )
      { 
       if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'teachers', $data );
        } else {
            $this->db->insert( 'teachers', $data );
            return $this->db->insert_id();
        }
		
		   /*
        $this->db->where('teacher_salary_payment_id',$data['id']);
	 
        $this->db->update('teacher_salary_payments', $data);
 */
   
           /*  $name=$data['name'];
            $date=$data['paid_salary'];
            $salary=$data['teacher_salary_payment_date'];
		    $id=$data['id'];
			 $query=
             $this->db->set('teachers.name',$name);
             $this->db->set('teacher_salary_payments.teacher_salary_payment_date',$date);
			 $this->db->set('teacher_salary_payments.paid_salary',$salary);
     

             $this->db->where('teachers.id',$id);
             $this->db->where('teacher_salary_payments.teacher_id',$id);
			 $this->db->join('teachers', 'teachers.id = teacher_salary_payments.teacher_id '); 
			 $this->db->update('teachers',$data);
			
           */


     }
	 
	
	
	
	

    public function getTotalTeacher()
    {
        $sql = "SELECT count(*) as `total_teacher` FROM `teachers`";
        $query = $this->db->query( $sql );
        return $query->row();
    }

    /**
     * Fetch teachers whose record has been updated previous month
     * @return bool|array Bool false or row of teachers
     */
    public function getTeachersBasedOnSalaryUpdate()
    {
        // get teacher details whose salary was updated previous month
        $this->db->select( '*' )->from( $this->table_name )
            ->where( 'YEAR(`salary_update_date`) <', date( 'Y', now() ) )
            ->or_where( 'MONTH(`salary_update_date`) <', date( 'm', now() ) );

        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }


   


   public function getCurrentMonthAttendance( $teacher_id = null, $teacher_attendance_type = null, $month = null, $year = null )
    {
        $this->db
            ->select( '*' )
            ->from( 'teacher_attendance' )
            ->join( 'teacher_attendence_types', 'teacher_attendence_types.teacher_attendence_type_id = teacher_attendance.teacher_attendence_type_id' );

        if ( $teacher_id !== null ) {
            $this->db->where( 'teacher_attendance.teacher_attendance_id', $teacher_id );
        }

        if ( $teacher_attendance_type !== null ) {
            $this->db->where( 'teacher_attendence_types.teacher_attendence_type_name', $teacher_attendance_type );
        }

        if ( $month !== null ) {
            $this->db->where( 'MONTH(teacher_attendance.attendance_date)', $month );
        }

        if ( $year !== null ) {
            $this->db->where( 'YEAR(teacher_attendance.attendance_date)', $year );
        }

        $q = $this->db->get();

        return $q->result_array();
    }

    public function countCurrentMonthAttendance( $teacher_id = null, $teacher_attendance_type = null, $month = null, $year = null )
    {
        return count( $this->getCurrentMonthAttendance( $teacher_id, $teacher_attendance_type, $month, $year ) );
    }

    public function keepUpdatingDueSalaries()
    {
        $teachers = $this->getTeachersBasedOnSalaryUpdate();

        if ( $teachers !== false ) {

            foreach ( $teachers as $teacher ) {

                $due_salary = intval( $teacher['due_salary'] );

                $this_month_date = date( 'Y-m-01', now() );

                $salary_update_date = new DateTime( $this_month_date );
                $salary_update_date = $salary_update_date->format( 'Y-m-d' );

                $previous_month_start = new DateTime( $this_month_date );
                $previous_month_start->sub( new DateInterval( 'P1M' ) );

                $teacher_type_name = $this->teacher_type_model->get( $teacher['teacher_type_id'] );
                $teacher_type_name = $teacher_type_name['teacher_type_name'];
                $teacher_salary = intval( $teacher['teacher_salary'] );

                // if teacher type is permanent.
                // finding permanent is not false in the string
                if ( strpos( $teacher_type_name, 'permanent' ) !== false ) {

                    // get number of allowed absents
                    $teachers_max_leaves_in_month = $this->custom_option_model->get( 'teachers_max_leaves_in_month' );
                    $teachers_max_leaves_in_month = intval( $teachers_max_leaves_in_month['value'] );

                    // get percentage of the amount that will be deducted
                    $teachers_salary_deduction_per_leave = $this->custom_option_model->get( 'teachers_salary_deduction_per_leave' );
                    $teachers_salary_deduction_per_leave = intval( $teachers_salary_deduction_per_leave['value'] );

                    // Get total absents.
                    $total_absents = $this->countCurrentMonthAttendance( $teacher['id'], 'absent', $previous_month_start->format( 'n' ), $previous_month_start->format( 'Y' ) );

                    // subtract number of allowed absents
                    $final_absents = $total_absents - $teachers_max_leaves_in_month;

                    // if value is lower than 0 set it to 0
                    $final_absents = ( $final_absents < 0 ? 0 : $final_absents );

                    // get one day salary
                    $one_day_salary = intval( $teacher['teacher_salary'] ) / 30;

                    // get percentage of one day's salary
                    $one_day_salary_percentage_amount = ( $teachers_salary_deduction_per_leave / 100 ) * $one_day_salary;

                    // Multiplying one day salary to extra absents.
                    // if it is 0 then all of the amount will be changed to 0.
                    $one_day_salary_percentage_amount *= $final_absents;

                    // subtract from due salary
                    $due_salary = $due_salary + ( $teacher_salary - $one_day_salary_percentage_amount );

                } else { // teacher type is lecture based

                    $total_attended_lectures = $this->teacher_attendance_model->total_attended_lectures_in_month( $teacher['id'], $previous_month_start->format( 'Y-m-d' ) );

                    $teacher_salary = $teacher_salary * $total_attended_lectures;

                    $due_salary = $due_salary + $teacher_salary;

                }

                $eobi = $this->custom_option_model->get('eobi');
                
                $eobi =  $teacher['teacher_eobi'] + $eobi['value'];

                $this->db->update( $this->table_name, array(
                    'due_salary' => $due_salary,
                    'teacher_eobi' => $eobi,
                    'salary_update_date' => $salary_update_date
                ), array(
                    'id' => $teacher['id']
                ) );

            }

        }
    }

    public function sum_teachers_salary()
    {
        $q = $this->db->select_sum( 'teacher_salary', 'teacher_salary_sum' )
            ->select_sum( 'due_salary', 'due_salary_sum' )
            ->from( $this->table_name )
            ->get();

        $sm = $q->row_array();

        $sm['teacher_salary_sum'] = intval( $sm['teacher_salary_sum'] );
        $sm['due_salary_sum'] = intval( $sm['due_salary_sum'] );

        return $sm;

    }

}
