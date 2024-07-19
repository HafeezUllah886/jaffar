@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>{{$product->name}} - Ingredients List</h3>
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
                    <form action="{{ route('ingredient.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="productID" value="{{$product->id}}">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <select name="materialID" required class="selectize">
                                        <option value="">Select Material</option>
                                        @foreach ($materials as $material)
                                            <option value="{{$material->id}}">{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success w-100">Add</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th width="90%">Item</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($product->ingredient as $key => $ingredient)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$ingredient->material->name}}</td>
                                    <td><a href="{{route('ingredient.destroy', [$product->id, $ingredient->id])}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
    $(".selectize").selectize();
</script>
@endsection
