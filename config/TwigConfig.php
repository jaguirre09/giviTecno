<?php


namespace App\Config;


use Oneago\Arcturus\Core\config\BaseTwigConfig;

/**
 * Class TwigConfig is a basic twig loader
 */
abstract class TwigConfig extends BaseTwigConfig
{
    /**
     * TwigConfig constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->twigAdditions();
    }

    /**
     * Add global variables, functions and extensions to twig
     */
    private function twigAdditions(): void
    {
        // Example custom twig additions
        /*
        $this->templateEngine->addExtension(new TranslationExtension(TranslationConfig::getTranslationConfig()));   // Add extension

        $this->templateEngine->addGlobal("getRequestUri", $_SERVER["REQUEST_URI"]);                                 // Add global Variable

        $this->templateEngine->addFunction(new TwigFunction('getCss', function ($cssFile) {
            return sprintf('/css/%s', ltrim($cssFile, '/'));                                                        // Add function
        }));

        $this->templateEngine->addFilter(new TwigFilter('tester', function(string $param) {                         // Add filter
            return $param;
        }));
        
        $this->templateEngine->addFunction(new TwigFunction('strftime', function (string $format, int $timestamp) {
            return strftime($format, $timestamp);
        }));
        */
    }
}
