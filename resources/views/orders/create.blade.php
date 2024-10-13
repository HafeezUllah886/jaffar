@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Order </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="product" class="selectize" id="product">
                                        <option value="0"></option>
                                        @foreach ($products as $product)
                                            @if ($product->stock > 0)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" id="products_list">
                                    <div class="card card-height-100">
                                        <div class="card-body">
                                            <h5 class="fs-15 mb-2 product">Half Sleeve T-Shirts (Pink)</h5>
                                            <div class="d-flex mb-4 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="text-primary fs-18 mb-0"><span>$48.20</span> <small class="text-decoration-line-through text-muted fs-13">$124.10</small></h5>
                                                </div>
                                                <div class="flex-grow-1 text-end">
                                                    <h5 class="text-primary fs-18 mb-0"><span>$48.20</span></h5>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div>
                                                        <select class="form-select" id="expiry-year-input">
                                                            @foreach ($units as $unit)
                                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-end">
                                                <div class="input-step flex-shrink-0">
                                                    <button type="button" class="minus minus-1">–</button>
                                                    <input type="number" class="quantity-1" value="1" min="1">
                                                    <button type="button" class="plus plus-1">+</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-2">
                                    <label for="customer">Customer</label>
                                    <select name="customerID" id="customer" class="selectize1">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->title }}</option>
                                        @endforeach
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
                                <button type="submit" class="btn btn-primary w-100">Create Order</button>
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
    <script src="{{ asset('assets/js/pages/form-input-spin.init.js') }}"></script>

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
                        html += '<td class="no-padding"><div class="input-group">  <span class="input-group-text" id="stockValue_'+id+'">'+product.stock +'</span><input type="number" max="'+product.stock+'" name="qty[]" oninput="updateChanges(' + id +')" min="0.1" required step="any" value="1" class="form-control text-center" id="qty_' + id + '"></div></td>';
                        html += '<td class="no-padding"><select name="unit[]" class="form-control text-center" onchange="updateChanges(' + id +')" id="unit_' + id + '">';
                            units.forEach(function(unit) {
                                var isSelected = (unit.id == product.unitID);
                                html += '<option data-unit="'+unit.value+'" value="' + unit.id + '" ' + (isSelected ? 'selected' : '') + '>' + unit.name + '</option>';
                            });
                        html += '</select></td>';
                        html += '<td class="no-padding"><input type="number" name="price[]" oninput="updateChanges(' + id + ')" required step="any" value="'+product.price+'" min="1" class="form-control text-center" id="price_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="discount[]" oninput="updateChanges(' + id + ')" required step="any" value="'+product.discount+'" min="0" class="form-control text-center" id="discount_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="ti[]" required step="any" value="0.00" min="0" class="form-control text-center" id="ti_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="tp[]" oninput="updateChanges(' + id + ')" required step="any" value="'+product.tp+'" min="0" class="form-control text-center" id="tp_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="gst[]" oninput="updateChanges(' + id + ')" required step="any" value="18" min="0" class="form-control text-center" id="gst_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="gstValue[]" required step="any" value="0.00" min="0" class="form-control text-center" id="gstValue_' + id + '"></td>';
                        html += '<td> <span class="btn btn-sm btn-danger" onclick="deleteRow('+id+')">X</span> </td>';
                        html += '<input type="hidden" name="id[]" value="' + id + '">';
                        html += '<input type="hidden" id="stock_'+id+'" value="' + product.stock + '">';
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
            var stock = $('#stock_' + id).val();
            var discount = $('#discount_' + id).val();
            var newQty = qty * unit;

            var ti = (newQty * price) - (newQty * discount);
            $("#ti_"+id).val(ti);

            var tp = $("#tp_"+id).val();
            var gst = $("#gst_"+id).val();

            var gstValue = (tp * gst / 100) * newQty;

            $("#gstValue_"+id).val(gstValue.toFixed(2));

            var newPrice = price - discount;

            $("#stockValue_"+id).html(stock / unit);
            $("#qty_"+id).attr("max", stock / unit);

            updateTotal();
        }

        function updateTotal() {


            var totalDiscount = 0;
            $("input[id^='discount_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalDiscount += parseFloat(inputValue);
            });
            $("#totalDiscount").html(totalDiscount.toFixed(2));

            var totalTI = 0;
            $("input[id^='ti_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalTI += parseFloat(inputValue);
            });
            $("#totalTI").html(totalTI.toFixed(2));

            var totalGST = 0;
            $("input[id^='gstValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                totalGST += parseFloat(inputValue);
            });
            $("#totalGST").html(totalGST.toFixed(2));

            var discount = parseFloat($("#discount").val());
            var fright = parseFloat($("#fright").val());
            var fright1 = parseFloat($("#fright1").val());
            var whTax = parseFloat($("#whTax").val());

            var taxValue = totalTI * whTax / 100;

            $(".whTaxValue").html(taxValue.toFixed(2));

            var net = (totalTI + taxValue + fright1) - (discount + fright);

            $("#net").val(net.toFixed(2));
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
