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
<h3>Project 1: Creating Images from the Prokudin-Gorsky collection</h3>

<a href="https://en.wikipedia.org/wiki/Sergey_Prokudin-Gorsky">Sergey Prokudin-Gorsky</a> was a photographer of the Russian Empire, and is famous for color photographs taken in the early 1900's.  Many of his photographs are now in the library of Congress.  

<h4> Goals: </h4>
The goal of this lab is to take the digitized Prokudin-Gorskii glass plate images and produce a color image with as few visual artifacts as possible. There are a few steps in this process:
<ol>
  <li> Split the image into three color channel images
  <li> Align the images to each other
  <li> Composite the channels into a single RGB image.
</ol>



<a img="https://tile.loc.gov/storage-services/service/pnp/prok/00000/00090v.jpg">
