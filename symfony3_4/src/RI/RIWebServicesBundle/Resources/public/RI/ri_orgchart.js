/**
* Agregamos el botón full screen en el grafico chart que tiene como finalidad poner la gráfica en modo pantalla completa.
* Usamos la API de full screen de javascript para el modo pantalla completa.
* @param json
*/
function fullScreenButton(){
   var r = $('<div class="buttonFullScreenContainer"><button id="fullScreen" type="button"><i id="fullScreenFontAwesome" class="fa fa-expand" aria-hidden="true"></i></button></div>');

   $("#chart-container").prepend(r);

   $("#chart-container #fullScreen").addClass("buttonFullScreenChart");

   $("#chart-container #fullScreen").click(function () {

       if ($("#chart-container").hasClass("fullScreen"))
       {

           // Salimos del modo full-screen
           if (document.exitFullscreen) {
               document.exitFullscreen();
           } else if (document.webkitExitFullscreen) {
               document.webkitExitFullscreen();
           } else if (document.mozCancelFullScreen) {
               document.mozCancelFullScreen();
           } else if (document.msExitFullscreen) {
               document.msExitFullscreen();
           }

           // Quitamos la clase Full Screen
           $("#chart-container").removeClass("fullScreen");

           $("#chart-container .orgchart").removeClass("orgcgharImage");

           $("#fullScreenFontAwesome").removeClass("fa-compress ");
           $("#fullScreenFontAwesome").addClass("fa-expand");

           $(".buttonFullScreenChart").css("position","initial");

       }
       else{

       $("#chart-container").addClass("fullScreen");

       var i = document.getElementById("chart-container");

       // vamos al modo full screen
       if (i.requestFullscreen) {
           i.requestFullscreen();
       } else if (i.webkitRequestFullscreen) {
           i.webkitRequestFullscreen();
       } else if (i.mozRequestFullScreen) {
           i.mozRequestFullScreen();
       } else if (i.msRequestFullscreen) {
           i.msRequestFullscreen();
       }

       // Cambiamos el icono del boton al salir del modo pantalla completa
       $("#chart-container .orgchart").addClass("orgcgharImage");
       $("#fullScreenFontAwesome").removeClass("fa-expand");
       $("#fullScreenFontAwesome").addClass("fa-compress");

       // Ponemos en posicion fixed para evitar desplazamiento en vertical del boton full screen.
       $(".buttonFullScreenChart").css("position","fixed");

       }

   })
}