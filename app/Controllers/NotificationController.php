<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Security;

class NotificationController extends Controller
{
    public function saveToken()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $token = $data['fcm_token'];

        // Save the token to the database
        // Assuming you have a logged-in user
        $userId = $_SESSION['user_id'];

        $userModel = new User();
        $userModel->updateUser($userId, $token);

        echo json_encode(['success' => true]);
    }

    public function sendNotificationToUser($userId, $title, $body)
    {
        $userModel = new User();
        $user = $userModel->getUserById($userId);
        $fcmToken = $user[0]['fcm_token'];

        if (!empty($fcmToken)) {
            $response = $this->sendFCMNotification($title, $body, $fcmToken);
            echo "Notification sent. Response: " . $response;
        } else {
            echo "User does not have an FCM token.";
        }
    }

    function sendFCMNotification($title, $body, $fcmToken)
    {
        $serverKey = 'BF67snExbAKukiyj32dVrstE16NomXfL00JkZvuYy1Ugs5MUN2-CBP33RJ4jiuRkI_duC9cUWecTGlX71fr7NYo'; // Replace with your FCM server key

        $data = [
            "to" => $fcmToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "icon" => "icon.png", // Optional, the URL of the icon
                "click_action" => "https://arzanbime.com" // Optional, the URL to open when the notification is clicked
            ]
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }
}
