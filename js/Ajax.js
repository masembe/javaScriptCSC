/**
 * Created by Ibrahim on 14/04/18.
 */


function showHint(str) {
    if (str.length === 0) {
        document.getElementById("results").innerHTML = "";
        return;
    } else {
//


        fetch("gethint.php?q=" + str)
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



    jsonResponse.forEach(function (obj) {

        console.log(obj);
        var target = document.getElementById('results');

        // jsonString =  " <a class='list-group-item'  type='button' >" +
        //     obj._tittle + ": " + obj._description + "</a> ";

        jsonString = `<img width="50px" height="50px" src= ${"images/"+obj.ad_photo}/><a href ="viewAdvert.php?id=${obj.ad_id}">${obj.ad_title}</a><br/> <br/>`;


        var aTag = document.createElement("li");

        aTag.innerHTML = jsonString;

        while(aTag.firstChild){
            target.appendChild(aTag.firstChild);
        }

    });



}
