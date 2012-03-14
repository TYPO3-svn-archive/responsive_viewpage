<?php

unset($MCONF);
require ('conf.php');
require ($BACK_PATH.'init.php');


$urlP = parse_url(t3lib_div::getIndpEnv("REQUEST_URI"));
//header("Location: index.php?".$urlP["query"]);
$thepage = $urlP["query"];

$iFrame =0;	// I hoped that with an IFRAME the links to "_top" would not really open in "_top" but top of the IFRAME. But that was not the case...
if ($iFrame)	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
</head>
<body marginwidth=0 marginheight=0 topmargin=0 leftmargin=0>
<?php
echo '<IFRAME src="index.php?'.$urlP["query"].'" id="VIEWFRAME" style="visibility: visible; position: absolute; left: 0px; top: 0px; height=100%; width=100%"></IFRAME>';
?>
</body>
</html>
<?php
} else {
?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Responsive Design Testing</title>
<script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	if (top.fsMod) top.fsMod.recentIds['web'] = <?php echo intval(t3lib_div::_GET("id"));?>;
  
  
$(function() {
  $("#bm_generate .sortable").sortable({
    axis:   "y",
    handle: ".sort"
  });

  $("#add_row_link").bind("click", bm_ns.add_row);
  $(".del").live("click", bm_ns.delete_row);
  $("#generate_btn").bind("click", function() { bm_ns.generate_bookmarklet(true) });

  // generate it for them automatically
  bm_ns.generate_bookmarklet(false);
});


var bm_ns = {};
bm_ns.add_row = function(e) {
  $("#bm_generate .sortable").append(
    '<div class="row">' +
    '<ul>' +
      '<li class="col0 sort">&nbsp;</li>' +
      '<li class="col1"><input type="text" value="" /></li>' +
      '<li class="col2"><input type="text" value="" /></li>' +
      '<li class="col3"><input type="text" value="" /></li>' +
      '<li class="col4 colN del">x</li>' +
    '</ul>' +
    '<div class="clear"></div>' +
  '</div>');
}

bm_ns.delete_row = function(e) {
  $(e.target).closest(".row").remove();
}

bm_ns.generate_bookmarklet = function(highlight) {
  var link = "javascript:document.write('<!DOCTYPE html><html><head>&lt;meta charset=&quot;utf-8&quot;><title>Responsive Design Testing</title><style>body { margin: 20px; font-family: sans-serif; overflow-x: scroll; }.wrapper { width: 6000px; }.frame { float: left; }h2 { margin: 0 0 5px 0; }iframe { margin: 0 20px 20px 0; border: 1px solid #666; }</style></head><body><div class=&quot;wrapper&quot;>";
  $("#bm_generate .sortable .row").each(function() {
    var width  = $(this).find(".col1 input").val();
    var height = $(this).find(".col2 input").val();
    var label  = $(this).find(".col3 input").val();
    if (label) {
      label = "(" + label + ")";
    }
    link += "<div class=&quot;frame&quot;><h2>" + width + "<span> x " + height + "</span> <small>" + label + "</small></h2>"
          + "<iframe src=&quot;index.php?<?php echo $thepage;?>&quot; sandbox=&quot;allow-same-origin allow-forms&quot; seamless "
          + "width=&quot;" + width + "&quot; height=&quot;" + height + "&quot;></iframe></div>"
  });
  link += "</div></body></html>')";
  $("#bookmarklet_link").html('<a class="affichage" href="' + link + '">Responsive Design Test</a>');

  if (highlight) {
    $("#bookmarklet_link").effect("highlight", { color: "#00ff00" }, 2000);
  }

  $(".affichage").trigger("click");

}
  
  
</script>
<style>body { margin: 20px; font-family: sans-serif; overflow-x: scroll; }.wrapper { width: 6000px; }.frame { float: left; }h2 { margin: 0 0 5px 0; }iframe { margin: 0 20px 20px 0; border: 1px solid #666; }
#bm_generate ul {
  list-style: none;
  margin: 0px;
  padding: 0px;
}
#bm_generate .heading {
  font-weight: bold;
}
#bm_generate ul li {
  float: left;
}
#bm_generate .col0 {
  width: 20px;
  display: block;
}
#bm_generate .row {
  background-color: #f2f2f2;
  height: 22px;
  border-bottom:1px solid white;
  width: 410px;
}
#bm_generate .sortable .col0 {
  background: transparent url(sort.png) center center no-repeat;
  cursor: move;
}
#bm_generate .col1 {
  width: 80px;
}
#bm_generate .col1 input {
  width: 65px;
}
#bm_generate .col2 {
  width: 80px;
}
#bm_generate .col2 input {
  width: 65px;
}
#bm_generate .col3 {
  width: 200px;
}
#bm_generate .col3 input {
  width: 195px;
}
#bm_generate .del {
  width: 20px;
  padding: 0px 4px;
  background-color: #990000;
  color: white;
  text-align: center;
  border-radius: 2px;
  cursor: pointer;
}
#bm_generate .del:hover {
  background-color: #333333;
}
#add_row_link {
  color: #0033cc;
  text-decoration: none;
  cursor: pointer;
}
#add_row_link:hover {
  text-decoration: underline;
}
#generate_btn {
  background-color: green;
  padding: 2px 8px;
  border-radius: 3px;
  color: white;
  cursor: pointer;
}
#generate_btn:hover {
  background-color: #0055cc;
}
#bookmarklet_link {
  padding: 20px;
  background-color: #f2f2f2;
  border: 1px solid #dddddd;
  width: 160px;
}
</style>
</head>
<body>
<div id="bm_generate">
      <ul class="heading">
        <li class="col0">&nbsp;</li>
        <li class="col1">Width (px)</li>
        <li class="col2">Height (px)</li>
        <li class="col3">Label</li>
        <li class="col4 colN del"></li>
      </ul>
      <div class="clear"></div>
      <div class="sortable">
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="240" /></li>
            <li class="col2"><input type="text" value="320" /></li>
            <li class="col3"><input type="text" value="mobile" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="320" /></li>
            <li class="col2"><input type="text" value="480" /></li>
            <li class="col3"><input type="text" value="mobile" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="480" /></li>
            <li class="col2"><input type="text" value="640" /></li>
            <li class="col3"><input type="text" value="small tablet" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="768" /></li>
            <li class="col2"><input type="text" value="1024" /></li>
            <li class="col3"><input type="text" value="tablet - portrait" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="1024" /></li>
            <li class="col2"><input type="text" value="768" /></li>
            <li class="col3"><input type="text" value="tablet - landscape" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="row">
          <ul>
            <li class="col0 sort">&nbsp;</li>
            <li class="col1"><input type="text" value="1200" /></li>
            <li class="col2"><input type="text" value="800" /></li>
            <li class="col3"><input type="text" value="desktop" /></li>
            <li class="col4 colN del">x</li>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <p id="add_row_link">Ajouter une ligne &raquo;</p>
    <span id="generate_btn">Generate!</span>

    <p id="bookmarklet_link"></p>

</body></html>

<?php
}
?>