<?php


namespace App\Config;

use Dotenv\Dotenv;

class DotEnvConfig
{
    private Dotenv $dotenv;
    private array $vars;

    /**
     * dotEnvConfig constructor.
     */
    public function __construct()
    {
        // Start dotenv
        $this->dotenv = Dotenv::createImmutable(__DIR__ . "/..");
        $this->vars = $this->dotenv->load();
    }

    public function initConfigs(): void
    {
        $this->dotenv->required("DEBUG_MODE")->allowedValues(["1", "0"]);
        $this->dotenv->required(["EDITOR_COMMAND"])->allowedValues(["sublime", "textmate", "emacs", "macvim", "phpstorm", "idea", "vscode", "atom", "espresso"])->notEmpty();
        $this->dotenv->required([
            "PRODUCTION_DB_ADAPTER",
            "APP_NAME",
            "PRODUCTION_DB_HOST",
            "PRODUCTION_DB_NAME",
            "PRODUCTION_DB_USER",
            "PRODUCTION_DB_PASS",
            "PRODUCTION_DB_PORT",
            "DEBUG_DB_ADAPTER",
            "DEBUG_DB_HOST",
            "DEBUG_DB_NAME",
            "DEBUG_DB_USER",
            "DEBUG_DB_PASS",
            "DEBUG_DB_PORT",
            "DOCKER_DB_ADAPTER",
            "DOCKER_DB_HOST",
            "DOCKER_DB_NAME",
            "DOCKER_DB_USER",
            "DOCKER_DB_PASS",
            "DOCKER_DB_PORT",
        ]);
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }
}