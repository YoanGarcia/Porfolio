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

var button_all_creations = document.querySelector('#all_creations');
var button_illu_creations = document.querySelector('#illu_creations');
var button_photo_creations = document.querySelector('#photo_creations');
var button_3ds_creations = document.querySelector('#creations_3ds');

var creations_3ds = document.querySelectorAll('.c3ds');
var creations_photo = document.querySelectorAll('.photo');
var creations_illu = document.querySelectorAll('.illu');

button_all_creations.addEventListener('click', function(e)
{
	e.preventDefault();
	
	if(creations_illu.length != 0)
	{
		Array.prototype.map.call(creations_illu, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}

	if(creations_photo.length != 0)
	{
		Array.prototype.map.call(creations_photo, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}

	if(creations_3ds.length != 0)
	{
		Array.prototype.map.call(creations_3ds, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}
});

button_illu_creations.addEventListener('click', function(e)
{
	e.preventDefault();
	
	if(creations_illu.length != 0)
	{
		Array.prototype.map.call(creations_illu, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}

	if(creations_photo.length != 0)
	{
		Array.prototype.map.call(creations_photo, function(crea)
		{
			crea.style.display = 'none';
		});
	}

	if(creations_3ds.length != 0)
	{
		Array.prototype.map.call(creations_3ds, function(crea)
		{
			crea.style.display = 'none';
		});
	}	
});

button_photo_creations.addEventListener('click', function(e)
{
	e.preventDefault();
	
	if(creations_illu.length != 0)
	{
		Array.prototype.map.call(creations_illu, function(crea)
		{
			crea.style.display = 'none';
		});
	}

	if(creations_photo.length != 0)
	{
		Array.prototype.map.call(creations_photo, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}

	if(creations_3ds.length != 0)
	{
		Array.prototype.map.call(creations_3ds, function(crea)
		{
			crea.style.display = 'none';
		});
	}	
});

button_3ds_creations.addEventListener('click', function(e)
{
	e.preventDefault();
		
	if(creations_illu.length != 0)
	{
		Array.prototype.map.call(creations_illu, function(crea)
		{
			crea.style.display = 'none';
		});
	}

	if(creations_photo.length != 0)
	{
		Array.prototype.map.call(creations_photo, function(crea)
		{
			crea.style.display = 'none';
		});
	}

	if(creations_3ds.length != 0)
	{
		Array.prototype.map.call(creations_3ds, function(crea)
		{
			crea.style.display = 'inline-block';
		});
	}
		
});

let creation = document.querySelectorAll('.creation');
let creation_p = document.querySelectorAll('.creation p');
let body = document.querySelector('body');


Array.prototype.map.call(creation, function(crea)
{
	crea.addEventListener('click', function(e)
	{
		e.preventDefault();

		let popup = document.querySelector('#popup_creation');
		if(popup)
		{
			popup.remove();
		}

		let new_div = document.createElement('section');
		let close = document.createElement('section');

		close.id = 'popup_creation_close';
		close.innerHTML = "X";

		new_div.id = 'popup_creation';
		new_div.innerHTML = this.innerHTML;
		new_div.appendChild(close);

		body.appendChild(new_div);

		popup_close = document.querySelector('#popup_creation_close');
		popup = document.querySelector('#popup_creation');
		if(popup_close)
		{
			popup_close.addEventListener('click', function()
			{
				popup.remove();	
			});
		}
	});
});