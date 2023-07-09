@extends("layouts.app")

@section("content")

    @include("components.alert", [
        "message" => Session::get("success"),
        "color" => "success",
        "errors" => $errors,
    ])

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst("expertise") }}</h5>
            <br>
            @include("components.documentation", ["description" => $description])
            <a href="{{ route("partner_expertise.create") }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i>
                {{ ucfirst("create") }}
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ strtoupper("id") }}</th>
                            <th>{{ ucfirst("partner") }}</th>
                            <th>{{ ucfirst("service") }}</th>
                            <th>{{ ucfirst("timestamp") }}</th>
                            <th>{{ ucfirst("action") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partner_expertise as $partner_expertise)
                        <tr>
                            <td>{{ $partner_expertise->id }}</td>
                            <td>{{ $partner_expertise->user->name ?? "" }}</td>
                            <td>{{ $partner_expertise->service->name ?? "" }}</td>
                            <td>{{ $partner_expertise->created_at }}</td>
                            <td>
                                <form action="{{ route("partner_expertise.destroy", $partner_expertise->id) }}" method="POST" onsubmit="if(!confirm('Expertise {{ $partner_expertise->service->name }} for Partner {{ $partner_expertise->user->name }} will deleted, are you sure?')){return false;}">
                                    @csrf @method("DELETE")
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
