=== Plugin Name ===
Contributors: igrossiter
Donate link: http://onespace.com.br/doacoes/
Tags: latest posts, post
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode to get the latest posts on the blog, for one or more categories or a post_type.

== Description ==

Veja descrição em portugues em: http://onespace.com.br/lastpost/

This plugin provides you with a shortcode that returns the latest posts from specifics categories or post_types, you can choose how many posts is to be show or what kind of information you can get from posts.

Arguments:

1. id - You can use any number of post categories ids separeted by commas
1. num - the number of posts to return for wich categorie id
1. info - this is where goes all the printing information

Info printing arguments:

1. thumb: returns the post's featured image, you must specify the width of the thumb after ':', has a link to the post
1. title: returns the title, has a link to the post
1. excerpt: returns the first lines from you post you can specify the lenght of the text to show and a subtext. excerpt:LENGTH:SUB-TEXT, has a link to the post
1. content: returns all content from post
1. date: returns date of post publishing, you can specify the format after ':'

More about date:

Date format uses php default formating symbols, here goes some of then;

d: day of month
m: month
y: year

it has some limitations, you can't use escape chars (yet).

check the manual to see the complete list: http://php.net/manual/en/function.date.php

A few examples:

[os_lastpost id="x,y,z" num=2 info="title,date:d/m/y,thumb:130,excerpt:120: ... veja mais"]

returns the latest 2 posts from post categories x, y and z, printing the date on Day/Month/Year, featured image 130 px of width, 120 chars from post content (html stripped) and a custom text " ... veja mais" at the end.

[os_lastpost post_type="custom_post_type" num=5 info="title,excerpt"]

returns the latest 5 posts from a custom post type, printing title, and the first 60 chars from the post content and a default text " ... read more"

[os_lastpost post_type="post" num=5 info="title,content"]

returns the latest 5 posts from all your categories, printing title, and full content

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Unzip and upload `os-lastpost` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use the shortcode described on the description in your site
1. If you need to use the shortcode on a widget, it is possible with a additional plugin

== Frequently Asked Questions ==

= I need a list on a widget =

Get a plugin that allows you to use any shortcode on widgets, thats fairly easy to find here on wp plugin repository.

= How do I found out the ID from a category? =

Go to Admin > posts > categories, mouse over the category that you need, and check the ID on the link.

== Screenshots ==

1. Plugin used on a post.

2. Shortcode used.

3. Plugin used on a widget, need additional plugin to make possible the use of shortcodes on widget.

== Changelog ==

= 0.1 =
inicial version

== Upgrade Notice ==

== Arbitrary section ==
