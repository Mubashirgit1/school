<?php
?>
<script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
<footer class="main-footer">


</footer>
<div class="control-sidebar-bg"></div>
</div>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>
<script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url(); ?>backend/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js"></script>
<script src="<?php echo base_url(); ?>backend/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>backend/dist/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        if ($("#classwork").length) {
            CKEDITOR.replace("classwork");
        }
        if ($("#homework").length) {
            CKEDITOR.replace("homework");
        }
        if ($("#description").length) {
            CKEDITOR.replace("description");
        }
        if ($("#vocation").length) {
            CKEDITOR.replace("vocation");
        }

        if ($("#syllabus").length) {
            CKEDITOR.replace("syllabus");
        }


        $('#class_id').hide();
        $('#class_id').select2();
        $('#section_id').hide();
        $('#section_id').select2();
    });
    $(document).ready(function () {

        var table = $('.example').DataTable();
        $('div.dataTables_filter input').attr('placeholder', 'Search...');
        var table = $('.example2').DataTable();
        $('div.dataTables_filter input').attr('placeholder', 'Search...');
        var table = $('.example3').DataTable();
        $('div.dataTables_filter input').attr('placeholder', 'Search...');
        var table = $('.example4').DataTable();
        $('div.dataTables_filter input').attr('placeholder', 'Search...');
        var table = $('.example5').DataTable();
        $('div.dataTables_filter input').attr('placeholder', 'Search...');
    });

</script>

<script type="text/javascript">
    jQuery(function ($) {
        $("input[type='number'][min=0]").change(function () {
            var val = $(this).val();
            val = parseInt(val);
            if (isNaN(val)) {
                val = "";
            } else if (val < 0) {
                val = 0 - val;
            }

            $(this).val(val);
        });
    });
    jQuery(function ($) {
        $('.balance_sheet_input_submit').keydown(function (e) {

            var url = $(this).data('url'),
                selectors = $(this).data('values');

            if (e.key.toLowerCase() == 'enter') {
                e.preventDefault();
                var values = $(selectors).serialize();

                window.location.href = url + "?" + values;
            }
        });

        // on pressing enter submit the form
        $(".on_enter_submit").on('keydown', function (e) {
            var form = $(this).parents('form');

            if (e.key.toLowerCase() == 'enter' || e.keyCode == 13) {
                e.preventDefault();
                $(form).submit();
            }
        });
    });
</script>

<!--print table-->
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/jsdata/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/sorting/natural.js"></script>
<style>
    .group {
        background-color: #f1f1f1;
        font-size: 1.6rem;
    }

    .table > thead > tr > th, .table > tfoot > tr > th {
        background-color: #e6e6e6;
    }
</style>

<script type="text/javascript">


    $(document).ready(function () {


        if ($('#active_student').length) {
            var title = 'Active Report (Admission wise)';
            var table = $('#active_student');
            var report = $('#report').val();
            classgroup = false;

            if (report == 'class') {
                var title = 'Active Report (Class wise)';
                $('.section-order').show();
                classgroup = true;
            }
            type = 3;
            if (report == 'family') {
                classgroup = true;
                var title = 'Active Report (Family wise)';
                type = 6;
            }
            $('#report_title').text(title);

            datatable_call(table, title1(title), type, 19, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], -1, 5, 6, 10, 17, " Students", "text-right", 1, classgroup);
        }
        if ($('#new_students').length) {
            var title = 'New Admission';
            var table = $('#new_students');
            datatable_call(table, title1(title), 0, 19, [18]);
        }
        if ($('#free_students').length) {
            var title = 'Free Students';
            var table = $('#free_students');
            datatable_call(table, title1(title), 0, 19, [18]);
        }
        if ($('#adjusted').length) {
            var title = currrnet_month() + ' Advance Adjusted Students';
            var table = $('#adjusted');
            datatable_call(table, title1(title), 0, 19, [11]);
        }
        if ($('#voucher_wise_collection').length) {


            var title = 'Fee Collection Report (Voucher wise)';
            var table = $('#voucher_wise_collection');
            var report = $('#search_type_paid').val();
            var type = 0;
            var classgroup = false;
            if (report == 'class') {
                var title = 'Fee Collection Report (Class wise)';
                classgroup = true;
                type = 5;
            }

            if (report == 'family') {
                classgroup = true;
                var title = 'Active Report (Family wise)';
                type = 7;
            }
            console.log(type);

            $('#report_title').text(title);

            datatable_call(table, title1(title), type, 19, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], -1, 5, 6, 10, 17, " Students", "text-right", 1, classgroup);


        }
        if ($('#student_wise_collection').length) {


            datatable_call(table, title1(title), 0, 19, [16]);
        }
        if ($('#unpaid_voucher').length) {
            var title = currrnet_month() + ' Unpaid Voucher';
            var table = $('#unpaid_voucher', 0, 19, [15]);
            datatable_call(table, title1(title));
        }

        if ($('#waive_reports').length) {
            var title = currrnet_month() + ' Voucher Wise Fee Waived Report';
            var table = $('#waive_reports');
            datatable_call(table, title1(title), 0, 19, [16]);
        }
        if ($('#student_wise_waive').length) {
            var title = currrnet_month() + ' Student Wise Fee Waived Report';
            var table = $('#student_wise_waive');
            datatable_call(table, title1(title), 0, 19, [18]);
        }

        if ($('#withdraw_students').length) {
            var title = currrnet_month() + ' Struck Off Students Reports';
            var table = $('#withdraw_students');
            datatable_call(table, title1(title), 0, 19, [18]);
        }
        if ($('#due_reports').length) {
            var title = currrnet_month() + ' Due Fee Reports';
            var table = $('#due_reports');
            datatable_call(table, title1(title), 0, 19, [14]);
        }
        if ($('#student_wise_unpaid').length) {
            var title = currrnet_month() + ' Due Fee Reports';
            var table = $('#student_wise_unpaid');
            datatable_call(table, title1(title), 0, 19, [17]);
        }
        if ($('#paid_other_fee').length) {
            var title = currrnet_month() + ' Paid Voucher (Other Fee)';
            var table = $('#paid_other_fee');
            datatable_call(table, title1(title), 0, 19, [18]);
        }
        if ($('#message_tuition').length) {
            var title = currrnet_month() + ' Message Tuition Unpaid Fee Reports';
            var table = $('#message_tuition');
            datatable_call(table, title1(title), 0, 19, [18]);
        }
        if ($('#message_other').length) {
            var title = currrnet_month() + ' Message Tuition Unpaid Fee Reports';
            var table = $('#message_other');
            datatable_call(table, title1(title), 0, 19, [18]);
        }

        function currrnet_month() {

            var month = new Array();
            month[0] = "January";
            month[1] = "February";
            month[2] = "March";
            month[3] = "April";
            month[4] = "May";
            month[5] = "June";
            month[6] = "July";
            month[7] = "August";
            month[8] = "September";
            month[9] = "October";
            month[10] = "November";
            month[11] = "December";

            var d = new Date();
            var n = month[d.getMonth()];
            return n;
        }

        function title1(title) {

            left = '<div style="display: contents;"><div style="display: inline-block">';
            image = '<img style="width: 90px; height:90px; vertical-align: initial;  "  src="<?= base_url("uploads/school_content/logo/{$this->setting_model->getCurrentImage()}") ?>" alt="American lyceum International School"></div>';
            name = '<div style="display: inline-block;margin: 0px 20px;"><h2  ><b> <?= $this->setting_model->getCurrentSchoolName(); ?> </b></h2><h4><?= $this->setting_model->getSchoolAddress()?></h4><h5><?= $this->setting_model->getCurrentSessionName()?> </h5></div></div>';
            right = '<div style="display: inline-block; float:right;    text-align: end;"><h3><b>' + title + '</b></h3><h4><b>From</b> <?=date("d/F/Y ") ?> <b>to</b> <?=date("d/F/Y ") ?></h4><h5>Date <?= date("d, F, Y H:i:s")?> </h5><h5>Printed By <?= $this->session->userdata('admin')['username']; ?> </h5></div></div>';

            // start   =   '<div  style="border-bottom: 3px solid black;"> ';
            // image   =   '<div style="text-align: center;"><img style="width: 80px; height:80px;float: left; margin-top: -15px; "  src="<?= base_url("uploads/school_content/logo/{$this->setting_model->getCurrentImage()}") ?>" alt="American lyceum International School">';
            // head    =   '<h2 ><b> <?php echo $this->setting_model->getCurrentSchoolName(); ?></b></h2></div></div>';
            // report  =   '<div  style="text-align: center;margin-left:80px" ><h3><b>'+title+' (<?= $this->session_model->get($this->setting_model->getCurrentSession())['session']; ?>)</b></h3></div>';
            // date    =   '<div  style="text-align: center; font-size:16px;margin-left:80px;" ><p><b><?= date('d, F, Y H:i:s')?></b></p></div>';
            return left + image + name + right;
        }


        $('.grid tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 0 && currentOrder[1] === 'asc') {
                table.order([0, 'desc']).draw();
            } else {
                table.order([0, 'asc']).draw();
            }
        });

        function datatable_call(tablee, title, groupCol = 0, totalCols = 0, UnOrderAble = [], displayLength = 100, tdColspan = 1, startCountingTd = 2, startLimit = 2, endLimit = 2, countPostfix = "", tdClass = "text-right", active = 0, classgroup = false) {

            if (groupCol > 0 && classgroup == true) {

                var table = tablee.not('.initialized').addClass('initialized').show().DataTable({
                    destroy: true,
                    fixedHeader: {
                        header: true,
                        footer: true,
                        headerOffset: $('.main-header').outerHeight()
                    },
                    "orderFixed": [groupCol, 'asc'],
                    "stateSave": false,
                    "stateDuration": 60 * 60 * 24 * 365,
                    "displayLength": displayLength,
                    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                        $("td:first", nRow).html(iDisplayIndex + 1);
                        return nRow;
                    },
                    order: [[groupCol, 'asc']],

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


                            $('.serial').text(i);
                            if (last !== group) {
                                groupid++;
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="' + tdColspan + '">' + group + '</td></tr>'
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

                        $('#' + tablee.attr("id") + ' tbody').find('.group').each(function (i, v) {

                            var rowCount = $(this).nextUntil('.group').length;
                            $(this).find('td:first')
                                .append($('<span />', {'class': 'rowCount-grid'})
                                    .append($('<b />', {'text': ' (' + rowCount + countPostfix + ')'})));
                            var subtd = '';
                            for (var a = startCountingTd; a < colonne; a++) {
                                var mySubtotal = "";

                                if (a >= startLimit && a <= endLimit) {
                                    mySubtotal = $.fn.dataTable.render.number(',', '.', 0, '').display(subtotale[i][a]);
                                }

                                subtd += '<td class="' + tdClass + '">' + mySubtotal + '' + '</td>';

                            }

                            $(this).append(subtd);
                        });

                    },

                    columnDefs: [

                        {orderable: false},

                        {
                            targets: UnOrderAble,
                            orderable: false
                        },
                        {
                            targets: groupCol,
                            visible: false,
                        },
                        {
                            type: 'natural',
                            targets: groupCol,
                        },
                    ],
                });


            } else {

                var table = tablee.DataTable({
                    "displayLength": -1,
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }],
                    "order": [[1, 'asc']]
                });
                table.on('order.dt search.dt', function () {
                    table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            }


            new $.fn.dataTable.Buttons(table, {
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
                        customize: function (doc) {
                            doc.pageMargins = [10, 10, 10, 10];
                        },
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 8, 10, 11, 12, 13, 14, 15, 16, 17],
                            modifier: {
                                page: 'current'
                            },

                        },
                        title: title,
                    },
                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
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


            });

            // new $.fn.dataTable.FixedHeader( table, {
            //     footer: true,
            //     header: true,
            //     headerOffset: $('.main-header').outerHeight()
            // } );

            if (classgroup == true) {


            } else {
                table.buttons(0, null).container().prependTo(
                    table.table().container()
                );

            }


        }


        var title = '<div style="font-size:21px;"><?php echo $print_title ?></div>';
        if ($('.example').length) {
            var table = $('.example').DataTable();

            new $.fn.dataTable.Buttons(table, {

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
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
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
                columnDefs: [
                    {orderable: false}
                ]
            });

            // table.buttons( 0, null ).container().prependTo(
            //     table.table().container()
            // );
        }
    });
</script>
<script type="text/javascript">

    $(document).ready(function () {


        var title = '<div style="font-size:21px;"><?php echo $print_title ?></div>';
        if ($('#example').length) {
            var table = $('#example').DataTable({
                "order": [],
                "scrollY": "500px",
                "scrollCollapse": true,
                "paging": false
            });

            new $.fn.dataTable.Buttons(table, {

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
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
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
                columnDefs: [
                    {orderable: false}
                ]
            });


            table.buttons(0, null).container().prependTo(
                table.table().container()
            );
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var title = '<div style="font-size:21px;"><?php echo $print_title_2 ?></div>';
        if ($('.example_print').length) {
            var table = $('.example_print').DataTable();
            new $.fn.dataTable.Buttons(table, {

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
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
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


                ]
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var title = '<div style="font-size:21px;"><?php echo $print_title ?></div>';

        if ($('.example2').length > 0) {

            var table = $('.example2').DataTable();
            new $.fn.dataTable.Buttons(table, {

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
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        title: title,
                        text: '<i class="fa fa-print"></i>',
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


                ]
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );

        }

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        if ($('.example3').length > 0) {

            var table = $('.example3').DataTable();
            new $.fn.dataTable.Buttons(table, {

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
                        text: '<i class="fa fa-print"></i>',
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


                ]
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );

        }

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        if ($('.example4').length > 0) {

            var table = $('.example4').DataTable();
            new $.fn.dataTable.Buttons(table, {

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
                        text: '<i class="fas fa-file-spreadsheet"></i>',
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
                        text: '<i class="fa fa-print"></i>',
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


                ]
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );

        }

    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        if ($('.example5').length > 0) {

            var table = $('.example5').DataTable();
            new $.fn.dataTable.Buttons(table, {

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
                        text: '<i class="fas fa-file-spreadsheet"></i>',
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
                        text: '<i class="fa fa-print"></i>',
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


                ]
            });

            table.buttons(0, null).container().prependTo(
                table.table().container()
            );

        }

    });
</script>
<script src="<?php echo base_url(); ?>backend/sweet-alert/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>backend/js/school-custom.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
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


<script type="text/javascript">
    jQuery(function ($) {
        $("body").keydown(function (event) {
            if (event.ctrlKey === true && event.key.toLowerCase() == 'e') {
                event.preventDefault();

                window.location.href = "<?= site_url('admin/expense') ?>";
            }
        });

        $(".back_btn").click(function (e) {
            e.preventDefault();

            window.history.back();
        });
    });
</script>

<script type="text/javascript">
    jQuery(function ($) {
        var date_format = 'mm/dd/yyyy';

        $('._date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

    });

    // function jquery_alert(message, type){
    //     if(type == undefined) type = 'success';
    //     $.alert({
    //         title: type=='success'?"Success!":"Error!",
    //         content: message
    //     });
    // }

</script>


<!--./print table-->
</body>
</html>