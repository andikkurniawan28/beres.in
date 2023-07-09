@extends("layouts.app_customer")

@section("content")

    <div class="card mt-4 bg-{{ $global["app_color"] }}">
        <div class="card-body">
            <h4 class="color-white">Pesanan</h4>
            <p class="color-white">
                Pesanan yang telah kamu lakukan.
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="p-4">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>Layanan</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($order as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->service->name ?? "" }}</td>
                            <td>
                                @if($order->is_open === 1)
                                    <a href="{{ route("application-customer.pesananByOrderId", $order->id) }}" class="btn btn-xs btn-outline-danger">Cek</a>
                                @elseif ($order->is_open === 2)
                                    <span class="badge badge-pill badge-success">Diproses</span>
                                @elseif ($order->is_open === 0)
                                    <span class="badge badge-pill badge-danger">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-sm btn-outline-info text-xs" onClick="window.location.reload();"><i class="fas fa-spinner"></i> Refresh</button>
                </div>
            </div>
        </div>
    </div>

@endsection


