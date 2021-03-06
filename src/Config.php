<?php


namespace MoxiworksPlatform;


class Config
{
    private static $url = "https://api.moxiworks.com";
    private static $debug = false;

    /**
     * The Moxi Works Platform base URL. default is 'https://api.moxiworks.com'
     *
     * Modification of this attribute should not be needed unless you are debugging or developing for Moxi Works Platform PHP SDK
     *
     * @param [String] the base url to use when connecting to The Moxi Works Platform
     */
    public static function setUrl($u) {
        static::$url = trim($u);
    }

    /**
     * The Moxi Works Platform base URL. default is 'https://api.moxiworks.com'
     *
     * @return String the base url to use when connecting to The Moxi Works Platform
     */
    public static function getUrl() {
        return static::$url;
    }

    /**
     * Debug Moxi Works Platform Requests. default is 'true'
     *
     * Modification of this attribute should not be needed unless you are debugging or developing for Moxi Works Platform PHP SDK
     *
     * @param [Boolean] whether to print debug information for requests to Moxi Works Platform
     */
    public static function setDebug($d) {
        static::$debug = (is_bool($d) && $d == true);
    }

    /**
     * Debug Moxi Works Platform Requests. default is 'true'
     *
     * @return Boolean whether to print debug information for requests to Moxi Works Platform
     */
    public static function getDebug() {
        return static::$debug;
    }

}