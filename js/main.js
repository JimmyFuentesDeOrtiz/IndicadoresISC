$(document).ready(function () {
	/*articulos para llamar a las secciones del menu*/
	/*$('ul.tabs li a:first').addClass('active');*/
	$('.secciones article').hide();
	$('.secciones article:first').show();

	$('ul.tabs li a').click(function () {
		$('ul.tabs li a').removeClass('active');
		$(this).addClass('active');
		$('.secciones article').hide();

		var activeTab = $(this).attr('href');
		$(activeTab).show();
		return false;
	});
});

/*Sidebar izquierdo*/
$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar, #content, #hamburger button').toggleClass('active');
		$('.collapse.in').toggleClass('in');
		$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		document.getElementById("bodyContent").style.width = "100%";
	});
});
/*Indicador de Carga Web */
