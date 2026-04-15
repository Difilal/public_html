<?php
/**
 * Fungsi untuk memanggil koponen untuk ditampilkan di view
 * 
 * @param string $componentName Nama komponen yang ingin ditampilkan
 * @param array $data Data atau parameter yang ingin dikirim ke komponen
 */
function loadComponent($componentName, $data = []) {
    $componentPath = __DIR__ . "/../components/{$componentName}.php"; 

    if (file_exists($componentPath)) {
        extract($data); // Mengubah array asosiatif menjadi variabel
        include $componentPath;
    } else {
        echo "<p>Component <b>{$componentPath}</b> not found!</p>";
    }
}

/**
 * Fungsi untuk mendapatkan data dari tabel tertentu dengan batas jumlah dan kolom spesifik
 * 
 * @param string $table Nama tabel yang ingin diambil datanya
 * @param array $columns Kolom yang ingin diambil (default: semua kolom)
 * @param int $limit Jumlah data yang ingin diambil (default: 5)
 * @param string $orderBy Kolom untuk sorting data (default: 'created_at')
 * @param string $orderType Tipe sorting ('ASC' atau 'DESC', default: 'DESC')
 * @return array Array data dari tabel
 */
function getDataHighlightKonten($table, $columns = ['*'], $limit = 5, $orderBy = 'tgl_input', $orderType = 'DESC') {
    global $conn;

    // Pastikan input aman untuk mencegah SQL Injection
    $allowedTables = ['web_cerita', 'web_produk', 'web_artikel']; // Daftar tabel yang diizinkan
    if (!in_array($table, $allowedTables)) {
        die("Akses ke tabel tidak diperbolehkan.");
    }

    // Pastikan kolom yang diminta dalam format yang valid
    $columnsString = implode(", ", array_map(fn($col) => "`" . $conn->real_escape_string($col) . "`", $columns));

    // Pastikan orderBy adalah kolom yang valid
    $orderBy = $conn->real_escape_string($orderBy);
    $orderType = strtoupper($orderType) === 'ASC' ? 'ASC' : 'DESC'; // Hanya izinkan ASC atau DESC

    // Query SQL dengan Prepared Statement
    $sql = "SELECT $columnsString FROM `$table` ORDER BY `$orderBy` $orderType LIMIT ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare statement gagal: " . $conn->error);
    }
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Ambil hasil dalam bentuk array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}