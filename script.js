$(function () {

    var timeNode = document.getElementById('time-node');

    function getCurrentTimeString() {
        return new Date().toTimeString().replace(/ .*/, '');
    }

    setInterval(
        () => timeNode.innerHTML = getCurrentTimeString(),
        1000
    );

    $('#checkForm').submit(function (e) {

        /*var coordinateX = $('#coordinateX').val();
        var coordinateY = $('input[name="coordinateY"]:checked').val();

        $('.coordinateYE').next("div").remove();
        $('#coordinateX').next("div").remove();

        if (isNaN((coordinateX - 0)) || coordinateX > 3 || coordinateX < -5 || coordinateX === '') {
            e.preventDefault();
            if (coordinateY === undefined) {
                $('.coordinateYE').after('<div>Неверные данные</div>');
            }
            $('#coordinateX').after('<div>Неверные данные</div>');
            return;
        }

        if (coordinateY === undefined) {
            e.preventDefault();
            $('.coordinateYE').after('<div>Неверные данные</div>');
            return;
        }*/


        e.preventDefault();
        $.ajax({
            url: 'checkHitPoint.php',
            type: "POST",
            data: $('#checkForm').serialize(),
            success: function (response) {
                $(response).insertAfter($("tr:last"));
            },
            error: function(response) { // Данные не отправлены
                alert("о оу");
            }
        });
    });
});
