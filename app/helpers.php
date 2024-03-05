<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;

function sendFirebaseNotification($deviceToken, $title, $body, $data = []) {
    try {
        // Lấy đường dẫn tới file firebase-credentials.json từ biến môi trường
        $firebaseCredentialsPath = getenv('FIREBASE_CREDENTIALS');
        // Tạo Factory với ServiceAccount từ file firebase-credentials.json
        $factory = (new Factory)->withServiceAccount(__DIR__.'/../'.$firebaseCredentialsPath);
        $messaging = $factory->createMessaging();

        $message = Messaging\CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body
            ],
            'data' => $data
        ]);

        $messaging->send($message);
        return "Notification sent successfully";
    } catch (\Kreait\Firebase\Exception\MessagingException $e) {
        return "MessagingException: " . $e->getMessage();
    } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
        return "FirebaseException: " . $e->getMessage();
    }
}
