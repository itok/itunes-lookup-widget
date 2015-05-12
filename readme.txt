=== iTunes Lookup Widget ===
Contributors: ollybach
Author URI: http://search-itunes.com
Plugin URI: http://wordpress.org/extend/plugins/itunes-lookup-widget/
Tags: itunes, music, software, ebooks, audiobooks, widget, multiwidget, affiliate
Requires at least: PHP 5.2 with cUrl, WP 3.3
Tested up to: 3.6
Stable tag: 0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Embeds an interactive iTunes display as a sidebar widget with optional use of affiliate links.
Multilingual Frontend (just update labels in admin settings page and/or widget as required)
Shortcode enabled. (use link within widget in widget admin to get the shortcode for the settings selected)


== Installation ==

1. Upload the entire `itunes-lookup-widget` folder to the `/wp-content/plugins/` directory.  
2. Activate the plugin through the 'Plugins' menu in WordPress.  
3. You will find the widget under Appearance > Widgets in the Wordpress backend.  

if using cache, ensure that the cache directory of this plugin is writable by the webserver  

if you have edited the stylesheet and wish to keep your css after updates, just copy 'styles.css' from '/itunes-lookup-widget/css/' as 'ilw-style.css' into your main template directory  

== Upgrade Notice ==

update to 0.6  
use PHG affiliate network, as LinkShare and DGM - according to Apple - will be discontinued at end September 2013

update to 0.4  
When upgrading from a previous version, please check and re-save widget settings as well as pages that use the shortcode.  


== Screenshots ==

1. widget administration
2. widget administration - find artist/author etc id
3. Blog-view of widget

== Other Notes ==

Based on this plugin, I also built a simple website to quickly search the iTunes store as I found the search iTunes provides on their website quite cumbersome.
So if you just quickly want to search for an item on iTunes , head over to <a href='http://search-itunes.com'>search-itunes.com</a>. Maybe it's useful...

== Changelog ==

0.6  
* added PHG affiliate network, as LinkShare and DGM - according to Apple - will be discontinued at end September 2013     
* minor code changes  
16th August 2013  

0.5.2  
* added option to explicitly  omit an album/software/ebook etc by id  
* added id's to li elements
7th July 2013  
  
0.5.1  
* bugfix when including/excluding podcasts and software (results were reversed, i.e. when excluded they got included and vice versa)  
  
0.5  
* enabled the option to open links in new window  
* reasonably extensive re-write to make future updates easier  
* moving many functions and default options into include files  
* minimal change to frontend css  
* streamlining and combining of some functions and removing redundant ones  
* php notice messages eradicated when saving/updating shortcodes in page  
15th March 2013  
  
0.4.2  
* updated curl pem certificate to newer version  
  
0.4.1  
* the widget did not work with other mootools (and possibly other frameworks). this should be fixed now.  
* changed loader gif so it works better on different coloured backgrounds  
* some other minor changes  
  
0.4  
* added ability to keep css changes when updating to future versions (see *installation* for instructions)  
* slightly changed the search of artist/publisher etc. id's in backend.  
* added display of tv episodes/seasons.  
For example, you can now also search by song title and (hopefully) find the artist's id that way, or you could search for a TV Season and display all episodes of that season in the widget.  
* some bugfixes - 3rd January 2013  
  
0.3.9  
* now also displaying collections/albums as albums even when iTunes API only returns them as wrappertype: track - 27th December 2012  
  
0.3.8  
* enable nested shortcodes (please re-save any pages that use the shortcode of this plugin) - 30th October 2012  
  
0.3.7  
* minor update- just sending the ajax iTunes API call straight to https instead of following redirection from http  - 23th October 2012  
  
0.3.6  
* apple in their infinite wisdom decided to only allow/redirect to SSL connections when quering the itunes API. so now we do that then.......  - 23th October 2012  
  
0.3.4  
* some more php notice/warning messages eradicated - 10th October 2012  
  
0.3.3  
* get rid of some php notice/warning messages and screenshot update - 5th October 2012  
  
0.3.2  
* minor maintenance, bug fixes - 5th October 2012  
  
0.3.1  
*iTunes API treats (CD) singles as tracks/songs (as opposed to collections with a trackcount of 1).  
The widget will now also find items for an artist when there are only singles - check readme for "Exclude Singles from Collection" in widgets about some caveats - 4th October 2012  
  
0.3  
* added shortcode handler,  enabled use of non-english characters in labels, stopped some functions executing when not needed plus some other cosmetic changes and maintenance  - 3rd October 2012  
  
0.2.4  
* a theme may not necessarily output an element with the required id around the widget (which is needed to render the widget in the right place). This update addresses this problem   - 19th September 2012  
  
0.2.3  
* same bug fix as in 0.2.1, when adding first widget  - 18th September 2012  
  
0.2.2  
* update some plugin options and delete redundand ones when updating from older versions and updating screenshots  - 18th September 2012  
  
0.2.1  
* fixed a bug that did not let you search for artist id in widget admin before widget had been saved - 17th September 2012  
  
0.2  
* bugfixes and additional frontend display options - 17th September 2012  
  
0.1  
* Initial release - 16th September 2012  
  
== Frequently Asked Questions ==  
  
none as yet. however,it's my first wp plugin, so leave a message in support if you have problems or feature requests  

