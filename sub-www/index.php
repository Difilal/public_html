<?php
error_reporting(0);
include("view/inc/config.php");
include("view/inc/constant.php");

$standalonepages = ['digital-card', 'digital-card-download', 'digital-card-download-b'];
$mod = isset($_GET['pages']) ? $_GET['pages'] : 'home';

if (in_array($mod, $standalonepages)) {
    $standalonePath = dirname(__FILE__) . '/view/pages/' . $mod . '.php';
    if (file_exists($standalonePath)) {
        $_SESSION['modpage'] = $mod;
        include $standalonePath;
    } else {
        echo "Page not available. File: " . $standalonePath;
    }
    exit;
}

if (isset($_GET['pages'])) {
    if($_GET['pages'] === 'artikel' && isset($_GET['id'])){
        $idartikel = intval($_GET['id']);
        $judul_konten = isset($_GET['judul_artikel']) ? $_GET['judul_artikel'] : '';

        $query = "SELECT wa.idartikel, wa.utc_offset, wa.judul_artikel, wa.konten, wa.created_by, wa.tgl_publish, wa.meta_keyword, wa.meta_description, wa.header_konten, wa.idkategori, wk.warna, wk.kategori, COUNT(wv.idwebvisitor) as total_visitor FROM web_artikel AS wa LEFT JOIN web_kategori AS wk ON wa.idkategori = wk.idkategori LEFT JOIN web_artikel_visitor AS wv ON wa.idartikel = wv.idartikel WHERE wa.idartikel = $idartikel AND wa.status_artikel = 1 LIMIT 1";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        $data["slug"] = sanitizeString($data["judul_artikel"], $data["idartikel"]);
    }

    if($_GET['pages'] === 'karir' && isset($_GET['id'])){
        $idartikel = intval($_GET['id']);
        $judul_konten = isset($_GET['judul_artikel']) ? $_GET['judul_artikel'] : '';

        $query = "SELECT wa.idartikel, wa.utc_offset, wa.judul_artikel, wa.konten, wa.created_by, wa.tgl_publish, wa.meta_keyword, wa.meta_description, wa.header_konten, wa.idkategori, wk.warna, wk.kategori FROM web_karir AS wa LEFT JOIN web_kategori_karir AS wk ON wa.idkategori = wk.idkategori WHERE wa.idartikel = $idartikel AND wa.status_artikel = 1 LIMIT 1";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        $data["slug"] = sanitizeString($data["judul_artikel"], $data["idartikel"]);
    }
}


include "header.php";
include "navigation.php";

if (!file_exists(MODULE_PATH . $mod . '.php')) {
    echo "Page not available.";
} else {
	$_SESSION['modpage'] = $mod;
    include MODULE_PATH . $mod . '.php';
}

include "footer.php";
?>