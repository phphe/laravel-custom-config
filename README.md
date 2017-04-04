# laravel-custom-config
JUST one file! a simple middleware to load and save custom config.

# Install
1 put CustomConfigMiddleware.php to your Middleware dir
2 use it as a middleware. You can put it in global, or middleware group, or some routes.

# Config
It uses default storage drive to save config to a file(default: 'system/customConfig.txt'). You can change the path or driver, it is easy.

# Usage
It will load custom config file and merge it to default config. Use it like default config.

# Save
It will put the instance of CustomConfigMiddleware to config root with key 'customConfig'. So use config('customConfig') to get instance, and config('customConfig')->save() to save config to file.
