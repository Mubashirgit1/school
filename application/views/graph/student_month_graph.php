<!DOCTYPE HTML>
<html>
<head>  
</head>
<body>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
      <div class="box box-primary" style="margin-bottom: 0px;">
           
                <h4 class="pull-left" style="margin-top: 0px;">
                   <?= $title ?>
                   </h4>
            
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
                                  
            <input type="button" id="fetch" class="btn btn-primary" value="Get Graph">
            <a href="<?= site_url( 'transactions/class_wise_graph' ) ?>" title="Graph" class="btn btn-primary">Class Section Wise </a>
            </div>
                </div>
           
        </div>
        <div class="clearfix"></div> 

   
        <div class="clearfix"></div>
        
    </section>
     
    <section class="content">
    
    

      </form>
         
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="myChart" width="200" height="70" class=""></canvas>
        
      
      <?php
  //    echo "<pre>";
	//   print_r($teachers);
 //echo "</pre>";
 
      ?>
<script>

var teacher = [];
var teacher1 = [];
var teacher2 = [];
var teacher3 = [];
var teacher4 = [];
var dates = [];
var total1 = [];


//var ctx = document.getElementById("myChart2").getContext("2d");
//
//var data = {
//  labels: ["Chocolate", "Vanilla", "Strawberry"],
//  datasets: [{
//    label: "Blue",
//    backgroundColor: "blue",
//    data: [3, 7, 4]
//  }, {
//    label: "Red",
//    backgroundColor: "red",
//    data: [4, 3, 5]
//  }, {
//    label: "Green",
//    backgroundColor: "green",
//    data: [7, 2, 6]
//  }]
//};
//
//var myBarChart = new Chart(ctx, {
//  type: 'bar',
//  data: data,
//  options: {
//    barValueSpacing: 20,
//    scales: {
//      yAxes: [{
//        ticks: {
//          min: 0,
//        }
//      }]
//    }
//  }
//});



 $("#fetch").on('click', function(){
	
	 
	 var year =  $("#year").val();
 	
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/student_all_month2',
    data: { 'year': year },
    success: function(data){
obj  = JSON.parse(data);
console.log(obj);

$.each(obj,function(i,item){
		
	dates.push(i)
	
	
	var count_month = 0
	var count_month_absent = 0
	var count_month_leave = 0
	var count_month_late = 0
	var count_month_holiday = 0
	
	 var total = 0;
	 var total_teacher = 0;
$.each(item,function(j,item){
	 var count = 0;
	 var count_absent = 0;
	 var count_leave = 0;
	 var count_late = 0;
	 var count_holiday = 0;
	 
	 
	total = j++;
$.each(item,function(k,item){
total_teacher = k++;
if(item != false){
if(item.attendence_type_id == 1  ){
	
	count++;
}
if(item.attendence_type_id == 2  ){
	
	count_absent++;
}
if(item.attendence_type_id == 3  ){
	
	count_leave++;
}
if(item.attendence_type_id == 4  ){
	
	count_late++;
}
if(item.attendence_type_id == 5  ){
	
	count_holiday++;
}


}

 	})

 count_month = count_month + count;
 count_month_absent = count_month_absent + count_absent;
 count_month_leave = count_month_leave  + count_leave;
 count_month_late = count_month_late + count_late;
 count_month_holiday = count_month_late + count_holiday;
	
	})
	
	var count_percent = parseInt(count_month) * 100 / parseInt(total);
	var count_percent_absent = parseInt(count_month_absent) * 100 / parseInt(total);
	var count_percent_leave = parseInt(count_month_leave) * 100 / parseInt(total);
	var count_percent_late = parseInt(count_month_late) * 100 / parseInt(total);
	var count_percent_holiday = parseInt(count_month_holiday) * 100 / parseInt(total);
	
	
	
	total_teacher_to =total_teacher+1
	
	
	 total_percent =count_percent/total_teacher_to;
	 total_percent_absent =count_percent_absent/total_teacher_to;
	 total_percent_leave =count_percent_leave/total_teacher_to;
	 total_percent_late =count_percent_late/total_teacher_to;
	 total_percent_holiday =count_percent_holiday/total_teacher_to;
	
	
	
	teacher.push(total_percent);
	teacher1.push(total_percent_absent);
	teacher2.push(total_percent_leave);
	teacher3.push(total_percent_late);
	teacher4.push(total_percent_holiday);
	

	
 	})


var ctx = $("#myChart");


var color = dates;

var vertical = teacher;
var vertical1 = teacher1;
var vertical2 = teacher2;
var vertical3 = teacher3;
var vertical4 = teacher4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
    
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