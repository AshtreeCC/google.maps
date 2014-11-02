<div class="option">
	<label>
		<span style="font-weight:bold; color:#777;">Share link:</span> <input type="text" id="dlink" value="{$results_url}" style="width:244px" />
	</label>
</div>
<div class="option">
	<form action="{$download_link}" method="post" target="_blank">
        <a href="{$kml_link}" class="view_ge">Download KML for Google Earth</a>
    	<input type="hidden" name="rp" value="{$download_link_rp}" />
    	<input type="hidden" name="pa" value="{$download_link_pa}" />
    	<input type="hidden" name="ch" value="{$download_link_ch}" />
    	<input type="hidden" name="bl" value="{$download_link_bl}" />
    	<input type="hidden" name="cn" value="{$download_link_cn}" />
    </form>
</div>
<!-- <div class="option">
	<a href="{$csv_link}">CSV</a>
</div> -->
<div class="option">
	<a href="{$pdf_link}" target="_blank">Download PDF</a>
</div>
<div class="option">
	<span style="font-weight:bold; color:#777;">Embed with the current search results:</span>
	<div style="float:left;width:50%">
		<label>Width (px) <input type="text" id="dwidth" value="480" style="width:35px; height:25px; text-align:center;" /></label>	
	</div>
	<div style="float:left;width:50%">
		<label>Height (px) <input type="text" id="dheight" value="385" style="width:35px; height:25px; text-align:center;" /></label>	
	</div>
	<div>
		<textarea id="dframe" rows="4" style="width:330px; color:#555;">{$embed_code}</textarea>
	</div>	
</div>
<div style="float:right">
	<a href="#" id="share_box_close">CLOSE</a>
</div>