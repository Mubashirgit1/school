<div class="content-wrapper">
    <section class="content-header">
        <h1>
        <?php 
          $admind = $this->session->userdata( 'admin' ); 
          $this->load->helper('menu_helper');
          $permission = admin_permission($admind['id']);
        
        ?>
            <i class="fa fa-gears"></i>
            <?php echo $this->lang->line( 'system_settings' ); ?>
            <small></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line( 'general_settings' ); ?></h3>
                    </div>
                    <form action="<?php echo site_url( "Schsettings/edit/" . $id ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" class="form-horizontal form-label-left">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'school_name' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'name', $setting['name'] ); ?>"/>
                                    <span class="text-danger"><?php echo form_error( 'name' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'address' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" rows="3" id="address" name="address" placeholder="" placeholder=""><?php echo set_value( 'address', $setting['address'] ); ?></textarea>
                                    <span class="text-danger"><?php echo form_error( 'address' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'phone' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="phone" name="phone" placeholder="" type="text" value="<?php echo set_value( 'phone', $setting['phone'] ); ?>"/>
                                    <span class="text-danger"><?php echo form_error( 'phone' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'email' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="email" name="email" placeholder="" type="text" value="<?php echo set_value( 'email', $setting['email'] ); ?>"/>
                                    <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line( 'school_code' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="dise_code" name="dise_code" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value( 'dise_code', $setting['dise_code'] ); ?>"/>
                                    <span class="text-danger"><?php echo form_error( 'dise_code' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'session' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="session_id" name="session_id" class="form-control col-md-7 col-xs-12">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $sessionlist as $session ) {
                                            ?>
                                            <option value="<?php echo $session['id'] ?>" <?php
                                            if ( $setting['session_id'] == $session['id'] ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $session['session'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'session_id' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'session_start_month' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="start_month" name="start_month" class="form-control col-md-7 col-xs-12">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $monthList as $key => $month ) {
                                            ?>
                                            <option value="<?php echo $key ?>"<?php
                                            if ( $setting['start_month'] == $key ) {
                                                echo "selected =selected";
                                            }
                                            ?> ><?php echo $month ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'session_id' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'language' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="language_id" name="lang_id" class="form-control col-md-7 col-xs-12">
                                        <option value="">--Select--</option>
                                        <?php
                                        foreach ( $languagelist as $language ) {
                                            ?>
                                            <option value="<?php echo $language['id'] ?>" <?php
                                            if ( set_value( 'lang_id', $setting['lang_id'] ) == $language['id'] ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $language['language'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'language_id' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="IsSmallBusiness"><?php echo $this->lang->line( 'language_rtl_text_mode' ); ?></label>
                                <div class="col-md-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="is_rtl" value="disabled" <?php echo ( set_value( 'is_rtl', $setting['is_rtl'] ) == "disabled" ) ? "checked" : "" ?>><?php echo $this->lang->line( 'disabled' ); ?>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="is_rtl" value="enabled" <?php echo ( set_value( 'is_rtl', $setting['is_rtl'] ) == "enabled" ) ? "checked" : "" ?>><?php echo $this->lang->line( 'enabled' ); ?>
                                    </label>


                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'timezone' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="language_id" name="timezone" class="form-control col-md-7 col-xs-12">
                                        <option value="">--Select--</option>
                                        <?php
                                        foreach ( $timezoneList as $key => $timezone ) {
                                            ?>
                                            <option value="<?php echo $key ?>"
                                                <?php
                                                if ( set_value( 'timezone', $setting['timezone'] ) == $key ) {
                                                    echo "selected =selected";
                                                }
                                                ?>
                                            ><?php echo $timezone ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'timezone' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'date_format' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="date_format" name="date_format" class="form-control col-md-7 col-xs-12">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $dateFormatList as $key => $dateformat ) {
                                            ?>
                                            <option value="<?php echo $key ?>" <?php
                                            if ( $setting['date_format'] == $key ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $dateformat; ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'date_format' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'currency' ); ?></label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="currency" name="currency" class="form-control col-md-7 col-xs-12">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $currencyList as $currency ) {
                                            ?>
                                            <option value="<?php echo $currency ?>" <?php
                                            if ( $setting['currency'] == $currency ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $currency; ?></option>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error( 'currency' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line( 'currency_symbol' ); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="currency_symbol" name="currency_symbol" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value( 'currency_symbol', $setting['currency_symbol'] ); ?>"/>
                                    <span class="text-danger"><?php echo form_error( 'currency_symbol' ); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Message Username</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="username" name="username" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value( 'username', $setting['username'] ); ?>"/>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Message Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" name="password" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value( 'password', $setting['password'] ); ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Message Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="message_type" name="message_type" class="form-control col-md-7 col-xs-12">
                                            <option value="0">Non-brand</option>
                                            <option <?= $setting['message_type']  == 1 ?  "selected=selected" : ''  ?> value="1">Brand</option>
                                    </select>
                                </div>
                            </div>
                        <?php if($permission->saturday == 1){ ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Student Saturday ON/OFF </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="saturday" name="saturday"  class="form-control col-md-7 col-xs-12">
                                            <option   value="0">OFF</option>
                                            <option <?= $setting['saturday']  == 1 ?  "selected=selected" : ''  ?>  value="1">ON</option>
                                    </select>
                                </div>
                            </div> 
                        <?php }?>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Staff Saturday ON/OFF </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="staff_saturday" name="staff_saturday"  class="form-control col-md-7 col-xs-12">
                                            <option   value="0">OFF</option>
                                            <option <?= $setting['staff_saturday']  == 1 ?  "selected=selected" : ''  ?>  value="1">ON</option>
                                    </select>
                                </div>
                            </div>

                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Admission Class Key </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="admission_key" name="admission_key"  class="form-control col-md-7 col-xs-12">
                                    
                                            <option  value="0">OFF</option>
                                            <option <?= $setting['admission_key']  == 1 ?  "selected=selected" : ''  ?> value="1">ON</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">Voucher Fine in Arrears </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="vr_fine" name="vr_fine"  class="form-control col-md-7 col-xs-12">
                                            <option value="0">OFF</option>
                                            <option <?= $setting['vr_fine']  == 1 ?  "selected=selected" : ''  ?> value="1">ON</option>
                                    </select>
                                </div>
                            </div> 
                          </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-info pull-center"><?php echo $this->lang->line( 'save' ); ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>