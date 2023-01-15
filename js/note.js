(function($)
{
    /**
     * Auto-growing textareas; technique ripped from Facebook
     *
     * https://github.com/jaz303/jquery-grab-bag/tree/master/javascripts/jquery.autogrow-textarea.js
     */
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;

            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
                'word-wrap': 'break-word'
            }).appendTo(document.body);

            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };

                var val = self.value.replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/&/g, '&amp;')
                                    .replace(/\n$/, '<br/>&nbsp;')
                                    .replace(/\n/g, '<br/>')
                                    .replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });

                // Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
                if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
                    val += '<br />';
                }

                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
                $self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
            }

            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);

            update();
        });
    };
})(jQuery);


var noteTemp =  '<div class="note">'
                +   '<a href="#" onclick="addNoteToDB()" class="button save-btn">Save</a>'
                // +   '<input type="button" class="save-btn" value="Save" onclick="addNoteToDB()">'
				+	'<a href="javascript:;" class="button remove">x</a>'
				+ 	'<div class="note_cnt">'
				+		'<textarea class="title" placeholder="Enter note title"></textarea>'
				+ 		'<textarea class="cnt" placeholder="Enter note description here"></textarea>'
                
				+	'</div> '
				+'</div>';

var noteZindex = 1;

function delNoteID($idnya){
    console.log('hapus : '+$idnya);
    $(this).parent('.note').hide("puff",{ percent: 133}, 250);
};

function deleteNote(){    
    $(this).parent('.note').hide("puff",{ percent: 133}, 250);
};

function newNoteIsi(idreply, tgl, judul, konten) {
    // var note =  '<div class="note">'
    //             +   '<span class="fa fa-bars"></span>  &nbsp;<span>'+tgl+'</span>'
    //             +	'<a href="javascript:delNoteID('+idreply+');" class="button remove">x</a>'
    //             + 	'<div class="note_cnt">'
    //             +		'<textarea class="title" placeholder="Enter note title">'+judul+'</textarea>'
    //             + 		'<textarea class="cnt" placeholder="Enter note description here">'+konten+'</textarea>'
    //             +	'</div> '
    //             +'</div>';

    //             $(note).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
    //             function(){
    //                 $(this).zIndex(++noteZindex);
    //             }
    //             );
    //             $('.remove').click(deleteNote);
    //             $('textarea').autogrow();

    //             $('.note')
	//                 return false; 

    
      
};

function addNoteToDB(){
    var title = $('.title').val();
    var content = $('.cnt').val();
    // var tgl = $('#dateya').val();
    var dataString = 'title='+ title + '&content=' + content;
    $.ajax({
        type: "POST",
        url: "operation/fungsiNote.php?op=addnote",
        data: dataString,
        cache: false,
        success: function(html){
            //reload ??
            document.location.reload(true);

            // var reply = $.parseJSON(html);
            // console.log('sukses add data: '+JSON.stringify(html));
            // console.log('judul: '+reply['judul']);
            
            //newNoteIsi(reply['id'], reply['tgl'], reply['judul'], reply['konten']);
        }
    });

};

function showNote(){
    $.ajax({
        type: "GET",
        url: "operation/fungsiNote.php?op=shownote",
        cache: false,
        success: function(html) {
            // parsing the html to json
            var json = $.parseJSON(html);
            // loop the json to new card 
            $.each(json, function(i, item) {
                var note =  '<div class="note">'
                +   '<span class="fa fa-bars"></span>  &nbsp;<span>'+item.tgl+'</span>'
                +	'<a href="javascript:delNoteID('+item.id+');" class="button remove">x</a>'
                + 	'<div class="note_cnt">'
                +		'<textarea class="title" placeholder="Enter note title">'+item.judul+'</textarea>'
                // +       '<span>'+item.tgl+'</span>'
                + 		'<textarea class="cnt" placeholder="Enter note description here">'+item.konten+'</textarea>'
                +	'</div> '
                +'</div>';
                $(note).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
                function(){
                    $(this).zIndex(++noteZindex);
                }
                );
                $('.remove').click(deleteNote);
                $('textarea').autogrow();
                
            });

        }
    });
};

function newNoteKosong() {
  $(noteTemp).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
    function(){
       $(this).zIndex(++noteZindex);
    });
 
	$('.remove').click(deleteNote);
	$('textarea').autogrow();
	
  $('.note')
	return false; 
};

$(document).ready(function() {
    
    //$("#board").height($(document).height());
    // $("#board").height($(document).height() / 2);
    
    $("#add_new").click(newNoteKosong);
    
    $('.remove').click(deleteNote);
    newNoteKosong();
    showNote();
    return false;
    
});

