@extends("layouts.app_auth")

@section("content")

    <h5 class="h5 text-gray-900 mb-4 text-center">Halo, ada yang bisa kami bantu ? &#128075</h5>

    <form class="user" method="POST" action="{{ route("form-client.process") }}" onsubmit="return checkForm(this);">

        @csrf @method("POST")

        <div class="form-group">
            <label for="service_id">Kamu butuh apa ?</label>
            <select name="service_id" id="service_id" class="form-control">
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Ada masalah apa ?</label>
            <textarea class="form-control" cols="20" rows="10" name="description" placeholder="Jelasin lengkap ya, cantumkan merk, ukuran atau informasi lain supaya Partner kami bisa bantuin. &#128521" required></textarea>
        </div>

        <div class="form-group">
            <label for="address">Lokasinya dimana ?</label>
            <textarea class="form-control" name="address" cols="20" rows="10" placeholder="Cantumin nama jalan, kecamatan atau kelurahan. Kasih patokan juga ya misalnya depan kantor pos atau depan jembatan." required></textarea>
        </div>

        <div class="form-group">
            <label for="address">Nomor WA kamu berapa ?</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+62</span>
                </div>
                <input type="number" step="any" class="form-control" placeholder="8xxxxxxxxxx" aria-label="Username" aria-describedby="basic-addon1" name="phone_number" id="phone_number" required>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Nama kamu siapa ?</label>
            <input type="text" class="form-control" id="name" aria-describedby="name"
                placeholder="" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block" name="myButton" value="Submit">
           Submit
        </button>

    </form>

    <script>

        var checkForm = function(form) {
          form.myButton.disabled = true;
          return true;
        };

    </script>

@endsection
