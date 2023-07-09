@extends("layouts.app_customer")

@section("content")

    <div class="card mt-4 bg-{{ $global["app_color"] }}">
        <div class="card-body">
            <h4 class="color-white">Daftar Penawaran</h4>
            <p class="color-white">
                Bantu refresh ya. Barangkali ada tawaran masuk.
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="p-4">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Layanan</th>
                            <td>{{ $order->service->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $order->description }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <th>Whatsapp</th>
                            <td>{{ $order->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Atas nama</th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>Tawaran</th>
                            <td>
                                @foreach ($order->bid as $bid)
                                    <li>
                                        <a href="{{ route("application-customer.cekTawaran", $bid->id) }}">{{ $bid->user->name ?? "" }} -
                                        @if($bid->price === NULL)
                                            {{ "Belum menawar" }}
                                        @else
                                            Rp. {{ number_format($bid->price) }}
                                        @endif
                                        </a>
                                    </li>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-sm btn-outline-info text-xs" onClick="window.location.reload();"><i class="fas fa-spinner"></i> Refresh</button>
                    <a class="btn btn-sm btn-outline-secondary text-xs" href="{{ route("application-customer.pesanan", Auth::user()->id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection


