<?php

function showCurrentMonth($currentMonth,$year)
{
    $date = mktime(12,0,0,$currentMonth,1,$year);
    $numberOfDays = cal_days_in_month(CAL_GREGORIAN,$currentMonth,$year);
    $offset = date("w", $date);    
    $offset--;
    $rowNumber = 1;
    //Рисуем шапку месяца
    echo "<table><br/>";
    echo "<tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td></tr> <tr>";
    //Печатаем дополнительную запись td, если месяц не начинается с понедельника
    for ($i=1; $i <= $offset ; $i++) { 
        echo "<td></td>";
    }
    // Печатаем числа
    for ($day=1; $day <= $numberOfDays ; $day++) { 
     if (($day + $offset - 1) % 7 == 0 && $day != 1) {
        echo "</tr> <tr>";
        $rowNumber ++;
     }
     echo "<td>".$day."</td>";
    }
    while (($day + $offset) <= $rowNumber * 7) {
        echo "<td> </td>";
        $day++;
    }
    echo "</tr></table>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <section>
    <form action="" method="POST" name="calendar-form">
        <label>Месяц (0-12)</label>
        <input type="number" name="month" data-min="1" data-max="12"/><br><br>
        <label>Год (2000-2050)</label>
        <input type="number" name="year" data-min="2000" data-max="2050"/><br><br>
        <button type="submit" name="add" >Set Date</button>
    </form><br>
    <?php 
    if (!empty($_POST['month']) && !empty($_POST['year'])){    
        if ($_POST['month'] < 1 || $_POST['month'] > 12) {
            echo "Ошибка ввода месяца";
        } 
        else if ($_POST['year'] < 2000 || $_POST['year'] > 2050) {
            echo "Ошибка ввода года";
        } 
        else {
            $setmonth = $_POST['month'];
            $setyear = $_POST['year'];         
            showCurrentMonth($setmonth , $setyear);
        }
    }          
    ?>
    </section>
</body>
</html>