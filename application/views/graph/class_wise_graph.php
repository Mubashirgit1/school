<!DOCTYPE HTML>
<html>
<head>  
</head>
<body>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
      <div class="box box-primary" style="margin-bottom: 0px;">
           <div class="pull-left">
                <h3  style="margin-top: 0px;">
                  <?= $title ?>
                  <br>
<br>
                </h3>
<h4>        
                   
                             
                             
</h4>
    

</div>            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year">
                                        <?php
                                        $date = new DateTime( date( 'Y-m-d', now() ) );
                                        $date->sub( new DateInterval( 'P6Y' ) );
                                        for ( $i = 0; $i <= 6; $i++ ):
                                            ?>
                                            <option value="<?= $date->format( 'Y' ) ?>" <?= ( $year == $date->format( 'Y' ) ? "selected" : "" ) ?>><?= $date->format( 'Y' ) ?></option>
                                            <?php
                                            $date->add( new DateInterval( 'P1Y' ) );
                                        endfor;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="month" class="form-control" id="month">
                                        <?php
                                        $date = new DateTime( date( 'Y-01-d', now() ) );
                                        for ( $i = 0; $i < 12; $i++ ):
                                            ?>
                                            <option value="<?= $date->format( 'm' ) ?>" <?= $month == $date->format( 'm' ) ? "selected" : "" ?>><?= $date->format( 'F' ) ?></option>
                                            <?php
                                            $date->add( new DateInterval( 'P1M' ) );
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                  
                                
                           
            <input type="button" id="fetch" class="btn btn-primary" value="Get Graph">
            <a href="<?= site_url( 'transactions/expense_line_graph' ) ?>" title="Graph" class="btn btn-primary">Expense </a>
            </div>
                </div>


                                     

           
        </div>
        <div class="clearfix"></div> 

   
        <div class="clearfix"></div>
        
    </section>
     
    <section class="content">
    <div class="row">
                                <?php if ( $exams !== false ): ?>
                                    <?php $count = 2; 
									?>
                                    
                                    <?php foreach ( $exams as $exa ): 
									?>
                                    
                                        <div class="col-xs-6">
                                            <div class="checkbox">
                                                <label>
               
                                <input type="hidden" name="fee[<?= $count ?>][name]" value="<?= $exa['name'] ?>">
                                
     <input type="checkbox" id="other_fee" class="percentage_exam_id" name="fee[<?= $count ?>][check]" value="<?= $exa['id'] ?>"> <?= $exa['name'] ?>
                                     
                                                </label>
                                            </div>
                                        </div>

                                        

                                        <div class="clearfix"></div>
                                        <hr  style="margin: 0px 5px;">
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
    

      </form>
         
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="myChart" width="200" height="70" class=""></canvas>
        
      
<script>

var teacher = [];
var teacher1 = [];
var teacher2 = [];
var teacher3 = [];
var teacher4 = [];
var dates = [];
var total1 = [];



 $("#fetch").on('click', function(){
	 
	 var exam_id = $('.percentage_exam_id:checked').val();
	 
	 
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/teacher_exam_result',
    data: { 'exam_id': exam_id },
    success: function(data){
    obj  = JSON.parse(data);
	
	console.log(obj);
  
 
	$.each(obj,function(i,item){
		
		
		dates.push(item['name']);
	
	    var total_subject = 0;	
	
	  var total_marks_total = 0;
	  var get_marks_total = 0;
	  var passing_marks_total = 0;
	  
		$.each(item['subject'],function(j,item){
	   
	    total_subject++;
		
	    var passing_marks = 0;	
	    var total_marks = 0;
		var get_marks = 0;
			
	    
	   $.each(item['exam'],function(k,item){
		
	    total_marks  =   Number(get_marks)+ Number(item['full_marks']);		
	    passing_marks = Number(passing_marks) + Number(item['passing_marks']);
		
	      get_marks =  Number(get_marks) + Number(item['result']['get_marks']);        
		
		  })
		  
		   total_marks_total  =   Number(total_marks_total)+ Number(total_marks);	
		  get_marks_total     =   Number(get_marks_total )+ Number(get_marks);
		  passing_marks_total =   Number(passing_marks_total)+ Number(passing_marks);
		
		    // console.log(get_marks);
		   // console.log(passing_marks);
		  //	console.log(total_marks);
		  
	     })
		 

  var  total_get =  parseInt( get_marks_total) / parseInt(total_subject);
    
  var  total =  parseInt( total_marks_total) / parseInt(total_subject);    
  
     

	
 var percentage = parseInt( total_get) * 100 / parseInt(total );

        teacher.push(percentage)

	})
	
	

	
var ctx = $("#myChart");


var color = dates;

var vertical = teacher;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "percentage",
    backgroundColor: "green",
    data: vertical,
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

    </section>
</div>



 





</body>
</html>          