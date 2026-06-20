
<!DOCTYPE html>
<html>
<head>
    <title>Codeigniter 3 Datatables Ajax Example</title>







</head>
<body>


<div class="container">
    <h2>Codeigniter 3 Datatables Ajax Example</h2>
    <table id="item-list" class="table table-bordered     table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Description</th>

        </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
</div>


</body>


<script type="text/javascript">
    $(document).ready(function() {
        $('#item-list').DataTable({
            "ajax": {
                url : "unpaid_student_ajax",
                type : 'POST'
            },
        });
    });
</script>


</html>