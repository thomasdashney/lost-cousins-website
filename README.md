Lost Cousins Band Website
====================

Website for Lost Cousins (Indie rock band from Kingston, ON Canada).

It is hosted here: http://findlostcousinsband.com

This project was designed by [Mady Newey](https://www.behance.net/madisonnewey) and developed/maintained by [Thomas Dashney](https://github.com/thomasdashney)

Check out Lost Cousins at any of the following networking sites:
* [Bandcamp](https://lostcousins.bandcamp.com)
* [Soundcloud](https://soundcloud.com/lostcousinsband)
* [Facebook](https://facebook.com/lostcousinsband)
* [Twitter](https://twitter.com/lostcousinsband)
* [Instagram](https://instagram.com/lostcousinsband)
* [Songkick](https://songkick.com/lostcousinsband)

Features
--------------------

* Custom songkick player using [Plangular](https://github.com/jxnblk/plangular)
* Custom show listing using the [Songkick API](https://www.songkick.com/developer)
* Customized twitter feed using [this widget](https://github.com/kevinburke/customize-twitter-1.1)
* Completely custom-built instagram feed

Set Up
---------------------

* To set up for development, fork this repo and clone locally.
* _Important_: The project uses LESS and compiles to CSS. I made use of a simple less-watch-compiler, which can be found [here](https://github.com/jonycheung/Dead-Simple-LESS-Watch-Compiler). If you have node.js installed on your machine, `cd` into the project directory and run `node less-watch-compiler less css`. This will auto-compile any .less files in the `less` directory into the `css` directory.


Songkick Listing
---------------------

You can add/modify the data pulled in by songkick by adding a `shows.json` file to the root of the project directory root. An example would be the following: 
```json
{
    
	"brooklyn-gig": {
		"date": "Nov 28 2014",
		"venue": {
			"name": "The Brooklyn w/ Devan & Khalid",
			"link": "https://www.songkick.com/venues/2752613-brooklyn"
		},
		"location": "Kingston, ON, Canada"
	},
	"cameron-house-gig": {
		"date": "Dec 18 2014",
		"venue": {
			"name": "Cameron House",
			"link": "http://www.songkick.com/venues/105891-cameron-house"
		},
		"location": "Toronto, ON, Canada"
	},
	"25368344": {
		"venue": {
			"name": "The Mansion w/ Will Hunter Band"
		}
	}
}
```
The root-level keys can be any arbitrary string. This allows you to add more show information in addition to the Lost Cousins data pulled in from Soundcloud.

If the root-level key corresponds to a songkick show, any data defined in the javascript object will override the corresponding data pulled in from songkick.

Any dates from the past are filtered off of the site.

Contributing
---------------------

If you're generous enough to contribute to our site, submit a pull request and we can go from there! :)
