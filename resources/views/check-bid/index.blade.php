@extends("layouts.app_auth")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("order-bid", $bid->order_id) }}">Kembali ke Daftar Penawaran</a></li>
        </ol>
    </nav>

    <h6 class="h6 text-gray-900 mb-4 text-left">Tawaran dari <strong>{{ $bid->user->name }}</strong></h6>

    <table class="table table-sm table-hover table-bordered table-striped text-center">
        <tr>
            <th class="text-left">Tarif</th>
            <td>Rp. {{ number_format($bid->price) }}</td>
        </tr>
        <tr>
            <th class="text-left">Katanya</th>
            <td>{{ $bid->description }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <form action="{{ route("check-bid.process") }}" method="POST">
                @csrf @method("POST")
                <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                <button type="submit" class="btn btn-primary btn-block">
                    OK, pesan &#129309
                </button>
                </form>
            </td>
        </tr>
    </table>

@endsection
