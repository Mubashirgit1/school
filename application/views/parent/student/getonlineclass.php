<style>


</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-7 col-sm-9 col-md-10"> 
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
        <div class="box box-primary" style="margin-bottom: 0px;">
        <div class="box-header">
            <div class="col-sm-2">  
                <label>Select Date for Online Class</label>
                <input type="text" name="date_from"   class="form-control date" value="<?php echo date('d/m/Y'); ?>" autocomplete="off" >
            </div>
        </div>
            
            <div class="box-body">
            <div class="" id="onlineclass">
            
                   
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
    });

function getData($date){
    $.ajax( {
            url: '<?php echo site_url( "parent/parents/studentonlineclass" ) ?>',
            type: 'post',
            data: {
                date: $date,
                student_id: <?=$student['id']?>,
            },
            dataType: 'json',
            success: function ( response ) {
                var div = GetDynamicTextBox( response );
                $( "#onlineclass" ).html( div );
            }
        } );
}

$(document).ready(function(){
    getData("<?php echo date('d/m/Y') ?>");
})


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

function GetDynamicTextBox( value ) {
        var row = "";

        row += '<ul class="nav nav-tabs" id="tabs">';
        $.each( value.subjects, function ( index, subject ) {
            if(index ==0){
                row += '<li class="active"><a data-toggle="tab" href="#'+subject.id+'">'+subject.name+'</a></li>';
            }else{
                row += '<li><a data-toggle="tab" href="#'+subject.id+'">'+subject.name+'</a></li>';
            }
        });
        row += '</ul>';

        row += '<div class="tab-content">';
        i =0;
        $.each(value.classes, function(parentIndex, singleSubject){
            i++;
            
            let active = i == 1 ? "active" : "";

            if(singleSubject.length>0){
            row += '<div id="'+singleSubject[0].subject_id+'" class="tab-pane fade in  '+active+'">';
                    row += '<div class="row"><div class="col-sm-4"> <h4> Title: Online Class</h4>  </div> <div class="col-sm-4"><h4 > Class : '+singleSubject[0]["class"]+'/'+singleSubject[0]["section_name"]+' </h4></div> <div class="col-sm-4"><h4 > Teacher : '+singleSubject[0]["teacher"]+'</h4></div></div>';
                    row +='   <div class="table-responsive"> <table class="table table-bordered table-hover ">'
                    row +='<thead>';
                    row +='<tr>';
                    row +='<th>Sr No</th>';
                    row +='<th>Date</th>';
                    row +='<th>Title</th>';
                    row +='<th>Time</th>';
                    row +='<th>Password</th>';
                    row +='<th>Class Link</th>';
                    row +='</tr>';
                    row +='</thead>';
                    row +='<tbody>';

        
            $.each( singleSubject, function ( index, onlineClass ) {
    
               date =  new Date(onlineClass.date);
               var lastword = '';
               
                if(onlineClass.file){
                     lastword = onlineClass.file.split("/").pop();
                }
                

                    
                    row += '<tr>';
                    row += '<td>1</td>';
                    row += '<td>'+formatDate(date)+'</td>';
                    row += '<td>'+onlineClass.title+'</td>';
                    row += '<td>'+onlineClass.class_time+'</td>';
                    row += '<td>'+onlineClass.password+'</td>';
                    row += '<td>'+'<a target="_blank" href="'+onlineClass.link+'" class="btn btn-sm btn-primary">Join Now</a>'+'</td>';
                    // row += '<td><pre>'+onlineClass.link+'</pre></td>';
                    row += '</tr>';
                    
            
            });
            row += ' </tbody>';
            row += '</table>';
            row += '</div></div>';
            }
        });
        row += '</div>';
  
        return row;
    }

});



</script>