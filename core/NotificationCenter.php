<?php
namespace Core;

class NotificationCenter {
    private $observers = [];
    private $observerTypes = [];

    public function attach($observer, $type) {
        $this->observers[] = $observer;
        $this->observerTypes[get_class($observer)] = $type;
    }

    public function detach($observer) {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notify($message, $targets = []) {
        foreach ($this->observers as $observer) {
            if (empty($targets) || in_array($this->observerTypes[get_class($observer)], $targets)) {
                $observer->update($message);
            }
        }
    }
}
