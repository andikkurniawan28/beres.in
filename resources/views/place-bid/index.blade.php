@extends("layouts.app_auth")

@section("content")

    <h6 class="h6 text-gray-900 mb-4">Halo <strong>{{ $partner_name }}</strong></h6>

    <div class="form-group">
        <label for="description">Customer ada masalah gini</label>
        <textarea id="" class="form-control" readonly>{{ $order->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="address">Lokasinya disini</label>
        <textarea id="" class="form-control" readonly>{{ $order->address }}</textarea>
    </div>

    <div class="form-group">
        <label for="name">Nama customernya</label>
        <input type="text" class="form-control" value="{{ $order->name }}" readonly>
    </div>

    <form class="user" method="POST" action="{{ route("place-bid.process") }}">

        @csrf @method("POST")

        <input type="hidden" name="user_id" value="{{ $partner_id }}">
        <input type="hidden" name="order_id" value="{{ $order_id }}">

        <div class="form-group">
            <label for="price">Tarifnya berapa ?</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Kasih keterangan ya</label>
            <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Kasih tau kamu berangkat darimana atau harga diatas harga per apa ?. Sebisa mungkin buat Customermu mengerti tawaranmu ya." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
           Submit
        </button>

    </form>

@endsection
