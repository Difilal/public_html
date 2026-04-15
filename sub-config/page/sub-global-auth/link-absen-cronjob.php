<?php //exit;

if(	$_SERVER['HTTP_HOST']=="adms.pmpland.co.id:1111" || $_SERVER['HTTP_HOST']=="adms.pmpland.abc")
{

    include("tag/link-mysql-hosting-server.php");

    $idmesin	= $_POST["idmesin"];
    $mesin		= getData("data_absensi_mesin","idmesin='".$idmesin."'");
    $idcabang   = $mesin["idcabang"];
    
    
    $absen    = getdata("data_absensi_checkinout","SN='".$mesin["serial_number"]."' ORDER BY checktime ASC LIMIT 1");
    $cekAbsen = cekdata("data_absensi_checkinout","SN='".$mesin["serial_number"]."' ORDER BY checktime ASC LIMIT 1");
    
    
    if($cekAbsen>0)
    {
        $idcheckinout = $absen["idcheckinout"];
        $waktu_absen  = $absen["checktime"];
        $idabsensi    = ($absen["badgenumber"]-0);

        
        # 20210513_150550_000001001_AEWD202961478.jpg
        $tbt        = FilterNumber(substr($absen["checktime"],0,10)); // Tahun Bulan Tanggal
        $jmd        = FilterNumber(FormatWaktu($absen["checktime"],"full")); // Jam Menit Detik
        $pathFile   = "file-absensi/".$tbt."/".$tbt."_".$jmd."_".$absen["badgenumber"]."_".$mesin["serial_number"].".jpg";
        $pathUrl    = "https://app.pmpland.co.id/".$pathFile;
    
        
        $dataCurl["url"]        = "https://config-tams.irwan.id/link-absensi-photo-checkfile-hosting-api.async";
        $dataCurl["postFields"] = array("pathFile"=>$pathFile);
        $dataApi                = apiCurl($dataCurl);
        $dataCurl               = json_decode($dataApi,true);
        if($dataCurl["respon"]=="success") $nama_file=$pathFile; else $nama_file="";
    }
    else $idcheckinout=$waktu_absen=$idabsensi="";
    
    $sn_mesin_absensi	= $mesin["serial_number"];
    if($idabsensi!="")  $data["idabsensi"] = $idabsensi;
    $data["tgl_absen"]	= FormatTgl($waktu_absen,"full-id");
    $data["jam_absen"]	= Formatwaktu($waktu_absen,"full");




    #$user = getData("data_karyawan","idabsensi='".$idabsensi."'");
    $user = userAbsensi($idabsensi);


    // cek duplikat absen rentang waktu +/- 30 detik
    $cekDuplikatAbsen   = cekdata("data_absensi","user_type='".$user["user_type"]."' AND iduser='".$user["iduser"]."' AND idabsensi='".$idabsensi."' AND (waktu_absen='".$waktu_absen."' OR (waktu_absen>='".DateBySecond(30,"-",$waktu_absen)."' AND waktu_absen<='".DateBySecond(30,"+",$waktu_absen)."'))");
    
    
    if($cekDuplikatAbsen==0 && $cekAbsen>0 && !isset($browserjob))
    {       
        
        $nohpAtasanLangsung = getdata("data_karyawan","iduser='".$user["direct_supervisor"]."' AND nohp1_status='aktif'","nohp1");
        $jamkerja           = ProfileAbsensi($user["idprofileabsensi"]);
        $tgl_kalender       = $jamkerja["tgl_kalender"];
        $masuk              = $jamkerja["masuk"];
        $jam_masuk          = $jamkerja["jam_masuk"];
        $batas_jam_masuk    = $jamkerja["batas_jam_masuk"];
        $jam_pulang         = $jamkerja["jam_pulang"];
        $batas_jam_pulang   = $jamkerja["batas_jam_pulang"];
        ###
        $detik_waktuAbsen_real  = strtotime(substr($waktu_absen,11));
        $detik_waktuAbsen       = $detik_waktuAbsen_real-($detik_waktuAbsen_real%60);
        ###
        $cek_AbsenMasuk  = cekData("data_absensi","idabsensi='".$idabsensi."' AND tgl_absen='".$tgl_kalender."' AND waktu_absen <'".$jam_pulang."'");
        $cek_AbsenPulang = cekData("data_absensi","idabsensi='".$idabsensi."' AND tgl_absen='".$tgl_kalender."' AND waktu_absen>='".$jam_pulang."'");
        if($cek_AbsenPulang>0)
        {
            $updateAbsenPulang="UPDATE data_absensi SET status_absen='', durasi_lembur='0' WHERE status_absen='Absen Pulang' AND user_type='".$user["user_type"]."' AND iduser='".$user["iduser"]."' AND idabsensi='".$idabsensi."' AND tgl_absen='".$tgl_kalender."'";
            if(runQuery($updateAbsenPulang)) $cek_AbsenPulang=0;
        }
        ###
        /* if($cek_AbsenPulang>0 && strtotime(substr($waktu_absen,11,5))>=strtotime($jam_pulang))   $status_absen="";
        elseif($detik_waktuAbsen >  strtotime($batas_jam_pulang))                $status_absen="Absen Pulang";
        elseif($detik_waktuAbsen >= strtotime($jam_pulang))                      $status_absen="Absen Pulang"; */
        if($detik_waktuAbsen >= strtotime($jam_pulang))                          $status_absen="Absen Pulang";
        ###
        elseif($cek_AbsenMasuk>0 && strtotime(substr($waktu_absen,11,5))<strtotime($jam_pulang)) $status_absen="";
        elseif($detik_waktuAbsen >  strtotime($jam_masuk))                       $status_absen="Masuk Terlambat";
        elseif($detik_waktuAbsen <= strtotime($jam_masuk))                       $status_absen="Absen Masuk";
        ###
        else $status_absen="?";
        
        
        $message  =                                   ":: _Notifikasi Absen_ ::"."\n";
        $message .=                                   "*PT. PANCA MULIA PERSADA*\n.\n";
        $message .=                                   "Nama : *".         $user["nama"]."*\n"; if($user["user_type"]=="Karyawan")
        $message .=                                   "NIK : *".          $user["nomor_induk_karyawan"]."*\n";
        $message .=                                   "Hari/Tgl : *".     DayByDate($waktu_absen).", ".$data["tgl_absen"]."*\n";
        $message .=                                   "Jam Absen : *".    $data["jam_absen"]."*\n";
        $message .=                                   "Cabang : *".       getdata("data_cabang","idcabang='".$mesin["idcabang"]."'","nama_cabang")."*\n";
        if($masuk==1 && $status_absen!=""){
        $message .=                                   "Status Absen : *". $status_absen."*"/* ."\n" */;
        }
        
        
        if( ((isNoHP($user["nohp1"]) && $user["nohp1_status"]=="aktif")  || 
             (isNoHP($user["nohp2"]) && $user["nohp2_status"]=="aktif")  || 
              isNoHP($nohpAtasanLangsung)
            ) && (strtotime(date("Y-m-d H:i:s"))-strtotime($waktu_absen))<=3600 )
        {
            $kirim_notif                = "queue";
            $ketNotifNo                 = "";
            $data["kirim_notifikasi"]   = "Ya";
            
            $nohp_tujuan=array();
            if(isNoHP($nohpAtasanLangsung))
            {    
                array_push($nohp_tujuan,$nohpAtasanLangsung);
                $durasiLembur = $detik_waktuAbsen-(strtotime($jam_pulang)+3600); // lembur dihitung 1 jam setelah jam pulang
            }

            // if(isset($user["jabatan"]) && $user["jabatan"]=="Marketing Agent Supervisor") array_push($nohp_tujuan,"0811543538"); // Pa hendi
            
            if(     isNoHP($user["nohp1"]) && $user["nohp1_status"]=="aktif")   array_push($nohp_tujuan,$user["nohp1"]);
            elseif( isNoHP($user["nohp2"]) && $user["nohp2_status"]=="aktif")   array_push($nohp_tujuan,$user["nohp2"]);
            elseif( isNoHP($nohpAtasanLangsung) && (($status_absen=="Absen Pulang" && ($durasiLembur-3600)>=0) || $status_absen=="Masuk Terlambat")) $ketNotifNo = "NoHP tidak valid, notif tetap kirim ke atasan langsung";
        }
        else
        { 
            $kirim_notif="no"; $data["kirim_notifikasi"]="Tidak"; $nohp_tujuan=""; 
            if(isNoHP($user["nohp1"])) $isNoHP1="true"; else $isNoHP1="false";
            if(isNoHP($user["nohp2"])) $isNoHP2="true"; else $isNoHP2="false";
            if(!isNoHP($user["nohp1"]) && !isNoHP($user["nohp2"]))                      $ketNotifNo="Nohp tidak valid, nohp1:".$isNoHP1.", nohp2:".$isNoHP2;
            elseif($user["nohp1_status"]!="aktif" && $user["nohp2_status"]!="aktif")    $ketNotifNo="Nohp status tidak aktif, nohp1_status:".$user["nohp1_status"].", nohp1_status".$user["nohp2_status"];
            elseif((strtotime(date("Y-m-d H:i:s"))-strtotime($waktu_absen))>(3600*3))   $ketNotifNo="wkt_sinkron - wkt_absen > 3jam, wkt_sinkron:".date("Y-m-d H:i:s").", wkt_absen:".$waktu_absen;
        }
    
    
    
    
        if($status_absen=="Absen Pulang")
        {
            $durasiTerlambat=0;
            $durasiLembur   = $detik_waktuAbsen-(strtotime($jam_pulang)+3600); // lembur dihitung 1 jam setelah jam pulang
            if($durasiLembur<=0) $durasiLembur=0;
        }
        elseif($status_absen=="Masuk Terlambat")
        {
            $durasiTerlambat=$detik_waktuAbsen-strtotime($jam_masuk);
            if($durasiTerlambat<=0) $durasiTerlambat=0;
            $durasiLembur   =0;
        }
        else $durasiTerlambat=$durasiLembur=0;
    
        
        
        $NohpWaSender=getNohpWaSender();
        if($NohpWaSender==""){ $kirim_notif="no"; $data["kirim_notifikasi"]="Tidak"; $ketNotifNo="WA sender tidak akif"; } 
        if($kirim_notif=="queue") $kirim_notif2="yes"; else $kirim_notif2=$kirim_notif; //$kirim_notif2="no";
        $qry_insert1 ="INSERT INTO data_absensi (user_type,iduser,idabsensi, idperusahaan, idcabang, nik, status_absen, tgl_absen, waktu_absen, durasi_masuk_terlambat, durasi_lembur, sn_mesin_absensi,kirim_notif,ket_notif_no) ";
        $qry_insert1.="VALUES ('".$user["user_type"]."','".$user["iduser"]."','".$idabsensi."','".$user["idperusahaan"]."','".$user["idcabang"]."','".$user["nomor_induk_karyawan"]."','".$status_absen."','".$tgl_kalender."','".$waktu_absen."','".$durasiTerlambat."','".$durasiLembur."','".$sn_mesin_absensi."','".$kirim_notif2."','".$ketNotifNo."')";
        /* $cekDataAbsen=cekdata("data_absensi","iduser='".$user["iduser"]."' AND idabsensi='".$idabsensi."' AND (waktu_absen='".$waktu_absen."' OR (waktu_absen>='".DateBySecond(30,"-",$waktu_absen)."' AND waktu_absen<='".DateBySecond(30,"+",$waktu_absen)."'))");
        if($cekDataAbsen>0)
        {
            $qry_delete="DELETE FROM data_absensi_checkinout WHERE idcheckinout='".$idcheckinout."' LIMIT 1";
            runQuery($qry_delete);
        }
        else */
        if(runQuery($qry_insert1)){ //echo "_-0-=0-0-= ";
            
            if($kirim_notif=="queue")
            {
                $last_idcheckinout_absensi=mysqli_insert_id($_SESSION["sess"]["koneksi"]);
                $qry_insert2 ="INSERT INTO data_log_wa (send_group,tipe_pesan,nohp_pengirim, nohp_tujuan, pesan, nama_file, status_kirim, waktu) VALUES ";
                for($t=0;$t<count($nohp_tujuan);$t++)
                {
                    //if($t>0) $qry_insert2.=",";
                    $qry_insert2_value="('notif-absensi','outbox','".getNohpWaSender(-1,$nohp_tujuan[$t])."','".$nohp_tujuan[$t]."','".escStringDB($message)."','".$nama_file."','".$kirim_notif."','".date("Y-m-d H:i:s")."')";
                    runQuery($qry_insert2.$qry_insert2_value);
                }

                $last_idcheckinout_logwa=mysqli_insert_id($_SESSION["sess"]["koneksi"]);
                runQuery("UPDATE data_absensi SET idlogwa='".$last_idcheckinout_logwa."' WHERE idcheckinout='".$last_idcheckinout_absensi."'");
            }


            $qry_delete="DELETE FROM data_absensi_checkinout WHERE idcheckinout='".$idcheckinout."' LIMIT 1";
            runQuery($qry_delete);
            //apiDelDataAbsen($idcheckinout);
        }else echo mysqli_error($_SESSION["sess"]["koneksi"])." --- ";
    }
    elseif($cekDuplikatAbsen>0)
    {
        $qry_delete="DELETE FROM data_absensi_checkinout WHERE idcheckinout='".$idcheckinout."' LIMIT 1";
        runQuery($qry_delete);
    }
    
    
    $data["dataAbsenAll"]   = cekdata("data_absensi","sn_mesin_absensi='".$mesin["serial_number"]."'");
    $data["dataAbsenToday"] = cekdata("data_absensi","sn_mesin_absensi='".$mesin["serial_number"]."' AND waktu_absen LIKE '".date("Y-m-d")."%'");
    
    
    
    
    //mysqli_close($_SESSION["sess"]["koneksi"]);
    //include("link-mysql-hosting-server.php"); 
    $cronjob_last_operation=substr($mesin["cronjob_last_operation"],0,10);
    if(date("Y-m-d")!=$cronjob_last_operation) $cronjob_operation="0";
    else $cronjob_operation=$mesin["cronjob_operation"]+1;
    runQuery("UPDATE data_absensi_mesin SET cronjob_operation='".$cronjob_operation."', cronjob_last_operation='".date("Y-m-d H:i:s")."' WHERE idmesin='".$idmesin."'");
    //if(isset($_POST["idmesin"]) && $data["idabsensi"]!="") 
    if(isset($_POST["idmesin"])) echo json_encode($data);

}