{
"iTotalRecords" :
<?=10;?>
,
"iTotalDisplayRecords" :
<?= 10;?>
,
"aaData" :
[
<?php
if($records){

   // print_r($records);
    foreach($records as $index => $record){
        ?>
        [
        <?=json_encode($record->id) ;?>,
        <?=json_encode($record->student_id) ;?>,
        <?=json_encode($record->total_fee) ;?>,
        ]
        <?=($index + 1 < count($records) ? ',': '');?>
    <?php }} ?>
]
}