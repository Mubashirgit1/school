<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function add( $data )
    {
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'users', $data );
            return $data;
        } else {
            $this->db->insert( 'users', $data );
            return $this->db->insert_id();
        }
    }
    public function editParent( $data )
    {
        if ( isset( $data['user_id'] ) ) {
            $this->db->where( 'user_id', $data['user_id'] );
            $this->db->where( 'role', 'parent' );
         
            $this->db->update( 'users', $data );
            return $data;
        } else {
            $this->db->insert( 'users', $data );
            return $this->db->insert_id();
        }
    }

    public function editTeacher( $data )
    {
        if ( isset( $data['user_id'] ) ) {
            $this->db->where( 'user_id', $data['user_id'] );
            $this->db->where( 'role', 'teacher' );
            $this->db->update( 'users', $data );
            return $data;
        }
    }
    public function updateParentChild($data){
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'users', $data );
            return $data;
        } else {
            $this->db->insert( 'users', $data );
            return $this->db->insert_id();
        }

    }
    public function checkLogin( $data )
    {
        $this->db->select( 'id, username, password,role,is_active' );
        $this->db->from( 'users' );
        $this->db->where( 'username', $data['username'] );
        $this->db->where( 'password', ( $data['password'] ) );
        $this->db->limit( 1 );
        $query = $this->db->get();
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_user_information( $username )
    {
        $this->db->select( 'users.*,students.firstname,students.lastname,students.guardian_name' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'users.username', $username );
        $this->db->limit( 1 );
        $query = $this->db->get();
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function check_sibling( $father_phone )
    {
        $this->db->select( 'users.*,students.firstname,students.lastname,students.guardian_name' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'students.father_phone', $father_phone );
        $this->db->where( 'users.role', 'parent' );
    
        $this->db->limit( 2 );
        $query = $this->db->get();
     
        if ( $query->num_rows() > 0 ) {
           
            return $query->result_array();
        } else {
           
            return false;
        }
    }
    public function get( $user_id = null )
    {
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'users.role', 'student' );
        $this->db->where( 'users.user_id', $user_id );
    
        $this->db->limit( 2 );
        $query = $this->db->get();
     
        if ( $query->num_rows() > 0 ) {
           
            return $query->result_array();
        } else {
           
            return false;
        }
    }
    public function check_parent_not_exist( $user_id )
    {
        $this->db->select( 'users.*,students.firstname,students.lastname,students.guardian_name' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'users.user_id', $user_id );
        $this->db->where( 'users.role', 'student' );
    
        //$this->db->limit( 2 );
        $query = $this->db->get();
     
        if ( $query->num_rows() > 0 ) {
           
            return $query->result_array();
        } else {
           
            return false;
        }
    }
    public function check_sibling_cnic( $father_cnic )
    {
        $this->db->select( 'users.*,students.firstname,students.lastname,students.guardian_name' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'students.father_cnic', $father_cnic );
        $this->db->where( 'users.role', 'parent' );
    
        $this->db->limit( 2 );
        $query = $this->db->get();
     
        if ( $query->num_rows() > 0 ) {
           
            return $query->result_array();
        } else {
           
            return false;
        }
    }
    public function check_sibling_student( $father_phone )
    {
        $this->db->select( 'users.*,students.firstname,students.lastname,students.guardian_name' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'students.father_phone', $father_phone );
        $this->db->where( 'users.role', 'student' );
    
       // $this->db->limit( 2 );
        $query = $this->db->get();
     
        if ( $query->num_rows() > 0 ) {
           
            return $query->result_array();
        } else {
           
            return false;
        }
    }
    function delete_parents( $id )
    {
            $this->db->where( 'user_id', $id );
            $this->db->where( 'role','parent'  );
            $del = $this->db->delete( 'users' );
            if($del){
                return $del;
            } 
             
    }
    public function read_teacher_information( $username )
    {
        $this->db->select( 'users.*,teachers.name' );
        $this->db->from( 'users' );
        $this->db->join( 'teachers', 'teachers.id = users.user_id' );
        $this->db->where( 'users.username', $username );
        $this->db->limit( 1 );
        $query = $this->db->get();
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_all_teacher(  )
    {
        $this->db->select( 'users.*,teachers.*' );
        $this->db->from( 'users' );
        $this->db->join( 'teachers', 'teachers.id = users.user_id' );
        $this->db->where('users.role' , 'teacher');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function read_accountant_information( $username )
    {
        $this->db->select( 'users.*,accountants.name' );
        $this->db->from( 'users' );
        $this->db->join( 'accountants', 'accountants.id = users.user_id' );
        $this->db->where( 'users.username', $username );
        $this->db->limit( 1 );
        $query = $this->db->get();
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function read_librarian_information( $username )
    {
        $this->db->select( 'users.*,librarians.name' );
        $this->db->from( 'users' );
        $this->db->join( 'librarians', 'librarians.id = users.user_id' );
        $this->db->where( 'users.username', $username );
        $this->db->limit( 1 );
        $query = $this->db->get();
        if ( $query->num_rows() == 1 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkOldUsername( $data )
    {
        $this->db->where( 'id', $data['user_id'] );
        $this->db->where( 'username', $data['username'] );
        $query = $this->db->get( 'users' );
        if ( $query->num_rows() > 0 )
            return TRUE;
        else
            return FALSE;
    }

    public function checkOldPass( $data )
    {
        $this->db->where( 'id', $data['user_id'] );
        $this->db->where( 'password', $data['current_pass'] );
        $query = $this->db->get( 'users' );
        if ( $query->num_rows() > 0 )
            return TRUE;
        else
            return FALSE;
    }

    public function checkUserNameExist( $data )
    {
        $this->db->where( 'role', $data['role'] );
        $this->db->where( 'username', $data['new_username'] );
        $query = $this->db->get( 'users' );
        if ( $query->num_rows() > 0 )
            return TRUE;
        else
            return FALSE;
    }

    public function saveNewPass( $data )
    {
        $this->db->where( 'id', $data['id'] );
        $query = $this->db->update( 'users', $data );
        if ( $query ) {
            return true;
        } else {
            return false;
        }
    }

    public function changeStatus( $data )
    {
        $this->db->where( 'id', $data['id'] );
        $query = $this->db->update( 'users', $data );
        if ( $query ) {
            return true;
        } else {
            return false;
        }
    }

    public function saveNewUsername( $data )
    {
        $this->db->where( 'id', $data['id'] );
        $query = $this->db->update( 'users', $data );
        if ( $query ) {
            return true;
        } else {
            return false;
        }
    }

    public function read_user()
    {
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function read_user_father($father_phone)
    {
        $this->db->select( 'users.*,students.*' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'students.father_phone', $father_phone );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function read_user_father_all()
    {
        $this->db->select( 'users.*,students.*' );
        $this->db->from( 'users' );
        $this->db->join( 'students', 'students.id = users.user_id' );
        $this->db->where( 'users.role','parent'  );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getLoginDetails( $student_id )
    {
        $sql = "SELECT * FROM (select * from users where find_in_set('$student_id',childs) <> 0 union SELECT * FROM `users` WHERE `user_id` = " . $this->db->escape( $student_id ) . " AND `role` != 'teacher' AND `role` != 'librarian' AND `role` != 'accountant') a order by a.role desc";
        $query = $this->db->query( $sql );
        return $query->result();
    }

    public function getTeacherLoginDetails( $teacher_id )
    {
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'user_id', $teacher_id );
        $this->db->where( 'role', 'teacher' );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getLibrarianLoginDetails( $librarian_id )
    {
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'user_id', $librarian_id );
        $this->db->where( 'role', 'librarian' );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAccountantLoginDetails( $accountant_id )
    {
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'user_id', $accountant_id );
        $this->db->where( 'role', 'accountant' );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function user_exists( $username )
    {
        $q = $this->db->get_where('users', [
            'username' => $username
        ]);

        if($q->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

}
