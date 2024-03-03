<?php

function sendFCMNotification($fcmMessage) {
    $accessToken = 'ya29.c.c0AY_VpZiv4bChtblFLActZ16xAFNcL7TaBByr75SIuCRk8AMGnoZ0LM3zyKkgXWvE0dEPSNWIJCquriv6daQQIE9TkzL7lKugaaziRfi7KSgF1frMnr7nXZqeoGmZuJRAv2rfucDzO6IN_Pi44dwei1-Ubh5kJ2iqNlSSGtyIrVlzwNeaa2QTILd7FGc58zpElc6q3Ld1ez3Js3BGKeCzc7Ckh3z6kupzvL4QAaPknO9pQJ_VajY9d4YfZilEYK752NT-IrZIPRVwcgRM1mJsI_VLGFCrAet77cIeYjDvpdj3081KE5Jgke3tJ1aIDeRG6iDuhlHedICOPeE9rsG27jyVCEiNwrZ0t-Dpf6OxAsMpNBR2ZXrF1lwN384KUzS7I53hoQ2igaeSv0WBB9QgszaxRemfn4w72VJbOSU-5ncuhV14dzOnbdfXapUlo8gpxlx0354i5ndXb1sOl6RywqJwwcrROcbe6jfc6amZFl8';
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
