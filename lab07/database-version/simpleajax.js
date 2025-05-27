function getData(dataSource, divID, aName, aPwd) {
    const place = document.getElementById(divID);
    place.innerHTML = '<p>Searching...</p>';
    
    fetch(dataSource, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `name=${encodeURIComponent(aName)}&pwd=${encodeURIComponent(aPwd)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(text => {
        if (text.startsWith("Error:")) {
            place.innerHTML = `<p class="error">${text}</p>`;
        } else {
            place.innerHTML = `<p class="success">Your email: ${text}</p>`;
        }
    })
    .catch(error => {
        place.innerHTML = `<p class="error">Error: ${error.message}</p>`;
        console.error('Fetch error:', error);
    });
}