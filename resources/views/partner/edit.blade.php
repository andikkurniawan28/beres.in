@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("partner.index") }}">{{ ucfirst("partner") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ ucfirst("partner") }}</li>
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
                Edit {{ ucfirst("partner") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("partner.update", $partner->id) }}" method="POST">
                @csrf @method("PUT")
                <div class="form-group">
                    <label for="role_id">{{ ucfirst('role') }}</label>
                    <select class="form-control" id="role_id" name="role_id">
                        @foreach ($global['role'] as $role)
                            <option value="{{ $role->id }}"
                            @if($role->id == $partner->role_id) {{ "selected" }} @endif
                            >{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="old_role_id" value="{{ $partner->role_id }}">
                </div>
                <div class="form-group">
                    <label for="service_id">{{ ucfirst('service') }}</label>
                    <select class="form-control" id="service_id" name="role_id">
                        @foreach ($service as $service)
                            <option value="{{ $service->id }}"
                            @if($service->id == $partner->service_id) {{ "selected" }} @endif
                            >{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{ ucfirst('name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..." value="{{ $partner->name }}" required>
                    <input type="hidden" name="old_name" value="{{ $partner->name }}">
                </div>
                <div class="form-group">
                    <label for="username">{{ ucfirst('username') }}</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username..." value="{{ $partner->username }}" required>
                    <input type="hidden" name="old_username" value="{{ $partner->username }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection
