
	function run(){
		alto = []; 
		if ($('.adjust').find('.adjust-height').length) {
			$(".adjust").each(function () {
				$('.adjust-height', this).each(function () {
					var elem = $(this).height();
					//console.log(elem.length);
					if (elem) {
						alto.push(elem);
						max = Math.max.apply(Math, alto);
						//console.log(alto);
						return 0; 
					}
					 
				});
				console.log(max);
				$('.adjust-height', this).height(max);
				alto = [];
			})
		}else {
			console.log('No hay elementos que ajustar :)');
		}

	}

	function report(mensaje)
    {
	    $('.reports').show();
	    $('.reports p').text(mensaje);
	    setTimeout(function(){ $('.reports').hide(); }, 6000);
    }
	$(document).on('click', '.reports .close', function(){
		$('.reports').hide();
	});



