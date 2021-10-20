@extends('layouts.master')

@section('title', 'Dashboard')

@section('konten')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-sm-6">
        <h1 class="m-0">Ringkasan Neraca</h1>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    {{-- Card Ringkasan --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-dark">
                <span class="info-box-icon bg-success"><i class="fas fa-wallet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Saldo</span>
                    <span class="info-box-number mb-3">{{ $count }}</span>
                    <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-dark">
            <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Bank</span>
            <span class="info-box-number mb-3">{{ $count_bank }}</span>
            <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-dark">
            <span class="info-box-icon bg-success"><i class="fas fa-money-bill"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Besar</span>
            <span class="info-box-number mb-3">{{ $count_besar }}</span>
            <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-dark">
            <span class="info-box-icon bg-success"><i class="fas fa-money-bill-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Kecil</span>
            <span class="info-box-number mb-3">{{ $count_kecil }}</span>
            <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row mb-4">
        <div class="col-sm-6">
          <h1 class="m-0">Ringkasan Alur Kas</h1>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-gradient-dark">
            <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text text-white">Pembelian</span>
                <span class="info-box-number text-white mb-3">{{ $saldo_buy_ }}</span>
                <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-3 col-12">
        <div class="info-box bg-gradient-dark">
            <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Penjualan</span>
            <span class="info-box-number mb-3">{{ $saldo_sell_ }}</span>
            <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.col -->
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="info-box bg-gradient-dark">
                <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number mb-3">{{ $cuan }}</span>
                <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-3 col-12">
            <div class="info-box bg-gradient-dark">
                <span class="info-box-icon bg-warning"><i class="fas fa-chart-line"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-white">Credit/Piutang</span>
                    <span class="info-box-number text-warning mb-3">{{ $piutang }}</span>
                    <a href="{{ route('credit.index') }}" class="btn btn-sm btn-info small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    {{-- End Card Ringkasan --}}
    </div>
  <!-- /.container-fluid -->
</div>
@endsection
