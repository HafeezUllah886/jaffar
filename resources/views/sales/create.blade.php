@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Sale </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('sale.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="product" class="selectize" id="product">
                                        <option value="0"></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th width="20%">Product</th>
                                        <th width="15%" class="text-center">Batch</th>
                                        <th width="10%" class="text-center">Unit</th>
                                        <th width="15%" class="text-center">Qty</th>
                                        <th width="10%" class="text-center">Price</th>
                                        <th width="10%" class="text-center">Discount</th>
                                        <th width="10%" class="text-center">Scheme</th>
                                        <th width="10%" class="text-end">Amount</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="products_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-end">Total</th>
                                            <th class="text-end" id="total">0.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select name="customerID" id="customer" class="selectize1">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="account">Account</label>
                                    <select name="accountID" id="account" class="selectize1">
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status">Payment Status</label>
                                    <select name="status" id="status" class="selectize1">
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Sale</button>
                            </div>

                </div>
            </form>
            </div>

        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize1").selectize();
        $(".selectize").selectize({
            onChange: function(value) {
                if (!value.length) return;
                if (value != 0) {
                    getSingleProduct(value);
                    this.clear();
                    this.focus();
                }

            },
        });
        var units = @json($units);
        var existingProducts = [];

        function getSingleProduct(id) {
            $.ajax({
                url: "{{ url('sales/getproduct/') }}/" + id,
                method: "GET",
                success: function(product) {
                    let found = $.grep(existingProducts, function(element) {
                        return element === product.id;
                    });
                    if (found.length > 0) {

                    } else {
                        var id = product.id;
                        var html = '<tr id="row_' + id + '">';
                        html += '<td class="no-padding">' + product.name + '</td>';
                        html += '<td class="no-padding">';
                            html += '<select class="form-control text-center" name="batchNumber[]" id="batch_'+id+'" onchange="updateChanges(' + id +')">';
                                product.batches.forEach(function (b){
                                    if(b.balance > 0)
                                    {
                                        html += '<option value="'+b.batchNumber+'" data-stock="'+b.balance+'">'+b.batchNumber+'</option>';
                                    }
                                });
                            html += '</select>';
                        html += '</td>';
                        html +=
                            '<td class="no-padding"><select name="unit[]" class="form-control text-center" onchange="updateChanges(' + id +')" id="unit_' + id + '">';
                        units.forEach(function(unit) {
                            var isSelected = (unit.id == product.unitID);
                            html += '<option data-unit="'+unit.value+'" value="' + unit.id + '" ' + (isSelected ? 'selected' : '') + '>' + unit.name + '</option>';
                        });
                        html += '</select></td>';
                        html += '<td class="no-padding"><div class="input-group">  <span class="input-group-text" id="stockValue_'+id+'">'+product.stock +'</span><input type="number" name="qty[]" oninput="updateChanges(' + id +')" min="0.1" required step="any" value="1" class="form-control text-center" id="qty_' +
                            id + '"></div></td>';

                        html +=
                            '<td class="no-padding"><input type="number" name="price[]" oninput="updateChanges(' +
                            id +
                            ')" required step="any" value="'+product.price+'" min="1" class="form-control text-center" id="price_' +
                            id + '"></td>';
                            html +=
                            '<td class="no-padding"><div class="input-group"> <input type="number" name="discount[]" oninput="updateChanges(' +
                            id +
                            ')" required step="any" value="'+product.discount+'" min="0" class="form-control text-center" id="discount_' +
                            id + '"> <span class="input-group-text" id="discountValue_'+id+'">'+product.stock +'</span></div></td>';
                            html +=
                            '<td class="no-padding"><div class="input-group"> <input type="number" name="scheme[]" oninput="updateChanges(' +
                            id +
                            ')" required step="any" value="'+product.scheme+'" min="0" class="form-control text-center" id="scheme_' +
                            id + '"> <span class="input-group-text" id="schemeValue_'+id+'">'+product.stock +'</span></div></td>';
                        html +=
                            '<td class="no-padding"><input type="number" name="amount[]" required step="any" readonly value="0.00" class="form-control text-end" id="amount_' +
                            id + '"></td>';
                        html += '<td> <span class="btn btn-sm btn-danger" onclick="deleteRow('+id+')">X</span> </td>';
                        html += '<input type="hidden" name="id[]" value="' + id + '">';
                        html += '</tr>';
                        $("#products_list").prepend(html);
                        updateChanges(id);
                        existingProducts.push(id);
                    }
                }
            });
        }

        function updateChanges(id) {
            var qty = $('#qty_' + id).val();
            var price = $('#price_' + id).val();
            var unit = $('#unit_' + id).find('option:selected');
                unit = unit.data('unit');
            var stock = $('#batch_' + id).find('option:selected');
                stock = stock.data('stock');
            var discount = $('#discount_' + id).val();
            var scheme = $('#scheme_' + id).val();

            var newQty = qty * unit;
            var discountValue = price * discount / 100;
            var schemeValue = price * scheme / 100;
            var newPrice = price - discountValue - schemeValue;
            var amount = newQty * newPrice;

            $("#stockValue_"+id).html(stock / unit);
            $("#qty_"+id).attr("max", stock / unit);
            $("#discountValue_"+id).html((discountValue * newQty).toFixed(1));
            $("#schemeValue_"+id).html((schemeValue * newQty).toFixed(1));

            $("#amount_" + id).val(amount.toFixed(1));
            updateTotal();
        }

        function updateTotal() {
            var total = 0;
            $("input[id^='amount_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                total += parseFloat(inputValue);
            });

            $("#total").html(total);
        }

        function deleteRow(id) {
            existingProducts = $.grep(existingProducts, function(value) {
                return value !== id;
            });
            $('#row_'+id).remove();
            updateTotal();
        }

    </script>
@endsection
