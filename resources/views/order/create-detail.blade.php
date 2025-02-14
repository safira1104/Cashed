<x-layout title="Orders">
    <div class="container">
        <div class="row">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-body border-bottom fw-bold">
                        <a href="{{ route('orders.create') }}" class="text-decoration-none text-black">
                            <i class="bi-arrow-left"></i>
                        </a>
                        Product
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('orders.storeDetail', ['product' => $product->id]) }}">
                            @csrf

                            <x-text-input name="name" label="Nama" value="{{ $product->name }}"
                                :disabled="true"></x-text-input>
                            <x-text-input name="qty" label="Qty" type="number"
                                value="{{ old('qty', $detail != null ? $detail->qty : '1') }}"></x-text-input>
                            <x-text-input name="price" label="Price" type="number"
                                value="{{ old('price', $detail != null ? $detail->price : $product->price) }}"></x-text-input>

                            <div class="d-flex flex-row-reverse flex-reverse justify-content-between">
                                <button type="submit" class="btn btn-dark">Simpan</button>
                                @if ($detail != null)
                                    <button type="submit" name="submit" value="destroy"
                                        class="btn btn-danger">Hapus</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
