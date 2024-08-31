<?php
session_start();

// if (!isset($_SESSION['login_user'])) {
//     // Jika session login tidak ada, redirect ke halaman login
//     header("location: index.php");
//     exit();
// }
require_once "koneksi.php";

// Query to get the latest temperature
$sql = "SELECT suhu FROM tb_suhu ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result = $konek->query($sql);

$suhu = "Data tidak ditemukan";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $suhu = $row['suhu'];
}
// Query to get the latest pH
$sql_pH = "SELECT pH FROM tb_ph ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_pH = $konek->query($sql_pH);

$pH = "Data tidak ditemukan";
if ($result_pH->num_rows > 0) {
    $row_pH = $result_pH->fetch_assoc();
    $pH = $row_pH['pH'];
}

// Query to get the latest TDS
$sql_TDS = "SELECT TDS FROM tb_tds ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_TDS = $konek->query($sql_TDS);

$TDS = "Data tidak ditemukan";
if ($result_TDS->num_rows > 0) {
    $row_TDS = $result_TDS->fetch_assoc();
    $TDS = $row_TDS['TDS'];
}

// //Query to get the latest jarak
$sql_jarak = "SELECT jarak FROM tb_jarak ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_jarak = $konek->query($sql_jarak);

$jarak = "Data tidak ditemukan";
if ($result_jarak->num_rows > 0) {
    $row_jarak = $result_jarak->fetch_assoc();
    $jarak = $row_jarak['jarak'];
}

$konek->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> SIMBIOTIK </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!-- <meta http-equiv="refresh" content="2"> -->
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            "families": ["Open+Sans:300,400,600,700"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
            urls: ['assets/css/fonts.css']
        },
        active: function() {
            sessionStorage.fonts = true;
        }
    });
    </script>

    <script type="text/javascript" src="jquery/jquery.min.js"></script>
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $("#ceksuhu").load("ceksuhu.php");
        }, 1000)
    })
    $(document).ready(function() {
        setInterval(function() {
            $("#cekpH").load("cekpH.php");
        }, 1000)
    })
    $(document).ready(function() {
        setInterval(function() {
            $("#cekTDS").load("cekTDS.php");
        }, 1000)
    })
    $(document).ready(function() {
        setInterval(function() {
            $("#cekjarak").load("cekjarak.php");
        }, 1000)
    })
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/azzara.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- Tambahkan referensi ke Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    button {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #0056b3;
    }

    btn-custom {
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        border: none;
        font-size: 14px;
        padding: 8px 16px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    .btn-custom:focus {
        box-shadow: none;
        outline: none;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main Header -->
        <div class="main-header" style="background-color: #294A79;">
            <!-- Logo Header -->
            <div class="logo-header">
                <a href="index.html" class="logo">
                    <div style="font-weight: bold;" alt="navbar brand" class="navbar-brand text-white">SIMBIOTIK</div>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 3 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Suhu Air saat ini 30c
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"></div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Air mencapai batas maximum
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"></div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Tanaman membutuhkan TDS
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="assets/img/nat.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="assets/img/nat.jpg" alt="image profile"
                                                class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>Natasha Melinda</h4>
                                            <p class="text-muted">Admin</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="profile.php">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="accsetting.php">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php" data-toggle="modal"
                                        data-target="#logoutModal">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-background" style="background-color: #c1c1c1;"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="dashboard.php">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="control.php">
                                <i class="fas fa-fw fa-cog"></i>
                                <p>Control</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item" class="nav-link" href="index.php" data-toggle="modal"
                                data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        // <script>
        //     function fetchData() {
        //         fetch('data.php')
        //             .then(response => response.json())
        //             .then(data => {
        //                 document.getElementById('ceksuhu').innerText = data.suhu + '°C';
        //                 document.getElementById('cekpH').innerText = data.pH;
        //                 document.getElementById('cekTDS').innerText = data.TDS + 'ppm';
        //                 document.getElementById('cekjarak').innerText = data.jarak + 'cm';
        //             })
        //             .catch(error => console.error('Error fetching data:', error));
        //     }

        //     // Fetch data initially
        //     fetchData();

        //     // Set interval to fetch data every 5 seconds
        //     setInterval(fetchData, 5000);
        // 
        </script>
        <!-- Content Row -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Dashboard</h4>
                    </div>

                    <!-- Card Content -->
                    <div class="row text-center">

                        <!-- Suhu Air -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style="font-weight: bold; text-align: center;"
                                class="card bg-primary text-black shadow">
                                <div style="font-weight: bold; font-size: 18px;" class="card-body">
                                    Suhu Air
                                    <h4 style="font-weight: bold;" class="card-title text-white"><span
                                            id="cekpH"><?php echo $suhu; ?>°C</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- pH Air -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style="font-weight: bold; text-align: center;"
                                class="card bg-danger text-black shadow">
                                <div style="font-weight: bold; font-size: 18px;" class="card-body">
                                    pH Air
                                    <h4 style="font-weight: bold;" class="card-title text-white"><span
                                            id="cekpH"><?php echo $pH; ?></span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- TDS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style="font-weight: bold; text-align: center;"
                                class="card bg-warning text-black shadow">
                                <div style="font-weight: bold; font-size: 18px;" class="card-body">
                                    TDS
                                    <h4 style="font-weight: bold;" class="card-title text-white"><span
                                            id="cekpH"><?php echo $TDS; ?>ppm</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Tinggi Air -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style="font-weight: bold; text-align: center;"
                                class="card bg-success text-black shadow">
                                <div style="font-weight: bold; font-size: 18px;" class="card-body">
                                    Tinggi Air
                                    <h4 style="font-weight: bold;" class="card-title text-white"><span
                                            id="cekpH"><?php echo $jarak; ?>cm</span>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- GRAFIK SEMUA SENSOR -->
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4>Data Sensor Suhu</h4>
                                    <div class="dropdown no-arrow">
                                        <button type="button" onclick="exportToExcel()"
                                            class="btn btn-custom btn-sm btn-custom">
                                            <span class="btn-label">
                                            </span>
                                            Export
                                        </button>
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink5"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink5">
                                            <div class="dropdown-header">Filter Data Suhu</div>
                                            <div class="form-group">
                                                <label for="startDate">Tanggal Mulai:</label>
                                                <input type="datetime-local" id="startDate" name="startDate"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="endDate">Tanggal Selesai:</label>
                                                <input type="datetime-local" id="endDate" name="endDate"
                                                    class="form-control">
                                            </div>
                                            <button type="button" onclick="filterData()"
                                                class="btn btn-custom btn-sm btn-custom">Terapkan Filter</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card Content -->
                </div>
            </div>
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="index.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- Moment JS -->
    <script src="assets/js/plugin/moment/moment.min.js"></script><!-- DateTimePicker -->
    <script src="assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Toggle -->
    <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Azzara JS -->
    <script src="assets/js/ready.min.js"></script>
    <!-- Azzara DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    <script>
    $('#datepicker').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    </script>
    <script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
    </script>

    <!-- script grafik suhu -->
    <script>
    function toggleFilterMenu() {
        var filterMenu = document.getElementById('filterMenu');
        filterMenu.style.display = (filterMenu.style.display === 'none' || filterMenu.style.display === '') ? 'block' :
            'none';
    }

    function filterData() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(response) {
                var dataFromServer = JSON.parse(response);
                updateChart(dataFromServer);
                window.dataForExcel = dataFromServer; // Save data for export
            }
        });
    }

    function updateChart(dataFromServer) {
        console.log(dataFromServer); // Debugging: Cek data dari server

        var labels = dataFromServer.map(function(e) {
            return e.created_at;
        });
        var data = dataFromServer.map(function(e) {
            return e.suhu;
        });

        var chartData = {
            labels: labels,
            datasets: [{
                label: "Suhu Air",
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1,
                pointRadius: 0,
                data: data,
                fill: false,
                lineTension: 0,
            }]
        };

        var ctx = document.getElementById('myAreaChart').getContext('2d');
        if (window.myChart) {
            window.myChart.destroy();
        }
        window.myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                elements: {
                    line: {
                        tension: 0.5
                    }
                }
            }
        });
    }

    function exportToExcel() {
        if (!window.dataForExcel || window.dataForExcel.length === 0) {
            alert('Tidak ada data untuk diekspor.');
            return;
        }

        var ws = XLSX.utils.json_to_sheet(window.dataForExcel);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Data Suhu");

        // Generate buffer
        var wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'binary'
        });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), 'data_suhu.xlsx');
    }

    $(document).ready(function() {
        // Load initial data
        filterData();
    });
    </script>

    <script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {
        'packages': ['gauge']
    });
    google.charts.setOnLoadCallback(drawSuhuChart);

    function drawSuhuChart() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Suhu', {
                {
                    $latestSuhuAir
                }
            }], // Ganti 20 dengan nilai suhu terbaru Anda
        ]);

        var options = {
            width: 150,
            height: 150,
            redFrom: 35,
            redTo: 50,
            yellowFrom: 25,
            yellowTo: 35,
            greenFrom: 0,
            greenTo: 50,
            minorTicks: 5,
            max: 50
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_suhu_air'));
        chart.draw(data, options);

        // Optional: refresh data periodically
        function refreshSuhuData() {
            // Call your backend to get the latest data
            // For example, using AJAX (make sure to include jQuery if using this)
            $.ajax({
                url: '/path/to/your/api/endpoint',
                dataType: 'json',
                success: function(response) {
                    var suhu = parseFloat(response.suhu).toFixed(2);
                    data.setValue(0, 1, suhu);
                    chart.draw(data, options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown + ': ' + textStatus);
                }
            });
        }

        // Refresh the data every 1 second
        setInterval(refreshSuhuData, 1000);
    }
    google.charts.load('current', {
        'packages': ['gauge']
    });
    google.charts.setOnLoadCallback(drawPhChart);
    google.charts.setOnLoadCallback(drawTdsChart);
    google.charts.setOnLoadCallback(drawTinggiChart);

    function drawPhChart() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['pH', {
                {
                    $latestpHAir
                }
            }], // Ganti 5.5 dengan nilai pH terbaru Anda
        ]);

        var options = {
            width: 150,
            height: 150,
            redFrom: 0,
            redTo: 7,
            greenFrom: 7,
            greenTo: 14,
            minorTicks: 5,
            max: 14
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_ph_air'));
        chart.draw(data, options);

        // Optional: refresh data periodically
        function refreshPhData() {
            // Panggil backend Anda untuk mendapatkan data terbaru
            // Contoh menggunakan AJAX (pastikan untuk menyertakan jQuery jika menggunakan ini)
            $.ajax({
                url: '/path/to/your/api/endpoint',
                dataType: 'json',
                success: function(response) {
                    var ph = parseFloat(response.ph).toFixed(2);
                    data.setValue(0, 1, ph);
                    chart.draw(data, options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown + ': ' + textStatus);
                }
            });
        }

        // Refresh data setiap 1 detik
        setInterval(refreshPhData, 1000);
    }

    function drawTdsChart() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['TDS', {
                {
                    $latestTDS
                }
            }], // Ganti 500 dengan nilai TDS terbaru Anda
        ]);

        var options = {
            width: 150,
            height: 150,
            redFrom: 600, // Mulai zona merah dari 600
            redTo: 1000, // Hingga maksimal 1000
            yellowFrom: 0,
            yellowTo: 0, // Tidak ada zona kuning
            greenFrom: 0, // Mulai zona hijau dari 100
            greenTo: 600, // Hingga 600
            minorTicks: 5,
            max: 1000
        };



        var chart = new google.visualization.Gauge(document.getElementById('chart_tds_air'));
        chart.draw(data, options);

        // Optional: refresh data periodically
        function refreshTdsData() {
            // Panggil backend Anda untuk mendapatkan data terbaru
            // Contoh menggunakan AJAX (pastikan untuk menyertakan jQuery jika menggunakan ini)
            $.ajax({
                url: '/path/to/your/api/endpoint',
                dataType: 'json',
                success: function(response) {
                    var tds = parseFloat(response.tds).toFixed(2);
                    data.setValue(0, 1, tds);
                    chart.draw(data, options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown + ': ' + textStatus);
                }
            });
        }

        // Refresh data setiap 1 detik
        setInterval(refreshTdsData, 1000);
    }

    function drawTinggiChart() {
        var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Tinggi Air', {
                {
                    $latestTinggiAir
                }
            }], // Ganti 15 dengan nilai Tinggi Air terbaru Anda
        ]);

        var options = {
            width: 150,
            height: 150,
            redFrom: 20,
            redTo: 25,
            yellowFrom: 15,
            yellowTo: 20,
            greenFrom: 0,
            greenTo: 25,
            minorTicks: 5,
            max: 25
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_tinggi_air'));
        chart.draw(data, options);

        // Optional: refresh data periodically
        function refreshTinggiData() {
            // Panggil backend Anda untuk mendapatkan data terbaru
            // Contoh menggunakan AJAX (pastikan untuk menyertakan jQuery jika menggunakan ini)
            $.ajax({
                url: '/path/to/your/api/endpoint',
                dataType: 'json',
                success: function(response) {
                    var tinggi = parseFloat(response.tinggi).toFixed(2);
                    data.setValue(0, 1, tinggi);
                    chart.draw(data, options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown + ': ' + textStatus);
                }
            });
        }

        // Refresh data setiap 1 detik
        setInterval(refreshTinggiData, 1000);
    }
    </script>

</body>

</html>