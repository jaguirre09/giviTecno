<?php


namespace App\Config;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsConfig
{

    private array $vars;

    /**
     * WhoopsConfig constructor.
     * @param array $vars
     */
    public function __construct(array $vars)
    {
        // Start whoops
        $this->vars = $vars;
        $whoops = new Run;

        // Configure the PrettyPageHandler:
        $errorPage = new PrettyPageHandler();
        $errorPage->setPageTitle("{$_ENV['APP_NAME']} app is broken!"); // Set the page's title
        $errorPage->setEditor($_ENV["EDITOR_COMMAND"]);                    // Set the editor used for the "Open" link
        $this->blackList($errorPage);

        $whoops->pushHandler($errorPage);
        $whoops->register();
    }

    private function blackList(PrettyPageHandler $pageHandler)
    {
        foreach ($this->vars as $key => $var) {
            $pageHandler->blacklist("_SERVER", $key);
            $pageHandler->blacklist("_ENV", $key);
        }
        $pageHandler->blacklist("_ENV", "DB_HOST");
        $pageHandler->blacklist("_ENV", "DB_NAME");
        $pageHandler->blacklist("_ENV", "DB_USER");
        $pageHandler->blacklist("_ENV", "DB_PASS");
    }
}