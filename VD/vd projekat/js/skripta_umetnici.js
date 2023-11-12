$(document).ready(function(){

    inicijalizuj();

    function inicijalizuj(){
        let umetnici = JSON.parse(localStorage.getItem('umetnici'));
        
        let container = document.getElementById("artists_container");

        let title = document.createElement("div");
        title.classList.add("col-sm-12");

        let title_header = document.createElement("h3");
        title_header.textContent = "Galerija umetnika";
        let title_hr = document.createElement("hr");
        title_hr.classList.add("w-25", "mx-auto", "bg-secondary");
        
        title.append(title_header, title_hr);

        container.append(title);

        for(let i = 0; i < umetnici.length; i++){
            //artist
            let artist_element = document.createElement("div");
            artist_element.classList.add("col-md-12", "text-center");

            //kartica za artista
            let artist_blog = document.createElement("div");
            artist_blog.classList.add("blog-post");

            let blog_image = document.createElement("div");
            blog_image.classList.add("blog-image");

            //slika artista
            let img = document.createElement("img");
            img.src = umetnici[i].slike;
            img.alt = "Slika" + i;
            blog_image.appendChild(img);

            let blog_content = document.createElement("div");
            blog_content.classList.add("blog-content");

            let header = document.createElement("h2");
            header.textContent = umetnici[i].ime;
            let paragraph = document.createElement("p");
            paragraph.textContent = umetnici[i].biografija;
            var link = document.createElement("a");
            link.id = "umetnik" + i;
            link.href = "#";
            link.textContent = "Pregled dela";
            link.classList.add("read-more");

            blog_content.append(header, paragraph, link);

            artist_blog.append(blog_image, blog_content);

            container.appendChild(artist_blog);
        }
    }

    $("#umetnik0").click(function(){
        let url = "assets/pdf/Pablo.pdf";
        window.open(url, "_blank");
    });

    $("#umetnik1").click(function(){
        let url = "assets/pdf/Paul.pdf";
        window.open(url, "_blank");
    });

    $("#umetnik2").click(function(){
        let url = "assets/pdf/Pablo.pdf";
        window.open(url, "_blank");
    });

    $("#umetnik3").click(function(){
        let url = "assets/pdf/Pablo.pdf";
        window.open(url, "_blank");
    });

    $("#umetnik4").click(function(){
        let url = "assets/pdf/Pablo.pdf";
        window.open(url, "_blank");
    });

    $("#umetnik5").click(function(){
        let url = "assets/pdf/Pablo.pdf";
        window.open(url, "_blank");
    });
});