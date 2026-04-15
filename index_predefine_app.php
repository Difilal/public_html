<?php 

$_SESSION["sess"]["orderByFieldStatusPenjualan_RandomData"] = "FIELD(status_penjualan,'Akad','SP3K','Proses Bank','Pemberkasan','Booking Kavling','Approval Booking','Pending Pemberkasan','Pending Proses Bank','Mundur','Mundur Turun Plafon','Reject Approval Booking','Reject Booking','Reject Pemberkasan','Reject Bank')";
$_SESSION["sess"]["orderByFieldStatusPenjualan_NormalSequence"] = "FIELD(status_penjualan,'Approval Booking','Booking Kavling','Pemberkasan','Pending Pemberkasan','Proses Bank','Pending Proses Bank','SP3K','Akad','Mundur','Mundur Turun Plafon','Reject Approval Booking','Reject Booking','Reject Pemberkasan','Reject Bank')";
$listStatusPenjualan	= array("Antrian Booking","Approval Booking","Booking Kavling","Pemberkasan","Pending Pemberkasan","Proses Bank","Pending Proses Bank","SP3K","Akad");
$listSubstatusPenjualan	= array("Biaya NUP","Antrian Booking","BI Checking","Booking Fee",
								"Booking Kavling","Input SPR","Cetak SPR",
								"Berkas Belum Lengkap","Berkas Lengkap",
								"Berkas Siap Kirim Ke Bank","Berkas Diproses Bank","Berkas Balik Dari Bank","SP3K","Banding","Reject Bank",
								"Approve > SP3K","Jadwal Akad",
								"Akad","BAST","BAST > Komplen","BAST > Progres Perbaikan","BAST > Perbaikan Selesai");

$DivisiJabatan=SettingApp(array("keyword"=>"dataDivisiJabatan"));
$DivisiJabatan=isJson($DivisiJabatan)?json_decode($DivisiJabatan,true):array("jabatan"=>[]);
$_SESSION["sess"]["listJabatan"]=[];
foreach($DivisiJabatan AS $rowdivjab)
{
	if(count($_SESSION["sess"]["listJabatan"])>0) array_push($_SESSION["sess"]["listJabatan"],"-----");
	foreach($rowdivjab["jabatan"]??[] AS $jabatan) array_push($_SESSION["sess"]["listJabatan"],$jabatan);
}


$_SESSION["sess"]["paymentChannel"]=
[
	["vendor"=>"doku", "kode_channel"=>"35", "nama_channel"=>"Alfamart"],
	["vendor"=>"doku", "kode_channel"=>"36", "nama_channel"=>"ATM Bersama"],
	["vendor"=>"doku", "kode_channel"=>"34", "nama_channel"=>"BRI Virtual Account"],
	["vendor"=>"doku", "kode_channel"=>"38", "nama_channel"=>"BNI Virtual Account"],
	["vendor"=>"doku", "kode_channel"=>"41", "nama_channel"=>"Mandiri Virtual Account"],
	["vendor"=>"doku", "kode_channel"=>"32", "nama_channel"=>"CIMB Virtual Account"],
	["vendor"=>"doku", "kode_channel"=>"33", "nama_channel"=>"Danamon Virtual Account"],
	["vendor"=>"owner","kode_channel"=>"XX", "nama_channel"=>"Transfer Bank"],
];


$_SESSION["sess"]["DataUnit"]["SLF_ListObjekFoto"]=
[
	"Akses Jalan",
	"Struktur Pondasi",
	"Lantai dan Dinding",
	"{{---}}",
	"Atap",
	"Rangka Atap",
	"Plafon Rumah",
	"{{---}}",
	"Pintu dan Jendela",
	"Plat Nomor Bersubsidi",
	"Tampak Depan",
	"Tampak Belakang",
	"Tampak Dalam Rumah",
	"{{---}}",
	"Kamar Tidur",
	"Kamar Mandi",
	"{{---}}",
	"Jaringan Listrik",
	"Instalasi Listrik",
	"Jaringan Air Bersih",
	"Sarana Pewadahan Sampah",
	"Drainase",
	"Pipa Pembuangan Air Kotor",
	"Septic Tank (Pipa Ventilasi)"
];



if(!isset($_SESSION["settingDefaultSLA"]))
{
	$_SESSION["settingDefaultSLA"]=1;

	// Satuan Hari
	if(SettingApp(array("keyword"=>"sla_database_konsumen"))<1)
	{
		$sla_database_konsumen="14";
		SettingApp(array("keyword"=>"sla_database_konsumen","content"=>$sla_database_konsumen));
	}

	// Satuan Konsumen
	if(SettingApp(array("keyword"=>"jmlh_max_waiting_list"))<1)
	{
		$jmlh_max_waiting_list="3";
		SettingApp(array("keyword"=>"jmlh_max_waiting_list","content"=>$jmlh_max_waiting_list));
	}

	// Satuan Menit
	if(SettingApp(array("keyword"=>"sla_waiting_list"))<1)
	{
		$sla_waiting_list="60";
		SettingApp(array("keyword"=>"sla_waiting_list","content"=>$sla_waiting_list));
	}

	// Satuan Jam
	if(SettingApp(array("keyword"=>"sla_bayar_booking_fee"))<1)
	{
		$sla_bayar_booking_fee="24";
		SettingApp(array("keyword"=>"sla_bayar_booking_fee","content"=>$sla_bayar_booking_fee));
	}

	// Satuan Hari
	if(SettingApp(array("keyword"=>"sla_pemberkasan"))<1)
	{
		$sla_pemberkasan="14";
		SettingApp(array("keyword"=>"sla_pemberkasan","content"=>$sla_pemberkasan));
	}
	if(SettingApp(array("keyword"=>"extend_sla_pemberkasan"))<1)
	{
		$extend_sla_pemberkasan="7";
		SettingApp(array("keyword"=>"extend_sla_pemberkasan","content"=>$extend_sla_pemberkasan));
	}
}



$_SESSION["sess"]["menu_navigation"]["app"]=
[
    [	'label' 	=> 'Data Sharing', 
		'icon'  	=> '<i class="fas fa-share-alt"></i>', 
		'submenu' 	=> [
              				['label' => 'Media Gallery', 						'icon'  => '<i class="fas fa-images i-fs-smaller"></i>',				'url'   => 'dashboard-operator-media-gallery.html'],
							['label' => 'File Sharing', 						'icon'  => '<i class="fas fa-folder i-fs-smaller"></i>',				'url'   => 'dashboard-operator-file-sharing.html'],
							['label' => 'Kontak Karyawan', 						'icon'  => '<i class="fas fa-address-card i-fs-smaller"></i>',			'url'   => 'dashboard-operator-karyawan-kontak.html'],
    					]
	],[	'label' 	=> 'Approval', 
		'icon'  	=> '<i class="fas fa-check-double"></i>', 
		'submenu' 	=> [
              				['label' => 'Approval', 							'icon'  => '<i class="fas fa-file-signature i-fs-smaller"></i>',		'url'   => 'dashboard-operator-approval-data.html'],
    					]
	],[	'label' 	=> 'Penjualan', 
		'icon'  	=> '<i class="fas fa-tag"></i>',/* <i class=""></i> */
		'submenu' 	=> [
							['label' => 'Data Penjualan', 						'icon'  => '<i class="fas fa-file-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-penjualan-data.html'],
							['label' => 'Target Penjualan', 					'icon'  => '<i class="fas fa-bullseye i-fs-smaller"></i>',				'url'   => 'dashboard-operator-penjualan-target-data.html'],
							['label' => 'Booking Kavling', 						'icon'  => '<i class="fas fa-map-marked-alt i-fs-smaller"></i>',		'url'   => 'dashboard-operator-booking-kavling.html'],
							['label' => 'BI Checking', 							'icon'  => '<i class="fas fa-check-double i-fs-smaller"></i>',			'url'   => 'dashboard-operator-bi-checking-data.html'],
							['label' => 'Scoring', 								'icon'  => '<i class="fas fa-tasks i-fs-smaller"></i>',					'url'   => 'dashboard-operator-scoring-data.html'],/* 
							['label' => 'Approval Booking',						'icon'  => '<i class="fas fa-check-circle i-fs-smaller"></i>',			'url'   => 'dashboard-operator-approval-booking.html'], */
							['label' => 'Data Konsumen', 						'icon'  => '<i class="fas fa-user i-fs-smaller"></i>', 					'url'   => 'dashboard-operator-konsumen-data.html'],
							['label' => 'Penerimaan Biaya', 					'icon'  => '<i class="fas fa-user i-fs-smaller"></i>', 					'url'   => 'dashboard-operator-biaya-penerimaan-finance.html'],
    					]
	],[	'label' 	=> 'Keuangan', 
		'icon'  	=> '<i class="fas fa-donate"></i>',
		'submenu' 	=> [
							['label' => 'Penerimaan Booking Fee', 				'icon'  => '<i class="fas fa-list i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-penerimaan-finance.html'],
							['label' => 'Pengajuan Biaya', 						'icon'  => '<i class="fas fa-list i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-finance-pengajuan.html'],
							['label' => 'Persetujuan Biaya', 					'icon'  => '<i class="fas fa-tasks i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-finance-persetujuan.html'],
							['label' => 'Pengajuan Biaya Disetujui', 			'icon'  => '<i class="fas fa-clipboard-check i-fs-smaller"></i>',		'url'   => 'dashboard-operator-biaya-finance-disetujui.html'],
							
							['label' => 'Pengajuan Biaya Eksternal', 			'icon'  => '<i class="fas fa-list i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-finance-eksternal-pengajuan.html'],
							['label' => 'Persetujuan Biaya Eksternal', 			'icon'  => '<i class="fas fa-tasks i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-finance-eksternal-persetujuan.html'],
							['label' => 'Pengajuan Biaya Eksternal Disetujui', 	'icon'  => '<i class="fas fa-clipboard-check i-fs-smaller"></i>',		'url'   => 'dashboard-operator-biaya-finance-eksternal-disetujui.html'],
						]
	],
	[	'label' 	=> 'Laporan Keuangan', 
		'icon'  	=> '<i class="fas fa-file-invoice-dollar"></i>',
		'submenu' 	=> [
              				['label' => 'Buku Besar', 							'icon'  => '<i class="fas fa-book i-fs-smaller"></i>', 					'url'   => 'dashboard-operator-setup-keuangan-jurnal-bukubesar.html'],
              				['label' => 'Neraca Keuangan',						'icon'  => '<i class="fas fa-book i-fs-smaller"></i>', 					'url'   => 'dashboard-operator-setup-keuangan-jurnal-neraca.html'],
						]
	],[	'label' 	=> 'Produksi', 
		'icon'  	=> '<i class="fas fa-truck-monster"></i>',
		'submenu' 	=> [
              				['label' => 'Generate Project', 					'icon'  => '<i class="fas fa-city i-fs-smaller"></i>', 					'url'   => 'dashboard-operator-setup-projek-data.html'],
							['label' => 'Kelompok Wilayah', 					'icon'  => '<i class="fas fa-braille i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-kelompok-wilayah.html'],
							['label' => 'Master Unit SPK', 						'icon'  => '<i class="fas fa-sticky-note i-fs-smaller"></i>',			'url'   => 'dashboard-operator-perumahan-unit-spk.html'],
							['label' => 'Pengecekan Unit SPK', 					'icon'  => '<i class="fas fa-file i-fs-smaller"></i>',					'url'   => 'dashboard-operator-perumahan-unit-spk-checker.html'],
							['label' => 'Persetujuan Unit SPK', 				'icon'  => '<i class="fas fa-file-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spk-approval.html'],
							['label' => 'Unit SPK Disetujui', 					'icon'  => '<i class="fas fa-archive i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spk-approved.html'],
							['label' => 'Unit SPK Ditolak', 					'icon'  => '<i class="fas fa-folder i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spk-decline.html'],

							['label' => 'Pengecekan Unit SPMB', 				'icon'  => '<i class="fas fa-file i-fs-smaller"></i>',					'url'   => 'dashboard-operator-perumahan-unit-spmb-checker.html'],
							// ['label' => 'Persetujuan Unit SSPMBPK', 			'icon'  => '<i class="fas fa-file-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spmb-approval.html'],
							['label' => 'Unit SPMB Disetujui', 					'icon'  => '<i class="fas fa-archive i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spmb-approved.html'],
							['label' => 'Unit SPMB Ditolak', 					'icon'  => '<i class="fas fa-folder i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perumahan-unit-spmb-decline.html'],

							['label' => 'List Pekerjaan Bangunan', 				'icon'  => '<i class="fas fa-outdent i-fs-smaller"></i>',				'url'   => 'dashboard-operator-progres-bangunan-list-pekerjaan-bangunan.html'],
							['label' => 'Progres Bangunan', 					'icon'  => '<i class="fas fa-list-ol i-fs-smaller"></i>',				'url'   => 'dashboard-operator-progres-bangunan-update.html'],
							['label' => 'Data Biaya Subkon', 					'icon'  => '<i class="fas fa-copy i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-subkon.html'],
							['label' => 'Draft Pengajuan Biaya Subkon', 		'icon'  => '<i class="fas fa-file i-fs-smaller"></i>',					'url'   => 'dashboard-operator-biaya-subkon-pengajuan-draft.html'],
							['label' => 'Approval Pengajuan Biaya Subkon', 		'icon'  => '<i class="fas fa-file-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-biaya-subkon-pengajuan-approval.html'],
							['label' => 'Pengajuan Biaya Subkon Disetujui', 	'icon'  => '<i class="fas fa-archive i-fs-smaller"></i>',				'url'   => 'dashboard-operator-biaya-subkon-pengajuan-disetujui.html'],
							['label' => 'Retensi Subkon', 						'icon'  => '<i class="fas fa-copy i-fs-smaller"></i>',					'url'   => 'dashboard-operator-retensi-subkon.html'],
							['label' => 'Pengajuan Retensi Subkon', 			'icon'  => '<i class="fas fa-file i-fs-smaller"></i>',					'url'   => 'dashboard-operator-retensi-subkon-pengajuan.html'],
							['label' => 'Persetujuan Retensi Subkon', 			'icon'  => '<i class="fas fa-file-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-retensi-subkon-persetujuan.html'],
							['label' => 'Retensi Subkon Disetujui', 			'icon'  => '<i class="fas fa-archive i-fs-smaller"></i>',				'url'   => 'dashboard-operator-retensi-subkon-disetujui.html'],
						]
	],[	'label' 	=> 'Laporan Produksi', 
		'icon'  	=> '<i class="fas fa-file-contract"></i>',
		'submenu' 	=> [
							['label' => 'Progres Bangunan', 					'icon'  => '<i class="fas fa-industry i-fs-smaller"></i>',				'url'   => 'dashboard-operator-progres-bangunan-report.html'],
							['label' => 'Progres Bangunan SP', 					'icon'  => '<i class="fas fa-pen-square i-fs-smaller"></i>',			'url'   => 'dashboard-operator-progres-bangunan-sp-report.html'],
    					]
	],[	'label' 	=> 'Master Data', 
		'icon'  	=> '<i class="fas fa-cog"></i>',
		'submenu' 	=> 	[
              				['label' => 'Data Perusahaan', 						'icon'  => '<i class="fas fa-building i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perusahaan-data.html'],
              				['label' => 'Data Cabang', 							'icon'  => '<i class="fas fa-sitemap i-fs-smaller"></i>',				'url'   => 'dashboard-operator-perusahaan-cabang-data.html'],
              				['label' => 'Data Perumahan', 						'icon'  => '<i class="fa-solid fa-house i-fs-smaller"></i>',			'url'   => 'dashboard-operator-perumahan-data.html'],
              				['label' => 'Data Unit', 							'icon'  => '<i class="fa-solid fa-border-all i-fs-smaller"></i>',		'url'   => 'dashboard-operator-perumahan-unit-data.html'],
              				['label' => 'Data Bank', 							'icon'  => '<i class="fa-brands fa-gg-circle i-fs-smaller"></i>',		'url'   => 'dashboard-operator-bank-data.html'],
              				['label' => 'Template SPR', 						'icon'  => '<i class="fa-solid fa-receipt i-fs-smaller"></i>',			'url'   => 'dashboard-operator-template-spr-data.html'],
							  ['label' => 'Setting Penjualan', 					'icon'  => '<i class="fas fas fa-pencil-square i-fs-smaller"></i>',		'url'   => 'dashboard-operator-setting-penerimaan-penjualan.html'],
    					]
	],[	'label' 	=> 'Informasi', 
		'icon'  	=> '<i class="fas fa-bullhorn"></i>', 
		'submenu' 	=> [
							['label' => 'Broadcast Pesan', 						'icon'  => '<i class="fas fa-paper-plane i-fs-smaller"></i>',			'url'   => 'dashboard-operator-broadcast-general-data.html'],
							['label' => 'History Activity', 					'icon'  => '<i class="fas fa-history i-fs-smaller"></i>',				'url'   => 'dashboard-operator-history-activity.html'],
						]
	],[	'label' 	=> 'Agent', 
	'icon'  	=> '<i class="fas fa-user-secret"></i>',/* <i class=""></i> */
	'submenu' 	=> [
						['label' => 'Data Agent', 								'icon'  => '<i class="fas fa-user-friends i-fs-smaller"></i>',				'url'   => 'dashboard-operator-agent-data.html'],
						['label' => 'Absensi Agent', 							'icon'  => '<i class="fas fa-calendar-alt i-fs-smaller"></i>',				'url'   => 'dashboard-operator-agent-absensi-data.html'],
					]
	],[	'label' 	=> 'HRD', 
		'icon'  	=> '<i class="fas fa-user-circle"></i>',
		'submenu' 	=> [
							['label' => 'Absensi Online', 						'icon'  => '<i class="fas fa-camera i-fs-smaller"></i>',				'url'   => 'dashboard-operator-absensi-online-data.html'],
							['label' => 'Jadwal Absensi', 						'icon'  => '<i class="fas fa-calendar-days i-fs-smaller"></i>',			'url'   => 'dashboard-operator-absensi-jadwal-data.html'],
							['label' => 'Rekap Bulanan',						'icon'  => '<i class="fas fa-clipboard-list i-fs-smaller"></i>',		'url'   => 'dashboard-operator-absensi-rekap-bulanan.html'],
							['label' => 'Izin Tidak Hadir',						'icon'  => '<i class="fas fa-user-clock i-fs-smaller"></i>',			'url'   => 'dashboard-operator-absensi-tidak-hadir-data.html'],
							['label' => 'Absensi Karyawan',						'icon'  => '<i class="fas fa-user-clock i-fs-smaller"></i>',			'url'   => 'dashboard-operator-absensi-karyawan.html'],
							['label' => 'Data Karyawan', 						'icon'  => '<i class="fas fa-user-tie i-fs-smaller"></i>',				'url'   => 'dashboard-operator-karyawan-data.html'],
						]
	],[	'label' 	=> 'Web Content', 
		'icon'  	=> '<i class="fas fa-globe-asia"></i>', 
		'submenu' 	=> [
							['label' => 'Berita', 								'icon'  => '<i class="fas fa-newspaper"></i>',							'url'   => 'dashboard-operator-web-content-berita-data.html'],
							['label' => 'Artikel', 								'icon'  => '<i class="fas fa-book-reader"></i>',						'url'   => 'dashboard-operator-web-content-artikel-data.html'],
						]
	]
];



$_SESSION["sess"]["listTextVarSPR"] = 
[  	
	["textlabel"=>"Nama Induk Perusahaan",         "textvar"=>"{{NamaIndukPerusahaan}}",           "textsample"=>"PT. Ciayu Majakuning Sejahtera"],
	["textlabel"=>"Nama Perusahaan",               "textvar"=>"{{NamaPerusahaan}}",                "textsample"=>"PT. Cirebon Kota Sejahtera"],
	["textlabel"=>"Logo Perusahaan",               "textvar"=>"{{UrlLogoPerusahaan}}",             "textsample"=>"https://appdev.pmpland.co.id/img-pancasila.png"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Alamat Perusahaan 1",           "textvar"=>"{{AlamatPerusahaan1}}",             "textsample"=>"Alamat Baris 1"],
	["textlabel"=>"Alamat Perusahaan 2",           "textvar"=>"{{AlamatPerusahaan2}}",             "textsample"=>"Alamat Baris 2"],
	["textlabel"=>"Alamat Perusahaan 3",           "textvar"=>"{{AlamatPerusahaan3}}",             "textsample"=>"Alamat Baris 3"],
	["textlabel"=>"Alamat Perusahaan 4",           "textvar"=>"{{AlamatPerusahaan4}}",             "textsample"=>"Alamat Baris 1, Alamat Baris 2."],
	["textlabel"=>"Alamat Perusahaan 5",           "textvar"=>"{{AlamatPerusahaan5}}",             "textsample"=>"Alamat Baris 1, Alamat Baris 2, Alamat Baris 3"],
	["textlabel"=>"Alamat Perusahaan 6",           "textvar"=>"{{AlamatPerusahaan6}}",             "textsample"=>"Alamat Baris 1".PHP_EOL."Alamat Baris 2"],
	["textlabel"=>"Alamat Perusahaan 7",           "textvar"=>"{{AlamatPerusahaan7}}",             "textsample"=>"Alamat Baris 1".PHP_EOL."Alamat Baris 2".PHP_EOL."Alamat Baris 3"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nomor SPR",                     "textvar"=>"{{NomorSpr}}",                      "textsample"=>"109/SPR/VI/2022"],
	["textlabel"=>"Hari Input SPR",                "textvar"=>"{{HariInputSpr}}",                  "textsample"=>"Senin"],
	["textlabel"=>"Tanggal Numerik Input SPR",     "textvar"=>"{{TglNumerikInputSpr}}",            "textsample"=>"15"],
	["textlabel"=>"Tanggal Terbilang Input SPR",   "textvar"=>"{{TglTerbilangInputSpr}}",          "textsample"=>"Lima Belas"],
	["textlabel"=>"Bulan Numerik Input SPR",       "textvar"=>"{{BulanNumerikInputSpr}}",          "textsample"=>"10"],
	["textlabel"=>"Bulan Terbilang Input SPR",     "textvar"=>"{{BulanTerbilangInputSpr}}",        "textsample"=>"Oktober"],
	["textlabel"=>"Tahun Numerik Input SPR",       "textvar"=>"{{ThnNumerikInputSpr}}",            "textsample"=>"2022"],
	["textlabel"=>"Tahun Terbilang Input SPR",     "textvar"=>"{{ThnTerbilangInputSpr}}",          "textsample"=>"Dua Ribu Dua Puluh Dua"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Tanggal Input SPR Format 1",    "textvar"=>"{{TglInputSpr1}}",                  "textsample"=>"15/10/2022"],
	["textlabel"=>"Tanggal Input SPR Format 2",    "textvar"=>"{{TglInputSpr2}}",                  "textsample"=>"15-10-2022"],
	["textlabel"=>"Tanggal Input SPR Format 3",    "textvar"=>"{{TglInputSpr3}}",                  "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tanggal Input SPR Format 4",    "textvar"=>"{{TglInputSpr4}}",                  "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Tanggal Cetak SPR Format 1",    "textvar"=>"{{TglCetakSpr1}}",                  "textsample"=>"15/10/2022"],
	["textlabel"=>"Tanggal Cetak SPR Format 2",    "textvar"=>"{{TglCetakSpr2}}",                  "textsample"=>"15-10-2022"],
	["textlabel"=>"Tanggal Cetak SPR Format 3",    "textvar"=>"{{TglCetakSpr3}}",                  "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tanggal Cetak SPR Format 4",    "textvar"=>"{{TglCetakSpr4}}",                  "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Tanggal Hari Ini Format 1",     "textvar"=>"{{TglHariIni1}}",                   "textsample"=>"15/10/2022"],
	["textlabel"=>"Tanggal Hari Ini Format 2",     "textvar"=>"{{TglHariIni2}}",                   "textsample"=>"15-10-2022"],
	["textlabel"=>"Tanggal Hari Ini Format 3",     "textvar"=>"{{TglHariIni3}}",                   "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tanggal Hari Ini Format 4",     "textvar"=>"{{TglHariIni4}}",                   "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Perusahaan",               "textvar"=>"{{NamaPerusahaan}}",                "textsample"=>"PT. Cirebon Kota Sejahtera"],
	["textlabel"=>"Alamat Perusahaan",             "textvar"=>"{{AlamatPerusahaan}}",              "textsample"=>"Jl. Makmur Abadi No.88, Cirebon 45120"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Pihak Pertama",            "textvar"=>"{{NamaPihakPertama}}",              "textsample"=>"Kotaro Minami"],
	["textlabel"=>"Jabatan Pihak Pertama",         "textvar"=>"{{JabatanPihakPertama}}",           "textsample"=>"Marketing Manager"],
	["textlabel"=>"Nomor ID Pihak Pertama",        "textvar"=>"{{NomorIDPihakPertama}}",           "textsample"=>"3274010101800001"],
	["textlabel"=>"Alamat Pihak Pertama",          "textvar"=>"{{AlamatPihakPertama}}",            "textsample"=>"Jl. Jalan Sore Blok A4 No.10, Cirebon 45123"],
	["textlabel"=>"NoHP Pihak Pertama",            "textvar"=>"{{NoHpPihakPertama}}",              "textsample"=>"081122334455"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Pihak Kedua",              "textvar"=>"{{NamaPihakKedua}}",                "textsample"=>"Nobita Akatsuki"],
	["textlabel"=>"Tempat Lahir Pihak Kedua",      "textvar"=>"{{TempatLahirPihakKedua}}",         "textsample"=>"Cirebon"],
	["textlabel"=>"Tgl Lahir Pihak Kedua Format 1","textvar"=>"{{TglLahirPihakKedua1}}",           "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl Lahir Pihak Kedua Format 2","textvar"=>"{{TglLahirPihakKedua2}}",           "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl Lahir Pihak Kedua Format 3","textvar"=>"{{TglLahirPihakKedua3}}",           "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl Lahir Pihak Kedua Format 4","textvar"=>"{{TglLahirPihakKedua4}}",           "textsample"=>"15 Oktober 2022"],
	["textlabel"=>"TTL Lahir Pihak Kedua",			"textvar"=>"{{TtlLahirPihakKedua}}",           	"textsample"=>"Cirebon, 15 Oktober 2022"],
	["textlabel"=>"Nomor ID Pihak Kedua",          "textvar"=>"{{NomorIDPihakKedua}}",             "textsample"=>"3173280711880005"],
	["textlabel"=>"AlamatPihak Kedua",             "textvar"=>"{{AlamatPihakKedua}}",              "textsample"=>"Jl. Kenangan Mantan No.23, Cirebon 45151"],
	["textlabel"=>"NoHP Pihak Kedua",              "textvar"=>"{{NohpPihakKedua}}",                "textsample"=>"081122334455"],
	["textlabel"=>"NoTelp Kantor Pihak Kedua",     "textvar"=>"{{NotelpKantorPihakKedua}}",        "textsample"=>"0231-234567"],
	["textlabel"=>"Jabatan Pihak Kedua",           "textvar"=>"{{JabatanPihakKedua}}",             "textsample"=>"Subkontraktor"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Marketing",                "textvar"=>"{{NamaMarketing}}",                 "textsample"=>"Suneo Halilintar"],
	["textlabel"=>"NoHP Marketing",                "textvar"=>"{{NohpMarketing}}",                 "textsample"=>"082233445566"],
	["textlabel"=>"SPV Marketing",                	"textvar"=>"{{SpvMarketing}}",                 	"textsample"=>"Mark Zuckerberg"],
	["textlabel"=>"Divisi Marketing",              "textvar"=>"{{DivisiMarketing}}",               "textsample"=>"Marketing Inhouse"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Bank Rekening Transfer",   "textvar"=>"{{NamaBankRekeningTransfer}}",      "textsample"=>"Bank BTN"],
	["textlabel"=>"Atas Nama Rekening Transfer",   "textvar"=>"{{AtasNamaRekeningTransfer}}",      "textsample"=>"PT. Cirebon Kota Sejahtera"],
	["textlabel"=>"Nomor Rekening Transfer",       "textvar"=>"{{NomorRekeningTransfer}}",         "textsample"=>"1111-2222-3333-4444"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nama Perumahan",                "textvar"=>"{{NamaPerumahan}}",                 "textsample"=>"Griya Mertua Indah"],
	["textlabel"=>"Cluster Unit",                  "textvar"=>"{{ClusterUnit}}",                   "textsample"=>"Anggrek"],
	["textlabel"=>"Blok Unit",                     "textvar"=>"{{BlokUnit}}",                      "textsample"=>"B"],
	["textlabel"=>"Nomor Unit",                    "textvar"=>"{{NomorUnit}}",                     "textsample"=>"7"],
	["textlabel"=>"Unit Kavling",                  "textvar"=>"{{UnitKavling}}",                   "textsample"=>"Cluster Anggrek Blok B No.7"],
	["textlabel"=>"Luas Bangunan",                 "textvar"=>"{{LuasBangunan}}",                  "textsample"=>"30"],
	["textlabel"=>"Luas Tanah",                    "textvar"=>"{{LuasTanah}}",                     "textsample"=>"60"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Harga Jual Rumah",              "textvar"=>"{{HargaJualRumah}}",                "textsample"=>"150.000.000"],
	["textlabel"=>"Plafon KPR",                    "textvar"=>"{{PlafonKPR}}",                     "textsample"=>"145.000.000"],
	["textlabel"=>"Uang Muka",                     "textvar"=>"{{UangMuka}}",                      "textsample"=>"2.500.000"],
	["textlabel"=>"Booking Fee",                   "textvar"=>"{{BookingFee}}",                    "textsample"=>"1.000.000"],
	["textlabel"=>"Biaya Hook",              	   "textvar"=>"{{BiayaHook}}",                	   "textsample"=>"1.500.000"],
	["textlabel"=>"Nominal Terima Kunci",          "textvar"=>"{{NominalTerimaKunci}}",            "textsample"=>"5.000.000"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Biaya Balik Nama",              "textvar"=>"{{BiayaBalikNama}}",                "textsample"=>"2.000.000"],
	["textlabel"=>"Biaya BPHTB",                   "textvar"=>"{{BiayaBPHTB}}",                    "textsample"=>"3.500.000"],
	["textlabel"=>"Biaya Proses Bank",             "textvar"=>"{{BiayaProsesBank}}",               "textsample"=>"2.000.000"],
	
	["textlabel"=>"separator",				   	   "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel" =>"SPMB Nomor Surat",			   "textvar"=>"{{SpmbNomorSurat}}",                "textsample"=>"007/GCK-SPMB/UNIT/II/2025"],
	["textlabel" =>"SPMB Tanggal Di Buat",		   "textvar"=>"{{SpmbTanggal}}",                   "textsample"=>"01 Januari 1907"],
	["textlabel" =>"SPMB Lampiran",		   		   "textvar"=>"{{SpmbLampiran}}",                  "textsample"=>""],
	["textlabel" =>"SPMB Waktu Pembangunan",	   "textvar"=>"{{SpmbWaktuPembangunan}}",          "textsample"=>"45 Hari"],
	["textlabel" =>"SPMB Tanggal Mulai Bangun",	   "textvar"=>"{{SpmbTanggalMulai}}",              "textsample"=>"01 Janurai 1907"],
	["textlabel" =>"SPMB Tanggal Jatuh Tempo Pembangunan", "textvar"=>"{{SpmbJatuhTempo}}",        "textsample"=>"01 Janurai 1907"],
	["textlabel" =>"SPMB Nilai Kontrak", 			"textvar"=>"{{SpmbNilaiKontrak}}",        	   "textsample"=>"Rp. 60.0000.000"],
	["textlabel" =>"SPMB Target Mingguan", 			"textvar"=>"{{SpmbTargetMingguan}}",           "textsample"=>"• MINGGU 1 7.97%
																												  • MINGGU 2 17.6%
																												  • MINGGU 3 36.3%
																												  • MINGGU 4 59.24%
																												  • MINGGU 5 78.87%
																												  • MINGGU 6 94.08%
																												  • MINGGU 7 100%"],

	["textlabel"=>"separator",				   	   "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel" =>"SPK Nomor Surat",			   "textvar"=>"{{SpkNomorSurat}}",                	"textsample"=>"006/GCK-PMP/UNIT/II/2025"],
	["textlabel" =>"SPK Nama Pekerjaan",		   "textvar"=>"{{SpkNamaPekerjaan}}",               "textsample"=>"Pembangunan Unit"],
	["textlabel" =>"SPK Harga Per Unit",		   "textvar"=>"{{SpkHargaPerUnit}}",                "textsample"=>"Rp. 50.000.000"],
	["textlabel" =>"SPK Total Unit",		   	   "textvar"=>"{{SpkTotalUnit}}",               	"textsample"=>"100"],
	["textlabel" =>"SPK Total Harga",		   		"textvar"=>"{{SpkTotalHarga}}",                 "textsample"=>"Rp. 50.000.000"],
	["textlabel" =>"SPK Tanggal",		   			"textvar"=>"{{SpkTanggal}}",                 	"textsample"=>"01 Januari 1907"],
	["textlabel" =>"SPK Hari",			   			"textvar"=>"{{SpkHari}}",                 		"textsample"=>"Senin"],
	/* ,
	["textlabel"=>"Biaya Administrasi",            "textvar"=>"{{BiayaAdministrasi}}",             "textsample"=>"1.000.000"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Diskon Uang Muka",              "textvar"=>"{{DiskonUangMuka}}",                "textsample"=>"1.000.000"],
	["textlabel"=>"Diskon BBN",                    "textvar"=>"{{DiskonBBN}}",                     "textsample"=>"1.000.000"],
	["textlabel"=>"Diskon Booking Fee",            "textvar"=>"{{DiskonBookingFee}}",              "textsample"=>"500.000"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 1",              "textvar"=>"{{NominalTermin1}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 1 - Format A",   "textvar"=>"{{TglSlaTermin1A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 1 - Format B",   "textvar"=>"{{TglSlaTermin1B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 1 - Format C",   "textvar"=>"{{TglSlaTermin1C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 1 - Format D",   "textvar"=>"{{TglSlaTermin1D}}",                "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 2",              "textvar"=>"{{NominalTermin2}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 2 - Format A",   "textvar"=>"{{TglSlaTermin2A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 2 - Format B",   "textvar"=>"{{TglSlaTermin2B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 2 - Format C",   "textvar"=>"{{TglSlaTermin2C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 2 - Format D",   "textvar"=>"{{TglSlaTermin2D}}",                "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 3",              "textvar"=>"{{NominalTermin3}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 3 - Format A",   "textvar"=>"{{TglSlaTermin3A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 3 - Format B",   "textvar"=>"{{TglSlaTermin3B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 3 - Format C",   "textvar"=>"{{TglSlaTermin3C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 3 - Format D",   "textvar"=>"{{TglSlaTermin3D}}",                "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 4",              "textvar"=>"{{NominalTermin4}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 4 - Format A",   "textvar"=>"{{TglSlaTermin4A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 4 - Format B",   "textvar"=>"{{TglSlaTermin4B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 4 - Format C",   "textvar"=>"{{TglSlaTermin4C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 4 - Format D",   "textvar"=>"{{TglSlaTermin4D}}",                "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 5",              "textvar"=>"{{NominalTermin5}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 5 - Format A",   "textvar"=>"{{TglSlaTermin5A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 5 - Format B",   "textvar"=>"{{TglSlaTermin5B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 5 - Format C",   "textvar"=>"{{TglSlaTermin5C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 5 - Format D",   "textvar"=>"{{TglSlaTermin5D}}",                "textsample"=>"15 Oktober 2022"],

	["textlabel"=>"separator",                     "textvar"=>"{{separator}}",                     "textsample"=>"separator"],
	["textlabel"=>"Nominal Termin 6",              "textvar"=>"{{NominalTermin6}}",                "textsample"=>"2.500.000"],
	["textlabel"=>"Tgl SLA Termin 6 - Format A",   "textvar"=>"{{TglSlaTermin6A}}",                "textsample"=>"15/10/2022"],
	["textlabel"=>"Tgl SLA Termin 6 - Format B",   "textvar"=>"{{TglSlaTermin6B}}",                "textsample"=>"15-10-2022"],
	["textlabel"=>"Tgl SLA Termin 6 - Format C",   "textvar"=>"{{TglSlaTermin6C}}",                "textsample"=>"15 Okt 2022"],
	["textlabel"=>"Tgl SLA Termin 6 - Format D",   "textvar"=>"{{TglSlaTermin6D}}",                "textsample"=>"15 Oktober 2022"] */
];