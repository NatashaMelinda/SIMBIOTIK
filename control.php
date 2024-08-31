<?php

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

// Query to get the latest pH input
$sql_pH_input = "SELECT pH FROM input_data_ph ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_pH_input = $konek->query($sql_pH_input);

$pH_input = "Data tidak ditemukan";
if ($result_pH_input->num_rows > 0) {
    $row_pH_input = $result_pH_input->fetch_assoc();
    $pH_input = $row_pH_input['pH'];
}

// Query to get the latest TDS
$sql_TDS = "SELECT TDS FROM tb_tds ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_TDS = $konek->query($sql_TDS);

$TDS = "Data tidak ditemukan";
if ($result_TDS->num_rows > 0) {
    $row_TDS = $result_TDS->fetch_assoc();
    $TDS = $row_TDS['TDS'];
}

// Query to get the latest tds input
$sql_TDS_input = "SELECT TDS FROM input_data_tds ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_TDS_input = $konek->query($sql_TDS_input);

$TDS_input = "Data tidak ditemukan";
if ($result_TDS_input->num_rows > 0) {
    $row_TDS_input = $result_TDS_input->fetch_assoc();
    $TDS_input = $row_TDS_input['TDS'];
}

//Query to get the latest distance
$sql_jarak = "SELECT jarak FROM tb_jarak ORDER BY id DESC LIMIT 1"; // Sesuaikan nama tabel dan kolom
$result_jarak = $konek->query($sql_jarak);

$jarak = "Data tidak ditemukan";
if ($result_jarak->num_rows > 0) {
    $row_jarak = $result_jarak->fetch_assoc();
    $jarak = $row_jarak['jarak'];
}

if (!isset($_SESSION['water_pump_status'])) {
    $_SESSION['water_pump_status'] = 'ON'; // Default status
}

$water_pump_status = $_SESSION['water_pump_status'];

$konek->close();
?>
<!DOCTYPE html>
<html lang="en">



<!-- HTML Anda dilanjutkan dari sini -->


<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> SIMBIOTIK </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta http-equiv="refresh" content="15">
    <link rel="icon" href="assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch initial status for Water Pump
        fetch('status_water_pump.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const button = document.getElementById('toggleButton_water');
                    if (data.status_pompa == 0) {
                        button.textContent = 'OFF';
                        button.classList.add('btn-danger');
                        button.classList.remove('btn-success');
                    } else {
                        button.textContent = 'ON';
                        button.classList.add('btn-success');
                        button.classList.remove('btn-danger');
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat status Water Pump');
            });

        // Fetch initial status for Aerator Pump
        fetch('status_aerator_pump.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const button = document.getElementById('toggleButton_aerator');
                    if (data.status_aerator == 0) {
                        button.textContent = 'OFF';
                        button.classList.add('btn-danger');
                        button.classList.remove('btn-success');
                    } else {
                        button.textContent = 'ON';
                        button.classList.add('btn-success');
                        button.classList.remove('btn-danger');
                    }
                    // } else {
                    //     alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat status Aerator Pump');
            });
    });

    function toggleButton(buttonId) {
        const button = document.getElementById(buttonId);
        const currentStatus = button.textContent.trim();
        const newStatus = currentStatus === 'ON' ? 'OFF' : 'ON';
        const newStatusValue = newStatus === 'ON' ? 1 : 0;

        const url = buttonId === 'toggleButton_water' ? 'cp_water_pump.php' : 'cp_aerator_pump.php';

        fetch(`${url}?stat=${newStatus}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.textContent = newStatus;
                    if (newStatus === 'ON') {
                        button.classList.add('btn-success');
                        button.classList.remove('btn-danger');
                    } else {
                        button.classList.add('btn-danger');
                        button.classList.remove('btn-success');
                    }
                    // } else {
                    //     alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengubah status pompa');
            });
    }
    </script>

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
    <script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $("#cekjarak").load("cekjarak.php");
        }, 1000)
    })
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
            $("#cekinputpH").load("cekinputpH.php");
        }, 1000)
    })
    $(document).ready(function() {
        setInterval(function() {
            $("#cekinputTDS").load("cekinputTDS.php");
        }, 1000)
    })
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#edit_btn_pH').click(function() {
            $('#inlineinput_pH').prop('disabled', false);
            $('#send_pH').prop('disabled', false);
        });

        $('#send_pH').click(function() {
            var nilai_pH = $('#inlineinput_pH').val();
            $.ajax({
                type: 'POST',
                url: 'set_point_pH.php',
                data: {
                    nilai_ph: nilai_pH
                },
                success: function(response) {
                    alert(response);
                    $('#inlineinput_pH').prop('disabled', true);
                    $('#send_pH').prop('disabled', true);
                },
                error: function() {
                    alert('Terjadi kesalahan. Data tidak dapat disimpan.');
                }
            });
        });

        $('#edit_btn_TDS').click(function() {
            $('#inlineinput_TDS').prop('disabled', false);
            $('#send_TDS').prop('disabled', false);
        });

        $('#send_TDS').click(function() {
            var nilai_TDS = $('#inlineinput_TDS').val();
            $.ajax({
                type: 'POST',
                url: 'set_point_TDS.php',
                data: {
                    nilai_tds: nilai_TDS
                },
                success: function(response) {
                    alert(response);
                    $('#inlineinput_TDS').prop('disabled', true);
                    $('#send_TDS').prop('disabled', true);
                },
                error: function() {
                    alert('Terjadi kesalahan. Data tidak dapat disimpan.');
                }
            });
        });
    });
    $(document).ready(function() {
        // Load set points and populate input fields
        function loadSetPoints() {
            $.ajax({
                type: 'GET',
                url: 'get_set_point.php',
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.set_pH !== null) {
                        $('#inlineinput_pH').val(data.set_pH);
                    }
                    if (data.set_tds !== null) {
                        $('#inlineinput_TDS').val(data.set_tds);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat set points');
                }
            });
        }

        loadSetPoints();

        // Existing pH handling code
        $('#edit_btn_pH').click(function() {
            $('#inlineinput_pH').prop('disabled', false);
            $('#send_pH').prop('disabled', false);
        });

        $('#send_pH').click(function() {
            var nilai_pH = $('#inlineinput_pH').val();
            $.ajax({
                type: 'POST',
                url: 'set_point_pH.php',
                data: {
                    nilai_ph: nilai_pH
                },
                success: function(response) {
                    alert(response);
                    $('#inlineinput_pH').prop('disabled', true);
                    $('#send_pH').prop('disabled', true);
                    loadSetPoints(); // Reload set points after saving
                },
                error: function(xhr, status, error) {
                    console.error("Error saving pH data:", xhr.responseText);
                    alert('Terjadi kesalahan. Data tidak dapat disimpan.');
                }
            });
        });

        // Existing TDS handling code
        $('#edit_btn_TDS').click(function() {
            $('#inlineinput_TDS').prop('disabled', false);
            $('#send_TDS').prop('disabled', false);
        });

        $('#send_TDS').click(function() {
            var nilai_TDS = $('#inlineinput_TDS').val();
            $.ajax({
                type: 'POST',
                url: 'set_point_TDS.php',
                data: {
                    nilai_tds: nilai_TDS
                },
                success: function(response) {
                    alert(response);
                    $('#inlineinput_TDS').prop('disabled', true);
                    $('#send_TDS').prop('disabled', true);
                    loadSetPoints(); // Reload set points after saving
                },
                error: function(xhr, status, error) {
                    console.error("Error saving TDS data:", xhr.responseText);
                    alert('Terjadi kesalahan. Data tidak dapat disimpan.');
                }
            });
        });
    });
    </script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/azzara.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		 -->
        <div class="main-header" style="background-color: #294A79;">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="index.html" class="logo">
                    <img src="/simbiotik_rw/assets/img/icon2.png" alt="navbar brand" class="rounded-circle"
                        style="width: 40px; height: 40px; margin-right: 10px;">
                    <div style="font-weight: bold;" class="navbar-brand text-white">SIMBIOTIK</div>
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
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Control</h4>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="tabelsuhu.php" class="card-body text-black p-3"
                                style="font-size: large; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <h4 style="font-weight: bold;" class="card-title text-black">Suhu Air</h4>
                                <div class="progress-circle blue">
                                    <div class="progress-value">
                                        <h4 style="font-weight: bold;" class="card-title text-black"><span
                                                id="ceksuhu"><?php echo $suhu; ?></span>°C</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="tabelpH.php" class="card-body text-black p-3"
                                style="font-size: large; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <h4 style="font-weight: bold;" class="card-title text-black">pH Air</h4>
                                <div class="progress-circle blue">
                                    <div class="progress-value">
                                        <h4 style="font-weight: bold;" class="card-title text-black"><span
                                                id="cekpH"><?php echo $pH; ?></span>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="tabeltds.php" class="card-body text-black p-3"
                                style="font-size: large; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <h4 style="font-weight: bold;" class="card-title text-black">TDS</h4>
                                <div class="progress-circle success">
                                    <div class="progress-value">
                                        <h4 style="font-weight: bold;" class="card-title text-black">
                                            <span id="cekTDS"><?php echo $TDS; ?></span>ppm
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-4">
                            <a href="tabeltinggi.php" class="card-body text-black p-3"
                                style="font-size: large; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <h4 style="font-weight: bold;" class="card-title text-black">Tinggi Air</h4>
                                <div class="progress-circle success">
                                    <div class="progress-value">
                                        <h4 style="font-weight: bold;" class="card-title text-black">
                                            <span id="cekjarak"><?php echo $jarak; ?></span>cm
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <!-- {{-- Conten Control --}} -->
                    <div class="col-md-12">
                        <div class="card card-with-nav">
                            <!-- {{-- <div class="card-header">
 
                </div> --}} -->
                            <div class="card-body">


                                <div class="mt-4 text-center">
                                    <!-- {{-- Program Atur Nilai pH --}} -->
                                    <div class="form-group form-inline">
                                        <label for="inlineinput_pH" class="col-md-3 col-form-label">Atur Nilai
                                            pH</label>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput_pH"
                                                placeholder="<?php echo $pH_input; ?>" disabled><span id="cekpH"></span>
                                            <!-- Menggunakan disabled untuk mencegah input sebelum tombol Edit ditekan -->
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning" id="edit_btn_pH"><i class="fas fa-edit"></i>
                                                Edit</button>
                                            <!-- Tombol Kirim -->
                                            <button class="btn btn-primary" id="send_pH" disabled><i
                                                    class="fas fa-paper-plane"></i> Kirim</button>
                                        </div>
                                        <!-- {{-- Tombol Water Pump --}} -->
                                        <div class="col-md-3">
                                            <h4>Water Pump</h4>
                                            <button id="toggleButton_water" class="btn btn-success"
                                                onclick="toggleButton('toggleButton_water')">ON</button>
                                        </div>
                                    </div>

                                    <script>
                                    document.getElementById("edit_btn_pH").addEventListener("click", function() {
                                        // Mengaktifkan input saat tombol Edit ditekan
                                        document.getElementById("inlineinput_pH").removeAttribute("disabled");
                                        // Mengaktifkan tombol Kirim
                                        document.getElementById("send_pH").removeAttribute("disabled");
                                    });

                                    document.getElementById("send_pH").addEventListener("click", function() {
                                        const pHValue = document.getElementById("inlineinput_pH").value;

                                        // Mengunci kembali input saat tombol Kirim ditekan
                                        document.getElementById("inlineinput_pH").setAttribute("disabled",
                                            "disabled");
                                        // Menonaktifkan tombol Kirim
                                        document.getElementById("send_pH").setAttribute("disabled", "disabled");

                                        // Kirim nilai pH ke server
                                        fetch('inputdataph.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded'
                                                },
                                                body: `pH=${encodeURIComponent(pHValue)}`
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message);
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                alert('Terjadi kesalahan saat mengirim nilai pH');
                                            });
                                    });
                                    </script>
                                    <!-- {{-- Penutup Program Atur Nilai pH --}} -->

                                    <!-- {{-- Program Atur Nilai TDS --}} -->
                                    <div class="form-group form-inline">
                                        <label for="inlineinput_TDS" class="col-md-3 col-form-label">Atur Nilai
                                            TDS</label>
                                        <div class="col-md-3 p-0">
                                            <input type="text" class="form-control input-full" id="inlineinput_TDS"
                                                placeholder="<?php echo $TDS_input; ?>" disabled>
                                            <!-- Menggunakan disabled untuk mencegah input sebelum tombol Edit ditekan -->
                                        </div>
                                        <div class="col-md-3 p-2">
                                            <!-- Tombol Edit -->
                                            <button class="btn btn-warning" id="edit_btn_TDS"><i
                                                    class="fas fa-edit"></i> Edit</button>
                                            <!-- Tombol Kirim -->
                                            <button class="btn btn-primary" id="send_TDS" disabled><i
                                                    class="fas fa-paper-plane"></i> Kirim</button>
                                        </div>
                                        <!-- {{-- Tombol Aerator Pump --}} -->
                                        <div class="col-md-3">
                                            <h4>Aerator Pump</h4>
                                            <button id="toggleButton_aerator" class="btn btn-success"
                                                onclick="toggleButton('toggleButton_aerator')">ON</button>
                                        </div>
                                    </div>

                                    <script>
                                    document.getElementById("edit_btn_TDS").addEventListener("click", function() {
                                        // Mengaktifkan input saat tombol Edit ditekan
                                        document.getElementById("inlineinput_TDS").removeAttribute("disabled");
                                        // Mengaktifkan tombol Kirim
                                        document.getElementById("send_TDS").removeAttribute("disabled");
                                    });

                                    document.getElementById("send_TDS").addEventListener("click", function() {
                                        const TDSValue = document.getElementById("inlineinput_TDS").value;

                                        // Mengunci kembali input saat tombol Kirim ditekan
                                        document.getElementById("inlineinput_TDS").setAttribute("disabled",
                                            "disabled");
                                        // Menonaktifkan tombol Kirim
                                        document.getElementById("send_TDS").setAttribute("disabled",
                                            "disabled");

                                        // Kirim nilai TDS ke server
                                        fetch('inputdataTDS.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/x-www-form-urlencoded'
                                                },
                                                body: `TDS=${encodeURIComponent(TDSValue)}`
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                alert(data.message);
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                alert('Terjadi kesalahan saat mengirim nilai TDS');
                                            });
                                    });
                                    </script>
                                </div>


                                <!-- <script>
                                function toggleButton(buttonId) {
                                    const button = document.getElementById(buttonId);
                                    const isOn = button.classList.contains('btn-success');
                                    let confirmationMessage = isOn ?
                                        'Apakah Anda yakin ingin mematikan perangkat ini?' :
                                        'Apakah Anda yakin ingin menyalakan perangkat ini?';

                                    Swal.fire({
                                        title: 'Konfirmasi',
                                        text: confirmationMessage,
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya',
                                        cancelButtonText: 'Tidak'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            if (isOn) {
                                                button.textContent = 'OFF';
                                                button.classList.remove('btn-success');
                                                button.classList.add('btn-danger');
                                            } else {
                                                button.textContent = 'ON';
                                                button.classList.remove('btn-danger');
                                                button.classList.add('btn-success');
                                            }
                                            Swal.fire({
                                                title: 'Berhasil!',
                                                text: 'Operasi berhasil dilakukan.',
                                                icon: 'success',
                                                confirmButtonColor: '#3085d6',
                                            });
                                        }
                                    });
                                }
                                </script> -->

                            </div>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                        <script>
                        $(document).ready(function() {
                            $('.btn-toggle').click(function() {
                                $(this).find('.btn').toggleClass('active');

                                // Menambahkan kode untuk menampilkan pesan alert saat tombol diklik
                                var status = $(this).find('.active').text();
                                var pumpType = $(this).closest('.col-md-4').find('h4').text();
                                if (!pumpType) {
                                    pumpType = $(this).closest('.col-md-5').find('h4').text();
                                }
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Info Pump!',
                                    text: pumpType.trim() + ' is turned ' + status,
                                    confirmButtonText: 'OK',
                                    confirmButtonClass: 'btn btn-info'
                                });

                                if ($(this).find('.btn-primary').length > 0) {
                                    $(this).find('.btn').toggleClass('btn-primary');
                                }
                                if ($(this).find('.btn-danger').length > 0) {
                                    $(this).find('.btn').toggleClass('btn-danger');
                                }
                                if ($(this).find('.btn-success').length > 0) {
                                    $(this).find('.btn').toggleClass('btn-success');
                                }
                                if ($(this).find('.btn-info').length > 0) {
                                    $(this).find('.btn').toggleClass('btn-info');
                                }

                                $(this).find('.btn').toggleClass('btn-default');

                            });

                            // $('#send_pH').click(function() {
                            //     Swal.fire({
                            //         icon: 'success',
                            //         title: 'Nilai pH Dikirim!',
                            //         text: 'You clicked the button!',
                            //         confirmButtonText: 'OK',
                            //         confirmButtonClass: 'btn btn-success'
                            //     });
                            // });

                            // $('#send_TDS').click(function() {
                            //     Swal.fire({
                            //         icon: 'success',
                            //         title: 'Nilai TDS Dikirim!',
                            //         text: 'You clicked the button!',
                            //         confirmButtonText: 'OK',
                            //         confirmButtonClass: 'btn btn-success'
                            //     });
                            // });
                        });
                        </script>
                    </div>
                    <!-- {{-- Penutup Program Atur Nilai TDS --}} -->
                </div>
                <!-- {{-- end conten control --}} -->
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
</body>

</html>