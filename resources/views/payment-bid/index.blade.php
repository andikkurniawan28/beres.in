@extends("layouts.app_auth")

@section("content")

<h6 class="h5 text-gray-900 mb-4 text-center">FORM PEMBAYARAN</h6>

    <table class="table table-sm table-hover table-bordered table-striped text-center">
        <tr>
            <th class="text-left">GoPay</th>
            <td>
                <form action="{{ route("payment-bid.process") }}" method="POST">
                    @csrf @method("POST")
                    <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                    <button type="submit" class="btn btn-primary btn-block btn-sm">Bayar</button>
                </form>
            </td>
        </tr>
    </table>

@endsection
