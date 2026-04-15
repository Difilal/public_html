<?php
$key = isset($_GET['key']) ? $_GET['key'] : '';
$baseUrl = siteURL();

$nama = "EKO A. ANDRIANA";
$jabatan = "HEAD OF CEO OFFICE";
$phone = "0811 2343 880";
$email = "eko@pmpland.co.id";
$website = "www.pmpland.co.id";
$alamat_line1 = "Jl. Saleh No. 78A, Kesenden";
$alamat_line2 = "Kejaksan, Cirebon 45121";
$alamat_line3 = "West Java - Indonesia";
$cardName = "Eko A. Andriana";

$key = escStringDB($key);

/* CHANGE CONNECTION */
$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["app"];
$qry = "SELECT * FROM data_karyawan WHERE iduser_random = '".$key."'";

$data_karyawan = getData($qry);

if(empty($data_karyawan)){
    echo "Key not found";
    exit;
}

$nama = strtoupper($data_karyawan['nama_id_card'] ?? $data_karyawan['nama']);
$nama = singkatNama($nama);
$jabatan = strtoupper($data_karyawan['jabatan']);
$email = $data_karyawan['email1'];
$website = "www.pmpland.co.id";
$phone = formatPhoneCard($data_karyawan["nohp1"]);
$cardName = $data_karyawan['nama'];

$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];
/* END CHANGE CONNECTION */

$filename = 'business-card-' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $cardName));
$logoUrl = $baseUrl . 'sub-www/images/logo/PMPLand-GROUPLOGO-WHITE-FINAL.png';
$logoWhite = $logoUrl;
$logoBlack = $baseUrl . 'sub-www/images/logo/PMPLand-GROUP LOGO-BLACK-02.png';

// Format phone for display
function formatPhoneCard($phone) {
    $phone = preg_replace('/\D/', '', $phone);
    if (substr($phone, 0, 2) === '62') {
        $phone = '0' . substr($phone, 2);
    }
    if (strlen($phone) >= 11) {
        return substr($phone, 0, 4) . ' ' . substr($phone, 4, 4) . ' ' . substr($phone, 8);
    }
    return $phone;
}
$phoneDisplay = formatPhoneCard($phone);

function singkatNama($nama){
    $parts = preg_split('/\s+/', trim($nama));
    $fullName = implode(' ', $parts);

    if (strlen($fullName) <= 24) {
        return $fullName;
    }

    if (count($parts) === 1) {
        return $parts[0];
    }

    if (count($parts) === 2) {
        return $parts[0] . ' ' . strtoupper($parts[1][0]);
    }

    if (count($parts) === 3) {
        return $parts[0] . ' ' . strtoupper($parts[1][0]) . strtoupper($parts[2][0]);
    }

    $firstTwo = $parts[0] . ' ' . $parts[1]. " " . $parts[2];

    if (strlen($firstTwo) > 24) {
        $result = $parts[0] . ' ' . strtoupper($parts[1][0]) ." ". strtoupper($parts[2][0]);
    } else {
        $result = $firstTwo;
    }

    for ($i = 3; $i < count($parts); $i++) {
        $result .= ' ' . strtoupper($parts[$i][0]);
    }

    return $result;
}
?>