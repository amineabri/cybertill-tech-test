<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ApiDocumentationController
 * @package App\Http\Controllers
 */
class ApiDocumentationController extends Controller
{
    /** @var Yaml $yamlParser */
    private $yamlParser;

    /**
     * ApiDocumentationController constructor.
     * @param Yaml $yamlParser
     */
    public function __construct(Yaml $yamlParser)
    {
        $this->yamlParser = $yamlParser;
    }

    /**
     * View the API documentation
     * @return View
     */
    public function index() : View
    {
        // get the API YAML and parse it
        $yamlPath = base_path('swagger/logs-api.yml');
        $yaml     = file_get_contents($yamlPath);
        $parsed   = $this->yamlParser::parse($yaml);

        // render the swagger-ui template with the api spec as a json object
        // (the template is based on the swagger-api/swagger-ui package dist files)
        return view('swagger-ui', [
            'spec' => collect($parsed)->toJson()
        ]);
    }
}
