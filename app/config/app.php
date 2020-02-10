return [
  'providers' => [
    App\Providers\LogServiceProvider::class,
  ],
  'aliases' => [
    'MultiLog' => \App\Logging\MultiLog::class,
  ],
];
