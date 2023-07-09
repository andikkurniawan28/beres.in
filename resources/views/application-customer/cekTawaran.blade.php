@extends("layouts.app_customer")

@section("content")

{{-- <meta http-equiv="refresh" content="10;URL='{{ route("application-customer.pesananByOrderId", $order->id) }}'"> --}}
    <div class="card mt-4 bg-{{ $global["app_color"] }}">
        <div class="card-body">
            <h4 class="color-white">Tawaran Partner</h4>
            <p class="color-white">
                Bantu refresh ya. Barangkali ada tawaran masuk.
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="p-4">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $bid->id }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ $bid->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Partner</th>
                            <td>{{ $bid->user->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <th>Tarif</th>
                            <td>
                                @if($bid->price === NULL)
                                {{ "Belum Menawar" }}
                                @else
                                Rp. {{ number_format($bid->price) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Katanya</th>
                            <td>{{ $bid->description }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if($bid->price === NULL)

                                @else
                                <form action="{{ route("application-customer.pesanTawaran") }}" method="POST">
                                    @csrf @method("POST")
                                    <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                    <button class="btn btn-sm btn-primary btn-block text-xs" type="submit">Pesan</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-sm btn-outline-info text-xs" onClick="window.location.reload();"><i class="fas fa-spinner"></i> Refresh</button>
                    <a class="btn btn-sm btn-outline-secondary text-xs" href="{{ route("application-customer.pesananByOrderId", $bid->order_id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection


