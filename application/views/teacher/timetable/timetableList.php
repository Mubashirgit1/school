<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('academics'); ?> <small><?php echo $this->lang->line('student_fees1'); ?></small>        </h1>
    </section>   
    <section class="content">
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form action="<?php echo site_url('teacher/timetable/index') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                             <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($result_array)) {
                    ?>
                    
            <ul class="nav nav-tabs"  >
            <li class="active" ><a data-toggle="tab" href="#tab_date">Daily    </a></li>
                <li   ><a data-toggle="tab" href="#tab_all">ALL</a></li>
              
            </ul>
            <div class="tab-content">
                <div id="tab_all" class="tab-pane fade in  ">
                    <div class="box box-info" id="timetable">
                        <div class="box-header with-border" >
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('class_timetable'); ?></h3>
                            <div class="box-tools pull-right">
                             
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($result_array)) {                              
                                ?>
                                <div class="table-responsive">
                                    <table class="table example" >
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line('subject'); ?>
                                                </th>
                                                <?php foreach ($getDaysnameList as $key => $value) {
                                                    ?>
                                                    <th class="text text-center">
                                                        <?php echo $value; ?>
                                                    </th>
                                                <?php }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result_array as $key => $timetable) {
                                                ?>
                                                <tr>
                                                    <th><?php echo $key; ?></th>
                                                    <?php
                                                    foreach ($timetable as $key => $value) {
                                                        $status = $value->status;
                                                        if ($status == "Yes") {
                                                            ?>
                                                            <td class="text text-center">
                                                                <div class="attachment-block clearfix">
                                                                    <?php
                                                                    if ($value->start_time != "" || $value->end_time != "") {
                                                                        ?>
                                                                        <strong ><?php echo $value->start_time; ?></strong>
                                                                        <b class="text text-center">-</b>
                                                                        <strong ><?php echo $value->end_time; ?></strong><br/>
                                                                        <!--<strong ><?php echo $this->lang->line('room_no'); ?>:<?php echo $value->room_no; ?>:</strong>-->
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <b class="text text-center"><br/>
                                                                        <strong class="text-green"></strong>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td class="text text-center">
                                                                <div class="attachment-block clearfix">
                                                                    <strong class="text-red"><?php echo $value->start_time; ?></strong><br/>
                                                                </div>
                                                            </td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>   
                <div  id="tab_date" class="tab-pane fade in active ">   
                    
<?php
           
           $tab_menu = '';
           $tab_content = '';
           $i = 0;
           foreach($result_array1 as $key => $row )
           {
              
            if($i == 0)
            {
             $tab_menu .= '
              <li class="active"><a href="#'.$key.'" data-toggle="tab">'.$key.'</a></li>
             ';
             $tab_content .= '
              <div id="'.$key.'" class="tab-pane fade in active">
             ';
            }
            else
            {
             $tab_menu .= '
              <li><a href="#'.$key.'" data-toggle="tab">'.$key.'</a></li>
             ';
             $tab_content .= '
              <div id="'.$key.'" class="tab-pane fade">
             ';
            }
           
           
           
            $i = 0;
            foreach($row as $key1 => $sub_row)
            {
                
               
                $url = $sub_row->teacher['image'] != null ? $sub_row->teacher['image'] : 'uploads/student_images/no_image.png'; 
           if($sub_row->start_time){
                $i++;
             $tab_content .= '
             <div class="row" style="margin-bottom:20px;">
           
               <div class="col-sm-2 col-xs-3"  style="    ;background: #f4f4f4;"  > 
                   <h1 style="text-align: center; height: 50px;">'.$i.'</h1>
               </div> 
           
               <div class="col-sm-2 col-xs-5"> 
                   <div class="card-body-right">
                           <h6>'.$sub_row->start_time.'   </h6>
                           <h4 class="card-title">'.$key1.'</h4>
                           <p class="card-text">'.$sub_row->teacher['name'].' </p>
                   </div>
               </div>
           
               
            
           
              
           
             </div>
             ';
           //   <div class="col-sm-2 col-xs-4"> 
               
           //         <img style="height:70px;width:70px" class="student-image profile-user-img img-responsive img-circle" src="'.base_url().$url.'" alt="User profile picture">
           //     </div> 
           }else{
               $tab_content .= '
             <div class="row" >
           
                
              
           
             </div>
             ';
           }
           
            }
            
            $tab_content .= '<div style="clear:both"></div></div>';
            $i++;
           }
           ?>
           
           
                       
                   <div class="nav-tabs-custom">
                           <ul class="nav nav-tabs">
                               <?php
                               echo $tab_menu;
                               ?>
                           </ul>
                           <div class="tab-content">
                               <?php
                               echo $tab_content;
                               ?>
                           </div>
           
                   </div>
                </div>         
            </div> 
        </div>               
    </div> 
            <?php
        } else {

        }
        ?>
    </section>
</div>

<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "/teacher/sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }
    $(document).ready(function () {
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "/teacher/sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#feecategory_id', function (e) {           
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });
                    $('#feetype_id').append(div_data);
                }
            });
        });
    });

    $(document).on('change', '#section_id', function (e) {
        $("form#schedule-form").submit();
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';
    function printDiv(elem) {       
        Popup(jQuery(elem).html());
    }

    function Popup(data) 
        {
          
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({ "position": "absolute", "top": "-1000000px" });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
        

        return true;
    }
</script>