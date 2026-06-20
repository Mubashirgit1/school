<footer class="main-footer">
    &copy;  <?php echo date('Y'); ?> 
    <?php echo $this->customlib->getAppName(); ?> <?php echo $this->customlib->getAppVersion(); ?>   
</footer>
<div class="control-sidebar-bg"></div>
</div>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>

<script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/knob/jquery.knob.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/app.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
  var table = $('.example').DataTable();
  $('div.dataTables_filter input').attr('placeholder', 'Search...');
} );

</script>
<!--print table-->
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/jszip.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/pdfmake.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.colVis.min.js" ></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.print.min.js"></script>

<script type="text/javascript">
// $('.example').dataTable( {
//     paging: false
// } );
// $('.example').dataTable( {
//     paging: false
// } );
 
// $('.example').dataTable( {
//   "pageLength": 10
// } );


</script>
<script type="text/javascript">
    $(document).ready(function() {
        if ( $( '.example' ).length ) {
    var table = $('.example').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
        }
} );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        if ( $( '.example2' ).length ) {
    var table = $('.example2').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
        }
} );
</script>
<script type="text/javascript">
    $(document).ready(function() {

        if ( $( '#transation_history' ).length ) {
            var title = currrnet_month()+' Due Fee Reports';
            var table  = $( '#transation_history' );
            datatable_call(table,title,3, 19, [14]);
        }  


        function datatable_call(tablee,title , groupCol=0, totalCols=0,  UnOrderAble=[]){

if(groupCol >0){
    
     var table = tablee.not('.initialized').addClass('initialized').show().DataTable( {
         destroy: true,
        fixedHeader: {
            header: true,
            footer: true,
            headerOffset: $('.main-header').outerHeight()
        },

        "stateSave": false,
        "stateDuration": 60 * 60 * 24 * 365,
        "displayLength": 100,
        "sScrollX": "100%",
        
        // "scrollY":        "300px",
            // "scrollCollapse": true,
            
        order: [[groupCol, 'asc']],
        // drawCallback: function (settings) {
        //     var api = this.api();
        //     var rows = api.rows({page: 'current'}).nodes();
        //     var last = null;

        //     api.column(groupCol, {page: 'current'}).data().each(function (group, i) {
        //         if (last !== group) {
        //             $(rows).eq(i).before(
        //                 '<tr class="group"><td colspan="' + totalCols + '">' + group + '</td></tr>',
        //             );
        //             last = group;
        //         }
        //     });
        // },
        
        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({page: 'current'}).nodes();
            var last = null;
            var colonne = api.row(groupCol).data().length;
            var totale = new Array();
            totale['Totale'] = new Array();
            var groupid = -1;
            var subtotale = new Array();

            api.column(groupCol, {page: 'current'}).data().each(function (group, i) {
                if (last !== group) {
                    groupid++;
                    $(rows).eq(i).before(
                        '<tr class="group"><td>' + group + '</td></tr>'
                    );
                    last = group;
                }


                val = api.row(api.row($(rows).eq(i)).index()).data();      //current order index
                $.each(val, function (index2, val2) {
                    if (typeof subtotale[groupid] == 'undefined') {
                        subtotale[groupid] = new Array();
                    }
                    if (typeof subtotale[groupid][index2] == 'undefined') {
                        subtotale[groupid][index2] = 0;
                    }
                    if (typeof totale['Totale'][index2] == 'undefined') {
                        totale['Totale'][index2] = 0;
                    }

                    valore = Number(val2.replace('€', "").replace(',', ""));
                    subtotale[groupid][index2] += valore;
                    totale['Totale'][index2] += valore;
                });


            });
            $('tbody').find('.group').each(function (i, v) {
                var rowCount = $(this).nextUntil('.group').length;
                $(this).find('td:first').append($('<span />', {'class': 'rowCount-grid'}).append($('<b />', {'text': ' (' + rowCount + ')'})));
                var subtd = '';
                for (var a = 2; a < colonne; a++) {
                    var mySubtotal = "";

                    // allow columns only of index 10 to 17
                    if (a>=10 && a<=17) {
                        mySubtotal = $.fn.dataTable.render.number(',', '.', 0, '').display(subtotale[i][a]);
                    }

                    subtd += '<td class="text-center">' + mySubtotal + '' + '</td>';

                    // subtd += '<td>' + subtotale[i][a] + ' OUT OF ' + totale['Totale'][a] + ' (' + Math.round(subtotale[i][a] * 100 / totale['Totale'][a], 2) + '%) ' + '</td>';
                }
                $(this).append(subtd);
            });

        },
       
        columnDefs: [
          { orderable: false },
           {
                targets: UnOrderAble,
                orderable: false
            },
            {
                targets: groupCol,
                visible: false,
            },
       ]
        
        
        
    }
    );
            
            
} else {
    
    var table = tablee.DataTable( {
            "scrollY":        "300px",
            "scrollCollapse": true,
        });
            
}
            
            

    new $.fn.dataTable.Buttons( table, {
       buttons: [
           {
               extend: 'copyHtml5',
               text: '<i class="fa fa-files-o"></i>',
               titleAttr: 'Copy',
               exportOptions: {
                   columns: ':visible'
               }
           },
           {
               extend: 'excelHtml5',
               text: '<i class="fa fa-file-excel-o"></i>',
               titleAttr: 'Excel',
               exportOptions: {
                   columns: ':visible'
               }
           },
           {
               extend: 'csvHtml5',
               text: '<i class="fas fa-file-csv"></i>',
               titleAttr: 'CSV',
               exportOptions: {
                   columns: ':visible'
               }
           },

           {
               extend: 'pdfHtml5',
               text: '<i class="fa fa-file-pdf-o"></i>',
               titleAttr: 'PDF',
               exportOptions: {
                   columns: ':visible'
               }
           },
           {
               extend: 'print',
               customize: function ( win ) {
                   $(win.document.body)
                   .css( 'font-size', '12pt' )
                       
                   $(win.document.body).find( 'table' )
                       .addClass( 'compact' )
                       .css( 'font-size', 'inherit' );
               },
               text: '<i class="fa fa-print"></i>',
               title: title,
               titleAttr: 'Print',
               exportOptions: {
                   columns: ':visible'
               }
           },
           {
               extend: 'colvis',
               text: '<i class="fa fa-columns"></i>',
               titleAttr: 'Columns',
               postfixButtons: ['colvisRestore']
           },
        ],
   
       
   
    } );
    
    // new $.fn.dataTable.FixedHeader( table, {
    //     footer: true,
    //     header: true,
    //     headerOffset: $('.main-header').outerHeight()
    // } );
    
    
table.buttons( 0, null ).container().prependTo(
   table.table().container()
);
}
if ( $( '.example3' ).length ) {

    var table = $('.example3').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                 extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
}
} );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        if ( $( '.example4' ).length ) {
    var table = $('.example4').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                 extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
        }
} );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        if ( $( '.example5' ).length ) {
    var table = $('.example5').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                 extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
        }
} );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        if ( $( '.example6' ).length ) {
    var table = $('.example6').DataTable();
    new $.fn.dataTable.Buttons( table, {
      
        buttons: [
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                 columns: ':visible'
                }
            },

            {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                columns: ':visible'
                }
            },

           
          {
                 extend: 'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns',
                postfixButtons: [ 'colvisRestore' ]
            },
            

        ]
    } );
 
    table.buttons( 0, null ).container().prependTo(
        table.table().container()
    );
    }
} );
</script>
</body>
</html>


<script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>




<script type="text/javascript">
	$(document).ready(function() {
		<?php

		
		if($this->session->flashdata('success_msg')){
			?>
			successMsg("<?php echo $this->session->flashdata('success_msg'); ?>");
			<?php
		}else if($this->session->flashdata('error_msg')){
			?>
			errorMsg("<?php echo $this->session->flashdata('error_msg'); ?>");
			<?php
		}else if($this->session->flashdata('warning_msg')){
			?>
			infoMsg("<?php echo $this->session->flashdata('warning_msg'); ?>");
			<?php
		}else if($this->session->flashdata('info_msg')){
			?>
			warningMsg("<?php echo $this->session->flashdata('info_msg'); ?>");
			<?php
		}
		?> 
	});
</script>