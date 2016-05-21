<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js full"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>LOST COUSINS | OFFICIAL SITE</title>
        <meta name="description" content="Formed in 2014 and based in Kingston, ON, Canada, Lost Cousins is a unique group that is continually trying to push the boundaries of the broad genre of 'Indie Rock.'">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/splash.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/layout.css">
        <link rel="stylesheet" href="css/layout-mobile.css">

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!-- include facebook sdk for like button -->
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=389406421214163&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <!-- twitter scripts for follow button -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- SPLASH -->
        <?php include 'views/splash.php'; ?>

        <!-- BEGIN CONTENT -->
        <!-- background image -->
        <div class="container" id="content">
            <!-- for screen readers -->

            <!-- Header -->
            <h1 class="hidden">Lost Cousins</h1>
            <a href="#">
                <img data-toggle="modal" href="#download-modal" data-target="#download-modal" id="logo-treehouse" class="element" src="./img/logo-treehouse.png" alt="Lost Cousins">
            </a>

            <!-- Nav Buttons -->
            <div id="main-nav">
                <a class="scrollnav" href="#player">
                    <img id="listen-button" class="element" src="./img/buttons/listen-button.png" alt="Go To Music Player">
                </a>
                <a class="scrollnav" href="#tour">
                    <img id="tour-button" class="element" src="./img/buttons/tour-button.png" alt="Go To Tour Dates">
                </a>
                <a class="scrollnav" href="#media-top">
                    <img id="social-button" class="element" src="./img/buttons/social-button.png" alt="Go To Social Section">
                </a>
            </div>

            <img id="little-fish" class="element" src="./img/little-fish.png">
            <img id="greeting" class="element" src="./img/greeting.png" alt="Hello, we are Lost Cousins, nice to meet you. Have a listen to our songs.">
            <p class="hidden">Hello, we are Lost Cousins, nice to meet you. Have a listen to our songs.</p>

            <div id="player" class="element" ng-app="plangular" plangular="https://soundcloud.com/lostcousinsband/sets/not-now-what-we-were-2015">
                <a href="http://soundcloud.com/lostcousinsband" target="_blank">
                    <img id="soundcloud-logo" src="./img/player/soundcloud-logo.png" data-toggle="tooltip" data-placement="right" title="Listen on Soundcloud">
                </a>

                <div id="track-listing">
                  <ul>
                    <li ng-repeat="track in tracks">
                      <button
                        class="song-button"
                        title="Play {{track.title}}"
                        ng-class="{'is-active': player.playing === track.src }"
                        ng-click="playPause($index)">
                          {{track.title}}
                      </button>
                    </li>
                  </ul>
                </div>
                <div id="song-player">
                    <div class="player">
                        <button title="Play/Pause" class="play-pause-button" ng-click="playPause(index)">
                          <svg class="play-icon play-pause-icon icon geomicon" ng-if="player.playing !== track.src" viewBox="0 0 32 32" data-icon="play" opacity=".6">
                              <path d="M4 4 L28 16 L4 28 z "></path>
                          </svg>
                          <svg class="pause-icon play-pause-icon icon geomicon" ng-if="player.playing === track.src" viewBox="0 0 32 32"  data-icon="pause" opacity=".6">
                              <path d="M4 4 H12 V28 H4 z M20 4 H28 V28 H20 z "></path>
                          </svg>
                        </button>
                        <button title="Play Next Track" class="next-track-button" ng-click="next()">
                          <svg class="next-track-icon icon geomicon" data-icon="next" opacity=".6">
                            <path d="M4 4 L24 14 V4 H28 V28 H24 V18 L4 28 z "></path>
                          </svg>
                        </button>

                        <progress class="song-seeker" ng-value="currentTime / duration" ng-click="seek($event)">{{ currentTime / duration || 0 }}</progress>

                        <!-- download button -->
                        <a data-toggle="modal" href="#download-modal" data-target="#download-modal" id="download-button" title="Download our music!">
                            <span class="glyphicon glyphicon-cloud-download"></span>
                            Download our EP
                        </a>
                    </div>
                </div>
            </div>
            <div id="tour"></div>
            <!-- end players -->
            <img id="blue-unicorn" class="element" src="./img/tour/blue-unicorn.png" alt="Blue Unicorn">
            <img id="road" class="element" src="./img/tour/road.png" alt="Road">
            <img id="orange-narwhal" class="element" src="./img/tour/orange-narwhal.png" alt="Orange Narwhal">
            <img id="when-are-we" class="element" src="./img/tour/when-are-we.png" alt="When Are We Headed your Way?">

            <h2 class="hidden">Tour Dates</h2>

            <div id="tour-dates">
                <!-- Tour dates will be dynamically inserted -->
            </div>
            <div id="media">
              <div id="forest">
                <div id="media-top"></div>
                <img id="forest-img" src="./img/social/forest.png" />
                <img id="find-the-cousins" class="element" src="./img/social/find-the-cousins.png" />

                <!-- social media buttons -->

                <a href="http://twitter.com/lostcousinsband" target="_blank">
                    <img id="follow-twitter" class="element social-link" src="./img/social/follow-twitter.jpg" />
                </a>
                <a href="http://instagram.com/lostcousinsband" target="_blank">
                    <img id="follow-instagram" class="element social-link" src="./img/social/follow-instagram.jpg" />
                </a>
                <a href="http://facebook.com/lostcousinsband" target="_blank">
                    <img id="like-facebook" class="element social-link" src="./img/social/like-facebook.jpg" />
                </a>

              </div><!-- end forest -->

              <form id="mailing-list-form">
                <button id="mailing-list-submit-button" type="submit" class="btn btn-primary">Join Mailing List</button>
                <div id="mailing-list-input-container">
                  <input type="text" placeholder="ex. your.name@gmail.com" name="email" />
                </div>
              </form>

              <div class="media-section page-section" id="twitter-feed">
                  <h2>
                      <a href="http://twitter.com/lostcousinsband" target="_blank">
                          Twitter
                      </a>
                  </h2>
                  <div id="tweets">
                      <a class="twitter-timeline"
                          data-chrome="noheader noborders transparent nofooter"
                          data-link-color="#8e1d08"
                          data-dnt="true"
                          data-widget-id="511362229178871808"
                          height="500"
                          href="https://twitter.com/LostCousinsBand"></a>

                      <script>
                          !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
                              if(!d.getElementById(id)){js=d.createElement(s);js.id=id;
                              js.src="//platform.twitter.com/widgets.js";
                              fjs.parentNode.insertBefore(js,fjs);}
                          }(document,"script","twitter-wjs");
                      </script>
                  </div>
              </div>
              <div class="media-section page-section" id="instagram-feed">
                  <h2>
                      <a href="http://instagram.com/lostcousinsband" target="_blank">
                          Instagram
                      </a>
                  </h2>
                  <div id="instagram-photos">
                      <!-- Photos will be dynamically inserted -->
                  </div>
              </div>
              <div class="media-section page-section" id="youtube">
                  <h2>
                      <a href="http://youtube.com/lostcousinsband" target="_blank">
                          Videos
                      </a>
                  </h2>
                  <div id="videos">
                      <iframe src="https://player.vimeo.com/video/135092427" width="640" height="390" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                      <iframe src="https://player.vimeo.com/video/126845367" width="640" height="390" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                  </div>
              </div>
            </div><!-- end media -->
            <div id="footer" class="page-section">
                <h4>for booking inquiries, email <a href="mailto:lostcousinsband@gmail.com">
                    lostcousinsband@gmail.com
                </a></h4>
                <p>
                    (site designed by
                    <a href="https://www.behance.net/madisonnewey" target="_blank">
                        mady newey
                    </a>
                    w/ lost cousins &amp; maintained on
                    <a href="https://github.com/thomasdashney/lost-cousins-website" target="_blank">
                    github</a>)
                </p>
            </div>
        </div>
        <!-- /.container -->

        <!-- download modal -->
        <!-- Modal -->
        <div class="modal fade" id="download-modal" tabindex="-1" role="dialog" aria-labelledby="download-label" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body container-fluid text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2>Download Our Debut EP</h2>
                <a href="#free-download" class="free-download-link">for free</a> or
                <a target="_blank" href="http://lostcousins.bandcamp.com/album/not-now-what-we-were?action=buy">
                    by donation
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- free download modal -->
        <!-- Modal -->
        <div class="modal fade" id="free-download-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body container-fluid text-center">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <p>enter your email to enable download</p>
                <input placeholder="e.g. john.smith@gmail.com" class="email-field form-control">
                <a href="./Lost Cousins - Not Now What We Were (2015).zip" id="free-download-link" class="btn btn-primary disabled" target="_blank">Download</a>
                <p class="signup-notice">
                    by downloading, you agree to opt-in to the LC mailing list
                    <br>
                    (feel free to unsubscribe at any time!)
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- END CONTENT -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/vendor/customize-twitter-1.1.min.js" type="text/javascript"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/lodash.compat.min.js"></script>
        <!-- analytics setup -->
        <script src="js/analytics.js"></script>

        <!-- music player stuff -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
        <script src="js/vendor/plangular.min.js"></script>
        <!-- templating -->
        <script src="js/vendor/handlebars-v2.0.0.js"></script>

        <script src="js/main.js"></script>
        <script src="js/splash.js"></script>

        <script id="show-template" type="text/x-handlebars-template">
            {{#if shows}}
                <table>
                    <tr>
                        <th>
                            <img alt="Date" src="./img/tour/table-headers/date.png">
                        </th>
                        <th>
                            <img alt="Venue" src="./img/tour/table-headers/venue.png">
                        </th>
                        <th>
                            <img alt="Location" src="./img/tour/table-headers/location.png">
                        </th>
                        <th>
                            <img alt="Tickets" src="./img/tour/table-headers/tickets.png">
                        </th>
                    </tr>
                  {{#shows}}
                    <tr>
                        <td>{{date.display}}</td>
                        <td>
                            {{#if venue.link}}
                                <a href="{{venue.link}}" target="_blank">
                            {{/if}}
                                {{venue.name}}
                            {{#if venue.link}}
                                </a>
                            {{/if}}
                        </td>
                        <td>{{location}}</td>
                        <td>
                            {{#if links.tickets}}
                            <a href="{{links.tickets}}" target="_blank">
                                <img src="./img/tour/ticket-icon.png">
                            </a>
                            {{/if}}
                            {{#if links.facebook}}
                            <a href="{{links.facebook}}" target="_blank">
                                <!-- todo: put in facebook icon -->
                                <img src="./img/tour/facebook-icon.png">
                            </a>
                            {{/if}}
                            {{#if links.songkick}}
                            <a href="{{links.songkick}}" target="_blank">
                                <img src="./img/tour/songkick-icon.png">
                            </a>
                            {{/if}}
                        </td>
                    </tr>
                  {{/shows}}
                </table>
            {{else}}
                <div class="no-upcoming-shows">
                    (there are no upcoming shows)
                </div>
            {{/if}}

        </script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-55457024-1');ga('send','pageview');
        </script>
    </body>
</html>
