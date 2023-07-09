@extends("layouts.app_customer")

@section("content")

    <div class="card mt-4 bg-{{ $global["app_color"] }}">
        <div class="card-body">
            <h4 class="color-white">Pesan</h4>
            <p class="color-white">
                Kamu bisa pesan layanan disini. Isi form dibawah ini ya.
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="p-5">
                <form class="user" method="POST" action="{{ route("application-customer.prosesPesanan") }}" onsubmit="return checkForm(this);">

                    @csrf @method("POST")

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="form-group">
                        <label for="service_id">Kamu butuh apa ?</label>
                        <select name="service_id" id="service_id" class="form-control">
                            @foreach ($service as $service)
                                <option value="{{ $service->id }}"
                                    @if($service_id == $service->id)
                                    {{ "selected" }}
                                    @endif>{{ $service->name }}</option>
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
                        <input type="number" step="any" class="form-control" placeholder="628xxxxxxxxxx" aria-label="Username"
                            aria-describedby="basic-addon1" name="phone_number" id="phone_number" value="{{ Auth()->user()->phone_number }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama kamu siapa ?</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name"
                            placeholder="" name="name" value="{{ Auth()->user()->name }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="myButton" value="Submit">
                       Pesan
                    </button>

                </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        var checkForm = function(form) {
          form.myButton.disabled = true;
          return true;
        };

    </script>

@endsection


