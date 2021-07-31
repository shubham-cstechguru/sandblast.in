const baseurl = $('#base_url').val();
$(document).ready(function () {
    // Ajax Request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.lazy').Lazy();

    $(document).on('click', '.nav-icon', function (e) {
        e.preventDefault();
        $(this).find('i').toggleClass('icon-navicon').toggleClass('icon-close1');
        $('.main-navbar').toggleClass('active');
    });

    $(document).on('click', '.product-qty .plus', function (e) {
        e.preventDefault();

        var parent = $(this).closest('.product-qty'),
            qty = parent.find('.qty-input input').val();

        parent.find('.qty-input input').val(parseInt(qty) + 1);
    });

    $(document).on('click', '.product-qty .minus', function (e) {
        e.preventDefault();

        var parent = $(this).closest('.product-qty'),
            minqty = parent.find('.qty-input input').attr('min'),
            qty = parent.find('.qty-input input').val();

        var newqty = qty > minqty ? parseInt(qty) - 1 : minqty;

        parent.find('.qty-input input').val(parseInt(newqty));
    });

    $(document).on('click', '.enquiry_btn', function (e) {
        e.preventDefault();

        var form = $('#orderForm'),
            pid = $(this).data('pid'),
            qty = $(this).closest('.product-block').find('.product-qty input').val();


        $('#orderProductId').val(pid);
        $('#orderQty').val(qty);

        $('#enquiryModal').modal('show');
    });

    $(document).on('click', '.main-navbar>li>span', function () {
        $(this).closest('li').find('ul').slideToggle();
    });

    $(document).on('submit', '#orderForm', function (e) {
        e.preventDefault();

        is_valid = $(this).is_valid();
        if (is_valid) {
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    $('#enquiryModal').modal('hide');
                    swal({
                        title: "Done!",
                        text: res.message,
                        icon: "success",
                        timer: 2000
                    });
                }
            });

        }
    });

    $(".search-form").on('keyup change', function (e) {
        e.preventDefault();
        
        var url = $('#baseUrl').data('url');
        var search = $('.searchinput').val();
    
        $.ajax({
          url: url,
          type: "POST",
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data: {
            search: search,
          },
          success: function (response) {
            $("#searchlist").html('');
            $("#serachresult").html(response);
          },
        });
      });

    $('.refresh-captcha').on('click', function () {
        $('.captcha-image').attr('src', baseurl + '/captcha-code/?' + Date.now());
    });

    $('.nav-icon').on('click', function () {
        $('body').toggleClass('open_nav');
    });

    // Upload Image
    $(".file-upload input[type=file]").change(function () {
        var target = $(this).closest(".file-upload").find("img");
        readURL(this, target);
    });

    $("a.lightbox").fancybox({
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 600,
        'speedOut': 200,
        'overlayShow': false
    });

    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 300) {
    //         $('#return').fadeIn();
    //     } else {
    //         $('#return').fadeOut();
    //     }
    // });

    $('#owl-carousel-cat').owlCarousel({
        margin: 20,
        responsive: {
            0: {
                items: 1,
                loop: true,
                dots: true
            },
            600: {
                items: 2
            },
            1000: {
                items: 4,
                nav: false,
                dots: true
            }
        }
    });

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 2,
                dots: true,
            },
            600: {
                items: 3
            },
            1000: {
                nav: true,
                dots: false,
                items: 4
            }
        }
    });



    // $('#return').click(function () {
    //     $("html, body").animate({
    //         scrollTop: 0
    //     }, 600);
    //     return false;
    // });

});

$(window).on('load', function () {
    $('.lazy-load').each(function (event) {
        let self = $(this);
        self.attr('src', self.data('src')).removeAttr('data-src');

        self.on('load', function () {
            $(this).removeClass('lazy-load');
        });
    });
});

function readURL(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}
