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
<h3> Project 3: Image Mosaicing</h3>


<h3>Due</h3>
Thursday, March 25, 10am.  Please turn in your project via
<a href="https://forms.gle/DLKoBtUZXDMJHvUAA">this form</a></h4>


<h3>Overview</h3>

<p class="text">The goal of this part of the assignment is to create <a href="http://cvcl.mit.edu/hybridimage/">image mosaics</a>.

You will take two or more photographs and create a combined image by
registering, projective warping, resampling, and compositing them.
This will teach you about some image geometry and homographies, which
is the algebraic workhorse to warp images.

In your project and writeup, I want to see a collection of steps:
  <ol>
<li> Shoot and choose good pictures (20 pts).  Show the pictures you've picked, why you chose to use those pictures, what about those pictures might make the rest of the project easier or harder?</li>
<li> Recover homographies (20 pts).  Explain your approach (even if it is hand-clicking points), and what the challenges are for that.
<li> Warp the images (20 pts).  Produce at least two examples of rectified images, and share any adventures that you had along the way.
<li> Blend images into a mosaic (20 pts).  There are some choices about how you do the blending --- do you just use one image as much as possible and fill in with the rest?  Do you have a smooth gradient?  Do you do something more interesting?
<li> Optional Bells and Whistles (up to 20 pts).  
<li>Each of the above points includes point relating to the clarity and organization of the write-up of that section.
</ol>
 
  There are some built in functions that are able to do much of what
is needed, in matlab functions cp2tform, imtransform, tformarray,
tformfwd, tforminv, and maketform, explicitly take a collection of
corresponding points and compute the homography and warp the image.  I
  think there is value in doing these steps on your own, so that is one
  of the bells and whistles.  Basic linear algebra function (for solving linear systems, inverting matrices, linear interpolation, etc) you are welcome to use in any case.

 </p>

<h3>Details</h3>

<b>Recover Homographies</b>

Before you can warp your images into alignment, you need to recover
the parameters of the transformation between each pair of images. In
our case, the transformation is a homography: p’=Hp, where H is a 3x3
matrix with 8 degrees of freedom (lower right corner is a scaling
factor and can be set to 1). One way to recover the homography is via
a set of (p’,p) pairs of corresponding points taken from the two
images. You will need to write a function of the form:<br><br>

H = computeH(im1_pts,im2_pts)<br><br>

where im1_pts and im2_pts are n-by-2 matrices holding the (x,y)
locations of n point correspondences from the two images and H is the
recovered 3x3 homography matrix. In order to compute the entries in
the matrix H, you will need to set up a linear system of n equations
(i.e. a matrix equation of the form Ah=b where h is a vector holding
the 8 unknown entries of H). If n=4, the system can be solved using a
standard technique. However, with only four points, the homography
recovery will be very unstable and prone to noise. Therefore more than
4 correspondences should be provided producing an overdetermined
system which should be solved using least-squares.<br><br>

Establishing point correspondences is a tricky business. An error of a
couple of pixels can produce huge changes in the recovered
homography. The typical way of providing point matches is with a
mouse-clicking interface. You can write your own using the bare-bones
ginput function. Or you can use a nifty (but often flaky). You can
also use tools like Gimp or Photoshop to read off the pixel
coordinates of the mouse cursor. cpselect. After defining the
correspondences by hand, it’s often useful to fine-tune them
automatically. This can be done by SSD or normalized-correlation
matching of the patches surrounding the clicked points in the two
images (see cpcorr), although sometimes it can produce undesirable
results.<br>

<b> Warp the Images</b>

Now that you know the parameters of the homography, you need to warp your images using this homography. Write a function of the form:<br>

imwarped = warpImage(im,H)<br>

where im is the input image to be warped and H is the homography. You
can use either forward of inverse warping (but remember that for
inverse warping you will need to compute H in the right
“direction”). You will need to avoid aliasing when resampling the
image. Consider using interp2, and see if you can write the whole
function without any loops, Matlab-style. One thing you need to pay
attention to is the size of the resulting image (you can predict the
bounding box by piping the four corners of the image through H, or use
extra input parameters). Also pay attention to how you mark pixels
which don’t have any values. Consider using an alpha mask (or alpha
channel) here.
<br><br>

<b>Image Rectification</b>

Once you get this far, you should be able to “rectify” an image. Take a few sample images with some planar surfaces, and warp them so that the plane is frontal-parallel (e.g. the night street examples above). You should do this before proceeding further to make sure your homography/warping is working. Note that since here you only have one image and need to compute a homography for, say, ground plane rectification (rotating the camera to point downward), you will need to define the correspondences using something you know about the image. E.g. if you know that the tiles on the floor are square, you can click on the four corners of a tile and store them in im1_pts while im2_pts you define by hand to be a square, e.g. [0 0; 0 1; 1 0; 1 1].<br><br>

<b>Blend the images into a mosaic</b><br>

Warp the images so they're registered and create an image
mosaic. Instead of having one picture overwrite the other, which would
lead to strong edge artifacts, use weighted averaging. You can leave
one image unwarped and warp the other image(s) into its projection, or
you can warp all images into a new projection. Likewise, you can
either warp all the images at once in one shot, or add them one by
one, slowly growing your mosaic (making a mosaic of two images, then
using that image and mosaicing it with the third image etc...).<br>

If you choose the one-shot procedure, you should probably first
determine the size of your final mosaic and then warp all your images
into that size. That way you will have a stack of images together
defining the mosaic. Now you need to blend them together to produce a
single image. If you used an alpha channel, you can apply simple
feathering (weighted averaging) at every pixel. Setting alpha for each
image takes some thought. One suggestion is to set it to 1 at the
center of each (unwarped) image and make it fall off linearly until it
hits 0 at the edges (or use the distance transform bwdist). However,
this can produce some strange wedge-like artifacts. You can try
minimizing these by using a more sophisticated blending technique,
such as a Laplacian pyramid. If your only problem is “ghosting” of
high-frequency terms, then a 2-level pyramid should be enough.<br>


<h3> Bells &amp; Whistles (Extra Points)</h3>
<p class=text>Do the image geometric warping on your own without using functions that warp the images</p>

<p class=text>Try different things with the image blending process to make the transition between the images more seemless</p>

<p class=text>Spherical/Cylindrical/polar mapping: Instead of projecting your mosaic onto a plane, try using another surface, such as a sphere or a cylinder. This is often a better way to represent really wide mosaics. Be clever: do the inverse sampling from the original pre-warped images to make your mosaic the best possible resolution. Pick the focal length (radius) that looks good.

<p class=text>Use 3D rotational model: If your mosaic is a rotation about the same point and you don’t change zoom, you can use a simpler rotation-only transformation, which is more robust and requires less correspondences. This approach should also in theory help you find the focal length of your camera.

<p class=text>Video mosaics: Capture two (or more) stationary videos (either from the same point, or of a planar/far-away scene). Compute homography and produce a video mosaic. You will need to worry about video synchronization (not too hard – a single parameter search). Also make sure that you shoot something where things are happening over short periods of time – video data gets really big really quickly. A good example would be capturing a football game from the sides of the stadium.

  
</div>

