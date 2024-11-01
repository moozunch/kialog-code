<?php

namespace App\Providers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton(StorageClient::class, function ($app) {
      $firebaseCredentials = config('firebase.firebase_credentials');
      return new StorageClient([
        'keyFilePath' => $firebaseCredentials,
      ]);
    });
  }
}
