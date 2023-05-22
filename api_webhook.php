<?
    // store GET and POST arrays as JSON strings to webhook_log.txt file
    $json_GET = json_encode($_GET);
    $json_POST = json_encode($_POST);
    
    file_put_contents('webhook_log.txt', 'GET array: '.$json_GET, FILE_APPEND);
    file_put_contents('webhook_log.txt', "\r\n", FILE_APPEND);
    file_put_contents('webhook_log.txt', 'POST array: '.$json_POST, FILE_APPEND);
    file_put_contents('webhook_log.txt', "\r\n", FILE_APPEND);
    
    // get webhook data from GET
    $username = $_GET['username'];
    $name = $_GET['name'];
    $imei = $_GET['imei'];
    $type = $_GET['type'];
    $desc = $_GET['desc'];
    $marker_name = @$_GET['marker_name'];
    $route_name = @$_GET['route_name'];   
    $zone_name = @$_GET['zone_name'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $speed = $_GET['speed'];
    $altitude = $_GET['altitude'];
    $angle = $_GET['angle'];
    $dt_server = $_GET['dt_server'];
    $dt_tracker = $_GET['dt_tracker'];
    $tr_model = $_GET['tr_model'];
    $vin = $_GET['vin'];
    $plate_number = $_GET['plate_number'];    
    $sim_number = @$_GET['sim_number'];    
    $driver_name = $_GET['driver_name'];
    $trailer_name = $_GET['trailer_name'];
    $odometer = $_GET['odometer'];
    $eng_hours = $_GET['eng_hours'];
    
     // get webhook data from POST
    $username = $_POST['username'];
    $name = $_POST['name'];
    $imei = $_POST['imei'];
    $type = $_POST['type'];
    $desc = $_POST['desc'];
    $marker_name = @$_POST['marker_name'];
    $route_name = @$_POST['route_name'];
    $zone_name = @$_POST['zone_name'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $speed = $_POST['speed'];
    $altitude = $_POST['altitude'];
    $angle = $_POST['angle'];
    $dt_server = $_POST['dt_server'];
    $dt_tracker = $_POST['dt_tracker'];
    $tr_model = $_POST['tr_model'];
    $vin = $_POST['vin'];
    $plate_number = $_POST['plate_number'];    
    $sim_number = @$_POST['sim_number'];    
    $driver_name = $_POST['driver_name'];
    $trailer_name = $_POST['trailer_name'];
    $odometer = $_POST['odometer'];
    $eng_hours = $_POST['eng_hours'];
    $params = $_POST['params'];
?>