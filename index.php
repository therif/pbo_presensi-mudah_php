<?php 
include 'operation/fungsiPresensi.php';

if(isset($_POST['submit'])){
    $data = [
        $_POST['name'],
        $_POST['date'],
        $_POST['notes'],
        $_POST['tags']
    ];
    $insdb = new presensi();
    $prosins = $insdb->insert_data($data);
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Presensi Mudah!</title>
  <link rel="stylesheet" href="./css/note.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'>
  <link rel="stylesheet" href="./css/kalender.css">
  <script  src="./js/fungsi.js"></script>

  
</head>
<body>

<div class="judul-situs">PRESENSI MUDAH</div>
<div class="deskripsi-situs">Tunjukkan Kehadiranmu  Disini</div>
</p>

<!-- Kalender -->
<header>
  <div class="wrapper">
    <div class="c-monthyear">
    <div class="c-month">
        <span id="prev" class="prev fa fa-angle-left" aria-hidden="true"></span>
        <div id="c-paginator">
          <span class="c-paginator__month">JANUARY</span>
          <span class="c-paginator__month">FEBRUARY</span>
          <span class="c-paginator__month">MARCH</span>
          <span class="c-paginator__month">APRIL</span>
          <span class="c-paginator__month">MAY</span>
          <span class="c-paginator__month">JUNE</span>
          <span class="c-paginator__month">JULY</span>
          <span class="c-paginator__month">AUGUST</span>
          <span class="c-paginator__month">SEPTEMBER</span>
          <span class="c-paginator__month">OCTOBER</span>
          <span class="c-paginator__month">NOVEMBER</span>
          <span class="c-paginator__month">DECEMBER</span>
        </div>
        <span id="next" class="next fa fa-angle-right" aria-hidden="true"></span>
      </div>
      <span class="c-paginator__year">2022</span>
    </div>
    <div class="c-sort">
      <a class="o-btn c-today__btn" href="javascript:;">TODAY</a>
    </div>
  </div>
</header>
<div class="wrapper">
  <div class="c-calendar">
    <div class="c-calendar__style c-aside">
      <a class="c-add o-btn js-event__add" href="javascript:;">add Presensi <span class="fa fa-plus"></span></a>
      <div class="c-aside__day">
        <span class="c-aside__num"></span> <span class="c-aside__month"></span>
      </div>
      <div class="c-aside__eventList">
        <?php 
              // call koneksi.php connection
              // $koneksi = connect_database();
              // $pr = new presensi($koneksi);

              $pr = new presensi();
              $data = $pr->getAll_data();
              // $data = get_all_data($koneksi);
              foreach($data as $row){
                  echo '<div class="c-aside__event">
                  <div class="c-aside__event__title">'.$row['nama'].'</div>
                  <div class="c-aside__event__time">'.$row['tgl'].'</div>
                  <div class="c-aside__event__desc">'.$row['desk'].'</div>
                  <div class="c-aside__event__tags">'.$row['info'].'</div>
                </div>';
              }
        ?>
      </div>
    </div>
    <div class="c-cal__container c-calendar__style">
      <script>
      
      // CAHNGE the below variable to the CURRENT YEAR
      year = 2022;

      // first day of the week of the new year
      today = new Date("January 1, " + year);
      start_day = today.getDay() + 1;
      fill_table("January", 31, "01");
      fill_table("February", 28, "02");
      fill_table("March", 31, "03");
      fill_table("April", 30, "04");
      fill_table("May", 31, "05");
      fill_table("June", 30, "06");
      fill_table("July", 31, "07");
      fill_table("August", 31, "08");
      fill_table("September", 30, "09");
      fill_table("October", 31, "10");
      fill_table("November", 30, "11");
      fill_table("December", 31, "12");
      </script>
      
    </div>
    
  </div>

  <div class="c-event__creator c-calendar__style js-event__creator">
    <a href="javascript:;" class="o-btn js-event__close">CLOSE <span class="fa fa-close"></span></a>
       <form id="addEvent" action="" method="POST" enctype="multipart/form-data"> 
      <input placeholder="Nama" type="text" name="name" id="name">
      <input type="date" name="date" id="date">
      <textarea placeholder="Notes" name="notes" cols="30" rows="10" id="notes"></textarea>
      <select name="tags" id="tags">
          <option value="Hadir">Hadir</option>
          <option value="Sakit">Sakit</option>
          <option value="Izin">Izin</option>
        </select>
    </form>
    <br>
    <button type="submit" form="addEvent" value="Submit" id="submit" name="submit">Save</button>
  </div>
  
    <div class="header-kecil wrapper">
      <div class="c-sort">
        <a class="o-btn" href="javascript:;" id="add_new">Add New Note  <span class="fa fa-plus"></span></a>
      </div>
    </div>
    
    <div id="board">
    </div>
    
    <div class="bot-bef-gooter"> &nbsp; </div>
</div>
<!-- End Kalender -->


<!-- Notes -->
<!-- <iframe src="./note.php" width="100%" height="100%" frameborder="0" scrolling="no" ></iframe> -->
  
<!-- End Notes -->


<div class="footer">
  <div class="left">
    <a href="./About.html" target="_blank"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; <b>About</b></a> <br />
    <a href="https://github.com/therif/pbo_presensi-mudah" target="_blank"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; <b>Source Code</b></a>
  </div>

  <div class="right">
    <a onclick="scrollKePresensi()" href="#"><b>Presensi</b> &nbsp;&nbsp;&nbsp; <i class="fa fa-hand-o-left" aria-hidden="true"></i></a> <br />
    <a onclick="scrollKeNotes()" href="#"><b>Notes</b> &nbsp;&nbsp;&nbsp; <i class="fa fa-hand-o-left" aria-hidden="true"></i></a>
  </div>
  <span class="left"></span>
  <div class="konten"><p><b>Presensi Mudah</b><br />by Arif Kurniawan (TI - 1002220036)</p></div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.core.min.js'></script>
<script  src="./js/kalender.js"></script>

<!-- <script src='./js/jquery-ui.min.js'></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script  src="./js/note.js"></script>

<script type = "text/javascript">

  function scrollKePresensi() {
    window.scrollTo(0, 0);
  };

  function scrollKeNotes() {
    var accessBoard = document.getElementById("board").offsetHeight / 2;
    $("html, body").animate({ scrollTop: accessBoard });
  };

  function scrollKeAbout() {
    var accessAbout = document.getElementById("about").offsetHeight / 2;
    $("html, body").animate({ scrollTop: accessAbout });
  };

  // document.addEventListener("DOMContentLoaded", function(event) { 
  //           var scrollpos = localStorage.getItem('scrollpos');
  //           if (scrollpos) window.scrollTo(0, scrollpos);
  //       });

  //       window.onbeforeunload = function(e) {
  //           localStorage.setItem('scrollpos', window.scrollY);
  //       };

</script>

</body>
</html>
