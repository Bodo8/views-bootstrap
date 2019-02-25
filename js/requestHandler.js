let targetURL = '../src/AppBundle/Controller/ControllerRequest.php';
let isAsynchronous = true;

function saveTaskToDatabase(actualDateTab) {
    let xmlHttpRequest = new XMLHttpRequest();
    let data = new FormData();

    data.append('action', 'save');
    data.append('year', actualDateTab["actualYear"]);
    data.append('month', actualDateTab["actualMonth"]);
    data.append('week', actualDateTab["actualWeek"]);
    data.append('day', actualDateTab["actualDay"]);
    data.append('descriptionTask', actualDateTab["descriptionTask"]);
    data.append('rangeTask', actualDateTab["rangeTask"]);
    xmlHttpRequest.open("POST", targetURL, isAsynchronous)
    xmlHttpRequest.onreadystatechange = function () {
        if (xmlHttpRequest.readyState === 4 && xmlHttpRequest.status === 200) {

            if (xmlHttpRequest.status === 404) {
                console.log("POST error. the request has not success");
            }
        }
    };
    xmlHttpRequest.send(data);
}

function FormDataToJSON(formElement) {

    let ConvertedJSON = {};
    for (const [key, value]  of formElement.entries()) {
        ConvertedJSON[key] = value;
    }

    return ConvertedJSON
}

function getTaskFromDatabase(actualDateTab) {
    let getUrl = getPreparedUrl(actualDateTab);
    const xmlHttpResponse = new XMLHttpRequest();
    xmlHttpResponse.onreadystatechange = function () {
        if (xmlHttpResponse.readyState === 4) {
            if (xmlHttpResponse.status === 200) {
                let taskFromDatabase = JSON.parse(this.responseText);
                addElementToListTasks(taskFromDatabase);
            }

            if (xmlHttpResponse.status === 404) {
                console.log(" File or resource not found")
            }
        }
    };
    xmlHttpResponse.open('GET', getUrl, isAsynchronous);
    xmlHttpResponse.send();
}

let actualTab = getDateTab();
getTaskFromDatabase(actualTab);

function getPreparedUrl(actualDateTab) {
    let newUrl = "";
    newUrl += targetURL + "?" + "action" + "=" + "insert" + "&";
    for (let key in actualDateTab) {
        if (actualDateTab.hasOwnProperty(key)) {
            newUrl += key + "=" + actualDateTab[key] + "&";
        }
    }
    return newUrl.substring(0, (newUrl.length - 1));
}