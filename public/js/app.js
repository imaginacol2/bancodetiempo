$( document ).ready(function() {

    function showLoading(){
        $("#loadingcontent").show();
    }

    function hideLoading(){
        $("#loadingcontent").hide();
    }

    $(".collageHome").height($(document).height()-70);

    $(".mainactivityimage img").css('margin-top',(-$(".mainactivityimage img").height()/2));

    function calculateMainHeights(){
        $(".collageHome .form").css("margin-top",function(){
            return (-$(this).height()/2);
        });
    }

    $( "body" ).on( "click", "#createactivity", function() {
        showLoading();
        $('#myModal .modal-content').load('http://bdt.ingenio.com.co/createactivity/', function( response, status, xhr ) {
            $('#myModal').modal();
            hideLoading();
        })
    });

    $( "body" ).on( "click", ".assist", function() {
        showLoading();
        $('#myModal .modal-content').load('http://bdt.ingenio.com.co/assist/'+$(this).attr("assistID"), function( response, status, xhr ) {
            $('#myModal').modal();
            hideLoading();
        })
    });


    $( "body" ).on( "click", ".recoverpass", function() {
        showLoading();
        $('#myModal .modal-content').load('http://bdt.ingenio.com.co/password/reset/', function( response, status, xhr ) {
            $('#myModal').modal();
            hideLoading();
        })
    });

    $( "body" ).on( "click", "#callregister", function() {
        showLoading();
        $('#myModal .modal-content').load('http://bdt.ingenio.com.co/register/', function( response, status, xhr ) {
            $('#myModal').modal();
            hideLoading();
        })
    });

    $( ".collageHome" ).on( "click", "#findactivity", function() {
        $('html, body').animate({
            scrollTop: $("#activitycontainer").offset().top
        }, 500);
    });


    calculateMainHeights();
});