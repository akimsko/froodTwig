<?php
/**
 * This file is part of the froodTwig Frood extension.
 * @link https://github.com/akimsko/froodTwig
 *
 * @copyright Copyright 2011 Bo Thinggaard
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */
/**
 * A custom template loader for Twig. It supports theme: and original: prefixes.
 *
 * @category   Frood
 * @package    Renderer
 * @subpackage Twig
 * @author     Jens Riisom Schultz <ibber_of_crew42@hotmail.com>
 * @author     Bo Thinggaard <akimsko@tnactas.dk>
 */
class FroodRendererTwigTemplateLoader extends Twig_Loader_Filesystem {
	/**
	 * Support extending the original module templates using the prefix "original:".
	 *
	 * @return string
	 *
	 * @throws Twig_Error_Loader
	 */
	protected function findTemplate($name) {
		// normalize name
		$name = preg_replace('#/{2,}#', '/', strtr($name, '\\', '/'));

		if (isset($this->cache[$name])) {
			return $this->cache[$name];
		}

		$cacheName = $name;
		$paths     = $this->paths;

		if (count($this->paths) == 3) {
			$prefix = '';
			if (preg_match('/^([a-z]+):/', $name, $matches)) {
				$prefix = $matches[1];
				$name = preg_replace('/^[a-z]+:/', '', $name);
			}

			switch ($prefix) {
				case '':
					$paths = array($this->paths[1], $this->paths[2]);
					break;
				case 'original':
					$paths = array($this->paths[2]);
					break;
				case 'theme':
					$paths = array($this->paths[0]);
					break;
				default:
					throw new Twig_Error_Loader(sprintf('Unknown template prefix "%s".', $prefix));
					break;
			}
		}

		$this->validateName($name);

		foreach ($paths as $path) {
			if (is_file($path.'/'.$name)) {
				return $this->cache[$cacheName] = $path.'/'.$name;
			}
		}

		throw new Twig_Error_Loader(sprintf('Unable to find template "%s" (looked into: %s).', $name, implode(', ', $this->paths)));
	}
}
