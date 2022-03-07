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
<img src="project2/lynx_ssd.jpg" alt="Teaser Image" height="200" width="900" align="center" /> <br>
<h3> Project 2: Hybrid Images</h3>


<h3>Due</h3>
Febuary 14, 10am.  Please turn in your project via
<a href="https://forms.gle/DLKoBtUZXDMJHvUAA">this form</a></h4>


<h3>Overview</h3>

<p class="text">The goal of this part of the assignment is to create <a
href="http://cvcl.mit.edu/hybridimage/">hybrid images</a> using the approach
described in the SIGGRAPH 2006 <a
href="http://cvcl.mit.edu/publications/OlivaTorralb_Hybrid_Siggraph06.pdf">paper</a>
by Oliva, Torralba, and Schyns. <i>Hybrid images</i> are static images that
change in interpretation as a function of the viewing distance. The basic idea is that high frequency tends
to dominate perception when it is available, but, at a distance, only the low
frequency (smooth) part of the signal can be seen. By blending the high frequency portion of one image with the low-frequency portion of another, you get a hybrid image that leads to different interpretations at different distances.
</p>

<h3>Details</h3>

<p class=text><a href="project2/hybridImages.zip">Here</a>, we have included two sample images (of President Mark Wright and a bear.  I've mostly aligned these images so that their eyes are in the same place.  The alignment of these images is very important for the final results.</p>

<ol>
  <li>
    First, you'll need to get a few pairs of images that you want to make into
    hybrid images.  You can use the sample
    images for debugging, but you should use your own images in your results.  Then, you will need to write code to low-pass
    filter one image, high-pass filter the second image, and add (or average) the
    two images.  For a low-pass filter, Oliva et al. suggest using a standard 2D Gaussian filter. For a high-pass filter, they suggest using
    the impulse filter minus the Gaussian filter (which can be computed by subtracting the Gaussian-filtered image from the original). 
    The <a
href="http://en.wikipedia.org/wiki/Cutoff_frequency">cutoff-frequency</a> of
    each filter should be chosen with some experimentation; in this case that means you need to experiment with how much to blur each images.</li>
  <li>For your favorite result, you should also illustrate the process through frequency analysis.  Show the log magnitude of the Fourier transform of the two input images, the filtered images, and the
    hybrid image.  In MATLAB, you can compute and display the 2D Fourier transform with
    with: 
  <span style='font-size:11.0pt;font-family:"Courier New"'>imagesc(log(abs(fftshift(fft2(gray_image)))))</span>and in Python it's <span style='font-size:11.0pt;font-family:"Courier New"'>plt.imshow(np.log(np.abs(np.fft.fftshift(np.fft.fft2(gray_image)))))</span> </li>
  <li>Try creating a variety of types of hybrid images (change of expression,
    morph between different objects, change over time, etc.).
    The <a href="http://olivalab.mit.edu/hybrid_gallery/gallery.html">site</a> has several examples that
    may inspire.</li>
</ol>

<h3>Evaluation</h3>

The first 60 points (out of 100) are for demonstration that you correctly create hybrid images.
20 points for the quality of the written description.
10 points for the aethetic quality of the best results (for example, if you take 2 random images and put them together you will get a hybrid image, but it will look terrible and not be compelling.  Make them compelling!), and 10 points for bells and whistles (Groups need to do |group size| - 1) bells and whistles; and you are welcome to try to do other variations than those listed below.


<h3> Bells &amp; Whistles (Extra Points)</h3>
<p class=text>Try using color to enhance the effect.  Can you make one image gray scale and the other color?
Does it work better to use color for the high-frequency component, the low-frequency component, or both? (5 pts)</p>

<p class=text>Can you make a hybrid video that looks compelling, so that you can see a video of one object moving (or something) from up close and a different video scene from far away?</p>

<p class=text> Can you make code to automatically generate a movie (like those on <a href="http://olivalab.mit.edu/movies/movies.html">this page</a>) that highlight the change in perception as you zoom in?
  
<p class=text>Can you make a three-part hybrid image that shows three distinct images from different distances?
  
</div>

