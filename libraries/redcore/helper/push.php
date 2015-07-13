<?php
/**
 * @package     Redcore
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('JPATH_REDCORE') or die;

/**
 * Push notification helper class.
 *
 * @package     Redcore
 * @subpackage  Helper
 * @since       1.6.2
 */
final class RHelperPush
{
	/**
	 * Method for send Push Notification to Google Cloud Messaging
	 *
	 * @param   string  $apiAccessKey  Android app API Access key
	 * @param   string  $userToken     Access Token of user
	 * @param   array   $pushData      Array of data which has been send to user.
	 *
	 * @return  boolean                True on success. False otherwise.
	 */
	public static function pushAndroidNotification($apiAccessKey = '', $userToken = '', $pushData = array())
	{
		if (empty($apiAccessKey) || empty($userToken) || empty($pushData) || !is_array($pushData))
		{
			return false;
		}

		$registrationIds = array($userToken);

		$fields = array(
			'registration_ids' => $registrationIds,
			'data'             => $pushData
		);

		$headers = array(
			'Authorization: key=' . $apiAccessKey,
			'Content-Type: application/json'
		);

		$cUrl = curl_init();
		curl_setopt($cUrl, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($cUrl, CURLOPT_POST, true);
		curl_setopt($cUrl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($cUrl, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($cUrl);
		curl_close($cUrl);

		return $result;
	}

	/**
	 * Method for send Push Notifications on Apple Push Service
	 *
	 * @param   string   $token       Device access token
	 * @param   string   $passphrase  Passpharse for using PEM file if needed
	 * @param   string   $msg         Message text for push.
	 * @param   integer  $badge       Badge type
	 * @param   string   $sound       Sound file
	 * @param   array    $extras      Extra data if needed.
	 *
	 * @return  boolean          True on success. False other wise.
	 */
	public static function pushIosNotification($token = '', $passphrase = '', $msg = '', $badge = 0, $sound = 'default', $extras = array())
	{
		$badge = (int) $badge;

		if (empty($token) || empty($passphrase) || empty($msg))
		{
			return false;
		}

		$pemFile = JPATH_SITE . '/media/com_reditemdashboard/ios.pem';

		// Start stream connection
		$context = stream_context_create();

		// Set PEM file
		stream_context_set_option($context, 'ssl', 'local_cert', $pemFile);

		// Assume the private key passphrase was removed.
		stream_context_set_option($context, 'ssl', 'passphrase', $passphrase);

		// Open connection to the APNS Server
		$streamClient = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195',
			$error,
			$errorMessage,
			60,
			STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
			$context
		);

		if (!$streamClient)
		{
			return false;
		}

		// Prepare push message data
		$data = array(
			'alert' => $msg,
			'sound' => $sound
		);

		if ($badge)
		{
			$data['badge'] = $badge;
		}

		// Prepare payload
		$payload = array('aps' => $data);

		// If extras data has been set
		if (!empty($extras) && is_array($extras))
		{
			foreach ($extras as $key => $value)
			{
				// Not add for APS data
				if ($key == 'aps')
				{
					continue;
				}

				$payload[$key] = $value;
			}
		}

		// Encode data as JSON string
		$payload = json_encode($payload);

		// Build the binary notification
		$serviceData = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $token)) . pack("n", strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($streamClient, $serviceData, strlen($serviceData));

		// Close connection
		fclose($streamClient);

		return (boolean) $result;
	}
}
