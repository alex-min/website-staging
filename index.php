<?
session_start();
if (isset($_REQUEST["page"])) {
  $page = str_replace("<", "", $_REQUEST["page"]);
} else {
  if ((stristr($_SERVER["HTTP_ACCEPT_LANGUAGE"], "ja")) &&
      !(stristr($_SERVER["HTTP_ACCEPT_LANGUAGE"], "en"))) {
    header("Location: http://de-co.info/freenet/");
    exit();
  }
  $page = "index";
}

mysql_connect("mysql4-f", "f978rw", "t6j4f3gt");
mysql_select_db("f978_access");
mysql_query("INSERT INTO access VALUES (\"".$_SERVER["REMOTE_ADDR"]."\", \"".$_SERVER["HTTP_REFERER"]."\", NOW())");
mysql_close();

$modes = array("beginner"=>FALSE, "user"=>FALSE, "developer"=>FALSE);
if (isset($_GET["mode"])) {
  $mode = $_GET["mode"];
  setcookie("mode", $mode, time()+60*60*24*30);
} elseif (!isset($_REQUEST["mode"])) {	
 	$mode = "beginner";
} else {
	$mode = $_REQUEST["mode"];
}
  
$modes[$mode]=TRUE;
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta name="generator" content="HTML Tidy, see www.w3.org">
    <title>The Freenet Project - <?= $page." - ".$mode ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript">
var users=new Image();
users.src="image/users.gif";
var users_ovr=new Image();
users_ovr.src="image/users_ovr.gif";
var beginners=new Image();
beginners.src="image/beginners.gif";
var begin_ovr=new Image();
begin_ovr.src="image/begin_ovr.gif";
var developers=new Image();
developers.src="image/developers.gif";
var devel_ovr=new Image();
devel_ovr.src="image/devel_ovr.gif";
function rollOn(page) {
  if(document.images){
    eval('document.images["'+page+'"].src='+page.slice(0,5)+'_ovr.src');
  }
}
function rollOff(page) {
  if(document.images){
    eval('document.images["'+page+'"].src='+page+'.src');
  }
}
function sideOn(page) {
  eval('document.images["'+page+'"].src='+page.slice(0,5)+'_ovr.src');
}
function sideOut(num) {
  cell=document.getElementById('mn'+num);
  cell.bgColor="#ffffff";
}
function sideOvr(num) {
  cell=document.getElementById('mn'+num);
  cell.bgColor="#c7d6f1";
}
</script>
  </head>

  <body bgcolor="#FFFFFF" text="#000000" link="#000000" vlink="#000033" alink="#000000" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="51" rowspan="2" align="left" background="image/hdr_bg_tall.gif"><a 
href="http://freenetproject.org/index.php?page=index"><img border="0" alt="The Freenet Project" src="image/title.gif" width="414" height="51"></a></td>

        <td height="31">&nbsp;</td>
      </tr>

      <tr>
        <td height="20" align="right" valign="bottom" background="image/hdr_bg_short.gif"><?
	foreach($modes as $m => $k) {
		if(!$k) {
			echo "<a href='index.php?page=".$page."&mode=".$m."' onMouseOver=\"rollOn('";
			echo $m."s');\" onMouseOut=\"rollOff('".$m."s');\"><img border=0 name=".$m;
			echo "s alt=".$m."s src=\"image/".$m."s.gif\"></a>";
		}
	}?></td></tr></table>

    <table width="100%" border="0" cellspacing="15" cellpadding="0">
      <tr>
        <td valign="top">
          <table border="0" cellspacing="5" cellpadding="0">
            <? include("menu.php"); ?>
          </table>
<br>
          <div align="center">
            <a href="http://www.cafeshops.com/freenetproject"><img width="83" height="82" border="0" src="image/freenet-mug.gif" alt="Freenet Store"><br>
            <font size="-2">Visit the Freenet Store!</font></a>
          </div>
<br>
          <div align="center">
            <a href="http://sf.net"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=978&amp;type=1" width="88" height="31" border="0" alt="SourceForge.net Logo"></a>
          </div>
        </td>

        <td valign="top" align="left" class="body" width="100%"><? 	include ("pages/$page.php");  ?>
        </td>
      </tr>
    </table>
<center><font size=-1>This website is licensed under the <a 
href="http://www.gnu.org/licenses/fdl.html">GNU Free Documentation License</a></font></center>
<div class="hideit">
Send spam to <a href="mailto:catchme@freenetproject.org">catchme@freenetproject.org</a> ! :)
<div>
  </body>
</html>


