===============================
2013_02_13

Feeds importers
Overridden Feed
change Mapping for Node processor
________________________
|Source		|Target|
|---------------|------|
|Image URL	|photo |
-----------------------

Import 3 dummy Noded (Node type=Image)

Create Views
1)Image Collection 
List of Image Content Type

2)feeds_fb_images_feed_items clone of feeds_defaults_feed_items
Filter criteria
Content: Type (= Image) 

module dev 
feeds_fb_page
FeedsFbPageParser.inc update getMappingSources()




===============================
2013_02_10

module dev 
feeds_fb_page
name:Feeds: Facebook Page
Files:
feeds_fb_page.info
feeds_fb_page.install
feeds_fb_page.module
FeedsFbPageParser.inc


add new node (feed type)
feeds from paul's surf club page
http://localhost/d7r/node/106/
url
https://graph.facebook.com/pauls.surfclub?fields=albums

2 (dummy)* feed item imported

Feeds importers
Overridden Feed
Parser: Facebook Page Parser


===============================
2013_02_09

add new node (feed type)
Feeds from Romain Guy
http://localhost/d7r/node/95

url
http://www.curious-creature.org/feed/

10 * feed item imported

Periodic import set TO OFF for feed importer
Home » Administration » Structure » Feeds importers


restore db from /2013-01-30-23:16:30
run aggregator for 
Feed aggregator for windsurfing aggelies		
Next update:never	
Items: 20 items

related db tables are:
aggregator_item
aggregator_*

new modules installed and enabled:
features-7.x-2.0-beta1

existing modules enabled:
Feeds News 7.x-2.0-alpha7


Main menu added new link
aggregator for windsurfing aggelies
===============================
2013_01_31
module dev
new page feeds_facebook_page_users
http://localhost/d7r/feeds_facebook_page_users

fix
Access content for the feeds_facebook module 
enabled
===============================
2013_01_30

init github repository 
https://github.com/gerassimos/d7r.git

Feed aggregator changes
Feed aggregator for windsurfing aggelies	0 items	never	never	edit	remove items	update items
feed from www.boards.gr	0 items	never	never	edit	remove items	update items

2013_01_30 PARTIAL
module dev ONLY
feeds_facebook
new block defined: 
'feeds_facebook_page_users'

methods modified   
feeds_facebook_block_info()
feeds_facebook_block_view()

methods new 
_feeds_facebook_getContext
===============================
2013_01_29

module dev 
feeds_facebook
new test method _feeds_facebook_testFbPageClass();
new class import require ("FbPage.php");

tested with feeds_facebook_block_view()
see commented code

included folder hello_rest
example:
http://localhost/site/d7r/sites/all/modules/feeds_facebook/hello_rest/test_call_FbPageService.php

===============================
2013_01_27
core update to Drupal 7.19

modules update
Entity API	7.x-1.0

feeds_facebook
implement new hook methods
feeds_facebook_menu
feeds_facebook_form
feeds_facebook_form_validate
feeds_facebook_permission
_feeds_facebook_page
_feeds_facebook_testGetImageFromExtUrlAndSave

===============================
2012_12_04

xdebug is working 

new module dev
module name: feeds_facebook

Show all errors while developing

You can show all errors by adding a few lines to your local testing site's settings.php:

<?php
error_reporting(-1);
$conf['error_level'] = 2;
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
?>

===============================
2012_12_02

New modules:
Job Scheduler	7.x-2.0-alpha3
Feeds	7.x-2.0-alpha7

updated modules:
Services "7.x-3.3"

modules enabled 
Aggregator ( Aggregates syndicated content (RSS, RDF, and Atom feeds).)

Feed aggregator
  Feed aggregator for windsurfing aggelies
  feed from www.boards.gr
Category
	windsurf
===============================
2012_11_28
fb_social 7.x-2.0-beta4

Home » Administration » Structure » Facebook social ->PRESETS

Facebook activityfeed plugin (http://www.pauls-surfclub.gr/)
Facebook comments plugin on Blog entry 	
Facebook facepile plugin (http://www.facebook.com/pauls.surfclub)
Like button on Blog entry 
===============================
2012_11_21
delete folder ".git"  
===============================
2012_11_18

Delete test contents
Delete all unused content types (old galleries)
Create NEW (AGAIN) content type Gallery JT based on 
James Tombs 
Create an album based image gallery in Drupal 7 using fields and views 
http://jamestombs.co.uk/2011-05-26/create-album-based-image-gallery-drupal-7-using-fields-and-views
Create Gallery JT
gallery jt 1 
gallery jt 2
===============================
2012_11_12
core update using git
Drupal	7.17

module update using git
Wysiwyg 7.x-2.x
===============================
2012_11_07
partially
James Tombs 
Create an album based image gallery in Drupal 7 using fields and views 
http://jamestombs.co.uk/2011-05-26/create-album-based-image-gallery-drupal-7-using-fields-and-views
===============================
2012_11_06
references-7.x-2.0.zip
===============================
2012_11_04_b

modules:
colorbox-7.x-1.4
entity-7.x-1.0-rc3
entityreference-7.x-1.0-rc5
eva-7.x-1.2

libraries:
Colorbox - 1.3.20 
===============================
2012_11_04
new content added


===============================
2012_10_28

wysiwyg  = "7.x-2.1"
advanced_help  = "7.x-1.0"
libraries  = "7.x-2.0"
ctools  = "7.x-1.2"
services  = "7.x-3.2"
views  = "7.x-3.5"

