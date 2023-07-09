@extends("layouts.app_partner")

@section("content")

    <div class="card mt-4 bg-primary">
        <div class="card-body">
            <h4 class="color-white">Layanan kamu</h4>
            <p class="color-white">
                Layanan yang kamu tawarkan diantaranya :
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="row mt-3 pt-1 mb-3">
                    @foreach ($expertise as $expertise)
                    <div class="col-12">
                        <i class="float-left ml-3 mr-3"
                            data-feather="tool"
                            data-feather-line="1"
                            data-feather-size="35"
                            data-feather-color="blue2-dark"
                            data-feather-bg="blue2-fade-light">
                        </i>
                        <h5 class="color-black float-left font-13 font-500 line-height-s pb-3 mb-3 text-xs">{{$expertise->service->name ?? "" }}</h5>
                    </div>
                    @endforeach
                    <a href="{{ route("application-partner.tambahLayanan") }}">
                    <div class="col-12">
                        <i class="float-left ml-3 mr-3"
                            data-feather="plus"
                            data-feather-line="1"
                            data-feather-size="35"
                            data-feather-color="blue2-dark"
                            data-feather-bg="blue2-fade-light">
                        </i>
                        <h5 class="color-black float-left font-13 font-500 line-height-s pb-3 mb-3 text-xs">Tambah Layanan</h5>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


