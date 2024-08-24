@extends('users.admin.cover')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold" style="font-family:san-serif;">Welcome <span style="font-size:30px;font-style:san-serif" class="text-primary">{{ Auth::guard('admin')->user()->firstname}} {{ Auth::guard('admin')->user()->lastname}}</span></h3>
                </div>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
               <!--  <div class="card" id="card_id">
                  <div class="card-body">
                   <div class="d-flex justify-content-between">
                    <p class="card-title">Analytical graph</p>
                   </div>
                    <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                    <canvas id="analytic_graph"></canvas>
                  </div>
                </div> -->

                <div class="card">
                  
                  <div class="container mt-5">
                      <div class="form-group">
                          <select id="graph-type" class="form-control">
                              <option value="marks-by-province">Marks vs. Provinces</option>
                              <option value="user-counts-by-day">User Counts by Days</option>
                              <option value="user-counts-by-week">User Counts by Weeks</option>
                          </select>
                      </div>

                      <div id="graph-container">
                          <canvas id="data-chart"></canvas>
                      </div>
                  </div>

                </div>

              </div>
                      
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:green;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All users</p>
                      <p class="fs-30 mb-2">{{ $users_numbers }}</p>
                      <!-- <p>10.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card" style="background-color:darkblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All contents</p>
                      <p class="fs-30 mb-2">{{ $Content_numbers }}</p>
                      <!-- <p>22.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:black;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All exams</p>
                      <p class="fs-30 mb-2">{{ $Exam_numbers }}</p>
                      <!-- <p>2.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card" style="background-color:orange;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All certificate</p>
                      <p class="fs-30 mb-2">{{ $Certificate_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card" style="background-color:skyblue;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All courses</p>
                      <p class="fs-30 mb-2">{{ $Course_numbers }}</p>
                      <!-- <p>2.00% (30 days)</p> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card" style="background-color:teal;color:white;">
                    <div class="card-body">
                      <p class="mb-4">All resuslt</p>
                      <p class="fs-30 mb-2">{{ $Result_numbers }}</p>
                      <!-- <p>0.22% (30 days)</p> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- <script>
            var ctx = document.getElementById('analytic_graph').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',  // You can change this to 'line', 'pie', etc.
                data: {
                    labels: @json($provinces), // Provinces
                    datasets: [{
                        label: 'Average Score by Province',
                        data: @json($averageScores), // Average scores for each province
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });

            // Optional: Add legend to the div with id="sales-legend"
            document.getElementById('sales-legend').innerHTML = chart.generateLegend();
        </script> -->

        <script>
              document.addEventListener('DOMContentLoaded', function() {
                  var ctx = document.getElementById('data-chart').getContext('2d');
                  var chart;

                  function updateChart(type) {
                      if (chart) {
                          chart.destroy();
                      }

                      if (type === 'marks-by-province') {
                          chart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: @json($provinces),
                                  datasets: [{
                                      label: 'Average Score by Province',
                                      data: @json($averageScores),
                                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                      borderColor: 'rgba(75, 192, 192, 1)',
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  scales: {
                                      y: {
                                          beginAtZero: true,
                                          suggestedMax: 100 // Ensure the max value is set to 100
                                      }
                                  },
                                  plugins: {
                                      legend: {
                                          display: true,
                                          position: 'top'
                                      },
                                      tooltip: {
                                          enabled: true
                                      }
                                  }
                              }
                          });
                      } else if (type === 'user-counts-by-day') {
                          chart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: @json($periodLabels),
                                  datasets: [{
                                      label: 'Number of Users Created',
                                      data: @json($userCounts),
                                      backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                      borderColor: 'rgba(153, 102, 255, 1)',
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  scales: {
                                      y: {
                                          beginAtZero: true,
                                          suggestedMax: 10 // Ensure the max value is set to 10
                                      }
                                  },
                                  plugins: {
                                      legend: {
                                          display: true,
                                          position: 'top'
                                      },
                                      tooltip: {
                                          enabled: true
                                      }
                                  }
                              }
                          });
                      } else if (type === 'user-counts-by-week') {
                          chart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: @json($weekLabels),
                                  datasets: [{
                                      label: 'Number of Users Created',
                                      data: @json($weekCounts),
                                      backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                      borderColor: 'rgba(255, 159, 64, 1)',
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  scales: {
                                      y: {
                                          beginAtZero: true
                                      }
                                  },
                                  plugins: {
                                      legend: {
                                          display: true,
                                          position: 'top'
                                      },
                                      tooltip: {
                                          enabled: true
                                      }
                                  }
                              }
                          });
                      }
                  }

                  document.getElementById('graph-type').addEventListener('change', function() {
                      updateChart(this.value);
                  });

                  // Initialize with the default chart type
                  updateChart('marks-by-province');
              });
          </script>
                  
          
@endsection