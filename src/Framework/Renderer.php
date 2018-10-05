<?php
namespace Framework;

class Renderer 
{
	const DEFAULT_NAMESPACE = '__MAIN';

	/**
	 * @var array
	 */
	private $paths = [];

	/**
	 * Ajoute un chemin correspondant à un namespace
	 * @param string $namespace 
	 * @param ?string $path 
	 * @return type
	 */
	public function addPath(string $namespace, ?string $path = null): void
	{
		//si aucun chemin n'est renseigné, on définit $namespace comme namespace par défaut
		if (is_null($path)) {
			$this->paths[self::DEFAULT_NAMESPACE] = $namespace;
		} else {
			$this->paths[$namespace] = $path;
		}
	}

	/**
	 * Renvoie le contenu de la vue
	 * @param string $view 
	 * @return type
	 */
	public function render(string $view): string
	{
		if ($this->hasNamespace($view)) {
			$path = $this->replaceNamespace($view) . '.php';
		} else {
			$path = $this->paths[self::DEFAULT_NAMESPACE] . DIRECTORY_SEPARATOR . $view . '.php';
		}
		ob_start();
		require($path);
		return ob_get_clean();
	}

	/**
	 * Vérifie la présence d'un namespace dans une string
	 * @param string $view 
	 * @return type
	 */
	private function hasNamespace(string $view): bool{
		return $view[0] === '@';
	}

	/**
	 * Récupère le namespace
	 * @param string $view 
	 * @return type
	 */
	private function getNamespace(string $view): string
	{
		//i.e 'blog' pour @blog/demo
		return substr($view, 1, strpos($view, '/') - 1);
	}

	/**
	 * Réécrit le bon namespace dans la vue
	 * @param string $view 
	 * @return type
	 */
	private function replaceNamespace(string $view): string
	{
		//i.e 'blog'
		$namespace = $this->getNamespace($view);
		// @blog/demo devient cheminVersLeFichier/demo
		return str_replace('@' . $namespace, $this->paths[$namespace], $view);
	}
}