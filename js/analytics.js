/**
 * Listen for events and send them to google analytics
 */

$(document).ready(function() {
  // Music Player Stuff
  // played drift
  $('#drift .play-pause-button').click(function() {
    ga('send', 'event', 'Music Players', 'Click Drift Play/Pause');
  });  
  // clicked elegy play button
  $('#drift .play-pause-button').click(function() {
    ga('send', 'event', 'Music Players', 'Click Elegy Play/Pause');
  });
});

$(window).load(function() {
  // bind links to window load--they get added fairly late
  $('a').click(function() {
    var link = $(this).attr('href');
    ga('send', 'event', 'Links', 'Click ' + link);
  });
});