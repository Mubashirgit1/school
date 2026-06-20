 <style>
            
            .video_container {
                position: relative;
                width: 100%;
                height: auto;
                padding-bottom: 56.25%;
            }
            .youtube_video {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
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
        <div class="box box-primary" style="margin-bottom: 0px;">
        <div class="box-header">

        <h4>Youtube/Notes</h4>  
        </div>
            
        <div class="box-body">
            <div id="homework">
            
                   
            <ul class="nav nav-tabs" id="tabs">
            <?php 
            $i  = 1;
            foreach($vocation as $key => $sylla ){
            if($i == 1){ ?>
                <li class="active"><a data-toggle="tab" href="#modal-<?= $i ?>"><?=$key?></a></li>
            <?php }else{?>
                <li ><a data-toggle="tab" href="#modal-<?= $i ?>"><?=$key?></a></li>
            <?php }
              $i++;
            }  ?>

            </ul>
            <div class="tab-content">
            <?php
             $i  = 1;
            foreach($vocation as $key => $sylla ){
                if($i == 1){
               
                ?>
                <div id="modal-<?=  $i?>" class="tab-pane fade in active"><br>
                <?php }else{ ?>
                <div id="modal-<?=  $i?>" class="tab-pane fade"><br>
                <?php }?>
                <p>  </p>
    
                <div class="row"><div class="col-sm-4"> <h4> Title:  Youtube</h4>  </div> <div class="col-sm-4"><h4 > Class :<?= $sylla[0]["class"]." / ".$sylla[0]["section_name"] ?> </h4></div> <div class="col-sm-4"><h4 > Teacher : <?= $sylla[0]["teacher"]?></h4></div></div>
           
                <hr>
                <div class="table-responsive">
                <table class="table table-bordered table-hover examssjadkfjple">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Video</th>
                     
                    </tr>
                </thead>
                <tbody>
               
              <?php
              $i1 = 0;
                foreach($sylla as $key1 => $syl ){ 
                    $i1++;
                    ?>
                    <tr>
                    <td><?= $i1?></td>
                    <td><?= date('jS M Y', strtotime($syl['date']))?></td>
                    <td><?= $syl['title']?></td>
                    
                    <?php   $string = $syl['file'];
                            $pieces = explode('/', $string);
                            $last_word = array_pop($pieces); ?>

              
                          <td>  <a href="#<?php echo $syl['id'] ?>" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-primary" data-toggle="modal">Watch Video</a></td>

                                                <div id="<?php echo $syl['id'] ?>" class="modal fade">
                                                    <div class="modal-dialog modal-large modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button data-modal-id="<?php echo $syl['id'] ?>" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">YouTube Video</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <?php 
                                                            $string = $syl['link'];


                                                            $parts = parse_url($string);
                                                            parse_str($parts['query'], $query);
                                                            $last_word  =$query['v'];
                                                            if(empty($last_word)){
                                                                $pieces = explode('/', $string);
                                                                $last_word = array_pop($pieces);
                                                            }
                                                         
                                                                ?>
                                                           
                                                                <div class="video_container">
                                                                    <iframe id="cartoonVideo" class="youtube_video" src="//www.youtube.com/embed/<?= $last_word?>" frameborder="0" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    </tr>

               <?php 
                }
                $i++;?>
                </tbody>
 
                </table>
                </div>
                </div>
                <?php   } ?>
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

    $(".close").on("click", function(){
        let modalId = $(this).data("modal-id");

        $("#"+modalId + " iframe").attr("src", $("#"+modalId + " iframe").attr("src"));
        
    });
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true
         }).on('changeDate', function(e) {
        $.ajax( {
            url: '<?php echo site_url( "parent/parents/studentAssignment" ) ?>',
            type: 'post',
            data: {
                date: $(this).val(),
                student_id: <?=$student['id']?>,
            },
            dataType: 'json',
            success: function ( response ) {
                var div = GetDynamicTextBox( response );
                $( "#assignment" ).append( div );
            }
        } );
    }
);


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('/');
}

function GetDynamicTextBox( value ) {
        var row = "";

        row += '<ul class="nav nav-tabs" id="tabs">';
        $.each( value, function ( index, value ) {
            if(index ==0){
                row += '<li class="active"><a data-toggle="tab" href="#'+value.id+'">'+value.subject+'</a></li>';
            }else{
                row += '<li><a data-toggle="tab" href="#'+value.id+'">'+value.subject+'</a></li>';
            }
        });
        row += '</ul>';
        row += '<div class="tab-content">';
        $.each( value, function ( index, value ) {
           date =  new Date(value.date);
            if(index ==0){
                row += '<div id="'+value.id+'" class="tab-pane fade in active"><br><p> Date :'+formatDate(date)+'<span style="float:right">Teacher :'+value.teacher+'</span> </p><h3>Title :'+value.title+'</h3><h5>Download File <a  href="<?= base_url() ?>'+value.file+'" download><i class="fa fa-download" aria-hidden="true"></i></a></h5></div>';
            }else{
                row += '<div id="'+value.id+'" class="tab-pane fade  "><br><p> Date :'+formatDate(date)+'<span style="float:right">Teacher :'+value.teacher+'</span> </p><h3>Title :'+value.title+'</h3><h5>Download File <a  href="<?= base_url() ?>'+value.file+'" download><i class="fa fa-download" aria-hidden="true"></i></a></h5></div>';
            }
        });
        row += '</div>';
        return row;
    }

});




</script>