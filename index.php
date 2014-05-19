<?php
require_once("./src/snapchat.php");
// Log in:
$snapchat = new Snapchat('snaps_roulette', 'snaproulette');
$snaps = $snapchat->getSnaps();
$files = glob('./archive'. '/*.*');

echo "<table>";
foreach ($files as $file)
{
		echo "<tr><td>".$file.'</td>'.'<td><img src='.$file." style='width: 100px;'></td>".'</tr>';

}
echo "</table>";

?>

