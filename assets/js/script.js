// Access the submit button 

var submit_button = document.getElementById("submit");
var search_handle = document.getElementById("searchbar-un");
var search_tweets = document.getElementById("searchbar-nm");

submit_button.addEventListener("click", function() {
    if (search_handle.value == "") {
        alert("Fill out form fields.");
    }
});

// AJAX