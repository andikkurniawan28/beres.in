@extends("layouts.app_customer")

@section("content")

        <div class="card mt-4 bg-{{ $global["app_color"] }}">
            <div class="card-body">
                <h4 class="color-white">Layanan kami</h4>
                <p class="color-white">
                    Dengan senang hati menawarkan beragam layanan berkualitas untuk memenuhi kebutuhan Anda diantaranya :
                </p>
                <div class="card card-style ml-0 mr-0 bg-white">
                    <div class="row mt-3 pt-1 mb-3">
                        @foreach ($service as $service)
                            <div class="col-12">
                            <a href="{{ route("application-customer.pesan", $service->id) }}">
                                <i class="float-left ml-3 mr-3"
                                data-feather="tool"
                                data-feather-line="1"
                                data-feather-size="35"
                                data-feather-color="blue2-dark"
                                data-feather-bg="blue2-fade-light">
                                </i>
                                <h5 class="color-black float-left font-13 font-500 line-height-s pb-3 mb-3 text-xs">{{$service->name }}</h5>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endsection


