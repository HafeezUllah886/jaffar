@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Orders</h3>
                    <a onclick="newWindowMobile('{{ route('orders.create') }}')" class="btn btn-primary" >Create New</a>
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

                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Order Booker</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->orderbooker->name }}</td>
                                    <td>{{ $order->customer->title }}</td>
                                    <td>{{ date('d M Y', strtotime($order->date)) }}</td>
                                    <td>{{ $order->details->sum('amount') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item" onclick="newWindow('{{route('orders.show', $order->id)}}')"
                                                        onclick=""><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View
                                                    </button>
                                                </li>
                                                @if ($order->status == "Pending")
                                                @if (auth()->user()->role == "Admin")
                                                <li>
                                                    <button class="dropdown-item" onclick="newWindow('{{route('order.sale', $order->id)}}')"
                                                        onclick=""><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        Finalize Order
                                                    </button>
                                                </li>
                                                @endif
                                               @if (auth()->user()->role == "Admin" || $order->orderbookerID == Auth::id())
                                               <li>
                                                <a class="dropdown-item" onclick="newWindowMobile('{{route('orders.edit', $order->id)}}')">
                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Edit
                                                </a>
                                                </li>
                                                <li>
                                                <a class="dropdown-item text-danger" href="{{route('order.delete', $order->id)}}">
                                                    <i class="ri-delete-bin-2-fill align-bottom me-2 text-danger"></i>
                                                    Delete
                                                </a>
                                                </li>
                                               @endif
                                               
                                                @endif
                                               
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->
@endsection

