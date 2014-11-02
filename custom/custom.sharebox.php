<?php

// Put the share box into a variable that can be used again
$embed_link_path   = "{$tpl->portal_name}.mapaproject.org/embed/";
$embed_link_string = preg_replace('/.*?\?/is', '', $tpl->results_url);
$snapshot_string   = preg_replace('/.*?\?/is', '', $tpl->download_link.$tpl->download_link_2);

//$tpl->results_url = $embed_link_path.basic_hash($embed_link_string)."/";
$tpl->embed_url   = $embed_link_path."map/".basic_hash($embed_link_string)."/";
$tpl->embed_code  = "<iframe width=\"480\" height=\"385\" src=\"http://{$tpl->embed_url}\" frameborder=\"0\"></iframe>";

$embed_share_box                = str_replace("\n", "", $tpl->include_template("/tpl/map--share-box.tpl.php"));

$htm->jquery = <<<JQUERY
var map;

// Add a custom control share box
$('#map_canvas').gmap('addControl', 'control', google.maps.ControlPosition.RIGHT_TOP);

// Add custom controls
map = $('#map_canvas').gmap('get', 'map');
shareDiv = $('<div/>');
shareCtl = new ShareControl(shareDiv, map);

shareDiv.index = 1;
map.controls[google.maps.ControlPosition.TOP_RIGHT].push(shareDiv.get(0));


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
        $.get('http://{$embed_link_path}generate/', {
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
       
JQUERY;

