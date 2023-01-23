<?php 
if (file_exists('operation/fungsiPresensi.php')) {
  include 'operation/fungsiPresensi.php';
}

$yearNow = date("Y");
$monthLongNow = date("F");
$monthNow = date("m");
$monthSatuNow = date("n");
$dayNow = date("d");
$daySatuNow = date("j");


if(isset($_POST['submit'])){
    $data = [
        $_POST['name'],
        $_POST['date'],
        $_POST['notes'],
        $_POST['info']
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
  <script src="./js/fungsi.js"></script>

  
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
      <span class="c-paginator__year"><?php echo $yearNow; ?></span>
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
      </div>
    </div>
    <div class="c-cal__container c-calendar__style">
      <script>
        var monthsName = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
      // CAHNGE the below variable to the CURRENT YEAR
      // year = 2023;

      dateObj = new Date();
      year = <?php echo $yearNow; ?>;
      month = dateObj.getUTCMonth()+1;
      month2Digit = ("0" + (month)).slice(-2);
      day = dateObj.getUTCDate();
      day2Digit = ("0" + (day)).slice(-2);
        
        skrgToday = year + "-" + monthsName[parseInt(month)-1] + "-" + day;
        console.log('Today : '+skrgToday);

        // first day of the week of the new year
        // today = new Date("January 1, " + year);
        //today = new Date(monthsName[parseInt(month)-1] + " "+day+", " + year);
        today = new Date();
      
        // start_day = today.getDay() + 1;
        start_day = today.getDay();
        fill_table(monthsName[0], 31, "01");
        fill_table(monthsName[1], 28, "02");
        fill_table(monthsName[2], 31, "03");
        fill_table(monthsName[3], 30, "04");
        fill_table(monthsName[4], 31, "05");
        fill_table(monthsName[5], 30, "06");
        fill_table(monthsName[6], 31, "07");
        fill_table(monthsName[7], 31, "08");
        fill_table(monthsName[8], 30, "09");
        fill_table(monthsName[9], 31, "10");
        fill_table(monthsName[10], 30, "11");
        fill_table(monthsName[11], 31, "12");
      </script>
      
    </div>
    
  </div>

  <div class="c-event__creator c-calendar__style js-event__creator">
    <a href="javascript:;" class="o-btn js-event__close">CLOSE <span class="fa fa-close"></span></a>
       <form id="addEvent" action="" method="POST" enctype="multipart/form-data"> 
      <input placeholder="Nama" type="text" name="name" id="name">
      <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" >
      <textarea placeholder="Notes" name="notes" cols="30" rows="10" id="notes"></textarea>
      <select name="info" id="info">
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
    <a href="https://github.com/therif/pbo_presensi-mudah_php" target="_blank"><i class="fa fa-hand-o-right" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; <b>Source Code</b></a>
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
<script src="./js/kalender.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="./js/note.js"></script>

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

</script>

</body>
</html>
