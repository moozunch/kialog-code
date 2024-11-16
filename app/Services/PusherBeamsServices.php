<?php

namespace App\Services;

use Pusher\PushNotifications\PushNotifications;

class PusherBeamsService
{
  protected $beams;

  public function __construct()
  {
    $this->beams = new PushNotifications([
      'instanceId' => env('PUSHER_BEAMS_INSTANCE_ID'),
      'secretKey' => env('PUSHER_BEAMS_SECRET_KEY'),
    ]);
  }

  public function sendNotification($userId, $title, $body)
  {
    return $this->beams->publishToUsers(
      [$userId], // User IDs for Beams
      [
        'web' => ['notification' => ['title' => $title, 'body' => $body]],
        'fcm' => ['notification' => ['title' => $title, 'body' => $body]],
        'apns' => ['aps' => ['alert' => ['title' => $title, 'body' => $body]]],
      ]
    );
  }
}
