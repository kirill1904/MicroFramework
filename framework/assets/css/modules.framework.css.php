<?php
    ob_start ("ob_gzhandler");
    header ("content-type: text/css; charset: UTF-8");
    header ("cache-control: must-revalidate");
    $offset = 60 * 60;
    $expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
    header ($expire);
?>
.blog{
  display: inline-block;
  text-decoration: none;
}

.blog_item{
  width: 150px;
  min-height:150px;
  display: inline-block;
  margin:10px;
  padding: 15px;
  text-decoration: none; 
}
.blog_item:hover{
  background:lightgray;
  
}
.dropdown-menu{
	padding: 0;
	margin: 0;
	border: none;
	top:-8px;
}
.dropdown-item{

}
html {
  position: relative;
  min-height: 100%;
}
body!important {
  /* Margin bottom by footer height */
  margin-bottom: 50px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 50px;
}


@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min-device-pixel-ratio: 1.5), only screen and (max-width: 960px) {
.blog_item{
  width: 250px;
  min-height:40px;
  display: block;
  text-decoration: none; 
}
}	