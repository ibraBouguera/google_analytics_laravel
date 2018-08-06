<?php

// Load the Google API PHP Client Library.
require_once __DIR__ . '/vendor/autoload.php';

$analytics = initializeAnalytics();
$profile = getFirstProfileId($analytics);

echo '---------------   mobile analytics -------------------- <br>';
$params=array(
    'dimensions'=>'ga:mobileDeviceInfo,ga:source',
    'metrics'=>'ga:sessions,ga:pageviews,ga:sessionDuration',
    'segment'=>'gaid::-14'
 );
$results = getResults($analytics, $profile,$params);
//printResults($results);

if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    
    $pageviews =0;
    $sessions=0;
    foreach ($results->getRows() as $row) {
      $pageviews +=$row[3];
      $sessions+=$row[2];
    }
    echo 'Nombre des Pages  :'.$pageviews.'<br>';
    echo 'Mobile :'. $sessions.' visiteurs <br>';

    // Print the results.
    //print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }

  echo '---------------   country analytics -------------------- <br>';

  $params=array(
    'dimensions'=>'ga:country',
    'metrics'=>'ga:sessions',
    'sort'=>'-ga:sessions'
 );
$results = getResults($analytics, $profile,$params);
//printResults($results);

if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();
    foreach ($results->getRows() as $row) {
      echo json_encode($row).'<br>';
    }

    // Get the entry for the first entry in the first row.


    // Print the results.
    //print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }
    echo '---------------   Total analytics -------------------- <br>';

    $params=array(
    'metrics'=>'ga:sessions,ga:pageviews'
 );
$results = getResults($analytics, $profile,$params);
//printResults($results);

if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();
    foreach ($results->getRows() as $row) {
      echo json_encode($row).'<br>';
    }

    // Get the entry for the first entry in the first row.


    // Print the results.
    //print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }
  echo '---------------   Operating SystemAnd analytics -------------------- <br>';
  $params=array(
    'dimensions'=>'ga:operatingSystem',
    'metrics'=>'ga:sessions'
 );
$results = getResults($analytics, $profile,$params);
//printResults($results);

if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();
    foreach ($results->getRows() as $row) {
      echo json_encode($row).'<br>';
    }

    // Get the entry for the first entry in the first row.


    // Print the results.
    //print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }
  echo '---------------   Browser analytics -------------------- <br>';
  $params=array(
    'dimensions'=>'ga:browser',
    'metrics'=>'ga:sessions'
 );
$results = getResults($analytics, $profile,$params);
//printResults($results);

if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();
    foreach ($results->getRows() as $row) {
      echo json_encode($row).'<br>';
    }

    // Get the entry for the first entry in the first row.
    

    // Print the results.
    //print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }

function initializeAnalytics()
{
  // Creates and returns the Analytics Reporting service object.

  // Use the developers console and download your service account
  // credentials in JSON format. Place them in this directory or
  // change the key file location if necessary.
  $KEY_FILE_LOCATION = __DIR__ . '/oonoo-9bde8cae212d.json';

  // Create and configure a new client object.
  $client = new Google_Client();
  $client->setApplicationName("Hello Analytics Reporting");
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics($client);

  return $analytics;
}

function getFirstProfileId($analytics) {
  // Get the user's first view (profile) ID.

  // Get the list of accounts for the authorized user.
  $accounts = $analytics->management_accounts->listManagementAccounts();

  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
    $firstAccountId = $items[0]->getId();

    // Get the list of properties for the authorized user.
    $properties = $analytics->management_webproperties
        ->listManagementWebproperties($firstAccountId);

    if (count($properties->getItems()) > 0) {
      $items = $properties->getItems();
      $firstPropertyId = $items[0]->getId();

      // Get the list of views (profiles) for the authorized user.
      $profiles = $analytics->management_profiles
          ->listManagementProfiles($firstAccountId, $firstPropertyId);

      if (count($profiles->getItems()) > 0) {
        $items = $profiles->getItems();

        // Return the first view (profile) ID.
        return $items[0]->getId();

      } else {
        throw new Exception('No views (profiles) found for this user.');
      }
    } else {
      throw new Exception('No properties found for this user.');
    }
  } else {
    throw new Exception('No accounts found for this user.');
  }
}

function getResults($analytics, $profileId,$params) {
  // Calls the Core Reporting API and queries for the number of sessions
  // for the last seven days.
   return $analytics->data_ga->get(
       'ga:' . $profileId,
       '30daysAgo',
       'today',
       'ga:sessions',$params
     );
}

function printResults($results) {
  // Parses the response from the Core Reporting API and prints
  // the profile name and total sessions.
  if (count($results->getRows()) > 0) {

    // Get the profile name.
    $profileName = $results->getProfileInfo()->getProfileName();

    // Get the entry for the first entry in the first row.
    $rows = $results->getRows();
    $sessions = $rows[0][0];

    // Print the results.
    print "nombre des visiteurs: $sessions\n";
  } else {
    print "No results found.\n";
  }
}

