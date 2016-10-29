function showsubmenu(elem){    
  var device = navigator.userAgent  
  if (device.match(/Iphone/i)|| device.match(/Ipod/i)|| device.match(/Android/i)|| device.match(/J2ME/i)|| device.match(/BlackBerry/i)|| device.match(/iPhone|iPad|iPod/i)|| device.match(/Opera Mini/i)|| device.match(/IEMobile/i)|| device.match(/Mobile/i)|| device.match(/Windows Phone/i)|| device.match(/windows mobile/i)|| device.match(/windows ce/i)|| device.match(/webOS/i)|| device.match(/palm/i)|| device.match(/bada/i)|| device.match(/series60/i)|| device.match(/nokia/i)|| device.match(/symbian/i)|| device.match(/HTC/i))
   { 
    /*$(elem).children("ul").show();
    $(elem).css({
      height: "107px"
    });
    $(elem).children("span").addClass("aligntop");
    $(".ulsubmenu").css({
      top: "25px"     
    });
    $(".ulsubmenu").children("li").css("background-color", "#ccc");*/
    }
  else
  {
      //$(elem).children("ul").show();  
  }
}

/*function hidesubmenu(elem){
  $(elem).hide();
}*/

$(function () {
    $(".btnReservaPaquete")
        .mouseover(function(event){
            $(".name-hotel-"+event.target.id).addClass("crece-titulo");
        });
    $(".btnReservaPaquete").mouseout(function(event){
        $(".name-hotel-"+event.target.id).removeClass("crece-titulo");
    });
});

function payTour(data) {
    console.info("DATA ** = ", data);
    $.ajax({
        type: 'POST',
        url: $("payTour").val(),
        data: data,   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
        success: function(data){
            console.info("DATA = ", data);
        },
        error: function (error) {
            console.info("ERROR = ", error);
        }
    });
}