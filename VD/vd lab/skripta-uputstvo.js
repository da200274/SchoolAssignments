$(document).ready(function(){
    let n = null;
    let tezina = null;

    function inicijalizuj(){
        document.getElementById("n-greska").innerHTML = "";
        document.getElementById("tezina-greska").innerHTML = "";
        document.getElementById("korime-greska").innerHTML = "";

        let temp_tezina = document.getElementsByName("radio_tezina");
        for(let i = 0; i < temp_tezina.length; i++){
            if(temp_tezina[i].checked){
                tezina = temp_tezina[i].value;
                tezina = parseInt(tezina);
                break;
            }
        }

        let temp_dimenzija = document.getElementsByName("radio_dimenzija");
        for(let i = 0; i < temp_dimenzija.length; i++){
            if(temp_dimenzija[i].checked){
                n = temp_dimenzija[i].value;
                n = parseInt(n);
                break;
            }
        }

        let temp_korime = document.getElementById("korime").value;

        if(tezina == null){
            document.getElementById("tezina-greska").innerHTML = "Morate izabrati tezinu igre!";
            return;
        }
        else if(n == null){
            document.getElementById("n-greska").innerHTML = "Morate izabrati velicinu!";
            return;
        }else if(temp_korime == ""){
            document.getElementById("korime-greska").innerHTML = "Morate uneti korisnicko ime!";
            return;
        }
        dodaj_parametre(n , tezina, temp_korime);
        window.location.href = "zmijica-igra.html";
    }

    function dodaj_parametre(n, t, kor){
        let parametri = {
            vel : n,
            tez : t
        }
        localStorage.setItem("parametri", JSON.stringify(parametri));
        localStorage.setItem("korisnik", kor);
    }

    function inicijalizuj2(){
        localStorage.setItem("korisnik", "");
        window.location.href = "zmijica-rezultati.html";
    }

    $("#pokreni").click(function(){
        inicijalizuj();
    });

    $("#prikazi").click(function(){
        inicijalizuj2();
    });
});