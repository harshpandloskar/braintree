

/**
 * It has all css related to Home JS.
 */


var aflairtoremember = "https://i.stack.imgur.com/nL4eF.jpg",
aseriesoffortunateevents = "https://i.stack.imgur.com/LpR7G.png",
effortlessevents = "https://i.stack.imgur.com/0HLQ5.jpg",
belleoftheball = "https://i.stack.imgur.com/0HLQ5.jpg",
pictureperfect = "https://i.stack.imgur.com/Lu71A.jpg",
ceremonyevents = "https://i.stack.imgur.com/IkN4h.jpg",
corporateaffairs = "https://i.stack.imgur.com/zsj32.jpg",
corroboree = "https://i.stack.imgur.com/ASjoU.jpg",
dreamwedding = "https://i.stack.imgur.com/i1SJ7.jpg",
celebrations = "https://i.stack.imgur.com/pnS9E.jpg";

htmlCards = [];

$(function() {

    /**
     * ----------------------------------------------
     */
        
        /**
         * If data is not stored then call ajax function.
         */
        if(localStorage.getItem('moviesData') === null) {

            $.ajax({
                async: false,
                url: 'https://api.myjson.com/bins/1ckxm4',
                type: 'GET',
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                beforeSend: function(){
                    $(".loader").show();
                },
                complete : function() {
                    $(".loader").hide();
                    $(".movies-data").show();
                },
                success: function(response) {
                    console.log(response)
                    
                    var limit=10
                    var resp = response.slice(0, limit);
                    /**
                     * Storing this object in local storage on browser.
                     */
                    localStorage.setItem('moviesData', JSON.stringify(resp));
                    /**
                     * ---------------------------------------------------------
                     */
                }
            });
        }else{

            $(".loader").hide();
            $(".movies-data").show();
        }

        /**
         * Getting the data from the local storage in browser.
        */
        var data = JSON.parse(localStorage.getItem('moviesData'));
    

        for(var i=0; i<data.length; i++) {

            htmlCards.push("<div class='col-sm-4'><img class='movie-selection event-poster' onclick='window.location=\"synopsis.php?movie="+encodeURIComponent(data[i].title)+"\"' src="+eval(data[i].title.replace(/\s+/g, '').replace(':', '').toLowerCase())+" class='img-responsive' style='width:100%'><p class='movie-selection' >"+data[i].title+"</p></div>");
        }

        for (var i = 0; i < htmlCards.length; i++) {
            var appendDiv = $(htmlCards[i]);
            if (i % 3 === 0) {
            appendDiv = $('<div class="row row' + (i /3) + '">').append(appendDiv);
            $('#movie-listing-main').append(appendDiv);
            } else {
            console.log(Math.floor(i/3));
            $('#movie-listing-main').find('.row' + Math.floor(i/3)).append(appendDiv);
            }

        }
})

function redirect(link) {
    document.location = link;
}
