<?php sleep(1);

$sekolah=getData("data_sekolah","idsekolah='".$_POST["idsekolah"]."'");
$konten="Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Language,Photo,Group Membership,Phone 1 - Type,Phone 1 - Value,Organization 1 - Type,Organization 1 - Name,Organization 1 - Yomi Name,Organization 1 - Title,Organization 1 - Department,Organization 1 - Symbol,Organization 1 - Location,Organization 1 - Job Description\n";

// Add data konten
$qry="SELECT dl.nama,dl.role,dl.jabatan,dl.nohp,dl.nohp_status,dwk.kelas FROM `data_login` dl LEFT JOIN `data_wali_kelas` dwk ON dl.iduser=dwk.iduser ORDER BY dwk.kelas";
$mqr=mysqli_query($_SESSION["sess"]["koneksi"],$qry);
while($data=mysqli_fetch_array($mqr)){
	    
    if($data["nohp"]!=""){
        $konten.='"'.$data["nama"].'"';
        $konten.=",";
        $konten.='"'.$data["nama"].'"';
        $konten.=",";
        if($data["kelas"]!="")                                                              $konten.='"'." wali kelas ".$data["kelas"].'"';
        elseif($data["role"]=="operator" && $data["jabatan"]=="Guru Mata Pelajaran")        $konten.='"'." Guru ".$sekolah["nama_sekolah"].'"';
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Guru Bimbingan Konseling") $konten.='"'." Guru BK ".$sekolah["nama_sekolah"].'"';
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Staf TU")                  $konten.='"'." Staf TU ".$sekolah["nama_sekolah"].'"';
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Kepala Sekolah")           $konten.='"'." Kepsek ".$sekolah["nama_sekolah"].'"';
        elseif($data["role"]=="admin")                                                      $konten.='"'." Admin ".$sekolah["nama_sekolah"].'"';
        else                                                                                $konten.='"'." Operator ".$sekolah["nama_sekolah"].'"';
        $konten.=",,,,,,,,,,,,,,";
        $konten.=$sekolah["kota"];
        $konten.=",,,,,,,,,";        
        
        $konten.='"Catatan :'."\n";
        $konten.=$data["nama"]."\n";
        
        if($data["kelas"]!="")                                                              $konten.="Wali Kelas : ".$data["kelas"]."\n";
        elseif($data["role"]=="operator" && $data["jabatan"]=="Guru Mata Pelajaran")        $konten.="Jabatan : Guru"."\n";
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Guru Bimbingan Konseling") $konten.="Jabatan : Guru BK"."\n";
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Staf TU")                  $konten.="Jabatan : Staff TU"."\n";
        elseif($data["role"]=="supervisor" && $data["jabatan"]=="Kepala Sekolah")           $konten.="Jabatan : Kepala Sekolah"."\n";
        elseif($data["role"]=="admin")                                                      $konten.="Jabatan : Administrator"."\n";
        else                                                                                $konten.="Jabatan : Operator"."\n";
        $konten.="Sekolah : ".$sekolah["nama_sekolah"]."\n";
        $konten.="Tgl. Data : ".FormatTgl(date("Y-m-d"),"full-id")."\n";
        $konten.='"';
        
        $konten.=",,,";
        $konten.="* myContacts,Mobile,";
        $konten.=$data["nohp"];
        
        $konten.=",,";
        $konten.=$sekolah["nama_sekolah"];//company
        $konten.=",,,,,";
        
        $konten.='"';
        $konten.=$sekolah["kota"]. ", ";
        $konten.=$sekolah["provinsi"];
        $konten.=", Indonesia";
        $konten.='"';
        
        $konten.=",";
        $konten.="\n";
    }
    
}


// set default folder
$Folder = 'file-download/'; if(!file_exists($Folder)) mkdir($Folder); 
$filex	= $Folder."index.html"; if(!file_exists($filex)){ $myfilex=fopen($filex, "w");fclose($myfilex); }

// set nama file
$x=1; while(file_exists($Folder.strtoupper(UrlText($sekolah["nama_sekolah"]).'-operator-'.date("Y-m-d").'-'.str_pad($x,3,"0",STR_PAD_LEFT)).".csv")){ $x++; } 
$fileoutput =           $Folder.strtoupper(UrlText($sekolah["nama_sekolah"]).'-operator-'.date("Y-m-d").'-'.str_pad($x,3,"0",STR_PAD_LEFT)).".csv";

// Save
$myfile = fopen($fileoutput, "w") or die("Unable to open file!");
fwrite($myfile, $konten);
fclose($myfile);

// set response
$status["success"]="1";
$status["downlink"]=siteURL().$fileoutput;
echo json_encode($status);