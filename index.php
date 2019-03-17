<?php
if(!file_exists("config.php")) {
  die("config.php missing. You can use config.default.php as a template.");
}
require_once("config.php");

function isBetween($x, $min, $max) {
  return is_int($x) && ($min <= $x) && ($x <= $max);
}

function escape($input) {
  return htmlspecialchars($input, ENT_QUOTES);
}

function formatWeek($raw) {
  $trimmedWeek = ltrim($raw, 0); //removes all leading 0s
  $paddedWeek = str_pad($trimmedWeek, 2, '0', STR_PAD_LEFT); //adds a leading 0 to single-digit numbers
  return escape($paddedWeek);
}

$date = new DateTime();
$week = $date->format("W");

$firstWeek = 01;
$lastWeek = 53;

if(isset($_GET['w']) && isBetween((int)$_GET['w'], $firstWeek, $lastWeek)) {
  $customWeek = true;
  $currentWeek = $week;

  $week = (int)formatWeek($_GET['w']);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calendar Week <?php echo $week; ?></title>
    <link rel="stylesheet" href="css/style.min.css">
  </head>
  
  <body>
    <header>
      <h1>Week <?php echo $week; ?>.</h1>
        <nav>
          <ul>
            <?php if($week !== $firstWeek) { ?>
              <li><a href="?w=<?php echo $week - 1; ?>">Previous Week</a></li>
            <?php } else { ?>
              <li><span>Previous Week</span>
            <?php } ?>

            <?php if(isset($customWeek) && $week !== $currentWeek) { ?>
              <li><a class="currentWeek" href=".">Current Week</a>
            <?php } else { ?>
              <li><span>Current Week</span>
            <?php } ?>

            <?php if($week !== $lastWeek) { ?>
              <li><a href="?w=<?php echo $week + 1; ?>">Next Week</a>
            <?php } else { ?>
              <li><span>Next Week</span>
            <?php } ?>

            <?php if(!empty($fullCalendar)) { ?>
              <li><a href="<?php echo $fullCalendar; ?>" class="fullCalendar" target="_blank" rel="nofollow noopener noreferrer">Full Calendar</a></li>
            <?php } ?>
          </ul>
        </nav>
    </header>

    <main>
      <iframe src="<?php echo $baseURL . $week . $suffixURL; ?>" referrerpolicy="no-referrer" width="100%" height="730px"></iframe>
    </main>
  </body>
</html>
