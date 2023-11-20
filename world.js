document.addEventListener('DOMContentLoaded', function(){

    var lookupButton = document.getElementById('lookup');
    var cityButton = document.getElementById('city-lookup');

    lookupButton.addEventListener('click', function(){

        var countryInput = document.getElementById('country').value;

        var xhr = new XMLHttpRequest();

        url = 'http://localhost/info2180-lab5/world.php?country=' + countryInput;
        xhr.open('GET', url);

        xhr.onload = function(){
            if(xhr.status === 200){
                console.log(xhr.responseText);
                var response = xhr.responseText;
                document.getElementById('result').innerHTML = response;
            }else{
                console.log('Error: ' + xhr.status);
            }
        }
        xhr.send();

    });

    cityButton.addEventListener('click', function(){

        var countryInput = document.getElementById('country').value;

        var xhr = new XMLHttpRequest();

        url = 'http://localhost/info2180-lab5/world.php?country=' + countryInput + '&lookup=cities';
        xhr.open('GET', url);

        xhr.onload = function(){
            if(xhr.status === 200){
                console.log(xhr.responseText);
                var response = xhr.responseText;
                document.getElementById('result').innerHTML = response;
            }else{
                console.log('Error: ' + xhr.status);
            }
        }
        xhr.send();

    });

});