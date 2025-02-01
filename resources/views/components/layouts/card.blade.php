@extends('components.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
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
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card">
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
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
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
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
                    <div class="card">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
          <div class="card z-index-2">
              <div class="card-header pb-0">
                  <h6>Anggota Aktif Bulanan</h6>
                  <p class="text-sm">
                      <i class="fa fa-arrow-up text-success"></i>
                      <span class="font-weight-bold">{{ $persentaseKenaikanAnggota }}% pertumbuhan</span> tahun ini
                  </p>
              </div>
              <div class="card-body p-3">
                  <div class="chart">
                      <canvas id="chart-anggota-aktif" class="chart-canvas" height="300"></canvas>
                  </div>
              </div>
          </div>
      </div>
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Technology</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">John Michael</h6>
                      <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                  <p class="text-xs text-secondary mb-0">Organization</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                </td>
                <td class="align-middle">
                  <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
      
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">Alexa Liras</h6>
                      <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programator</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                </td>
                <td class="align-middle">
                  <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
      
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                      <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Executive</p>
                  <p class="text-xs text-secondary mb-0">Projects</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                </td>
                <td class="align-middle">
                  <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
      
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">Michael Levi</h6>
                      <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programator</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-success">Online</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                </td>
                <td class="align-middle">
                  <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
      
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">Richard Gran</h6>
                      <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                  <p class="text-xs text-secondary mb-0">Executive</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                </td>
                <td class="align-middle">
                  <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
      
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-xs">Miriam Eric</h6>
                      <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Programtor</p>
                  <p class="text-xs text-secondary mb-0">Developer</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm badge-secondary">Offline</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                </td>
                <td class="align-middle">
                  <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
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
