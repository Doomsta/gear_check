<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{$PAGE_TITLE}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{$DESCRIPTION}">
    <meta name="author" content="{$AUTHOR}">
    <link rel="shortcut icon" href="{$ICON}" type="image/png" />
    <link rel="icon" href="{$ICON}" type="image/png" />
    <!-- Le styles -->
    {$CSS_FILES}    
    <link href="{$BOOTSRAPPATH}css/bootstrap.css" rel="stylesheet">
    <link href="{$BOOTSRAPPATH}css/bootstrap-responsive.css" rel="stylesheet">
    <link href="{$BOOTSRAPPATH}css/bootstrap.css" rel="stylesheet">
    <link href="{$BOOTSRAPPATH}css/bootstrap-responsive.css" rel="stylesheet">
    <link href="{$BOOTSRAPPATH}css/docs.css" rel="stylesheet">
    <link href="css/base.css" rel="stylesheet">	
	<style>
      body {
        padding-top: 40px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
	<style type="text/css">
		{$CSS_CODE}
	</style>
  </head>

    <body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">{$PROJEKTNAME}</a>
          <div class="nav-collapse collapse">
            <ul class="nav"> 
{foreach key=schluessel item=wert from=$NAV_LINKS}
              <li class="{$wert.class}"><a href="{$wert.url}">{$wert.name}</a></li>
{/foreach}
            </ul>
          </div>
        </div>
   </div>
    </div>
	<!-- Subhead
================================================== -->
<header class="jumbotron subhead">
  <div class="container">
    <h1>{$SUBHEADBIG}</h1>
    <p class="lead">{$SUBHEADSMALL}</p>
  </div>
</header>
    <!-- Docs nav
    ================================================== -->	

<div class="container">
    <div class="row">
        <div class="span12">
	

            <!-- Overview
            ================================================== -->
            {include file="{$TEMPLATEFILE}"}

            {include file="debug.tpl"}
        </div>
    </div>
</div>

    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <p>FOOTER</P>
        <p>FOOTER</p>
        <ul class="footer-links">
          <li><a href="#">LINK1</a></li>
          <li class="muted">&middot;</li>
          <li><a href="#">Link2</a></li>
          <li class="muted">&middot;</li>
          <li><a href="#">LInk3</a></li>
        </ul>
      </div>
    </footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{$BOOTSRAPPATH}js/jquery.js"></script>
    <script src="{$BOOTSRAPPATH}js/bootstrap.js"></script>
    {$JS_FILES}
    {$ENDSCRIPT}
  </body>
</html>
