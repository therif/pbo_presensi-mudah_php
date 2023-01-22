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
        case 'delnote':
            delnote();
            break;
        case 'editnote':
            editnote();
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

    function escape_string($value) {
		return $this->db->real_escape_string($value);
	}

    function add_Note($judul, $konten){
        if (!empty($judul)) {
            $cleanTitle = $this->escape_string($judul);
            $cleanKonten = $this->escape_string($konten);

            $tgl = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `notes` (`judul`, `konten`, `tgl`) VALUES ('$cleanTitle', '$cleanKonten', '$tgl');";
            $query = mysqli_query($this->db, $sql);
            if ($query) {
                // header('Location: ../index.php');
                // echo 'Sukses';

                $reply = array("id"=>mysqli_insert_id($this->db), 
                                "judul"=>$judul, 
                                "konten"=>$konten, 
                                "tgl"=>$tgl);

                // echo "<script>console.log('php "+$reply['judul']+"');</script>";
                return $reply;
            } else {
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

    function delete_Note($id){
        if (!empty($id)) {
            $sql = "DELETE FROM notes WHERE id = $id;";

            $query = mysqli_query($this->db, $sql);
            if ($query) {
                // header('Location: ../index.php');
                return 'Sukses';

            } else {
                return 'Gagal Add Note';
            }
        }
        
        $this->closeDB();
    }

    function update_Note($id, $judul, $konten) {
        if (!empty($id)) {
            
            if (!empty($judul) || !empty($konten)) {
                $cleanTitle = $this->escape_string($judul);
                $cleanKonten = $this->escape_string($konten);
                $sql = "UPDATE notes SET judul = '$cleanTitle', konten = '$cleanKonten' WHERE id = $id;";
                $query = mysqli_query($this->db, $sql);
                if ($query) {
                    // header('Location: ../index.php');
                    return 'Sukses';
                } else {
                    return 'Gagal Update Note!';
                }
            }
            
            return 'Gagal Update Note!';
        }
        
        $this->closeDB();
    }
}

function addnote() {
    $title = ($_POST['title']);
    $konten = ($_POST['content']);

    if (!empty($title)) {
        $addDb = new noteProses();
        $prosins = $addDb->add_Note($title, $konten);
        echo json_encode($prosins);      
    } else {

    }
    
}

function delnote() {
    // echo "<script>console.log('Delete Note');</script>";
    $idnya = ($_POST['id']);

    //echo 'IDNYA => '.($idnya);

    if (!empty($idnya)) {
        $delDb = new noteProses();
        $prosdel = $delDb->delete_Note($idnya);
        echo json_encode($prosdel);        
    } else {

    }

}

function editnote() {
    // echo "<script>console.log('Edit Note');</script>";
    $idnya = ($_POST['id']);
    $title = ($_POST['title']);
    $konten = ($_POST['content']);

    echo 'title => '.($title);

    if (!empty($idnya)) {
        $editDb = new noteProses();
        $prosupdate = $editDb->update_Note($idnya,$title,$konten);
        echo json_encode($prosupdate);        
    } else {

    }

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