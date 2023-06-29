@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("partner.index") }}">{{ ucfirst("partner") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create {{ ucfirst("partner") }}</li>
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
                Create {{ ucfirst("partner") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("partner.store") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ ucfirst('name') }}</label>
                    <input type="hidden" name="role_id" value="2">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..." required>
                </div>
                <div class="form-group">
                    <label for="service_id">{{ ucfirst('service') }}</label><br>
                    <select name="service_id" class="form-control">
                        @foreach ($service as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">{{ ucfirst('username') }}</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username..." required>
                </div>
                <div class="form-group">
                    <label for="password">{{ ucfirst('password') }}</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password..." required>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ ucfirst('phone_number') }}</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter phone_number..." required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
