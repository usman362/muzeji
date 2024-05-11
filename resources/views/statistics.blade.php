@extends('layouts.app')
@section('content')
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"
            integrity="sha512-k37wQcV4v2h6jgYf5IUz1MoSKPpDs630XGSmCaCCOXxy2awgAWKHGZWr9nMyGgk3IOxA1NxdkN8r1JHgkUtMoQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
    <div class="main-container" style="margin-top: 0">
        <div class="main-heading">
            <h1>Statistics</h1>
        </div>
        <div class="statistics-container">
            <div class="projects-dropdown dropdown">
                <div class="dropdown-box">
                    <span id="project-select">{{ !empty(\App\Models\Project::find(request()->project)) ? \App\Models\Project::find(request()->project)->title : 'Select the Project'}}</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="submenu project-submenu" id="dropdown-items">
                    @foreach ($projects as $key => $project)
                        <a href="{{ $project->id == request()->project ? 'javascript:void(0)' : url('statistics').'?project='.$project->id }}" class="submenu-item {{$project->id == request()->project  ? 'active' : ''}}"
                            onclick="onChangeDropdown(event,'project-select','{{ $project->title }}','dropdown-items' )">
                            {{ $project->title }} <i class="fa fa-check"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="line-chart-section">
                <div class="chart-heading">
                    <div>
                        <p>Total views of this exebition</p>
                        <h1>{{ $computerVisits + $phoneVisits + $tabletVisits }}</h1>
                    </div>
                    <i class="fa fa-info-circle"></i>
                </div>
                <div id="main" style="width: 100%; height: 500px"></div>
            </div>
            <div class="pie-charts-section">
                <div class="pie-chart">
                    <div class="chart-heading">
                        <div>
                            <p>Devices</p>
                            <h1>{{ $totalDevices }}</h1>
                            <small>Secondary text</small>
                        </div>
                        <i class="fa fa-info-circle"></i>
                    </div>
                    <div id="pie-1" style="width: 100%; height: 400px"></div>
                </div>
                <div class="pie-chart">
                    <div class="chart-heading">
                        <div>
                            <p>Access</p>
                            <h1>{{$short_codes->count()+$qrcodes->count()}}</h1>
                            <small>From type</small>
                        </div>
                        <i class="fa fa-info-circle"></i>
                    </div>
                    <div id="pie-2" style="width: 100%; height: 400px"></div>
                </div>
            </div>
        </div>
        <div class="main-heading" style="margin-bottom: 20px; margin-top: 60px">
            <h2>Projects History:</h2>
        </div>
        <div class="statistics-project-table">
            @foreach ($histories as $history)
            @php
                $daysAgo = \Carbon\Carbon::parse($history->created_at)->diffInDays();
                if ($daysAgo < 1) {
                    $formattedCreatedAt = 'Today';
                } elseif ($daysAgo == 1) {
                    $formattedCreatedAt = 'Yesterday';
                } else {
                    $formattedCreatedAt = (int)$daysAgo . ' days ago';
                }
            @endphp
                <div class="table-row">
                    <div class="place-title">
                        <input type="checkbox" />
                        <div class="title">
                            <div>{{ $history->description }}</div>
                            <div class="time-badge">
                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{$formattedCreatedAt}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function onChangeDropdown(event, id, value, parentId) {
            console.log([event, id, value, parentId]);
            Array.from(document.getElementById(parentId).children).forEach(
                (element) => {
                    element.classList.remove("active");
                }
            );
            const selectDropdown = document.getElementById(id);
            selectDropdown.innerText = value;
            event.target.classList.add("active");
        }

        const option = {
            tooltip: {
                trigger: "axis",
            },
            legend: {
                data: [
                    @foreach ($visits as $visit)
                        "{{ $visit[0]->poi->detail->title ?? '' }}",
                    @endforeach
                ],
                top: "25px",
            },
            grid: {
                top: "75px",
                left: "3%",
                right: "4%",
                bottom: "3%",
                containLabel: true,
            },
            xAxis: {
                type: "category",
                boundaryGap: false,
                data: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            yAxis: {
                type: "value",
            },
            series: [
                @foreach ($visits as $visit)
                    {
                        name: "{{ $visit[0]->poi->detail->title ?? '' }}",
                        type: "line",
                        data: [
                            @for ($i = 1; $i <= 12; ++$i)
                                {{ \App\Helpers\Helpers::getViews($visit[0]->poi_id, $i) }},
                            @endfor
                        ],

                    },
                @endforeach
            ],
        };

        var myChart = echarts.init(document.getElementById("main"));
        myChart.setOption(option);

        const option2 = {
            tooltip: {
                trigger: "item",
            },
            legend: {
                orient: "vertical",
                left: "left",
                show: false,
            },
            series: [{
                name: "Access From",
                type: "pie",
                radius: "50%",
                data: [{
                        value: {{ $computerVisits }},
                        name: "Computer"
                    },
                    {
                        value: {{ $tabletVisits }},
                        name: "Tablet"
                    },
                    {
                        value: {{ $phoneVisits }},
                        name: "Phone"
                    },
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: "rgba(0, 0, 0, 0.5)",
                    },
                },
            }, ],
        };

        var myChart2 = echarts.init(document.getElementById("pie-1"));
        myChart2.setOption(option2);

        const option3 = {
            tooltip: {
                trigger: "item",
            },
            legend: {
                orient: "vertical",
                left: "left",
                show: false,
            },
            series: [{
                name: "Access From",
                type: "pie",
                radius: "50%",
                data: [{
                        value: {{$short_codes->count()}},
                        name: "Short Code"
                    },
                    {
                        value: {{$qrcodes->count()}},
                        name: "QR Code"
                    },
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: "rgba(0, 0, 0, 0.5)",
                    },
                },
            }, ],
        };

        var myChart3 = echarts.init(document.getElementById("pie-2"));
        myChart3.setOption(option3);
    </script>
@endpush
