    $(document).on('ready',function(){

     $("#nav-mobile").on('click',function(){

     $(".subMenu ul").removeAttr('style');

      $('#menuL').slideToggle();

     })

     $("ul").on('click',function(p){

     p.stopPropagation();

    });

     

    $(".subMenu").on('click',function(){

$(this).children("ul").slideToggle();

    })

$(window).resize(function() {

 var estilo=$(".movil").css("display")  

if(estilo == 'none')

 {  $(".menu").css("display","block");

}

else{

     $(".menu").css("display","none");

}

  $(".subMenu ul").removeAttr('style');

});


/*
$('#read-left1 p').expander({
      slicePoint: 100, // si eliminamos por defecto es 100 caracteres
      expandText: '<p class="lectura">Leer más</p>', // por defecto es 'read more...'
      collapseTimer: 5000, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
      userCollapseText: '<p class="lectura">Leer menos</p>', // por defecto es 'read less...'
 });


$.fn.truncate = function(options) {
  $(this).append('<span class="truncate_lh" style="display:none;">&nbsp;</span>')

  var defaults = {
    maxlines: 2,
    moreText: 'Leer más',
    lessText: 'Leer menos',
    ellipsis: '...'
  };

  $.extend(options, {
    lineheight: ($('.truncate_lh').css('height').replace('px', ''))
  });
  $.extend(options, {
    maxheight: (options.maxlines * options.lineheight)
  });
  options = $.extend(defaults, options);

  return this.each(function() {
    var text = $(this);

    if (text.height() > options.maxheight) {
      
      text.css({
        'overflow': 'hidden',
        'height': options.maxheight + 'px'
      });

      var link = $('<a href="#" class="lectura">' + options.moreText + '</a>');
      var wrapDiv = $('<div class="truncate_wrap" />');

      text.wrap(wrapDiv);
      text.after(link);

      link.click(function() {
        if (link.text() == options.moreText) {
          link.text(options.lessText);
          text.css('height', 'auto');
        } else {
          link.text(options.moreText);
          text.css('height', options.maxheight + 'px');
        }
        return false;
      });
    }
  });
};


$('#read-left').truncate( {  
    maxlines: 2
  });  */
$("#btnleermas").on('click',function(){
  $(".publireportaje").fadeOut("fast", function(){
    $("#contenedorreportajeb").fadeIn("fast").show();  
})
})
$("#btnleermenos").on('click',function(){
  $(".publireportajeb").fadeOut("fast", function(){
    $(".publireportaje").fadeIn("fast").show();  
})
})

});