@extends("layouts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ ucfirst("dashboard") }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route("service.index") }}">{{ ucfirst("service") }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create {{ ucfirst("service") }}</li>
        </ol>
    </nav>

    @include("components.alert", [
        "message" => Session::get("success"),
        "color" => "success",
        "errors" => $errors,
    ])

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Create {{ ucfirst("service") }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route("service.store") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ ucfirst("name") }}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..." required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection
