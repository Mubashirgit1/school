<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> Options
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-5 col-lg-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-gear"></i> System Options</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback"></div>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php $this->general_library->err_msg() ?>
 
                        <form action="<?= site_url( 'options/index_process' ) ?>" method="post">
                            <div class="form-group">
                                <label>Teacher's max leaves in a month</label>
                                <input type="number" class="form-control" name="teachers_max_leaves_in_month" min="0" value="<?= set_value( 'teachers_max_leaves_in_month', $teachers_max_leaves_in_month['value'] ) ?>" placeholder="Teacher's max leaves in a month" autofocus>
                            </div>

                            <div class="form-group">
                                <label>Teacher's salary deduction per extra leave</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="teachers_salary_deduction_per_leave" min="0" max="100" value="<?= set_value( 'teachers_salary_deduction_per_leave', $teachers_salary_deduction_per_leave['value'] ) ?>" placeholder="Teacher's salary deduction per extra leave">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Last fee receiving date
                                    <small>(Every month)</small>
                                </label>
                                <input type="number" class="form-control" name="last_date_for_receiving_fee" value="<?= set_value( 'last_date_for_receiving_fee', $last_date_for_receiving_fee['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Voucher Expiry date for fee receiving 
                                    <small>(Every month)</small>
                                </label>
                                <input type="number" class="form-control" name="expiry_date_for_receiving_fee" value="<?= set_value( 'expiry_date_for_receiving_fee', $expiry_date_for_receiving_fee['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Fee Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="student_fee_fine_type" value="fixed_fine_after_due_date" <?= set_radio( 'student_fee_fine_type', 'fixed_fine_after_due_date', $student_fee_fine_type['value'] == 'fixed_fine_after_due_date' ) ?> > Fixed fine after due date
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="student_fee_fine_type" value="per_day_fine_after_due_date" <?= set_radio( 'student_fee_fine_type', 'per_day_fine_after_due_date', $student_fee_fine_type['value'] == 'per_day_fine_after_due_date' ) ?> > Fine per day for fee after due date
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sibling Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sibling_type" value="phone_sibling" <?= set_radio( 'sibling_type', 'phone_sibling', $sibling_type['value'] == 'phone_sibling' ) ?> >Fixed Sibling with Phone Number
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sibling_type" value="cnic_sibling" <?= set_radio( 'sibling_type', 'cnic_sibling', $sibling_type['value'] == 'cnic_sibling' ) ?> >  Fixed Sibling with Father Cnic
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Student Fee Fine (Fine per day/Fixed fine after due date)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rs.</span>
                                    <input type="number" class="form-control" name="fine_per_day_for_fee" value="<?= set_value( 'fine_per_day_for_fee', $fine_per_day_for_fee['value'] ) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Teacher (Eobi/Fixed From Teacher Salary)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rs.</span>
                                    <input type="number" class="form-control" name="eobi" value="<?= set_value( 'eobi', $eobi['value'] ) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Restrict attendance For Teacher after</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Time</span>
                                    <input type="time" class="form-control" name="restrict_attendance_after" value="<?= set_value( 'restrict_attendance_after', $restrict_attendance_after['value'] ) ?>">
                                </div>
                            </div>

                           <div class="form-group">
                                <label>Restrict attendance For Staff after</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Time</span>
                                    <input type="time" class="form-control" name="restrict_attendance_after_staff" value="<?= set_value( 'restrict_attendance_after_staff', $restrict_attendance_after_staff['value'] ) ?>">
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Admin Phone No For SMS reception</label>
                                <input type="text" class="form-control" name="admin_phone" value="<?= set_value( 'admin_phone', $admin_phone['value'] ) ?>">
                            </div>

                            <div class="form-group">
                                <label>Bank Details on Bottom of Tuition Fee Voucher</label>
                                <input type="text" class="form-control" name="bank_account" value="<?= set_value( 'bank_account', $bank_account['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Text For Admission</label>
                                <input type="text" class="form-control" name="text_admission" value="<?= set_value( 'text_admission', $text_admission['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Voucher Reprint Fee</label>
                                <input type="number" class="form-control" name="reprint_fee" value="<?= set_value( 'reprint_fee', $reprint_fee['value'] ) ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Bank Name For top Details</label>
                                <input type="text" class="form-control" name="bank_name" value="<?= set_value( 'bank_name', $bank_name['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Bank Details on Top of Tuition Fee Voucher </label>
                                <input type="text" class="form-control" name="bank_account_top" value="<?= set_value( 'bank_account_top', $bank_account_top['value'] ) ?>">
                            </div>
                            <div class="form-group">
                                <label>Bank Account Other Fee Voucher</label>
                                <input type="text" class="form-control" name="bank_account_other" value="<?= set_value( 'bank_account_other', $bank_account_other['value'] ) ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>