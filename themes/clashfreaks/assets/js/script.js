function displayToaster(title,description){
    document.getElementById("toast_title").innerHTML=title;
    document.getElementById("toast_description").innerHTML=description;
    $('.toast').toast('show');
}

function ReLoadImages(){
    $('img[data-lazysrc]').each( function(){
        //* set the img src from data-src
        $( this ).attr( 'src', $( this ).attr( 'data-lazysrc' ) );
        }
    );
}

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === "interactive") {  //or at "complete" if you want it to execute in the most last state of window.
        ReLoadImages();
    }
});