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
                    Select the Project <i class="fa fa-chevron-down"></i>
                </div>
                <div class="submenu project-submenu">
                    @foreach ($projects as $key => $project)
                        <a href="{{url('statistics')}}?project={{$project->id}}" class="submenu-item">
                            {{$project->title}} <i class="fa fa-check"></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="line-chart-section">
                <div class="chart-heading">
                    <div>
                        <p>Total views of this exebition</p>
                        <h1>5.987,37</h1>
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
                            <h1>10.000</h1>
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
                            <h1>99999</h1>
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
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-row">
                <div class="place-title">
                    <input type="checkbox" />
                    <div class="title">
                        <div>Ana changed address description in Grad Velenje.</div>
                        <div class="time-badge">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 8 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const option = {
            tooltip: {
                trigger: "axis",
            },
            legend: {
                data: ["Email", "Union Ads", "Video Ads", "Direct", "Search Engine"],
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
                data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            },
            yAxis: {
                type: "value",
            },
            series: [{
                    name: "Email",
                    type: "line",
                    data: [120, 132, 101, 134, 90, 230, 210],
                },
                {
                    name: "Union Ads",
                    type: "line",

                    data: [220, 182, 191, 234, 290, 330, 310],
                },
                {
                    name: "Video Ads",
                    type: "line",
                    data: [150, 232, 201, 154, 190, 330, 410],
                },
                {
                    name: "Direct",
                    type: "line",
                    data: [320, 332, 301, 334, 390, 330, 320],
                },
                {
                    name: "Search Engine",
                    type: "line",
                    data: [820, 932, 901, 934, 1290, 1330, 1320],
                },
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
                        value: 1048,
                        name: "Search Engine"
                    },
                    {
                        value: 735,
                        name: "Direct"
                    },
                    {
                        value: 580,
                        name: "Email"
                    },
                    {
                        value: 484,
                        name: "Union Ads"
                    },
                    {
                        value: 300,
                        name: "Video Ads"
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
                        value: 1048,
                        name: "Search Engine"
                    },
                    {
                        value: 735,
                        name: "Direct"
                    },
                    {
                        value: 580,
                        name: "Email"
                    },
                    {
                        value: 484,
                        name: "Union Ads"
                    },
                    {
                        value: 300,
                        name: "Video Ads"
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
