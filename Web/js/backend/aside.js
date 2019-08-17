// this class manages admin right sidebar 

$(function() {

	const AsideButton = {

		rotation() {		// rotate arrow icon

			$('.fa-arrow-circle-left').css('transition', '' + this.transition + 's').css('transform', 'rotateZ(' + this.rotate + ')');
		}

	};

	class AsideParam  {

		constructor(rotate, transition) {

			this.rotate = rotate;
			this.transition = transition;
			
		}

	}

	class Aside {

		constructor(keyword, rotate, transition1, transition2, value1, value2) {

			this.keyword = keyword;				// "open", "close"
			this.rotate = rotate;				// 180, 0 deg 
			this.transition1 = transition1;		// 0, 0.5s
			this.transition2 = transition2;
			this.value1 = value1;				// css values 
			this.value2 = value2; 

		}

		openClose() {	

			Object.setPrototypeOf(AsideParam.prototype, AsideButton);		// bind class AsideParam to const 
			var rotation1 = new AsideParam(this.rotate, this.transition1); 
			rotation1.rotation();											// make arrow rotate

			if(this.keyword == 'open') {

				$('.label-hidden').show(this.transition2);					// show sidebar big titles 
				this.openBis();												// css to open sidebar 

			}
			else {

				$('.label-hidden').hide(this.transition2);					// hide sidbebar big titles 
				this.closeBis();											// css to close sidebar 

			}

		}

		closeBis() {	// css to close sidebar 

	  		$('.container-backend-content').css('transition', '' + this.transition1 + 's').css('width','' + this.value1 + '%');
			$('.menu-shown').css('transition', '' + this.transition1 + 's').css('width','' + this.value2 + 'px');
			$('.container-menu-hidden').css('transition', '' + this.transition1 + 's').css('width','' + this.value2 + 'px');

			$('#sup-admin').removeClass('open');
			$('.sub-admin').hide('slow');
		}

		openBis() {		// css to open sidebar 

			$('.container-backend-content').css('transition', '' + this.transition1 + 's').css('width', this.value2);
		  	$('.menu-shown').css('transition', '' + this.transition1 + 's').css('width', this.value1);
		  	$('.menu-hidden').css('transition', '' + this.transition1 + 's').css('width', this.value1);

		}

	}


	/***
	*
	*	when reload document and document width < 1100px 
	*
	***/

	var documentWidth = $(window).width();			

	if(documentWidth < 1100) {
								// ".close" class indicates that sidebar is closed 
								// ".closeLittle" indicates that sidebar is closed when document width is small
								// this class allows us to re-open aside when document width > 1100 px 
								// and document is enlarged 

		$('#open-close-aside').addClass('close').addClass('closeLittle');	
		var close1 = new Aside('close', '180deg', 0, 0, 96, 60); 
		close1.openClose();

	}

	if(documentWidth < 380) {
								// ".close" class indicates that sidebar is closed 
								// ".closeLittle" indicates that sidebar is closed when document width is small
								// this class allows us to re-open aside when document width > 1100 px 
								// and document is enlarged 

		$('#open-close-aside').addClass('close').addClass('closeLittle');	
		var close1 = new Aside('close', '180deg', 0, 0, 83, 60); 
		close1.openClose();

	}


	/***
	*
	*	CLICK 
	*
	***/

	$('#open-close-aside').click(function() {

		var documentWidth = $(window).width();

		 if(documentWidth < 380) {		

			if($('#open-close-aside').hasClass('close')) { // open sidebar when doc width > 1100 px 
														   // class ".openLittle" indicates that sidebar is open
														   // and allows us to keep sidebar open 
														   // when document is enlarged 	

				$('#open-close-aside').removeClass('close').removeClass('closeLittle').addClass('openLittle');
				var open1 = new Aside('open', '0deg', 0.5, 'slow', '230px', '83%'); 
				open1.openClose();

			}
			else {											// close sidebar 				 
				
				$('#open-close-aside').addClass('close').removeClass('openLittle');

				var close2 = new Aside('close', '180deg', 0.5, 'slow', 83, 60); 
				close2.openClose();
			}

		 }
		 if(documentWidth < 1100 && documentWidth > 380) {			

			if($('#open-close-aside').hasClass('close')) { // open sidebar when doc width > 1100 px 
														   // class ".openLittle" indicates that sidebar is open
														   // and allows us to keep sidebar open 
														   // when document is enlarged 	

				$('#open-close-aside').removeClass('close').removeClass('closeLittle').addClass('openLittle');
				var open1 = new Aside('open', '0deg', 0.5, 'slow', '230px', '96%'); 
				open1.openClose();

			}
			else {											// close sidebar 				 
				
				$('#open-close-aside').addClass('close').removeClass('openLittle');

				var close2 = new Aside('close', '180deg', 0.5, 'slow', 96, 60); 
				close2.openClose();
			}
		}
		else if(documentWidth > 1100) {	

			if($('#open-close-aside').hasClass('close')) {	// open sidebar 

				$('#open-close-aside').removeClass('close');
				var open2 = new Aside('open', '0deg', 0.5, 'slow', '20%', '80%'); 
				open2.openClose();

			}
			else {											// close sidebar
				
				$('#open-close-aside').addClass('close'); 
				var close3 = new Aside('close', '180deg', 0.5, 'slow', 96, 60); 
				close3.openClose();

			}

		}

	});


	/***
	*
	*	RESIZE 
	*
	***/

	$(window).resize(function() {

		var documentWidth = $(window).width();

		if(documentWidth < 380) {		

			$('.container-backend-content').css('width', '83%');

		}

		if(documentWidth < 1100 && documentWidth > 380) {		

			$('.container-backend-content').css('width', '96%');

		}

		if(documentWidth < 1100) {		

			if(!$('#open-close-aside').hasClass('close') && !$('#open-close-aside').hasClass('openLittle')) {

																			// close sidebar when document is reduced 
				$('#open-close-aside').addClass('close');
			 	var close4 = new Aside('close', '180deg', 0.5, 'slow', 96, 60); 
				close4.openClose();

			}

			if($('#open-close-aside').hasClass('close')) {	 	// keep suidebar closed when document is reduced
																// and open sdebar when document is enlarged 			

				$('#open-close-aside').addClass('closeLittle');
			}

			if($('#open-close-aside').hasClass('openLittle')) { // keep sidebar width at 230px when document is enlarged and sidebar is open
																// before changing sidebar width to 20% when document width > 1101px

				var open3 = new Aside(null, null, 0.5, null, '230px', null); 
				open3.openBis();
			}

		}

		if(documentWidth > 1101) {

			if($('#open-close-aside').hasClass('openLittle')) { 			// keep sidebar open when document is enlarged 
																			// and adapt the size of content container 	

				$('#open-close-aside').removeClass('openLittle');
				var open4 = new Aside(null, null, 0.5, null, '20%', '80%'); 
				open4.openBis();

			}

			if($('#open-close-aside').hasClass('closeLittle')) {	// open sdebar when document is enlarged 
																	// and keep suidebar closed when document is reduced 
																												
				$('#open-close-aside').removeClass('close').removeClass('closeLittle');																								
				var open5 = new Aside('open', '0deg', 0.5, 'slow', '20%', '80%'); 
				open5.openClose();

			}

		}

	});

});

  