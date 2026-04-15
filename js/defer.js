document.addEventListener("DOMContentLoaded", function(event) { 

    (function(document, tag) {
        var scriptTag = document.createElement(tag), // create a script tag
            firstScriptTag = document.getElementsByTagName(tag)[0]; // find the first script tag in the document
        scriptTag.src = 'https://code.jquery.com/jquery-3.4.1.min.js'; // set the source of the script to your script
        firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag); // append the script to the DOM
    }
    
    (document, 'script'));

});