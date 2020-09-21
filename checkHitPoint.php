<?php
    $start = microtime(true);
    date_default_timezone_set('Europe/Moscow');
    const Y_VALUES = [-4, -3, -2, -1, 0, 1, 2, 3, 4];
    const R_VALUES = [1, 2, 3, 4, 5];

    if (isset($_POST['coordinateX'],$_POST['coordinateY'], $_POST['coordinateR'])) {

        $x = $_POST['coordinateX'];
        $y = $_POST['coordinateY'];
        $r = $_POST['coordinateR'];

        if (isValid($x, $y, $r)) {
            echo (
            "<tr>
                <td>" . "Неправильно введенные данные." . "</td>
             </tr>");
            return;
        }

        $result = checkHit($x, $y, $r);
        $time = number_format((microtime(true) - $start) * 1000000, 2, ",", ".") . " мкс";

        echo ("<tr>
        <td>" . $x ."</td>
        <td>" . $y . "</td>
        <td>". $r ."</td>
        <td>" . $result . "</td>
        <td>" . $time . "</td>
      </tr>");
    }

    function isValid($x, $y , $r) {
        if (!is_double($x) || !is_double($y) || !is_double($r)) {
            return false;
        }

        if ($x > 3 || $x < -5) {
            return false;
        }

        if (!in_array($y, Y_VALUES)) {
            return false;
        }

        if (!in_array($r, R_VALUES)) {
            return false;
        }

        return true;
    }

    function checkHit($x, $y , $r) {
        if (hitToCircle($x, $y, $r) || hitToRectangle($x, $y, $r) || hitToTriangle($x, $y, $r)) {
            return "Попадание";
        }
        return "Не попадание";
    }

    function hitToRectangle($x, $y, $r) {
        if ( (-$r <= $x) && ($x <= 0) && (0 <= $y) && ($y <= ($r/2) ) ) {
            return true;
        }
        return false;
    }

    function hitToCircle($x, $y, $r) {
        if ( (0 <= $x) && ($x <= sqrt($r^2 - $y^2)) && (0 <= $y) && ($y <= sqrt($r^2 - $x^2)) ) {
            return true;
        }
        return false;
    }

    function hitToTriangle($x, $y, $r) {
        if ( ((-$y - $r)/2 <= $x) && ($x <= 0) && (-2 * $x - $r <= $y) && ($y <= 0) ) {
            return true;
        }
        return false;
    }
?>