# Prototype Configuration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dvxgit-jalonzo/prototype-configuration.svg?style=flat-square)](https://packagist.org/packages/dvxgit-jalonzo/prototype-configuration)
[![Total Downloads](https://img.shields.io/packagist/dt/dvxgit-jalonzo/prototype-configuration.svg?style=flat-square)](https://packagist.org/packages/dvxgit-jalonzo/prototype-configuration)
[![License](https://img.shields.io/packagist/l/dvxgit-jalonzo/prototype-configuration.svg?style=flat-square)](https://packagist.org/packages/dvxgit-jalonzo/prototype-configuration)

A lightweight and flexible Laravel package for managing JSON configuration files with dot notation support. Perfect for runtime configuration management without database overhead.

## Features

- 🚀 Simple and intuitive API
- 🎯 Dot notation support for nested values
- 📝 Read and write JSON configuration files
- 🔄 Batch operations with `setMany()`
- 🗑️ Easy key and array item removal
- ⚡ Zero database dependencies
- 🛡️ Type-safe with modern PHP

## Installation
```bash
composer require dvxgit-jalonzo/prototype-configuration
```

## Quick Start

### 1. Create a JSON configuration file
```bash
touch config/app-settings.json
```
```json
{
  "app": {
    "name": "My Application",
    "version": "1.0.0",
    "maintenance": false
  },
  "features": {
    "newsletter": true,
    "analytics": false
  }
}
```

### 2. Use in your application
```php
use Nrmnalonzo\Prototype\PrototypeConfiguration;

$config = new PrototypeConfiguration('app-settings.json');

// Get values
echo $config->get('app.name'); // "My Application"
echo $config->get('app.maintenance', false); // false (with default)

// Update values
$config->set('app.maintenance', true);
$config->set('features.newsletter', false);
```

## Usage Examples

### Reading Configuration
```php
$config = new PrototypeConfiguration('settings.json');

// Get all configuration as array
$all = $config->all();

// Get specific value with dot notation
$appName = $config->get('app.name');

// Get with default value if key doesn't exist
$debug = $config->get('app.debug', false);

// Get nested values
$emailHost = $config->get('mail.smtp.host');
```

### Writing Configuration
```php
// Set a single value
$config->set('app.name', 'Updated App Name');

// Set multiple values at once (more efficient)
$config->setMany([
    'app.name' => 'My App',
    'app.version' => '2.0.0',
    'features.new_feature' => true,
]);

// Replace entire configuration
$config->replace([
    'app' => [
        'name' => 'Brand New App',
        'version' => '1.0.0'
    ]
]);
```

### Removing Configuration
```php
// Remove a key (supports dot notation)
$config->forget('app.debug');
$config->forget('features.old_feature');

// Remove specific array item by index
$config->forgetArrayItem('users', 0); // removes first user
```

## Real-World Examples

### Feature Flags
```php
$features = new PrototypeConfiguration('features.json');

if ($features->get('dark_mode.enabled')) {
    // Enable dark mode UI
}

// Toggle feature
$features->set('maintenance_mode', true);
```

### Application Settings
```php
$settings = new PrototypeConfiguration('settings.json');

// Update multiple settings
$settings->setMany([
    'timezone' => 'Asia/Manila',
    'locale' => 'en',
    'per_page' => 25,
]);
```

### Dynamic Configuration
```php
$config = new PrototypeConfiguration('runtime.json');

// Track application state
$config->set('last_backup', now()->toDateTimeString());
$config->set('total_users', User::count());
```

## API Reference

| Method | Description |
|--------|-------------|
| `all()` | Get entire configuration as array |
| `get(string $key, mixed $default = null)` | Get value by key (supports dot notation) |
| `set(string $key, mixed $value)` | Set a single value |
| `setMany(array $items)` | Set multiple values at once |
| `replace(array $data)` | Replace entire configuration |
| `forget(string $key)` | Remove a key |
| `forgetArrayItem(string $key, int $index)` | Remove array item by index |

## Requirements

- PHP 8.1, 8.2, or 8.3
- Laravel 11.x or 12.x

## Error Handling

The package throws a `RuntimeException` if the JSON file doesn't exist:
```php
try {
    $config = new PrototypeConfiguration('nonexistent.json');
} catch (RuntimeException $e) {
    // Handle missing file
}
```

## Tips

- **File naming**: You can omit `.json` extension - it's added automatically
```php
  new PrototypeConfiguration('settings'); // Same as 'settings.json'
```

- **Performance**: Use `setMany()` instead of multiple `set()` calls for better performance

- **Validation**: Consider adding validation before writing critical configuration

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security-related issues, please email the author instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Norman Jalonzo](https://github.com/dvxgit-jalonzo)
- [All Contributors](../../contributors)

---

**Made with ❤️ for the Laravel community**