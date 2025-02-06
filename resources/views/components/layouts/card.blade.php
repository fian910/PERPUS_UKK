@extends('components.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <a href="{{ route('anggota') }}">
                        <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fas fa-users text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $totalAnggota }}
                                    </h5>
                                    <span class="text-white text-sm">Total Anggota</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card">
                        <a href="{{ route('pustaka') }}">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fas fa-book text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $totalPustaka }}
                                    </h5>
                                    <span class="text-white text-sm">Total Pustaka</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <a href="{{ route('transaksi') }}">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fas fa-exchange-alt text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $totalTransaksi }}
                                    </h5>
                                    <span class="text-white text-sm">Total Transaksi</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card">
                        <a href="{{ route('pengarang') }}">
                        <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fas fa-pen-nib text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $totalPengarang }}
                                    </h5>
                                    <span class="text-white text-sm">Total Pengarang</span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
          <div class="card z-index-2">
              <div class="card-header pb-0">
                  <h6>Anggota Aktif Bulanan</h6>
              </div>
              <div class="card-body p-3">
                  <div class="chart">
                      <canvas id="chart-anggota-aktif" class="chart-canvas" height="300"></canvas>
                  </div>
              </div>
          </div>
      </div>
      
      @push('scripts')
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
      document.addEventListener('DOMContentLoaded', function() {
          var ctx = document.getElementById('chart-anggota-aktif').getContext('2d');
          var chartData = @json($chartDataAnggota);
      
          var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);
          gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
          gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
          gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');
      
          new Chart(ctx, {
              type: 'line',
              data: {
                  labels: chartData.labels,
                  datasets: [{
                      label: 'Anggota Aktif',
                      tension: 0.4,
                      borderWidth: 0,
                      pointRadius: 0,
                      borderColor: "#cb0c9f",
                      backgroundColor: gradientStroke1,
                      borderWidth: 3,
                      fill: true,
                      data: chartData.values,
                      maxBarThickness: 6
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          display: false,
                      }
                  },
                  interaction: {
                      intersect: false,
                      mode: 'index',
                  },
                  scales: {
                      y: {
                          grid: {
                              drawBorder: false,
                              display: true,
                              drawOnChartArea: true,
                              drawTicks: false,
                              borderDash: [5, 5]
                          },
                          ticks: {
                              display: true,
                              padding: 10,
                              color: '#b2b9bf',
                              font: {
                                  size: 11,
                                  family: "Open Sans",
                                  style: 'normal',
                                  lineHeight: 2
                              },
                          }
                      },
                      x: {
                          grid: {
                              drawBorder: false,
                              display: false,
                              drawOnChartArea: false,
                              drawTicks: false,
                              borderDash: [5, 5]
                          },
                          ticks: {
                              display: true,
                              color: '#b2b9bf',
                              padding: 20,
                              font: {
                                  size: 11,
                                  family: "Open Sans",
                                  style: 'normal',
                                  lineHeight: 2
                              },
                          }
                      },
                  },
              },
          });
      });
      </script>
      @endpush
    </div>
</div>

@endsection
