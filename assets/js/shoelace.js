/*! Shoelace - v0.1.0 - 2015-02-09
 * http://www.teomaragakis.com
 * Copyright (c) 2015; * Licensed GPLv2+ */
( function( window, undefined ) {
	'use strict';

	// dropcaps
  var dropcaps = document.querySelectorAll(".dropcap");
  window.Dropcap.layout(dropcaps, 3);

 } )( this );

 jQuery(document).ready(function($){
    // Target your .container, .wrapper, .post, etc.
    $(".entry-content").fitVids();

    $("img.lazy").lazyload({
      effect : "fadeIn"
    });

    $('pre code').each(function(i, block) {
      hljs.highlightBlock(block);
    });

  });