<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class SystemNotification extends Notification
{
    protected $message;
    protected $icon;
    protected $client_id;

    public function __construct($message, $icon, $client_id)
    {
        $this->message = $message;
        $this->icon = $icon;
        $this->client_id = $client_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'icon' => $this->icon,
            'client_id' => $this->client_id, // 🔑 مهم
        ];
    }
}

