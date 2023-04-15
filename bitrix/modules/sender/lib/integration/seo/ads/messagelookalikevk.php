<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage sender
 * @copyright 2001-2020 Bitrix
 */

namespace Bitrix\Sender\Integration\Seo\Ads;

use Bitrix\Main\Localization\Loc;

/**
 * Class MessageLookalikeVk
 * @package Bitrix\Sender\Integration\Seo\Ads
 */
class MessageLookalikeVk extends MessageLookalike
{
	const CODE = self::CODE_ADS_LOOKALIKE_VK;

	/**
	 * Get name.
	 * @return string
	 */
	public function getName()
	{
		return Loc::getMessage('SENDER_INTEGRATION_SEO_MESSAGE_NAME_ADS_LOOKALIKE_VK');
	}

	protected function setConfigurationOptions()
	{
		$this->configuration->setArrayOptions(array(
			array(
				'type' => 'string',
				'code' => 'CLIENT_ID',
				'name' => Loc::getMessage('SENDER_INTEGRATION_SEO_MESSAGE_CONFIG_CLIENT_ID'),
				'required' => true,
			),
			array(
				'type' => 'string',
				'code' => 'ACCOUNT_ID',
				'name' => Loc::getMessage('SENDER_INTEGRATION_SEO_MESSAGE_CONFIG_ACCOUNT_ID'),
				'required' => true,
			),
			array(
				'type' => 'string',
				'code' => 'AUDIENCE_ID',
				'name' => Loc::getMessage('SENDER_INTEGRATION_SEO_MESSAGE_CONFIG_AUDIENCE_ID'),
				'required' => false,
			),
			array(
				'type' => 'string',
				'code' => 'AUDIENCE_SIZE',
				'name' => Loc::getMessage('SENDER_INTEGRATION_SEO_MESSAGE_CONFIG_AUDIENCE_SIZE'),
				'required' => false,
			)
		));
	}

	public function getLookalikeOptions()
	{
		$config = $this->configuration;
		return [
			'AUDIENCE_SIZE' => $config->get('AUDIENCE_SIZE'),
		];
	}
}