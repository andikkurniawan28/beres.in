@extends("layouts.app_auth")

<meta http-equiv="refresh" content="10;URL='{{ route("order-bid", $id) }}'">

@section("content")

<h6 class="h5 text-gray-900 mb-4 text-center">DAFTAR PENAWARAN</h6>

    <table class="table table-sm table-hover table-bordered table-striped" width="100%">
        <tr>
            <th>#</th>
            <th>Partner</th>
            <th>Tarif</th>
        </tr>
        @foreach ($order as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->user->name }}</td>
            <td>
                @if($order->price === NULL)
                {{ "-" }}
                @else
                <a href="{{ route("check-bid", [
                    "order_id" => $id,
                    "partner_id" => $order->user_id,
                ]) }}">Rp. {{ number_format($order->price) }}</a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

@endsection
