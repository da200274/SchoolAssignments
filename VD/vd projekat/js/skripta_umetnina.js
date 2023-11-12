$(document).ready(function() {
    let umetnina = JSON.parse(localStorage.getItem('umetnina'));
    let put = JSON.parse(localStorage.getItem('putanja'));
    let ponude;

    function inicijalizuj() {
      
        ponude = localStorage.getItem('ponude');
        if (!ponude) {
            ponude = [];
            localStorage.setItem('ponude', JSON.stringify(ponude));
        }
        else ponude = JSON.parse(ponude);

        $("#sadrzaj").append($("<div/>", {'class': 'col-md-6'}).append($("<img>", {'src': umetnina.putanja}).css({'max-width': '500px', 'max-height' : '600px', 'width':'auto', 'height' : 'auto'}).attr('class', 'd-block w-100')));
        
        let opis = $("<div/>", {'class':'col-md-3'}).append($("<div/>").append($("<h2>"+umetnina.naziv+"</h2>"))).
        append($("<div/>").append($("<h4>"+umetnina.autor+"</h4>"))).append($("<div/>").append($("<h5>"+umetnina.cena+" rsd </h5>"))).
        append($("<div/>").append($("<h5> procenjena starost: "+umetnina.starost+" god </h5>")).append($("<p> O umetniku: "+umetnina.about+"</p>")));

        $("#sadrzaj").append(opis).append($("<div/>", {'class':'col-md-3 baner'}));

        for (let i = 0; i < ponude.length; i++) {
            if (ponude[i].umetnina.naziv != umetnina.naziv) continue;
            $("#ponude").append($("<h5>"+ ponude[i].iznos + " EUR (" + ponude[i].korisnik + ")</h5>")).append($("<div>"+ ponude[i].komentar + "</div>"));
            $("#ponude").append($("<hr>", {'class':'mx-auto'}));
        }

        $("#brdcrm").append($("<a>"+put.tekst+"</a>").attr('href', put.put));
        $("#umet").append($("<a>"+umetnina.naziv+"</a>").attr('href', "umetnina.html"));

        $("#inner").append($("<div/>", {'class': 'carousel-item active'}).append($("<img>", {'src': umetnina.naslovna}).css({'max-width':'100%', 'max-height':'100%'}).attr('class', 'd-block w-100')));

        for (let i = 0; i < umetnina.galerija.length; i++) {
            $("#inner").append($("<div/>", {'class': 'carousel-item'}).append($("<img>", {'src': umetnina.galerija[i]}).css({'max-width':'100%', 'max-height':'100%'}).attr('class', 'd-block w-100')))
        }

        for (let i = 0; i < umetnina.video.length; i++) {
            $("#videi").append($("<li/>").append($("<a>"+umetnina.video[i]+"</a>").attr('href', umetnina.video[i])))
        }
    };


    inicijalizuj();

    $("#postavi").click(function(){
        let ponuda = {
            korisnik: $("#Name").val(),
            iznos: $("#Offer").val(),
            komentar: $("#Comment").val(),
            umetnina: umetnina,
            id: ponude.length
        };

        ponude.push(ponuda);
        localStorage.setItem('ponude', JSON.stringify(ponude));
        window.location.reload();
    })
})
