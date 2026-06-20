<style type="text/css">
    .voucher_head{
        font-size: 16px;
        font-weight: bold;
    }
    
    .padding_lr_0{
        padding-left: 0px;
        padding-right: 0px;
    }
    .voucher_head_information{
        border-right: 0px !important;
        border-top: 2px solid #ddd !important;
        border-bottom: 2px solid #ddd !important;
        border-left: : 0px;
        font-size: 16px;
        font-weight: bold !important;
    }
    .voucher_content_information{
        border-right: 0px !important;
        border-top: 0px !important;
        border-bottom: 1px solid #ddd;
        border-left: : 0px !important;
    }
</style>

<div class="hidden-print text-left">
    <button class="btn btn-default" onclick="location.href = document.referrer; return false;">Back</button>
    <button class="btn btn-primary" onclick="window.print()">Print</button>
</div>

<div class="student_card_container">
        <?php foreach($student as $stud){?>

    <div class="student_card_part_container " style="margin-bottom: 40px; float: left;">
            <div class="student_card_part">
                <div class="row voucher_header">
                    <table>
                        <tr>
                            <td width="30%" class="text-center">
                                <div class="fee_voucher_logo">
                                </div>
                            </td>
                            <td>
                                <div class="fee_voucher_type">

                                </div>
                                <div class="fee_voucher_heading voucher_head">
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>


                <div class="fee_voucher_body">
                    <!-- <div class="fee_voucher_body_heading">Fee Voucher</div> -->

                    <div class="fee_voucher_student_details">
                        <br>
                        <table class="table">
                            <thead>
                            <tr class="" style="border-radius:2px; border:2px solid black">
                                <td width="35%" >
                                    <div class="fee_voucher_logo">
                                        <img style="margin-top:5px" src="<?= base_url( "uploads/school_content/logo/{$school_logo}" ) ?>" title="<?= $school_name ?>">
                                    </div>
                                </td>

                                <td width="65%" colspan="3" class="text-center"><div style="margin-top:11px;"><b><?= $school_name ?></b>
                                        <br>  <?php echo $settinglist[0]['address'] ?> <br>
                                        <?php echo $settinglist[0]['phone'] ?>
                                    </div></td>

                            </tr>

                            <tr style="font-size:16px;">
                                <td width="25%"  rowspan="3" >
                                    <div style="margin-left:15px;">
                                        <img class="img-responsive" alt="Cinque Terre" src="<?php echo base_url() . $stud['image'] ?>" alt="Image"></a>
                                    </div>
                                </td>
                                <td width="10%">Name</td>
                                <td width="45%">: &nbsp&nbsp<?= $stud['firstname']." ".$stud['lastname']?></td>
                                <td width="20%"></td>

                            </tr>
                            <tr style="font-size:17px;">

                                <td width="10%">Class/Section</td>
                                <td width="45%">: &nbsp&nbsp<?= $stud['class']?>/<?= $stud['section']?></td>
                                <td width="20%"></td>

                            </tr>
                            <tr style="font-size:16px;">

                                <td width="10%"><?= admission_text() ?></td>
                                <td width="15%">: &nbsp&nbsp<?= $stud['admission_no']?></td>
                                <td width="30%"></td>

                            </tr>
                            <tr style="font-size:16px;">
                                <td width="35%"></td>
                                <td width="10%">Address</td>
                                <td width="15%">: &nbsp&nbsp<?= $stud['current_address']?></td>
                                <td width="30%"></td>

                            </tr>

                            <tr style="font-size:16px;">
                                <td width="30%"></td>

                                <td width="10%"></td>
                                <td width="15%"></td>
                                <td width="30%">Principal </td>

                            </tr>
                            </thead>
                        </table>

                    </div>


                </div>
            </div>
    </div>

        <?php  } ?>


</div>
