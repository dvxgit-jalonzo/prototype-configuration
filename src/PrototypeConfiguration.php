<?php

namespace Nrmnalonzo\Prototype;

use Illuminate\Support\Facades\File;
use RuntimeException;

class PrototypeConfiguration
{
    protected string $path;

    /**
     * @param string $filename  Example: 'prototype.json'
     */
    public function __construct(string $filename)
    {
        // Normalize filename
        if (! str_ends_with($filename, '.json')) {
            $filename .= '.json';
        }

        $this->path = config_path($filename);

        if (! File::exists($this->path)) {
            throw new RuntimeException("{$filename} does not exist in config directory.");
        }
    }

    /**
     * Get full JSON as array
     */
    public function all(): array
    {
        return json_decode(File::get($this->path), true) ?? [];
    }

    /**
     * Get value (dot notation supported)
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return data_get($this->all(), $key, $default);
    }

    /**
     * Set or update a value
     */
    public function set(string $key, mixed $value): void
    {
        $data = $this->all();
        data_set($data, $key, $value);
        $this->write($data);
    }

    /**
     * Set multiple keys at once (dot notation supported)
     */
    public function setMany(array $items): void
    {
        $data = $this->all();

        foreach ($items as $key => $value) {
            data_set($data, $key, $value);
        }

        $this->write($data);
    }

    /**
     * Replace entire JSON file
     */
    public function replace(array $data): void
    {
        $this->write($data);
    }

    /**
     * Remove a key
     */
    public function forget(string $key): void
    {
        $data = $this->all();
        data_forget($data, $key);
        $this->write($data);
    }

    public function forgetArrayItem(string $key, int $index): void
    {
        $array = $this->get($key, []);
        unset($array[$index]);
        $this->set($key, array_values($array));
    }

    /**
     * Persist changes
     */
    protected function write(array $data): void
    {
        File::put(
            $this->path,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
