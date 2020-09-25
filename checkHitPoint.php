<?php
    session_start();

    $start = microtime(true);
    date_default_timezone_set('Europe/Moscow');
    const Y_VALUES = [-4, -3, -2, -1, 0, 1, 2, 3, 4];
    const R_VALUES = [1, 2, 3, 4, 5];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $x = $_POST['coordinateX'];
        $y = $_POST['coordinateY'];
        $r = $_POST['coordinateR'];

        if (is_numeric($x) && is_numeric($y) && is_numeric($r)) {
            $x = floatval($x);
            $y = intval($y);
            $r = intval($r);

            if (isValid($x, $y, $r)) {
                $result = checkHit($x, $y, $r);
                $duration = number_format((microtime(true) - $start) * 1000000, 2, ",", ".") . " мкс";
                $time = date("H:i:s");

                $receivedData = ("<tr>
                        <td>" . $x . "</td>
                        <td>" . $y . "</td>
                        <td>" . $r . "</td>
                        <td>" . $result . "</td>
                        <td>" . $duration . "</td>
                        <td>"  . $time . "</td>
                       </tr>");

                if (!isset($_SESSION['dataHistory'])) {
                    $_SESSION['dataHistory'] = array();
                }

                array_push($_SESSION['dataHistory'], $receivedData);

                echo ($receivedData);
            } else echo("<tr>
                        <td>" . "Неправильно введенные данные." . "</td>
                        <td>" . "Х - число от -5 до 3. Y - число из набора: -4, -3, -2, -1, 0, 1, 2, 3, 4. 
                        R - число из набора: 1, 2, 3, 4, 5." . "</td>
                    </tr>");
            return;
        } else {echo("<tr>
                        <td>" . "Координаты X, Y, а также параметр R - числа. Введите правильные данные." . "</td>
                      </tr>");
        return;}
    }



    function isValid($x, $y, $r) {
        if ($x > 3 || $x < -5) {
            return false;
        }

        if (!in_array($y,Y_VALUES, true)) {
            return false;
        }

        if (!in_array($r,R_VALUES, true)) {
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
        if ( (0 <= $x) && (pow($x, 2) <= (pow($r,2) - pow($y,2))) && (0 <= $y) ) {
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
