@extends("layouts.app")

@section("content")

    @include("components.alert", [
        "message" => Session::get("success"),
        "color" => "success",
        "errors" => $errors,
    ])

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst("order") }}</h5>
            <br>
            @include("components.documentation", ["description" => $description])
            <a href="{{ route("order.create") }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i>
                {{ ucfirst("create") }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ strtoupper("id") }}</th>
                            <th>{{ ucfirst("service") }}</th>
                            <th>{{ ucfirst("description") }}</th>
                            <th>{{ ucfirst("location") }}</th>
                            <th>{{ ucfirst("phone_number") }}</th>
                            <th>{{ ucfirst("name") }}</th>
                            <th>{{ ucfirst("bid") }}</th>
                            <th>{{ ucfirst("timestamp") }}</th>
                            <th>{{ ucfirst("action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->service->name ?? "" }}</td>
                            <td>{{ $order->description }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{ $order->name }}</td>
                            <td>
                                @forelse ($order->bid as $bid)
                                    <li>{{ $bid->user->name}} - Rp. {{ number_format($bid->price) }}</li>
                                @empty

                                @endforelse
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <form action="{{ route("order.destroy", $order->id) }}" method="POST" onsubmit="if(!confirm('User {{ $order->name }} will deleted, are you sure?')){return false;}">
                                    @csrf @method("DELETE")
                                    <a href="{{ route("order.edit", $order->id) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-edit"></i> {{ ucfirst("edit") }}</a>
                                    @if($order->is_activated === 0)
                                    <a href="{{ route("user.activation", $order->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-check"></i> {{ ucfirst("activate") }}</a>
                                    @elseif($order->is_activated === 1)
                                    <a href="{{ route("user.activation", $order->id) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-ban"></i> {{ ucfirst("ban") }}</a>
                                    @endif
                                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash"></i> {{ ucfirst("delete") }}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>

@endsection
