<?php
$tpl->download_link = ASH_BASEHTTP . "search.kml?";
$tpl->results_url   = ASH_BASEHTTP . preg_replace('/^\//', '', $_SERVER['REQUEST_URI']);

// Put the share box into a variable that can be used again
$embed_link_path   = ASH_ROOTHTTP . "embed/";
$embed_link_string = preg_replace('/.*?\?/is', '', $tpl->results_url);
$snapshot_string   = preg_replace('/.*?\?/is', '', $_SERVER['REQUEST_URI'].'&t=kml');

//$tpl->results_url = $embed_link_path.basic_hash($embed_link_string)."/";
$tpl->embed_url   = $embed_link_path."map/".basic_hash($embed_link_string)."/";
$tpl->embed_code  = "<iframe width=\"480\" height=\"385\" src=\"{$tpl->embed_url}\" frameborder=\"0\"></iframe>";

$tpl->kml_link = ASH_BASEHTTP . "search.kml?{$snapshot_string}";
$tpl->csv_link = ASH_BASEHTTP . "search.csv?{$snapshot_string}";
$tpl->pdf_link = ASH_BASEHTTP . "search.pdf?{$snapshot_string}";

$embed_share_box                = str_replace("\n", "", $tpl->include_template(ASH_PLUGINS . 'google.maps/custom/custom.sharebox.tpl.php'));

$htm->javascript = <<<JAVASCRIPT

function ShareControl(controlDiv, map) {

  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map
  controlDiv.css({
  	'padding': '5px'
  });
  
  // Set the DIV for the share information
  shareBox = $('<div/>')
  .css({
  	'position': 'absolute',
  	'top': '30px',
  	'left': '-186px',
  	'width': '345px',
  	'border': '1px solid #717B87',
  	'-webkit-box-shadow': 'rgba(0, 0, 0, 0.398438) 0px 2px 4px',
    'box-shadow': 'rgba(0, 0, 0, 0.398438) 0px 2px 4px',
    'background-color': '#FFF',
    'text-align': 'left',
    'padding':'5px'
  })
  .html('{$embed_share_box}')
  .hide();
  
  $('div.option', shareBox).css({
  	'border-bottom': '1px dashed #CCC',
  	'padding': '0 5px 5px',
  	'margin-bottom': '5px'
  })

  // Set CSS for the control border
  shareBtn = $('<div/>')
  .css({
  	'direction': 'ltr',
  	'text-align': 'center',
    'position': 'relative',
    'color': 'black',
    'font-family': 'Arial, sans-serif',
    'font-size': '13px',
    'background': 'white',
    'padding': '1px 6px',
    'border': '1px solid #717B87',
    '-webkit-box-shadow': 'rgba(0, 0, 0, 0.398438) 0px 2px 4px',
    'box-shadow': 'rgba(0, 0, 0, 0.398438) 0px 2px 4px',
    'font-weight': 'bold',
    'min-width': '29px',
    'background-position': 'initial initial',
    'background-repeat': 'initial initial',
    'background-color': '#FFF',
  	'border': '1px solid #717B87',
  	'cursor': 'pointer'
  })
  .attr('title', 'Click to choose a share method');
  controlDiv.append(shareBtn);

  // Set CSS for the control interior
  var controlTxt = $('<div/>').text('Share');

  shareBtn.append(controlTxt);
  controlDiv.append(shareBox);

  // Setup the click event listeners
  shareBtn.bind('click', function() {
    shareBox.toggle();
    if (shareBox.is(':visible')) {
        $.get('{$embed_link_path}generate/', {
      		'search'   : '{$embed_link_string}',
      		'snapshot' : '{$snapshot_string}'
      	});
    }
  });
  
  // Add an additional listener for the close button
  $('#share_box_close').live('click', function(e){
  	e.preventDefault();
  	shareBox.hide();
  });

}
       
JAVASCRIPT;

