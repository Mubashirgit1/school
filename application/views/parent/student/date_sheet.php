<div class="content-wrapper" style="min-height: 946px;">
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
           <h4 class="pull-left">
           Classes Exam Schedule (<?= $select_exam_detail['name']?>)
           </h4>
           <div class="pull-right">
            <form action="<?php echo site_url( 'parent/parents/dateSheet' ) ?>" method="post" class="form-inline">
                <div class="form-group">
                 <label for="exampleInputFile">Select Exam</label>
                 <select class="form-control" id="credit" name="exam_id">
                                                          <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $exam as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $value['id']; ?>"  <?php if ( set_value( 'credit', $bank['credit'] ) == $value['id'] ) echo "selected"; ?> ><?php echo $value['name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                </div>
                <div class="form-group">
                    <button type="submit" id="submit" class="btn btn-info pull-right">Search</button>
                </div>
              </form>
           </div>
                    </div>
                    
                    <div class="box-body">
                        <?php
                        if ( $class_section_incharge === false ):
                            echo '<h3>No Class, Section and incharge teacher found!</h3>';
                        else:
                            ?>
                            <table class="table     table-bordered table-hover  xyz">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="85px">Date.</th>
                                    <?php foreach($classlist as $class){?>
                                        <th class="text-center"><?= $class['class'] ?></th>
                                    <?php } ?>
                                 </tr>
                                </thead>
                                <tbody>
                                 <?php foreach($examschedule as $key=>$schedule){ ?>
                                 <tr>
                                 <td class="text-center"><?= date("d-M-Y",strtotime($key)); ?></td>
                                 <?php foreach($schedule as $key2=>$sche){ ?>
                                  <td class="text-center"><?php print_r($sche[0][0]['subject'])?><br>
                                  <?= $sche[0][0]['start_to'] ?>
                                  <?= $sche[0][0]['end_from'] ?>
                                  
                               
                                  </td>
                                   <?php } }?> 
                               </tbody>
                            </table>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>

            </div>
        </div>
</div>
</section>
</div>

