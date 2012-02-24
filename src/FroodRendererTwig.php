<?php
/**
 * This file is part of the froodTwig Frood extension.
 * @link https://github.com/Ibmurai/zaphod
 *
 * @copyright Copyright 2011 Jens Riisom Schultz
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
/**
 * A renderer for the Twig template engine.
 *
 * @link http://twig.sensiolabs.org
 *
 * @category   Frood
 * @package    Renderer
 * @subPackage Twig
 * @author     Jens Riisom Schultz <ibber_of_crew42@hotmail.com>
 */
class FroodRendererTwig extends FroodRendererTemplate {
	/** @var string The content type. */
	protected $_contentType = 'text/html';

	/**
	 * The Frood calls this when appropriate.
	 * It should output directly.
	 *
	 * @param array &$values The values assigned to the controller.
	 */
	public function render(array &$values) {
		require_once dirname(__FILE__) . '/../twig/lib/Twig/Autoloader.php';

		Twig_Autoloader::register();

		$loader = new Twig_Loader_String();
		$twig = new Twig_Environment($loader, array(
			'cache' => realpath(dirname(__FILE__) . '/../cache'),
		));

		echo $twig->render(file_get_contents($this->_getTemplate()), $values);
	}

	/**
	 * Get the extension used for templates for the implementing renderer.
	 *
	 * @return string
	 */
	protected function _getTemplateFileExtension() {
		return 'html.twig';
	}
}
