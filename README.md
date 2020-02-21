# distance_calc_demo_wordpress_plugin

# Working versions on word press site 
* https://mfales.com/all-skills/web-design/word-press/wordpress-plugin/

# Goal
* Stand alone plugin for wrodpress should work with all version
* Take user and calculate the distance from one point to the whitehouse

# Install
* Browse OS and add the distance-calc-demo.zip file
* Then go to plugin and activate the plugin distance-calc-demo
* Short code [distance-calc-demo]

# Process 
* Grab user location through ip https://www.geoplugin.com/webservices/php good class to use
* Set up The calculations 
* Great-circle distance between two points https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php 
* NOTE: using API that may cost, may not work in the future due to changes, and adding extra step not needed.
* This code will work no matter what and will always give back the same results 
* This means it is stable version which will not risk any problems in the future 
* The table you see is built with bootstrap 4/ Version of WordPress uses
* Table will work on mobile 
---
* The map
* This is built with free API called openlayers https://openlayers.org/
* Shows you the line between to the locations 
* NOTE: this is Javascript base meaning the variables are taken from php from the first part of the code


# Code Notes
* For short code add_shortcode('distance-calc-demo', 'distance_calc_demo'); 
* Fixed locations points Fixed location https://www.latlong.net/place/the-white-house-washington-dc-usa-20381.html


# Testing 
* VPN to change location
* Validation on distance  http://www.meridianoutpost.com/resources/etools/calculators/calculator-latitude-longitude-distance.php?
* There is always a chance it not exact location base on IP.  This is due to where the server is located.  






---
![Outline](Example.PNG)








