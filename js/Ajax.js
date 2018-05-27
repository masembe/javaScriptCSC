/**
 * Created by stc706 on 28/04/18.
 */


function showHint(str) {
    if (str.length === 0) {
        document.getElementById("results").innerHTML = "";
        return;
    } else {
//         var xmlhttp = new XMLHttpRequest();
//
//         xmlhttp.overrideMimeType("application/json");
//
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 //alert('test');
//                 var uic = document.getElementById("txtHint");
// //                    uic.innerHTML = this.responseText;
//
//                 var jsonResponse = JSON.parse(xmlhttp.responseText);
//
//                 renderJson(jsonResponse);
//             }
//         };
//         xmlhttp.open("GET", "gethint.php?q=" + str, true);
//         xmlhttp.send();


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

        jsonString = `<img width="50px" height="50px" src= ${"images/"+obj.ad_photo}/><a href ="viewAdd.php?search=${obj.ad_title}&searchButton=Go!">${obj.ad_title}</a><br/> <br/>`;


        var aTag = document.createElement("li");

        aTag.innerHTML = jsonString;

        while(aTag.firstChild){
            target.appendChild(aTag.firstChild);
        }

    });



}
