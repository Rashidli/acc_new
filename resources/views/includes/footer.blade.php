
</div>
<!-- END layout-wrapper -->


<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>


<!-- apexcharts -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('/')}}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}assets/libs/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="{{asset('/')}}assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Responsive examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script>

    // var table = $('#datatable-button').DataTable( {
    //     buttons: [
    //          'excel', 'pdf'
    //     ]
    // } );


    $(document).ready(function (){
        $('#corporate_name').change(function(){
            var voen_number = $(this).find(':selected').attr('data-voen');
            $('#voen').val(voen_number);
        });

        $('.js-example-basic-single').select2();

        $('.group-checkbox').on('click', function() {

            // $(this).prop('checked', !$(this).prop('checked'));
            var groupBoolean =  $(this).prop('checked');
            var groupValue = $(this).data('group');

            $('input[type="checkbox"][data-group="' + groupValue + '"]').each(function() {

                if(groupBoolean){
                    $(this).prop('checked', true);
                }else{
                    $(this).prop('checked', false);
                }

            });

        });

        $('.radio_input').click(function (){

           var delete_route = $(this).data('delete');
           var edit_route = $(this).data('edit');
           var deleteForm = $('.delete_form');
            $('.edit_form').attr('href', edit_route);
            deleteForm.attr('action', delete_route);
            deleteForm.find('[type="submit"]').prop('disabled', false);
        });

        $('tbody tr').on('click', function () {
            // Find the radio input within this row and trigger its click event
            $(this).find('.radio_input').trigger('click');
        });

        // Attach a click event handler to the radio inputs to prevent propagation
        $('.radio_input').on('click', function (event) {
            event.stopPropagation();
        });
    });
</script>
</body>

</html>
