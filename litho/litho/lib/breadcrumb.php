<?php
/**
 * Default Breadcrumb Class File.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Breadcrumb_Navigation` doesn't exists yet.
if ( ! class_exists( 'Litho_Breadcrumb_Navigation' ) ) {
	/**
	 * The Main Breadcrumb Navigation
	 */
	class Litho_Breadcrumb_Navigation {

		/**
		 * Customize control type.
		 *
		 * @var array
		 */
		public $opt;

		/**
		 * Constructor
		 */
		public function __construct() {

			$this->opt = array(

				'static_frontpage'                => false,
				// ** only used if 'static_frontpage' => true
				// Relative URL for your blog's address that is used for the Weblog link.
				// Use it if your blog is available at http://www.site.com/myweblog/,
				// and at http://www.site.com/ a WordPress page is being displayed:
				// In this case apply '/myweblog/'.
				'url_blog'                        => '',
				// Display HOME? If set to false, HOME is not being displayed.
				'home_display'                    => true,
				// URL for the home link.
				'url_home'                        => home_url( '/' ),
				// Apply a link to HOME? If set to false, only plain text is being displayed.
				'home_link'                       => true,
				// Text displayed for the home link, if you don't want to call it home then just change this.
				// Also, it is being checked if the current page title = this variable. If yes, only the Home link is being displayed,
				// but not a weird "Home / Home" breadcrumb.
				'title_home'                      => esc_html__( 'Home', 'litho' ),
				// Text displayed for the blog. If "'static_frontpage' => false", you
				// might want to change this value to "Home".
				'title_blog'                      => esc_html__( 'Blog', 'litho' ),
				// Separator that is placed between each item in the breadcrumb navigation, but not placed before
				// the first and not after the last element. You also can use images here,
				// e.g. '<img src="separator.gif" title="separator" width="10" height="8" />'.
				'separator'                       => ' / ',
				// Text displayed for the search page.
				'title_search'                    => esc_html__( 'Search', 'litho' ),
				// Prefix for a single blog article.
				'singleblogpost_prefix'           => '',
				// Suffix for a single blog article.
				'singleblogpost_suffix'           => '',
				// Prefix for a page.
				'page_prefix'                     => '',
				// Suffix for a page.
				'page_suffix'                     => '',
				// The prefix that is used for mouseover link (e.g.: "Browse to: Archive").
				'urltitle_prefix'                 => esc_html__( 'Browse to: ', 'litho' ),
				// The suffix that is used for mouseover link.
				'urltitle_suffix'                 => '',
				// Prefix for categories.
				'archive_category_prefix'         => '',
				// Suffix for categories.
				'archive_category_suffix'         => '',
				// Prefix for archive by year/month/day.
				'archive_date_prefix'             => '',
				// Suffix for archive by year/month/day.
				'archive_date_suffix'             => '',
				// Prefix for tags (Simple Tagging Plugin).
				'tag_page_prefix'                 => esc_html__( 'Tag: ', 'litho' ),
				// Prefix for tags (Simple Tagging Plugin).
				'tag_page_suffix'                 => '',
				// Text displayed for a 404 error page, , only being used if 'use404' => true.
				'title_404'                       => esc_html__( '404', 'litho' ),
				// For post type.
				'title_portfolio'                 => '',
				// Display current item as link?
				'link_current_item'               => false,
				// URL title of current item, only being used if 'link_current_item' => true.
				'current_item_urltitle'           => esc_html__( 'Link of current page (click to refresh)', 'litho' ),
				// Style or prefix being applied as prefix to current item. E.g. <span class="bc_current">.
				'current_item_style_prefix'       => '',
				// Style or prefix being applied as suffix to current item. E.g. </span>.
				'current_item_style_suffix'       => '',
				// Maximum number of characters of post title to be displayed? 0 means no limit.
				'posttitle_maxlen'                => 0,
				// Display category when displaying single blog post.
				'singleblogpost_category_display' => false,
				// Prefix for single blog post category, only being used if 'singleblogpost_category_display' => true.
				'singleblogpost_category_prefix'  => '',
				// Suffix for single blog post category, only being used if 'singleblogpost_category_display' => true.
				'singleblogpost_category_suffix'  => '',
			);
		} // END function breadcrumb (constructor)

		/**
		 * DISPLAY BREADCRUMB
		 */
		public function litho_display_breadcrumb() {

			global $wpdb, $post, $wp_query, $wp;

			$bcn_homelink = '';
			if ( ( true === $this->opt['static_frontpage'] ) && ( true === $this->opt['home_display'] ) ) { // Hide HOME if it is disabled in the options.
				if ( true === $this->opt['home_link'] ) { // Link home or just display text.
					$bcn_homelink = '<a href="' . esc_url( $this->opt['url_home'] ) . '" title="' . $this->opt['urltitle_prefix'] . $this->opt['title_home'] . $this->opt['urltitle_suffix'] . '">' . $this->opt['title_home'] . '</a>';
				} else {
					$bcn_homelink = $this->opt['title_home'];
				}
			}

			/* -------- BLOG LINK -------- */
			$bcn_bloglink = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url( '/' ) ) . $this->opt['url_blog'] . '" title="' . $this->opt['urltitle_prefix'] . $this->opt['title_blog'] . $this->opt['urltitle_suffix'] . '"><span itemprop="name">' . $this->opt['title_blog'] . '</span></a><meta itemprop="position" content="1" /></li>';

			/* -------- CURRENT ITEM -------- */
			$curitem_urlprefix = '';
			$curitem_urlsuffix = '';
			if ( $this->opt['link_current_item'] ) {
				$current_url       = trailingslashit( home_url( $wp->request ) );
				$curitem_urlprefix = '<a title="' . $this->opt['current_item_urltitle'] . '" href="' . esc_url( $current_url ) . '">';
				$curitem_urlsuffix = '</a>';
			}

			// Get the different types.

			if ( is_search() ) {
				$swg_type = 'search'; // Search.
			} elseif ( is_attachment() ) {
				$swg_type = 'attachment';
			} elseif ( is_page() ) {
				$swg_type = 'page'; // Page.
			} elseif ( is_singular( 'portfolio' ) ) {
				$swg_type = 'portfoliosinglepost'; // Single Portfolio page.
			} elseif ( is_single() ) {
				$swg_type = 'singlepost'; // Single post page.
			} elseif ( is_post_type_archive( 'portfolio' ) ) {
				$swg_type = 'portfolio';
			} elseif ( is_archive() && is_category() ) {
				$swg_type = 'categories'; // Weblog Categories.
			} elseif ( is_tag() ) {
				$swg_type = 'tag';
			} elseif ( is_archive() && ! is_category() ) {
				$swg_type = 'blogarchive'; // Weblog Archive.
			} elseif ( is_404() ) {
				$swg_type = '404'; // 404.
			} elseif ( class_exists( 'SimpleTagging' ) ) {
				if ( STP_IsTagView() ) { // phpcs:ignore
					$swg_type = 'tag';
				}
			} else {
				$swg_type = 'else'; // Everything else (should be weblog article list only).
			}

			/**
			 * Here we set the initial array $result_array. We use this for being able
			 * to apply styles, anchors etc. to each element.
			 * Default is set to false.
			 */
			$result_array = array(
				'middle' => false, // The part between "Home" and the last element of the breadcrumb.
				'last'   => array(// The last element of the breadcrumb.
					'prefix' => false, // prefix.
					'title'  => false, // text.
					'suffix' => false, // suffix.
				),
			);
			switch ( $swg_type ) {
				case 'page':
					/**
					 * Get Pages.
					 */
					$bcn_theparentid = $post->post_parent; // id of the parent page.
					$page_counter    = 2; /* For litho */
					$bcn_loopcount   = 0; // counter for the array.
					$bcn_titlearray  = array();

					while ( 0 != $bcn_theparentid ) { // phpcs:ignore
						// Get the row of the parent's page;
						// *** Regarding performance this is not a perfect solution since this query is inside a loop ! ***
						// However, the number of queries is reduced to the number of parents.
						$mylink = $wpdb->get_row( $wpdb->prepare( "SELECT post_title, post_parent FROM $wpdb->posts WHERE ID = %d", $bcn_theparentid ) ); // phpcs:ignore
						// Title of parent into array incl. current permalink (via $bcn_theparentid,.
						// since we set this variable below we can use it here as current id!).

						$bcn_titlearray[ $bcn_loopcount ] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $bcn_theparentid ) ) . '" title="' . $this->opt['urltitle_prefix'] . $mylink->post_title . $this->opt['urltitle_suffix'] . '"><span itemprop="name">' . $mylink->post_title . '</span><meta itemprop="position" content="' . $page_counter . '" /></a></li>';

						// New parent ID of parent.
						$bcn_theparentid = $mylink->post_parent;

						$bcn_loopcount++;
						$page_counter++;
					} // while.

					if ( is_array( $bcn_titlearray ) ) {
						// Reverse the array since it is in a reverse order .
						$bcn_titlearray = array_reverse( $bcn_titlearray );
						// Prepare the output by looping thru the array. We use $sep for not adding the separator before the first element.
						$count       = 0;
						$page_result = '';

						foreach ( $bcn_titlearray as $val ) {
							$sep = '';
							if ( 0 !== $count ) {
								$sep = $this->opt['separator'];
							}

							$page_result = $page_result . $sep . $val;

							$count++;
						}
					}

					$bcn_pagetitle  = trim( get_the_title() ); // page title, we do not use "$post->post_title" since it could display.
					$bcn_pagetitle1 = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $bcn_pagetitle ) . '</span><meta itemprop="position" content="' . $page_counter . '" /></li>'; // wrong title if theme uses more than one LOOP.

					// Result
					// If we have a front page named 'Home' (or similar), we do not want to display the Breadcrumb like this: Home / Home
					// Therefore do not display the Home Link if such certain page is being displayed.
					if ( strtolower( $bcn_pagetitle ) !== strtolower( $this->opt['title_home'] ) ) {  // Check if we are not on home.
						if ( isset( $page_result ) ) {
							if ( '' !== $page_result ) {
								$result_array['middle'] = $page_result;
							}
						}
						$result_array['last']['prefix'] = $this->opt['page_prefix'];
						$result_array['last']['title']  = $bcn_pagetitle1;
						$result_array['last']['suffix'] = $this->opt['page_suffix'];
					}

					break;
				case 'search':
					// Get Search.

					$search_name                   = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $this->opt['title_search'] . '</span><meta itemprop="position" content="2" /></li>';
					$result_array['last']['title'] = $search_name;

					break;
				case 'singlepost':
					// Get single blog post.

					$bcn_pagetitle = trim( get_the_title() );
					// wrong title if theme uses more than one LOOP.
					$result_array['middle'] = $bcn_bloglink;

					$counter = 2;
					// Add category.
					if ( true === $this->opt['singleblogpost_category_display'] ) {
						$category      = get_the_category();
						$category_link = get_category_link( $category[0]->term_id );

						$result_array['middle'] .= $this->opt['separator'] . $this->opt['singleblogpost_category_prefix'] . '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $category_link ) . '" title="' . $category[0]->cat_name . '"><span itemprop="name">' . $category[0]->cat_name . '</span></a><meta itemprop="position" content="' . esc_attr( $counter ) . '" /></li>' . $this->opt['singleblogpost_category_suffix'];
						/* Custom for litho */
						$counter++;
					}

					$result_array['last']['prefix'] = $this->opt['singleblogpost_prefix'];

					// Restrict the length of the title...
					$bcn_post_title = $bcn_pagetitle;
					if ( ( $this->opt['posttitle_maxlen'] >= 1 ) && ( strlen( $bcn_post_title ) > $this->opt['posttitle_maxlen'] ) ) {
						$bcn_post_title = substr( $bcn_post_title, 0, $this->opt['posttitle_maxlen'] - 1 ) . '...';
					}
					$result_array['last']['title'] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $bcn_post_title ) . '</span><meta itemprop="position" content="' . esc_attr( $counter ) . '" /></li>';

					$result_array['last']['suffix'] = $this->opt['singleblogpost_suffix'];

					break;
				case 'attachment':
					// Get single blog post.

					$bcn_pagetitle = trim( get_the_title() );
					// wrong title if theme uses more than one LOOP.
					$result_array['middle'] = $bcn_bloglink;
					$counter                = 2;
					// Add category.
					$result_array['last']['prefix'] = $this->opt['singleblogpost_prefix'];

					// Restrict the length of the title...
					$bcn_post_title = $bcn_pagetitle;
					if ( ( $this->opt['posttitle_maxlen'] >= 1 ) && ( strlen( $bcn_post_title ) > $this->opt['posttitle_maxlen'] ) ) {
						$bcn_post_title = substr( $bcn_post_title, 0, $this->opt['posttitle_maxlen'] - 1 ) . '...';
					}
					$result_array['last']['title'] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $bcn_post_title ) . '</span><meta itemprop="position" content="' . esc_attr( $counter ) . '" /></li>';

					$result_array['last']['suffix'] = $this->opt['singleblogpost_suffix'];

					break;
				case 'singlepostcategory':
					// Get single blog post.

					$bcn_pagetitle = 'Blog'; // page title, we do not use "$post->post_title" since it could display
					// wrong title if theme uses more than one LOOP.
					$result_array['middle'] = $bcn_bloglink;

					// Restrict the length of the title...
					$bcn_post_title = $bcn_pagetitle;
					if ( ( $this->opt['posttitle_maxlen'] >= 1 ) && ( strlen( $bcn_post_title ) > $this->opt['posttitle_maxlen'] ) ) {
						$bcn_post_title = substr( $bcn_post_title, 0, $this->opt['posttitle_maxlen']-1 ) . '...'; // phpcs:ignore
					}

					$bcn_post_title                = '<li><a href="' . esc_url( get_permalink( get_page_by_path( ( 'blog' ) ) ) ) . '">' . esc_html( $bcn_post_title ) . '</a></li>';
					$result_array['last']['title'] = $bcn_post_title;

					$result_array['last']['suffix'] = $this->opt['singleblogpost_suffix'];

					break;
				case 'categories':
					// Get Category and Parent Categories.

					/* Litho custom code */
					$cat_counter            = 2;
					$result_array['middle'] = $bcn_bloglink;

					$object = $wp_query->get_queried_object();

					// Get parents of current category.
					$parent_id       = $object->category_parent;
					$cat_breadcrumbs = '';

					while ( $parent_id ) {
						$category        = get_category( $parent_id );
						$cat_breadcrumbs = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_category_link( $category->cat_ID ) ) . '" title="' . $this->opt['urltitle_prefix'] . $category->cat_name . $this->opt['urltitle_suffix'] . '"><span itemprop="name">' . esc_html( $category->cat_name ) . '</span><meta itemprop="position" content="' . esc_attr( $cat_counter ) . '" /></a></li>' . $this->opt['separator'] . $cat_breadcrumbs;
						$parent_id       = $category->category_parent;
						$cat_counter++;
					}

					$result_array['last']['prefix']  = $this->opt['archive_category_prefix'];
					$result_array['last']['prefix'] .= $cat_breadcrumbs;

					$cat_name = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $object->cat_name . '</span><meta itemprop="position" content="' . esc_attr( $cat_counter ) . '" /></li>';

					// Current Category.
					$result_array['last']['title']  = $cat_name;
					$result_array['last']['suffix'] = $this->opt['archive_category_suffix'];
					break;
				case 'blogarchive':
					// Get Blog archive.

					$result_array['middle'] = $bcn_bloglink;
					if ( is_day() ) {
						$archive_name = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( get_the_date() ) . '</span><meta itemprop="position" content="2" /></li>';
						// -- Archive by day
						$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
						$result_array['last']['title']  = $archive_name;
						$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];

					} elseif ( is_month() ) {
						$archive_name = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( get_the_date( 'F Y' ) ) . '</span><meta itemprop="position" content="2" /></li>';
						// -- Archive by month
						$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
						$result_array['last']['title']  = $archive_name;
						$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];
					} elseif ( is_year() ) {
						$archive_name = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( get_the_date( 'Y' ) ) . '</span><meta itemprop="position" content="2" /></li>';
						// -- Archive by year
						$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
						$result_array['last']['title']  = $archive_name;
						$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];
					} elseif ( is_author() ) {
						$archive_name = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( get_the_author() ) . '</span><meta itemprop="position" content="2" /></li>';
						// -- Archive by author
						$result_array['last']['prefix'] = $this->opt['archive_date_prefix'];
						$result_array['last']['title']  = $archive_name;
						$result_array['last']['suffix'] = $this->opt['archive_date_suffix'];
					} else {
						$tag_name                       = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . single_tag_title( '', false ) . '</span><meta itemprop="position" content="2" /></li>';
						$result_array['middle']         = $bcn_bloglink;
						$result_array['last']['prefix'] = $this->opt['tag_page_prefix'];
						$result_array['last']['title']  = $tag_name;
						$result_array['last']['suffix'] = $this->opt['tag_page_suffix'];
					}

					break;
				case '404':
					// Get 404 error page.

					$result_array['last']['title'] = $this->opt['title_404'];
					break;
				case 'tag':
					// Get Tag Page.

					$tag_name                       = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . single_tag_title( '', false ) . '</span><meta itemprop="position" content="2" /></li>';
					$result_array['middle']         = $bcn_bloglink;
					$result_array['last']['prefix'] = $this->opt['tag_page_prefix'];
					$result_array['last']['title']  = $tag_name;
					$result_array['last']['suffix'] = $this->opt['tag_page_suffix'];
					break;
				case 'portfolio':
					$result_array['middle']        = $bcn_bloglink;
					$title_portfolio               = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"></span><meta itemprop="position" content="2" />' . esc_html__( 'Portfolio', 'litho' ) . '</li>';
					$result_array['last']['title'] = $title_portfolio;
					break;
				case 'portfoliosinglepost':
					// Get single portfolio post.

					$bcn_pagetitle   = trim( get_the_title() );
					$bcn_theparentid = $post->post_parent; // id of the parent page.
					$bcn_loopcount   = 0;// counter for the array.
					$bcn_titlearray  = array();

					while( 0 != $bcn_theparentid ) { // phpcs:ignore

						$mylink   = $wpdb->get_row( $wpdb->prepare( "SELECT post_title, post_parent FROM $wpdb->posts WHERE ID = %d", $bcn_theparentid ) );// phpcs:ignore
						$page_url = get_permalink( $bcn_theparentid );
						// Single portfolio title.
						$bcn_titlearray[ $bcn_loopcount ] = '<li><a href="' . esc_url( $page_url ) . '" title="' . $this->opt['urltitle_prefix'] . $mylink->post_title . $this->opt['urltitle_suffix'] . '">' . $mylink->post_title . '</a></li>';

						// New parent ID of parent.
						$bcn_theparentid = $mylink->post_parent;
						$bcn_loopcount++;
					} // while.

					if ( is_array( $bcn_titlearray ) ) {
						// Reverse the array since it is in a reverse order.
						$bcn_titlearray = array_reverse( $bcn_titlearray );
						$count          = 0;
						$page_result    = '';
						foreach ( $bcn_titlearray as $val ) {
							$sep = '';
							if ( 0 !== $count ) {
								$sep = $this->opt['separator'];
							}

							$page_result = $page_result . $sep . $val;

							$count++;
						}
					}
					// wrong title if theme uses more than one LOOP.
					$result_array['middle'] = $bcn_bloglink;

					$position_meta = false;
					if ( 'portfolio' === get_post_type() ) {

						if ( isset( $page_result ) ) {
							if ( '' !== $page_result ) {
								$result_array['middle'] .= $page_result;
							}
						}
					}

					$result_array['last']['prefix'] = $this->opt['singleblogpost_prefix'];

					// Restrict the length of the title...
					$bcn_post_title     = $bcn_pagetitle;
					if ( ( $this->opt['posttitle_maxlen'] >= 1 ) && ( strlen( $bcn_post_title ) > $this->opt['posttitle_maxlen'] ))// phpcs:ignore.
						$bcn_post_title = substr( $bcn_post_title, 0, $this->opt['posttitle_maxlen'] - 1 ) . '...';
					if ( $position_meta ) {
						$result_array['last']['title'] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $bcn_post_title . '</span><meta itemprop="position" content="3" /></li>';
					} else {
						$result_array['last']['title'] = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $bcn_post_title . '</span><meta itemprop="position" content="2" /></li>';
					}

					$result_array['last']['suffix'] = $this->opt['singleblogpost_suffix'];
					break;
				case 'else':
					// Get weblog article list (which is very often the front page of the blog).

					$default = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . $this->opt['title_blog'] . '</span><meta itemprop="position" content="2" /></li>';

					$result_array['last']['title'] = $default;
			} // switch

			// Echo the result.

			// MIDDLE PART.

			// The first separator between HOME and the first entry.
			$first_sep = ''; // display first separator only if HOME is disabled in the options AND it is a static front page.
			if ( ( true === $this->opt['static_frontpage'] ) && ( true === $this->opt['home_display'] ) ) {
				$first_sep = $this->opt['separator'];
			}

			// get middle part and add separator(s).
			$middle_part = '';
			if ( false === $result_array['middle'] ) {
				// there is no middle part...

				if ( false === $result_array['last']['title'] ) {
					$first_sep = ''; // we are on home.
				}
			} else {
				// There is a middle part...
				$middle_part = $result_array['middle'] . $this->opt['separator'];
			}

			// LAST PART.
			$last_part = '';
			if ( false !== $result_array['last']['prefix'] ) {
				$last_part .= $result_array['last']['prefix'];
			}

			if ( false !== $result_array['last']['title'] ) {
				$last_part .= $curitem_urlprefix . $result_array['last']['title'] . $curitem_urlsuffix;
			}

			if ( false !== $result_array['last']['suffix'] ) {
				$last_part .= $result_array['last']['suffix'];
			}

			// ECHO.
			$result = "\n";

			if ( false === $this->opt['static_frontpage'] ) {
				if ( ( 'page' === $swg_type ) || ( 'search' === $swg_type ) || ( '404' === $swg_type ) ) {
					$result .= $bcn_bloglink . $this->opt['separator'];
				}
			}

			$result .= $bcn_homelink . $first_sep . $middle_part . $this->opt['current_item_style_prefix'] . $last_part . $this->opt['current_item_style_suffix'] . "\n";
			return $result;

		} // END function display.
	} // END class Litho_Breadcrumb_Navigation.
}
