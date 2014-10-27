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

        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/layout.css">
        <link rel="stylesheet" href="css/layout-mobile.css">
        <!-- ensure elements are hidden initially (to be revealed) -->
        <style> [data-sr] { visibility: hidden; } </style>

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

        <!-- BEGIN CONTENT -->
        <!-- background image -->
        <div class="container" id="content">
            <!-- for screen readers -->

            <!-- Header -->
            <h1 class="hidden">Lost Cousins</h1>
            <img data-sr id="logo-treehouse" class="element" src="./img/logo-treehouse.png" alt="Lost Cousins">

            <!-- Nav Buttons -->
            <div id="main-nav">
                <a class="scrollnav" href="#players">
                    <img data-sr id="listen-button" class="element" src="./img/buttons/listen-button.png" alt="Go To Music Player">
                </a>
                <a class="scrollnav" href="#tour">
                    <img data-sr id="tour-button" class="element" src="./img/buttons/tour-button.png" alt="Go To Tour Dates">
                </a>
                <a class="scrollnav" href="#media-top">
                    <img data-sr id="media-button" class="element" src="./img/buttons/media-button.png" alt="Go To Media Section">
                </a>
            </div>

            <img data-sr id="little-fish" class="element" src="./img/little-fish.png">
            <img data-sr id="greeting" class="element" src="./img/greeting.png" alt="Hello, we are Lost Cousins, nice to meet you. Have a listen to our songs.">
            <p class="hidden">Hello, we are Lost Cousins, nice to meet you. Have a listen to our songs.</p>

            <div data-sr  id="players" class="element" ng-app="plangular">
                <a href="http://soundcloud.com/lostcousinsband" target="_blank">
                    <img id="soundcloud-logo" src="./img/player/soundcloud-logo.png" data-toggle="tooltip" data-placement="right" title="Listen on Soundcloud">
                </a>
                <!-- download button -->
                <a href="http://lostcousins.bandcamp.com/album/drift-elegy-single?action=buy" target="_blank" id="download-button" data-toggle="tooltip" data-placement="left" title="Download our music!">
                    <span class="glyphicon glyphicon-cloud-download"></span>
                </a>
                <div id="drift">
                    <div class="player" v-component="plangular" v-src="'http://soundcloud.com/lostcousinsband/feel-an-emotion-live-radio-cut'">
                        <button id="drift-button"></button>
                        <button class="play-pause-button" v-on="click: playPause()">
                          <svg class="play-icon play-pause-icon" v-if="player.playing != track" v-plangular-icon="'play'" opacity=".8"></svg>
                          <svg class="pause-icon play-pause-icon" v-if="player.playing == track" v-plangular-icon="'pause'" opacity=".8"></svg>
                        </button>

                        <progress class="song-seeker" v-show="player.playing == track" value="{{ currentTime / duration || 0 }}" v-on="click: seek($event)">{{ currentTime / duration }}</progress>
                        <progress class="song-seeker-not-playing" v-show="player.playing != track" value="{{ currentTime / duration || 0 }}" v-on="click: seek($event)">{{ currentTime / duration }}</progress>  
                    </div>
                </div>
                <div id="elegy">
                    <button id="elegy-button"></button>
                    <div class="player" v-component="plangular" v-src="'http://soundcloud.com/kidinkofficial/kid-ink-body-language-ft-usher-tinashe'">
                        <div id="elegy-player"></div>
                        <button class="play-pause-button" v-on="click: playPause()">
                          <svg class="play-icon play-pause-icon" v-if="player.playing != track" v-plangular-icon="'play'" opacity=".8"></svg>
                          <svg class="pause-icon play-pause-icon" v-if="player.playing == track" v-plangular-icon="'pause'" opacity=".8"></svg>
                        </button>

                        <progress class="song-seeker" v-show="player.playing == track" value="{{ currentTime / duration || 0 }}" v-on="click: seek($event)">{{ currentTime / duration }}</progress>
                        <progress class="song-seeker-not-playing" v-show="player.playing != track" value="{{ currentTime / duration || 0 }}" v-on="click: seek($event)">{{ currentTime / duration }}</progress>  
                    </div>
                </div>

                
            </div>
            <div id="tour"></div>
            <!-- end players -->
            <img data-sr id="blue-unicorn" class="element" src="./img/tour/blue-unicorn.png" alt="Blue Unicorn">
            <img data-sr id="road" class="element" src="./img/tour/road.png" alt="Road">
            <img data-sr id="orange-narwhal" class="element" src="./img/tour/orange-narwhal.png" alt="Orange Narwhal">
            <img data-sr id="when-are-we" class="element" src="./img/tour/when-are-we.png" alt="When Are We Headed your Way?">

            <h2 data-sr class="hidden">Tour Dates</h2>

            <div data-sr id="tour-dates">
                <!-- Tour dates will be dynamically inserted -->
            </div>
            <div id="media">
                <div data-sr id="media-top"></div>
                <img id="forest" class="element" src="./img/social/forest.png" />
                <img data-sr id="find-the-cousins" class="element" src="./img/social/find-the-cousins.png" />

                <!-- social media buttons -->

                <a href="http://twitter.com/lostcousinsband" target="_blank">
                    <img data-sr id="follow-twitter" class="element social-link" src="./img/social/follow-twitter.jpg" />
                </a>
                <a href="http://instagram.com/lostcousinsband" target="_blank">
                    <img data-sr id="follow-instagram" class="element social-link" src="./img/social/follow-instagram.jpg" />
                </a>
                <a href="http://facebook.com/lostcousinsband" target="_blank">
                    <img data-sr id="like-facebook" class="element social-link" src="./img/social/like-facebook.jpg" />
                </a>
                <!-- end social media buttons -->

                <div data-sr class="media-section" id="twitter-feed">
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
                <div data-sr class="media-section" id="instagram-feed">
                    <h2>
                        <a href="http://instagram.com/lostcousinsband" target="_blank">
                            Instagram
                        </a>
                    </h2>
                    <div id="instagram-photos">
                        <!-- Photos will be dynamically inserted -->
                    </div>
                </div>
                <div data-sr class="media-section" id="youtube">
                    <h2>
                        <a href="http://youtube.com/lostcousinsband" target="_blank">
                            Videos
                        </a>
                    </h2>
                    <div id="videos">
                        <iframe width="640" height="390" src="//www.youtube.com/embed/lJGgqes1COc" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div><!-- end media -->
            <div data-sr id="footer">
                <h4>for booking inquiries, email <a href="mailto:lostcousinsband@gmail.com">
                    lostcousinsband@gmail.com
                </a></h4>
                <p>
                    (site designed by 
                    <a href="https://www.behance.net/madisonnewey" target="_blank">
                        mady newey
                    </a>
                    w/ lost cousins)
                </p>
            </div>
        </div>
        <!-- /.container -->

        <!-- END CONTENT -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/vendor/customize-twitter-1.1.min.js" type="text/javascript"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/lodash.compat.min.js"></script>
        <script src="js/main.js"></script>
        <!-- analytics setup -->
        <script src="js/analytics.js"></script>


        <!-- enable scroll reveal effect -->
        <script src="js/vendor/scrollReveal.js"></script>
        <script>
            window.sr = new scrollReveal({
                mobile: false,
                reset: true,
                delay: 'once',
                vFactor: 0.2
            });
        </script>

        <!-- music player stuff -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.10.6/vue.min.js"></script>
        <script src="js/vendor/v-plangular.min.js"></script>
        <!-- templating -->
        <script src="js/vendor/handlebars-v2.0.0.js"></script>

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



        <script> 
            var vm = new Vue({ el: '#players' });
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
