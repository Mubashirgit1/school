<div class="content-wrapper" style="min-height: 946px;">
    <?php
        $this->load->view('layout/academics_link');
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Class Fee Updation</h3>
                    </div>

                    <div class="box-body">
                    
                            <table class="table table-bordered table-hover example xyz">
                                <thead>
                                
                                <tr>
                                    <th class="text-center">Date.</th>
                                    <?php foreach($classlist as $class){?>
                                        <th class="text-center"><?= $class['class'] ?></th>                             
                                    <?php } ?>
                                 </tr>   
                                </thead>

                                <tbody>
                               
                                
                                 <?php foreach($class_fee as $key=>$fee){ ?>
                                  <tr>
                                 <td class="text-center"><?= $key ?></td>
                                 <?php foreach($fee as $key2=>$fee_cla){ 
								if($fee_cla == null){ ?>	
								 <td class="text-center"><?= 0 ?></td>
                                <?php	}else{  ?>
                                 <td class="text-center">
                                 <?php foreach($fee_cla as $cla){
									 echo $cla['class_fee']."<br>";
									 } ?></td>
                                 
                                    <?php } } ?> 
                                
                           
                                 </tr>
                                    <?php } ?> 
                            </tbody>
                            </table>
                    </div>
                </div>

            </div>
        </div>
</div>
</section>
</div>

