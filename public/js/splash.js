function disableScrolling () {
  $('html, body').css({
    'overflow': 'hidden',
    'height': '100%'
  });
}

function enableScrolling () {
  $('html, body').css({
    'overflow': 'auto',
    'height': 'auto'
  });
}
/*
$(function () {
  disableScrolling()

  $('#continue-to-site-button').click(function () {
    enableScrolling()
    $('.splash').removeClass('splash-open')
  })
})
*/

$(function () {

  var $spaceman = $('#spaceman')
  var $feelAnEmotion = $('#feel-an-emotion-text-1')
  var $buttons = $('.splash button')
  $spaceman.addClass('moved')

  setTimeout(function () {
    $feelAnEmotion.addClass('show')
  }, 2000)

  setTimeout(function () {
    $buttons.addClass('show')
  }, 3000)

  $('.splash .play-video-button').click(function () {
    $spaceman.fadeOut(1000)
    $('.splash button').removeClass('show')
    $player = $(".splash iframe")
    $player.attr('src', $player.attr('src') + '&autoplay=1');
    $player.fadeIn(3000)
  })

  $('#scroll-down-button, #continue-to-site-button').click(scrollToSite)

  var ESCAPE_KEY = 27
  $(document).keyup(function(e) {
    if (e.keyCode === ESCAPE_KEY && $(document).scrollTop() === 0) {
      scrollToSite()
    }
  });

  return;
})

function scrollToSite () {
  $('html, body').animate({
    scrollTop: $('#content').offset().top
  }, 1500);
}
