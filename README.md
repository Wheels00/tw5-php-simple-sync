# tw5-php-simple-sync
a basic sync adaptor and php syncing scripts for TiddlyWiki 5

Proof of concept

## Concept

On a web-server:

- empty+plugins.html  <--- the core wiki with plugins baked in
- content1.tid   <--- a .tid file to be synced
- content2.tid  <--- a .tid file to be synced
- content3.tid   <--- a .tid file to be synced
- getSkinnyTiddlers.php  <-- a php script that compiles a set of skinny tiddlers from all .tid files and echoes as json
- saveTiddler.php <-- a php script that takes a file upload and saves as a .tid
- loadTiddler.php <-- that takes a GET parameter as a .tid file name and echoes the full tiddler as json
- deleteTiddler.php <-- that takes a GET parameter as a .tid file name and deletes that file

In a corresponding sync adaptor plugin:

- the constructor method
- methods corresponding to each of the 4 php scripts, doing an http request to that script


That's it. No database back-end, python, or nodejs.


## FAQ

### Is it robust?

Ummm. Improving (thanks to jtejkl's commits) but largly untested. 

### Is it secure?

No. There is zero authentication in this version.

### Is it compatible with Tiddlywiki 5.1.13?

No, only 5.1.14

### How is it installed? 

Copy the folder to a php-enabled web server. The syncadaptor is baked into the html file and expects all php scripts to be in the same directory. 

## Wish list

- cross-session browser caching
- backups
- nicer well commented code
- config tiddler
- lazy loading

