<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"> 
<html> 
  <head> 
    <title> 
    robert pless - computational photography
    </title> 
    <meta name="keywords" content="robert pless, computational geometry course notes"> 
     <link rel="STYLESHEET" href="../mystyle.css" type="text/css">   
  </head> 
  <body> 
<?php include("../navbar.html") ?>
<div class="content"> 
<img src="project3/teaser.png" alt="Teaser Image" height="200" width="900" align="center" /> <br>
<h3> Project 4: Final Project</h3>


<h3>Due</h3>

This project has two due dates.  Projects *must* be turned in by May 2
at 10am. and will be graded ASAP, but for sure by May 4.  Possible
extensions for your specific project will be proposed to you along
with grade improvements.  Those extensions will be due by May 10.
Please turn in your project via
<a href="https://forms.gle/DLKoBtUZXDMJHvUAA">this form</a>.  As before, the project can be done in groups of 1 to 3.

<h3>Overview</h3>

<p class="text">The goal of the final project is to explore a
Computational Photography project of your choosing, putting together
some of the mathematical ideas that we've explored this semester,
along with some of the intuition about how those math theories
interact with specific images or problem domains.  I've also included
one possible project that you can "just do" if you don't have other
inspiriation.

  <h3>Possible Project Ideas</h3>
  <ol>
    <li> PhotoMosaics: This process takes an image as input, and tries
    to re-create that image with a large collection of other imtes
    (perhaps a 20x20 grid of other images), for
    example <a href="https://en.wikipedia.org/wiki/Photographic_mosaic#/media/File:Franz_Marc_Blue_Horse_1911_Photomosaic.jpg">this
    image</a>.  The process to do this takes a few steps (1) collect a
    big database of iamges (that you will use as your mosaic pieces).
    (2) take your target image and break it up into small times.  (3)
    For each tile, find the database image that is most similar.

    <p>The challenge in this project lies in (a) the choice of image
    database (you could use all pictures from GWU to recreate one big
    picture of GWU), and having an image database big enough so that
    you can find a good picture, and (b) having a good way to measure
    if a database picture matches the tile from the original picture.

    <p>The project works especially well if you allow the original
    pictures to be changed "just a little bit" (e.g. change the color
    a bit, or even crop the image slightly to better fit), but this
    requires more work and becomes a harder search problem becuase
    instead of saying, "which database image has a low-frequency that
    is closest to this tile", you instead have to ask, "which database
    image can I slightly change" to be closest to this tile.

    <p>There are write-ups on the web that explain how to do this --- for
    this project you must produce one output picture that started as a
    picture that *you* took, or a picture of GWU, and you must write the code
    the processes both that picture and the database of images that you use.
    </li>
    <li>Gradient Domain Image Editing/Poisson Image Editing </li> Read
    and implement the
    classic <a href="https://www.cs.jhu.edu/~misha/Fall07/Papers/Perez03.pdf">Perez
    paper</a>.  The <a href="gradientReconstruction.m">matlab code</a>
    from last lecture may be a good starting point.
    <li>Summarizing a <a href="https://eirikso.com/2011/01/04/one-year-in-one-image/">
long time-lapse video in a single image</a> like this one:</li>
    <img height=200 src="https://eirikso.files.wordpress.com/2011/01/allof20101.jpg?w=598&h=402">
  <li> You are welcome to try different projects if you'd like, drop me a quick note with your idea
  and I'll give feedback ASAP.</li>
</ol>
    

<p><b>Project Rules.</b>
  <p>First, you are <b>explicitly allowed</b> to look
  up online how other people have worked on this problem, including
  their code.  But you must be explicit in your writeup about all the
  sources that you use, what code you've used from others and what
  code you wrote yourself.
  <p>Second, if you use code that does some part of the problem, you must explain what code is yours, and what the functionality your code provides.
    <p>Third, you must produce output images that have never been
      produced before (using your own or otherwise new images).

  <p>Your project and write-up will be evaluated based on: (30%) the technical
  difficulty and novelty of the part of the project that required your
  code, (40%) the experimentation or other analysis you did to show
  where and why things do and don't work, and (30%)

  
</div>

