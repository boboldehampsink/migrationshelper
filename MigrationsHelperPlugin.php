<?php

namespace Craft;

/**
 * Migrations Helper Plugin.
 *
 * Plugin that helps you write complex migrations.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Bob Olde Hampsink
 * @license   MIT
 *
 * @link      http://github.com/boboldehampsink
 */
class MigrationsHelperPlugin extends BasePlugin
{
    /**
     * Get plugin name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Migrations Helper');
    }

    /**
     * Get plugin version.
     *
     * @return string
     */
    public function getVersion()
    {
        return '0.5.0';
    }

    /**
     * Get plugin developer name.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }

    /**
     * Get plugin developer url.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://github.com/boboldehampsink';
    }

    /**
     * Load the helpers.
     */
    public function init()
    {
        require_once __DIR__.'/helpers/MigrationsHelper.php';
    }
}
