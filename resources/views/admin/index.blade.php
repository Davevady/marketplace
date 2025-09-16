@extends('layouts.app')

@section('title', 'Atlantis Lite - Bootstrap 4 Admin Dashboard')

@section('content')
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">
                            Dashboard Admin
                        </h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                        <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Users</p>
                                        <h4 class="card-title">{{ $users->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="bi-box-seam"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Produk</p>
                                        <h4 class="card-title">{{ $products->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Transaksi Pending</p>
                                        <h4 class="card-title">{{ $pendingCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="bi bi-cart-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Transaksi Selesai</p>
                                        <h4 class="card-title">{{ $paidCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Pendapatan</p>
                                        <h4 class="card-title">Rp {{ number_format($paidTotal, 0, ',', '.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Grafik Penjualan</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="chartPenjualan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Produk Terlaris</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Order Terbaru</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="recent-order" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <th>Total Item</th>
                                            <th>Total Pembelian</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <th>Total Item</th>
                                            <th>Total Pembelian</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td>{{ $order['user_name'] }}</td>
                                                <td>{{ $order['total_items'] }}</td>
                                                <td>Rp {{ number_format($order['total_amount'], 0, ',', '.') }}</td>
                                                <td class="timestamps-formated" data-date="{{ $order['created_at'] }}"></td>
                                                <td>{{ ucfirst($order['status']) }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="/" class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk terbaru -->
                <div class="col-sm-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Product Terbaru</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="product-terbaru" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Product</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Ditambahkan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Product</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Ditambahkan</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($latestProducts as $product)
                                            <tr>
                                                <td>
                                                    <div>{{ $product->name }}</div>
                                                    <div>
                                                        <small class="badge badge-info">
                                                            <i class="bi bi-upc"></i> {{ $product->sku }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td class="is-active-{{ $product->is_active ? 'true' : 'false' }}">
                                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="timestamps-formated" data-date="{{ $product->created_at }}">
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Product">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger"
                                                            data-original-title="Remove Product">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifikasi Stok Produk Rendah -->
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h4 class="card-title mb-0">
                                <i class="bi bi-exclamation-triangle"></i> Stok Produk Rendah
                            </h4>
                        </div>
                        <div class="card-body">
                            @if ($lowStockProducts->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="low-stock">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Produk</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Min</th>
                                                <th>Terakhir Diupdate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lowStockProducts as $product)
                                                <tr class="{{ $product->stock <= 0 ? 'table-danger' : 'table-warning' }}">
                                                    <td>
                                                        <div>{{ $product->name }}</div>
                                                        <div>
                                                            <small class="badge badge-info">
                                                                <i class="bi bi-upc"></i> {{ $product->sku }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $product->stock <= 0 ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                            {{ $product->stock }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $product->min_stock }}</td>
                                                    <td class="timestamps-formated"
                                                        data-date="{{ $product['updated_at'] }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-success mb-0">
                                    <i class="bi bi-check-circle"></i> Semua stok aman 👍
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Recent Order
            $('#recent-order').DataTable({
                "pageLength": 10,
            });

            // Product terbaru
            $('#product-terbaru').DataTable({
                autoWidth: false,
                pageLength: 10,
                order: [
                    [4, 'desc']
                ],
                columnDefs: [{
                        width: "30%",
                        targets: 0
                    }, // Nama Product
                    {
                        width: "15%",
                        targets: 1
                    }, // Harga
                    {
                        width: "10%",
                        targets: 2
                    }, // Stok
                    {
                        width: "10%",
                        targets: 3
                    }, // Status
                    {
                        width: "20%",
                        targets: 4
                    }, // Ditambahkan
                ]
            });

            // Low Stock
            $('#low-stock').DataTable({
                autoWidth: false,
                pageLength: 10,
                order: [
                    [3, 'asc']
                ],
                columnDefs: [{
                        width: "30%",
                        targets: 0
                    },
                    {
                        width: "15%",
                        targets: 1
                    },
                    {
                        width: "15%",
                        targets: 2
                    },
                    {
                        width: "5%",
                        targets: 3
                    },
                    {
                        width: "5%",
                        targets: 4
                    },
                ]
            });

            // Add Row
            $('#add-row').DataTable({
                autoWidth: false,
                pageLength: 10,
                // order: [[4, 'desc']],
                columnDefs: [{
                        width: "30%",
                        targets: 0
                    }, // Nama Product
                    {
                        width: "10%",
                        targets: 1
                    }, // Satuan
                    {
                        width: "15%",
                        targets: 2
                    }, // Harga
                    {
                        width: "10%",
                        targets: 3
                    }, // Stok
                    {
                        width: "30%",
                        targets: 4
                    }, // Deskripsi
                    {
                        width: "10%",
                        targets: 5
                    }, // Status
                ]
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });

        var chartPenjualan = document.getElementById('chartPenjualan').getContext('2d'),
            pieChart = document.getElementById('pieChart').getContext('2d');

        var salesDataLine = new Chart(chartPenjualan, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Total Penjualan",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: 'transparent',
                    fill: true,
                    borderWidth: 2,
                    data: @json($salesData) // ambil data dari controller
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 10,
                        fontColor: '#1d7af3',
                    }
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                }
            }
        });

        var bestProductPie = new Chart(pieChart, {
            type: 'pie',
            data: {
                labels: @json($bestProductNames),
                datasets: [{
                    label: 'Jumlah Produk per Kategori',
                    data: @json($bestProductTotals),
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e',
                        '#e74a3b',
                        '#858796'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                pieceLabel: {
                    render: 'percentage',
                    fontColor: 'white',
                    fontSize: 14,
                },
            }
        })
    </script>
@endpush
