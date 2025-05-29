// file simpleajax.js
// var xhr = createRequest();
function getData(dataSource, divID, aName, aPwd)  {
	const place = document.getElementById(divID);
	vconst data = new URLSearchParams();
data.append('name', aName);
data.append('pwd', aPwd);

    place.innerHTML = "<em>Fetching data... please wait.</em>";
fetch(dataSource, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: data.toString() })
    .then(response => response.json())
    .then(result => 
            if (result.status === 'ok') {  place.innerHTML = `${result.name} email address <em>${result.email}</em>`;} else {
                alert(result.message);
                place.innerHTML = '';}
        
    })
    .catch(error => {alert('Fetch error: ' + error);
		      place.innerHTML.jas = ''; });
}


/*	
	const requestPromise = fetch(url);
	requestPromise.then(
		function (response){
			response.text().then(function(text) {
				place.innerHTML = text;
			});



			
		}
	);
} 
*?


