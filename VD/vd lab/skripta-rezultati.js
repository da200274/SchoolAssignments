$(document).ready(function(){
    let niz_korisnika = [];
    let kor = localStorage.getItem("korisnik");
    let res = localStorage.getItem("result");
    inicijalizacija();

    function inicijalizacija(){
        let temp_niz = localStorage.getItem("korisnici");
        
        if(kor != ""){
            let refreshed = localStorage.getItem("refresh");
            refreshed = parseInt(refreshed);
            if(refreshed == 1){
                refreshed = 0;
                localStorage.setItem("refresh", 0);
                if(temp_niz == null){
                    niz_korisnika.push({
                        "korime" : kor,
                        "result" : res
                    });
                }
                else{
                    niz_korisnika = JSON.parse(temp_niz);

                    niz_korisnika.push({
                        "korime" : kor,
                        "result" : res
                    });
                    sortiraj();
                }
            }
            $("#poruka").text(kor + " je izgubio/la sa " + res + " poena");

        }else{
            niz_korisnika = JSON.parse(temp_niz);
            $("#poruka").text("Rezultati: ");
        }
        prikazi();

    }

    function sortiraj() {
        for(let i = 0; i < niz_korisnika.length - 1; i++) {
            for(let j = i; j < niz_korisnika.length; j++) {
                if (parseInt(niz_korisnika[j].result) > parseInt(niz_korisnika[i].result)) {
                    let tmp = niz_korisnika[j];
                    niz_korisnika[j] = niz_korisnika[i];
                    niz_korisnika[i] = tmp;
                }
            }
        }
    }

    function prikazi_korisnika(korisnik, k){
        if(korisnik == kor){   
            $("#" + k + "0").text(korisnik).css("font-weight", "bold");
        }
        else{
            $("#" + k + "0").text(korisnik);
        }
    }

    function prikazi_rezultat(rezultat, q){
        $("#" + q + "1").text(rezultat);
    }

    function ostavi_najbolje(count){
        niz_korisnika.splice(5, count);
    }

    function prikazi(){
        if(niz_korisnika == []) return;
        if(niz_korisnika.length > 5){
            ostavi_najbolje(niz_korisnika.length - 5);
        }

        localStorage.setItem("korisnici", JSON.stringify(niz_korisnika));
        for(let i = 0; i < niz_korisnika.length; i++){
            prikazi_korisnika(niz_korisnika[i].korime, i);
            prikazi_rezultat(niz_korisnika[i].result, i);
        }
        for(let i = niz_korisnika.length; i < 6; i++){   
            $("#" + i).hide();
        }
    }

});