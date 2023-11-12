$(document).ready(function(){
    let ponude;

    function inicijalizuj() {
        if (localStorage.getItem('slike') == null) {
            let slike = [
                {putanja: "assets/slike/zena.jpg", naziv: "Žena koja plače", autor: "Pablo Pikaso", cena: "20000", starost: "2", about: "neki tekst", naslovna: "assets/slike/zena/slika0.jpg.webp", galerija: ["assets/slike/zena/slika1.jpg"], video: ""},
                {putanja: "assets/slike/tahicanke.jpg", naziv: "Tahićanke na plaži", autor: "Pol Gogen", cena: "15000", starost: "3", about: "neki  tekst", naslovna: "assets/slike/tahicanke/slika0.jpg", galerija: ["assets/slike/tahicanke/slika1.jpg"], video: ""},
                {putanja: "assets/slike/terasa.jpeg", naziv: "Terasa u Sent Andresu", autor: "Klod Mone", cena: "45000", starost: "12", about: "neki  tekst", naslovna: "assets/slike/terasa/slika0.jpeg", galerija: ["assets/slike/terasa/slika1.jpg"], video: ""},
                {putanja: "assets/slike/gotika.jpg", naziv: "Američka gotika", autor: "Grant Vud", cena: "200000", starost: "7", about: "neki  tekst", naslovna: "assets/slike/gotika/slika0.jpg", galerija: ["assets/slike/gotika/slika1.jpg"], video: ""},
                {putanja: "assets/slike/soba.jpg", naziv: "Plava soba", autor: "Pablo Pikaso", cena: "90000", starost: "4", about: "neki  tekst", naslovna: "assets/slike/soba/slika0.jpg", galerija: ["assets/slike/soba/slika1.jpg"], video: ""},
                {putanja: "assets/slike/poljubac.jpg", naziv: "Poljubac", autor: "Gustav Klimt", cena: "150000", starost: "6", about: "neki  tekst", naslovna: "assets/slike/poljubac/slika0.jpg", galerija: ["assets/slike/poljubac/slika1.jpg.webp", "assets/slike/poljubac/slika2.jpg"], video: ["https://www.youtube.com/watch?v=SNhmSdLDmto"]}
            
            ];
            localStorage.setItem('slike', JSON.stringify(slike));
        }

        if (localStorage.getItem('skulpture') == null) {
            let skulpture = [
                {putanja: "assets/skulpture/bacac.jpg", naziv: "Bacač diska", autor: "Miron", cena: "20000", starost: "2000", about: "neki  tekst", naslovna: "assets/skulpture/bacac/slika0.jpg", galerija: ["assets/skulpture/bacac/slika1.jpg", "assets/skulpture/bacac/slika2.jpg"], video: ["https://www.youtube.com/watch?v=1n7euia14NM"]},
                {putanja: "assets/skulpture/david.jpg", naziv: "David", autor: "Mikelanđelo", cena: "15000", starost: "200", about: "neki  tekst", naslovna: "assets/skulpture/david/slika0.jpeg", galerija: ["assets/skulpture/david/slika1.jpg", "assets/skulpture/david/slika2.jpg"] ,video: ""},
                {putanja: "assets/skulpture/venera.jpg.avif", naziv: "Miloska Venera", autor: "Aleksandros", cena: "45000", starost: "2100", about: "neki  tekst", naslovna: "assets/skulpture/venera/slika0.jpg", galerija: ["assets/skulpture/venera/slika1.jpg.webp", "assets/skulpture/venera/slika2.jpg"], video: ""},
                {putanja: "assets/skulpture/vilendorfska.jpg", naziv: "Vilendorfska Venera", autor: "nepoznat autor", cena: "150000", starost: "24000", about: "neki  tekst", naslovna: "assets/skulpture/vilendorfska/slika0.jpg", galerija: ["assets/skulpture/vilendorfska/slika1.jpg"], video: ""}
            ];
            localStorage.setItem('skulpture', JSON.stringify(skulpture));
        }

        if (localStorage.getItem('ostalo') == null) {
            let ostalo = [
                {putanja: "assets/ostalo/hamurabi.jpg", naziv: "Hamurabijev zakonik", autor: "Hamurabi", cena: "20000", starost: "2000", about: "neki  tekst", naslovna: "assets/ostalo/hamurabi/slika0.jpg", galerija: ["assets/ostalo/hamurabi/slika1.jpg"], video: ""},
                {putanja: "assets/ostalo/miroslav.jpg", naziv: "Miroslavljevo jevanđelje", autor: "nepoznat autor", cena: "15000", starost: "200", about: "neki  tekst", naslovna: "assets/ostalo/miroslav/slika0.jpg", galerija: ["assets/ostalo/miroslav/slika1.jpeg", "assets/ostalo/miroslav/slika2.jpg"], video: ""},
                {putanja: "assets/ostalo/tutankamon.jpg", naziv: "Tutankamonova maska", autor: "nepoznat autor", cena: "45000", starost: "2100", about: "neki  tekst",  naslovna: "assets/ostalo/tutankamon/slika0.jpg", galerija: ["assets/ostalo/tutankamon/slika1.jpg", "assets/ostalo/tutankamon/slika2.jpeg"], video: ["https://www.youtube.com/watch?v=bxN1hm1TmJ0"]},
                {putanja: "assets/ostalo/dusanov.jpg", naziv: "Dušanov zakonik", autor: "Stefan Uroš IV Dušan", cena: "25000", starost: "800", about: "neki  tekst",  naslovna: "assets/ostalo/dusan/slika0.jpg", galerija: ["assets/ostalo/dusan/slika1.jpg"], video: ""}
            ];
            localStorage.setItem('ostalo', JSON.stringify(ostalo));
        }

        if(localStorage.getItem('umetnici') == null){
            let umetnici = [
                {ime: "Pablo Picasso", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/pablo.jpg"},
                {ime: "Paul Gauguin", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/gogen.png"},
                {ime: "Claude Monet", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/mone.jpg"},
                {ime: "Grant Wood", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/wood.jpg"},
                {ime: "Gustav Klimt", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/klimt.jpg"},
                {ime: "Michelangelo", biografija: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat repellendus consectetur molestias et ad, voluptates nesciunt voluptatem ratione dolorum corporis ut labore nulla, vitae culpa adipisci exercitationem ipsa blanditiis temporibus?", slike:"assets/artists/michelangelo.jpg"}
            ];
            localStorage.setItem('umetnici', JSON.stringify(umetnici));
        }

        if(localStorage.getItem('korisnik') == null){
            let korisnik = {ime: "Andreja Đokić", email: "andrejadjokic79@gmail.com", zanimanje:"Student", telefon:"065/95-29-109"};
            localStorage.setItem('korisnik', JSON.stringify(korisnik));
        }

        if(localStorage.getItem('ponude') == null){
            ponude = [
                    {korisnik: "Andreja Đokić", iznos: "500000", komentar: "", umetnina: {putanja: "assets/skulpture/david.jpg", naziv: "David", autor: "Mikelanđelo", cena: "15000", starost: "200", about: "neki retardiran tekst", naslovna: "assets/skulpture/david/slika0.jpeg", galerija: ["assets/skulpture/david/slika1.jpg", "assets/skulpture/david/slika2.jpg"]}, id: "0"},
                    {korisnik: "Marta Anđić", iznos: "130000", komentar: "", umetnina: {putanja: "assets/slike/zena.jpg", naziv: "Žena koja plače", autor: "Pablo Pikaso", cena: "20000", starost: "2", about: "neki retardiran tekst", naslovna: "assets/slike/zena/slika0.jpg.webp", galerija: ["assets/slike/zena/slika1.jpg"]}, id: "1"},
                    {korisnik: "Andreja Đokić", iznos: "10000", komentar: "", umetnina: {putanja: "assets/slike/soba.jpg", naziv: "Plava soba", autor: "Pablo Pikaso", cena: "90000", starost: "4", about: "neki retardiran tekst", naslovna: "assets/slike/soba/slika0.jpg", galerija: ["assets/slike/soba/slika1.jpg"]}, id: "2"},
                    {korisnik: "Ana Gnezdić", iznos: "75000", komentar: "", umetnina: {putanja: "assets/ostalo/miroslav.jpg", naziv: "Miroslavljevo jevanđelje", autor: "nepoznat autor", cena: "15000", starost: "200", about: "neki retardiran tekst", naslovna: "assets/ostalo/miroslav/slika0.jpg", galerija: ["assets/ostalo/miroslav/slika1.jpeg", "assets/ostalo/miroslav/slika2.jpg"]}, id: "3"}
                ];
            localStorage.setItem('ponude', JSON.stringify(ponude));
        }
        else ponude = JSON.parse(localStorage.getItem('ponude'));

        let novo = ponude.slice(-3);
        for (let i = 0; i < 3; i++) {
            let red = $("<tr></tr>");
            red.append($("<td>"+novo[i].korisnik+"</td>")).
                append($("<td>"+novo[i].umetnina.naziv+"</td>")).
                append($("<td>"+novo[i].umetnina.autor+"</td>")).
                append($("<td>"+novo[i].iznos+"</td>"));
            $("#telo").append(red);
        }
    };

    inicijalizuj();

});