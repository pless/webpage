<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd"> 
<html> 
  <head> 
    <title> 
    robert pless - washington university - computer vision 
    </title> 
    <meta name="keywords" content="robert pless, computer vision, webcams, generalized cameras structure from motion"> 
     <link rel="STYLESHEET" href="./mystyle.css" type="text/css">   
  </head> 
  <body> 
<?php include("navbar.html") ?>
    <div class="content"> 
<SCRIPT language=JavaScript>

<!--
// Load images but only if browser supports the
// document.images method

if (document.images) {
   var pic = new Image(); pic.src =  "webImages/people.jpg"; 
}

function swap(n) {
    document["pic"].src = n;
}


function swap_any(state) {
     document["pic"].src = state.src;
}

//-->
</SCRIPT>

<script type=text/javascript>
function changetext(txt)
{
var id = document.getElementById("DP");
id.innerHTML=txt;
}
</script>


<center>
<table>
<tr>
<td width=30% align=center> <IMG height=200 src="webImages/people.jpg" name=pic>
<td width=70% align=left> <div style="width:400px" id="DP" onmouseover="changetext('')">I have been privileged to work on research projects with some of the
most outstanding students I have ever known.  Students I am currently working with are listed at the top, alumni of my lab are listed in <i>italics</i>
</div>
</tr>
</table>
</center>

<br>
<TABLE width=599 align=center>
  <TBODY><TR>
    <TD valign="top" align=center><h4>Undergraduate Students</h4><BR>
<!-- CURRENT Ugrad -->
      <br>
      <A onmouseover="swap('webImages/people.jpg');changetext('Marshall Thompson George Washington University, GWU Class of 2022')">Marshall Thompson</a><br>
      <A onmouseover="swap('webImages/people.jpg');changetext('Rishiraj Kanungo, George Washington University, GWU Class of 2022')">Rishiraj Kanungo</a><br>
      <A onmouseover="swap('webImages/people.jpg');changetext('Chen Hao Liu, George Washington University, GWU Class of 2022')">Chen Hao Liu</a><br>
      <A onmouseover="swap('webImages/people.jpg');changetext('Grady McPeak, George Washington University, GWU Class of 2022')">Grady McPeak</a><br>
<!-- ALUMNI Ugrad -->
<br>  <i>
<A onmouseover="swap('webImages/people.jpg');changetext('Suraj Shah, George Washington University, Class of 2020')">Suraj Shah</a><br>
<A onmouseover="swap('webImages/people.jpg');changetext('Kyle Rood, George Washington University, Class of 2020')">Kyle Rood</a><br>
<A onmouseover="swap('webImages/people.jpg');changetext('Sutton Howell, George Washington University, Class of 2022')"></a>Sutton Howell<br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Samsara Counts, George Washington University, Class of 2019')" href="http://samsaranc.com">Samsara Counts</A><BR>
   <A onmouseover="swap('webImages/people.jpg');changetext('Sam Hanna, George Washington University, Class of 2020')">Sam Hanna</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('William Lyons, Washington University, Class of 2018')">Will Lyons</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Jessica Schreier, Washington University, Class of 2018')">Jessica Schreier</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Joseph O\'Sullivan, Washington University, Class of 2016')">Joseph O'Sullivan</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Morgan Redding, Washington University, Class of 2017')">Morgan Redding</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Daniel Gordon, Washington University, Class of 2014, now at Google')">Daniel Gordon</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Micah Goodman, Washington University, Class of 2017')">Micah Goodman</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Ali Bukys, Washington University, Class of 2016')">Ali Bukys</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Hannah Siebers, Washington University, Class of 2014')">Hannah Siebers</a><br>
   <A onmouseover="swap('webImages/hawley.jpg');changetext('Chris Hawley, Washington University, Class of 2013 (Dec.), now at Amazon/A9')">Christopher Hawley</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Calvin Murdock, Washington University, Class of 2013, now PhD student at CMU')">Calvin Murdock</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Vishnu Halthore, Washington University, Class of 2013')">Vishnu Halthore</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Shane Carr, Washington University, Class of 2015')">Shane Carr</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Brittany Shannon, Monmouth University, Class of 2013')">Brittany Shannon</a><br>
   <A onmouseover="swap('webImages/tyler.jpg');changetext('Tyler Trussel, Washington University, Class of 2012')">Tyler Trussel</a><br>
   <A onmouseover="swap('webImages/emilyFeder.jpeg');changetext('Emily Feder, Washington University, Class of 2012, Currently in Chicago at Inspiration Corporation')">Emily Feder</a><br>
   <A onmouseover="swap('webImages/walker.jpeg');changetext('Walker Burgin, Washington University, 2011, now at Microsoft')">Walker Burgin</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Nicholas Fridrich, Washington University (2011)')">Nicholas Fridrich</a><br>
   <A onmouseover="swap('webImages/people.jpg');changetext('Brian Bies, Washington University (2010)')">Brian Bies</a><br>
   <A onmouseover="swap('webImages/nroman.jpg');changetext('Nathaniel Roman, Washington University (2010), Software Engineer @ Stripe (formerly facebook)')" href="http://www.facebook.com/nroman">Nathaniel Roman</A><br>
   <A onmouseover="swap('webImages/jonathan.jpg');changetext('Jonathan Cannon, Brown University (2009), PhD in Neuroscience, BU.)" href="http://joncannon.net/">Jonathan Cannon</a><br>
   <A onmouseover="swap('webImages/mharris.jpg');changetext('Melissa Harris, Washington University (2007), now at Google')">Melissa Harris</a><br>
   <A onmouseover="swap('webImages/avi.jpg');changetext('Avi Hoffman, Washington University (2007), now at Google') ">Avi Hoffman</A><br>
   <A onmouseover="swap('webImages/people.jpg'); changetext('Justin Brown, Washington University (2006, 2008), now at Partek')">Justin Brown</A><br>
   <A onmouseover="swap('webImages/lewis.jpg');changetext('Chris Lewis, (2003), ERNST STRÜGMANN INSTITUTE/MPI')">Chris Lewis </a><br>
   <A onmouseover="swap('webImages/ian.jpg');changetext('Ian Simon, Washington University (2001), PhD from University of Washington, now at Microsoft')" href="http://www.iansimon.org/">
    Ian Simon</A><BR>
  </i>
</TD>
    <TD valign="top" align=center ><h4>Master Students</h4><BR>
<!-- CURRENT MS -->
      <br>
      <A onmouseover="swap('webImages/people.jpg');changetext('Matthew Bernstein, George Washington University, MS 2022')">Matthew Bernstein</a><br>
<br>
<br>
<br>
<br>
<!-- ALUMNI MS -->
<i>   
    <A onmouseover="swap('webImages/people.jpg');changetext('Maya Shende, George Washington University MS 2020')">Maya Shende</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Xuqing (Ken) Zhou, George Washington University, MS 2020')"></a>Xuqing (Ken) Zhou<br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Tang Li, George Washington University, MS 2020, Now a PhD student at the University of Delaware')"></a>Tang Li<br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Justine-Louis Manning')">Justine-louise Manning</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Derek Lefever, MS GWU '19, Now At Capital One')">Derek Lefever</A><br>
    <A onmouseover="swap('webImages/joshua.jpg');changetext('Joshua Little, Washington University, Class of 2013, now at Google')">Joshua Little</a><br>
    <A onmouseover="swap('webImages/Eileen.jpg');changetext('Eileen Duffner, Washington University, MS 2016, Now at Tandem (Chicago)')">Eileen Duffner</a><br>
    <A onmouseover="swap('webImages/kylia.jpg');changetext('Kylia Miskell, MS 2015, now at Google')" href="http://research.engineering.wustl.edu/~miskellk/">Kylia Miskell</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Agata Kargol, MS 2015, now at Planet')">Agata Kargol</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Adina Stoica, MS, 2014, Now a software Engineer at Bloomberg')">Adina Stoica</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Jessica Graham, MS, 2014, Now a software engineer at Epic')">Jessica Graham</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Brandon Kerr, MS, 2013, Now a software engineer at Boeing')">Brandon Kerr</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Bill Chang, MS, 2013')">Bill Chang</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Devorah Langsam, MS, 2012, now at Flight Safety International')">Devorah Langsham</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('MS 2012, now at Microsoft')">Alex Drake</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Jed Jackoway, MS 2012, Now at Whaleshark Media')">Jed Jackoway</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Adam Kraft, MS 2011, now at A9.com')">Adam Kraft</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Nicholas Chavez, MS 2011, now at BAM Technologies')"> Nicholas Chavez</a><br>
    <A onmouseover="swap('webImages/klein_matthew.png');changetext('Matthew Klein, MS 2011, now at Boeing')"> Matthew Klein</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Patrick McBryde, MS 2010, Citizen Science - iPhone RePhotography, now at Microsoft')"> Patrick McBryde</a><br>
    <A onmouseover="swap('webImages/joe.jpg');changetext('Joe Israelevitz, Now faculty at Univ. Colorado')"> Joe Israelevitz</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Rachel Tannenbaum, BS/MS 2009, now at FactSet')">Rachel Tannenbaum</a><br>
    <A onmouseover="swap('webImages/speyer.jpg');changetext('Richard Speyer, BS/MS 2009, now at Microsoft')"> Richard Speyer</a><br>
    <A onmouseover="swap('webImages/davidRoss.jpg');changetext('David Ross, BS/MS 2009, now at Klout, previously at Google')"> David Ross</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Thomas Moore, BS/MS 2009, now at Microsoft')"> Thomas Moore</a><br>
    <A onmouseover="swap('webImages/satkin.jpg');changetext('Scott Satkin, BS 2006, MS 2008.  PhD@Carnegie-Mellon.  Now at Google.')" href="http://research.satkin.com/">Scott Satkin</a><br>
    <A onmouseover="swap('webImages/garnett.jpg');changetext('Roman Garnett, BS/MS 2004, PhD Oxford, 2010.  Now Faculty at Washington University')"> Roman Garnett</a><br>
    <A onmouseover="swap('webImages/jurgens.jpg');changetext('David Jurgens, BS/MS 2004. PhD UCLA.  Now faculty at University of Michigan')" href="http://www.cs.ucla.edu/~jurgens">David Jurgens</a><br>    
    <A onmouseover="swap('webImages/people.jpg');changetext('Doug Clauson, MS 2004.  Now at Boeing')">Doug Clauson</a><br>
    <A onmouseover="swap('webImages/larson.jpg');changetext('John Larson, MS 2003. now loosely with playgroundcreative.com')">John Larson</A><br>
    <A onmouseover="swap('webImages/perkins.jpg');changetext('Jacob Perkins, BS/MS.  CTO of weotta.com, Author of Python Text Processing with NLTK Cookbook.')" href="
https://plus.google.com/105258061927639811990/about">Jacob Perkins</a><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Scott Siebers, BS/MS 2005, now at Cerner Corporation')"> Scott Siebers</a><br>
</i>
</TD>
    <TD valign="top" align=center><h4>Doctoral Students/ <br> Research Scientists</h4><BR>
<!-- CURRENT -->
    <A onmouseover="swap('webImages/people.jpg');changetext('Hong Xuan, George Washington University, Expected Graduation 2021')">Hong Xuan</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Zeyu Zhang, George Washington University, Expected Graduation 2023')">Zeyu Zhang</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Xiaotong Liu, George Washington University, Expected Graduation 2023')">Xiaotong Liu</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Roxana Leontie, George Washington University, PhD 2019')">Roxana Leontie</A><br>
<!-- ALUMNI -->
 <br>
    <i> 
    <A onmouseover="swap('webImages/abby.jpg');changetext('Abby Stylianou, PhD, Assistant Professor, Saint Louis University')" href="http://www2.seas.wustl.edu/~astylianou/">Abby Stylianou, PhD</A><br>
    <A onmouseover="swap('webImages/people.jpg');changetext('Zongyang Li, now a research Scientist at the Donald Danforth Plant Science Center')"> 
    Zongyang Li</A><br>
   <A onmouseover="swap('webImages/Ian.jpg'); changetext('Ian Schillebeeckx')"
href="http://www.cse.wustl.edu/~schillebeeckxi/">
Ian Schillebeeckx, PhD</A><br>
    <A onmouseover="swap('webImages/austin.jpg');changetext('Now at Google Research')"  
href="http://research.engineering.wustl.edu/~abramsa/">Austin Abrams, PhD</A><br>
   <A onmouseover="swap('webImages/david.jpg'); 
changetext('David Lu PhD, jointly advised with Bill Smart.  Now at Bossa Nova Robotics.')"
href="http://wustl.probablydavid.com/">David Lu, PhD</a><br>
    <A onmouseover="swap('webImages/Freudenburg.jpg');changetext('Zachary Freudenburg, PhD 2012.  Now at UMC Utrecht.')" 
href="https://www.linkedin.com/pub/zachary-freudenburg/6a/a92/993"> 
    Zachary Freudenburg, PhD</A><br>
    <A onmouseover="swap('webImages/tucek.jpg');changetext('Jayne Tucek, staff scientist, now at NestLabs/Google')" href="https://www.linkedin.com/in/jayne-tucek/">Jayne Tucek</A><br>
    <A onmouseover="swap('webImages/dixon.jpg');changetext('Michael Dixon, BS/MS 2003, staff scientist until 2011, Willow Garage, Reflektion, Nest Labs/Google')" href="http://www.cs.wustl.edu/~msd2/">Michael Dixon</A><br>
    <A onmouseover="swap('webImages/manfred.jpg');changetext('Manfred Georg, PhD 2010, now at Google')" href="http://www.cse.wustl.edu/~mgeorg/index.html">Manfred Georg, PhD</A><br>
    <A onmouseover="swap('webImages/nathan_jacobs.jpg');changetext('Nathan Jacobs, PhD 2010, now Associate Professor at University of Kentucky')"href="http://cs.uky.edu/~jacobs/">Nathan Jacobs, PhD</A><br>
    <A onmouseover="swap('webImages/richard.jpg');changetext('Richard Souvenir, PhD 2006, now Professor/Associate Dean @ Temple')">Richard Souvenir, PhD</A><br>
    <A onmouseover="swap('webImages/qilong.jpg');changetext('Qilong Zhang, PhD 2006, now at Nomura')" href="http://www.cs.wustl.edu/~zql">Qilong Zhang, PhD</A><br>
</i>
<br><br>
    </TD>
    </TR>
  </TBODY>
</TABLE>
<br>
</div>
</body>
</html>
