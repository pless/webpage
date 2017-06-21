<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"> 
<html> 
  <head> 
    <title> 
    robert pless - washington university - computer vision 
    </title> 
    <meta name="keywords" content="robert pless, computer vision, webcams, generalized cameras structure from motion""> 
     <link rel="STYLESHEET" href="./mystyle.css" type="text/css">   
  </head> 
  <body> 
<?php include("navbar.html") ?>
<div class="content"> 
<h4>Updates:</h4>
<ul>
<li>Congratulations <a href="http://www.cse.wustl.edu/~schillebeeckxi/">Ian
    Schillebeeckx</a>, new PhD!
<li>Thank you Adobe for your gift in support of image matching research.
<li>Best Paper award for
<a href="http://www.cv-foundation.org//openaccess/content_cvpr_2016_workshops/w16/papers/Stylianou_SparkleGeometry_Glitter_Imaging_CVPR_2016_paper.pdf">SparkleGeometry:
  Glitter Imaging for 3D Point Tracking</a> at the IEEE/CVPR Workshop
  on <a href="http://imagesci.ece.cmu.edu/CCD2016/">Computational
  Cameras and Displays</a>.
<li>100,000 downloads of our app TraffickCam for <a href="https://itunes.apple.com/us/app/traffickcam/id1067713017?mt=8">iPhone</a> and
    <a href="https://play.google.com/store/apps/details?id=com.exchangeinitiative.traffickcam">Android</a>.
    Popular press: 
<a href="https://www.washingtonpost.com/news/inspired-life/wp/2016/07/01/how-simply-snapping-a-photo-of-your-hotel-room-could-save-trafficked-children/">Washington
  Post</a>, 
<a href="http://www.stltoday.com/news/local/crime-and-courts/a-new-app-created-in-st-louis-aims-to-track/article_984efb3b-8ee1-5f98-94d7-96afeefa5af0.html">St. Louis
    Post-Dispatch</a>,
    the <a href="http://timesofindia.indiatimes.com/tech/apps/TraffickCam-app-seeks-users-support-to-fight-sex-trafficking/articleshow/52896216.cms">Times
    of
    India</a>, <a href="http://www.ecpatusa.org/2016/06/20/travelers-use-traffickcam-app-fight-sex-trafficking-uploading-hotel-room-photos-national-database/">ECPAT</a>,
    and <a href="http://www.ksdk.com/news/local/new-app-created-to-fight-human-trafficking/253188670">KSDK news</a>.
<li>Published in Frontiers in Public Health:
<a href="http://journal.frontiersin.org/article/10.3389/fpubh.2016.00097/full">Webcams, crowdsourcing, and enhanced crosswalks: Developing a novel method to analyze active transportation</a>, Hipp, Manteiga, Burgess, Stylianou, Pless.
<li><a href="http://www.nsf.gov/awardsearch/showAward?AWD_ID=1553116">NSF CAREER AWARD</a> to my former student <a href="http://cs.uky.edu/~jacobs/">Nathan Jacobs</a>.
<li>New DOE TERRA <a href="https://engineering.wustl.edu/news/Pages/Wash-U-computer-scientists-part-of-$8M-big-data-research-grant.aspx">big data/agricultural robotics grant</a>.
</ul>

<h4>Research</h4> 
My research is in the area of computer vision with applications to
environmental science, medical imaging, robotics and virtual reality.
I am particularly interested in data-driven and geometric techniques
to more robustly understand images taken "in the wild".  This research
exploits the fact that cameras are incredibly precise measurement
systems --- if they are calibrated properly, then the vast quantities
of visual data they collect can help to learn, understand, and
manipulate the world around us.  At a high level, the current themes
of research in my lab are:

<ul>
<li><b>Understand visual change at scales from the sidewalk to the planet:</b><br>
What can you do with a billion images?  Webcams, iPhones, and flocks
  of micro-satellites a visual depiction of the Earth at an
unprecedented temporal and spatial coverage.  Our aim is to organize
these disparate image sources to create coherent global imaging
systems that answer important questions facing our society and our
planet.  Specifically, we work to understand physical principles that
govern image formation in realistic environments, and we use those in
application domains that include: Understanding patterns of
tree-growth at a continental scale, characterizing the use of public
spaces over time, and creating generalizable models to 
learn how image appearance varies over time.

<li><b>Next generation imaging systems:</b><br>

All Virtual Reality and Robotics applications require fast visual
reasoning systems to characterize the 3D world and pose of objects
within that world.  The objective of this research effort is to
understand and overcome the fundamental limits of cameras and
materials that make that task difficult.  Specifically, our work has
developed the theory of motion estimation from multi-perspective and
compressive sensing cameras, fundamental constraints for calibrating
cameras with other sensing systems, and the design of new light-field
modulating materials that make geometric inference especially easy.  

<li><b>Democratizing Visual Analytics and Applications to Social Justice:</b><br>
What can our community do to make visual reasoning more available to
more people?  Our lab works to make web implementations and
smart-phone apps that support the broader publics ability to create
and use visual inference across many applications.  This includes apps
to support Citizen Science through repeat photography, and the
geocalibration.org website that allows the precise geo-location of an
image with respect to Google Maps which was used to find the lost
grave of a Jane Doe crime victim from 30 years ago.
</ul>

I founded and direct the 
<a href="https://www.facebook.com/Media-and-Machines-Lab-145663825454497/info/?tab=overview">Media
 and Machines Laboratory</a>.
<br>
<br>

<h4>Dataset, Apps, and Frequenty Requested Code</h4>
<ul>
<li> The Archive of Many Outdoor Scenes 
(<a href="http://amos.cse.wustl.edu">AMOS</a>).
<li><a href="http://traffickcam.org">TraffickCam</a>, an app to crowd source the creation of a continually
  updated index of the appearance of hotel rooms to support
  investigations of sex trafficking.
<li> Citizen Science Repeat Photography App and Data 
(<a href="http://projectrephoto.com">rePhoto</a>).
<li>Code (<a href="code/manifoldVis.zip">12 KB zip file</a>) for
matlab and web visualizations of image manifolds, from the paper: "A
Survey of Manifold Learning for Images", Robert Pless and Richard
Souvenir, IPSJ Transactions on Computer Vision and Applications,
vol. 1 pp. 83-94, 2009.
<a href="http://research.engineering.wustl.edu/~pless/pubs/bibtexbrowser.php?key=plessSouvenirSurvey2009&bib=plessRefs.bib">(bib)</a>

<li>Code (<a href="code/calibZip.zip">2.3 MB zip file</a>) from our
paper: "Extrinsic Calibration of a Camera and Laser Range Finder",
Qilong Zhang, Robert Pless, IROS 2004,
<a href="http://research.engineering.wustl.edu/~pless/pubs/bibtexbrowser.php?key=zhangIROS&bib=plessRefs.bib">(bib)</a>, 
</ul>
</div> 
</body> 
</html> 
 
