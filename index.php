<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Fredags kontroll</title>
</head>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<label for="date">Ange ett datum:</label>
<input type="date" id="date" name="date" required>
<input type="submit" value="Kontrollera">

</form>

<?php

include "namnsdag.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $timestamp = strtotime($date);
    $day = date("l", $timestamp);
    $day_number = date("z", $timestamp) + 1;
    $month = date("n", $timestamp);
    $day_of_month = date("j", $timestamp);
    
    // Justera indexet genom att subtrahera 1 från $day_of_month
    $namnsdagar = $namnsdag[$day_of_month - 1];
    
    echo "<p>$date är en $day.</p>";
    echo "<p>Det är dag $day_number i året.</p>";
    
    if (!empty($namnsdagar)) {
        echo "<p>Namnsdag: " . implode(", ", $namnsdagar) . "</p>";
    } else {
        echo "<p>Ingen namnsdag idag.</p>";
    }

    if ($day == "Friday") {
        echo "<p>Det är fredag! Woohoo!</p>";
        echo "<img class=\"img1\" src=\"https://www.icegif.com/wp-content/uploads/2023/04/icegif-1241.gif\" alt=\"Min fredags gif\">";
    } else {
        echo "<p>Det är inte fredag. Buhu!</p>";
        echo "<img class=\"img2\" src=\"https://media1.giphy.com/media/WTQNh1a0O1TandWdVp/200w.gif?cid=6c09b952xzuej8it6zmgvo8fnraj4cum2jhhwd94ekhux2bw&ep=v1_gifs_search&rid=200w.gif&ct=g\" alt=\"Det är inte fredag gif\">";

        $friday = strtotime("next Friday", $timestamp);
        $diff = ($friday - $timestamp) / (60 * 60 * 24);
        $diff = round($diff); 
        echo "<p>Det är bara $diff dagar kvar till fredag!</p>";
    }

    $month_images = array(
        1 => "IMG/january-wallpaper-4.jpg",
        2 => "IMG/february.jpeg",
        3 => "IMG/mars.jpeg",
        4 => "IMG/april.jpeg",
        5 => "IMG/maj.jpeg",
        6 => "IMG/juni.jpeg",
        7 => "IMG/juli.jpeg",
        8 => "IMG/augusti.jpeg",
        9 => "IMG/september.jpeg",
        10 => "IMG/oktober.jpeg",
        11 => "IMG/november.jpeg",
        12 => "IMG/december.jpeg"
    );

    $month_image = $month_images[$month];

    echo "<p>Månad: <img src=\"$month_image\" alt=\"Bild för månad\"></p>";
}
?>

</body>
</html>
