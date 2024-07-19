@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('production.update', $production->id) }}" method="post">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Edit Production</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="product">Product</label>
                                    <select name="productID" id="product" class="selectize">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" @selected($product->id == $production->productID)>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select name="unit" id="unit" class="form-control">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" @selected($unit->id == $production->unitID)>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" required value="{{$production->qty / $production->unit->value}}" class="form-control" step="any" id="qty">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="batch">Batch #</label>
                                    <input type="text" name="batchNumber" value="{{$production->batchNumber}}" readonly required class="form-control" id="batch">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="materials">
                        <table class="table">
                            <thead>
                                <th width="50%">Item</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                            </thead>
                            <tbody>
                                @foreach ($production->details as $raw)
                                    <input type="hidden" name="material_id[]" value="{{$raw->materialID}}">
                                    <tr>
                                        <td>{{$raw->material->name}}</td>
                                        <td>
                                            <select name="material_unit[]" class="form-control">
                                                @foreach ($material_units as $u)
                                                    <option value="{{$u->id}}" @selected($u->id == $raw->raw_unitID)>{{$u->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="material_qty[]" value="{{$raw->qty / $raw->unit->value}}" step="any" class="form-control"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <button type="submit" id="submit" class="btn btn-primary w-100">Update</button>
                    </div>

            </form>
        </div>

    </div>
    </div>
    <!-- Default Modals -->


@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize").selectize({
            onChange : function(value){
                if (!value.length) return;
                if (value != 0) {
                    getIngredients(value);
                }
            }
        });
        var raw_units = @json($material_units);
        console.info(raw_units);
        function getIngredients(id){
            var path = "{{ route('product.ingredients', ':id') }}".replace(':id', id);

            $.ajax({
                url : path,
                method : "get",
                success : function(items)
                {
                    var html = '';
                    if(items.data.length > 0)
                    {
                        html += '<table class="table">';
                            html += '<thead><th width="50%">Item</th><th>Unit</th><th>Quantity</th></thead>';
                            html += '<tbody>';
                                   items.data.forEach(i => {
                                    html += '<input type="hidden" name="material_id[]" value="'+i.materialID+'">';
                                    html += '<tr>';
                                        html += '<td>'+i.material.name+'</td>';
                                        html += '<td>';
                                            html += '<select name="material_unit[]" class="form-control">';
                                                raw_units.forEach(u => {
                                                    html += '<option value="'+u.id+'">'+u.name+'</option>';
                                                });
                                            html += '</select>';
                                        html += '</td>';
                                        html += '<td><input name="material_qty[]" required class="form-control" step="any"></td>';
                                    html += '</tr>';
                                   });
                            html += '</tbody>';
                        html += '</table>';
                        $("#submit").show();
                    }
                    else
                    {
                        html += '<h3 class="text-center text-danger">No Ingredients Found</h3>';
                        $("#submit").hide();
                    }

                    $("#materials").html(html);
                }
            });
        }
    </script>
@endsection
