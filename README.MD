### What Problem does this project solve?
It makes it easy to import large librarys of text articles into Drupal Quickly.

### Who will use this project?

PLR Importer helps writers focus on writing great articles because it lets them write in the writing tool they are most used to like word or note and not worry about learning how to write in Drupal or even worry about learning anything about Drupal.

Writers will simply save there articles as a plain text document that follows a simple format that looks like this.

The first line of the article is the title.
The rest of the page is the article content. Just plain text no with graphics or tables or anything but the article text.

After the writer is done they save their article into a folder that has the name of the topic of the articles it contains.  Then they run the folder into a zip file to package it up.  

Then they can send that file into the PLR Importer Module in Drupal and it will automatically create the articles in Drupal and tag the article with the name of the folder the articles were saved in.  This saves a bunch of time because the articles are processed all at the same time. 
Then the articles get displayed in the theme of the Drupal site and the fonts and styles are always consistent with the look and feel of the theme.
This also is a big time saver for blog editors who purchase PLR Article packs from PLR sites and get 100’s of articles at a time.   They can instantly upload that folder into Drupal and it will create all the Article nodes.  

If the site has workflows setup then the articles that get uploaded will be ready for the Publisher or Content Manager to review and make any final edits in Drupal and then publish them.

This works great for community newspaper organizations and community groups that have a team of content creators and don’t want to require them to all have to log in to the Drupal site just to edit an article.  They can just email their articles as zip files to the Site Manager and they can then upload the zip files into Drupal. 
Future versions of this module will allow for different article formats to be imported automatically so the various PLR Library formats can be quickly imported and the content organized correctly.
Future PLR Import Engine plugin extensions will allow for importing Word Docs and possibly PDF documents too.
And with the many available PDF creation modules available you can allow visitors to print out your content as PDF’s for simple reading, printing and sharing.

### More technical info follows here:


This application converts txt files into .csv files.
This application allows the upload of a .zip file with a folder containing .txt files that have a known format of 

## Line 1 - Contains the title of the article.
## Line 2 - EOF contains the body of the article.

The goal of this application is to create a combined .csv file of all the article files in the folder so that the .csv file can be upoaded into a cms such as Drupal or WordPress if the cms has a module or plugin that can accept a .csv file as input and convert them to articles or posts in the blog.

Work is in progress to meld various article formats which can be imported to match the various PLR library article formts one can find.

Work is being done to allow the direct import of the files into Drupal Article Nodes and skip the conversion of the .txt file into .csv file that then would need to be manually uploaded via a csv importer Module or Plugin.

Different extensible format engines are being developed to allow a number of PLR formats to be imported and converted to Article Nodes in Drupal and Posts in WordPress and 
HUGO Markdown Post formats.

This project is looking for development contributors and funding sponsors to help continue the development of it.

It is based on the LAMP stack and the CMS system that run on the LAMP stack as well as HUGO and REACT based web sites.

This project will eventually allow the upload of a nested folder structure of topical folder names which contain articles which would be taged as the name of the folder for taxonomi and catagory classification.

Eventually the application will be released into the Druapl Marketplace for Modules and the WordPress Plugin Directory as well as from here in Git Hub.

Concept Developer: Michael Scott McGinn
Lead Developer: Ed Reel

This project is looking for funding for the development of it. Visit https://givesendgo.com/plrimporter to help support it.

