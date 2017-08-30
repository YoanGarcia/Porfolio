var close_sidemenu = document.querySelector('#close_sidemenu');
var sidemenu = document.querySelector('#sidemenu');


close_sidemenu.addEventListener('click', function(e)
{
	e.preventDefault();
	
	console.log(sidemenu);
	
	sidemenu.style.display = 'none';
	
	alert('test');
	
});