<?php

namespace App\Http\Middleware;

use Closure;
use Storage;

class CustomConfigMiddleware
{
  // storage
  protected $path = 'system/customConfig.txt';
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
      $customConfig = unserialize(Storage::get($this->path));
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
    return Storage::put($this->path, serialize(array_except(config()->all(), ['customConfig'])));
  }
}
