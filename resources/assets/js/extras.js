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
