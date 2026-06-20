<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

class Classsection_model extends CI_Model
{

    public $table_name = "class_sections";

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
    public function get( $classid = null )
    {
        $this->db->select( 'class_sections.id,class_sections.section_id,sections.section' );
        $this->db->from( 'class_sections' );
        $this->db->join( 'sections', 'sections.id = class_sections.section_id' );
        $this->db->where( 'class_sections.class_id', $classid );
        $this->db->order_by( 'class_sections.id' );
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_teacher_class( $teacher_id = null )
    {
        $this->db->select( 'classes.class,class_sections.id,class_sections.section_id,class_sections.class_id,sections.section' );
        $this->db->from( 'class_sections' );
        $this->db->join( 'classes', 'classes.id = class_sections.class_id', 'inner' );
        $this->db->join( 'sections', 'sections.id = class_sections.section_id' );
        
        $this->db->join('teacher_subjects' , 'teacher_subjects.class_section_id  =  class_sections.id');
        $this->db->where( 'teacher_subjects.teacher_id', $teacher_id );
        $this->db->order_by( 'class_sections.id' );
        $this->db->group_by('class_sections.class_id'); 
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_class_section_incharge_teacher()
    {
        $q = $this->db->select( 'classes.class, sections.section, class_sections.class_incharge_teacher_id' )
            ->from( 'class_sections' )
            ->join( 'classes', 'classes.id = class_sections.class_id', 'inner' )
            ->join( 'sections', 'sections.id = class_sections.section_id', 'inner' )
            ->get();

        if ( $q->num_rows() > 0 ) {
            return $q->result_array();
        } else {
            return false;
        }
    }


    public function update( $data )
    {

        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'classes', $data );
        }
    }

    public function check_order($data){
        $this->db->select( '*' )
        ->from( 'class_sections' )
        ->where( 'class_sections.order_by', $data['order_by'] );
        $q = $this->db->get();
        if ( $q->num_rows() > 0 ){
            return true; 
        }else{
            return false; 
        }
    }

    public function updateOrder( $data )
    {
        $this->db->where( 'id', $data['id'] );
        $this->db->set( 'order_by', $data['order_by'] );
        $update =     $this->db->update( 'class_sections', $data );
        return $update;
    }
    


    public function update_class_fee( $data )
    {
	
	  $this->db->insert( 'class_fee_update', $data );		
	
	}
	
	   public function get_class_date($class_id )
      {
        $this->db->select( "*" )
            ->from( 'class_fee_update' )
			->order_by('date', 'desc')
		    ->limit(1)
            ->where( 'class_id', $class_id );

         $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {
            return $q->row_array();
        } else {
            return false;
        }
    }
	
	public function get_class_update_fee($class_id= null, $date=null )
    {
        $this->db->select( '*' );
		$this->db->from( 'class_fee_update' );
		if($class_id != null){
			$this->db->where('class_id', $class_id);
			}
		if($date != null){
			$this->db->where('date', $date);
			}
		$query = $this->db->get();
        return $query->result_array();
    }

	

    public function add( $data, $sections )
    {
        $this->db->trans_begin();
        if ( isset( $data['id'] ) ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'classes', $data );
            $class_id = $data['id'];

        } else {
            $this->db->insert( 'classes', $data );
            $class_id = $this->db->insert_id();
        }


        $sections_array = array();
        foreach ( $sections as $vec_key => $vec_value ) {

            $vehicle_array = array(
                'class_id' => $class_id,
                'section_id' => $vec_value,
            );

            $sections_array[] = $vehicle_array;
        }
        $this->db->insert_batch( 'class_sections', $sections_array );
        if ( $this->db->trans_status() === FALSE ) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

    }


    public function getDetailbyClassSection( $class_id = null, $section_id = null )
    {
        $this->db->select( 'class_sections.*, classes.class, sections.section' )
            ->from( 'class_sections' )
            ->join( 'classes', 'classes.id = class_sections.class_id', 'inner' )
            ->join( 'sections', 'sections.id = class_sections.section_id' );

        if ( $class_id !== null ) {
            $this->db->where( 'class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'section_id', $section_id );
        }

        $query = $this->db->get();

        if ( $class_id !== null && $section_id !== null ) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    function check_data_exists( $data )
    {
        $this->db->where( 'class_id', $data['class_id'] );
        $this->db->where( 'section_id', $data['section_id'] );
        $query = $this->db->get( 'class_sections' );
        if ( $query->num_rows() > 0 ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function getByID( $id = null )
    {
        $this->db->select( 'classes.*' )->from( 'classes' );

        if ( $id != null ) {
            $this->db->where( 'classes.id', $id );
        } else {
            $this->db->order_by( 'classes.id', 'DESC' );
        }

        $query = $this->db->get();
        if ( $id != null ) {
            $vehicle_routes = $query->result_array();

            $array = array();
            if ( !empty( $vehicle_routes ) ) {
                foreach ( $vehicle_routes as $vehicle_key => $vehicle_value ) {
                    $vec_route = new stdClass();
                    $vec_route->id = $vehicle_value['id'];

                    $vec_route->route_id = $vehicle_value['class'];

                    $vec_route->fee = $vehicle_value['fee'];

                    $vec_route->vehicles = $this->getVechileByRoute( $vehicle_value['id'] );
                    $array[] = $vec_route;
                }
            }
            return $array;
        } else {
            $vehicle_routes = $query->result_array();
            $array = array();
         
            if ( !empty( $vehicle_routes ) ) {
                foreach ( $vehicle_routes as $vehicle_key => $vehicle_value ) {

                    $vec_route = new stdClass();
                    $vec_route->id = $vehicle_value['id'];
                    $vec_route->class = $vehicle_value['class'];
                    $vec_route->class_group = $vehicle_value['class_group'];
                    $vec_route->fee = $vehicle_value['fee'];

                    $vec_route->vehicles = $this->getVechileByRoute( $vehicle_value['id'] );
                    $array[] = $vec_route;
                }
            }
            
            return $array;
        }
    }


    public function getVechileByRoute( $route_id )
    {
        $this->db->select( 'class_sections.id as class_section_id,class_sections.class_id,class_sections.section_id,class_sections.order_by,sections.*' )->from( 'class_sections' );
        $this->db->join( 'sections', 'sections.id = class_sections.section_id' );

        $this->db->where( 'class_sections.class_id', $route_id );
        $this->db->order_by( 'class_sections.id', 'asc' );
        $query = $this->db->get();
        return $vehicle_routes = $query->result();
    }

    public function remove( $class_id, $array )
    {
        $this->db->where( 'class_id', $class_id );
        $this->db->where_in( 'section_id', $array );
        $this->db->delete( 'class_sections' );
    }

    public function class_sections( $id = null, $class_id = null, $section_id = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $class_id !== null ) {
            $this->db->where( 'class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'section_id', $section_id );
        }
        $this->db->order_by('order_by','asc');	
        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $id !== null || ( $class_id !== null && $section_id !== null ) ) {
                $data = $q->row_array();
                $data['class'] = $this->class_model->get( $data['class_id'] );
                $data['section'] = $this->section_model->get( $data['section_id'] );
            } else {
                $data = $q->result_array();

                for ( $i = 0; $i < count( $data ); $i++ ) {
                    $data[$i]['class'] = $this->class_model->get( $data[$i]['class_id'] );
                    $data[$i]['section'] = $this->section_model->get( $data[$i]['section_id'] );
                }
            }

            return $data;

        } else {
            return false;
        }
    }
    public function class_sections_others( $id = null, $class_id = null, $section_id = null )
    {
        $this->db->select( '*' )
            ->from( $this->table_name );

        if ( $id !== null ) {
            $this->db->where( 'id', $id );
        }

        if ( $class_id !== null ) {
            $this->db->where( 'class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'section_id', $section_id );
        }
        $this->db->order_by('order_by','asc');	
        $q = $this->db->get();

        if ( $q->num_rows() > 0 ) {

            if ( $id !== null || ( $class_id !== null && $section_id !== null ) ) {
                $data = $q->result_array();
                $data[0]['class'] = $this->class_model->get( $data[0]['class_id'] );
                $data[0]['section'] = $this->section_model->get( $data[0]['section_id'] );
            } else {
                $data = $q->result_array();

                for ( $i = 0; $i < count( $data ); $i++ ) {
                    $data[$i]['class'] = $this->class_model->get( $data[$i]['class_id'] );
                    $data[$i]['section'] = $this->section_model->get( $data[$i]['section_id'] );
                }
            }

            return $data;

        } else {
            return false;
        }
    }
}
