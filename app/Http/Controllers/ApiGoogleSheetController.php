<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiGoogleSheetController extends Controller
{
    public function index(Request $request)
	{
		$client = $this->getClient();
		// Get the API client and construct the service object.
		
		$service = new \Google_Service_Sheets($client);
		$spreadsheetId = '1v2_YiGSpJUgMRn-SFDiMENY9Wczaq_Kt7MY0ch1ogMc';  // id google sheets
//		$range = 'Class Data!A2:E';
		$range = 'api-sheet';
		$response = $service->spreadsheets_values->get($spreadsheetId, $range);
		$values = $response->getValues();

		if (!empty($values)) {
			dump("GHI DU LIEU VAO SHEETS");
		}
	
		$options = array('valueInputOption' => 'RAW');
		$values = [
			["Name", "Roll No.", "Contact"],
			["Anis", "001", "+88017300112233"],
			["Ashik", "002", "+88017300445566"]
		];
		
		$body   = new \Google_Service_Sheets_ValueRange(['values' => $values]);
		
		$result = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $options);
		print($result->updatedRange. PHP_EOL);
	}
	
	protected function getClient()
	{
		$client = new \Google_Client();
		$client->setApplicationName('Google Sheets API PHP Quickstart');
		$client->setScopes(\Google_Service_Sheets::SPREADSHEETS_READONLY);
		$client->setAuthConfig(public_path().'/credentials.json');
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');
		
		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = 'token.json';
		if (file_exists($tokenPath)) {
			$accessToken = json_decode(file_get_contents($tokenPath), true);
			$client->setAccessToken($accessToken);
		}
		
		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {
				// Request authorization from the user.
				$authUrl = $client->createAuthUrl();
				printf("Open the following link in your browser:\n%s\n", $authUrl);
				print 'Enter verification code: ';
				
				define('STDIN',fopen("php://stdin","r"));
//				$authCode = trim(fgets(STDIN));
				$authCode = '4/MQFIDKyKvJiPHfaPj1ZFuLOcynD8vUTe4B2Y37EHqj00rAYyJmFmfNE';
				
				// Exchange authorization code for an access token.
//				dd($authCode);
				//4/MQFIDKyKvJiPHfaPj1ZFuLOcynD8vUTe4B2Y37EHqj00rAYyJmFmfNE
				$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
				$client->setAccessToken($accessToken);
				
				// Check to see if there was an error.
				if (array_key_exists('error', $accessToken)) {
					throw new Exception(join(', ', $accessToken));
				}
			}
			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0700, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));
		}
		
		return $client;
	}
}
