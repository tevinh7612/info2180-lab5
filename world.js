document.addEventListener('DOMContentLoaded', function(){

    const countryInput = document.getElementById('country');

    const lookupCountryButton = document.getElementById('lookup-country');
    const lookupCityButton = document.getElementById('lookup-city');

    const resultsDiv = document.getElementById('result');

    lookupCountryButton.addEventListener('click', () => dataLookup(countryInput, resultsDiv));
    lookupCityButton.addEventListener('click', () => dataLookup(countryInput, resultsDiv, "cities"));

});

function dataLookup(countryInput, outputElem, lookupType = "") {

    const country = countryInput.value.trim();
    let url = `world.php?country=${encodeURIComponent(country)}`; 
    
    if (lookupType === "cities") {
        url += '&lookup=cities';
    } 

    fetch(url)
        .then(response => response.text())
        .then(data => {
            outputElem.innerHTML = data; 
        })
        .catch(error => {
            console.log('Error:', error);
        });

}