@extends('admin.layout.index')
<!-- Page Sidebar Ends-->
@section('content')
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Dashboard</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">

          <div class="col-xl-6 col-lg-12 box-col-6 xl-50">
            <div class="card">
              <div class="card-header">
                <h5>Skill Status</h5>
              </div>
              <div class="card-body">
                <div class="chart-container skill-chart">
                  <div id="circlechart"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-12 box-col-6 xl-50">
            <div class="card">
              <div class="card-header">
                <div class="header-top">
                  <h5>Order Status</h5>
                  <div class="card-header-right-icon">
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown">Today</button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Today</a><a class="dropdown-item" href="#">Tomorrow</a><a class="dropdown-item" href="#">Yesterday</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-container progress-chart">
                  <div id="progress1"></div>
                  <div id="progress2"></div>
                  <div id="progress3"></div>
                  <div id="progress4"></div>
                  <div id="progress5">               </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
  </div>
@endsection

@section('scripts')
  <script src="../assets/js/chart/apex-chart/moment.min.js"></script>
  <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
  <script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
  <script src="../assets/js/chart-widget.js"></script>

@endsection
