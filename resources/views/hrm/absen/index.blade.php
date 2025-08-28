@extends('layouts.app')

@section('content')

    <div class="attendance-header">
        <div class="attendance-content">
            <img src="./assets/img/icons/hand01.svg" class="hand-img" alt="img">
            <h3>Selamat datang, <span>{{auth()->user()->name}}</span></h3>
        </div>
        <div>
            <ul class="table-top-head employe">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                            class="feather-rotate-ccw"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                            data-feather="chevron-up" class="feather-chevron-up"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="attendance-widget">
        <div class="row">
            <div class="col-xl-4 col-lg-12 col-md-4 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <h5>Kehadiran<span>{{ \Carbon\Carbon::now()->format('d F Y') }}</span></h5>
                        <div class="card attendance">
                            <div>
                                <img src="./assets/img/icons/time-big.svg" alt="time-img">
                            </div>
                            <div>
                                <h2 id="current-time">{{ \Carbon\Carbon::now()->format('H:i:s') }}</h2>
                                <p>Waktu Saat Ini</p>
                            </div>

                        </div>
                        <div class="modal-attendance-btn flex-column flex-lg-row">
                            <a href="javascript:void(0);" class="btn btn-submit w-100">Clock Out</a>
                            <a href="javascript:void(0);" class="btn btn-cancel me-2 w-100" data-bs-dismiss="modal">Clock
                                Out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12 col-md-8 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <h5>Kehadiran Dalam Bulan Ini</h5>
                        <ul class="widget-attend">
                            <li class="box-attend">
                                <div class="light-card">
                                    <h4>28</h4>
                                    <h6>Hadir</h6>
                                </div>
                            </li>
                            <li class="box-attend">
                                <div class="light-card">
                                    <h4>28</h4>
                                    <h6>Hadir</h6>
                                </div>
                            </li>
                            <li class="box-attend">
                                <div class="danger-card">
                                    <h4>05</h4>
                                    <h6>Absen</h6>
                                </div>
                            </li>
                            <li class="box-attend">
                                <div class="success-card">
                                    <h4>20</h4>
                                    <h6>Tepat Waktu</h6>
                                </div>
                            </li>
                            <li class="box-attend">
                                <div class="warming-card">
                                    <h4>08</h4>
                                    <h6>Terlambat</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card table-list-card">


        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th class="no-sort">
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Date</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Production</th>
                        <th>Break</th>
                        <th>Overtime</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Total Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row 1 -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>01 Jan 2023</td>
                        <td>09:15 AM</td>
                        <td>08:55 PM</td>
                        <td>9h 00m</td>
                        <td>1h 13m</td>
                        <td>00h 50m</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:78%"></div>
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badge-linesuccess">Present</span></td>
                        <td>09h 50m</td>
                    </tr>
                    <!-- Example Row 2 -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>02 Jan 2023</td>
                        <td>09:07 AM</td>
                        <td>08:40 PM</td>
                        <td>9h 10m</td>
                        <td>1h 07m</td>
                        <td>01h 13m</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:124%"></div>
                            </div>
                        </td>
                        <td><span class="badge-linesuccess">Present</span></td>
                        <td>10h 23m</td>
                    </tr>
                    <!-- Example Row 3 -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>03 Jan 2023</td>
                        <td>09:04 AM</td>
                        <td>08:52 PM</td>
                        <td>8h 47m</td>
                        <td>1h 04m</td>
                        <td>01h 07m</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:124%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badge-linesuccess">Present</span></td>
                        <td>10h 04m</td>
                    </tr>
                    <!-- Example Row 4 (Absent) -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>04 Jan 2023</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:78%"></div>
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badges-inactive">Absent</span></td>
                        <td>-</td>
                    </tr>
                    <!-- Example Row 5 -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>06 Jan 2023</td>
                        <td>09:10 AM</td>
                        <td>08:48 PM</td>
                        <td>8h 38m</td>
                        <td>0h 58m</td>
                        <td>01h 08m</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:78%"></div>
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badge-linesuccess">Present</span></td>
                        <td>09h 46m</td>
                    </tr>
                    <!-- Example Row 6 -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>07 Jan 2023</td>
                        <td>09:03 AM</td>
                        <td>08:57 PM</td>
                        <td>8h 50m</td>
                        <td>1h 26m</td>
                        <td>0h 43m</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:78%"></div>
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badge-linesuccess">Present</span></td>
                        <td>08h 33m</td>
                    </tr>
                    <!-- Example Row 7 (Holiday) -->
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>04 Jan 2023</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <div class="progress attendance">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:78%"></div>
                                <div class="progress-bar progress-bar-warning" role="progressbar" style="width:55%"></div>
                                <div class="progress-bar progress-bar-danger" role="progressbar" style="width:15%"></div>
                            </div>
                        </td>
                        <td><span class="badges-inactive Holiday">Holiday</span></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function updateTime() {
            const el = document.getElementById('current-time');
            if (el) {
                const now = new Date();
                let h = now.getHours().toString().padStart(2, '0');
                let m = now.getMinutes().toString().padStart(2, '0');
                let s = now.getSeconds().toString().padStart(2, '0');
                el.textContent = `${h}:${m}:${s}`;
            }
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
@endpush
