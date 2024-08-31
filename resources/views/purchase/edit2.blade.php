@extends('layout.popups')
@section('content')
<script>
    var existingProducts = [];
    @foreach ($purchase->details as $product)
        @php
            $productID = $product->productID;
        @endphp
        existingProducts.push({{$productID}});
    @endforeach
</script>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Purchase </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>

                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('purchase.update', $purchase->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-6">
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
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="fed">FED</label>
                                    <input type="number" name="fed" value="{{$purchase->fed}}" oninput="updateTaxes()" id="fed" class="form-control" step="any">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="gst">GST</label>
                                    <input type="number" name="gst" value="{{$purchase->gst}}" oninput="updateTaxes()" id="gst" class="form-control" step="any">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="sed">SED</label>
                                    <input type="number" name="sed" value="{{$purchase->sed}}" oninput="updateTaxes()" id="sed" class="form-control" step="any">
                                </div>
                            </div>
                            <div class="col-12">

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th width="30%">Item</th>
                                        <th width="10%" class="text-center">Unit</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Tax Inc</th>
                                        <th class="text-center">TP</th>
                                        <th class="text-center">FED</th>
                                        <th class="text-center">GST</th>
                                        <th class="text-center">SED</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="products_list">
                                        @foreach ($purchase->details as $product)
                                        @php
                                            $id = $product->productID;
                                        @endphp
                                        <tr id="row_{{$id}}">
                                            <td class="no-padding">{{$product->product->name}}</td>
                                            <td class="no-padding">
                                                <select name="unit[]" class="form-control text-center" id="unit_{{$id}}">
                                                    @foreach ($units as $unit)
                                                    @php
                                                    if($unit->id == $product->unitID)
                                                    {
                                                        $unitValue = $product->unitValue;
                                                    }
                                                @endphp
                                                    <option data-unit="{{$unit->value}}" value="{{$unit->id}}" @selected($unit->id == $product->unitID)>{{ $unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="no-padding"><input type="number" name="qty[]" oninput="updateChanges({{$id}})" min="0.1" required step="any" value="{{$product->qty / $unitValue}}" class="form-control text-center" id="qty_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="price[]" oninput="updateChanges({{$id}})" required step="any" value="{{$product->price}}" min="1" class="form-control text-center" id="price_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="ti[]" required step="any" readonly value="{{$product->ti}}" class="form-control text-end" id="ti_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="tp[]" oninput="updateChanges({{$id}})" required step="any" value="{{$product->tp}}" min="1" class="form-control text-center" id="tp_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="fedValue[]" step="any" value="{{$product->fedValue}}" min="0" readonly class="form-control text-center" id="fedValue_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="gstValue[]" step="any" value="0" min="{{$product->gstValue}}" readonly class="form-control text-center" id="gstValue_{{$id}}"></td>
                                            <td class="no-padding"><input type="number" name="sedValue[]" step="any" value="0" min="{{$product->sedValue}}" readonly class="form-control text-center" id="sedValue_{{$id}}"></td>
                                            <td> <span class="btn btn-sm btn-danger" onclick="deleteRow({{$id}})">X</span> </td>
                                            <input type="hidden" name="id[]" value="{{$id}}">
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total</th>
                                            <th class="text-end" id="totalTI">0.00</th>
                                            <th></th>
                                            <th class="text-end" id="totalFED">0.00</th>
                                            <th class="text-end" id="totalGST">0.00</th>
                                            <th class="text-end" id="totalSED">0.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="stTax">Sale Tax</label>
                                    <input type="number" name="stTax" id="stTax" max="50" min="0" step="any" value="{{$purchase->st}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="whTax">WH Tax</label>
                                    <input type="number" name="whTax" id="whTax" max="50" min="0" step="any" value="{{$purchase->wh}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" name="discount" id="discount" step="any" value="{{$purchase->discount}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="comp">Compensation</label>
                                    <input type="number" name="comp" id="comp" step="any" value="{{$purchase->compensation}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d', strtotime($purchase->date)) }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="vendor">Vendor</label>
                                    <select name="vendorID" id="vendor" class="selectize1">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" @selected($vendor->id == $purchase->vendorID)>{{ $vendor->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 mt-2">
                                <div class="form-group">
                                    <label for="account">Account</label>
                                    <select name="accountID" id="account" class="selectize1">
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 mt-2">
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
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5">{{$purchase->notes}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Purchase</button>
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

        function getSingleProduct(id) {
            $.ajax({
                url: "{{ url('purchases/getproduct/') }}/" + id,
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
                        html += '<td class="no-padding"><select name="unit[]" class="form-control text-center" onchange="updateChanges(' + id + ')" id="unit_' + id + '">';
                        units.forEach(function(unit) {
                            var isSelected = (unit.id == product.unitID);
                            html += '<option data-unit="'+unit.value+'" value="' + unit.id + '" ' + (isSelected ? 'selected' : '') + '>' + unit.name + '</option>';
                        });
                        html += '</select></td>';
                        html += '<td class="no-padding"><input type="number" name="qty[]" oninput="updateChanges(' + id + ')" min="0.1" required step="any" value="1" class="form-control text-center" id="qty_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="price[]" oninput="updateChanges(' + id + ')" required step="any" value="0" min="1" class="form-control text-center" id="price_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="ti[]" required step="any" readonly value="0.00" class="form-control text-end" id="ti_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="tp[]" oninput="updateChanges(' + id + ')" required step="any" value="'+product.tp+'" min="1" class="form-control text-center" id="tp_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="fedValue[]" step="any" value="0" min="0" readonly class="form-control text-center" id="fedValue_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="gstValue[]" step="any" value="0" min="0" readonly class="form-control text-center" id="gstValue_' + id + '"></td>';
                        html += '<td class="no-padding"><input type="number" name="sedValue[]" step="any" value="0" min="0" readonly class="form-control text-center" id="sedValue_' + id + '"></td>';
                        html += '<td> <span class="btn btn-sm btn-danger" onclick="deleteRow('+id+')">X</span> </td>';
                        html += '<input type="hidden" name="id[]" value="' + id + '">';
                        html += '</tr>';
                        $("#products_list").prepend(html);
                        existingProducts.push(id);
                        updateChanges(id);
                    }
                }
            });
        }

        function updateChanges(id) {

            var qty = parseFloat($('#qty_' + id).val());
            var unit = $("#unit_"+id).find(':selected').data("unit");

            qty = qty * unit;

            var price = parseFloat($('#price_' + id).val());
            var tp = parseFloat($('#tp_' + id).val());

            var fed = parseFloat($("#fed").val());
            var gst = parseFloat($("#gst").val());
            var sed = parseFloat($("#sed").val());

            var fedValue = (tp * fed / 100) * qty;
            var gstValue = (tp * gst / 100) * qty;
            var sedValue = (tp * sed / 100) * qty;

            $("#fedValue_"+id).val(fedValue.toFixed(2));
            $("#gstValue_"+id).val(gstValue.toFixed(2));
            $("#sedValue_"+id).val(sedValue.toFixed(2));

            var ti = qty * price;
            $("#ti_" + id).val(ti.toFixed(2));
            updateTotal();
        }

        function updateTotal() {
            var ti = 0;
            $("input[id^='ti_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                ti += parseFloat(inputValue);
            });


            $("#totalTI").html(ti.toFixed(2));

            var fedValue = 0;
            $("input[id^='fedValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                fedValue += parseFloat(inputValue);
            });

            $("#totalFED").html(fedValue.toFixed(2));

            var gstValue = 0;
            $("input[id^='gstValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                gstValue += parseFloat(inputValue);
            });

            $("#totalGST").html(gstValue.toFixed(2));

            var sedValue = 0;
            $("input[id^='sedValue_']").each(function() {
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();
                sedValue += parseFloat(inputValue);
            });

            $("#totalSED").html(sedValue.toFixed(2));
        }

        function deleteRow(id) {
            existingProducts = $.grep(existingProducts, function(value) {
                return value !== id;
            });
            $('#row_'+id).remove();
            updateTotal();
        }
        updateTaxes();

        function updateTaxes()
        {

            $("input[id^='fedValue_']").each(function() {
                var id = $(this).attr('id');
                var splitString = id.split("_");
                var textAfterUnderscore = splitString[1];
                updateChanges(textAfterUnderscore);
            });
        }

    </script>
@endsection
