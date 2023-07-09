@extends("layouts.app")

@section("content")

    @include("components.alert", [
        "message" => Session::get("success"),
        "color" => "success",
        "errors" => $errors,
    ])

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst("sale") }}</h5>
            <br>
            @include("components.documentation", ["description" => $description])
            {{-- <a href="{{ route("sale.create") }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i>
                {{ ucfirst("create") }}
            </a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ strtoupper("id") }}</th>
                            <th>{{ ucfirst("order") }}</th>
                            <th>{{ ucfirst("accepted Bid") }}</th>
                            <th>{{ ucfirst("timestamp") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>
                                <li>Service : {{ $sale->order->service->name ?? "" }}</li>
                                <li>Customer : {{ $sale->order->name }}</li>
                                <li>Description : {{ $sale->order->description }}</li>
                            </td>
                            <td>
                                <li>Price : Rp. {{ number_format($sale->bid->price) }}</li>
                                <li>Partner : {{ $sale->bid->user->name ?? "" }}</li>
                                <li>Description : {{ $sale->bid->description }}</li>
                            </td>
                            <td>{{ $sale->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

@endsection
