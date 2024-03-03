<?php

function sendFCMNotification($fcmMessage) {
    $accessToken = 'ya29.c.c0AY_VpZg3xGH91Tb6nAO2HeZSLmFzbzwTdvZxPkU6c_qMv-aGbA5GEvvqBqPdt3DYEkq2Jc_EyN3qN9BI97jhNGzwFR_na0zXySlVTxaVz6JDj3tbyGHae37K8j3VEdVLvZQgRM7-bu9zxW1XQWnN7EL6tQJWUKvlNdLUHZjCw-chYH2f4UcxrjzzpMVQzitVObQEXpXKCUGSx_aFrDSK9AzziWeOzVSvVH08qDSFJ4drfg7G_gVnJPslrr0X7DxabrVIMzgMKiSfpnyiY7o5eherfoW3O2ep_ZBQUsafnlyMnkaSZKtiVucY9yZZIJWuGSbBndXcIvQEQ-Qse6XfcDKvcsIPxG2bX5lugHpOmHp41sjsp8Kq-gN383DUpge0jiUzc7ml58yRIc-3df_Q-vpQY_pxY9nI-6RuofOQQVIkaUJF91ktwQlXxxcdm9O8e4J9YJhn9_BxdFJ93nfOb3JVf5a-hkf_WFYkxMqXkfRyyQsJjtb23O7Yhl2jMk5m4X5s9BXIgS1F5FdBc1QXnrWmO_hZyvbxe22FJ7rV8hSI19ko4RR9hXO1ehRjgipMb5gmb6fsZ_h1nvikRpbhVt32bvdbgI_v4JnZU8YQeetqBarb6qgb6W9tup_md1IaFbF-xwUOscgbZpBw3Vs4RJrtwcg8b4yZc1skte-b4SOiqZ4kOrWvlycrg3X0d6swac4n0gY1eWl7qIRQW8IJ68pgtvbIwgjqzWSwoIxVe6ZlzsRt_ian5ow2pJ5mXXJjlUbeklrVzMmhZal_M7V2O0w5hJmU0-ybqfn0l3WwQebXt9X068xevsgZh2t7mWuSs-qxynVkow_XQn9wzmgIZOa2--bk1romy47mav7Zq7veMS_Mn54BMXMyqxOh9jnOFYufaFVoW-UXrzdfmOrJ12O4z2pxB9Zg6rahj1U9uzB_aFbuBcfu2yUkBjOO0fFoOpbozFMi_0ym__1tptQWJcq2getsa2sfxxtwZnfQ5Ydr3pO8ZgfwpnM';
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
