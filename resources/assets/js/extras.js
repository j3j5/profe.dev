Vue.filter('displayMedia', function(value) {

     if(String(value).match(/.*\.(png|jpe?g|gif)(\?.*)?$/i)) {
         return '<img src="' + IMG_BASE_URL + value + '" alt="' + value + '" class="admin-thumb img-responsive">';
     } else if(String(value).match(/.*\.(pdf|doc|docx)(\?.*)?$/i)) {
         return '<a target="_blank" href="' + FILES_BASE_URL + value + '" class="">' + value + '</a>';
     } else {
         return value;
     }
 });

 Vue.filter('parseCurso', function (value) {
     switch (value) {
         case 1:
             return "1º (Primero)";
         case 2:
             return "2º (Segundo)";
         case 3:
             return "3º (Tercero)";
         default:
             return "error";
     }
 });
