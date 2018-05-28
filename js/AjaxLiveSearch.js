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
function loadMore() {
    let no = 12;
    console.log("load more function called");
    if (no < 0) {
        document.getElementById("results").innerHTML = "";
        return;
    } else {

        fetch("loadmore.php?no=" + no)
            .then(function(response) {

                //console.log(response);
                return response.json()
        })
            .then(function(json) {
                renderJsonLoad(json)
            })
    }
}

function renderJsonLoad(jsonResponse)
{
    document.getElementById("results").innerHTML = "";



    jsonResponse.forEach(function (advert) {

        console.log(advert);
        var target = document.getElementById('adverts');

        jsonString = `<div class="card text-center" style="box-shadow: 2.5px 3.5px #888888;margin-bottom:5.5px;">
                         <div class="card-header">${advert.ad_title}</div>
                        <img src= ${"images/"+advert.ad_photo} class="card-img-top"  style="width:auto;max-height:220px;" alt="">
                        <div class="card-body"><p><strong>TV Type : </strong>${advert.ad_type}</p>
                        <p><strong>Expires on : </strong</p>
                        <p><strong>Price : </strong>£${advert.price}</p>
                        <p>Item price is <strong></strong></p>
                        <div class="btn-group">
                        <a href="viewAd.php?id=${advert.ad_id}"  class=" btn btn-outline-secondary btn-sm">Watchlist +</a> 
                        <a href="viewAdvert.php?id=${advert.ad_id}"  class=" btn btn-outline-secondary btn-sm">View Ad</a>
                        <a href="mailto:" target="_blank" class=" btn btn-outline-secondary btn-sm">Contact Seller</a>
                        </div></div>
                        </div>`;

        var aDiv = document.createElement("div");

        aDiv.innerHTML = jsonString;

        target.appendChild(aDiv.firstChild);

    });



}