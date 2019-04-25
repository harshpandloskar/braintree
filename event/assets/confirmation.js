
/**
 * 
 *  This function splits the url parameter in URL for showing synopsis data.
 */
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}

/**
 * 
 * This function capitalize the first letter of any string. 
 */
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/**
 * Generating random seat number as I don't have seats api data since generating it randomly.
 */
function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}

/**
 * Appending all informations in HTML DOM.
 */
$(function(){
    // $("._movie-name").append(capitalizeFirstLetter(getURLParameter("movie")));
    // $("._time").append(getURLParameter("time"));
    // $("._day").append(capitalizeFirstLetter(getURLParameter("day")));
    // $("._bookingID").append(randomString(6, 'abcdefghijklmnopqrstuvwxyz').toUpperCase());

    _bookingID = randomString(6, 'abcdefghijklmnopqrstuvwxyz').toUpperCase();

    /**
     * For now, I have done hard coded. But remove it asap if we are showing
     * a popup modal for ticket quantity.
     */
    var _seatQuantity = 1;
    // var _seatQuantity = getURLParameter("seatQuantity");

    // for(var i=0; i<_seatQuantity; i++) {
    //     var generateSeat = randomString(1, 'abcdefghijklmnopqrstuvwxyz')+''+Math.floor(Math.random()*30);
    //     $("._seat").append(generateSeat.toUpperCase()+' | ');
    // }
})


