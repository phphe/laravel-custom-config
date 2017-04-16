<?php

namespace App\Http\Middleware;

use Closure;
use Storage;

class CustomConfigMiddleware
{
  // storage
  protected $path = 'system/customConfig.txt';
  public $allowed = ['model', 'site', 'mail'];
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Storage::exists($this->path)) {
      $customConfig = array_only(unserialize(Storage::get($this->path)), $this->allowed);
      $config = config()->all();
      $replaced = array_replace_recursive($config, $customConfig);
      config($replaced);
    }
    config([
      'customConfig' => $this
    ]);
    return $next($request);
  }

  public function save()
  {
    return Storage::put($this->path, serialize(array_only(config()->all(), $this->allowed)));
  }
}
