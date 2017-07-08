<?

session_start();
session_destroy();
session_start();

$rx[] = @file_get_contents("/sys/class/net/wlan0/statistics/rx_bytes");
sleep(1);
$rx[] = @file_get_contents("/sys/class/net/wlan0/statistics/rx_bytes");

$rbps = $rx[1] - $rx[0];

$round_rx=round($rbps/1, 2);

$time=date("Y-m-d H:i:s");
$_SESSION['rx'] = $round_rx;
$data_points['label'] = $time;
$data_points['y'] = $_SESSION['rx'];

echo json_encode([$data_points]);

?>