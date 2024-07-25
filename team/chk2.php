<?php
function getMalayalamMonth($date) {
    $malayalam_months = [
        "ചിങ്ങം", "കന്നി", "തുലാം", "വൃശ്ചികം", "ധനു", 
        "മകരം", "കുംഭം", "മീനം", "മേടം", "ഇടവം", 
        "മിഥുനം", "കര്ക്കിടകം"
    ];

    // Convert the Gregorian date to a timestamp
    $timestamp = strtotime($date);

    // Get the year, month, and day of the Gregorian date
    $gregorian_year = date("Y", $timestamp);
    $gregorian_month = date("m", $timestamp);
    $gregorian_day = date("d", $timestamp);

    // Calculate the Malayalam year
    $malayalam_year = $gregorian_year - 825;

    // Calculate the Malayalam month and day
    $malayalam_month = 0;
    if ($gregorian_month < 5 || ($gregorian_month == 5 && $gregorian_day < 15)) {
        $malayalam_year--;
        $malayalam_month = $gregorian_month + 8;
        if ($malayalam_month > 12) {
            $malayalam_month -= 12;
        }
    } else {
        $malayalam_month = $gregorian_month - 4;
    }

    return $malayalam_months[$malayalam_month - 1];
}

// Example usage
$date = "2008-09-15";
echo "The Malayalam month for the date $date is: " . getMalayalamMonth($date);
?>
