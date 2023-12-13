$(document).ready(function () {
    $(".sidebar").hover(
        function () {
            $(this).removeClass("close");
            $("#main-content").css("margin-left", "250px");
        },
        function () {
            $(this).addClass("close");
            $("#main-content").css("margin-left", "0");
        }
    );
});
