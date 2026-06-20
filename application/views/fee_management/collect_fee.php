<div class="content-wrapper">

    <section class="content-header">

        <h1><i class="fa fa-money"></i> Collect fee</h1>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-sm-5">

                <?php
                $this->general_library->err_msg();
                ?>

                <div class="box box-primary">

                    <div class="box-header">
                        <h3 class="box-title">Search student</h3>
                    </div>

                    <div class="box-body">

<!--                        <form action="--><?//= site_url('fee_management/receive_fee') ?><!--" method="get">-->
<!---->
<!--                            <div class="form-group">-->
<!--                                <label>Student's Admission/Registration Number</label>-->
<!--                                <input type="text" class="form-control" name="student_registration_no" value="--><?//= set_value('student_id') ?><!--" placeholder="Admission/Registration id of the student">-->
<!--                            </div>-->
<!---->
<!--                            <div>-->
<!--                                <button type="submit" class="btn btn-primary pull-right">Search Student</button>-->
<!--                            </div>-->
<!---->
<!--                        </form>-->

                        <form action="<?= site_url('student/search') ?>" method="post">

                            <div class="form-group">
                                <label>Search By</label>
                                <input type="text" class="form-control" name="search_text" value="<?= set_value('search_text') ?>" placeholder="Search By Name, Roll Number, Enroll Number, National Id, Local Id Etc..">
                            </div>

                            <div>
                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right">Search Student</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>