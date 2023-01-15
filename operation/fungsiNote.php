<?php
include '../db/koneksi.php';

if (isset($_REQUEST['op'])) {
    $act = $_REQUEST['op'];
    
    switch($act){
        case 'addnote':
            addnote();
            break;
        case 'shownote':
            shownote();
            break;
        default:
            // echo 'Gagal';
            break;
    }
}

class noteProses {
    protected $db;
    function __construct(){
        $this->db = connect_database();
    }

    function closeDB(){
        mysqli_close($this->db);
    }

    function add_Note($data){
        if (!empty($data)) {
            $judul = $data[0];
            $konten = $data[1];

            $tgl = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `notes` (`judul`, `konten`, `tgl`) VALUES ('$judul', '$konten', '$tgl');";
            $query = mysqli_query($this->db, $sql);
            if($query){
                // header('Location: ../index.php');
                // echo 'Sukses';


                $reply = array("id"=>mysqli_insert_id($this->db), 
                                "judul"=>$judul, 
                                "konten"=>$konten, 
                                "tgl"=>$tgl);

                // echo "<script>console.log('php "+$reply['judul']+"');</script>";
                //return $reply; //reply
            }else{
                return 'Gagal Add Note';
            }
        }
        $this->closeDB();
    }

    function getAll_Note($tgl = ''){
        if (!empty($tgl)) {
            $sql = "SELECT * FROM notes WHERE tgl = $tgl ORDER BY tgl DESC;";
        } else {
            $sql = "SELECT * FROM notes ORDER BY tgl DESC;";
        }
        
        $query = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($query)){
            $data[] = $row;
        }
        return $data;
        $this->closeDB();
    }
}

function addnote() {
    $parsing = ($_POST);
    $data = [];
    foreach($parsing as $key => $value){
        $data[] = $value;
    }
    $addDb = new noteProses();
    $prosins = $addDb->add_Note($data);
    echo json_encode($prosins);
}

function shownote() {
    $pr = new noteProses();
    $data = $pr->getAll_Note();
    echo json_encode($data);
}

// function addnote(){
//     include '../db/koneksi.php';
//     $koneksi = connect_database();
//     $parsing = ($_POST);
//     $data = [];
//     foreach($parsing as $key => $value){
//         $data[] = $value;
//     }


//     $sql = "INSERT INTO `notes` (`judul`, `konten`, `tgl`) VALUES ('$data[0]', '$data[1]', '$data[2]');";
//     $query = mysqli_query($koneksi, $sql);
//     if($query){
//         header('Location: ../index.php');
//     }else{
//         echo 'Gagal addnote';
//     }
//     closeDB($koneksi);
// }

// function shownote(){
//     include '../db/koneksi.php';
//     $koneksi = connect_database();
//     $sql = "SELECT * FROM notes";
//     $query = mysqli_query($koneksi, $sql);
//     $data = [];
//     while($row = mysqli_fetch_array($query)){
//         $data[] = $row;
//     }
//     echo json_encode($data);
//     closeDB($koneksi);
// }

?>