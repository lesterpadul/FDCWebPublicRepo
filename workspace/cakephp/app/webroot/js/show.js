$(document).ready(function() {
    $("#sbtnrms").hide();
    $("#sparoh").hide();
    $("#sbtnrl").hide();
    $("#sbtnrm").click(function() {
        $("#spar").append("Artificial Intelligence (AI) has been making waves across various industries, and the realm of is no exception. With AI technology becoming more sophisticated, it's now capable of creating stunning artworks that rival those produced by human artists. However, this AI art revolution has sparked a debate within the creative community: is AI empowering or endangering the creative industries?<br> Artificial Intelligence (AI) has been making waves across various industries, and the realm of is no exception. With AI technology becoming more sophisticated, it's now capable of creating stunning artworks that rival those produced by human artists. However, this AI art revolution has sparked a debate within the creative community: is AI empowering or endangering the creative industries?<br>Artificial Intelligence (AI) has been making waves across various industries, and the realm of is no exception. With AI technology becoming more sophisticated, it's now capable of creating stunning artworks that rival those produced by human artists. However, this AI art revolution has sparked a debate within the creative community: is AI empowering or endangering the creative industries?");
        var result = $("#spar").text().length + $("#sparo").text().length;
        if (result > $("#spar").text().length) {
            $("#sbtnrm").hide();
            $("#sbtnrl").show();
            $("#sbtnrl").off("click").on("click", function() {
                $("#spar").toggle();
                $("#sbtnrl").hide();
                $("#sbtnrms").show();
            });
            $("#sbtnrms").off("click").on("click", function() {
                $("#spar").toggle();
                $("#sbtnrms").hide();
                $("#sbtnrl").show();
            });
        }
    });
});
$(document).ready(function() {
    $("#sbtnrms1").hide();
    $("#sparoh1").hide();
    $("#sbtnrl1").hide();
    $("#sbtnrm1").click(function() {
        $("#spar1").append("Exploring the World of AI ArtIn recent years, Artificial Intelligence (AI) has been revolutionizing the world of art, offering new possibilities for creativity, expression, and innovation. But what exactly is AI art, and how is it changing the way we think about artistic creation?At its core, AI art refers to artworks created with the assistance of artificial intelligence technology<br>Exploring the World of AI ArtIn recent years, Artificial Intelligence (AI) has been revolutionizing the world of art, offering new possibilities for creativity, expression, and innovation. But what exactly is AI art, and how is it changing the way we think about artistic creation?At its core, AI art refers to artworks created with the assistance of artificial intelligence technology<br>Exploring the World of AI ArtIn recent years, Artificial Intelligence (AI) has been revolutionizing the world of art, offering new possibilities for creativity, expression, and innovation. But what exactly is AI art, and how is it changing the way we think about artistic creation?At its core, AI art refers to artworks created with the assistance of artificial intelligence technology<br>Exploring the World of AI ArtIn recent years, Artificial Intelligence (AI) has been revolutionizing the world of art, offering new possibilities for creativity, expression, and innovation. But what exactly is AI art, and how is it changing the way we think about artistic creation?At its core, AI art refers to artworks created with the assistance of artificial intelligence technology<br>");
        var result = $("#spar1").text().length + $("#sparo1").text().length;
        if (result > $("#spar1").text().length) {
            $("#sbtnrm1").hide();
            $("#sbtnrl1").show();
            $("#sbtnrl1").off("click").on("click", function() {
                $("#spar1").toggle();
                $("#sbtnrl1").hide();
                $("#sbtnrms1").show();
            });
            $("#sbtnrms1").off("click").on("click", function() {
                $("#spar1").toggle();
                $("#sbtnrms1").hide();
                $("#sbtnrl1").show();
            });
        }
    });
});