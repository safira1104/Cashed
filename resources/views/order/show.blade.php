<x-layout title="Order #{{ $order->id }}">
    <x-slot:title>Detail Order</x-slot:title>

    <style>
        body {
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027);
            color: #ffffff;
            font-family: 'Baskervville SC', serif;
        }

        .card {
            background: #202731;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(71, 68, 68, 0.368);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            padding: 1.5rem;
            color: #ffffff;
        }

        .card-body.border-bottom {
            border-bottom: 1px solid #343a40;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.3);
        }

        .d-flex {
            display: flex;
        }

        .d-flex .ms-auto {
            margin-left: auto;
        }

        .form-text {
            color: #ffffff;
        }

        .btn-dark {
            background-color: #2d2f31;
            border-color: #343a40;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #b6bec5;
            border-color: #495057;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card mb-2">
                    <div class="card-body border-bottom">
                        <div class="d-flex">
                            <div>Customer:</div>
                            <div class="ms-auto">{{ $order->customer }}</div>
                        </div>

                        <div class="d-flex">
                            <div>Date:</div>
                            <div class="ms-auto">{{ $order->formatted_created_date }}</div>
                        </div>
                    </div>

                    <div class="card-body border-bottom">
                        <div class="d-grid gap-2">
                            @foreach ($order->details as $detail)
                                <div class="card">
                                    <div class="card-body">
                                        <div>{{ $detail->product->name }}</div>

                                        <div class="d-flex">
                                            <div class="form-text">
                                                {{ number_format($detail->qty) }} x {{ number_format($detail->price) }}
                                            </div>
                                            <div class="ms-auto form-text">
                                                Rp{{ number_format($detail->qty * $detail->price) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <div>Total</div>
                            <div class="ms-auto mb-0 fw-bold">Rp{{ number_format($order->total) }}</div>
                        </div>

                        <div class="d-flex">
                            <div>Payment</div>
                            <div class="ms-auto mb-0">Rp{{ number_format($order->payment) }}</div>
                        </div>

                        <div class="d-flex">
                            <div>Kembalian</div>
                            <div class="ms-auto mb-0">Rp{{ number_format($order->payment - $order->total) }}</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('orders.index') }}" class="btn btn-dark">Kembali</a>
            </div>
        </div>
    </div>
</x-layout>
