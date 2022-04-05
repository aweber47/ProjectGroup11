/*
 * This script contains AJAX methods
 */
var xmlHttp;
var numProducts = 0;  //total number of suggested menu items
var activeProduct = -1;  //menu item currently being selected
var searchBoxObj, suggestionBoxObj;

//this function creates a XMLHttpRequest object. It should work with most types of browsers.
function createXmlHttpRequestObject() {
    // create a XMLHttpRequest object compatible to most browsers
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        alert("Error creating the XMLHttpRequest object.");
        return false;
    }
}

//initial actions to take when the page load
window.onload = function () {
    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xmlHttp = createXmlHttpRequestObject();

    //DOM objects
    searchBoxObj = document.getElementById('searchtextbox');
    suggestionBoxObj = document.getElementById('suggestionDiv');
};

window.onclick = function () {
    suggestionBoxObj.style.display = 'none';
};

//set and send XMLHttp request. The parameter is the search term
function suggest(query) {
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        suggestionBoxObj.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", base_url + "/" + media + "/suggest/" + query, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON received from the server
            var products = JSON.parse(xmlHttp.responseText);
            //console.log(titlesJSON);
            // display suggested titles in a div block
            displayProducts(products);
        }
    };

    // make the request
    xmlHttp.send(null);
}


/* This function populates the suggestion box with spans containing all the titles
 * The parameter of the function is a JSON object
 * */
function displayProducts(products) {
    numProducts = products.length;
    //console.log(numTitles);
    activeProduct = -1;
    if (numProducts === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

    var divContent = "";
    //retrive the titles from the JSON doc and create a new span for each title
    for (i = 0; i < products.length; i++) {
        divContent += "<span id=s_" + i + " onclick='clickTitle(this)'>" + products[i] + "</span>";
    }
    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';
}

//This function handles keyup event. The funcion is called for every keystroke.
function handleKeyUp(e) {
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    /* if the keystroke is not up arrow or down arrow key,
     * call the suggest function and pass the content of the search box
     */
    if (e.keyCode !== 38 && e.keyCode !== 40) {
        suggest(e.target.value);
        return;
    }

    //if the up arrow key is pressed
    if (e.keyCode === 38 && activeProduct > 0) {
        //add code here to handle up arrow key. e.g. select the previous item
        activeProductObj.style.backgroundColor = "#FFF";
        activeProduct--;
        activeProductObj = document.getElementById("s_" + activeProduct);
        activeProductObj.style.backgroundColor = "#F5DEB3";
        searchBoxObj.value = activeProductObj.innerHTML;
        return;
    }

    //if the down arrow key is pressed
    if (e.keyCode === 40 && activeProduct < numProducts - 1) {
        //add code here to handle down arrow key, e.g. select the next item

        if(typeof(activeProductObj) != "undefined") {
            activeProductObj.style.backgroundColor = "#FFF";
        }
        activeProduct++;
        activeProductObj = document.getElementById("s_" + activeProduct);
        activeProductObj.style.backgroundColor = "#F5DEB3";
        searchBoxObj.value = activeProductObj.innerHTML;
    }
}



//when a title is clicked, fill the search box with the title and then hide the suggestion list
function clickProduct(product) {
    //display the title in the search box
    searchBoxObj.value = product.innerHTML;

    //hide all suggestions
    suggestionBoxObj.style.display = 'none';
}