/**
 * main3.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {
	var Ut = "M0,0 L10,0 C10,105.986036 10,210.607972 10,313.865807 C10,468.752559 10,538.081976 10,603.74187 C10,669.401764 10,755.03975 10,821.648704 C10,866.054674 10,927.171773 10,1005 L0,1005 L0,0 Z",
		Vt = "M0,0 L187,0 C145.137023,108.287035 129.797864,212.908971 140.982524,313.865807 C157.759513,465.301061 179.997341,538.394809 179.997341,603.74187 C179.997341,669.088931 141.263881,752.537628 127.977585,821.648704 C119.120054,867.722755 125.454491,928.839854 146.980896,1005 L0,1005 L0,0 Z",
		Rt = "M0,0 L375,0 C375,105.986036 375,210.607972 375,313.865807 C375,468.752559 375,538.081976 375,603.74187 C375,669.401764 375,755.03975 375,821.648704 C375,866.054674 375,927.171773 375,1005 L0,1005 L0,0 Z";

	var bodyEl = document.body,
        content = document.querySelector(".side-nav-backdrop"),
        openbtn = document.getElementById("open-button"),
        closebtn = document.getElementById("close-button"),
        adminbtn = document.querySelector(".adminmenu-link"),
        backbtn = document.querySelector(".adminmenu-back"),
        isOpen = false,
        morphEl = document.getElementById("morph-shape"),
        s = Snap(morphEl.querySelector("svg"));
		path = s.select( 'path' );
		initialPath = this.path.attr('d'),
		pathOpen = morphEl.getAttribute( 'data-morph-open' ),
		isAnimating = false;

	function init() {
		initEvents();
	}

	function initEvents() {
		openbtn.addEventListener( 'click', toggleMenu );
		if( closebtn ) {
			closebtn.addEventListener( 'click', toggleMenu );
		}

		// close the menu element if the target it´s not the menu element or one of its descendants..
		content.addEventListener( 'click', function(ev) {
			var target = ev.target;
			if( isOpen && target !== openbtn ) {
				toggleMenu();
			}
		} );
	}

	function toggleMenu() {
		if( isAnimating ) return false;
		isAnimating = true;
		if( isOpen ) {
			classie.remove( bodyEl, 'show-menu' );
			classie.remove(bodyEl, "show-adminmenu");
			// animate path
			setTimeout( function() {
				// reset path
				path.attr( 'd', initialPath );	
				

				isAnimating = false; 
			}, 300 );

		}
		else {
			classie.add( bodyEl, 'show-menu' );
			// animate path
			// path.animate( { 'path' : pathOpen }, 400, mina.easeinout, function() { isAnimating = false; } );
			
 			path.animate( { 'path' : pathOpen }, 400, mina.easeinout, function() { isAnimating = false; } );
			isAnimating = false;
		}
		isOpen = !isOpen;
	}

	init();


adminbtn.addEventListener("click", showAdminMenu);

backbtn.addEventListener("click", hideAdminMenu);

function showAdminMenu() {
    classie.add(bodyEl, "show-adminmenu");
}

function hideAdminMenu() {
    classie.remove(bodyEl, "show-adminmenu");
}


})();