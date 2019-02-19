<?php
require_once("config.php");

function isBetween($x, $min, $max) {
  return (!is_numeric($x) || ($min > $x) || ($x > $max)) ? false : true;
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

$firstWeek = '01';
$lastWeek = '53';

if(isset($_GET['w']) && isBetween($_GET['w'], $firstWeek, $lastWeek)) {
  $customWeek = true;
  $currentWeek = $week;

  $week = formatWeek($_GET['w']);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calendar Week <?php echo $week; ?></title>
    <style>
    p {
      margin: 0;
    }
    a {
      text-decoration: none;
    }
    .currentWeek {
      font-weight: bold;
    }
    </style>
  </head>
  <body>
    <p>
      <span>Week <?php echo $week; ?>.</span> |

      <?php if($week !== $firstWeek) { ?>
        <a href="?w=<?php echo $week - 1; ?>">Previous Week</a>
      <?php } else { ?>
        <span>Previous Week</span>
      <?php } ?> |

      <?php if(isset($customWeek) && $week !== $currentWeek) { ?>
        <a class="currentWeek" href=".">Current Week</a>
      <?php } else { ?>
        <span>Current Week</span>
      <?php } ?> |

      <?php if($week !== $lastWeek) { ?>
        <a href="?w=<?php echo $week + 1; ?>">Next Week</a>
      <?php } else { ?>
       <span>Next Week</span>
     <?php } ?>
    </p>

    <iframe src="<?php echo $baseURL . $week . $suffixURL; ?>" referrerpolicy="no-referrer" width="100%" height="730px"></iframe>
  </body>
</html>
