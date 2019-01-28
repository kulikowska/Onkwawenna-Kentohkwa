(function( $ ) {
	'use strict';
	  $(document).ready(function() {

        // remove audio event from elements with no content
        $("p").each(function(index) {
            if ($(this).text().trim().length === 0) {
                $(this).off();
                $(this).addClass('no-hover-events');
            }
        });

        //Pagination stuff
        var pages = [];
        var activePage = 1;

        // Break unit down into sections
        var pageCount = 0;

				$('.entry-content').children().each(function(index) {
					if($(this).is('.no-hover-events') && index<30) {
						$(this).hide();
					}
				});

				// Write something to identify the classes for italics

				var headerElements = [];
				$("body").find("span").each(function(){
					// Give ~22px to match 16pt
					if(parseInt($(this).css('fontSize'))>=21 && $(this).css('fontStyle')==='italic') {
						headerElements.push($(this));
					}
				});

        headerElements.forEach(function(element, index) {
					if(headerElements[index + 1]) {
            var firstEl = element.parentsUntil('.entry-content').last();
            var secondEl = headerElements[index + 1].parentsUntil('.entry-content').last();


            if (firstEl.get(0) !== secondEl.get(0)) {
                pageCount++;
                pages.push(pageCount);
                firstEl.nextUntil(secondEl).addBack().wrapAll('<div id="pagination-index-' + pageCount +'">');

                console.log('page ', pageCount, ' has ', firstEl.nextUntil(secondEl).addBack().text().length, ' characters');
            }
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
            $('#pagination-index-' + currentPage).append(pager);

            if (currentPage !==1 ) {
                $('.prevButton').addClass('active').on('click', function() { navPage(currentPage - 1); });
            }
            if (currentPage !== pages.length) {
                $('.nextButton').addClass('active').on('click', function() { navPage(currentPage + 1); });
            }

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
            $('html, body').animate({
                scrollTop: ($('.entry-content').offset().top - 30)
            },0);

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




        //Attempt at breaking down pages by character count as well.
        //Almost works, but for some reason misses some content sometimes.

        var els = $('.c14 .c16');
        for (var i = 0; i < els.length; i++) {
            var firstEl = $('.c14 .c16').eq(i).parentsUntil('.entry-content').last();
            var secondEl = $('.c14 .c16').eq(i + 1).parentsUntil('.entry-content').last();

            var count = 0;
            while (firstEl.nextUntil(secondEl).addBack().text().length < 500) {
                count++;
                secondEl = $('.c14 .c16').eq(i + count).parentsUntil('.entry-content').last();
            }

            if (firstEl.get(0) !== secondEl.get(0)) {

                pageCount++;
                pages.push(pageCount);
                firstEl.nextUntil(secondEl).addBack().wrapAll('<div id="pagination-index-' + pageCount +'">');
                console.log('page ', pageCount, ' has this many characters: ', firstEl.nextUntil(secondEl).addBack().text().length);

            		i += count;
						}
        }



})( jQuery );
