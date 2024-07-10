<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Just exit for OPTIONS request
    exit(0);
}

// Lanjutkan dengan pengolahan permintaan API
require 'data.php';

// Enum perintah yang valid
$validCommands = [
    'Nyalakan Lampu Merah',
    'Nyalakan Lampu Kuning',
    'Nyalakan Lampu Hijau',
    'Matikan Lampu'
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = getData();

    // Log untuk debugging
    error_log('Data returned from getData(): ' . print_r($data, true));

    // Pastikan struktur respons ini benar
    if (isset($data['command'])) {
        echo json_encode(['command' => $data['command']]);
    } else {
        echo json_encode(['command' => null]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['command']) && in_array($input['command'], $validCommands)) {
        $newData = addData($input['command']);
        echo json_encode($newData);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid input']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>
