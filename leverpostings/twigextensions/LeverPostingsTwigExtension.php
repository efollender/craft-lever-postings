<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class LeverPostingsTwigExtension extends \Twig_Extension
{

	/**
	 * Returns an array of global variables.
	 *
	 * @return array An array of global variables.
	 */
	public function getGlobals()
	{
		$globals['leverPostingsItems'] = craft()->LeverPostings_items->getJobs();
		$globals['leverPostingsDepartments'] = craft()->LeverPostings_items->getDepartments();
		return $globals;
	}

	public function getName()
	{
		return Craft::t('LeverPostingsItem');
	}

}
