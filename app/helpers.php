<?php

function sendFCMNotification($accessToken, $fcmMessage) {
    $url = 'https://fcm.googleapis.com/v1/projects/appdemo-c1dfb/messages:send';

    // Headers
    $headers = [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmMessage));

    // Execute cURL session and fetch response
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        // Handle cURL error
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ['success' => false, 'error' => $error_msg];
    }

    // Close cURL session
    curl_close($ch);

    // Decode JSON response
    $decodedResponse = json_decode($response, true);

    return ['success' => true, 'response' => $decodedResponse];
}
