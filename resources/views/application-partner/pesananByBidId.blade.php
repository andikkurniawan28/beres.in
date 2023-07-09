@extends("layouts.app_partner")

@section("content")

    <div class="card mt-4 bg-primary">
        <div class="card-body">
            <h4 class="color-white">Pesanan</h4>
            <p class="color-white">
                Bantu refresh ya. Barangkali ada tawaran masuk.
            </p>
            <div class="card card-style ml-0 mr-0 bg-white">
                <div class="p-4">
                    <table class="table table-sm table-hover table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $bid->order->id }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ $bid->order->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Layanan</th>
                            <td>{{ $bid->order->service->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $bid->order->description }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $bid->order->address }}</td>
                        </tr>
                        <tr>
                            <th>Atas nama</th>
                            <td>{{ $bid->order->name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($bid->order->is_open === 1)
                                <span class="badge badge-pill badge-primary">Terbuka</span>
                                @elseif ($bid->order->is_open === 2)
                                    <span class="badge badge-pill badge-success">Disetujui</span>
                                @elseif ($bid->order->is_open === 0)
                                    <span class="badge badge-pill badge-danger">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tarif</th>
                            <td>
                                @if($bid->price === NULL)
                                <form action="{{ route("application-partner.tawar") }}" method="POST">
                                @csrf @method("POST")
                                <input type="hidden" name="order_id" value="{{ $bid->order_id }}">
                                <input type="hidden" name="user_id" value="{{ $bid->user_id }}">
                                <input type="number" step="any" class="form-control" name="price" required>
                                @else
                                Rp. {{ number_format($bid->price) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>
                                @if($bid->description === NULL)
                                <textarea name="description" class="form-control" required></textarea>
                                @else
                                {{ $bid->description }}
                                @endif
                            </td>
                        </tr>
                        @if($bid->description === NULL && $bid->price === NULL)
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary btn-block">
                                   Submit
                                </button>
                            </td>
                            </form>
                        </tr>
                        @endif
                    </table>
                    <button class="btn btn-sm btn-outline-info text-xs" onClick="window.location.reload();"><i class="fas fa-spinner"></i> Refresh</button>
                    <a class="btn btn-sm btn-outline-secondary text-xs" href="{{ route("application-partner.pesanan", Auth::user()->id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>

@endsection


