<?php
include 'koneksi.php';

$sql = "SELECT id, nilai_suhu, nilai_pH, nilai_tds, nilai_ketinggian, created_at, updated_at FROM tabel_sensor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data dalam tabel HTML
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nilai Suhu</th>
                <th>Nilai pH</th>
                <th>Nilai TDS</th>
                <th>Nilai Ketinggian</th>
                <th>Waktu Dibuat</th>
                <th>Waktu Diperbarui</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["nilai_suhu"]. "</td>
                <td>" . $row["nilai_pH"]. "</td>
                <td>" . $row["nilai_tds"]. "</td>
                <td>" . $row["nilai_ketinggian"]. "</td>
                <td>" . $row["created_at"]. "</td>
                <td>" . $row["updated_at"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>