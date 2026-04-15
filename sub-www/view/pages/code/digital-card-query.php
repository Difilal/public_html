<?php
$key = isset($_GET['key']) ? $_GET['key'] : '';
$baseUrl = siteURL();

$isLocal = ($baseUrl === "http://pmpland.abc/");
$isDev   = ($_SESSION["sess"]["env"]["dev"] ?? 0) == 1;

if ($isLocal) {
    $appBaseUrl = "http://app.pmpland.abc/";
} else {
    $appBaseUrl = $isDev
        ? "https://appdev.pmpland.co.id/"
        : "https://app.pmpland.co.id/";
}

if(empty($key)){
    echo "Invalid Key";
    exit;
}

/* CHANGE CONNECTION */
$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["app"];

$escapedKey = escStringDB($key);
$qry = "SELECT iduser, nama, jabatan, email1, nohp1, url_idcard, iduser_random FROM data_karyawan WHERE iduser_random = '".$escapedKey."' LIMIT 1";

$data_karyawan = getData($qry);

if(empty($data_karyawan)){
    $_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];
    header("Location: /");
    exit;
}

$iduser = $data_karyawan["iduser"];
$nama_asli = strtoupper($data_karyawan['nama']);
$nama = singkatNama($nama_asli);

$file_foto_karyawan = $baseUrl."img/profile_default.png";

$qry_foto = "SELECT nama_folder, nama_file FROM data_berkas WHERE modul_id = '$iduser' AND jenis_berkas = 'Personal' AND modul_berkas = 'Karyawan Mandatori' AND nama_berkas = 'Foto Profile Full';";
$foto_karyawan = getData($qry_foto);

if(!empty($foto_karyawan)){
    $file_foto_karyawan = $appBaseUrl.$foto_karyawan["nama_folder"].$foto_karyawan["nama_file"];
}

$foto = $file_foto_karyawan;

$jabatan = $data_karyawan['jabatan'];
$email = $data_karyawan['email1'];
$website = "pmpland.co.id";
$alamat = "Jl. Saleh No. 78A, Kesenden Jl. Saleh No. 78A, Kesenden, Kejaksan, Cirebon 45121";
$url_idcard = $data_karyawan["url_idcard"];
$waPhone = $phone = $data_karyawan["nohp1"];

$groupJabatan = getGroupJabatanKaryawan($jabatan);

$url_download = "download-staff/";
if(!empty($groupJabatan) && $groupJabatan["group"] != "Staff"){
    $url_download = "download/";
}

$urlGMaps = "https://maps.app.goo.gl/s6AMriSojBHAXTRZA";

$_SESSION["sess"]["koneksi"] = $_SESSION["sess"]["condb"]["default"];
/* END CHANGE CONNECTION */

function singkatNama($nama){
    $parts = preg_split('/\s+/', trim($nama));
    $fullName = implode(' ', $parts);

    if (strlen($fullName) <= 16) {
        return $fullName;
    }

    if (count($parts) === 1) {
        return $parts[0];
    }

    if (count($parts) === 2) {
        return $parts[0] . ' ' . strtoupper($parts[1][0]);
    }

    // 3+ kata: keep part 1 & 2, singkat part 3 dst
    $firstTwo = $parts[0] . ' ' . $parts[1];

    // Jika part 1 + 2 > 16 huruf, singkat part 2 juga
    if (strlen($firstTwo) > 16) {
        $result = $parts[0] . ' ' . strtoupper($parts[1][0]);
    } else {
        $result = $firstTwo;
    }

    for ($i = 2; $i < count($parts); $i++) {
        $result .= ' ' . strtoupper($parts[$i][0]);
    }

    return $result;
}

function genThumbnailGDrive($url){
    if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
        $fileId = $matches[1];
        return "https://drive.google.com/thumbnail?id={$fileId}&sz=w1000";
    }

    return null;
}

function getGroupJabatanKaryawan($jabatan = null){
        $setting = SettingApp(["keyword" => "dataGroupJabatan"]);
        $data = isJSON($setting) ? json_decode($setting, true) : [];

        if(!empty($jabatan)){
            foreach($data as $group){
                foreach($group["jabatan"] as $jab){
                    if($jab == $jabatan){
                        return $group;
                    }
                }
            }
        }

        return $data;
    }
?>