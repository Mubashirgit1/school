<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
    .bootstrap-select .bs-ok-default::after {
    width: 0.3em;
    height: 0.6em;
    border-width: 0 0.1em 0.1em 0;
    transform: rotate(45deg) translateY(0.5rem);
    }

    .btn.dropdown-toggle:focus {
        outline: none !important;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <?php
        $this->load->view('layout/academics_link');
    ?>
    <section class="content-header">
    <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
           <h4 class="pull-left">
           Classs Group
           </h4>
        </div>
        </div>
        </div>
        
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Class Group List</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="form1" action="<?php echo site_url( 'classes/createClassGroup' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Class Group Name</label>
                                <input id="name" name="name" placeholder="" type="text" class="form-control" value=""/>
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Select Classes</label>
                                <select multiple data-style="bg-white rounded-pill px-4 py-3 shadow-sm " name="class[]" class="selectpicker w-100 form-control" required >
                                <option value="">< ?php echo $this->lang->line( 'select' ); ?></option>
                                < ?php
                                foreach ( $classlist as $class ) {
                                    ?>
                                    <option value="< ?php echo $class['id'] ?>" < ?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>>< ?php echo $class['class'] ?></option>
                                    < ?php
                                    $count++;
                                }
                                ?>
                            </select> -->
                            <!-- </div> -->
               
                            <div class="form-group">
                                <label for="exampleInputEmail1">Class Group Admission Key</label>
                                <input id="admission_key" name="admission_key" placeholder="" type="text" class="form-control" value=""/>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                        </div>
                    </form>
                </div>
            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary" id="exphead">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Class Group List </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body  ">
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Class Group Name</th>
                                     
                                        <th>Class group Admission Key</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ( empty( $categorylist ) ) {
                                        ?>

                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ( $categorylist as $category ) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover">
                                                        <?php echo $category['name'] ?>
                                                    </a>
                                                </td>
                                              
                                               
                                                <td class="mailbox-name">
                                                        <?php echo $category['admission_key'] ?>
                                                </td>
                                                
                                                <td class="mailbox-date pull-right no-print">
                                                    <a href="<?php echo base_url(); ?>classes/editClassGroup/<?php echo $category['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>classes/deleteClassGroup/<?php echo $category['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                   
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div>

       





            <!-- right column -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>
<script type="text/javascript">
     $('select').selectpicker();
    $( document ).ready( function () {
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );

</script>

<script>
    $( document ).ready( function () {
        $( '.detail_popover' ).popover( {
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $( this ).closest( 'td' ).find( '.fee_detail_popover' ).html();
            }
        } );
    } );
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';


    function Popup( data ) {

        var frame1 = $( '<iframe />' );
        frame1[0].name = "frame1";
        frame1.css( {"position": "absolute", "top": "-1000000px"} );
        $( "body" ).append( frame1 );
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write( '<html>' );
        frameDoc.document.write( '<head>' );
        frameDoc.document.write( '<title></title>' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">' );


        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">' );
        frameDoc.document.write( '</head>' );
        frameDoc.document.write( '<body>' );
        frameDoc.document.write( data );
        frameDoc.document.write( '</body>' );
        frameDoc.document.write( '</html>' );
        frameDoc.document.close();
        setTimeout( function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500 );


        return true;
    }


    $( "#print_div" ).click( function () {
        Popup( $( '#exphead' ).html() );
    } );

</script>