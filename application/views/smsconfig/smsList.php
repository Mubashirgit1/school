<div class="content-wrapper" style="min-height: 946px;">
  <section class="content-header">
    <h1>
      <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_3" data-toggle="tab"><?php echo $this->lang->line('custom_sms_gateway'); ?></a></li>
              <li><a href="#tab_2" data-toggle="tab"><?php echo $this->lang->line('twilio_sms_gateway'); ?></a></li>
              <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('clickatell_sms_gateway'); ?></a></li>
              <li class="pull-left header"><i class="fa fa-mobile"></i> <?php echo $this->lang->line('sms_setting'); ?></li>

            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <form role="form" id="clickatell" action="<?php echo site_url('smsconfig/clickatell')?>" class="form-horizontal" method="post">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-7">
                          <?php 
                          $clickatell_result=check_in_array('clickatell',$smslist);
                          ?>

                          <div class="form-group">
                            <label class="col-sm-5 control-label"><?php echo $this->lang->line('clickatell_username'); ?></label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="clickatell_user" value="<?php echo $clickatell_result->username; ?>">
                              <span class=" text text-danger clickatell_user_error"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label"><?php echo $this->lang->line('clickatell_password'); ?></label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="clickatell_password"  value="<?php echo $clickatell_result->password; ?>">
                              <span class=" text text-danger clickatell_password_error"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label"><?php echo $this->lang->line('clickatell_api_id'); ?></label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="clickatell_api_id"  value="<?php echo $clickatell_result->api_id; ?>">
                              <span class=" text text-danger clickatell_api_id_error"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-5 control-label"><?php echo $this->lang->line('status'); ?></label>
                            <div class="col-sm-7">

                              <select class="form-control" name="clickatell_status">
                                <?php 
                                foreach ($statuslist as $s_key => $s_value) {
                                 ?>
                                 <option 
                                 value="<?php echo $s_key;?>"
                                 <?php if($clickatell_result->is_active == $s_key){
                                  echo "selected=selected";
                                } ?>
                                ><?php echo $s_value;?></option>
                                <?php
                              }
                              ?>
                            </select>
                            <span class=" text text-danger clickatell_api_id_error"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5 text text-center">
                        <a href="https://www.clickatell.com/"  target="_blank"><img src="<?php echo base_url()?>backend/images/clickatell.png"></a><br/>
                        <a href="https://www.clickatell.com/" target="_blank">https://www.clickatell.com</a>
                      </div>
                    </div>
                    
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary col-md-offset-3"><?php echo $this->lang->line('save'); ?></button>&nbsp;&nbsp;<span class="clickatell_loader"></span>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">

              <form role="form" id="twilio" id="twilio" action="<?php echo site_url('smsconfig/twilio')?>" class="form-horizontal" method="post">
                <div class="box-body">

                 <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-7">
                      <?php 
                      $twilio_result=check_in_array('twilio',$smslist);
                      ?>
                      <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $this->lang->line('twilio_account_sid'); ?></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="twilio_account_sid" value="<?php echo $twilio_result->api_id; ?>">
                          <span class="text text-danger twilio_account_sid_error"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $this->lang->line('authentication_token'); ?></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="twilio_auth_token" value="<?php echo $twilio_result->password; ?>">
                          <span class="text text-danger twilio_auth_token_error"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $this->lang->line('registered_phone_number'); ?></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="twilio_sender_phone_number" value="<?php echo $twilio_result->contact; ?>">
                          <span class="text text-danger twilio_sender_phone_number_error"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label"><?php echo $this->lang->line('status'); ?></label>
                        <div class="col-sm-7">
                          <select class="form-control" name="twilio_status">
                            <?php 
                            foreach ($statuslist as $s_key => $s_value) {
                             ?>
                             <option
                             value="<?php echo $s_key;?>"
                             <?php if($twilio_result->is_active == $s_key){
                              echo "selected=selected";
                            } ?>
                            ><?php echo $s_value;?></option>
                            <?php
                          }
                          ?>
                        </select>
                        <span class=" text text-danger clickatell_api_id_error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 text text-center">
                   <a href="https://www.twilio.com/?v=t"  target="_blank"><img src="<?php echo base_url()?>backend/images/twilio.png"></a><br/>
                   <a href="https://www.twilio.com/?v=t" target="_blank">https://www.twilio.com</a>
                   
                 </div>
               </div>
             </div>

           </div>
           <!-- /.box-body -->

           <div class="box-footer">
            <button type="submit" class="btn btn-primary col-md-offset-3"><?php echo $this->lang->line('save'); ?></button>&nbsp;&nbsp;<span class="twilio_loader"></span>
          </div>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3">

        <form role="form" id="custom" id="custom" action="<?php echo site_url('smsconfig/custom')?>" class="form-horizontal" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-7">
                  <?php 
                  $custom_result=check_in_array('custom',$smslist);
                  ?>
                  <div class="form-group">
                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('gateway_name'); ?>
</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="name" value="<?php echo $custom_result->name; ?>">
                      <span class="text text-danger name_error"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('username'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="username" value="<?php echo $custom_result->username; ?>">
                      <span class="text text-danger username_error"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('password'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="password" value="<?php echo $custom_result->password; ?>">
                      <span class="text text-danger password_error"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('url'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="url" value="<?php echo $custom_result->url; ?>">
                      <span class="text text-danger url_error"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-5 control-label"><?php echo $this->lang->line('status'); ?></label>
                    <div class="col-sm-7">
                      <select class="form-control" name="custom_status">
                        <?php 
                        foreach ($statuslist as $s_key => $s_value) {
                         ?>
                         <option 
                         value="<?php echo $s_key;?>"
                         <?php if($custom_result->is_active == $s_key){
                          echo "selected=selected";
                        } ?>
                        ><?php echo $s_value;?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <span class=" text text-danger clickatell_api_id_error"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-5 text text-center">
                <img src="<?php echo base_url()?>backend/images/custom-sms.png">
              </div>
            </div>
          </div>

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary col-md-offset-3"><?php echo $this->lang->line('save'); ?></button>&nbsp;&nbsp;<span class="custom_loader"></span>
        </div>
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
  <!-- /.tab-content -->
</div>
</div>
</div>  
</section>
</div>

<?php 

function check_in_array($find,$array){

  foreach ( $array as $element ) {
    if ( $find == $element->type ) {
     return $element;
   }
 }
 $object = new stdClass();
 $object->id="";
 $object->type ="";
 $object->api_id ="";
 $object->username="";
 $object->url="";
 $object->name="";
 $object->contact="";
 $object->password="";
 $object->is_active="";
 return $object;

}
?>


<script type="text/javascript">
 var img_path="<?php echo base_url().'/backend/images/loading.gif' ?>";
 $("#clickatell").submit(function(e) {
   $("[class$='_error']").html("");

   $(".clickatell_loader").html('<img src="'+img_path+'">');
    var url = $(this).attr('action'); // the script where you handle the form input.

    $.ajax({
     type: "POST",
     dataType:'JSON',
     url: url,
           data: $("#clickatell").serialize(), // serializes the form's elements.
           success:function(data, textStatus, jqXHR) 
           {
            if(data.st ===1 ){
              $.each( data.msg, function( key, value ) {
                $('.'+key+"_error").html(value);
              });
            }else{
              console.log('dsfds');
              $("span[class$='_error']").html(""); 
            }
            $(".clickatell_loader").html("");

          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
            $(".clickatell_loader").html("");
            //if fails      
          }
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.
  });

 $("#twilio").submit(function(e) {
   $("[class$='_error']").html("");

   $(".twilio_loader").html('<img src="'+img_path+'">');
    var url = $(this).attr('action'); // the script where you handle the form input.

    $.ajax({
     type: "POST",
     dataType:'JSON',
     url: url,
           data: $("#twilio").serialize(), // serializes the form's elements.
           success:function(data, textStatus, jqXHR) 
           {
            if(data.st ===1 ){
              $.each( data.msg, function( key, value ) {
                $('.'+key+"_error").html(value);
              });
            }else{



            }
            $(".twilio_loader").html("");

          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
            $(".twilio_loader").html("");
            //if fails      
          }
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.
  });


 $("#custom").submit(function(e) {
   $("[class$='_error']").html("");

   $(".custom_loader").html('<img src="'+img_path+'">');
    var url = $(this).attr('action'); // the script where you handle the form input.

    $.ajax({
     type: "POST",
     dataType:'JSON',
     url: url,
           data: $("#custom").serialize(), // serializes the form's elements.
           success:function(data, textStatus, jqXHR) 
           {
            if(data.st ===1 ){
              $.each( data.msg, function( key, value ) {
                $('.'+key+"_error").html(value);
              });
            }else{



            }
            $(".custom_loader").html("");

          },
          error: function(jqXHR, textStatus, errorThrown) 
          {
            $(".custom_loader").html("");
            //if fails      
          }
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.
  });
</script>


