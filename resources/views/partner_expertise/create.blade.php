@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("partner_expertise.index") }}">{{ ucfirst("expertise") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create {{ ucfirst("expertise") }}</li>
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
                Create {{ ucfirst("expertise") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("partner_expertise.store") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">{{ ucfirst('partner') }}</label><br>
                    <select name="user_id" class="form-control">
                        @foreach ($partner as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
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
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
