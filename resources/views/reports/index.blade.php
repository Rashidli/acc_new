@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">Hesabatlar</h4>

                                    <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>

                                                <th>Seç</th>
                                                <th>Elek qaimə</th>
                                                <th>Müəssisə</th>
                                                <th>Tarix</th>
                                                <th>Cəm</th>
                                                <th>ƏDV-siz</th>
                                                <th>ƏDV</th>
                                                <th>Ödəniş əsas</th>
                                                <th>Ödəniş ƏDV</th>
                                                <th>Qalıq əsas</th>
                                                <th>Qalıq ƏDV</th>
                                                <th>Qalıq Cəm</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($reports as $report)
                                            <tr>

                                                <td><input type="checkbox" class="radio_input" name="check" data-edit="{{route('reports.edit',$report->id)}}" data-delete="{{route('reports.destroy', $report->id)}}"></td>
                                                <td class="elect_invoice">{{$report->electron_invoice}}</td>
                                                <td class="company_name">{{$report->company}}</td>
                                                <td>{{$report->date}}</td>
                                                <td>{{$report->total_amount}}</td>
                                                <td>{{($report->products()->sum('price')*($report->products()->sum('quantity')))}}</td>
                                                <td>{{$report->products()->sum('total_amount') - ($report->products()->sum('price')*($report->products()->sum('quantity')))}}</td>
                                                <td>{{ $report->bank_payments()->where('payment_type', 1)->sum('payment_amount')}} </td>
                                                <td>{{$report->bank_payments()->where('payment_type', 2)->sum('payment_amount')}}</td>
                                                <td class="residual_basis">{{($report->products()->sum('price')*($report->products()->sum('quantity'))) - $report->bank_payments()->where('payment_type', 1)->sum('payment_amount')}}</td>
                                                <td>{{$report->products()->sum('total_amount') - ($report->products()->sum('price')*($report->products()->sum('quantity'))) - $report->bank_payments()->where('payment_type', 2)->sum('payment_amount')}}</td>
                                                <td>
                                                    {{($report->products()->sum('price')*($report->products()->sum('quantity'))) - $report->bank_payments()->where('payment_type', 1)->sum('payment_amount') + ($report->products()->sum('total_amount') - ($report->products()->sum('price')*($report->products()->sum('quantity'))) - $report->bank_payments()->where('payment_type', 2)->sum('payment_amount'))}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="10"></td>
                                                <td colspan="1">Ümumi borc: </td>
                                                <td id="totalSum">0</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td colspan="9"></td>
                                                <td><button class="btn btn-primary" id="groupPaymentButton">Paket</button></td>
                                                <td colspan="1">Cəm</td>
                                                <td id="totalSumChecked">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@include('includes.footer')
<!-- Add this at the bottom of your HTML file, right before the closing </body> tag -->
<script>
    function updateTotalSum() {
        let total = 0;
        $('tbody tr').each(function () {
            const qaliqEsas = parseFloat($(this).find('td:last').text());
            if (!isNaN(qaliqEsas)) {
                total += qaliqEsas;
            }
        });

        $('#totalSum').text(total);
    }
    $(document).ready(function () {
        updateTotalSum();
    });
    $('input[type="checkbox"]').on('change', function () {
        const checkedRows = $('input[type="checkbox"]:checked').closest('tr');
        let totalCheckedSum = 0;

        checkedRows.each(function () {
            const qaliqEsas = parseFloat($(this).find('td:eq(9)').text()); // Select the 10th td (index 9)
            if (!isNaN(qaliqEsas)) {
                totalCheckedSum += qaliqEsas;
            }
        });

        // Display the total for checked rows separately.
        $('#totalSumChecked').text(totalCheckedSum);

        // Show or hide the second <tr> based on whether there are checked checkboxes.
        if (checkedRows.length > 0) {
            $('tfoot tr:eq(1)').show();
        } else {
            $('tfoot tr:eq(1)').hide();
        }
    });

    $('#groupPaymentButton').click(function () {
        const selectedData = [];

        // Loop through checked checkboxes and concatenate the data for each checked row.
        $('input[type="checkbox"]:checked').each(function () {
            const $row = $(this).closest('tr');
            const company = $row.find('.company_name').text();
            const residualBasis = $row.find('.residual_basis').text();
            const electInvoice = $row.find('.elect_invoice').text();

            selectedData.push(`${company}:${residualBasis}:${electInvoice}`);
        });

        $.ajax({
            type: 'POST',
            url: '{{ route('group_payment') }}',
            data: { selectedData: selectedData },
            success: function (response) {
                window.location.href = '{{ route('packages.index') }}';
            },
            error: function (xhr, status, error) {
                // Handle errors if necessary.
            }
        });
    });


</script>
