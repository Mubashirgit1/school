



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
            <a href="<?= site_url( 'transactions/student_all_month' ) ?>" title="Graph" class="btn btn-primary">month </a>
            </div>
                </div>
                
                           
           
        </div>
        <div class="clearfix"></div> 

   
        <div class="clearfix"></div>
        
    </section>
     
    <section class="content">
    
    
  <?php 
	 //     echo "<pre>";
	//  print_r($teachers);
// echo "</pre>";
                 ?> 
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
	 var month = $("#month").val();
	 


 $.ajax({
        method: 'POST',
        url: '<?php echo base_url() ?>transactions/student_month_graph2',
        data: { 'year': year, 'month': month },
        success: function(data){
        obj  = JSON.parse(data);



$.each(obj,function(i,item){

 
 dates.push(i);
	
 var count = 0;
 var count1 = 0;
 var count2 = 0;
 var count3 = 0;
 var count4 = 0;
 
var total = 0;
$.each(item,function(j,item){


total = j++;
  
  console.log(item.attendence_type_id);
  
if(item != null){
	
if(item.attendence_type_id == 1  ){
	
	count++;
}
if(item.attendence_type_id == 2  ){
	
	count1++;
}
if(item.attendence_type_id == 3  ){
	
	count2++;
}
if(item.attendence_type_id == 4  ){
	
	count3++;
}
if(item.attendence_type_id == 5  ){
	
	count4++;
}

  }
	})
	
	
	
	var count = parseInt(count) * 100 / parseInt(total+1);
	var count1 = parseInt(count1) * 100 / parseInt(total+1);
	var count2 = parseInt(count2) * 100 / parseInt(total+1);
	var count3 = parseInt(count3) * 100 / parseInt(total+1);
	var count4 = parseInt(count4) * 100 / parseInt(total+1);
	
	teacher.push(count)
	teacher1.push(count1)
	teacher2.push(count2)
	teacher3.push(count3)
	teacher4.push(count4)
		 
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