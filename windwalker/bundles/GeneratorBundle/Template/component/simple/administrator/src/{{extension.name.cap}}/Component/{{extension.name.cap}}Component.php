<?php
/**
 * Part of Component {{extension.name.cap}} files.
 *
 * @copyright   Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

namespace {{extension.name.cap}}\Component;

use {{extension.name.cap}}\Provider\{{extension.name.cap}}Provider;
use Windwalker\Component\Component;
use Windwalker\Debugger\Debugger;
use Windwalker\Helper\LanguageHelper;
use Windwalker\Helper\ProfilerHelper;

defined('_JEXEC') or die;

/**
 * {{extension.name.cap}} Component
 *
 * @since 1.0
 */
abstract class {{extension.name.cap}}Component extends Component
{
	/**
	 * Component name without `com_`.
	 *
	 * @var string
	 */
	protected $name = '{{extension.name.cap}}';

	/**
	 * Prepare hook of this component.
	 *
	 * Do some customize initialise through extending this method.
	 *
	 * @return void
	 */
	public function prepare()
	{
		if (JDEBUG)
		{
			Debugger::registerWhoops();
		}

		// Register provider
		$this->container->registerServiceProvider(new {{extension.name.cap}}Provider);

		// Load language
		$lang = $this->container->get('language');

		LanguageHelper::loadAll($lang->getTag(), $this->option);

		// Load asset
		$asset = $this->container->get('helper.asset');

		$asset->windwalker();

		// Register tasks
		TaskMapper::register($this);

		parent::prepare();
	}

	/**
	 * Post execute hook.
	 *
	 * @param mixed $result The return value of this component.
	 *
	 * @return  mixed  The return value of this component.
	 */
	protected function postExecute($result)
	{
		$doc = \JFactory::getDocument();

		// Debug profiler
		if (JDEBUG && $doc->getType() === 'html')
		{
			$result .= "<hr />" . ProfilerHelper::render('Windwalker', true);
		}

		return parent::postExecute($result);
	}
}
