$(document).ready(function(){
    let ponude = JSON.parse(localStorage.getItem('ponude'));

    inicijalizuj();

    function inicijalizuj(){
        let user = JSON.parse(localStorage.getItem('korisnik'));
        document.getElementById('briefcase').innerHTML = document.getElementById('briefcase').innerHTML + " " + user.zanimanje;
        document.getElementById('user').innerHTML = document.getElementById('user').innerHTML + " " + user.ime;
        document.getElementById('envelope').innerHTML = document.getElementById('envelope').innerHTML + " " + user.email;
        document.getElementById('phone').innerHTML = document.getElementById('phone').innerHTML + " " + user.telefon;

        for (let i = 0; i < ponude.length; i++) {
            if (ponude[i].korisnik != user.ime) continue;
            $("#prostor").append($("<div/>", {'class': 'row'}).append($("<div></div>").css('padding-left', '40px').append($("<h5>"+ ponude[i].umetnina.naziv + " ("+ponude[i].iznos+" EUR)</h5>")).
            append($("<h6>"+ponude[i].umetnina.autor+"</h6>")).append($("<p>"+ ponude[i].komentar+"</p>"))).append($("<div></div>").css('margin-left', '20px').
            append($("<button>Obriši</button>").attr('id', ponude[i].id).attr('class', 'obrisi')))).append($("<hr>"));
            
        }
    };


    $(".obrisi").click(function(){
        let ind = 0;

        for (ind; ind < ponude.length; ind++) {
            if (ponude[ind].id == $(this).attr('id')) break;
        }

        ponude.splice(ind, 1);
        localStorage.setItem('ponude', JSON.stringify(ponude));
        window.location.reload();
    })
});

