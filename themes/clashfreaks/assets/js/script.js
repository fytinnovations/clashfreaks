function displayToaster(title,description){
    document.getElementById("toast_title").innerHTML=title;
    document.getElementById("toast_description").innerHTML=description;
    $('.toast').toast('show');
}