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