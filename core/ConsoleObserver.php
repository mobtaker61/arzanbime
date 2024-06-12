<?php
namespace Core;

class ConsoleObserver implements ObserverInterface {
    public function update($message) {
        if (is_array($message)) {
            $message = print_r($message, true);
        }
        echo "Console: $message\n";
    }
}
