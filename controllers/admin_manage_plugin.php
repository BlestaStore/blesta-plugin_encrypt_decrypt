<?php
/**
 * AdminManagePlugin Controller
 *
 * This controller handles the management of the Encrypt/Decrypt plugin.
 * It allows users to perform encryption and decryption actions.
 *
 * @link https://blesta.store Blesta Store
 */
class AdminManagePlugin extends AppController
{
    /**
     * Initialize the controller
     */
    private function init()
    {
        // Load necessary models and configure company ID
        Loader::loadModels($this, ['Companies']);
        $this->company_id = Configure::get('Blesta.company_id');

        //Load Language file
        Language::loadLang('admin_manage_plugin', null, PLUGINDIR . 'encrypt_decrypt' . DS . 'language' . DS);

        // Require user login, set view, and structure
        $this->parent->requireLogin();
        $this->view->setView(null, 'EncryptDecrypt.default');
        $this->parent->structure->set('page_title');
        $this->uses(['PluginManager']);
    }

    /**
     * Main action for managing the plugin
     */
    public function index()
    {
        // Initialize the controller
        $this->init();
        $this->uses(['Settings', 'Plugins', 'Services']);

        // Get company ID and plugin ID from request
        $this->company_id = Configure::get('Blesta.company_id');
        $plugin_id = isset($this->get[0]) ? $this->get[0] : null;

        // Get post data
        $vars = $this->post;

        // Check if POST data is present
        if (!empty($this->post)) {
            // Determine the action based on POST data
            $action = isset($this->post['encrypt_text']) ? 'encrypt' : (isset($this->post['decrypt_text']) ? 'decrypt' : null);
            $data = $action === 'encrypt' ? $this->post['encrypt_text'] : ($action === 'decrypt' ? $this->post['decrypt_text'] : null);

            // Check if both action and data are present
            if (!empty($action) && !empty($data)) {
                // Perform encryption or decryption based on the action
                if ($action === 'encrypt') {
                    $result = $this->Services->systemEncrypt($this->post['encrypt_text']);
                } elseif ($action === 'decrypt') {
                    $result = $this->Services->systemDecrypt($this->post['decrypt_text']);
                }

                // Display success message
                $this->parent->flashMessage('message', "Data: $result");

            } else {
                // Display an error message for missing or invalid data
                $this->parent->flashMessage('error', Language::_('AdminManagePlugin.error', true));
            }

            // Redirect or perform other actions as needed
            $this->redirect($this->base_uri . 'settings/company/plugins/manage/' . $plugin_id . '/');
        }

        // Return the view with variables
        return $this->partial('admin_manage_plugin', compact('vars'));
    }
}
