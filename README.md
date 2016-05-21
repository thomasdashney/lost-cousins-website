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
* [Songkick](https://www.songkick.com/artists/8158333-lost-cousins)

Features
--------------------

* Custom songkick player using [Plangular](https://github.com/jxnblk/plangular)
* Custom show listing using the [Songkick API](https://www.songkick.com/developer)
* Customized twitter feed using [this widget](https://github.com/kevinburke/customize-twitter-1.1)
* Completely custom-built instagram feed

Set Up (Development)
---------------------

* Fork this repo and clone locally: `git checkout https://github.com/thomasdashney/lost-cousins-website.git`
* The project uses LESS and compiles to CSS. I made use of a simple less-watch-compiler, which can be found [here](https://github.com/jonycheung/Dead-Simple-LESS-Watch-Compiler).
    * Install Node.js v0.12
		* Install less on your machine: `npm install -g less`
		* `npm start` to watch for file changes
* To set up a simple LAMP server, you can use the provided vagrant file (courtesy of [scotch-box](https://github.com/scotch-io/scotch-box)).
    * Install [Vagrant](https://www.vagrantup.com/downloads.html)
    * Install [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
    * `cd` into `lost-cousins-website` and run `vagrant up`
    * The site is now live at `http://192.168.33.10/`
* To setup the database:
    * `vagrant ssh` to gain access to the box
    * `cd /var/www` to go to the repository's files. Only the `public` folder here is exposed via the HTTP server.
    * Run the following two commands from the command line to setup the database directly from the command line. When prompted, the database password is `root`
        * `mysql -u root -p -e "create database lost_cousins"`
        * `mysql -u root -p lost_cousins < db/structure.sql`

Songkick Listing
---------------------

You can add/modify the data pulled in by songkick by adding a `public/shows.json`. An example would be the following:
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
