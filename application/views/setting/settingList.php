    <div class="content-wrapper" style="min-height: 946px;">    
    <section class="content-header">
<!--        <h1>-->
<!--            <i class="fa fa-gears"></i> --><?php //echo $this->lang->line('system_settings'); ?><!--</h1>-->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-gear"></i> <?php echo $this->lang->line('general_settings'); ?></h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <a href="<?php echo base_url(); ?>schsettings/edit/<?php echo $settinglist[0]['id']; ?>" class="btn btn-primary btn-sm checkbox-toggle addcourse pull-right" data-toggle="tooltip" title="<?php echo $this->lang->line('edit_setting'); ?>" ><i class="fa fa-pencil"></i> <?php echo $this->lang->line('edit'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">                          
                        </div>
                        <div class="row" style="padding: 5px;">
                            <div class="col-md-3">
                                <?php
                                if ($settinglist[0]['image'] == "") {
                                    ?>
                                    <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?><?php echo $settinglist[0]['image']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                                    <?php
                                }
                                ?>
                                <br/>
                                <br/>
                                <a class="btn btn-sm btn-primary col-md-offset-4" href="<?php echo base_url() ?>schsettings/editLogo/<?php echo $settinglist[0]['id']; ?>"><i class="fa fa-picture-o"></i> <?php echo $this->lang->line('edit_logo'); ?></a>
                                <br>
                                <br>



                                <?php
                                if ($settinglist[0]['splash'] == "") {
                                    ?>
                                    <img src="<?php echo base_url() ?>login/img/pt_bg.jpeg" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo base_url() ?><?php echo $settinglist[0]['splash']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                                    <?php
                                }
                                ?>
                                <br/>
                                <br/>
                                <a class="btn btn-sm btn-primary col-md-offset-4" href="<?php echo base_url() ?>schsettings/editLoginScreenImage/<?php echo $settinglist[0]['id']; ?>"><i class="fa fa-picture-o"></i> <?php echo 'Edit Login Screen'; ?></a>
                                <br>
                                <br>





                            </div>
                            <div class="col-md-9">
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover    ">
                                        <tbody>
                                            <tr>
                                                <td><?php echo $this->lang->line('school_name'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('address'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['address'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('phone'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['phone'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('email'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('school_code'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['dise_code'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('session'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['session'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('session_start_month'); ?></td>
                                                <td class="mailbox-name">
                                                    <?php
                                                    foreach ($getMonthList as $key => $value) {
                                                        if ($key == $settinglist[0]['start_month'])
                                                            echo $value;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('language'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['language'] ?></td>
                                            </tr>                                                
                                            <tr>
                                                <td><?php echo $this->lang->line('language_rtl_text_mode'); ?></td>
                                                <td class="mailbox-name"> <?php echo ucfirst($settinglist[0]['is_rtl']); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('timezone'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['timezone'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('date_format'); ?></td>
                                                <td class="mailbox-name">
                                                    <?php
                                                    foreach ($date_formatlist as $k => $f_v) {
                                                        if ($k == $settinglist[0]['date_format']) {
                                                            echo $f_v;
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $this->lang->line('currency'); ?></td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['currency'] ?></td>
                                            </tr>

                                            <tr>
                                                <td>Saturday ON/OFF</td>
                                                    <?php if($settinglist[0]['saturday']  ==  "1"){
                                                            $saturday = "ON";
                                                         }else{
                                                            $saturday = "OFF";
                                                        } ?>

                                                <td class="mailbox-name"> <?php echo $saturday ?></td>
                                            </tr>
                                            <tr>
                                                <td>Message brand/Non-brand</td>

                                                    <?php if($settinglist[0]['message_type']  ==  "1"){
                                                        $type = "Brand";
                                                         }else{
                                                        $type = " Non-Brand";
                                                        } ?>

                                                <td class="mailbox-name"> <?php echo $type ?></td>
                                            </tr>
                                            <tr>
                                                <td>Message Username</td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['username'] ?></td>
                                            </tr><tr>
                                                <td>Message Password</td>
                                                <td class="mailbox-name"> <?php echo $settinglist[0]['password'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">                            
                        </div>
                    </div>
                </div>
            </div>  
        </div> 
    </section>
</div>