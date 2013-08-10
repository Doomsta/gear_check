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
          <a href="https://github.com/Doomsta/gear_check">
        <img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub">
      </a>
      
    <div class="navbar navbar-inverse navbar-fixed-top">
        <a class="navbar-brand" href="#">{$PROJEKTNAME}</a>
        <ul class="nav navbar-nav">
{foreach key=schluessel item=wert from=$NAV_LINKS}
              <li class="{$wert.class}"><a href="{$wert.url}">{$wert.name}</a></li>
{/foreach}
        </ul>
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
        <div class="col-lg-3">
            {include file="{$LEFT_INNER_TEMPLATE}"}
        </div>
        <div class="col-lg-9">
        
           <!-- alert print
           =========================================-->	
           {if isset($ERROR_MSG)}
                <div class="notify">
           {foreach from=$ERROR_MSG item=error}
                    <div class="alert alert-block alert-error fade in ">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4 class="alert-heading">{$error['head']}</h4>
                    <p>{$error['text']}</p>
                 </div>
              {/foreach}  
                </div>
             {/if}
            <!-- Overview
            ================================================== -->
            {include file="{$TEMPLATEFILE}"}
        </div>
    </div>
</div>

    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <p>FOOTER</P>
        <p>Rendering [{number_format(microtime() - $PERF_START_0,2)}ms]</p>
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
    <script type="text/javascript" src="http://cdn.openwow.com/api/tooltip.js"></script>
    {$JS_FILES}
    {$SCRIPT}
  </body>
</html>
