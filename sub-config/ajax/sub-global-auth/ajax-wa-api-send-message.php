<?php 


$qryValueWaApi = $_POST["qryValueWaApi"]??"";
$qryValueWaApi = isJson($qryValueWaApi)?json_decode($qryValueWaApi,true):[];

if(count($qryValueWaApi)>0)
{
    $insertData="   INSERT INTO kirim 
                    (
                        nomor_pengirim_kirim,
                        nomor_tujuan_kirim,
                        waktu_kirim,
                        id_jenis_kirim,
                        pesan_kirim,
                        gambar_kirim,
                        file_kirim,
                        keterangan_kirim,
                        status_kirim,
                        user_kirim,
                        date_kirim
                    )
                    VALUES ".join(", ",$qryValueWaApi);
    
    if(runQuery($insertData))   $result="success";
    else                        $result="failed 1";
}   else                        $result="failed 2";

echo $result;