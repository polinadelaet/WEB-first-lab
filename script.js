$(function () {
    $('#checkForm').submit(function (e) {
        var coordinateX = $('#coordinateX').val().trim();
        var coordinateY = $('input[name="coordinateY"]:checked').val();

        if (coordinateX > 3 || coordinateX < -5 || coordinateX === '') {
            e.preventDefault();
            $('#coordinateX').next("div").remove();
            $('#coordinateX').after('<div>This field is required</div>');
        }

        if (coordinateY === undefined) {
            e.preventDefault();
            $('.coordinateYE').next("div").remove();
            $('.coordinateYE').after('<div>This field is required</div>');
        }


    });
});

/*(function () {
   //var el = document.getElementById("coordX");
   var el = document.getElementById("checkForm");



   el.addEventListener('submit', function (e){
       e.preventDefault();
       //var x = document.getElementById("coordX");
       var elements = this.elements;
       var x = elements.coordinateX.value;
       document.getElementById('main').textContent = x;
       alert(x);
   });
})
 */
/*$(document).ready(function() {
   $('#checkForm').submit(function (e) {
       alert("ochko");
       e.preventDefault();
       var coordinateX = $('#coordX').val().trim();
       var coordinateY = $("#coordinateY").val();


       if (coordinateX > 3 || coordinateX < -5 || coordinateX === "") {
           $('#coordX').after('<span class="error">This field is required</span>');
       }
   });
});

 */





