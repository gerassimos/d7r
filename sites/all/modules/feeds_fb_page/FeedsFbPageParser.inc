<?php


/**
 * @file
 *  Feeds parser class for Flickr.
 */

/**
 * Class definition for Flickr Flicker Parser.
 *
 * Parses RSS and Atom feeds.
 */
class FeedsFbPageParser extends FeedsParser {

/**
   * Parse the extra mapping sources provided by this parser.
   *
   * @param $fetcher_result FeedsFetcherResult
   * @param $source FeedsSource
   *
   * @see FeedsParser::parse()
   */
  public function parse(FeedsSource $source, FeedsFetcherResult $fetcher_result) {
  	$result = new FeedsParserResult();
    //echo 'FeedsFbPageParser parce';
    $response = $fetcher_result->getRaw();
    $response_array=explode("\r\n\r\n", $response , 2);
    list($a_dummy_var,$response_body) = $response_array;
    
    //echo 'FeedsFetcherResult getRaw()'.$string;
    $fbPage = new FbPage(NULL,NULL);
    $fbPage->fb_page_albums_contents=$response_body ;
    $fbPage->populateMemberVariable();
    $fbUsers = $fbPage->fbUsersThatLikeAlbums;
    
    // Get the file's content.
    
    
    // Parse it...
    
    // The parsed result should be an array of arrays of field name => value.
    // This is an example of such an array:
    $items = array();
    
    $items[] = array(
        'guid' => 'MyGuid1',
        'fbid' => 'fbid1',
        'title' => 'Title1',
        'url'=> 'url1',
        'url_image'=> 'http://drupal.org/files/druplicon.small_.png',
        'description'=> 'test <img src="http://www.pauls-surfclub.gr/sites/default/files/imagecache/scale_width_320/img_320x240/paul01.jpg"  >',
    );
    $items[] = array(
        'guid' => 'MyGuid2',
        'fbid' => 'fbid2',
        'title' => 'Title2',
        'url'=> 'url1',
        'url_image'=> 'http://drupal.org/files/drupal_logo-blue.png',
        'description'=> 'd2',
    );
    $items[] = array(
        'guid' => 'MyGuid3',
        'fbid' => 'fbid3',
        'title' => 'Title3',
        'url'=> 'url1',
        'url_image'=> 'http://groups.drupal.org/files/Logo-drupal-camp-bs-as-2.jpg',
        'description'=> 'd3',
    );
    
    
    
    $result->items = $items;
    return $result;
  }
  

  public function getMappingSources() {
    return array(
        'guid' => array(
            'name' => t('GUID'),
            'description' => t('Unique ID.'),
        ),
        'title' => array(
            'name' => t('Title'),
            'description' => t('Title'),
        ),
        'url' => array(
            'name' => t('URL'),
            'description' => t('URL of the item'),
        ),
        'url_image' => array(
            'name' => t('Image URL'),
            'description' => t('URL of the Image'),
        ),
        'description' => array(
            'name' => t('Body'),
            'description' => t('HTML encoded description'),
        ),
        'published' => array(
            'name' => t('Date published'),
            'description' => t('Date'),
        )
        
    );
  }

  
  

}
