<?php
/**
 * Encrypt Decrypt parent controller
 *
 * This is a parent controller for encryption and decryption related functionality.
 *
 * @link https://blesta.store Blesta Store
 */
class EncryptDecryptController extends AppController
{
    /**
     * Pre-action method
     *
     * This method is executed before the main action of the controller.
     * It sets up the default view, checks for login, and loads language files.
     */
    public function preAction()
    {
        // Set the default view directory
        $this->structure->setDefaultView(APPDIR);

        // Call the parent's preAction method
        parent::preAction();

        // Set the view to "default"
        $this->view->view = "default";

        // Require the user to be logged in
        $this->requireLogin();

        // Load language files for this controller
        Language::loadLang(
            [Loader::fromCamelCase(get_class($this))],
            null,
            dirname(__FILE__) . DS . 'language' . DS
        );
        Language::loadLang(
            'encrypt_decrypt_controller',
            null,
            dirname(__FILE__) . DS . 'language' . DS
        );
    }
}
