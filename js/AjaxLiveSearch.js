/**
 * Created by Ibrahim on 14/04/18.
 */


function showHint(str) {
    if (str.length === 0) {
        document.getElementById("results").innerHTML = "";
        return;
    } else {

        fetch("livesearch.php?q=" + str)
            .then(function(response) {

                //console.log(response);
                return response.json()
        })
            .then(function(json) {
                renderJson(json)
            })
    }
}

function renderJson(jsonResponse)
{
    document.getElementById("results").innerHTML = "";



    jsonResponse.forEach(function (advert) {

        console.log(advert);
        var target = document.getElementById('results');

        jsonString = `<img id="liveSearch" src= ${"images/"+advert.ad_photo}/> <a href ="viewAdvert.php?id=${advert.ad_id}">    ${advert.ad_title}        </a>|            £${advert.price}<br/>`;

        var aTag = document.createElement("li");

        aTag.innerHTML = jsonString;

        while(aTag.firstChild){
            target.appendChild(aTag.firstChild);
        }

    });



}
