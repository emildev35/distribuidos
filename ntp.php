#!/usr/bin/php -q
<?php
  // ntp time servers to contact
  // we try them one at a time if the previous failed (failover)
  // if all fail then wait till tomorrow
  $time_servers = array("time.nist.gov",
                        "nist1.datum.com",
                        "time-a.timefreq.bldrdoc.gov",
                        "utcnist.colorado.edu");

  // date and clock programs (change for your system)
  $date_app  = "/bin/date";
  $clock_app = "/sbin/hwclock";

  // a flag and number of servers
  $valid_response = false;
  $ts_count = sizeof($time_servers);

  // time adjustment
  // I'm in California and the clock will be set to -0800 UTC [8 hours] for PST
  // you will need to change this value for your region (seconds)
  $time_adjustment = 0;

  for ($i=0; $i<$ts_count; $i++) {
    $time_server = $time_servers[$i];
    $fp = fsockopen($time_server, 37, $errno, $errstr, 30);
    if (!$fp) {
      echo "$time_server: $errstr ($errno)\n";
      echo "Trying next available server...\n\n";
    } else {
      $data = NULL;
      while (!feof($fp)) {
        $data .= fgets($fp, 128);
      }
      fclose($fp);

      // we have a response...is it valid? (4 char string -> 32 bits)
      if (strlen($data) != 4) {
        echo "NTP Server {$time_server} returned an invalid response.\n";
        if ($i != ($ts_count - 1)) {
          echo "Trying next available server...\n\n";
        } else {
          echo "Time server list exhausted\n";
        }
      } else {
        $valid_response = true;
        break;
      }
    }
  }

  if ($valid_response) {
    // time server response is a string - convert to numeric
    $NTPtime = ord($data{0})*pow(256, 3) + ord($data{1})*pow(256, 2) + ord($data{2})*256 + ord($data{3});

    // convert the seconds to the present date & time
    // 2840140800 = Thu, 1 Jan 2060 00:00:00 UTC
    // 631152000  = Mon, 1 Jan 1990 00:00:00 UTC
    $TimeFrom1990 = $NTPtime - 2840140800;
    $TimeNow = $TimeFrom1990 + 631152000;

    // set the system time
    $TheDate = date("m/d/Y H:i:s", $TimeNow + $time_adjustment);
    $success = exec("$date_app -s \"$TheDate\"");

    // set the hardware clock (optional) - you may want to comment this out
    exec("$clock_app --systohc");

    echo "The server's date and time was set to $success\n";
  } else {
    echo "The system time could not be updated. No time servers available.\n";
  }
?>
