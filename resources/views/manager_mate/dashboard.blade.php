@extends('manager_mate_layouts.app')
@section('manager_title', 'Manager | Dashboard')
@section('manager_content')
<div class="row mainrow">
  <!-- Left side columns -->
  <div class="col-lg-8">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">All Reports <span>/This Month</span></h5>
            <div class="row justify-content-center">
              {{-- In total meal --}}
                <div class="col-xxl-6 col-md-6 col-sm-12">
                  <div class="card info-card sales-card align-items-center">
                    <div class="card-body text-center">
                      <h5 class="card-title">In-Total Meal <span>| this Month</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cup-hot-fill"></i>
                        </div>
                        <div class="ps-3">
                          @php
                            $grandtotal = 0;
                            $monthlyArrMeals = json_decode($monthlyDetails->dailymeals);
                            foreach ($monthlyArrMeals as $key => $value) {
                            $grandtotal += $value;
                            }
                            @endphp
                            <a href="{{route('mealstable.index')}}">
                              <h6 style="color:#012970; font-weight:700; font-size:28px"><i class="bi bi-filter-right"></i>
                                {{$grandtotal}}</h6>
                            </a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                {{-- end In total meal --}}
                {{-- total bazar --}}
                <div class="col-xxl-6 col-md-6 col-sm-12">
                  <div class="card info-card sales-card align-items-center">
                    <div class="card-body text-center">
                      <h5 class="card-title">In-Total Bazar <span>| this Month</span></h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <div class="ps-3">
                            @php
                            $totals = 0;
                            $monthlyArrBazar = json_decode($monthlyDetails->dailybazar);
                            foreach ($bazarsArr as $key => $value) {
                            $totals += $value->total;
                            }
                            @endphp
                            <a href="{{route('bazarstable.index')}}">
                              <h6 style="color:#012970; font-weight:700; font-size:28px"><i class="fa-solid fa-comments-dollar"></i> {{$totals}}/=</h6>
                            </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- meal rate --}}
                <div class="col-xxl-6 col-md-6 col-sm-12">
                  <div class="card info-card sales-card align-items-center">
                    <div class="card-body">
                      <h5 class="card-title">Meal Rate <span>| this Month</span></h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div class="ps-3">
                            <a href="{{route('manager_mate.dashboard')}}">
                              <h6 style="color:#012970; font-weight:700; font-size:28px"><i class="fa-solid fa-chart-line"></i> {{$monthlyDetails->meal_rate}}</h6>
                            </a>
                        </div>
                      </div>
                      <a class="btn btn-dark btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#verticalycentered" href="{{route('otherexpences', $monthlyDetails->id)}}">Add other Expencies</a> 
                      <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Add Other Exepences</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('otherexpences', $monthlyDetails->id)}}" method="post">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                <table>
                                    <thead>
                                      <th class="text-center">Name</th>
                                      <th class="text-center">Price</th>
                                    </thead>
                                    <tbody id="otherExpences">
                                      @if($monthlyDetails->other_expence)
                                          @php
                                              $monthlyExpences = json_decode($monthlyDetails->other_expence);
                                              $array0 = $monthlyExpences->ename;
                                              $array1 = $monthlyExpences->eprice;
                                          @endphp
                                          @for ($i = 0; $i < count($array0); $i++)
                                              <tr class="deleteCell">
                                                  <td><input type="text" name="ename[]" value="{{$array0[$i]}}" class="ename form-control"></td>
                                                  <td><input type="number" name="eprice[]" value="{{$array1[$i]}}" class="eprice form-control"></td>
                                                  <td class="RetrivedDelete" style="text-align: center; font-weight: 800; color: orange; cursor: pointer;">✖</td>
                                              </tr>
                                          @endfor
                                      @endif
                                    </tbody>
                                    <tfoot>
                                      <tr id="add-button-row" style="text-align:center;">
                                          <td colspan="3" style="padding-top: 5px; color: chocolate; font-size: 20px">
                                              <a href="#" class="add-button" style="text-decoration: none"><i class="bi bi-plus-circle"></i></a>
                                          </td>
                                      </tr>
                                  </tfoot>  
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class='fas fa-reply-all'></i></button>
                                <button type="submit" name="submit" class="btn btn-outline-primary">Add / Update</button>
                              </div>
                            </form>
                            <script>
                              const tbody = document.querySelector('#otherExpences');
                                const addButtonRow = document.querySelector('#add-button-row');
                                const templates = `  <tr>
                                <td><input type="text" name="ename[]" class="ename form-control" /></td>
                                <td><input type="number" name="eprice[]" class="eprice form-control" /></td>
                                <td><a href="#" class="delete">&#10006</a></td>
                                </tr>`;
                                const addButton = document.querySelector('.add-button');
                                // const outputButton = document.querySelector('#output-button');
                    
                                const addTableRow = () => tbody.innerHTML += templates;
                                const removeTableRow = e => e.target.closest('tr').remove();
                                const generateTableBody = () => {
                                    for (let y = 0; y < 1; y++) {
                                        addTableRow();
                                    }
                                }                    
                                addButton.addEventListener('click', e=>{
                                  e.preventDefault();
                                  addTableRow();
                                });
                                tbody.addEventListener('click', e => {
                                    e.preventDefault();
                                    if(e.target.classList.contains('RetrivedDelete')){
                                        removeTableRow(e);
                                    }
                                    if (e.target.classList.contains('delete'))
                                        removeTableRow(e);
                                });
                                generateTableBody();
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 {{--end meal rate --}}
                 {{-- end total bazar --}}         
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div><!-- End Left side columns -->
  <!-- Right side columns -->
  <div class="col-lg-4">
    <!-- Recent Activity -->
    <div class="card">
      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Recent Activity <span>| Today</span></h5>

        <div class="activity">

          <div class="activity-item d-flex">
            <div class="activite-label">32 min</div>
            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
            <div class="activity-content">
              Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">56 min</div>
            <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
            <div class="activity-content">
              Voluptatem blanditiis blanditiis eveniet
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">2 hrs</div>
            <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
            <div class="activity-content">
              Voluptates corrupti molestias voluptatem
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">1 day</div>
            <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
            <div class="activity-content">
              Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">2 days</div>
            <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
            <div class="activity-content">
              Est sit eum reiciendis exercitationem
            </div>
          </div><!-- End activity item-->

          <div class="activity-item d-flex">
            <div class="activite-label">4 weeks</div>
            <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
            <div class="activity-content">
              Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
            </div>
          </div><!-- End activity item-->

        </div>

      </div>
    </div><!-- End Recent Activity -->
    
  </div><!-- End Right side columns -->
    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Details Report <span>/This Month</span></h5>
              <div class="row">
                {{--details meal --}}
                <div class="col-xxl-4 col-md-6 col-sm-12">
                  <div class="card info-card sales-card align-items-center">
                    <div class="card-body text-center">
                      <h5 class="card-title">Total Meal <span>| by RoomMates</span></h5>  
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cup-hot-fill"></i>
                        </div>
                        <div class="ps-3">
                          <div class="row" style="margin-top: 20px">
                            <div class="col" style="line-height:16px">
                              @foreach ($users as $user)
                              <p class="text-muted small fw-bold" style="text-wrap: nowrap; overflow:hidden">{{$user->name}}:</p>
                              @endforeach
                            </div>
                            <div class="col" style="line-height:16px">
                              @foreach ($allMeals as $keys=>$values)
                              <p class="text-success small fw-bold ps-1">{{$values}}</p>
                              @endforeach
                            </div>
                          </div>  
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
                 {{--end details meal --}}
                {{-- details bazar --}}
                <div class="col-xxl-4 col-md-6 col-sm-12">
                  <div class="card info-card sales-card align-items-center">
                    <div class="card-body text-center">
                      <h5 class="card-title">Total Bazar <span>| by RoomMates</span></h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <div class="ps-3">
                          @foreach ($bazarsArr as $keys=>$values)
                          <p style="line-height: 10px; margin-top:20px"><span
                              class="text-muted small fw-bold">{{$values->user->name}}:</span><span
                              class="text-success small fw-bold ps-1">{{$values->total}} /=</span></p>
                          @endforeach
                        </div>                        
                      </div>
                      
                    </div>
                  </div>
                </div>
                 {{-- roommates --}}
              <div class="col-xxl-4 col-md-6 col-sm-12">
                <div class="card info-card sales-card align-items-center">
                  <div class="card-body">
                    <h5 class="card-title">RoomMates <span>| this Month</span></h5>
                    <div class="d-flex align-items-center">
                      <div class="ps-3 text-center">
                        <a href="{{route('roommates.index')}}">
                          <h6 style="color:#012970; font-weight:700; font-size:28px"><i class="bi bi-hearts"></i>
                            0{{count($users)}}</h6>
                        </a>
                        <div class="col" style="margin-top:16px; text-align:center">
                          @foreach ($users as $user)
                          <span class="text-success small pt-1 fw-bold" style="text-wrap: nowrap">{{$user->name}}</span><br>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
               {{-- end roommates --}}
              </div>
              {{-- <div class="row">
                <div class="col-12">
                  <div class="card">
                    <h1 class="card-header">Debits & Credits</h1>
                  </div>
                </div>
                </div>            --}}
            </div>
          </div>
        </div>
      </div>
      
    </div><!-- End Left side columns -->
</div>
<div class="row" id="faq" name="faq">
  <div class="col-12">
      <div class="card">
          <div class="card-body">
            <h5 class="card-title">FAQ <span>/ Documentations</span></h5>
          <div class="">
            @php
                $faqJson = File::get(base_path('public/JSON/faq.json'));
                $faqData = json_decode($faqJson);
            @endphp
            @foreach ($faqData as $key=>$faq)
            <div class="faq-content">
              <div class="faq-header p-2">
                <h4 style="position: relative">{!!__( $faq->title )!!}<span
                    style="position: absolute; right:5px"><i class="fa-solid fa-angle-down"></i></span></h4>
              </div>
              <div class="faq-body pt-2">
                <p>{!!__( $faq->body )!!}</p>
              </div>
            </div>
            @endforeach
          </div>
          </div>
        </div>
  </div>
</div>
@endsection