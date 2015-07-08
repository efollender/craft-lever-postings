<?php
namespace Craft;

class LeverPostingsPlugin extends BasePlugin
{

	function getName()
	{
		return Craft::t('Lever Postings');
	}

	function getVersion()
	{
		return '1';
	}

	function getDeveloper()
	{
		return 'Emma Follender';
	}

	function getDeveloperUrl()
	{
		return 'http://www.emmafollender.com';
	}

	protected function defineSettings()
	{
		return array(
			'leverId' => array(AttributeType::String, 'required' => true),
			'query' => array(AttributeType::String, 'required' => true)
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('leverpostings/_settings', array(
			'settings' => $this->getSettings()
		));
	}

	/**
	 * Registers the Twig extension.
	 *
	 * @return LeverPostingsTwigExtension
	 */
	public function addTwigExtension()
	{
		Craft::import('plugins.leverpostings.twigextensions.LeverPostingsTwigExtension');
		return new LeverPostingsTwigExtension();
	}

}
