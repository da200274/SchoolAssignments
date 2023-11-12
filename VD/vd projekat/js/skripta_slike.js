$(document).ready(function() {
    let slike;

    function inicijalizuj() {
        localStorage.setItem('putanja', JSON.stringify({tekst: "Slike", put: "slike.html"}));
        slike = JSON.parse(localStorage.getItem('slike'));

        for (let i = 0; i < slike.length; i++) {
            let elem = $("<div/>", {'class': 'col-lg-4 col-md-6 text-center'}).append($("<div/>", {'class': 'blog-post'}).css({'width': '350px', 'height': '200px'}).
            append($("<div/>", {'class': 'blog-image'}).append($("<img>", {'src': slike[i].putanja}))).
            append($("<div/>", {'class': 'blog-content'}).append($("<h2>"+slike[i].naziv+"</h2>")).append($("<p>"+slike[i].autor+"</p>")).
            append($("<button>Više</button>").attr('class', 'btn btn-outline-info vise').attr('id', i))));
            $("#galerija").append(elem);
        }
    };

    function sort_naziv_asc(a, b) {
        return (a.naziv).localeCompare(b.naziv);
    };

    function sort_umetnik_asc(a, b) {
        return (a.autor).localeCompare(b.autor);
    };

    function naziv_rastuce() {
        slike.sort(sort_naziv_asc);
        localStorage.setItem('slike', JSON.stringify(slike));
        $("#galerija").empty();
    };


    function autor_rastuce() {
        slike.sort(sort_umetnik_asc);
        localStorage.setItem('slike', JSON.stringify(slike));
        $("#galerija").empty();
    };

    
    inicijalizuj();


    $(".btn.btn-outline-info.vise").click(function() {
        localStorage.setItem('umetnina', JSON.stringify(slike[Number($(this).attr('id'))]));
        window.location.href = "umetnina.html";
    });

    $("#srch").click(function(){
        let pretraga = $("#prompt").val();
        localStorage.setItem('pretraga', pretraga);
        localStorage.setItem('tip', 'slike');
        window.location.href = "pretraga.html";
    });

    $("#sort_naziv").click(function(){
        naziv_rastuce();
        window.location.reload();
    });

    $("#sort_umetnik").click(function(){
        autor_rastuce();
        window.location.reload();
    });
});
