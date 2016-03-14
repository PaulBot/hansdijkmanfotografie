jQuery(function(){
	var $ = jQuery;

	function setMobile(){
		var mobile;
		if($('.mobilecheck').is(':visible')){
			mobile = true;
		} else {
			mobile = false;
		}
		return mobile;
	}


	function setMenu(){


		var mobile = setMobile();
		if(mobile === true){
			$('.menu').removeClass('open');
			$('body').addClass('mobile');
			$('#nav-toggle').removeClass('active');
		} else {
			$('.menu').addClass('open');
			$('body').removeClass('mobile');
			$('#nav-toggle').addClass('active');
		}
	}

	setMenu();

	$(window).on('resize', function(){
		setMenu();
	});

	$("#nav-toggle").on( "click", function() {
    	$(this).toggleClass( "active" );
    	$('.menu').toggleClass('open');

  	});

	$.customSlider = function(holder){
		that = this;
		this.slides = $(holder).find('.slide');

		this.numSlides = $(this.slides).length;
		this.counter = this.numSlides -1;
		
		$(this.holder).fadeIn();
		this.slide = function(){
			setInterval(function(){
				var curSlide = $(that.slides)[that.counter];
				$(curSlide).addClass('fade');
				
				console.log('counter' + that.counter);
				console.log('numslides' + that.numSlides);
				that.counter = that.counter - 1;
				if(that.counter === -1){
					$(that.slides).removeClass('fade');
					that.counter = that.numSlides -1;
				}

			}, 5000);
		};
		this.slide();
	};

	

 	baguetteBox.run('.gallery');
 	$('.gallery').fadeIn();  

 	$('#menu-hoofdmenu').on('click', 'a', function(e){
 		e.preventDefault();
 		var link = $(e.target).attr('href');

 		$('.loadverlay').fadeIn(300, function(e){
 			window.location.href = link;
 		});
 	});
});

jQuery(window).load(function(){
	var $ = jQuery;
    $(".textcontent").mCustomScrollbar();
    $('.loadverlay').fadeOut(1000, function(){
    	if($('.fullslider')[0]){
    		slider = new $.customSlider('.fullslider');
    	}
    });

    $('.gallery').jMosaic({
		items_type: "a", 
		min_row_height: 200, 
		margin: 10, 
		is_first_big: false
	});        
});


jQuery(window).resize(function(e){
	var $ = jQuery;

	var resizeTimer;
  	clearTimeout(resizeTimer);
  	resizeTimer = setTimeout(function() {
  		$('.gallery .item').css({
  			'width': '',
  			'height': ''
   		});
		$('.gallery').jMosaic({
			items_type: "a", 
			min_row_height: 200, 
			margin: 10, 
			is_first_big: false
		});

  	}, 100);
});
