<style type="text/css">
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */

</style>

<div class="content-wrapper" style="min-height: 946px;">


            <?php
            if ( $this->session->flashdata( 'expense_err' ) ):
                echo "<div><div class='alert alert-danger' style='display: inline-block;'>" . $this->session->flashdata( 'expense_err' ) . "</div></div>";
            endif;

            if ( $this->session->flashdata( 'expense_msg' ) ):
                echo "<div><div class='alert alert-success' style='display: inline-block;'>" . $this->session->flashdata( 'expense_msg' ) . "</div></div>";
            endif;
            ?>
            <div id="voucher_pre"></div>
             <?php  $admind = $this->session->userdata( 'admin' );  ?>
            
    <section class="content-header">
     <div class="box box-primary" style="margin-bottom: 0px;">
      <div class="box-header with-border" >
        <div class="row">
         <h4 class="pull-left col-sm-2">
            Generate <?= $title ?>
        
         </h4>
        <div class="col-sm-2">
        <h5 > 
       </h5>  
        </div>
        
        <div class="col-sm-3 pull-right">

        </div>
        <div class="clearfix"></div>
        </div>
        </div>
        </div>
    </section>

    <section class="content">
<div class="modal"><!-- Place at bottom of page --></div>

        <div class="text-center">
            <?php $this->general_library->err_msg(); ?>
        </div>

        <div class="row">
        
            <form action="" method="post">
            
                <div class="col-xs-12 col-sm-6">
                
                
                    <div class="box box-primary">
                    
       <div class="other_fee2" >              
           
                        <div class="box-body">
                     <div class="other_fee2" >
                              <div class="box box-primary">
                                <?php if ( $student_details !== null ): ?>
                                    <input type="hidden" id="student_id" name="student_ids[]" value="<?= $student_details['id'] ?>">
                                <?php else: ?>


                                    <?php if ( empty( $class_sections ) ): ?>
                                        <p class="text-center text-danger">No class has been added yet.</p>
                                    <?php else: ?>
                                    
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="26%" title="Select all classes and students in them">
                            <input type="checkbox" class="select_checkbox" data-target=".class_section_checkbox">
                                                        <span>Select All</span>
                                                    </th>
                                                    <th>
                                                        <div>Class / Section / Student Wise</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $class_sections as $class_section ): ?>
                                                    <tr>
                                                        <td title="Select all students in this class">
                                                            <input type="checkbox" class="class_section_checkbox select_checkbox" data-target=".student_checkbox_<?= $class_section['class_id'] . '_' . $class_section['section_id']; ?>">
                                          <?= $class_section['class']['class'] ?> / <?= $class_section['section']['section'] ?>
                                                        </td>
                                                        <td>

                                                            <?php if ( empty( $class_section['students'] ) ): ?>
                                                        <table class="table student_info_table"  style="margin-bottom: 0px;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="8%"></th>
                                                                            <th class="text-danger">No student found in this class</th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            <?php else: ?>
                                                                <table class="table student_info_table"  style="margin-bottom: 0px;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="8%"></th>
                                                                            <th onclick="jQuery(this).parents('.student_info_table').children('tbody').fadeToggle()" style="cursor: pointer;" title="Click to show students">Students</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody style="display: none;">
                                                                <?php foreach ( $class_section['students'] as $student ): ?>
                                                                            <tr>
                                                                                <td>
                                                                                
                                                 
                                                <input type="checkbox" class="student_checkbox_<?= $class_section['class_id'] . '_' . $class_section['section_id']; ?> select_checkbox" name="student_ids[]" value="<?= $student['id'] ?>">
                                                                                </td>
                                                                                <td>
                                                                                    <?= $student['firstname'] . ' ' . $student['lastname'] ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        
                                        
                                        
                                    <?php endif; ?>
                                
                                    
                                <?php endif; ?>

                                <div class="">
                            <button type="submit" class="btn btn-primary pull-right message voucher_button" id="" formaction="<?= site_url( 'student/student_card_print' ) ?>">Generate Student Card</button>
                                </div>
    </div>
                        </div>
                    </div>
                
                </div>
  
                    
          
              </form>
            
        </div>
    </section>
    
</div>

<script type="text/javascript">

    $('#due_fee').click(function () {
        if ($(this).is(":checked")) {
            $('.fee_arrears').prop('checked', true);
        } else {
            $('.fee_arrears').prop('checked', false);
        }
    });
	   

    jQuery( function ( $ ) {
        $( ".select_checkbox" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		
		
        function update_due_date() {
            var due_date_h_month = $( "#due_date_h_month" ).val(),
                due_date = $( "#due_date" ).val();

            if ( due_date_h_month.length == 1 ) {
                due_date_h_month = "0" + due_date_h_month;
            }

            due_date = due_date.replace( /(\d*)(\/\d*\/\d*)/g, (due_date_h_month + "$2") );
            $( "#due_date" ).val( due_date )
		
        }
        update_due_date();
        $( "#due_date_h_month" ).change( function () {
            update_due_date();
        } );
    } );
</script>



<script type="text/javascript">

$('input.check_advance').click(function(){
  $('input.check_advance1').prop('checked',this.checked)
})

$('input.check11').click(function(){
  $('input.check21').prop('checked',this.checked)
})
$('input.check21').click(function(){
  $('input.check11').prop('checked',this.checked)
})

    jQuery( function ( $ ) {
		
   $(document).ready(function() {
    $('.other_fee').click(function() {
        if ($(this).is(':checked')) {
            
			
            $(".other_fee2").addClass("disabledbutton");
			               
        } else {
            
            $(".other_fee2").removeClass("disabledbutton");

        }
    });
});
  
 		
    } );
	
 jQuery( function ( $ ) {
   $(document).ready(function() {
    $('.tuition_fee').click(function() {
	    if ($(this).is(':checked')) {
            $('#due_fee').prop('checked',true);
			
            $("#tuition_fee").addClass("disabledbutton");
			               
        } else {
            $('#due_fee').prop('checked',false);
            $("#tuition_fee").removeClass("disabledbutton");

        }
    });
});
  
    } );
	
	
	   $( document ).on( 'click', '.voucher_button', function () {
	
	
        var student_id = $( '#student_id' ).val();
        var base_url = '<?php echo base_url() ?>'; 
     	var student_details = [];
	   if ( student_id.length > 0 ) {
            $.ajax( {
                type: "POST",
                url: base_url + "fee_management/check_voucher",
                data: {'student_id': student_id},
                dataType: "json",
				async:false,
                success: function ( data ) {
		        student_details.push(data) 	  
	         	},
				beforeSend: function(){
       $('.loader').show();
   },
  complete: function(){
       $('.loader').hide();
  }
				
			  } );

			
			 	if(student_details ==  1){
					 alert("Voucher Allready Available");
					 $( '#voucher_pre' ).html( "<div class='alert alert-danger'>Voucher Allready Available </div>" );
					return false;
				}
			
        } else {
		    $( '#voucher_pre' ).html( "<div class='alert alert-danger'>No Student Selected</div>" );
        }
     } );
	
	
   jQuery( function ( $ ) {
   $(document).ready(function() {
    $('.advance_fee').click(function() {
        if ($(this).is(':checked')) {
            $('#advance_fee').prop('checked',true);
			
            $("#tuition_fee").addClass("disabledbutton");
			               
        } else {
            $('#advance_fee').prop('checked',false);
            $("#tuition_fee").removeClass("disabledbutton");

        }
    });
});
  
    } );
	
</script>

<script type="text/javascript">




function validation(){
	var invalid = 0
	var y = document.getElementById("other_fee").value;
	if( y == "" ){
		confirm('Due Date not provide ');
		invalid += 1;
	}
	var x = document.getElementById("due_date_h_date_other").value;
	if( x == "" ){
		confirm('Due Date not provide ');
		invalid += 1;
	}
	 if(invalid!=0){
	  return false;
      }
	else{
		return true;
	}
	 }
   

</script>






