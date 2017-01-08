

/**
 * JS code for the site
 */

/* global $ */
/* global _ */
/* global Handlebars */

var instagramPendingReload = false;
var nextInstagramUrl = false; // set initial nextUrl

$(document).ready(function() {
  window.hasPlayedMusic = false;
  // increment the track playlist to track 2 (feel an emotion)
  // if the play button is pressed before any music has played
  var player = angular.element(document.getElementById('player')).scope();
  player.audio.addEventListener('playing', function() {
      window.hasPlayedMusic = true;
  });
  $('.play-pause-button').one('click', function() {
      if (!window.hasPlayedMusic) {
          player.next();
      }
  });

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

  $('.free-download-link').click(function() {
    $('#download-modal').modal('hide'); // hide current modal
    // when it's hidden, open the other modal
    $('#download-modal').on('hidden.bs.modal', function () {
      $('#download-modal').off('hidden.bs.modal'); // prevent future func exec
      // make new modal come up
      $('#free-download-modal').modal('show');
    });
  });

  // make sure email field closes when modal is closed
  $('#free-download-modal').on('shown.bs.modal', function() {
    $('#free-download-modal .email-field').val('');
  });

  // when a valid email is entered, enable download link
  $emailField = $('.email-field');
  $emailField.data('oldVal', $emailField.val());
  $emailField.on('propertychange change click keyup input paste', function() {
    var value = $('.email-field').val()
    if ($emailField.data('oldVal') != value) {
      $emailField.data('oldVal', value);
      if (isValidEmail(value))
        $('#free-download-link').removeClass('disabled');
      else
        $('#free-download-link').addClass('disabled');
    }
  });

  $('#free-download-link').click(function() {
    var email = $('.email-field').val();
    $.post('php/submit_email.php', {email: email})
      .then(function(data) {
        console.log('Email post successful');
        console.log(data)
      })
      .fail(function(data, status, error) {
        console.log('Email post failed');
        console.log(error);
      });
    $('#free-download-modal').modal('hide');
  });

  // when free download is clicked, post email to server and start download

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

  var $emailField = $('#mailing-list-form input')
  var $mailingListButton = $('#mailing-list-submit-button')

  $emailField.on('propertychange change click keyup input paste', function() {
    if ($emailField.data('oldVal') != $emailField.val()) {
      $emailField.data('oldVal', $emailField.val());
      var input = $emailField.val();
      if (isValidEmail(input))
        $mailingListButton.removeClass('disabled');
      else
        $mailingListButton.addClass('disabled');
    }
  });

  // mailing list button
  $('#mailing-list-form').submit(function (e, vals) {
    e.preventDefault()
    var email = $emailField.val()
    if (!isValidEmail(email)) return

    $.post('./php/submit_email.php', { email: email }, function (done) {
      $emailField.val('')
    })
  })

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
    var skShows = res.resultsPage.results.event || []; // should be fine in sk api 3.0
    var shows = {};
    for (var i = 0; i < skShows.length; i ++) { // for each soundcloud event
      // get the songkick show object
      var skShow = skShows[i];

      // make sure show isn't cancelled or something
      if (skShow.status !== 'ok')
        continue;

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
    $.getJSON('shows.json').always(function gotData(customShows) {
      if (customShows) {
        // for each id
        for (var id in customShows) {
          // convert the date object to the correct format
          var show = customShows[id];
          if (show.date && !show.dateDisplay) {
            var date = new Date(show.date);
            show.date = {
              obj: date,
              display: dateFormat(date)
            };
          }
          else if (show.dateDisplay) {
            show.date = {
              display: show.dateDisplay
            }
            delete show.dateDisplay;
          }
        }
        shows = _.merge(shows, customShows); // merge sk shows w/ custom shows
      }
      // delete any shows that are too old
      var today = new Date();
      var yesterday = new Date();
      yesterday.setDate(today.getDate()-1);
      for (var id in shows) {
        var show = shows[id];
        if (!show.date ||
            (show.date.obj < yesterday) ||
            (show.announced && show.announced === 'false'))
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
      access_token: '1409521348.1677ed0.cba7520b1207476aa84283c78cbb05ec',
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
      var caption = '';
      // there might not be a caption, so only set it if it's there
      if (photo.caption && photo.caption.text)
        caption = photo.caption.text;
      console.log('photo', photo)
      return {
        img: photo.images.low_resolution,
        caption: caption,
        time: photo.created_time,
        link: photo.link,
        isVideo: photo.type === 'video'
      };
    }),
    nextUrl: res.pagination.next_url || false
  };
}

var instagramTemplate =
  '<a href="{{link}}" target="_blank">' +
    '<div class="inst-img">' + // for effect
      '<img src="{{url}}" class="{{#if isVideo}}fade{{/if}}">' +
      '{{#if isVideo}}' +
        '<span class="glyphicon glyphicon-play instagram-video-play"></span>' +
      '{{/if}}' +
      '<div class="photo-caption" style="display: none;">' +
        '<p class="date">{{date}}</p>' +
        '<hr>' +
        '<p class="caption">{{caption}}</p>' +
      '</div>' +
    '</div>' +
  '</a>';
var generateInstagramHtml = Handlebars.compile(instagramTemplate);

function generateInstagramImgElement(photos) {
  var html = '';
  for (var i = 0; i < photos.length; i++) {
    var photo = photos[i];
    // format date
    var datef = dateFormatWithYear(new Date(parseInt(photo.time)*1000));
    html += generateInstagramHtml({
      link: photo.link,
      url: photo.img.url,
      date: datef,
      caption: photo.caption,
      isVideo: photo.isVideo
    })
  }
  return html;
}

function insertInstagramPhotos(photos) {

  var html = generateInstagramImgElement(photos);
  // insert images
  $('#instagram-photos').append(html);
  // apply hover listener effect to inserted images
  var fadeInAmount = 100
  $('#instagram-photos .inst-img').hover(
    function mouseEnter() {
      var div = $(this);
      // hide play button
      div.find('.instagram-video-play').hide()
      // darken background and add image transparency
      div.addClass('darken');
      // show caption
      div.children('.photo-caption').fadeIn(fadeInAmount);
    },
    function mouseLeave() {
      var div = $(this);
      // show play button
      div.find('.instagram-video-play').show()
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

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
