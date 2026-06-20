<?php

class Sms_messages
{
    public function student_absent_message( $name, $gender, $class, $section,$school_name, $type = null )
    {
        if($type != null){
            return "Dear Parents,\nThis is to inform you that today your child '{$name}' is on Leave in " . ( strtolower( $gender ) == 'male' ? "his" : "her" ) . " class ({$class}/{$section}) today.\n\n {$school_name}";
        }else{
            return "Dear Parents,\nThis is to inform you that today your child '{$name}' is absent in " . ( strtolower( $gender ) == 'male' ? "his" : "her" ) . " class ({$class}/{$section}) today.\n\n {$school_name}";
        }
    }
	
	public function student_specific_message(  $message , $school_name )
    {
        $str = "'{$message}'";
        $str .= "\n\n{$school_name}";
        return $str;
    }

    public function teacher_staff_absent_message( $name, $teacher_staff = 'teachers' )
    {
        if ( is_array( $name ) ) {
            $name = implode( ', ', $name );
        }
        return "Dear Admin,\nPlease find below the absent {$teacher_staff} today.\n{$name}";
    }
	
	 public function teacher_staff_late_message( $name, $teacher_staff = 'teachers' )
    {
        if ( is_array( $name ) ) {
            $name = implode( ', ', $name );
        }

        return "Dear Admin,\nPlease find below the Late {$teacher_staff} today.\n{$name}";
    }
	
    public function student_fee_receive_message( $std_name, $std_class, $std_section, $roll_no, $adm_no, $arrears,$advance, $total_paid_fee, $fee_types, $fee_arrears, $submission_date,$school_name,$month )
    {
        $str = "Fee Collection Update \n";
        $str .= "\nName: {$std_name}\nAd No: {$adm_no}\nClass(S): {$std_class} ({$std_section})\n";
        $str .= implode( "\n", $fee_types );

        if ($arrears > 0) {
            $str .= "\nArrears: {$arrears}";
        }
		if ($advance > 0) {
            $str .= "\n{$month}: {$advance}";
        }
        $str .= "\nTotal Paid: {$total_paid_fee}";
        
		$str .= "\nBalance: {$fee_arrears}";
		
        $str .= "\n\n{$school_name}";
        
        return $str;
    }

    public function fee_due( $name, $class, $section, $admission_no, $roll_number, $tuition_fee, $advance_fee , $fee_arrears,$total,$school_name,$month,$advance_month )
    {
        $str =  "{$month} Fee Reminder\n";
        $str .= "\nName: {$name}\nClass(S): {$class}({$section})\nAd No: {$admission_no}\n";
        if($advance_fee > 0 ){
            $str .= "\n{$advance_month} : {$advance_fee}";
        }
        if($tuition_fee > 0 ){
            $str .=   date('M')." Fee : {$tuition_fee}";
        }
        if($fee_arrears > 0 ){
        $str .= "\nArrears: {$fee_arrears}";
        }
        $str .= "\nTotal: {$total}";
        $str .= "\n\n{$school_name}";
		return $str;
    }

	 public function fee_due_all( $name, $class, $section, $admission_no, $roll_number, $tuition_fee , $arrears,$total,$school_name )
    {
        $str = "Monthly Fee Reminder\n";
        $str .= "\nName: {$name}\nClass(S): {$class}({$section})\nAd No: {$admission_no}\n".date( 'M', now() )." fee: {$tuition_fee}";
        $str .= "\nArrears: {$arrears}";
		$str .= "\nTotal: {$total}";
		$str .= "\n\n{$school_name}";
		
		return $str;
    }
	
		
     public function other_fee( $name, $class, $section, $admission_no, $roll_number, $other_fees , $total_other,$school_name )
    {
		
        $str = "Other Fee Reminder\n";
        $str .= "\nName: {$name}\nClass(S): {$class}({$section})\nAd No: {$admission_no}\n";
        foreach($other_fees as $other_fee ){    
	    $amount    =   number_format($other_fee['amount']);
		$str .= "\n{$other_fee['name']}: {$amount}";
	}
		$str .= "\nTotal: {$total_other}";
		$str .= "\n\n {$school_name}";
		
	   return $str;
    }

    public function admin_fee_message( $opening, $recieve, $expense,$payment, $closing , $date,$school )
    {
        $str = "Date  {$date}\n\n";
        $str .= "Openeing cash  : {$opening}\n\n";
        $str .= "Fee collection : {$recieve}\n";
        $str .= "Bank Withdrawl   : 0\n";
        $str .= "Payroll        : {$payment}\n";
        $str .= "Expense        : {$expense}\n";
        $str .= "Bank  Deposit : 0\n\n";
        $str .= "Closing        : {$closing}\n";
        $str .= "\n\n{$school}";
        return $str;
    }


    public function admin_fee_message1( $date, $monthly_due,$total_arrears,$paid_fee,$paid_arrears,$advance,
    $waive_fee,$waive_arrears ,$withdraw_fee,$withdraw_arrears,$due_fee, $due_arrears,$school_name  )
    {
        $str = "Date  {$date}\n\n";
        $str .= date('M')." Due : {$monthly_due}\n";
        $str .= date('M')." Paid Fee  : {$paid_fee}\n";
        $str .= date('M')." Waive Fee : {$waive_fee}\n";
        $str .= date('M')." Withdraw Fee : {$withdraw_fee}\n";
        $str .= date('M')." Due Fee : {$due_fee}\n";
        $str .= "Advance Fee Paid : {$advance}\n\n";
        

        $str .= "Arrears : {$total_arrears}\n";
        $str .= "Paid Arr : {$paid_arrears}\n";
        $str .= "Waive Arr : {$waive_arrears}\n";
        $str .= "Withdraw Arr : {$withdraw_arrears}\n";
        $str .= "Due Arrears : {$due_arrears}\n";
        $str .= "\n\n{$school_name}";
        return $str;
    }
    public function admin_fee_message2( $date,$due_other_fee,$paid_other_fee, $other_waive_fee,$unpaid_students_other  ,$due_fine ,$paid_fine,$waive_fine ,$struck_fine,$total_fine  ,$school_name  )
    {
        $str = "Date  {$date}\n\n";
        $str .= "Total Other Fee Due : {$due_other_fee}\n";
        $str .= date('M')." Other Fee Collection : {$paid_other_fee}\n";
        $str .= date('M')." Other Fee Waive : {$other_waive_fee}\n";
        $str .= date('M')." Other Fee Waive : {$other_waive_fee}\n";
        
        $str .= "Other Fee Balance  : {$unpaid_students_other}\n\n";
        $str .= "Fine Due  : {$due_fine}\n";
        $str .= "Fine Collection : {$paid_fine}\n";
        $str .= "Fine waive : {$waive_fine}\n";
        $str .= "Fine struck off : {$struck_fine}\n";
        $str .= "Fine Balance : {$total_fine}\n";
        $str .= "\n\n{$school_name}";
        return $str;
    }
    public function daily_balance( $date_now, $opening , $expense, $collection,$total_credit , $total_debit  )
    {

        $str = "{$date_now}\n\n";
        $str .= "Today Collection\n{$collection}\nToday Payments:\n{$expense}\n\nCIH Balance\n{$opening}\n\nTotal Credit:{$total_credit}\n";
        $str .= "Total Debit \n{$total_debit}";
        return $str;
    }

     public function send_date_sheet( $school_name,$examSchedule,  $exam_name ,$school )
    {
		 $str = "{$school_name}";
         $str .= "\n{$exam_name} ".date( 'Y', now() )."\n Date Sheet";
    
	foreach($examSchedule as $value ){  
        if( strlen($value['name']) > 4){
                $result = substr($value['name'], 0, 3);
        }elseif( strlen($value['name']) == 4){
            $result = substr($value['name'], 0, 4);
            }
            $date   =   date("d/M",strtotime($value['date_of_exam']));
            
            $str .= "\n{$result}: {$date}";
        }
	
	   return $str;
    }
	
	
	public function send_result_card( $student_name,$examarray,  $exam_name,$school_name )
    {
	
		 $str = "{$student_name}";
         $str .= "\n{$exam_name} ".date( 'Y', now() )."\nResult Card";
         $total = 0;
         
     foreach($examarray as $value ){      
        $obtained += $value['get_marks'];
        $total += $value['full_marks'];
        
            if( strlen($value['exam_name']) > 4){
                $result = substr($value['exam_name'], 0, 3);
            }elseif( strlen($value['exam_name']) == 4){
            $result = substr($value['exam_name'], 0, 4);
            }
            $getMarks = floatval($value['get_marks']);
            $str .= "\n{$value['exam_name']}:{$getMarks}/{$value['full_marks']}";
            $str .= "\nGrd/per:{$value['grade']}/{$value['pre']}";
            
            
        }
        $tot = $obtained.'/'.$total;
        $str .= "\nTotal: {$tot}";
        $str .= "\n\n {$school_name}";
	   return $str;
    }
	

    public function fee_arrear( $name, $class, $section, $admission_no, $roll_number, $arrears,$school_name )
    {
        $str = "Dear Parents,\nAssalam-O-Alaikum. Please find the status of your child's tuition fees' total due balance:";
        $str .= "\nName   : {$name}\nClass  : {$class}\nSection: {$section}\nAdm No : {$admission_no}";
        $str .= "\nTotal dues: {$arrears}";
		$str .= "\n\n{$school_name}";
		

        return $str;
    }

    public function admin_attendence( $date, $present, $absent,$leave ,$total )
    {
        
        $str = "{$date}\n";
        $str .= "\nPresent   : {$present}\nAbsent  : {$absent}\nLeave  : {$leave}\n";
        $str .= "\nTotal Student: {$total}";

        return $str;
    }

    public function new_admission_sms($firstname,$lastname,$school_name)
    {
        $str = "Dear Parents,\nWe are feeling very thankful for putting your trust on us regarding your child's ".$firstname." ".$lastname." education and future.";
        $str .= "\n\n{$school_name}";
        return $str;
    }
}