<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"> 
<html> 
  <head> 
    <title> 
    robert pless - Computer Vision - Project 1
    </title> 
    <meta name="keywords" content="robert pless, computer vision course notes"> 
     <link rel="STYLESHEET" href="../../mystyle.css" type="text/css">   
  </head> 
  <body>
<?php include("../../navbar.html") ?>
<div class="content"> 
  <center><img src="lynx_ssd.jpg" alt="Teaser Image" height="150" width="750" align="center" /> </center>
  <br>
<h3> Project 1: Aligning and compositing the images of the 
    <a href="http://www.loc.gov/exhibits/empire/gorskii.html">Prokudin-Gorskii</a> 
    photo collection</h3>


<h4>Useful Links</h4>
<p>
<ul>
<li>Data: <a href="data.zip">zip file (~60MB)</a>
<li>Browse through more data: <a href="http://www.loc.gov/pictures/search/?q=Prokudin+negative&sp=2&st=grid">Library of Congress</a></li>
<li><tt>Due: 10:00am on Monday, Jan. 24.  A link to a blog or web page that is a write-up of your project</tt> </li>
</ul>
</p>

<h4>Background</h4>
<p>
    <a href="http://en.wikipedia.org/wiki/Prokudin-Gorskii">Sergei Mikhailovich Prokudin-Gorskii</a> (1863-1944)
    was a photographer ahead of his time. He saw color photography as the wave of the future and came up with
    a simple idea to produce color photos: record three exposures of every scene onto a glass plate using a 
    red, a green, and a blue filter and then project the monochrome pictures with correctly coloured light
    to reproduce the color image; color printing of photos was very difficult at the time. Due to the fame he got 
    from his color photos, including the only color portrait of 
    <a href="http://en.wikipedia.org/wiki/Leo_Tolstoy">Leo Tolstoy</a> (a famous Russian author), he won the 
    Tzar's permission and funding to travel across the Russian Empire and document it in 'color' photographs.
    His RGB glass plate negatives were purchased in 1948 by the Library of Congress. They are now digitized and available <a href="http://www.loc.gov/pictures/search/?q=Prokudin+negative&sp=2&st=grid">on-line</a>.
</p>

<h4>Requirements</h4>
<p>
    Take the digitized Prokudin-Gorskii glass plate images and automatically produce a color image with as few 
    visual artifacts as possible. You will need to extract the three color channel images and align them so that they form a single RGB color image. The high-resolution images are
    quite large so you will need to have a fast and efficient aligning algorithm.
    You are required to implement a single-scale and multi-scale aligning algorithm that searches over a 
    user-specified window of displacements. Also, you are required to try your algorithm on other images from
    the <a href="http://www.loc.gov/pictures/search/?q=Prokudin+negative&sp=2&st=grid">Prokudin-Gorskii collection</a>.
</p>


<h4>Details</h4>
<img src="exampleNegative.jpg" alt="example negative" style="float:right;"/>
<p>
    Important notes about the images:
</p>
<p>
    <ul>
    <li> The images are, from top to bottom, in BGR order.</li>
    <li> Each image has a high and low res image available online,
        so consider trying your aligning algorithm on both.</li>
    <li> Assume the negatives are evenly divided into 3 plates 
        (ie, each plate is in exactly 1/3 of the negative).</li>
    <li> Assume that a simple x,y translation model is sufficient 
        for proper alignment.</li>
    </ul>
</p>
<p>
    <a href="colorize_skel.m">MATLAB stencil code</a> is available, as is <a href="colorize_skel.py">python stencil code</a>.  You're free to do this project in whatever language you want. 
</p>
<p>
    Example digitized glass plate images, both hi-res and low-res versions are available in 
<a href="data.zip">this zip file</a>
</p>
<p>
    Your program will take a glass plate image as input and produce a single color image as output. 
    The program should divide the image into three equal parts and align the second and the third 
    parts (G and R) to the first (B). For each image, you will need to record the displacement vector 
    that was used to align the parts. Don't get your coordinate order mixed up -- Matlab matrices are accessed (y, x). 
</p>

<p>
    The easiest way to align the parts is to exhaustively search over a window of possible displacements 
    (e.g. [-15,15] pixels), score each one using some image matching metric, and take the displacement 
    with the best score. There are several possible metrics to measure how well images match:
</p>
<p>
    <ul>
    <li> Sum of squared differences: &nbsp;&nbsp; <tt> sum( (image1-image2).^2 )</tt> </li>
    <li> Normalized cross correlation: &nbsp;&nbsp; <tt> dot( image1./||image1||, image2./||image2|| )</tt> </li>
    </ul>
</p>
<p>
    Note that in this particular case, the images to be matched do not actually have the same 
    brightness values (they are different color channels), so other metrics might work better.
</p>

<p>
    Exhaustive search will become prohibitively expensive if the displacement search range or image resolution are too 
    large (which will be the case for high-resolution glass plate scans). To avoid this,
    you will need to implement a better strategy.  Some options:
    <ol>
      <li> a coarse-to-fine search strategy using an image pyramid.
	This means shrinking your image (for example, you might shrink
	your original 3000 x 3000 pixel image to be 300 x 300 pixels),
	where you can solve the problem quickly because the image is
	small, and also because you may only have to slide the R,G,B
	channel a few pixels relative to each other.  Once you have
	the answer for the 300 x 300 pixel version of the image, you
	can use that displacement estimate to search only the most
	likely displacements in the 600 x 600 pixel image, and so on,
	until you are optimizing on the original image but only have
	to search a little bit.
      <li>There are other possible approaches to making a search
      faster.  Can you think of any and test them?
</ol>
</p>

<h4>Bells and Whistles</h4>
<p>
Although the color images resulting from this automatic procedure will often look strikingly real, 
they are still not nearly as good as the manually restored versions available on the LoC website and 
from other professional photographers. However, each photograph takes days of painstaking 
Photoshop work, adjusting the color levels, removing the blemishes, adding contrast, etc.
Can you come up with ways to address these problems automatically? Feel free to come up
with your own approaches or talk to the Professor or TAs about your ideas.  There is no right answer
here, just try out things and see what works.
</p>
<p>
Here are some ideas, but we will give credit for other clever ideas:
</p>
<p>
<ul>
<li>Automatic cropping: Remove white, black or other color borders. Don't just crop a predefined margin off of 
each side -- actually try to detect the borders or the edge between the border and the image.</li>
<li>Automatic contrasting: It is usually safe to rescale image intensities such that the darkest pixel is zero 
(on its darkest color channel) and the brightest pixel is 1 (on its brightest color channel). More drastic or non-linear 
mappings may improve perceived image quality.</li>
<li>Better colors: There is no reason to assume (as we have) that the red, green, and blue lenses used by 
Produkin-Gorskii were especially good, or correspond directly to the R, G, and B channels in RGB color space.
Try to find a mapping that produces more realistic colors</li>
<li>Better features: Instead of aligning based on RGB similarity, try using gradients or edges.</li>
<li>Better transformations: Instead of searching for the best x and y translation, additionally search over 
small scale changes and rotations. Adding two more dimensions to your search will slow things down, but the same course to 
fine progression should help alleviate this.</li>
<li>Finding and trying this on related data: Can you make your algorithm work on the images from <a href="http://www.dailymail.co.uk/news/article-2202389/Worlds-earliest-colour-movies-shown-time-incredible-120-years-shot.html">
an even earlier time</a>?.  Can you find or track down high resolution originals?  
<li>Aligning and processing data from other sources. In many domains, such as astronomy, image data is still 
captured one channel at a time. Often the channels don't correspond to visible light, but NASA artists stack these channels
together to create false color images. For example, 
<a href="http://www.wikihow.com/Process-Your-Own-Colour-Images-from-Hubble-Data">here is a tutorial</a> on how to process
Hubble Space Telescope imagery yourself. Also, consider images like 
<a href="http://www.flickr.com/photos/gsfc/7931831962/in/set-72157631408160534">this one of a coronal mass ejection</a> 
built by combining <a href="http://www.nasa.gov/mission_pages/sunearth/news/News090412-filament.html">ultraviolet images</a> from the Solar Dynamics Observatory.
To get full credit for this, you need to demonstrate that your algorithm found a non-trivial alignment and color correction.</li>
</ul>
<p>
For all extra credit, be sure to demonstrate on your web page cases where your extra credit has improved image quality.

<h4> Web-Publishing Results </h4>
<p>
All the results for each project will be put on the course website so that
the students can see each other's results. In class we will have 
presentations of the projects and the students will vote on who got the
best results. If you do not want your results published to the web, you can
choose to opt out. If you want to opt out, email the class TA
saying so.
</p>

<h4>Write up</h4>
<p>
For this project, and all other projects, you must do a project
writeup that will be shared as a webpage; either on the gwu blogging
service (or any other blogging service that you like).  In the report
you will describe your algorithm and any decisions you made to write
your algorithm a particular way. Show and discuss the results of your
algorithm, including, if possible, examples where your algorithm
works, where (and why!) it fails. Also discuss any bells and whistles
that you did.  Feel free to add any other information you feel is
relevant.

How much should you write about your project?  The following are blog posts that are about the level of detail that I hope to see:
<ol>
  <li> <a href="https://medium.com/@nikatsanka/comparing-edge-detection-methods-638a2919476e">Write up about edge detection</a>
  <li> <a href="https://towardsdatascience.com/image-processing-with-python-applying-homography-for-image-warping-84cd87d2108f">write up about how to use an image warping function</a>
  <li><a href="https://medium.com/analytics-vidhya/image-processing-series-part1-colorspaces-836d2e3ca700">A write-up of how to transform between different color-spaces</a>
</ol>
These are not class projects so the format isn't exactly, but they should a little bit about how to use images to talk about image based algorithms and show the size and scope of the write-up I'm hoping for.
</p>

<h4> Rubric </h4>
<ul>
   <li> +20 pts: Correctly aligned images, even if done by hand (explain how!) </li>
   <li> +30 pts: Single-scale implementation (if correct, no need to show by hand version)</li>
   <li> +20 pts: Multi-scale or otherwise faster implementation </li>
   <li> +10 pts: Bell + Whistles </li>
   <li> +20 pts: Quality of the write-up. </li>
</ul>

<h4> Final Advice </h4>
<p>
<ul>
  <li> A lot of the suggested MATLAB code will be in the Image Processing Toolbox.  As a SEAS student you can
    <a href="https://www.seas.gwu.edu/install-matlab">download Matlab for free.</a>
<li> For all projects, don't get bogged down tweaking input parameters. Most, but not all images will line up using the same 
parameters (for example, how big of a range of possible displacements there might be). Your final results should be the product of a fixed set of parameters (if you have free parameters). Don't worry if one or two of the handout images don't align properly using the simpler metrics suggested here.</li>
<li> The input images can be in jpg (uint8) or tiff format (uint16), remember to convert all the formats to the same 
    scale (see <tt>im2double</tt> and <tt>im2uint8</tt>).</li>
<li> Shifting a matrix is easy to do in MATLAB by using <tt>circshift</tt>, in a way that doesn't change the size of the array you are shifting.</li>
<li> The borders of the images will probably hurt your results, try computing your metric on the internal pixels only.</li>
<li> Output all of your images to jpg, it'll save you a lot of disk space.</li>
<li>When debugging any code that works with images, you should basically find a way to visualize almost everything that you do!  In my (professional) code, I probably have one line of visualization/debugging code for every line of "real" code.
</ul>
</p>

<h4> Credits </h4>
<p>
Project derived from Alexei A. Efros' Computational Photography course, with permission.
</p>

<h4>Collaboration Policy</h4>

All work that you turn in must be your work, your code.  But it is
also incredibly useful to talk with classmates and explore.  So I try
to share here some explicit guidance.

You are explictly ALLOWED to:
<ol>
  <li> Search the internet for answers to how to read in images, write out images, etc.
</ol>

<h2>Good Luck!</h2>

</div>

