

/**
 * JS code for the music players to play the songs
 * This file is dependent on the inclusion of the soundcloud js sdk
 */

/* global $ */
/* global _ */
/* global Handlebars */

var instagramPendingReload = false;
var nextInstagramUrl = false; // set initial nextUrl

$(document).ready(function() {
  // navigation link scrolling
  $( 'a.scrollnav' ).click(function(event) {
    event.preventDefault();
    var target = $(this).attr('href');
    $('html, body').animate({
      scrollTop: $(target).offset().top - 49
    }, 1100);
  });

  // initialize tooltips
  $('[data-toggle="tooltip"]').tooltip({
    animation: true
  });

  // download button
  $downloadButton = $('#download-button');

  // blink download button whenever you click play
  $('.play-pause-button').click(function() {
    if (sessionStorage && !sessionStorage.hasPressedPlayOnce) {
      sessionStorage.hasPressedPlayOnce = true;
      $downloadButton.tooltip('show'); // show tooltip
    // hide tooltip after 2 seconds
    setTimeout(function hideTooltip() {
      $downloadButton.tooltip('hide');
    }, 3500);
    blink($downloadButton, 3);// set up 2 blinks
    }
  });


  CustomizeTwitterWidget({
    url: './css/twitter-styles.css'
  });

  // fetch show data
  loadShowData(function(shows) {
    // display it
    var template = $('#show-template').html();
    var generateShowsHtml = Handlebars.compile(template);
    $('#tour-dates').html(generateShowsHtml({
      shows: shows
    }));
  });

  // fetch instagram data
  getInitialInstagramData(function(err, data) {
    if (err) return;
    insertInstagramPhotos(data.photos);
    nextInstagramUrl = data.nextUrl;
    // set scroll function to fetch new images as needed
    $('#instagram-photos').scroll(function() {
      var div = $(this);
      var pixelsFromBottom = div[0].scrollHeight - div.scrollTop() - 430; // offset
      if (nextInstagramUrl && pixelsFromBottom < 200 && !instagramPendingReload) {
        instagramPendingReload = true;
        getMoreImages(nextInstagramUrl, function(err, data) {
          if (err) return;

          insertInstagramPhotos(data.photos);
          nextInstagramUrl = data.nextUrl;

          // set pendingreload to false
          setTimeout(function() {
            instagramPendingReload = false;
          }, 500);
        });
      }
    });
  });

});

var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 
              'Sep', 'Oct', 'Nov', 'Dec'];

// get show data through combination of songkick and custom data
function loadShowData(cb) {
  // get songkick concerts for Lost Cousins
  var songkickRequest = $.ajax({
    url: 'http://api.songkick.com/api/3.0/artists/8158333/calendar.json' +
    '?apikey=7tVdbqmnSHSGx1Eu',
    dataType: 'jsonp',
    jsonp: false,
    data: {
      jsoncallback: 'mycallback'
    },
    jsonpCallback: 'mycallback'

  });
  songkickRequest.done(function populateTourDates(res) {
    var skShows = res.resultsPage.results.event; // should be fine in sk api 3.0
    var shows = {};
    for (var i = 0; i < skShows.length; i ++) { // for each soundcloud event
      // get the songkick show object
      var skShow = skShows[i];

      // get a date object
      var d = skShow.start.date.split('-');
      var date = new Date(d[0],d[1]-1,d[2]);

      var songkickShow = {};

      // create date object w/ display
      songkickShow.date = {
        obj: date,
        display: dateFormat(date)
      };
      // create venue object
      songkickShow.venue = {
        name: skShow.venue.displayName,
        link: skShow.venue.uri
      };
      // get the city name
      songkickShow.location = skShow.location.city;
      // get the tickets link
      songkickShow.links = {
        songkick: skShow.uri
      };

      shows[skShow.id] = songkickShow;

    } // end shows loop
    // get custom show data
    $.getJSON('shows.json').done(function gotData(customShows) {
      console.log("customShows");
      console.log(customShows);
      // for each id
      for (var id in customShows) {
        // convert the date object to the correct format
        var show = customShows[id];
        if (show.date) {
          var date = new Date(show.date);
          show.date = {
            obj: date,
            display: dateFormat(date)
          };
        }
      }
      shows = _.merge(shows, customShows); // merge sk shows w/ custom shows
      // delete any shows that are too old
      var today = new Date();
      var yesterday = new Date();
      yesterday.setDate(today.getDate()-1);
      for (var id in shows) {
        var show = shows[id];
        if (show.date.obj < yesterday)
          delete shows[id]; // delete the show
      }
      shows = _.values(shows); // get an array of shows (no ids)
      shows = sortShowsByDate(shows); // sort shows by date
      return cb(shows); // call cb w/ shows
    });
  });
}

function dateFormat(date) {
  return months[date.getMonth()] + ' ' +
         date.getDate();
}

function dateFormatWithYear(date) {
  return months[date.getMonth()] + ' ' +
         date.getDate() + '.' +
         date.getFullYear().toString().substr(2);
}

function sortShowsByDate(shows) {
  return _.sortBy(shows, function(show) {
    return show.date.obj; // use date obj
  });
}


// instagram
function getInitialInstagramData(cb) {
  $.ajax({
    url: 'https://api.instagram.com/v1/users/1409521348/media/recent/',
    dataType: 'jsonp',
    data: {
      client_id: '713afb58f89349d4894fa6af23dd1887',
      count: 5
    }
  }).done(function(res) {
    return cb(null, parseInstagramResponse(res));
  });
}

function getMoreImages(url, cb) {
  $.ajax({
    url: url,
    dataType: 'jsonp'
  }).done(function(res) {
    return cb(null, parseInstagramResponse(res));
  }).fail(function(err) {
    cb(err);
  });
}

function parseInstagramResponse(res) {
  return {
    photos: res.data.map(function(photo) {
      return {
        img: photo.images.low_resolution,
        caption: photo.caption.text,
        time: photo.created_time,
        link: photo.link
      };
    }),
    nextUrl: res.pagination.next_url || false
  };
}

function generateInstagramImgElement(photos) {
  var html = '';
  for (var i = 0; i < photos.length; i++) {
    var photo = photos[i];
    // format date
    var datef = dateFormatWithYear(new Date(parseInt(photo.time)*1000));
    html += '<a href="' + photo.link + '" target="_blank">' + 
              '<div class="inst-img">' + // for effect
                '<img src="' + photo.img.url + '">' +
                '<div class="photo-caption" style="display: none;">' +
                  '<p class="date">' + datef + '</p>' +
                  '<hr>' +
                  '<p class="caption">' + photo.caption + '</p>' +
                '</div>' +
              '</div>' + 
            '</a>';
  }
  return html;
}

function insertInstagramPhotos(photos) {

  var html = generateInstagramImgElement(photos);
  // insert images
  $('#instagram-photos').append(html);
  // apply hover listener effect to inserted images
  $('#instagram-photos .inst-img').hover(
    function mouseEnter() {
      var div = $(this);
      // darken background and add image transparency
      div.addClass('darken');
      // show caption
      div.children('.photo-caption').fadeIn(100);
    }, 
    function mouseLeave() {
      var div = $(this);

      // remove darkness
      div.removeClass('darken');
      // hide caption
      div.children('.photo-caption').hide();
    }
  );
}

// set up flashing!
function blink($thingToBlink, numberOfTimesToBlink) {
  if (numberOfTimesToBlink === undefined)
    numberOfTimesToBlink = -1;
  if (numberOfTimesToBlink) {
    $thingToBlink.addClass('blinking');
    // blink for 100ms
    setTimeout(function() {
      $thingToBlink.removeClass('blinking');
      // set it to blink again in 1 seconds
      setTimeout(function() {
        blink($thingToBlink, numberOfTimesToBlink-1)
      }, 1000);
    }, 150);
  }
}