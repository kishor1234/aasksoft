<?php
// mysql hostname
$db_host = "localhost";

// database name
$db_name = "aasksoft_map";

// database user name
$db_user = "aasksoft_user";

// database password
$db_pass = "root@123";

// admin username
$admin_user = "admin";

// admin password
$admin_pass = "Sonam@143";



$sg_enabled = false;

  // Put your SG API code here
  $sg_auth_code = '';

  // Choose your map's location here. If you're not sure
  // about this, check the URL on the Startup Genome website.
  $sg_location = '';
  // Examples:
  // $sg_location = '/city/los-angeles-ca';
  // $sg_location = '/state/ca-us';
  // $sg_location = '/country/chile';

  // We only check for new data from SG when people visit your map,
  // or when you run "startupgenome_get.php?override=true" manually.
  // You can limit how often this happens to avoid slow page loads.
  // Set the frequency below (in seconds).
  $sg_frequency = "3600";



// EventBrite.com integration (optional)
//
// Show events on the map? If set to "true", an event
// category will appear in the marker list, and you can
// run events_get.php in your browser (or a chron) to populate
// it with data from eventbrite.
$show_events = true;

    // put your eventbrite api key here
    $eb_app_key = "";

    // search eventbrite for these keywords
    // use "+" for spaces
    // e.g. 'startup', 'startups', 'demo+day'
    $eb_keywords = join("%20OR%20", array('startup', 'startups'));

    // specify city to search in and around
    // example: Santa+Monica
    $eb_city = "Santa+Monica";

    // specify search radius (in miles)
    $eb_within_radius = 50;


// set timezone
// date_default_timezone_set("America/Los_Angeles");

// HTML that goes just before </head>
$head_html = "";

// The <title></title> tag
$title_tag = "map.aasksoft.com - map of the @askSoft";

// The latitude & longitude to center the initial map
$lat_lng = "18.4572264,74.564606";

// Domain to use for various links
$domain = "http://map.aasksoft.com/";//"http://www.represent.la";

// Twitter username and default share text
$twitter = array(
  "share_text" => "Let's put Los Angeles startups on the map:",
  "username" => "representla"
);

// Short blurb about this site (visible to visitors)
$blurb = "This map was made to connect and promote the @askSoft .  Let's put some more information on the map which you know!";

// attribution (must leave link intact, per our license)
$attribution = "
  <span>
    Based on <a href='http://www.aasksoft.com' target='_blank'>@askSoft</a>
  </span>
";

// add startup genome to attribution if integration enabled
if($sg_enabled) {
  $attribution .= "
    <br /><br />
    Data from <a target='_blank' href='http://www.aasksoft.com'>@askSoft</a>
  ";
}
?>