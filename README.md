# Prototype Configuration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dvxgit-jalonzo/prototype-configuration.svg?style=flat-square)](https://packagist.org/packages/dvxgit-jalonzo/prototype-configuration)
[![Total Downloads](https://img.shields.io/packagist/dt/dvxgit-jalonzo/prototype-configuration.svg?style=flat-square)](https://packagist.org/packages/dvxgit-jalonzo/prototype-configuration)

A lightweight and flexible Laravel package for managing JSON configuration files with dot notation support.

## Installation
```bash
composer require dvxgit-jalonzo/prototype-configuration
```

## Usage

### Basic Example
```php
use Nrmnalonzo\Prototype\PrototypeConfiguration;

// Initialize with JSON file in config directory
$config = new PrototypeConfiguration('prototype.json');

// Get all configuration
$all = $config->all();

// Get specific value with dot notation
$value = $config->get('app.name');
$value = $config->get('app.debug', false); // with default

// Set a value
$config->set('app.name', 'My App');

// Set multiple values at once
$config->setMany([
    'app.name' => 'My App',
    'app.version' => '1.0.0',
]);

// Replace entire configuration
$config->replace([
    'app' => ['name' => 'New App'],
]);

// Remove a key
$config->forget('app.debug');

// Remove array item by index
$config->forgetArrayItem('users', 0);
```

### Setup

1. Create a JSON file in your `config` directory:
```bash
touch config/prototype.json
```

2. Add your configuration:
```json
{
  "app": {
    "name": "My Application",
    "version": "1.0.0"
  },
  "features": {
    "enabled": true
  }
}
```

3. Use it in your application:
```php
$config = new PrototypeConfiguration('prototype');
echo $config->get('app.name'); // "My Application"
```

## Requirements

- PHP ^8.1|^8.2|^8.3
- Laravel ^11.0|^12.0

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
```

---

## **3. Create `LICENSE.md` (or `LICENSE`)**
```
MIT License

Copyright (c) 2025 Norman Jalonzo

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## **4. Optional: Create `.gitattributes`**
```
* text=auto

/.github export-ignore
/tests export-ignore
.gitattributes export-ignore
.gitignore export-ignore
phpunit.xml export-ignore
```

---

## **5. File Structure (Final)**
```
prototype-configuration/
├── src/
│   └── PrototypeConfiguration.php
├── .gitattributes
├── .gitignore
├── composer.json
├── LICENSE.md
└── README.md