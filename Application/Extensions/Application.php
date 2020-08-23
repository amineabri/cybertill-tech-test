<?php

namespace App\Extensions;

use Laravel\Lumen\Application as App;

/**
 * Class Application
 * @package App\Extensions
 */
class Application extends App
{
    /**
     * @var string
     */
    private $newAppPath       = 'Application';
    private $newConfigPath    = 'Application/config';
    private $newDatabasePath  = 'Domain/database';
    private $newStoragePath   = 'Application/storage';


    /**
     * Get the path to the application "app" directory.
     *
     * @inheritdoc
     * @param  string  $path
     * @return string
     */
    public function path($path = ''): string
    {
        $appPath = $this->newAppPath ?: $this->basePath.DIRECTORY_SEPARATOR.$this->appPath;
        return $appPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.$this->newConfigPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the path to the database directory.
     *
     * @param  string  $path Optionally, a path to append to the database path
     * @return string
     */
    public function databasePath($path = ''): string
    {
        return $this->basePath.DIRECTORY_SEPARATOR.$this->newDatabasePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get the path to the storage directory.
     *
     * @param string $path
     * @return string
     */
    public function storagePath($path = ''): string
    {
        return ($this->storagePath ?: $this->basePath.DIRECTORY_SEPARATOR.$this->newStoragePath).
               ($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
