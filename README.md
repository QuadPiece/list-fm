list-fm
=======

list.fm is a simple site to show your recent last.fm tracks that requires minimal setup

How to set up
=======

* Place the files on a web server that supports PHP
* Change the feed url in fetch.php to your own (Read below for details)
* Change the username in index.php (To whatever, doesn't have to be your last.fm name)

Where do I find my feed URL?
======

The feed URL is always:

```
http://ws.audioscrobbler.com/2.0/user/**yourusername**/recenttracks
```

So for the user 'quadpiece' the URL would be:

```
http://ws.audioscrobbler.com/2.0/user/quadpiece/recenttracks
```
