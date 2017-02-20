# corona-fontmetrics-generator
A website to create font metrics for the Corona textrender code. The PHP code uses ImageMagick to read the headers of TTF files and extract the font metrics.
The metrics are written into a format that that the font metrics code in corona-textrender can read.

##Instructions
* Install the files from this project on a web server.
* Put TTF format fonts into the fonts folder.
* Open /index.php and wait a little bit...it can be slow.
* Copy the resulting text (beginning with the line with ###) from the screen.
* Paste it into your fontmetrics.txt in the appropriate place where the corona-textrender code will find it. You can add it to the existing fontmetrics.txt file, of course.
