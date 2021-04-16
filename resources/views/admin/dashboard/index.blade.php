@extends('layouts.base')
@section('page-title', 'Dashboard Users')
@section('content')
<div class="col-xl-9 xl-100 chart_data_left box-col-12">
  <div class="card">
    <div class="card-body p-0">
      <div class="row m-0 chart-main">
        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
          <div class="media align-items-center">
            <div class="hospital-small-chart">
              <div class="small-bar">
                <div class="small-chart flot-chart-container"></div>
              </div>
            </div>
            <div class="media-body">
              <div class="right-chart-content">
                <h4>1001</h4><span>purchase </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
          <div class="media align-items-center">
            <div class="hospital-small-chart">
              <div class="small-bar">
                <div class="small-chart1 flot-chart-container"></div>
              </div>
            </div>
            <div class="media-body">
              <div class="right-chart-content">
                <h4>1005</h4><span>Sales</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
          <div class="media align-items-center">
            <div class="hospital-small-chart">
              <div class="small-bar">
                <div class="small-chart2 flot-chart-container"></div>
              </div>
            </div>
            <div class="media-body">
              <div class="right-chart-content">
                <h4>100</h4><span>Sales return</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
          <div class="media border-none align-items-center">
            <div class="hospital-small-chart">
              <div class="small-bar">
                <div class="small-chart3 flot-chart-container"></div>
              </div>
            </div>
            <div class="media-body">
              <div class="right-chart-content">
                <h4>101</h4><span>Purchase ret</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row second-chart-list third-news-update">
    <div class="col-xl-12 col-lg-12 xl-50 morning-sec box-col-12">
      <div class="card o-hidden profile-greeting">
        <div class="card-body">
          <div class="media">
            <div class="badge-groups w-100">
              <div class="badge f-12"><i class="mr-1" data-feather="clock"></i><span id="txt"></span></div>
              <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>
            </div>
          </div>
          <div class="greeting-user text-center">
            <div class="profile-vector"><img class="img-fluid" src="../assets/images/dashboard/welcome.png" alt=""></div>
            <h4 class="f-w-600"><span id="greeting">Good Morning</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>
            <p><span> Today's earrning is $405 & your sales increase rate is 3.7 over the last 24 hours</span></p>
            <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a></div>
            <div class="left-icon"><i class="fa fa-bell"> </i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
@endsection