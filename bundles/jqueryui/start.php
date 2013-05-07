<?php

/**
 * Gumby Laravel bundle
 * Apply the Gumby CSS framework
 * 
 * @author: Hieu Le (http://www.webtrunghieu.info)
 * @create: 2013/04/30
 */

Asset::container('gumby')->bundle('gumby');
Asset::container('gumby')->add('gumby_css', 'css/gumby.css');
Asset::container('gumby')->add('jquery', 'js/libs/jquery-1.9.1.min.js');
Asset::container('gumby')->add('modernizr', 'js/libs/modernizr-2.6.2.min.js');
Asset::container('gumby')->add('gumby_js_min', 'js/libs/gumby.min.js', 'jquery');