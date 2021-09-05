@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>
        <div class="content-body">

          <!-- eCommerce statistic -->
          <div class="row pt-2">
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pull-up ecom-card-1 bg-white">
                <div class="card-content ecom-card2 height-180">
                  <h5 class="text-muted danger position-absolute p-1">Progress Stats</h5>
                  <div>
                    <i class="ft-pie-chart danger font-large-1 float-right p-1"></i>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
              <div class="card pull-up ecom-card-1 bg-white">
                <div class="card-content ecom-card2 height-180">
                  <h5 class="text-muted info position-absolute p-1">Activity Stats</h5>
                  <div>
                    <i class="ft-activity info font-large-1 float-right p-1"></i>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-12">
              <div class="card pull-up ecom-card-1 bg-white">
                <div class="card-content ecom-card2 height-180">
                  <h5 class="text-muted warning position-absolute p-1">Sales Stats</h5>
                  <div>
                    <i class="ft-shopping-cart warning font-large-1 float-right p-1"></i>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <!--/ eCommerce statistic -->

          <!-- Bordered table start -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Bordered table</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li>
                        <a data-action="collapse"><i class="ft-minus"></i></a>
                      </li>
                      <li>
                        <a data-action="reload"><i class="ft-rotate-cw"></i></a>
                      </li>
                      <li>
                        <a data-action="expand"><i class="ft-maximize"></i></a>
                      </li>
                      <li>
                        <a data-action="close"><i class="ft-x"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <!-- <div class="card-body">
                    <p class="card-text">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p>
                  </div> -->
                  <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@TwBootstrap</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">4</th>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Bordered table end -->

        </div>
      </div>
    </div>
@endsection
