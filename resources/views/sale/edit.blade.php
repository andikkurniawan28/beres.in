@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("order.index") }}">{{ ucfirst("order") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ ucfirst("order") }}</li>
        </ol>
    </nav>

    @include('components.alert', [
        'message' => Session::get('success'),
        'color' => 'success',
        'errors' => $errors,
    ])

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit {{ ucfirst("order") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("order.update", $order->id) }}" method="POST">
                @csrf @method("PUT")
                <div class="form-group">
                    <label for="service_id">{{ ucfirst('service') }}</label>
                    <select name="service_id" class="form-control">
                        @foreach ($service as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">{{ ucfirst('description') }}</label>
                    <textarea class="form-control" name="description">{{ $order->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="address">{{ ucfirst('location') }}</label>
                    <textarea class="form-control" name="address">{{ $order->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ ucfirst('phone_number') }}</label>
                    <input type="number" step="any" name="phone_number" id="phone_number" class="form-control" value="{{ $order->phone_number }}" required>
                </div>
                <div class="form-group">
                    <label for="name">{{ ucfirst('name') }}</label>
                    <input type="text" step="any" name="name" id="name" class="form-control" value="{{ $order->name }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
