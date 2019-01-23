(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	  $(document).ready(function() {
	 
        //Pagination stuff
        var pages = [];
        var activePage = 1;

        // Break unit down into sections
        var pageCount = 0;
        $('.c14 .c16').each(function(index) {
            var firstEl = $(this).parentsUntil('.entry-content').last();
            var secondEl = $('.c14 .c16').eq(index + 1).parentsUntil('.entry-content').last();

            if (firstEl.get(0) !== secondEl.get(0)) {
                pageCount++;
                pages.push(pageCount);
                firstEl.nextUntil(secondEl).addBack().wrapAll('<div id="pagination-index-' + pageCount +'">');
            }
        });

        // Create Pager
        function drawPager(currentPage) {
            $('.pager').remove();

            var pager = '<ul class="pager">' + 
                            '<button class="prevButton"> Prev </button>' +
                            '<button class="nextButton"> Next </button>' +
                         '</div>';

            $('.c199:first').append(pager); 
            $('#pagination-index-' + pages[currentPage - 1]).append(pager); 

            if (currentPage !==1 ) { $('.prevButton').addClass('active'); }
            if (currentPage !== pages.length) { $('.nextButton').addClass('active'); }

            $('.nextButton').on('click', function() { navPage(currentPage + 1); });
            $('.prevButton').on('click', function() { navPage(currentPage - 1); });


            var pagerItemsToShow = [];

            if (currentPage > 2 && currentPage < (pages.length - 2)) {
                pagerItemsToShow.push(currentPage -2, currentPage -1);
                for (var i = currentPage - 1; i < (currentPage + 2); i++) {
                    pagerItemsToShow.push(i+1);
                }
            } else if (currentPage > (pages.length - 3)) {
                for (var i = pages.length - 5; i < pages.length; i++) {
                    pagerItemsToShow.push(i+1);
                }
            } else if (pages.length > 4) {
                for (var i = 0; i < 5; i++) {
                    pagerItemsToShow.push(i+1);
                }
            } else {
                for (var i = 0; i < pages.length; i++) {
                    pagerItemsToShow.push(i+1);
                }
            }

            pagerItemsToShow.forEach(function(page) {
                $('.pager .nextButton').before('<li class="page-' + page +'" ">' + page + '</li>');
                $('.page-' + page).on('click', function() { navPage(page); });
            });
            $('.page-' + currentPage).addClass('active');
        }

        function navPage(newPage) {
            pages.forEach(function(page) {
                if (page === newPage) {
                    $('#pagination-index-' + page).fadeIn();
                } else {
                    $('#pagination-index-' + page).hide();
                }
            });
            drawPager(newPage);
            //console.log(updateQueryStringParameter(window.location.href, 'page', newPage));
            //window.location = updateQueryStringParameter(window.location.href, 'page', newPage);
        }

        navPage(1);
	  });


    /*
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    var startingPage = getParameterByName('page');
    if (!startingPage) {
        updateQueryStringParameter(window.location.href, 'page', 1);
    } else {
        navPage(getParameterByName('page'));
    }
    */

})( jQuery );
