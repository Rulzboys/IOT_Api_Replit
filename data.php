<?php

function getData() {
    // Misalnya data diambil dari file
    $filename = 'commands.csv';
    if (file_exists($filename)) {
        $jsonData = file_get_contents($filename);
        $data = json_decode($jsonData, true);
        return $data;
    } else {
        // Jika file tidak ada, kembalikan data default
        return ['command' => 'Matikan Lampu'];
    }
}

function addData($command) {
    // Misalnya data disimpan ke file
    $filename = 'commands.csv';
    $data = ['command' => $command];
    file_put_contents($filename, json_encode($data));
    return $data;
}
?>
