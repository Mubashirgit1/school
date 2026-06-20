        <div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Class</td>
                        <td><?php echo $question['class']." " . $question['section_name']; ?></td>
                    </tr>
                    
                    <tr>
                        <td>Subject</td>
                        <td><?php echo $question['subject'] ?></td>
                    </tr>
                    <tr>
                        <td>Teacher</td>
                        <td><?php echo $question['teacher'] ?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td><?php echo date("jS M Y", strtotime($question['date'])); ?></td>
                    </tr>
                    <tr>
                        <td>
                            Total Marks
                        </td>
                        <td>
                            <?php echo $question['marks']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Passing Marks
                        </td>
                        <td>
                            <?php echo $question['passing_marks']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        
        <script>


// function addMarks()
// {
//   let data=$('#marks_form').serialize();
   
//   console.log(data);
// }
$(function(){
     $('#marks_form').on('submit',function(e){
        e.preventDefault();
        
        $.ajax({
            
            url:'<?php echo base_url() ?>teacher/assignment/saveMarks',
            type:'post',
            data:$(this).serialize(),
            success:function(data)
            {
                if(data)
                {
        alert('marks updated');
                }
            }
        })
        
    })   
    
})

    
</script>

     <form id="marks_form">
<table class="table table-hover table-bordered" >
    <thead>
        <tr>
            <th>Sr.</th>
             <th>Admission No.</th>
              <th>Roll No.</th>
              <th>Student Name</th>
              <th>Submission Date</th>
              <th>View</th>
              <th>Download</th>
              <th>Marks Obtained</th>
              <th>%age</th>
              <th>Status</th>
        </tr>
    </thead>

    <tbody>
        
       
        <?php foreach($assignments as $key=> $result): 
           
        ?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=$result['admission_no']?></td>
            <td><?=$result['std_roll_no']?></td>
            <td><?=$result['std_fname']." ".$result['std_lname']?></td>
            <td><?=date("jS M Y", strtotime($result['date']))?></td>
            <td><a class="btn btn-xs btn-default" target="_blank" href="<?php echo base_url().$result['file']; ?>" ><i class="fa fa-eye"></i></a></td>
            <td><a class="btn btn-xs btn-default" download href="<?php echo base_url().$result['file']; ?>" ><i class="fa fa-download"></i></a></td>
            <td>
                <input type="number" step="0.01" name="marks[<?php echo $result['id'] ?>]" max="<?php echo $question['marks']; ?>" value="<?php echo $result['marks'] ?>" placeholder="Obtained Marks"/>
            </td>
            <td>    <?php 
            if($result['marks']){
            echo $obtained=$result['marks']/$question['marks']*100;
            }
            ?></td>
            <td>
                
                <?php
                
                if($result['marks']){
                if($result['marks']<$question['passing_marks']){
                    ?>
                    <span style="color:red">Fail</span>
                    <?php
                }else
                
                echo "Pass";
                    
                }
                ?>
                
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7">
                
            </td>
            
            <td colspan="3">
                <button type="submit"  class="btn btn-xs btn-default btn-block">Save</button>
            </td>
        </tr>
        
    </tbody>
   
</table>

 </form>




<h3>Pending</h3>
<table class="table table-hover table-bordered" >
    <thead>
        <tr>
            <th>Sr.</th>
             <th>Admission No.</th>
              <th>Roll No.</th>
              <th>Student Name</th>
              <th>Father Name</th>
              <th>Phone</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php
       foreach($pending as $key=> $result): 
     


        ?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=$result['admission_no']?></td>
            <td><?=$result['roll_no']?></td>
            <td><?=$result['firstname']." ".$result['lastname']?></td>
            <td><?=$result['father_name']?></td>
            <td><?=$result['father_phone']?></td>
        </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>