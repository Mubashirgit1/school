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
    //  echo "<pre>";
   //   print_r($transactions);
    //  echo "</pre>";
 
      ?>
<script>

var teacher = [];
var teacher1 = [];

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
    url: '<?php echo base_url() ?>transactions/expense_comparison_graph2',
    data: { 'year': year,'month': month },
    success: function(data){
    
	obj  = JSON.parse(data);
 
    console.log(obj);
 
    $.each(obj['collection'],function(i,item){
	 $.each(item,function(j,item){
	
	
	 dates.push(j);

	 teacher.push(item['amount']);

	})
	})
	    $.each(obj['expense'],function(j,item){
	  $.each(item,function(j,item){


	
     console.log(item);
	 
	teacher1.push(item['amount']);

	})
	})


var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: dates,
        datasets: [{
			fill: false,
			lineTension:0.1,
            label: "Collection",
            backgroundColor: 'green',
			pointBorderWidth:6,
            borderColor: 'green',
            data:teacher,
        },{
			fill: false,
			lineTension:0.1,
            label: "Expense",
            backgroundColor: 'red',
			pointBorderWidth:6,
            borderColor: 'red',
            data:teacher1,
        }]
    },


    // Configuration options go here
    options: {}
});

},

});

});

</script>

    </section>
</div>



 





</body>
</html>          