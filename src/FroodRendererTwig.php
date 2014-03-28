<?php
/**
 * This file is part of the froodTwig Frood extension.
 * @link https://github.com/akimsko/froodTwig
 *
 * @copyright Copyright 2011 Bo Thinggaard
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

/**
 * A renderer for the Twig template engine.
 *
 * @link http://twig.sensiolabs.org
 *
 * @category   Frood
 * @package    Renderer
 * @subpackage Twig
 * @author     Jens Riisom Schultz <ibber_of_crew42@hotmail.com>
 * @author     Bo Thinggaard <akimsko@tnactas.dk>
 */
class FroodRendererTwig extends FroodRendererTemplate {
	/** @var string The content type. */
	protected $_contentType = 'text/html';

	/** @var string The path to look for overridden templates. */
	protected static $_themePath;

	/**
	 * The constructor.
	 *
	 * @param FroodRequest $request
	 */
	public function __construct(FroodRequest $request) {
		parent::__construct($request);

		Twig_Autoloader::register();
	}

	/**
	 * The Frood calls this when appropriate.
	 * It should output directly.
	 *
	 * @param array &$values The values assigned to the controller.
	 */
	public function render(array &$values) {
		if (isset(self::$_themePath)) {
			$paths = array();
			if (is_dir($path = self::$_themePath)) {
				$paths[] = $path;
			}
			if (is_dir($path = self::$_themePath . '/' . $this->_request->getModule())) {
				$paths[] = $path;
			}
			if (is_dir($path = Frood::getFroodConfiguration()->getTemplatesPath($this->_request->getModule()))) {
				$paths[] = $path;
			}
		} else {
			$paths = array(
				Frood::getFroodConfiguration()->getTemplatesPath($this->_request->getModule()),
			);
		}

		$loader = new FroodRendererTwigTemplateLoader($paths);

		$twig = new Twig_Environment($loader, array(
			'cache' => realpath(dirname(__FILE__) . '/../cache'),
		));

		echo $twig->render($this->_getTemplateFile(), $values);
	}

	/**
	 * Get the extension used for templates for the implementing renderer.
	 *
	 * @return string
	 */
	protected function _getTemplateFileExtension() {
		return 'html.twig';
	}

	/**
	 * Set the path that the renderer will use to look for overridden templates.
	 *
	 * @param string $path
	 *
	 * @throws FroodExceptionConfiguration If the path does not exist.
	 */
	public static function setThemePath($path) {
		if ($realpath = realpath($path)) {
			self::$_themePath = $realpath;
		} else {
			throw new FroodExceptionConfiguration("Cannot set theme path to non-existent path, $path.");
		}
	}
}
