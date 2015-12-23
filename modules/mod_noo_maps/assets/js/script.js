/**
 * @version		$Id$
 * @author		NooTheme
 * @package		Joomla.Site
 * @subpackage	mod_noo_maps
 * @copyright	Copyright (C) 2013 NooTheme. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */

!function($){
	"use strict";
	function htmlspecialchars_decode (string, quote_style) {
	  var optTemp = 0,
	    i = 0,
	    noquotes = false;
	  if (typeof quote_style === 'undefined') {
	    quote_style = 2;
	  }
	  string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
	  var OPTS = {
	    'ENT_NOQUOTES': 0,
	    'ENT_HTML_QUOTE_SINGLE': 1,
	    'ENT_HTML_QUOTE_DOUBLE': 2,
	    'ENT_COMPAT': 2,
	    'ENT_QUOTES': 3,
	    'ENT_IGNORE': 4
	  };
	  if (quote_style === 0) {
	    noquotes = true;
	  }
	  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
	    quote_style = [].concat(quote_style);
	    for (i = 0; i < quote_style.length; i++) {
	      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
	      if (OPTS[quote_style[i]] === 0) {
	        noquotes = true;
	      } else if (OPTS[quote_style[i]]) {
	        optTemp = optTemp | OPTS[quote_style[i]];
	      }
	    }
	    quote_style = optTemp;
	  }
	  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
	    string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
	    // string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
	  }
	  if (!noquotes) {
	    string = string.replace(/&quot;/g, '"');
	  }
	  // Put this in last place to avoid escape being double-decoded
	  string = string.replace(/&amp;/g, '&');

	  return string;
	}

	
	var nooMap = function(element,options){
		this.element = $(element)
		this.options = options;
		this.directionsService = new google.maps.DirectionsService();
		this.initialize();
		
	}

	nooMap.prototype = {
		initialize:function(){
			var $this = this,
				mapInner = this.options.mapInner,
				travMode = null,
				Latlng = new google.maps.LatLng(this.options.latitude,this.options.longitude),
				mapOpt = {
					zoom: this.options.zoom,
					center: Latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					streetViewControl:false,
					scrollwheel:this.options.scrollwheel
				}
			this.Latlng = Latlng;
			this.map = new google.maps.Map(this.element.get(0), mapOpt);
			this.panorama = this.map.getStreetView();
			this.panorama.setPosition(Latlng);
			this.panorama.setPov(({
			    heading: 265,
			    pitch: 0
			  }));
			this.createMarker(Latlng,this.options.address,this.options.description);
			this.directionsDisplay = new google.maps.DirectionsRenderer();
			this.directionsDisplay.setMap(this.map);

			//google.maps.event.trigger(this.map, 'resize');
			google.maps.event.addDomListener(window, "resize", function() {
				 var center = $this.map.getCenter();
				 google.maps.event.trigger($this.map, "resize");
				 $this.map.setCenter(center); 
			});
		},
		placeMarker:function(position){
			var marker = new google.maps.Marker({
			    position: position,
			    map: this.map
			  });
			  this.map.panTo(position);

		},
		createMarker:function(latlng,address,description){
			var $this = this,
				formHtml = '<form class="" onsubmit="return findDirFromAddr(this,\''+$this.element.attr('id')+'\');" action="#"><div class="input-append"><input id="noodirInput" placeholder="'+this.options.translates.FROM_ADDRESS+'" type="text"><button class="btn" type="submit">'+this.options.translates.GO+'</button></div></form>',
				contentString = '<div class="noo-m-info">'+
		      '<h1>'+address+'</h1>';
			  if(description){
				 contentString += '<div class="noo-m-info-content">'+ Base64.decode(description) + '</div>'+
			      '<div class="noo-m-actbar-list">'+
			      '<div class="noo-m-act">'+
			      '<a id="noomdir">'+this.options.translates.DIRECTIONS+'</a> <a id="noomstreet" onclick="toggleStreetView(this,\''+$this.element.attr('id')+'\')">'+this.options.translates.STREET_VIEW+'</a>'+
			      '<div class="dirform-inner">'+formHtml+'</div>'+
			      '</div>'+
			      '</div>'+
			      '</div>';
			  }

		  var infowindow = new google.maps.InfoWindow({
		      content: contentString,
		      maxWidth: 300
		  });

		  this.marker = new google.maps.Marker({
		      position: latlng,
		      map: this.map,
		      title: address,
		      draggable: false,
		      animation: google.maps.Animation.DROP
		  });
		  
		 
		  google.maps.event.addListener(this.marker, 'click', function() {
		  	  infowindow.open(this.map,this);
		  });
	  
		  if(this.options.infowindow){
			  setTimeout(function(){google.maps.event.trigger($this.marker, 'click')},2000);
		  }
		},
		findDirFromAddr:function(element){
			var $this = this,
				dirForm = $(element),
				newAdd = dirForm.find("#noodirInput").val();
				
			if(newAdd == "")
				return false;
			
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( {
				'address': newAdd
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					$this.map.setCenter(results[0].geometry.location);
					$this.createMarker(results[0].geometry.location,newAdd);
					$this.showDirections($this.options.address,newAdd);
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
			
			return false;
		},
		showDirections:function(formAdd,toAdd){
			var $this = this,
				address = $this.getAddress($this.Latlng),
				request = {
			      origin:formAdd,
			      destination:toAdd,
			      travelMode: google.maps.DirectionsTravelMode.DRIVING
			  };
			this.directionsService.route(request, function(response, status) {
			    if (status == google.maps.DirectionsStatus.OK) {
			    	$this.directionsDisplay.setDirections(response);
			    }
			  });
		},
		toggleStreetView:function(){
		   var toggle = this.panorama.getVisible();
		   if (toggle == false) {
			   this.panorama.setVisible(true);
		   } else {
			   this.panorama.setVisible(false);
		   }
		},
		getAddress:function(Latlng) {
			var geocoder = new google.maps.Geocoder();
		    geocoder.geocode({'latLng': Latlng}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0]) {
						return results[0].formatted_address;
					}
				}
		    });
		}
	}
	
	$.fn.noomap = function(option){
		$.each(this,function(){
			var $this = $(this),
				noomap = $this.data('noomap'),
			    options = $.extend({}, $.fn.noomap.defaults, typeof option == 'object' && option);
			    if (!noomap){
					$this.data('noomap', (noomap = new nooMap(this, options)));
			    }
		});
		return this;
	};
	$.fn.noomap.defaults = {
			address:"",
			description:"",
			zoom:14,
			latitude:0,
			longitude:0,
			language:'en',
			infowindow:1,
			scrollwheel:true,
			translates: {
				'DIRECTIONS':'Directions',
				'STREET_VIEW': 'Street view',
				'GO': 'Go',
				'FROM_ADDRESS':'From address'
			}
	}
}(jQuery);

function toggleStreetView(element,parent) {
	var noomap = jQuery(element).closest('#'+parent).data('noomap');
	noomap.toggleStreetView();
}
function toggleDirection(element){
	jQuery(".dirform-inner").toggle();
}
function findDirFromAddr(element,parent){
	var noomap = jQuery(element).closest('#'+parent).data('noomap');
	noomap.findDirFromAddr(element);
	return false;
}
var Base64 = {
		 
		// private property
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	 
		// public method for encoding
		encode : function (input) {
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;
	 
			input = Base64._utf8_encode(input);
	 
			while (i < input.length) {
	 
				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);
	 
				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;
	 
				if (isNaN(chr2)) {
					enc3 = enc4 = 64;
				} else if (isNaN(chr3)) {
					enc4 = 64;
				}
	 
				output = output +
				this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
				this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
	 
			}
	 
			return output;
		},
	 
		// public method for decoding
		decode : function (input) {
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
	 
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
	 
			while (i < input.length) {
	 
				enc1 = this._keyStr.indexOf(input.charAt(i++));
				enc2 = this._keyStr.indexOf(input.charAt(i++));
				enc3 = this._keyStr.indexOf(input.charAt(i++));
				enc4 = this._keyStr.indexOf(input.charAt(i++));
	 
				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;
	 
				output = output + String.fromCharCode(chr1);
	 
				if (enc3 != 64) {
					output = output + String.fromCharCode(chr2);
				}
				if (enc4 != 64) {
					output = output + String.fromCharCode(chr3);
				}
	 
			}
	 
			output = Base64._utf8_decode(output);
	 
			return output;
	 
		},
	 
		// private method for UTF-8 encoding
		_utf8_encode : function (string) {
			string = string.replace(/\r\n/g,"\n");
			var utftext = "";
	 
			for (var n = 0; n < string.length; n++) {
	 
				var c = string.charCodeAt(n);
	 
				if (c < 128) {
					utftext += String.fromCharCode(c);
				}
				else if((c > 127) && (c < 2048)) {
					utftext += String.fromCharCode((c >> 6) | 192);
					utftext += String.fromCharCode((c & 63) | 128);
				}
				else {
					utftext += String.fromCharCode((c >> 12) | 224);
					utftext += String.fromCharCode(((c >> 6) & 63) | 128);
					utftext += String.fromCharCode((c & 63) | 128);
				}
	 
			}
	 
			return utftext;
		},
	 
		// private method for UTF-8 decoding
		_utf8_decode : function (utftext) {
			var string = "";
			var i = 0;
			var c = c1 = c2 = 0;
	 
			while ( i < utftext.length ) {
	 
				c = utftext.charCodeAt(i);
	 
				if (c < 128) {
					string += String.fromCharCode(c);
					i++;
				}
				else if((c > 191) && (c < 224)) {
					c2 = utftext.charCodeAt(i+1);
					string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
					i += 2;
				}
				else {
					c2 = utftext.charCodeAt(i+1);
					c3 = utftext.charCodeAt(i+2);
					string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
					i += 3;
				}
	 
			}
	 
			return string;
		}
	 
	}