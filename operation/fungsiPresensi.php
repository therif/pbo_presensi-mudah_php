<?php

include 'db/koneksi.php';

// class presensi_Model {
//     private $name;
//     private $date;
//     private $notes;
//     private $tags;

//     function __construct($data){
//         $this->name = $data[0];
//         $this->date = $data[1];
//         $this->notes = $data[2];
//         $this->tags = $data[3];
//     }
// }
    

class presensi {
    protected $db;
    // function __construct($db){
    //     $this->db = $db;
    // }

    function __construct(){
        $this->db = connect_database();
    }

    function closeDB(){
        mysqli_close($this->db);
    }

    function getAll_data($tgl = ''){
        if (!empty($tgl)) {
            $sql = "SELECT * FROM presensi WHERE tgl = $tgl ORDER BY tgl DESC;";
        } else {
            $sql = "SELECT * FROM presensi ORDER BY tgl DESC;";
        }
        
        $query = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($query)){
            $data[] = $row;
        }
        return $data;
        $this->closeDB();
    }

    function insert_data($data){
        $name = $data[0];
        $date = $data[1];
        $desk = $data[2];
        $info = $data[3];
        $sql = "INSERT INTO `presensi` (`nama`, `tgl`, `desk`, `info`) VALUES ('$name', '$date', '$desk', '$info');";
        $query = mysqli_query($this->db, $sql);
        if($query){
            header('Location: index.php');
        }else{
            echo 'Gagal insert_database';
        }
        $this->closeDB();
    }
}

// function closeDB($koneksi){
//     mysqli_close($koneksi);
// }

// function insert_database($koneksi, $data){
//     $name = $data[0];
//     $date = $data[1];
//     $notes = $data[2];
//     $tags = $data[3];
//     $sql = "INSERT INTO `pbo` (`event_name`, `event_tgl`, `event_notes`, `event_option`) VALUES ('$name', '$date', '$notes', '$tags');";
//     $query = mysqli_query($koneksi, $sql);
//     if($query){
//         header('Location: index.php');
//     }else{
//         echo 'Gagal';
//     }
//     closeDB($koneksi);
// }

// function get_all_data($koneksi, $tgl = ''){
//     if (!empty($tgl)) {
//         $sql = "SELECT * FROM pbo WHERE event_tgl = $tgl;";
//     } else {
//         $sql = "SELECT * FROM pbo;";
//     }
    
//     $query = mysqli_query($koneksi, $sql);
//     $data = [];
//     while($row = mysqli_fetch_array($query)){
//         $data[] = $row;
//     }
//     return $data;
//     closeDB($koneksi);
// }


?>