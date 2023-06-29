@extends("layouts.app_auth")

@section("content")

    <h1 class="h6 text-gray-900 mb-4">Halo, silahkan isi form dibawah untuk bergabung !</h6>

    <form class="user" method="POST" action="{{ route("form-partner.process") }}">

        @csrf @method("POST")

        <input type="hidden" name="role_id" value="2">

        <div class="form-group">
            <label for="service_id">Punya skill apa ?</label><br>
            <select name="service_id" class="form-control">
                @foreach ($service as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Nama Anda siapa ?</label>
            <input type="text" class="form-control" id="name" aria-describedby="name"
                placeholder="" name="name" required>
        </div>

        <div class="input-group mb-3">
            <label for="phone_number">Nomor Whatsapp Anda berapa ?</label>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">+62</span>
            </div>
            <input type="text" class="form-control" placeholder="8xxxxxxxxxx" aria-label="Username" aria-describedby="basic-addon1" name="phone_number" id="phone_number" required>
        </div>

        <div class="form-group">
            <label for="username">Buat username Anda</label>
            <input type="text" class="form-control" id="username" aria-describedby="username"
                placeholder="" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Buat password Anda</label>
            <input type="password" class="form-control" id="password" aria-describedby="password"
                placeholder="" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
           Submit
        </button>

    </form>

@endsection
