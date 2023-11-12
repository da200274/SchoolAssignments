$(document).ready(function(){
    
    let n = null;
    let tezina = null;
    let zmijica = null;
    let polja = [];
    let indeksi_polja = [];
    let vreme = null;
    let hrana = null;
    let int_superhrana = null;
    let start = false;
    let int_hrana = null;
    let superhrana = null;
    let int_timeout = null;

    inicijalizuj();

    function postavi_hranu(){
        while(true){
            hrana = Math.floor(Math.random() * n * n);
            if(!indeksi_polja.includes(hrana)) {
                $("#" + hrana).css("background-color", "red");
                break;
            };
        }
    }

    function generisi_superhranu(){
        while(true){
            superhrana = Math.floor(Math.random() * n * n);
            if(!indeksi_polja.includes(superhrana) && superhrana != hrana) {
                $("#" + superhrana).css("background-color", "#DAA520");
                break;
            };
        }
    }

    function postavi_vreme(){
        if(tezina == 1){
            vreme = 250;
        }else if(tezina == 2){
            vreme = 150;
        }else{
            vreme = 60;
        }
    }

    function parsiraj_parametre(){
        let parametri = localStorage.getItem("parametri");
        parametri = JSON.parse(parametri);
        n = parametri.vel;
        n = parseInt(n);

        tezina = parametri.tez;
        tezina = parseInt(tezina);
    }

    function inicijalizuj(){

        parsiraj_parametre();

        let width = Math.floor(100/n);
        width = "" + width + "%";
        let height = Math.floor(100/n);
        height = "" + height + "%";
    
        for(let i = 0; i < n ; i++){
            let red = $("<tr></tr>");
            for(let j = 0; j < n; j++){
                let celija = $("<td></td>");
                celija.addClass("polje").attr("id", i * n + j);
                if((i * n + j) % 2){
                    celija.css({
                        "background-color" : "#7B91C3",
                        "width" : width,
                        "height" : height
                    });
                }else{
                    celija.css({
                        "background-color" : "#50218D",
                        "width" : width,
                        "height" : height
                    });
                }
                red.append(celija);
            }
            $("#tabela").append(red);
        }
        zmijica = Math.floor(Math.random() * n * n);
        $("#" + zmijica).css("background-color", "#CCFFE5");
        
        for(let i = 0; i < n * n; i++){
            polja[i] = 0;
        }
        polja[zmijica]++;
        indeksi_polja.push(zmijica);
    
        postavi_vreme();
        
        postavi_hranu();
        
    }

    function vrati_i(i){
        return Math.floor(i/n);
    }

    function vrati_j(j){
        return j % n;
    }

    function obrisi_element(vrednost){
        if(vrednost == null) return;
        let index = indeksi_polja.indexOf(vrednost);
        if (index !== -1) {
            indeksi_polja.splice(index, 1);
        }
    }

    function printuj_matrix(){
        let tekst = [];
        for(let i = 0; i < n; i++){
            for(let j = 0; j < n; j++){
                tekst.push(polja[i * n + j]);
            }
            tekst.push("\n");
        }
        console.log(tekst.join(", "));
    }

    function printuj_niz(){
        let tekst = [];
        for(let j = 0; j < indeksi_polja.length; j++){
            tekst.push(indeksi_polja[j]);
        }
        console.log(tekst.join(", "));
    }

    function animacija(){
        let togg = 0;
        clearInterval(int_hrana);
        clearInterval(int_superhrana);
        clearInterval(int_timeout);
        let interval = setInterval(function(){
            $("#tabela").toggle();
            if(++togg >= 4){
                clearInterval(interval);
                localStorage.setItem("result", result);
                localStorage.setItem("refresh", 1);
                window.location.href = "zmijica-rezultati.html";
            }
        }, 1000);
    }

    function pomeri_zmiju(i, j){
        let zmija_i = vrati_i(zmijica);
        let zmija_j = vrati_j(zmijica);

        zmija_i += i;
        zmija_j += j;

        if(zmija_i < 0 || zmija_i >= n || zmija_j < 0 || zmija_j >= n){
            animacija();
        }

        let hrana_i = vrati_i(hrana);
        let hrana_j = vrati_j(hrana);


        let obrisi = null;

        for(let k = 0; k < indeksi_polja.length; k++){
            polja[indeksi_polja[k]]--;
            if(polja[indeksi_polja[k]] == 0){
                obrisi = indeksi_polja[k];
            }
        }
        
        obrisi_element(obrisi);
        if(obrisi % 2){   
            $("#" + obrisi).css("background-color", "#7B91C3");
        }
        else{
            $("#" + obrisi).css("background-color", "#50218D");
        }

        //zmijica je novo polje na koje se skace
        zmijica = zmija_i * n + zmija_j;
        if(indeksi_polja.includes(zmijica)){
            //zmija je udarila u sebe
            animacija();

        }else{  
            indeksi_polja.push(zmijica);
        }
        polja[zmijica] = indeksi_polja.length;
        

        for(let k = 0; k < indeksi_polja.length; k++){
            $("#" + indeksi_polja[k]).css("background-color", "#CCFFE5");
        }
        

        if(hrana_i == zmija_i && hrana_j == zmija_j){
            //stao je na polje sa hranom
            for(let k = 0; k < indeksi_polja.length; k++){
                polja[indeksi_polja[k]]++;
            }
            result++;
            $("#result").text("Rezultat je: " + result).css("color", "#04AA6D");
            postavi_hranu();
        }

        if(superhrana != null){

            let superhrana_i = vrati_i(superhrana);
            let superhrana_j = vrati_j(superhrana);
    
            if(superhrana_i == zmija_i && superhrana_j == zmija_j){
                //stao je na polje sa superhranom
                result+=10;
                $("#result").text("Rezultat je: " + result);
                superhrana = null;
            }
        }
        
    }

    let ii = 0;
    let jj = 0;

    function dohvati_ii(){
        return ii;
    }

    function dohvati_jj(){
        return jj;
    }

    let result = 0;

    $(document).keydown(function(event) {
        

        if (event.which === 37) {
          // Left arrow key
          // Handle left arrow key press
          jj=-1;
          ii=0;
        } else if (event.which === 39) {
          // Right arrow key
          // Handle right arrow key press
          jj=1;
          ii=0;
        } else if (event.which === 38) {
          // Up arrow key
          // Handle up arrow key press
          ii=-1;
          jj=0;
        } else if (event.which === 40) {
          // Down arrow key
          // Handle down arrow key press
          ii=1;
          jj=0;
        }
        
        if(!start){
            int_hrana = setInterval(function(){
                start = true;
                pomeri_zmiju(dohvati_ii(), dohvati_jj());
            }, vreme)
            int_superhrana = setInterval(function(){
                generisi_superhranu();
            }, 10001);
            int_timeout = setInterval(function(){
                console.log(superhrana);
                if(superhrana != null){
                    if(superhrana % 2){   
                        $("#" + superhrana).css("background-color", "#7B91C3");
                    }
                    else{
                        $("#" + superhrana).css("background-color", "#50218D");
                    }
                    superhrana = null;
                }
            }, 5000);
        }else{

        }

      });

    
});