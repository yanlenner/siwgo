document.oncontextmenu=function(){return!1};var d=new Date,mes=d.getMonth()+1,dia=d.getDate();12==mes&&$("img").attr("src","../../../src/img/bannernav.png"),10==mes&&3==dia&&$("img").attr("src","../../../src/img/bannerodo.png"),8!=mes&&7!=mes||$("img").attr("src","../../../src/img/bannerver.png"),$(window).scroll(function(){$(this).scrollTop()>=155?$("#return-to-top").fadeIn(200):$("#return-to-top").fadeOut(200)}),$("#return-to-top").click(function(){$("body,html").animate({scrollTop:0},500)});