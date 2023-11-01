

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- apexcharts -->
{{--<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>--}}

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
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

{{--<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>--}}

<!-- App js -->

<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script src="{{asset('assets/js/repeater.js')}}"></script>

@livewireScripts

<script>

    $(document).ready(function (){

        $('[data-repeater-create]').click(function() {

            $('.js-example-basic-single').select2();
            $('.electron_invoice_select').select2();
            $('.js-example-basic-single_bank').select2();

        });

        // $('[data-repeater-create]').on('click',function() {
        //
        // });

        $('#corporate_name').change(function(){
            var voen_number = $(this).find(':selected').attr('data-voen');
            $('#voen').val(voen_number);
        });

        $('.js-example-basic-single').select2();
        $('.electron_invoice_select').select2();
        $('.js-example-basic-single_bank').select2();

        $('#submit_button').on('click', function (event) {
            event.preventDefault();

            // Show loading message
            $('#loading-message').show();

            var formData = new FormData($('#your-form-id')[0]);


            $.ajax({
                type: 'POST',
                url: '{{route('bank_payments.store')}}', // Replace with your actual save endpoint
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {

                    $('#loading-message').hide();

                    $('#success-message').show();

                    console.log( response.bank_payments);
                },
                error: function (error) {

                    $('#loading-message').hide();
                    console.error('Error saving data:', error);
                }
            });
        });




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


        // Use event delegation to handle change event for dynamically added elements
        $('tbody[data-repeater-list="bank_payments"]').on('change', '.electron_invoice_select', function () {
            // Get the selected option
            var selectedOption = $(this).find('option:selected');

            // Get the 'data-purchase' attribute value from the selected option
            var dataCompany = selectedOption.data('purchase');
            var dataId = selectedOption.data('id');
            console.log("Purchase ID: " + dataId);

            // Find the input with class 'company' and set its value to 'dataCompany'
            $(this).closest('tr').find('.company').val(dataCompany);
            $(this).closest('tr').find('.purchase_id').val(dataId);

            // Find the input with class 'debet' and set its value
            $(this).closest('tr').find('.debet').val('531-1');

            // Find the input with class 'credit' and set its value
            $(this).closest('tr').find('.credit').val('223');
        });


    });
</script>
</body>

</html>
