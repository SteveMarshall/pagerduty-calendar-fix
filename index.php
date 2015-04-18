<?php
require 'class.iCalReader.php';

$ical = new ical($_GET['feed']);

$new_cal = array();

foreach ($ical->events() as $e) {
  foreach (array('DTSTART', 'DTEND') as $key) {
    $e[$key] = preg_replace('/T\d+Z$/', '', $e[$key]);
  }
  $last_e = end($new_cal);
  if ( $last_e
    && ($last_e['DTEND'] + 1 == $e['DTSTART'])
    && ($last_e['SUMMARY'] == $e['SUMMARY']) ) {
    array_pop($new_cal);
    $e['DTSTART'] = $last_e['DTSTART'];
  }
  $new_cal []= $e;
}

$rendered_cal = array(
  'BEGIN:VCALENDAR',
  'CALSCALE:GREGORIAN',
  'VERSION:2.0',
);
foreach ($new_cal as $e) {
  $rendered_cal []= <<<EOT
BEGIN:VEVENT
UID:{$e['UID']}
TRANSP:TRANSPARENT
SUMMARY:{$e['SUMMARY']}
DTSTART;VALUE=DATE:{$e['DTSTART']}
DTEND;VALUE=DATE:{$e['DTEND']}
URL:{$e['URL']}
SEQUENCE:0
END:VEVENT
EOT;
}

$rendered_cal []= "END:VCALENDAR";

print join("\n", $rendered_cal);