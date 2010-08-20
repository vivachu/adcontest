function writeFlashApp(divId, movie, bgColor, flashVars, width, height, name) {
	if(name==null) name = 'Main';
  	var s = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" '+
			' id="'+name+'" height="' + height + '" width="' + width + '" ' +
			' codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">' +
			' <param name="movie" value="' + movie + '" /> '+
			' <param name="quality" value="high" /> ';
	if (bgColor) {
		s+=	' <param name="bgcolor" value="' + bgColor + '" /> ';
	}
	else {
		s+= ' <param name="wmode" value="transparent" /> ';
	}
		s+=	' <param name="allowNetworking" value="all" /> '+
			' <param name="allowScriptAccess" value="always" /> '+
			' <param name="flashvars" value="' + flashVars + '"/> '+
			' <embed src="' + movie + '" quality="high" ';
	if (bgColor) {
		s+=	'   bgcolor="' + bgColor + '" ';
	}
	else {
		//s+=	' 	wmode="opaque" ';
		s+=	' 	wmode="transparent" ';
	}
		s+=	' 	height="' + height + '" width="' + width + '" id="'+name+'" name="'+name+'" align="middle" '+
			' 	play="true" '+
			' 	loop="false" '+
			' 	quality="high" '+
			' 	flashvars="' + flashVars + '" '+
			' 	allowNetworking="all" '+
			' 	allowScriptAccess="always" '+
			' 	type="application/x-shockwave-flash" '+
			' 	pluginspage="http://www.adobe.com/go/getflashplayer"> '+
			' </embed> '+
	' </object> ';
//alert(s);
	document.getElementById(divId).innerHTML = s;
}