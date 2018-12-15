<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"> 
<html> 
  <head> 
    <title> 
    robert pless - washington university - computer vision 
    </title> 
    <meta name="keywords" content="robert pless, computer vision, webcams, generalized cameras structure from motion""> 
     <link rel="STYLESHEET" href="mystyle.css" type="text/css">   
  </head> 
<body> 
<!-- get the navigation bar on the left side... -->
<?php
    include('navbar.html');
?>
<div class="content"> 
<h4>Publications</h4>

<a href="publications.php?search=selected">Selected</a>
papers across all topics, or all papers, organized <a href="publications.php">chronologically</a> or by 
<a href="publications.php?academic">publication
type</a>, or focussed on specific topics:
<ul>
   <li><a href="publications.php?search=geometry">Visual and geometric inference</a> for robot perception, virtual reality and environmental measurement.
<li>
<a href="publications.php?search=ML">Machine Learning and Big Data</a>, algorithms and applications to large scale visual analytics.
<li><a href="publications.php?search=social">Social Computing</a> from a visual perspective.</ul>
I am especially happy that many of these papers have <a href="publications.php?search=ugrad">undergraduate
co-authors</a>.
</div>
<div class="content">  
<?php 
$_GET['bib']='pubs/plessRefs.bib'; 
$_GET['all']='a'; 
include( 'pubs/bibtexbrowser.php' ); 
?>
</div> 
  </body> 
</html> 
 
