@extends('layout.app')
@section('content')
<div class="row">
       <div class="col-12">
              <div class="card">
                     <div class="card-header d-flex justify-content-between">
                            <h3>Raw Material</h3>
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#new">Create New</button>
                     </div>
                     <div class="card-body">
                            <table class="table">
                                   <thead>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Unit</th>
                                          <th>Price</th>
                                          <th>Action</th>
                                   </thead>
                                   <tbody>
                                          @foreach ($items as $key => $item)
                                                 <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->unit->name}}</td>
                                                        <td>{{$item->price}}</td>
                                                        <td>
                                                               <button type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#edit_{{$item->id}}">Edit</button>
                                                        </td>
                                                 </tr>
                                                 <div id="edit_{{$item->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel">Edit - Raw Material</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                </div>
                                                                <form action="{{ route('material.update', $item->id) }}" method="post">
                                                                  @csrf
                                                                      @method('patch')
                                                                         <div class="modal-body">
                                                                                <div class="form-group">
                                                                                       <label for="name">Name</label>
                                                                                       <input type="text" name="name" required value="{{$item->name}}" id="name" class="form-control">
                                                                                </div>
                                                                                <div class="form-group mt-2">
                                                                                    <label for="unit">Unit</label>
                                                                                    <select name="unitID" id="unit" class="form-control">
                                                                                           @foreach ($units as $unit)
                                                                                                  <option value="{{$unit->id}}" {{$unit->id == $item->unitID ? "selected" : ""}}>{{$unit->name}}</option>
                                                                                           @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group mt-2">
                                                                                       <label for="price">Price</label>
                                                                                       <input type="number" step="any" name="price" required value="{{$item->price}}" min="0" id="price" class="form-control">
                                                                                </div>
                                                                         </div>
                                                                         <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                         </div>
                                                                  </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                          @endforeach
                                   </tbody>
                            </table>
                     </div>
              </div>
       </div>
</div>
<!-- Default Modals -->

<div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Create New Raw Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{ route('material.store') }}" method="post">
              @csrf
                     <div class="modal-body">
                            <div class="form-group">
                                   <label for="name">Name</label>
                                   <input type="text" name="name" required id="name" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                   <label for="unit">Unit</label>
                                   <select name="unitID" id="unit" class="form-control">
                                          @foreach ($units as $unit)
                                                 <option value="{{$unit->id}}">{{$unit->name}}</option>
                                          @endforeach
                                   </select>
                               </div>
                            <div class="form-group mt-2">
                                   <label for="price">Price</label>
                                   <input type="number" name="price" required min="0" step="any" id="price" class="form-control">
                            </div>
                     </div>
                     <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                     </div>
              </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

