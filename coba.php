<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Sensor</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 20px;
        position: relative;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="datetime-local"] {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .filter-icon {
        cursor: pointer;
        font-size: 24px;
        color: #007bff;
        position: absolute;
        top: 20px;
        right: 20px;
        transition: color 0.3s;
    }

    .filter-icon:hover {
        color: #0056b3;
    }

    .filter-menu-content {
        display: none;
        position: absolute;
        top: 60px;
        right: 20px;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 4px;
        padding: 10px;
        z-index: 10;
        width: 250px;
    }

    .filter-menu-content label,
    .filter-menu-content input {
        display: block;
        margin-bottom: 10px;
    }

    .filter-menu-content input[type="datetime-local"] {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .filter-menu-content button {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin-top: 10px;
    }

    .filter-menu-content button:hover {
        background: #0056b3;
    }

    canvas {
        width: 100% !important;
        height: auto !important;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Grafik Sensor Suhu, pH, Jarak, dan TDS</h1>

        <div class="filter-icon" onclick="toggleFilterMenu()">
            <i class="fas fa-ellipsis-v"></i>
        </div>
        <div class="filter-menu-content" id="filterMenu">
            <form id="filterForm">
                <label for="startDate">Tanggal Mulai:</label>
                <input type="datetime-local" id="startDate" name="startDate">

                <label for="endDate">Tanggal Selesai:</label>
                <input type="datetime-local" id="endDate" name="endDate">

                <button type="button" onclick="filterData()">Terapkan Filter</button>
                <button type="button" onclick="exportToExcel()">Ekspor ke Excel</button>
            </form>
        </div>

        <canvas id="myAreaChart" width="400" height="200"></canvas>
    </div>

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
        var suhuData = dataFromServer.map(function(e) {
            return e.suhu;
        });
        var pHData = dataFromServer.map(function(e) {
            return e.pH;
        });
        var jarakData = dataFromServer.map(function(e) {
            return e.jarak;
        });
        var TDSData = dataFromServer.map(function(e) {
            return e.TDS;
        });

        var chartData = {
            labels: labels,
            datasets: [{
                    label: "Suhu Air",
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1,
                    pointRadius: 0,
                    data: suhuData,
                    fill: false,
                    lineTension: 0,
                },
                {
                    label: "pH Air",
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                    pointRadius: 0,
                    data: pHData,
                    fill: false,
                    lineTension: 0,
                },
                {
                    label: "Tinggi Air (Jarak)",
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1,
                    pointRadius: 0,
                    data: jarakData,
                    fill: false,
                    lineTension: 0,
                },
                {
                    label: "TDS",
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgb(153, 102, 255)',
                    borderWidth: 1,
                    pointRadius: 0,
                    data: TDSData,
                    fill: false,
                    lineTension: 0,
                }
            ]
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
        XLSX.utils.book_append_sheet(wb, ws, "Data Sensor");

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
        }), 'data_sensor.xlsx');
    }

    $(document).ready(function() {
        // Load initial data
        filterData();
    });
    </script>

</body>

</html>