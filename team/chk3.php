<?php
function timeToMinutes($time) {
    $parts = explode('.', $time);
    if (count($parts) == 2) {
        $hours = intval($parts[0]);
        $minutes = intval($parts[1]);
        return ($hours * 60) + $minutes;
    }
    return intval($time) * 60;
}

function minutesToTime($minutes) {
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    return sprintf('%d.%02d', $hours, $remainingMinutes);
}

$rowwstatus = [
    ['timetaken' => '2.00'],
    ['timetaken' => '1.45']
];

$totalMinutes = 0;

foreach ($rowwstatus as $time) {
    $totalMinutes += timeToMinutes($time['timetaken']);
}

$totalTime = minutesToTime($totalMinutes);
echo $totalTime; // Output should be 3.45 for 3 hours and 45 minutes
?>
