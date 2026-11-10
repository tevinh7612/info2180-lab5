document.addEventListener('DOMContentLoaded', function(){

    const countryInput = document.getElementById('country');
    const lookupButton = document.getElementById('lookup');
    const resultsDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function(){

        const country = countryInput.value.trim();
        const url = `world.php?country=${encodeURIComponent(country)}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultsDiv.innerHTML = data; 
            })
            .catch(error => {
                console.log('Error:', error);
            });

    });

});