<?php

class ClassApi extends CI_Controller
{

    public function class_details( $class_id = null )
    {
        $class_details = $this->class_model->get( $class_id );

        $this->output->set_header( 'Content-Type: application/json' );
        $this->output->set_output( json_encode( $class_details ) );
    }
	
	
	
	 public function class_roll( $class_id = null, $section_id = null)
    {
		
		
		
        $class_roll =$this->student_model->get_roll( $class_id, $section_id );
		$student_id = $class_roll['student_id'];
		
	    if($student_id > 0){
			
		 $student	=  $this->student_model->getStudents($student_id);
			
			      
		}
	
	
		
		$this->output->set_header( 'Content-Type: application/json' );
        $this->output->set_output( json_encode(  $student) );
    }
	

}