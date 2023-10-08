<?php
use Blesta\Core\Util\Events\Common\EventInterface;

/**
 * Encrypt Decrypt Plugin Handler
 *
 * This class represents the handler for the Encrypt Decrypt plugin.
 *
 * @link https://blesta.store Blesta Store
 */
class EncryptDecryptPlugin extends Plugin
{
    /**
     * Constructor method
     */
    public function __construct()
    {
        // Load required components for this plugin
        Loader::loadComponents($this, ['Input', 'Record']);

        // Load language files
        Language::loadLang('encrypt_decrypt_plugin', null, dirname(__FILE__) . DS . 'language' . DS);

        // Load configuration from the config.json file
        $this->loadConfig(dirname(__FILE__) . DS . 'config.json');
    }

    /**
     * Performs any necessary setup actions during plugin installation
     *
     * @param int $plugin_id The ID of the plugin being installed
     */
    public function install($plugin_id)
    {
        // Implement any necessary install actions here
    }

    /**
     * Performs any necessary cleanup actions during plugin uninstallation
     *
     * @param int $plugin_id The ID of the plugin being uninstalled
     * @param bool $last_instance True if $plugin_id is the last instance across
     *  all companies for this plugin, false otherwise
     */
    public function uninstall($plugin_id, $last_instance)
    {
        if ($last_instance) {
            // Implement any necessary cleanup actions here
        }
    }
}
