<?php

/**
 * @package Theme Customs
 * @author Diego Andrés <diegoandres_cortes@outlook.com>
 * @copyright Copyright (c) 2024, SMF Tricks
 * @license MIT
 */

namespace ThemeCustoms;

use ThemeCustoms\Theme\Init;

class Config extends Init
{
	/**
	 * @var string Theme Name
	 */
	protected string $name = 'LikeIPB';

	/**
	 * @var string Theme Version
	 */
	protected string $version = '2.6.3';

	/**
	 * @var array Theme Author
	 */
	protected string $author = 'Diego Andrés';

	/**
	 * @var int Theme Author SMF ID
	 */
	protected int $authorID = 254071;

	/**
	 * @var string Theme Default Color
	 */
	protected string $color = '#567c8f';

	/**
	 * @var string GitHub URL
	 */
	protected string $github = 'https://github.com/SMFTricks/LikeIPB';

	/**
	 * @var string Custom Suport URL
	 */
	protected string $supportURL = 'https://smftricks.com/index.php?board=60.0';

	/**
	 * @var bool Add the like button to the quickbuttons
	 */
	public bool $quickLikes = true;

	/**
	 * @var bool Using custom for the theme
	 */
	public bool $customFonts = false;

	/**
	 * @var int Number of Custom Links
	 */
	public int $customLinks = 5;

	/**
	 * @var bool Wheter to include bootstrap
	 */
	public bool $bootstrap = true;

	/**
	 * @var bool Wheter to enable Profile Cover Addon
	 */
	public bool $addonProfileCover = true;



	/**
	 * Load the additional hooks
	 */
	public function loadHooks() : void
	{
		// Load JS
		add_integration_function('integrate_pre_javascript_output', __CLASS__ . '::js#', false, __FILE__);
	}

	/**
	 * Load custom JS
	 */
	public function js() : void
	{
		// Custom js
		loadJavascriptFile('custom.js', [
			'force_current' => true,
		], 'themecustom_js');
	}

}