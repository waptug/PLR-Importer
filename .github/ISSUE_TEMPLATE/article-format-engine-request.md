---
name: Article Format Engine Request
about: Describe the sturcture of your article format.
title: Import Engine Format Request
labels: ''
assignees: ''

---

Create an example of the format of the article you would like to be able to submit so we can create an import engine for it.

Example:

First Line contains: Title (max of 80 charterers)
Second Line is blank with a CR/LF
Third line to the End of File contains the body of the Article. Paragraphs are separated by CR/LF 
The last line of the file may contain a code of PPPPPP to indicate the end of the file but may not always be present.
The last line of the file may also be a Char Count (xxxx) indicator but may not always be present.
Both the PPPPPP and Char Count (xxx) may be present at the end of the file but not always available.

File will be in UTF8 char set. 
File will be in .txt format
