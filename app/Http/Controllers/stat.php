<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class stat extends Controller
{
    //
    public function data(){

    echo '---------------   mobile analytics -------------------- <br>';
    	$analyticsMobile =$analyticsData = Analytics::performQuery(
	    	Period::months(1),
		    'ga:sessions',
		    [
		        'dimensions'=>'ga:deviceCategory',
		    	'metrics'=>'ga:sessions,ga:pageviews,ga:sessionDuration',
		    	'segment'=>'gaid::-14'
		    ]
		);
		if (count($analyticsMobile->getRows()) > 0) {
			$pageviews =0;
		    $sessions=0;
		    foreach ($analyticsMobile->getRows() as $row) {
		    	echo json_encode($row).'<br>';
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

    	 $CountryAnalytics =$analyticsData = Analytics::performQuery(
	    	Period::months(1),
		    'ga:sessions',
		    [
		        'dimensions'=>'ga:country',
			    'metrics'=>'ga:sessions,ga:pageviews',
			    'sort'=>'-ga:sessions'
		    ]
		);

    	 if (count($CountryAnalytics->getRows()) > 0) {

		    // Get the profile name.
		    $profileName = $CountryAnalytics->getProfileInfo()->getProfileName();
		    foreach ($CountryAnalytics->getRows() as $row) {
		      echo json_encode($row).'<br>';
		    }

		    // Get the entry for the first entry in the first row.


		    // Print the results.
		    //print "nombre des visiteurs: $sessions\n";
		  } else {
		    print "No results found.\n";
		  }
	echo '---------------   Total analytics -------------------- <br>';
			$TotalAnalytics =$analyticsData = Analytics::performQuery(
	    	Period::months(1),
		    'ga:sessions',
		    [
		    	'dimensions'=>'ga:deviceCategory',
		        'metrics'=>'ga:sessions,ga:pageviews'
		    ]
		);

    	 if (count($TotalAnalytics->getRows()) > 0) {

		    // Get the profile name.
		    $profileName = $TotalAnalytics->getProfileInfo()->getProfileName();
		    foreach ($TotalAnalytics->getRows() as $row) {
		      echo json_encode($row).'<br>';
		    }

		    // Get the entry for the first entry in the first row.


		    // Print the results.
		    //print "nombre des visiteurs: $sessions\n";
		  } else {
		    print "No results found.\n";
		  }
	echo '---------------   Operating SystemAnd analytics -------------------- <br>';
			$OSAnalytics =$analyticsData = Analytics::performQuery(
	    	Period::months(1),
		    'ga:sessions',
		    [
		        'dimensions'=>'ga:operatingSystem',
    			'metrics'=>'ga:sessions'
		    ]
		);

    	 if (count($OSAnalytics->getRows()) > 0) {

		    // Get the profile name.
		    $profileName = $OSAnalytics->getProfileInfo()->getProfileName();
		    foreach ($OSAnalytics->getRows() as $row) {
		      echo json_encode($row).'<br>';
		    }

		    // Get the entry for the first entry in the first row.


		    // Print the results.
		    //print "nombre des visiteurs: $sessions\n";
		  } else {
		    print "No results found.\n";
		  }
	echo '---------------   Browser analytics -------------------- <br>';
		$BrowserAnalytics =$analyticsData = Analytics::performQuery(
		    	Period::months(1),
			    'ga:sessions',
			    [
			        'dimensions'=>'ga:browser',
    				'metrics'=>'ga:sessions'
			    ]
			);

	    	 if (count($BrowserAnalytics->getRows()) > 0) {

			    // Get the profile name.
			    $profileName = $BrowserAnalytics->getProfileInfo()->getProfileName();
			    foreach ($BrowserAnalytics->getRows() as $row) {
			      echo json_encode($row).'<br>';
			    }

			    // Get the entry for the first entry in the first row.

			    // Print the results.
			    //print "nombre des visiteurs: $sessions\n";
			  } else {
			    print "No results found.\n";
			  }
    }
}
