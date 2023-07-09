@extends("layouts.app_partner")

@section("content")

    <div class="card mt-4 bg-primary">
        <div class="card-body">
            <h4 class="color-white">Tambah layanan</h4>
            <p class="color-white">
                Tambah layanan kamu disini:
            </p>
            <form action="{{ route("application-partner.tambahLayananProses") }}" method="POST" onsubmit="return checkForm(this);">@csrf @method("POST")
                <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                <div class="card card-style ml-0 mr-0 bg-white">
                    <div class="p-5">
                        <div class="form-group">
                            <label for="service_id">Layanan</label><br>
                            <select class="form-control" name="service_id">
                                @foreach ($service as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        var checkForm = function(form) {
          form.myButton.disabled = true;
          return true;
        };

    </script>

@endsection


