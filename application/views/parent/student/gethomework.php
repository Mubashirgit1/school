<style>

tbody
{
    overflow:scroll;
}
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-4 col-sm-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-8 col-sm-10"> 
                <div class="card-body-right">
                    <h4 class="card-title"><?= $student['firstname'].' '.$student['lastname']?></h4>
                    <h5><?= $student['class'].' / '.$student['section']?></h5>
                    <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                </div>
            </div>
            </div>
        </div>
    </section>

    <section class="content">
    <ul class="nav nav-tabs"  >
        <li  class="active" ><a data-toggle="tab" href="#tab_all">ALL</a></li>
        <li ><a data-toggle="tab" href="#tab_date">Date Wise</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab_date" class="tab-pane fade in ">
            <div class="box box-primary" style="margin-bottom: 0px;">
                <div class="box-header">
                    <div class="col-sm-2">
                        <label>Select Date for homework</label>
                        <input type="text" name="date_from"   class="form-control date" value="<?php echo date('d/m/Y'); ?>" autocomplete="off" >
                    </div>
                    
                </div>
                <div class="box-body">
                    <div id="homework">
                    </div>
                </div>  
            </div>
        </div>
        <div id="tab_all" class="tab-pane fade in active">
        <div class="box box-primary" style="margin-bottom: 0px;">
                <div class="box-header">
                    <h4>All Homework  </h4>
                </div>
                <div class="box-body">
                    <ul class="nav nav-tabs" id="tabs">
                        <?php 
                        $i = 0;
                        foreach($homework as $key => $home){ 
                        $i++;
                        $i == 1 ?  $class = "active" : $class= " ";?>
                        <li  class="<?= $class ?>"><a data-toggle="tab" href="#my_tab_no_<?= $i ?>"><?= $key ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php 
                        $i = 0;
                        foreach($homework as $key => $home){  
                        $i++;
                        $i == 1 ?  $class = "active" : $class= " ";?>
                        <div id="my_tab_no_<?= $i ?>" class="tab-pane fade in <?= $class ?>">
                      
                        <div class="row"><div class="col-sm-4"> <h4> Title: Homework</h4>  </div> <div class="col-sm-4"><h4 > Class :  <?= $home[0]["class"] ?> / <?= $home[0]["section"] ?>  </h4></div> <div class="col-sm-4"><h4 > Teacher :  <?= $home[0]["teacher"] ?>  </h4></div></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Classwork</th>
                                            <th>Homework </th>
                                            <th>File Name</th>
                                            <th>File View</th>
                                            <th>File Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach($home as $key => $home_value){ ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($home_value['date']))?></td>
                                            <td><?= $home_value['title']?></td>
                                            <td><?= $home_value['classwork']?></td>
                                            <td><?= $home_value['homework']?> </td>
                                            <?php   $string = $home_value['file'];
                                            $pieces = explode('/', $string);
                                            $last_word = array_pop($pieces); ?>
                                            <td><?= $last_word?></td>
                                            <td>
                                                <?php if($home_value['file']){ ?>
                                                 <a target="blank" href="<?= base_url() ?><?= $home_value['file']?>" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                 <?php }else{
                                                 echo "File no Attached" ;
                                                 }?>
                                            <td> 
                                            <?php if($home_value['file']){ ?>
                                               <a download href="<?= base_url() ?><?= $home_value['file']?>" ><i class="fa fa-download" aria-hidden="true"></i></a>
                                                 <?php }else{
                                                 echo "File no Attached" ;
                                                 }?>
                                            
                                            </td>
                                        </tr>
                                        </tr>
                                        <?php   $lastword="" ?>
                                            
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                         </div>
                        <?php } ?>
                    </div> 
                </div>  
            </div>
        </div>
        </div>
  
    </div>

    </section>  

    <section id="tabs">

</section>

</div>
   

<script type="text/javascript">
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });
</script>
 
<script type="text/javascript">
    $(document).ready(function () {
        $('.example').dataTable({
            "bSort": false,
            "paging": false,

        });
    
    
    });

 

    
    $(document).ready(function () {


        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>
<script>
   $( function() {

    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
         }).on('changeDate', function(e) {
        getData($(this).val());
    }
);

function getData(date){
    $.ajax( {
            url: '<?php echo site_url( "parent/parents/studentHomework" ) ?>',
            type: 'post',
            data: {
                date: date,
                student_id: <?=$student['id']?>,
            },
            dataType: 'json',
            success: function ( response ) {
                var div = GetDynamicTextBox( response );
                $( "#homework" ).html( div );
            }
        } );
}

$(function(){
    getData("<?php echo date('d/m/Y'); ?>");
});

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month, year].join('/');
}

function GetDynamicTextBox( data ) {
    
        var row = "";

        row += '<ul class="nav nav-tabs" id="tabs">';
      
        var i = 0;
        
        $.each( data, function ( index, value ) {
            console.log(value);
            if(value.length>0){
                if(i == 0){
                    row += '<li class="active"><a data-toggle="tab" href="#tab_'+i+'">'+index+'</a></li>';
                }else{
                    row += '<li><a data-toggle="tab" href="#tab_'+i+'">'+index+'</a></li>';
                }
                i++;
            }
        });
        
        i=0;
        
        row += '</ul>';
        row += '<div class="tab-content">';
        if(data){
            $.each( data, function ( index, value ) {
                
                console.log(index);
                console.log(value);
                
                if(value.length>0){
                    if(i == 0){
                        row += '<div id="tab_'+i+'" class="tab-pane fade in active">';
                        row += '<div class="row"><div class="col-sm-4"> <h4> Title: Homework</h4>  </div> <div class="col-sm-4"><h4 > Class : '+value[0]["class"]+'/'+value[0]["section_name"]+' </h4></div> <div class="col-sm-4"><h4 > Teacher : '+value[0]["teacher"]+'</h4></div></div>';
                        row +='<div class="table-responsive"><table class="table table-bordered table-hover example">'
                        row +='<thead>';
                        row +='<tr>';
                        row +='<th>Date</th>';
                        row +='<th>Title</th>';
                        row +='<th>Homework </th>';
                        row +='<th>Classwork</th>';
                        row +='<th>File Name</th>';
                        row +='<th>File View</th>';
                        row +='<th>File Download</th>';
                        row +='</tr>';
                        row +='</thead>';
                        row +='<tbody>';
                        
                        $.each( value, function ( index, value_table ) {
                            
                            date =  new Date(value_table.date);
                            var lastword = '';
                            if(value_table.file){
                                 lastword = value_table.file.split("/").pop();
                            }
                            
                            row +='<tr>';
                            row +='<td>'+formatDate(date)+'</td>';
                            row +='<td>'+value_table.title+'</td>';
                            row +='<td>'+value_table.homework+'</td>';
                            row +='<td>'+value_table.classwork+'</td>';
                            row +='<td>'+lastword+'</td>';
                            row +='<td> <a target="blank" href="<?= base_url() ?>'+value_table.file+'" ><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            row +='<td> <a download href="<?= base_url() ?>'+value_table.file+'" ><i class="fa fa-download" aria-hidden="true"></i></a></td>';
                            row +='</tr>';
                            lastword="";
                            
                        });
                        
                        row += ' </tbody>';
                        row += '</table>';
                        row += '</div></div>';
                    }else{
                        row += '<div id="tab_'+i+'" class="tab-pane fade">';
                        row += '<div class="row"><div class="col-sm-4"> <h4> Title: Homework</h4>  </div> <div class="col-sm-4"><h4 > Class : '+value[0]["class"]+'/'+value[0]["section_name"]+' </h4></div> <div class="col-sm-4"><h4 > Teacher : '+value[0]["teacher"]+'</h4></div></div>';
                        row += '<div class="table-responsive"><table class="table table-bordered table-hover ">'
                        row += '<thead>';
                        row += '<tr>';
                        row += '<th>Date</th>';
                        row += '<th>Title</th>';
                        row +='<th>Homework </th>';
                        row +='<th>Classwork</th>';
                        row += '<th>File Name</th>';
                        row += '<th>File View</th>';
                        row += '<th>File Download</th>';
                        row += '</tr>';
                        row += '</thead>';
                        row += '<tbody>';
                        
                        $.each( value, function ( index, value_table ) {
                            console.log(value_table);
                            
                            date =  new Date(value_table.date);
                            var lastword = '';
                            if(value_table.file){
                                 lastword = value_table.file.split("/").pop();
                            }
                            
                            row +='<tr>';
                            row +='<td>'+formatDate(date)+'</td>';
                            row +='<td>'+value_table.title+'</td>';
                            row +='<td>'+value_table.homework+'</td>';
                            row +='<td>'+value_table.classwork+'</td>';
                            row +='<td>'+lastword+'</td>';
                            row +='<td> <a target="blank" href="<?= base_url() ?>'+value_table.file+'" ><i class="fa fa-eye" aria-hidden="true"></i></a>';
                            row +='<td> <a download href="<?= base_url() ?>'+value_table.file+'" ><i class="fa fa-download" aria-hidden="true"></i></a></td>';
                            row +='</tr>';
                            lastword="";
                            
                        });
                        
                        row += '</tbody>';
                        row += '</table>';
                        row += '</div></div>';
                     }
                    i++;
                }
            });
        }
        row += '</div>';
        return row;
    }

});



</script>