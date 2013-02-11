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
        'title' => 'My Title',
        'url'=> 'url1',
        'description'=> 'test <img src="http://www.pauls-surfclub.gr/sites/default/files/imagecache/scale_width_320/img_320x240/paul01.jpg"  >',
    );
    $items[] = array(
        'guid' => 'MyGuid2',
        'fbid' => 'fbid2',
        'title' => 'My Other Title',
        'description'=> 'd2',
    );
    $result->items = $items;
    return $result;
  }
  
  
  /**
   * Parse Atom feed
   *
   * @param SimpleXMLElement $sxml
   * @param FeedsFetcherResult $fetcher_result
   * @param FeedsSource $source
   */
  private function parseAtom(SimpleXMLElement $sxml, FeedsSource $source, FeedsFetcherResult $fetcher_result) {
  
  
    $fetcher_result->title = $feed_title = (string) $sxml->title;
    $result = new FeedsParserResult();
  
    // Iterate over entries in feed
    // TODO: This is not DRY - extract things which is same in Atom and RSS20 to common method
    foreach ($sxml->entry as $entry) {
      // get video ID
      $arr = explode('/', $entry->id);
      $id = $arr[count($arr)-1];
  
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');
  
      // get video player URL
      $attrs = $media->group->player->attributes();
      $watch = str_replace('&feature=youtube_gdata_player', '', $attrs['url']);
  
      // get video thumbnail
      $attrs = $media->group->thumbnail[0]->attributes();
      $thumbnail = (string) $attrs['url'];
  
      // get <yt:duration> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
      $length = $attrs['seconds'];
  
      // get <yt:stats> node for viewer statistics
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->statistics->attributes();
      $viewCount = $attrs['viewCount'];
      $favCount = $attrs['favoriteCount'];
  
      // get <gd:rating> node for video ratings
      $gd = $entry->children('http://schemas.google.com/g/2005');
      $rating = 0;
      if ($gd->rating) {
        $attrs = $gd->rating->attributes();
        $rating = $attrs['average'];
      }
  
      $updated = (string) $entry->updated;
      $published = (string) $entry->published;
  
      $item = array(
          'feed_title' => $feed_title,
          'guid' => (string) $entry->id,
          'video_id' => $id,
          'url' => 'http://www.youtube.com/watch?v=' . $id,
          'watch_page' => $watch,
          'title' => (string) $media->group->title,
          'author' => (string) $entry->author->name,
          'description' => (string) $media->group->description,
          'thumbnail' => $thumbnail,
          'category' => (string) $media->group->category,
          'tags' => explode(',', $media->group->keywords),
          'embedded_player' => '',
          'duration' => $this->secsToTime($length),
          'duration_raw' => $length,
          'view_count' => (string) $viewCount,
          'fav_count' => (string) $viewCount,
          'rating' => (string) $rating,
          'updated_datetime' => date('Y-m-d H:i:s', strtotime($updated)),
          'updated_timestamp' => strtotime($published),
          'published_datetime' => date('Y-m-d H:i:s', strtotime($published)),
          'published_timestamp' => strtotime($updated),
      );
  
      // Populate the FeedsFetcherResult object with the parsed results.
      $result->items[] = $item;
    }
  }
  

  public function getMappingSources() {
    return array(
        'guid' => array(
            'name' => t('GUID'),
            'description' => t('Unique ID.'),
        ),
        'title' => array(
            'name' => t('Title'),
            'description' => t('Title of the Facebook link'),
        ),
        'url' => array(
            'name' => t('URL'),
            'description' => t('URL to the Facebook profile story'),
        ),
        'body' => array(
            'name' => t('Body'),
            'description' => t('HTML encoded description of the Facebook link'),
        ),
        'published' => array(
            'name' => t('Date published'),
            'description' => t('Date'),
        ),
        'author_tt' => array(
            'name' => t('Author_tt'),
            'description' => t('_tt The poster of the link'),
        )
    );
  }

  
  

}
