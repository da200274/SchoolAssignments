$(document).ready(function(){
    let prompt = localStorage.getItem('pretraga');
    let tip = localStorage.getItem('tip');
    let umetnine = JSON.parse(localStorage.getItem(tip));
    let put = JSON.parse(localStorage.getItem('putanja'));

    function inicijalizuj() {
        $("#naslov").text("Rezultati pretrage za: " + prompt);
        $("#brdcrm").append($("<a>"+put.tekst+"</a>").attr('href', put.put));

        for (let i = 0; i < umetnine.length; i++) {
            if (umetnine[i].naziv == prompt || umetnine[i].autor == prompt) {
                let elem = $("<div/>", {'class': 'col-lg-4 col-md-6 text-center'}).append($("<div/>", {'class': 'blog-post'}).css({'width': '350px', 'height': '200px'}).
                append($("<div/>", {'class': 'blog-image'}).append($("<img>", {'src': umetnine[i].putanja}))).
                append($("<div/>", {'class': 'blog-content'}).append($("<h2>"+umetnine[i].naziv+"</h2>")).append($("<p>Blog post content goes here...</p>")).
                append($("<button>Više</button>").attr('class', 'btn btn-outline-info vise').attr('id', i))));
                $("#galerija").append(elem);
            }
        }
    };

    inicijalizuj();

    $(".btn.btn-outline-info.vise").click(function() {
        localStorage.setItem('umetnina', JSON.stringify(umetnine[Number($(this).attr('id'))]));
        localStorage.setItem('putanja', 'slike');
        window.location.href = "umetnina.html";
    });

})