<?php


namespace MoxiworksPlatform;

use GuzzleHttp\Tests\Psr7\Str;
use MoxiworksPlatform\Exception\ArgumentException;
use MoxiworksPlatform\Exception\InvalidResponseException;
use Symfony\Component\Translation\Tests\StringClass;


class Brand extends Resource {
    /**
     * @var string URL to logo for the company
     */
    public $image_logo;

    /**
     * @var string HTML hexadecimal color code of the presentation accent color for the company
     */
    public $cma_authoring_color;

    /**
     * @var string HTML hexadecimal color code of the background color for the company
     */
    public $background_color;

    /**
     * @var string HTML hexadecimal color code of the background font color for the company
     */
    public $background_font_color_primary;

    /**
     * @var string HTML hexadecimal color code of the background color for buttons displayed
     */
    public $button_background_color;

    /**
     * @var string HTML hexadecimal color code of the font color for buttons displayed
     */
    public $button_font_color;

    /**
     * @var string copyright declaration for the company. This could include embedded HTML and so should be rendered as if it did.
     */
    public $copyright;

    /**
     * @var string HTML the display name for the company as to be presented to end users
     */
    public $display_name;

    /**
     * @var string HTML hexadecimal color code of the background color of email elements for the company
     */
    public $email_element_background_color;

    /**
     * @var string URL to a logo suitable for placement on a white background (i.e. printing)
     */
    public $image_cma_pdf_logo_header;

    /**
     * @var string URL to a logo suitable for placement over the company's email element background color
     */
    public $image_email_logo_alt;

    /**
     * @var string URL to a favicon image
     */
    public $image_favicon;

    /**
     * @var string URL to a logo suitable for placement over $pres_block_background_color
     */
    public $image_pres_cover_logo;

    /**
     * @var string HTML hexadecimal color code of the background color for the company used in block elements of the company's presentations
     */
    public $pres_block_background_color;

    /**
     * @var string HTML hexadecimal color code of a text color suitable for placement over $pres_block_background_color
     */
    public $pres_block_text_color;


    /**
     * Brand constructor.
     * @param array $data
     */
    function __construct(array $data) {
        foreach($data as $key => $val) {
            if(property_exists(__CLASS__,$key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Find a Brand on Moxi Works Platform.
     *
     * find can be performed including the Moxi Works Company ID in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Brand::find([moxi_works_company_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id *REQUIRED* </b>The Moxi Works Company ID
     *
     *
     * @return Brand|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    public static function find($attributes=[]) {
        $url = Config::getUrl() . "/api/brands/" . $attributes['moxi_works_company_id'];
        return Brand::sendRequest('GET', $attributes, $url);
    }

    /**
     * Search for Brands by Agent ID on Moxi Works Platform.
     *
     * search can be performed by including moxi_works_company_id and updated_since in a parameter array
     *  <code>
     *  \MoxiworksPlatform\Brand::search([moxi_works_agent_id: 'abc123'])
     *  </code>
     * @param array $attributes
     *       <br><b>moxi_works_company_id  </b> string The Moxi Works Company ID for the company in which we are searching for brands
     *       <br><b>moxi_works_agent_id  </b> string The Moxi Works Agent ID for the agent in which we are searching for brands
     *
     *       <h2>
     *     optional Task search parameters
     * </h2>
     *       <br><b>updated_since </b> integer  Unix timestamp representing the start time for the search. If no <i>updated_since</i> parameter is included in the request, only agents updated in the last seven days will be included in the response.
     *
     * @return Brand|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws ArgumentException if at least one search parameter is not defined
     * @throws RemoteRequestFailureException
     */
    public static function search($attributes=[]) {
        return Brand::sendRequest('GET', $attributes);
    }


    /**
     * @param $method
     * @param array $opts
     * @param null $url
     *
     * @return Brand|null
     *
     * @throws ArgumentException if required parameters are not included
     * @throws RemoteRequestFailureException
     */
    private static function sendRequest($method, $opts=[], $url=null) {
        if($url == null) {
            $url = Config::getUrl() . "/api/brands";
        }
        $required_opts = array('moxi_works_company_id');
        if(count(array_intersect(array_keys($opts), $required_opts)) != count($required_opts))
            throw new ArgumentException(implode(',', $required_opts) . " required");
        $brand = null;
        $json = Resource::apiConnection($method, $url, $opts);
        $brand = (!isset($json) || empty($json)) ? null : new Brand($json);
        return $brand;
    }
}