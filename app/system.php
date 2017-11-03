<?php
/**
 * @author      Raphaël Cerveaux <raphael@crvx.fr>
 * @copyright   Copyright (c), 2016 Raphaël Cerveaux
 * @license     MIT public license
 */

namespace App;

use \Bramus\Router\Router as Router;
use \App\DB\Database as Database;

/**
 * Class App
 */
class Application
{
	/**
     * @var bool
     */
	private $debug;

	/**
     * @var instance
     */
	private $router;

	/**
     * @var instance
     */
	private $db;

	/**
     * @var instance
     */
	private $twigLoader;

	/**
     * @var instance
     */
	private $twig;

    /**
     * public variables
     */
	public $webroot;
    public $domain;
	public $app;
	public $config_path;
	public $resources;
	public $controllers;
	public $models;
	public $views;
	public $src;
	public $config;

	/**
     * Constructor
     */
	public function __construct(bool $debug = false)
	{
		$this->debug = $debug;

		$this->webroot = str_replace('/index.php', '', $_SERVER['ORIG_PATH_TRANSLATED']);
		$this->domain = str_replace('/index.php', '', $_SERVER['REDIRECT_URL']);
		$this->app = $this->webroot.'/app/';
		$this->config_path = $this->webroot.'/app/config';
		$this->resources = $this->webroot.'/app/Resources/';
		$this->models = $this->resources.'models/';
		$this->views = $this->resources.'views/';
		$this->src = $this->webroot.'/src/';
        
        $this->config = parse_ini_file($this->config_path.'/config.ini', true);

		$this->router = new Router();

		$this->db = new Database($this->config['dbDns']['host'], $this->config['dbDns']['dbname'], $this->config['dbDns']['user'], $this->config['dbDns']['pass']);
        
        $this->private_key = $this->config['framework']['private_key'];

		\Twig_Autoloader::register();
		$this->twigLoader = new \Twig_Loader_Filesystem($this->views);
		$this->twig = new \Twig_Environment($this->twigLoader, array('debug' => $this->debug));

		if($this->debug){
            ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
		}else{
			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			error_reporting(E_ALL);
		}
	}

	private function __clone() {}

	public function __destruct(){}
	
	/**
     * Get module instance
     */
	public function getModule(string $module){
		$module = "\App\\".$module;
		$_instance = new $module();
		return $_instance;
	}

	/**
     * Get debug value
     */
	public function getDebug(){
		return (bool) $this->debug;
	}

	/**
     * Get router instance
     */
	public function getRouter(){
		return $this->router;
	}

	/**
     * Get database instance
     */
	public function getDB(){
		return $this->db;
	}

	/**
     * Get twig instance
     */
	public function getTwig(){
		return $this->twig;
	}

	/**
     * Get twig loader instance
     */
	public function getTwigLoader(){
		return $this->twigLoader;
	}

	/**
     * Use GET method
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function get($pattern, $fn){
		$this->router->get($pattern, $fn);
	}

	/**
     * Use POST method
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function post($pattern, $fn){
		$this->router->post($pattern, $fn);
	}

	/**
     * Match function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function match($method, $pattern, $fn){
		$this->router->match($method, $pattern, $fn);
	}

	/**
     * Mount function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function mount($pattern, $fn){
		$this->router->mount($pattern, $fn);
	}

	/**
     * Put function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function put($pattern, $fn){
		$this->router->put($pattern, $fn);
	}

	/**
     * Delete function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function delete($pattern, $fn){
		$this->router->delete($pattern, $fn);
	}

	/**
     * Options function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function options($pattern, $fn){
		$this->router->options($pattern, $fn);
	}

	/**
     * Patch function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function patch($pattern, $fn){
		$this->router->patch($pattern, $fn);
	}

	/**
     * Before function
     *
     * @param $method 	The request method
     * @param $fn 		The route function
     */
	public function before($method, $pattern, $fn){
		$this->router->before($method, $pattern, $fn);
	}

	/**
     * Set 404 error function
     *
     * @param $method 		The request method
     * @param $fn 			The route function
     */
	public function set404($fn){
		$this->router->set404($fn);
	}

	/**
     * Run application function
     */
	public function run($callback = null){
		$this->router->run($callback);
	}
	
	/**
     * Render template function using 
     */
	public function render(array $template, array $args = []){
		# Add a template path
		# $this->getTwigLoader()->addPath('/admin', 'admin');

		if (!empty($template['models'])) {
			$this->load($template['models']);
		}

		if (!empty($template['views'])) {
			echo $this->twig->render($template['views'].'.html.twig', $args);
		}
	}

	/**
     * Load router function
     * Folder /app/Resources/routers/*.php
     */
	public function router(string $file){
		$app = $this;
		require_once($this->resources.'routers/'.$file.'.php');
	}

	/**
     * Load model function
     * Folder /src/*.php
     */
	public function load(string $file){
		$app = $this;
		require_once($this->models.$file.'.php');
	}

	/**
     * Redirect function
	 *
	 * @param $local	choose local redirection or external link
    */
	public function redirect(string $path, bool $local = true){
		if ($local == true) {
			header('Location:'.$this->domain.$path);
		} else {
			header('Location:'.$path);
		}
	}
}
