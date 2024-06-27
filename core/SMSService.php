<?php
namespace Core;

class SMSService {
    public function update($message) {
        $phoneNumber = $_SESSION['phoneNumber'];
        $this->sendSMS($phoneNumber, $message);
    }

    private function sendSMS($phoneNumber, $message) {
        // Replace with actual SMS sending logic
        $url = "https://sms-service-provider.com/send?phone=$phoneNumber&message=" . urlencode($message);
        file_get_contents($url); // Example using file_get_contents, you can use cURL or other methods
    }
}
