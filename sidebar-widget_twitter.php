<?php
/**
 * @file
 *
 */

/**
 * addTweetEntityLinks
 *
 * adds a link around any entities in a twitter feed
 * twitter entities include urls, user mentions, and hashtags
 *
 * @author     Joe Sexton <joe@webtipblog.com>
 *
 * @param      object $tweet a JSON tweet object v1.1 API
 *
 * @return     string tweet
 */
function addTweetEntityLinks( $tweet ) {
	// actual tweet as a string
	$tweetText = $tweet->text;

	// create an array to hold urls
	$tweetEntites = array();

	// add each url to the array
	foreach ( $tweet->entities->urls as $url ) {
		$tweetEntites[] = array(
			'type'    => 'url',
			'curText' => substr( $tweetText, strpos( $tweetText, $url->url ), strlen( $url->url ) ),
			'newText' => " <a class='tweet-url' href='" . $url->expanded_url . "' target='_blank'>" . $url->display_url . "</a> "
		);
	} // end foreach

	// add each user mention to the array
	foreach ( $tweet->entities->user_mentions as $mention ) {
		$tweetEntites[] = array(
			'type'    => 'mention',
			'curText' => substr( $tweetText, strpos( $tweetText, '@' . $mention->screen_name ), strlen( $mention->screen_name ) + 1 ),
			'newText' => " <a class='tweet-mention' href='http://twitter.com/" . $mention->screen_name . "' target='_blank'>@" . $mention->screen_name . "</a>"
		);
	} // end foreach

	// add each hashtag to the array
	foreach ( $tweet->entities->hashtags as $tag ) {
		$tweetEntites[] = array(
			'type'    => 'hashtag',
			'curText' => substr( $tweetText, strpos( $tweetText, '#' . $tag->text ), strlen( $tag->text ) + 1 ),
			'newText' => " <a class='tweet-hastag' href='http://twitter.com/search?q=%23" . $tag->text . "&src=hash' target='_blank'>#" . $tag->text . "</a>"
		);
	} // end foreach


	// replace the old text with the new text for each entity
	foreach ( $tweetEntites as $entity ) {
		$tweetText = str_replace( $entity['curText'], $entity['newText'], $tweetText );
	} // end foreach

	return $tweetText;

} // end addTweetEntityLinks()

/* Load required lib files. */
require_once( 'TwitterApi/twitteroauth.php' );
require_once( 'TwitterApi/config.php' );

$tweetsLimit = 5;
$hashtags    = 'c4freedom';

$twitter = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET );
$tweets  = $twitter->get( 'https://api.twitter.com/1.1/search/tweets.json?q=%23' . $hashtags . '&result_type=mixed' );

$tweetsData = array();
foreach ( $tweets->statuses as $t ) {
	$date = new DateTime( $t->created_at );
	array_push( $tweetsData, array(
		'img'         => '<img src="' . $t->user->profile_image_url . '" alt="' . $t->user->name . '" />',
		'name'        => $t->user->name,
		'screen_name' => '@' . $t->user->screen_name,
		'url'         => 'http://twitter.com/' . $t->user->screen_name,
		'date'        => $date->format( 'M jS' ),
		'date_sort'   => $date->format( 'Y-m-d H-i-s' ),
		'rest'        => $t
	) );
}

function cmp( $a, $b ) {
	return strcmp( $b['date_sort'], $a['date_sort'] );
}

usort( $tweetsData, "cmp" );

$block = '<div class="widget_twitter">';
$block .= '<h3>#c4freedom</h3>';
$block .= '<ul class="widget_twitter_list">';

$tweetsLimit = ( $tweetsLimit < count( $tweetsData ) ) ? $tweetsLimit : count( $tweetsData );

for ( $i = 0; $i < $tweetsLimit; $i ++ ) {
	$block .= '<li>';
	$block .= '<div class="tweet-header">';
	$block .= '<a href="' . $tweetsData[ $i ]['url'] . '" target="_blank" class="user-image">' . $tweetsData[ $i ]['img'] . '</a>';
	$block .= '<div class="tweet-user">';
	$block .= '<a href="' . $tweetsData[ $i ]['url'] . '" target="_blank" class="name">' . $tweetsData[ $i ]['name'] . '</a>';
	$block .= '<a href="' . $tweetsData[ $i ]['url'] . '" target="_blank" class="screen-name">' . $tweetsData[ $i ]['screen_name'] . '</a>';
	$block .= '</div>';
	$block .= '<div class="tweet-date">' . $tweetsData[ $i ]['date'] . '</div>';
	$block .= '</div>';
	$block .= '<div class="tweet-content" data-content="">' . addTweetEntityLinks( $tweetsData[ $i ]['rest'] ) . '</div>';
	$block .= '</li>';
}
$block .= '</ul></div>';

echo $block;
?>