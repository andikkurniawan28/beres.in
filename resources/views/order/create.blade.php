@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("order.index") }}">{{ ucfirst("order") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create {{ ucfirst("order") }}</li>
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
                Create {{ ucfirst("order") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("order.store") }}" method="POST">
                @csrf
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
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="address">{{ ucfirst('location') }}</label>
                    <textarea class="form-control" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ ucfirst('phone_number') }}</label>
                    <input type="number" step="any" name="phone_number" id="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">{{ ucfirst('name') }}</label>
                    <input type="text" step="any" name="name" id="name" class="form-control" required>
                </div>
            </form>
        </div>
    </div>

@endsection
