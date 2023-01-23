<?php

if (file_exists('../db/koneksi.php')) {
    include '../db/koneksi.php';
  } else {
    include 'db/koneksi.php';
  }

if (isset($_REQUEST['op'])) {
    $act = $_REQUEST['op'];
    
    switch($act){
        case 'addpresensi':
            addnote();
            break;
        case 'showpresensi':
            showpresensi();
            break;
        default:
            // echo 'Gagal';
            break;
    }
}

// class presensi_Model {
//     private $name;
//     private $date;
//     private $notes;
//     private $info;
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

    function __construct() {
        $this->db = connect_database();
    }

    function closeDB() {
        mysqli_close($this->db);
    }

    function escape_string($value) {
		return $this->db->real_escape_string($value);
	}

    function getAll_data($tgl = '') {
        if (!empty($tgl)) {
            $sql = "SELECT * FROM presensi WHERE tgl = '$tgl' ORDER BY tgl DESC;";
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

    function insert_data($data) {
        $name = $this->escape_string($data[0]);
        $date = $data[1];
        $desk = $this->escape_string($data[2]);
        $info = $data[3];
        $sql = "INSERT INTO `presensi` (`nama`, `tgl`, `desk`, `info`, `tag`) VALUES ('$name', '$date', '$desk', '$info', 'Presensi');";
        $query = mysqli_query($this->db, $sql);
        if($query){
            header('Location: index.php');
        }else{
            echo 'Gagal insert_database';
        }
        $this->closeDB();
    }
    function delete_data($id) {
        if (!empty($id)) {
            $sql = "DELETE FROM presensi WHERE id = $id;";

            $query = mysqli_query($this->db, $sql);
            if ($query) {
                // header('Location: ../index.php');
                return 'Sukses';

            } else {
                return 'Gagal Add Data';
            }
            
        }
        
        $this->closeDB();
    }

    function update_data($id, $desk, $info) {
        if (!empty($id)) {
            if (!empty($desk) || !empty($info)) {
                $cleanDesk = $this->escape_string($desk);
                $cleanInfo = $this->escape_string($info);
                
                $sql = "UPDATE presensi SET desk = $cleanDesk, info = $cleanInfo WHERE id = $id;";

                $query = mysqli_query($this->db, $sql);
                if ($query) {
                    // header('Location: ../index.php');
                    return 'Sukses';

                } else {
                    return 'Gagal Update Data!';
                }
            }
            
            return 'Gagal Update Data!';
        }
        
        $this->closeDB();
    }

}


function showPresensi() {
    $tgl = '';
    if (isset($_POST['tgl'])) {
        $tgl = $_POST['tgl'];
    }
    $pr = new presensi();
    $data;
    if (!empty($tgl)) {
        $data = $pr->getAll_data($tgl);
    } else {
        $data = $pr->getAll_data();
    }
    
    echo json_encode($data);
}

?>