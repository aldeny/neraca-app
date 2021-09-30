@extends('layouts.master')

@section('title', 'Dashboard')

@section('konten')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-sm-6">
        <h1 class="m-0">Ringkasan Bisnis</h1>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    {{-- Card Ringkasan --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-wallet"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Total Saldo</span>
            <span class="info-box-number">{{ $count }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Bank</span>
            <span class="info-box-number">{{ $count_bank }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-money-bill"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Besar</span>
            <span class="info-box-number">{{ $count_besar }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-money-bill-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Saldo Kas Kecil</span>
            <span class="info-box-number">{{ $count_kecil }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
            <span class="info-box-text text-danger">Pembelian</span>
            <span class="info-box-number text-danger">{{ $saldo_buy_ }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-4 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Penjualan</span>
            <span class="info-box-number">{{ $saldo_sell_ }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.col -->
        </div>
        <div class="col-md-4 col-sm-4 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Pendapatan</span>
                <span class="info-box-number">{{ $cuan}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    {{-- End Card Ringkasan --}}
    </div>
  <!-- /.container-fluid -->
</div>
@endsection
