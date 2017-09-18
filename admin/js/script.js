let deco = document.querySelector("#deco");

deco.addEventListener('click', function(e)
{
	e.preventDefault();

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET','destroy_session.php', true);
    xmlhttp.onreadystatechange=function(){
       if (xmlhttp.readyState == 4){
          if(xmlhttp.status == 200){
             document.location = "../index.php";
         }
       }
    };
    xmlhttp.send(null);
});