<?php

class Migration
{
    public $name    = false;
    public $driver    = false;
    public $host    = false;
    public $port    = false;
    public $user    = "root";
    public $pass    = "123456";
    public $dbase    = false;
    public $charset    = false;

    public $key = "4F0BC5566E5F27A9FD776E09FA74687F";

    public $bd ;

    public function __construct($opt = [])
    {

        foreach ($opt as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }

        $this->connect();
    }

    public function connect()
    {
        $this->bd = new PDO('mysql:host=localhost;dbname=cota', $this->user, $this->pass);
    }

    public function request($cmd)
    {
        //OBJECT_GET_LOCATIONS
        return json_decode(file_get_contents("https://gtrack.bestsecurity.com/api/api.php?api=server&key=$this->key&cmd=$cmd"));
    }

    public function getFields()
    {
        $fields = [
            "codequipo",
            "id_equipo",
            "fecha_hora",
            "longitud",
            "latitud",
            "velocidad",
            "heading",
            "altitud",
            "satelites",
            "event_id",
            "input",
            "millas",
            "analog_input_1",
            "analog_input_2",
            "analog_output",
            "output",
            "counter_1",
            "counter_2",
            "accuracy",
            /*"field_1",
        "field_2",
        "field_3",
        "field_4",
        "field_5",
        "field_6",
        "field_7",
        "field_8",
        "field_9",
        "field_10",*/
            "fh_server",
            "info"
        ];

        /*
    $fields1 = '[
        "id_equipo"
    ]';
    */
        return $fields;
    }

    public function prepareQuery()
    {

        $f = $this->getFields();

        $values = [];
        foreach ($f as $name) {
            $values[] = ":$name";
        }

        $query =  "INSERT INTO cota.tracks_2023 (" . implode(",", $f) . ") VALUES (" . implode(",", $values) . ")";

        return $query;
    }

    public function save()
    {
        $data = $this->request("OBJECT_GET_LOCATIONS");
        
        $sql = $this->prepareQuery();
        echo "<hr>$sql<hr>";
        $sth = $this->bd->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $data = $data->{"2024000001"};

        $fields = [
            //"id"=> "",
            "codequipo" => "0",
            "id_equipo" => "2024000001",
            "fecha_hora" => $data->dt_tracker,
            "longitud" => $data->lng,
            "latitud" => $data->lat,
            "velocidad" => $data->speed,
            "heading" => $data->angle,
            "altitud" => $data->altitude,
            "satelites" => "0",
            "event_id" => "0",
            "input" => "0",
            "millas" => "0",
            "analog_input_1" => "0",
            "analog_input_2" => "0",
            "analog_output" => "0",
            "output" => "0",
            "counter_1" => "0",
            "counter_2" => "0",
            "accuracy" => "0",
            "field_1" => "0",
            "field_2" => "0",
            "field_3" => "0",
            "field_4" => "0",
            "field_5" => "0",
            "field_6" => "0",
            "field_7" => "",
            "field_8" => "",
            "field_9" => "",
            "field_10" => "",
            "fh_server" => $data->dt_server,
            "info" =>  json_encode($data->params)
        ];

        $values = [];
        $f = $this->getFields();
        foreach ($f as $name) {
            $values[$name] = $fields[$name];
        }
        echo "<br>..." .  count($values);
        print_r($values);
        $sth->execute($values);
    }
}

$m = new Migration();
$m->save();

