$(document).ready(function () {

    // ------------------------------------------------------- //
    // Custom Scrollbar
    // ------------------------------------------------------ //

    if ($(window).outerWidth() > 992) {
        $("nav.side-navbar").mCustomScrollbar({
            scrollInertia: 200
        });
    }

    // Main Template Color
    var brandPrimary = '#33b35a';

    // ------------------------------------------------------- //
    // Side Navbar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {

        e.preventDefault();

        if ($(window).outerWidth() > 1194) {
            $('nav.side-navbar').toggleClass('shrink');
            $('.page').toggleClass('active');
        } else {
            $('nav.side-navbar').toggleClass('show-sm');
            $('.page').toggleClass('active-sm');
        }
        $("#side-main-menu li").find('a').css("display","block");
        $(".side-navbar a.brand-small strong").css({"font-size":"10px","display":"block","word-break":"break-word"});
    });

    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //

    $('[data-toggle="tooltip"]').tooltip()

    // ------------------------------------------------------- //
    // Universal Form Validation
    // ------------------------------------------------------ //

    $('.form-validate').each(function () {
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function () {
        return $(this).val() !== "";
    }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Jquery Progress Circle
    // ------------------------------------------------------ //
    // var progress_circle = $("#progress-circle").gmpc({
    //     color: brandPrimary,
    //     line_width: 5,
    //     percent: 80
    // });
    // progress_circle.gmpc('animate', 80, 3000);

    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });

    // ------------------------------------------------------ //
    // For demo purposes, can be deleted
    // ------------------------------------------------------ //

    var stylesheet = $('link#theme-stylesheet');
    $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
    var alternateColour = $('link#new-stylesheet');
    //
    // if ($.cookie("theme_csspath")) {
    //     alternateColour.attr("href", $.cookie("theme_csspath"));
    // }
    //
    // $("#colour").change(function () {
    //
    //     if ($(this).val() !== '') {
    //
    //         var theme_csspath = 'css/style.' + $(this).val() + '.css';
    //
    //         alternateColour.attr("href", theme_csspath);
    //
    //         $.cookie("theme_csspath", theme_csspath, {
    //             expires: 365,
    //             path: document.URL.substr(0, document.URL.lastIndexOf('/'))
    //         });
    //
    //     }
    //
    //     return false;
    // });

});

// ===========Featured Owl Carousel============
var objowlcarousel = $(".owl-carousel-slider");
if (objowlcarousel.length > 0) {
    objowlcarousel.owlCarousel({
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            768: {
                items: 2,
            },
        },
        // lazyLoad: true,
        pagination: false,
        loop: true,
        dots: false,
        autoPlay: false,
        navigation: true,
        stopOnHover: true,
        nav: true,
        items: 2,
        margin: 10,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });
}

// ===========ACTIVE Menu============

jQuery(function ($) {
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $('#side-main-menu li a').each(function () {
        if (this.href === path) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
});

// ===========show vital============

$('.rep-vital').on('click', function () {
    $('.vitals-row2').css("display", "block");
});


// ===========add more divs============
$(document).ready(function () {
    var wrapper = $(".total-chq-c"); //Fields wrapper
    var new_input = $(".total-chq-c").html();
    // var add_button = $(".add_field_button");
    // $(add_button).click(function (e) { //on add input button click
    //     $(wrapper).append(new_input); //add input box
    // });
    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
    })


    // var wrapper_ipsh = $(".total-chq-c-ipsh"); //Fields wrapper
    // var new_input_ipsh = $(".total-chq-c-ipsh").html();
    // var add_button_ipsh = $(".add_field_button_ipsh");
    // $(add_button_ipsh).click(function (e) { //on add input button click
    //     $(wrapper_ipsh).append(new_input_ipsh); //add input box
    // });
    // $(wrapper_ipsh).on("click", ".remove_field", function (e) { //user click on remove text
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').remove();
    // })


    // var wrapper_fmhx = $(".total-chq-c-fmhx"); //Fields wrapper
    // var new_input_fmhx = $(".total-chq-c-fmhx").html();
    // var add_button_fmhx = $(".add_field_button_fmhx");
    // $(add_button_fmhx).click(function (e) { //on add input button click
    //     $(wrapper_fmhx).append(new_input_fmhx); //add input box
    // });
    // $(wrapper_fmhx).on("click", ".remove_field", function (e) { //user click on remove text
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').remove();
    // })

    // var wrapper_pe = $(".total-chq-c-pe"); //Fields wrapper
    // var new_input_pe = $(".total-chq-c-pe").html();
    // var add_button_pe = $(".add_field_button_pe");
    // $(add_button_pe).click(function (e) { //on add input button click
    //     $(wrapper_pe).append(new_input_pe); //add input box
    //     // $('.physical_exams').select2();
    //     $('.physical_exams').selectpicker('refresh');
    //
    //
    // });
    // $(wrapper_pe).on("click", ".remove_field", function (e) { //user click on remove text
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').remove();
    // })
    //
    // var wrapper_adr = $(".total-chq-c-adr"); //Fields wrapper
    // var new_input_adr = $(".total-chq-c-adr").html();
    // var add_button_adr = $(".add_field_button_adr");
    // $(add_button_adr).click(function (e) { //on add input button click
    //     $(wrapper_adr).append(new_input_adr); //add input box
    // });
    // $(wrapper_adr).on("click", ".remove_field", function (e) { //user click on remove text
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').remove();
    // })

    // var wrapper_rx = $(".total-chq-c-rx"); //Fields wrapper
    // var new_input_rx = $(".total-chq-c-rx").html();
    // var add_button_rx = $(".add_field_button_rx");
    // $(add_button_rx).click(function (e) { //on add input button click
    //     $(wrapper_rx).append(new_input_rx); //add input box
    // });
    // $(wrapper_rx).on("click", ".remove_field", function (e) { //user click on remove text
    //     e.preventDefault();
    //     $(this).parent('div').parent('div').remove();
    // })
});


// ===========smoking history============

$('.first-level-smoke').on('click', function () {
    $('.even-smoke').toggle();
});

$('.show-still-smoke').on('click', function () {
    $('.still-smoke').show();
});

$('.remove-still-smoke').on('click', function () {
    $('.still-smoke').hide();
});

$('.show-ever-drink').on('click', function () {
    $('.ever-drink').toggle();
});

$('.show-ever-drugs').on('click', function () {
    $('.ever-drugs').toggle();
});


//===========disable right click on model============
