<?php
class JavaScriptAlertObserver implements ObserverInterface {
    public function update($message) {
        if (is_array($message)) {
            $message = json_encode($message);
        }
        echo "<script>alert('$message');</script>";
    }
}
