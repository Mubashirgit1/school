<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

/**
 * @property CI_DB_mysqli_driver|CI_DB_mysqli_utility db
 */
class Timetable_model extends CI_Model
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

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'timetables' );
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add( $data )
    {
        if ( ( $data['id'] ) != 0 ) {
            $this->db->where( 'id', $data['id'] );
            $this->db->update( 'timetables', $data ); // update the record
        } else {
            $this->db->insert( 'timetables', $data ); // insert new record
            return $this->db->insert_id();
        }
    }

    public function get( $data )
    {
        $query = $this->db->get_where( 'timetables', $data );
        // print_r($this->db->last_query());exit;
        return $query->result_array();
    }

    public function calculateTeacherLectures( $teacher_id, $day = null )
    {

        $this->db->select( 'COUNT(*) as cnt' );
        $this->db->from( "timetables" );
        $this->db->join( 'teacher_subjects', 'teacher_subjects.id = timetables.teacher_subject_id', 'inner' );
        $this->db->join( 'sch_settings', 'sch_settings.session_id = teacher_subjects.session_id', 'inner' );
        $this->db->where( 'teacher_subjects.teacher_id', $teacher_id );

        if ( $day !== null ) {
            $day = strtolower( $day );
            $this->db->where( 'lower(timetables.day_name)', $day );
        }

        $q = $this->db->get();

        $cnt = $q->row_array();
        $cnt = intval( $cnt['cnt'] );

        return $cnt;

    }

    public function get_day_timetable( $class_id = null, $section_id = null, $day_name = null )
    {
        $this->db->select( 'timetables.*, subjects.name AS subject_name, subjects.id AS subject_id, teachers.name AS teacher_name' )
            ->from( 'class_sections' )
            ->join( 'teacher_subjects', 'teacher_subjects.class_section_id = class_sections.id', 'inner' )
            ->join( 'timetables', 'timetables.teacher_subject_id = teacher_subjects.id', 'inner' )
            ->join( 'subjects', 'subjects.id = teacher_subjects.subject_id', 'inner' )
            ->join( 'teachers', 'teachers.id = teacher_subjects.teacher_id', 'inner' );

        if ( $class_id !== null ) {
            $this->db->where( 'class_sections.class_id', $class_id );
        }

        if ( $section_id !== null ) {
            $this->db->where( 'class_sections.section_id', $section_id );
        }

        if ( $day_name !== null ) {
            $this->db->where( 'LOWER(`timetables`.`day_name`)', $day_name );
        }

        $this->db->order_by( 'substring(`timetables`.`start_time`, 7) ASC' );

        $this->db->order_by( 'substring(`timetables`.`start_time`, 1, 5) ASC' );

        $q = $this->db->get();

//        pwodie($this->db->last_query(), true);
//        pwodie($q->result(), false);

        return $q->result_array();
    }

}
