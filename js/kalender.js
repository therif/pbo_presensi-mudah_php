//global variables
var monthEl = $(".c-main");
var dataCel = $(".c-cal__cel");
var dateObj = new Date();
// var month = dateObj.getUTCMonth() + 1;
// var day = dateObj.getUTCDate();
// var month = ("0" + (dateObj.getUTCMonth() + 0)).slice(-2);
// var day = ("0" + (dateObj.getUTCDate())).slice(-2);
var month = dateObj.getUTCMonth() + 1;
var month2Digit = ("0" + (month)).slice(-2);
var day = dateObj.getUTCDate();
var day2Digit = ("0" + (day)).slice(-2);

var year = dateObj.getUTCFullYear();
var monthText = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];
var indexMonth = month;
var todayBtn = $(".c-today__btn");
var addBtn = $(".js-event__add");
var saveBtn = $(".js-event__save");
var closeBtn = $(".js-event__close");
var winCreator = $(".js-event__creator");
var inputDate = $(this).data();
today = year + "-" + month2Digit + "-" + day2Digit;

// ------ set default events -------
function defaultEvents(dataDay,dataName,dataNotes,classTag){
  var date = $('*[data-day='+dataDay+']');
  date.attr("data-name", dataName);
  date.attr("data-notes", dataNotes);
  date.addClass("event");
  date.addClass("event--" + classTag.toLowerCase());
}
function presensiEvents(dataDay,classTag){
  var date = $('*[data-day='+dataDay+']');
  date.addClass("event");
  date.addClass("event--" + classTag.toLowerCase());
}

showAllPresensi();
// defaultEvents(today, 'YEAH!','Today is your day','important');
// defaultEvents("2023-01-24", 'Tomorrow!','May tomorrow be more beautiful!!!!','festivity');
// defaultEvents('2022-12-25', 'MERRY CHRISTMAS','A lot of gift!!!!','festivity');
// defaultEvents('2022-05-04', "LUCA'S BIRTHDAY",'Another gifts...?','birthday');
// defaultEvents('2022-03-03', "MY LADY'S BIRTHDAY",'A lot of money to spent!!!!','birthday');


// ------ functions control -------

//button of the current day
todayBtn.on("click", function() {
  // console.log('todayBtn ('+today+') : '+month+' < '+indexMonth);
  if (month < indexMonth) {
    // var step = indexMonth % month;
    var step = indexMonth - month;
    console.log('Dalem ('+step+') : '+indexMonth+' % '+month);
    // movePrev(step, true);
    movePrev(step, true);
  } else if (month > indexMonth) {
    var step = month - indexMonth;
    moveNext(step, true);
  }
});

//higlight the cel of current day
dataCel.each(function() {
  // console.log('is Today : '+$(this).data("day")+' = '+today);
  if ($(this).data("day") === today) {
    $(this).addClass("isToday");
    
    fillEventSidebar($(this));
  }
});

//window event creator
addBtn.on("click", function() {
  console.log('addBtn : '+today);
  winCreator.addClass("isVisible");
  $("body").addClass("overlay");
  dataCel.each(function() {
    if ($(this).hasClass("isSelected")) {
      today = $(this).data("day");
      // console.log('addBtn2 : '+daytoday);
      document.querySelector('input[type="date"]').value = today;
    } else {
      document.querySelector('input[type="date"]').value = today;
    }
  });
});
closeBtn.on("click", function() {
  winCreator.removeClass("isVisible");
  $("body").removeClass("overlay");
});
saveBtn.on("click", function() {
  var inputName = $("input[name=name]").val();
  var inputDate = $("input[name=date]").val();
  var inputNotes = $("textarea[name=notes]").val();
  var inputTag = $("select[name=tags]")
    .find(":selected")
    .text();

  dataCel.each(function() {
    if ($(this).data("day") === inputDate) {
      if (inputName != null) {
        $(this).attr("data-name", inputName);
      }
      if (inputNotes != null) {
        $(this).attr("data-notes", inputNotes);
      }
      $(this).addClass("event");
      if (inputTag != null) {
        $(this).addClass("event--" + inputTag);
      }
      
      fillEventSidebar($(this));
    }
  });

  winCreator.removeClass("isVisible");
  $("body").removeClass("overlay");
  $("#addEvent")[0].reset();
});

function showAllPresensi() {

  $.ajax({
    type: "GET",
    url: "operation/fungsiPresensi.php?op=showpresensi",
    cache: false,
    success: function(html) {
        // console.log(html);
        // parsing the html to json
        var json = $.parseJSON(html);
        // loop the json to new card 
        $.each(json, function(i, item) {
          presensiEvents(item.tgl, item.tag);
            
        });

    }
  });

  var newdatebesok = new Date();
  newdatebesok.setDate(newdatebesok.getDate() + 1);
  console.log(newdatebesok);
  var monthbesok = newdatebesok.getUTCMonth() + 1;
  var month2DigitBesok = ("0" + (monthbesok)).slice(-2);
  var daybesok = newdatebesok.getUTCDate();
  var day2DigitBesok = ("0" + (daybesok)).slice(-2);

  var besok = (newdatebesok.getFullYear()+'-'+month2DigitBesok+ '-' + day2DigitBesok);

  //tomorrow = year + "-" + month2Digit + "-" + besok2Digit;
  console.log('tomorrow : '+besok);
  
  defaultEvents(today, 'YEAH!','Today is your day','important');
  defaultEvents(besok, 'Tomorrow!','May tomorrow be more beautiful!!!!','important');
}

//fill sidebar event info
function fillEventSidebar(self) {

  $(".c-aside__event").remove();
  var thisName = self.attr("data-name");
  var thisNotes = self.attr("data-notes");
  var thisImportant = self.hasClass("event--important");
  var thisBirthday = self.hasClass("event--birthday");
  var thisFestivity = self.hasClass("event--festivity");
  var thisPresensi = self.hasClass("event--presensi");
  var thisEvent = self.hasClass("event");
  
  if (thisName) {
    switch (true) {
      case thisPresensi:
        break;
      case thisImportant:
        $(".c-aside__eventList").append(
          "<p class='c-aside__event c-aside__event--important'>" +
          thisName +
          " <span> • " +
          thisNotes +
          "</span></p>"
        );
        break;
      case thisBirthday:
        $(".c-aside__eventList").append(
          "<p class='c-aside__event c-aside__event--birthday'>" +
          thisName +
          " <span> • " +
          thisNotes +
          "</span></p>"
        );
        break;
      case thisFestivity:
        $(".c-aside__eventList").append(
          "<p class='c-aside__event c-aside__event--festivity'>" +
          thisName +
          " <span> • " +
          thisNotes +
          "</span></p>"
        );
        break;
      case thisEvent:
        $(".c-aside__eventList").append(
          "<p class='c-aside__event'>" +
          thisName +
          " <span> • " +
          thisNotes +
          "</span></p>"
        );
        break;
    }
  }

  var tglny = self.attr("data-day");
  var dataString = 'tgl='+ tglny;
  // console.log(dataString);

  $.ajax({
    type: "POST",
    url: "operation/fungsiPresensi.php?op=showpresensi",
    data: dataString,
    cache: false,
    success: function(html) {
        // console.log(html);
        // parsing the html to json
        var json = $.parseJSON(html);
        // loop the json to new card 
        $.each(json, function(i, item) {

          if (item.tag.toLowerCase() == 'presensi') {
            $(".c-aside__eventList").append(
              "<p class='c-aside__event c-aside__event--presensi'>" +
              item.nama + " <span> • " + item.info + "</span><br>" +
              "<i>"+item.desk +"</i>"+
              "</p>"
            );
          } else {
            $(".c-aside__eventList").append(
              "<p class='c-aside__event'>" +
              item.nama + " <span> • " + item.info + "</span><br>" +
              "<i>"+item.desk +"</i>"+
              "</p>"
            );

          }
            
        });

    }
  });

};

dataCel.on("click", function() {
  var thisEl = $(this);
  var thisDay = $(this)
  .attr("data-day")
  .slice(8);
  var thisMonth = $(this)
  .attr("data-day")
  .slice(5, 7);

  // console.log($(this).val());
  
  fillEventSidebar($(this));

  $(".c-aside__num").text(thisDay);
  $(".c-aside__month").text(monthText[thisMonth - 1]);

  dataCel.removeClass("isSelected");
  thisEl.addClass("isSelected");

});

//function for move the months
function moveNext(fakeClick, indexNext) {
  for (var i = 0; i < fakeClick; i++) {
    $(".c-main").css({
      left: "-=100%"
    });
    $(".c-paginator__month").css({
      left: "-=100%"
    });
    switch (true) {
      case indexNext:
        indexMonth += 1;
        break;
    }
  }
}
function movePrev(fakeClick, indexPrev) {
  console.log('Masuk MovePrev : '+fakeClick+' '+indexPrev);
  for (var i = 0; i < fakeClick; i++) {
    $(".c-main").css({
      left: "+=100%"
    });
    $(".c-paginator__month").css({
      left: "+=100%"
    });
    switch (true) {
      case indexPrev:
        indexMonth -= 1;
        break;
    }
  }
}

//months paginator
function buttonsPaginator(buttonId, mainClass, monthClass, next, prev) {
  switch (true) {
    case next:
      $(buttonId).on("click", function() {
        if (indexMonth >= 2) {
          $(mainClass).css({
            left: "+=100%"
          });
          $(monthClass).css({
            left: "+=100%"
          });
          indexMonth -= 1;
        }
        return indexMonth;
      });
      break;
    case prev:
      $(buttonId).on("click", function() {
        if (indexMonth <= 11) {
          $(mainClass).css({
            left: "-=100%"
          });
          $(monthClass).css({
            left: "-=100%"
          });
          indexMonth += 1;
        }
        return indexMonth;
      });
      break;
  }
}

buttonsPaginator("#next", monthEl, ".c-paginator__month", false, true);
buttonsPaginator("#prev", monthEl, ".c-paginator__month", true, false);

//launch function to set the current month
moveNext(indexMonth - 1, false);

//fill the sidebar with current day
$(".c-aside__num").text(day);
$(".c-aside__month").text(monthText[month - 1]);