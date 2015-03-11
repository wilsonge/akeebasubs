<?php
/**
 * @package   AkeebaSubs
 * @copyright Copyright (c)2010-2015 Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Subscriptions\Site\Dispatcher;

defined('_JEXEC') or die;

class Dispatcher extends \FOF30\Dispatcher\Dispatcher
{
	/** @var   string  The name of the default view, in case none is specified */
	public $defaultView = 'Levels';

	public function onBeforeDispatch()
	{
		if (!@include_once(JPATH_ADMINISTRATOR . '/components/com_akeebasubs/version.php'))
		{
			define('AKEEBASUBS_VERSION', 'dev');
			define('AKEEBASUBS_DATE', date('Y-m-d'));
		}

		// Load common CSS JavaScript
		\JHtml::_('jquery.framework');
		$this->container->template->addCSS('media://com_akeebasubs/css/frontend.css', $this->container->mediaVersion);

		// Translate view names from Akeeba Subscriptions 1.x, 2.x, 3.x and 4.x
		$this->translateOldViewNames();
	}

	/**
	 * Translates the view name of an old version of Akeeba Subscriptions to the new names used in Akeeba Subscriptions
	 * 5.x and later.
	 */
	protected function translateOldViewNames()
	{
		// Map Akeeba Subscriptions 1.x-4.x view name to Akeeba Subscriptions 5.x+ view name
		$map = [
			'apicoupons'    => 'APICoupons',
			'apicoupon'     => 'APICoupons',
			'callbacks'     => 'Callbacks',
			'callback'      => 'Callbacks',
			'cron'          => 'CRON',
			'crons'         => 'CRON',
			'invoice'       => 'Invoices',
			'invoices'      => 'Invoices',
			'level'         => 'Level',
			'levels'        => 'Levels',
			'messages'      => 'Messages',
			'message'       => 'Messages',
			'subscribes'    => 'Subscribe',
			'subscribe'     => 'Subscribe',
			'subscription'  => 'Subscriptions',
			'subscriptions' => 'Subscriptions',
			'userinfos'     => 'UserInfo',
			'userinfo'      => 'UserInfo',
			'validates'     => 'Validate',
			'validate'      => 'Validate',
		];

		$oldViewName = strtolower($this->view);

		if (isset($map[$oldViewName]))
		{
			$this->view = $map[$oldViewName];
		}
	}
}