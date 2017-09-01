var close_sidemenu = document.querySelector('#close_sidemenu');
var open_sidemenu = document.querySelector('#open_sidemenu');
var sidemenu = document.querySelector('#sidemenu');


close_sidemenu.addEventListener('click', function(e)
{
	e.preventDefault();
		
	sidemenu.style.display = 'none';

	open_sidemenu.style.display = 'inline';	
});

open_sidemenu.addEventListener('click', function(e)
{
	e.preventDefault();
	
	sidemenu.style.display = 'block';

	open_sidemenu.style.display = 'none';
		
});