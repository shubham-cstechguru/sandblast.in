$(function() {
  var baseurl   = $("#base_url").val();
  var wbaseurl  = $("#wbase_url").val();
  $(".nav-item").on("click",function() {
    $(this).next(".inner-ul").slideToggle();
    $(".nav-item").not(this).next(".inner-ul").slideUp();
  });

  $("#nav").on("click",function() {
    $(this).next(".inner-ul").slideToggle();
  });

   function remove_gallery_img() {
    $(".file-upload .close[href='#close']").on("click", function(e) {
        e.preventDefault();

        var target = $(this).closest(".col-3");
        $(target).remove();
    });
  }

  $(document).on('click', '.add_price_btn', function(e) {
      var parent      = $(this).closest('.category'),
          price_qty   = parent.find('.price_qty').val(),
          unit        = parent.find('.price_unit').val(),
          org_price   = parent.find('.org_price').val(),
          sale_price  = parent.find('.sale_price').val();

      $('#loadingBox').show();
      $.ajax({
          url: $(this).data('url'),
          type: 'POST',
          data: {
              'unit'      : unit,
              'org_price' : org_price,
              'sale_price': sale_price,
              'price_qty' : price_qty
          },
          success: function(res) {
              $('#loadingBox').hide();

              $('#product_price').html( res.html );
          }
      });
  });

  $(document).on('click', 'a[href="#remove_image"]', function(e) {
      e.preventDefault();

      swal({
        title: "Are you sure?",
        text: "You will not able to recover this image.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((success) => {
          if (success) {
              window.location = $(this).data('url');
          } else {
              $(this).val('');
          }
      });
  });

  $(".file-upload .close[href='#close']").on("click", function(e) {
        e.preventDefault();

        var target = $(this).closest(".col-3");
        $(target).remove();
    });

    $(".galleryimages").on("click", function(e) {
        e.preventDefault();

        var html =  '<div class="col-3">';
            html+=      '<label class="file-upload form-group addgallary" style="padding: 0px; border: 1px solid #ccc;">';
            html+=          '<a href="#close" class="close" title="Remove"><i class="icon-cross"></i></a>';
            html+=          '<img  src="'+wbaseurl+'/imgs/no-image.png">';
            html+=          '<input type="file" name="gallery_images[]" accept="image/*" >';
            html+=      '</label>';
            html+=   '</div>';

        $("#gallery_images").append( html );

        $(".file-upload input[type=file]").change(function() {
            var target = $(this).closest(".file-upload").find("img");
            readURL(this, target);
        });
        remove_gallery_img();
    });

    $('.porder').on('change blur', function(e) {
        var form = $(this).closest('form');
        $.ajax({
            url: baseurl+'/ajax/change_order',
            type: 'POST',
            data: form.serialize(),
            success: function(res) {
                console.log('Order updated');
            }
        });
    });

    $(".mcategory").on('change', function() {
      var target = $(this).data('target');

      $(target).attr('disabled', 'disabled').html( $('<option />').val('').text('Loading') );

      $.ajax({
        url:  baseurl+'/ajax/get_subcategory',
        type: 'POST',
        data: {
          'id': $(this).val()
        },
        success: function(res) {
          $(target).removeAttr('disabled').html( $('<option />').val('').text('Select Subcategory') );

          $.each(res.categories, function(i, row) {
            $(target).append( $('<option />').val(row.category_id).text(row.category_name) );
          });
        }
      });
    });
});

$(function() {
  var baseurl   = $("#base_url").val();

  $(".file-upload input[type=file]").change(function() {
      var target = $(this).closest(".file-upload").find("img");
      readURL(this, target);
  });

    function readURL(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

  $(".inner-ul").hide();

  $(".navbar-item").on("click",function() {
  	$(this).children(".inner-ul").slideToggle();
    // $('.navbar-item').not(parent.children(".inner-ul")).slideUp();
  	$(this).children(".icon-keyboard_arrow_right , .icon-keyboard_arrow_down").toggleClass("icon-keyboard_arrow_right  icon-keyboard_arrow_down");
  });

  $(".icon-menu").on("click",function() {
  	$(".navigation , .hide-navigation").toggleClass("navigation hide-navigation");
  	$(".side-menu").toggleClass("mini-side-menu");
  	$(".top-bar ").toggleClass("top-bar-slide");
  	$(".inner-page").toggleClass("inner-page-slide");
  	$(".right-nav").toggleClass("right-nav-slide");
  	// $(".side-bar-logo").toggleClass("side-bar-logo-slide");
  	// $(".title , .title-hide").toggleClass("title title-hide");
  });

// $(".side-menu").hover(function() {
// 	$(".navigation , .hide-navigation").toggleClass("navigation hide-navigation");
// 	$(".side-menu").toggleClass("mini-side-menu");
// 	$(".title , .title-hide").toggleClass("title title-hide");
// 	$(".side-bar-logo").toggleClass("side-bar-logo-slide");
// 	$(".top-bar ").toggleClass("top-bar-slide");
// });

$(".user_name").on("click",function(){
	$(this).siblings("ul").toggleClass("inner-user-show");
	$(".user_name").not(this).siblings("ul").removeClass("inner-user-show");
	$(window).on("click").removeClass("inner-user-show");

});

$(".check_all").on("click", function() {
    var form = $(this).closest("form");

    form.find(".check:not([disabled])").prop( "checked", $(this).prop("checked") );
});

$(".check").on("click", function() {
    var form    = $(this).closest("form");
    var checked = form.find(".check:not([disabled])").length == form.find(".check:checked").length;

    form.find(".check_all").prop( "checked", checked );
});

    $('.order_status_change').on('change', function() {

        var form = $(this).closest("form");
        if(form.find(".check:checked").length > 0) {
            swal({
              title: "Are you sure?",
              text: "You're going to change order status.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((success) => {
                if (success) {
                    form.trigger('submit');
                } else {
                    $(this).val('');
                }
            });
        } else {
            swal("Warning", "Select at least one record to delete", "warning");
            $(this).val('');
        }
    });

    $(".icon-trash-o").on("click", function(e) {
            e.preventDefault();

            var form = $(this).closest("form");
            if(form.find(".check:checked").length > 0) {
                swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover record(s)!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    form.trigger("submit");
                  }
                });
            } else {
                swal("Warning", "Select at least one record to delete", "warning");
            }

        });

//  Add Products

    $("#original_price").on("input", function() {
      $originalprice = $(this).val();
      $discountprice = $("#discount").val();
      $sellprice = $("#sell_price").val(eval($originalprice - ($originalprice / 100 * $discountprice)));
      // alert();
    });

    $("#discount").on("input", function() {
      $originalprice = $("#original_price").val();
      $discountprice = $(this).val();
      $sellprice = $("#sell_price").val(eval($originalprice - ($originalprice / 100 * $discountprice)));
      // alert();
    });

    $("#sell_price").on("input", function() {
      $sellprice = $(this).val();
      $discountprice = $("#discount").val();
      $originalprice = $("#original_price").val(eval($sellprice / (1 - $discountprice / 100)));
      // alert();
    });

    $("#original_priced").on("input", function() {
      $originalprice = $(this).val();
      $discountprice = $("#discountd").val();
      $sellprice = $("#sell_priced").val(eval($originalprice - ($originalprice / 100 * $discountprice)));
      // alert();
    });

    $("#discountd").on("input", function() {
      $originalprice = $("#original_priced").val();
      $discountprice = $(this).val();
      $sellprice = $("#sell_priced").val(eval($originalprice - ($originalprice / 100 * $discountprice)));
      // alert();
    });

    $("#sell_priced").on("input", function() {
      $sellprice = $(this).val();
      $discountprice = $("#discountd").val();
      $originalprice = $("#original_priced").val(eval($sellprice / (1 - $discountprice / 100)));
      // alert();
    });

    // Measurement

function cal_cbm() {
    var w_cm = $(".cm_size.w").val(),
        d_cm = $(".cm_size.d").val(),
        h_cm = $(".cm_size.h").val(),
        cbm  = 0;

    cbm = (parseFloat(w_cm) * parseFloat(d_cm) * parseFloat(h_cm)) / 1000000;

    cbm = cbm.toFixed(6);

    $(".pro_cbm").val( cbm );

}



    // Add rows for spcification in add product
    function remove_product_row() {
    $(".closerow .close[href='#closerow']").on("click", function(e) {
        e.preventDefault();

        var target = $(this).closest(".mt-5");
        $(target).remove();
    });
}
    $(".addrow").on("click", function(e) {
        e.preventDefault();

        var html =  '<div class="closerow mt-5"><div class="form-group">';
            html+=          '<a href="#closerow" class="close" title="Remove"><i class="icon-cross"></i></a>';
            html+=      '<label style="font-weight: bold">Title</label>';
            html+=          '<input type="text" name="record[product_specification][title][]" class="form-control" placeholder="Title">';
            html+=          '</div>';
            html+=          '<div class="form-group">';
            html+=      '<label style="font-weight: bold">Description</label>';
            html+=   '<textarea rows="5" name="record[product_specification][description][]" placeholder="Description" class="form-control editor"></textarea>';
            html+=    '</div></div>';
        $("#rowadd").append( html );

        $(".file-upload input[type=file]").change(function() {
            var target = $(this).closest(".file-upload").find("img");
            readURL(this, target);

        });
        remove_product_row();

        tinymce.init({
          selector: '.editor',
          plugins: "code, link, image, textcolor, emoticons, hr, lists, stylebuttons, charmap, table, fullscreen",
          fontsizeselect: true,
          browser_spellcheck: true,
          menubar: 'view',
          toolbar: 'bold italic underline strikethrough | style-h1 style-h2 style-h3 style-h4 style-h5 style-h6 | table hr superscript subscript | alignleft aligncenter alignright alignjustify bullist numlist outdent indent code | fullscreen' ,
          // forced_root_block : 'div',
          branding: false,
          protect: [
              /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
              /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
              /\<script\:[^>]+\>/g,  // Protect <xsl:...>
              /<\?php.*?\?>/g  // Protect php code
          ],
          images_upload_credentials: true,
          file_browser_callback_types: 'image',
          image_dimensions: true,
          automatic_uploads: true,
          images_upload_url: baseurl+'/ajax/upload_image',
          relative_urls : false,
          remove_script_host : false,
          document_base_url: baseurl+'/assets/uploads/',
          images_reuse_filename: true,
          content_css:  baseurl+'/assets/tinymce/themes/advanced/fonts/stylesheet.css',
          font_format: "devlys 010normal=devlys 010normal",
          images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', baseurl+'/ajax/upload_image');

            xhr.onload = function() {
              var json;

              if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
              }

              json = JSON.parse(xhr.responseText);

              if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
              }

              success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }
        // sizeselect: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
      });
    });

     // Add rows for spcification in add product
    function remove_product_row() {
    $(".removetier .closet[href='#RemoveTier']").on("click", function(e) {
        e.preventDefault();

        var target = $(this).closest(".closetier");
        $(target).remove();
    });
}

     $("#AddTier").on("click", function(e) {
        e.preventDefault();
        var html =  '<div style="margin-left:0;" class="row removetier closetier">';
            html +=  '<div class="col-sm-3">';
            html +=  '<div class="form-group">';
            html +=  '<label>Original Price</label>';
            html +=  '<select class="form-control" name="record[product_tier][price][]">';
            html +=  '<option>Price / Vol.</option>';
            html +=  '<option>25 ft</option>';
            html +=  '<option>45 ft</option>';
            html +=  '<option>Wholesale</option>';
            html +=  '<option>Retailor</option>';
            html +=  '</select>';
            html +=  '</div>';
            html +=  '</div>';

            html +=  '<div class="col-sm-3">';
            html +=  '<div class="form-group">';
            html +=  '<label>MOQ</label>';
            html +=  '<input type="text" name="record[product_tier][moq][]" value=""class="form-control" placeholder="MOQ">';
            html +=  '</div>';
            html +=  '</div>';

            html +=  '<div class="col-sm-3">';
            html +=  '<div class="form-group">';
            html +=  '<label>Price / Pice</label>';
            html +=  '<input type="text" id="sell_price" value="" name="record[product_tier][price][]" class="form-control" placeholder="Price / Pice" required>';
            html +=  '</div></div>';

            html +=  '<div class="col-sm-3">';
            html +=  '<div class="form-group">';
            html +=  '<a href="#RemoveTier" style="color:#fff;" id="RemoveTier" style="margin-top: 32px;" class=" closet form-control btn btn-primary">';
            html +=  '<i class="icon-cross"></i> Remove';
            html +=  '</a>';
            html +=  '</div></div></div></div>';

        $("#addtier").append( html );
        remove_product_row();
    });


    remove_gallery_img();
    $(".inch_size").on("keyup", function() {
        var w_in = $(".inch_size.w").val(),
            d_in = $(".inch_size.d").val(),
            h_in = $(".inch_size.h").val(),
            w_cm = 0, d_cm = 0, h_cm = 0;

        if(w_in != 0) {
            w_cm = parseFloat(w_in) * 2.54;
        }

        if(d_in != 0) {
            d_cm = parseFloat(d_in) * 2.54;
        }

        if(h_in != 0) {
            h_cm = parseFloat(h_in) * 2.54;
        }

        w_cm = w_cm.toFixed(2);
        d_cm = d_cm.toFixed(2);
        h_cm = h_cm.toFixed(2);

        $(".cm_size.w").val(w_cm);
        $(".cm_size.d").val(d_cm);
        $(".cm_size.h").val(h_cm);

        cal_cbm();
    });


    $(".cm_size").on("keyup", function() {
        var w_cm = $(".cm_size.w").val(),
            d_cm = $(".cm_size.d").val(),
            h_cm = $(".cm_size.h").val(),
            w_in = 0, d_in = 0, h_in = 0;

        if(w_cm != 0) {
            w_in = parseFloat(w_cm) / 2.54;
        }

        if(d_cm != 0) {
            d_in = parseFloat(d_cm) / 2.54;
        }

        if(h_cm != 0) {
            h_in = parseFloat(h_cm) / 2.54;
        }

        w_in = w_in.toFixed(2);
        d_in = d_in.toFixed(2);
        h_in = h_in.toFixed(2);

        $(".inch_size.w").val(w_in);
        $(".inch_size.d").val(d_in);
        $(".inch_size.h").val(h_in);

        cal_cbm();
    });


    // Editor
    //////////// TinyMCE Editor
    tinyMCE.PluginManager.add('stylebuttons', function(editor, url) {
      ['div', 'pre', 'p', 'code', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(function(name){
        editor.addButton("style-" + name, {
            tooltip: "Toggle " + name,
              text: name.toUpperCase(),
              onClick: function() { editor.execCommand('mceToggleFormat', false, name); },
              onPostRender: function() {
                  var self = this, setup = function() {
                      editor.formatter.formatChanged(name, function(state) {
                          self.active(state);
                      });
                  };
                  editor.formatter ? setup() : editor.on('init', setup);
            }
        })
      });
    });
    tinymce.init({
        selector: '.editor',
        plugins: "code, link, image, textcolor, emoticons, hr, lists, stylebuttons, charmap, table, fullscreen, fullpage",
        fontsizeselect: true,
        browser_spellcheck: true,
        menubar: false,
        toolbar: 'bold italic underline strikethrough | style-h1 style-h2 style-h3 style-h4 style-h5 style-h6 | table hr superscript subscript | alignleft aligncenter alignright alignjustify bullist numlist outdent indent code fullscreen fullpage' ,
        // forced_root_block : 'div',
        branding: false,
        protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /\<script\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        images_upload_credentials: true,
        file_browser_callback_types: 'image',
        image_dimensions: true,
        automatic_uploads: true,
        images_upload_url: baseurl+'/ajax/upload_image',
        relative_urls : false,
        remove_script_host : false,
        document_base_url: baseurl+'/assets/uploads/',
        images_reuse_filename: true,
        content_css:  baseurl+'/assets/tinymce/themes/advanced/fonts/stylesheet.css',
        font_format: "devlys 010normal=devlys 010normal",
        images_upload_handler: function (blobInfo, success, failure) {
          var xhr, formData;

          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', baseurl+'/ajax/upload_image');

          xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
              failure('HTTP Error: ' + xhr.status);
              return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
              failure('Invalid JSON: ' + xhr.responseText);
              return;
            }

            success(json.location);
          };

          formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());

          xhr.send(formData);
      }
      // sizeselect: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });


// category

  $("#category").on("change", function() {
        var cat = $(this).val();

        $.ajax({
          url: baseurl+"ajax/get_subcategory/"+cat,
          success: function(res) {
            $("#response").html( $('<option />').val('').text('Select Subcategory') );

            $.each(res.data, function(i, row) {
              $("#response").append( $('<option />').val(row.category_id).text(row.category_name) );
            });
          }
        });
      });

  // Popular Product

    $(".popular_product").on("change", function() {
        var status = $(this).val();
        var id = $(this).data('id');
        window.location = baseurl+'product/?popular='+status+'&id='+id+'&action=popular';
      });
});



function readURL(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }

}







$(document).ready(function () {
    var baseurl   = $("#base_url").val();
    var wbaseurl  = $("#wbase_url").val();

    $('[data-toggle="tooltip"]').tooltip();

    $(".file-upload input[type=file]").change(function() {
        var target = $(this).closest(".file-upload").find("img");
        readURL(this, target);
    });
    // Locations
      $('.country').on('change', function() {
          var target = $(this).data('target');
          $.ajax({
              url: baseurl+'/ajax/get_states/',
              type: 'POST',
              data: {
                  'id': $(this).val()
              },
              success: function(res) {
                  $( target ).html( $('<option>').val('').text('Select State') );

                  $.each(res.data, function(i, row) {
                      $( target ).append( $('<option>').val(row.state_id).text(row.state_name+' ('+row.state_short_name+')') );
                  });

                  $( target ).trigger('change');
              }
          });
      });
      $('.state').on('change', function() {
          var target = $(this).data('target');
          $.ajax({
              url: baseurl+'/ajax/get_cities/',
              type: 'POST',
              data: {
                  'id': $(this).val()
              },
              success: function(res) {
                  $( target ).html( $('<option>').val('').text('Select City') );

                  $.each(res.data, function(i, row) {
                      $( target ).append( $('<option>').val(row.city_id).text(row.city_name+' ('+row.city_short_name+')') );
                  });

                  $( target ).trigger('change');
              }
          });
      });
      // End Location

    $(".check_all").on("click", function() {
        var form = $(this).closest("form");

        form.find(".check:not([disabled])").prop( "checked", $(this).prop("checked") );
    });

    $(".check").on("click", function() {
        var form    = $(this).closest("form");
        var checked = form.find(".check:not([disabled])").length == form.find(".check:checked").length;

        form.find(".check_all").prop( "checked", checked );
    });

    $("a[href='#delete_all']").on("click", function(e) {
        e.preventDefault();

        var form = $(this).closest("form");
        if(form.find(".check:checked").length > 0) {
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover record(s)!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                form.trigger("submit");
              }
            });
        } else {
            swal("Warning", "Select at least one record to delete", "warning");
        }

    });

    $("a[href='#copy_all']").on("click", function(e) {
        e.preventDefault();

        var form    = $(this).closest("form");

        if(form.find(".check:checked").length > 0) {
          form.trigger("submit");
        } else {
            swal("Warning", "Select at least one record to copy", "warning");
        }
    });

    $('.qtype').on('change', function() {
        var type = $(this).val();

        if(type == 'Paragraph') {
            $('.para').removeClass('d-none');
        } else {
            $('.para').addClass('d-none');
        }
    });

    // Ajax Request
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Editor
    //////////// TinyMCE Editor
    tinyMCE.PluginManager.add('stylebuttons', function(editor, url) {
      ['div', 'pre', 'p', 'code', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'].forEach(function(name){
        editor.addButton("style-" + name, {
            tooltip: "Toggle " + name,
              text: name.toUpperCase(),
              onClick: function() { editor.execCommand('mceToggleFormat', false, name); },
              onPostRender: function() {
                  var self = this, setup = function() {
                      editor.formatter.formatChanged(name, function(state) {
                          self.active(state);
                      });
                  };
                  editor.formatter ? setup() : editor.on('init', setup);
            }
        })
      });
    });
    tinymce.init({
        selector: '.editor',
        plugins: "code, link, image, textcolor, emoticons, hr, lists, stylebuttons, charmap, table, fullscreen,",
        fontsizeselect: true,
        browser_spellcheck: true,
        menubar: false,
        toolbar: 'bold italic underline strikethrough | style-h1 style-h2 style-h3 style-h4 style-h5 style-h6 | table hr forecolor backcolor superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | insertfile | charmap code fullscreen' ,
        // forced_root_block : 'div',
        branding: false,
        protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /\<script\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        images_upload_credentials: true,
        file_browser_callback_types: 'image',
        image_dimensions: true,
        automatic_uploads: true,
        images_upload_url: baseurl+'/ajax/upload-image',
        relative_urls : false,
        remove_script_host : false,
        document_base_url: wbaseurl+'/public/uploads/',
        images_reuse_filename: true,
        content_css:  wbaseurl+'/public/admin/tinymce/themes/advanced/fonts/stylesheet.css',
        font_format: "devlys 010normal=devlys 010normal",
        images_upload_handler: function (blobInfo, success, failure) {
          var xhr, formData;

          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', baseurl+'/ajax/upload-image');

          var token = $('meta[name="csrf-token"]').attr('content');
          xhr.setRequestHeader("X-CSRF-Token", token);

          xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
              failure('HTTP Error: ' + xhr.status);
              return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
              failure('Invalid JSON: ' + xhr.responseText);
              return;
            }

            success(json.location);
          };

          formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());

          xhr.send(formData);

      }
      // sizeselect: "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
    });

    // Get Subject by course
    $('.course').on('change', function() {
      var target = $(this).data('target');

      $(target).attr('disabled', 'disabled').html( $('<option />').val('').text('Loading') );

      $.ajax({
        url:  baseurl+'/ajax/get_subjects',
        type: 'POST',
        data: {
          'id': $(this).val()
        },
        success: function(res) {
          $(target).removeAttr('disabled').html( $('<option />').val('').text('Select Subject') );

          $.each(res.subjects, function(i, row) {
            $(target).append( $('<option />').val(row.subject_id).text(row.subject_name) );
          });
        }
      });
    });

    // Get Topics by subject
    $('.subject').on('change', function() {
      var target = $(this).data('target');

      $(target).attr('disabled', 'disabled').html( $('<option />').val('').text('Loading') );

      $.ajax({
        url:  baseurl+'/ajax/get_topics',
        type: 'POST',
        data: {
          'id': $(this).val()
        },
        success: function(res) {
          $(target).removeAttr('disabled').html( $('<option />').val('').text('Select Topic') );

          $.each(res.topics, function(i, row) {
            $(target).append( $('<option />').val(row.topic_id).text(row.topic_name) );
          });
        }
      });
    });

    // Get Para by topic
    $('.topic').on('change', function() {
      var target = $(this).data('target');

      $(target).attr('disabled', 'disabled').html( $('<option />').val('').text('Loading') );

      $.ajax({
        url:  baseurl+'/ajax/get_para',
        type: 'POST',
        data: {
          'id': $(this).val()
        },
        success: function(res) {
          $(target).removeAttr('disabled').html( $('<option />').val('').text('Select Essay / Paragraph') );

          $.each(res.paras, function(i, row) {
            $(target).append( $('<option />').val(row.para_id).text(row.para_name) );
          });
        }
      });
    });

    $('a[href="#save"]').on('click', function(e) {
      e.preventDefault();

      $(this).closest('form').trigger('submit');
    });


    $("#loginForm").on("submit", function(e) {
      e.preventDefault();
      var form     = $(this);
      var is_valid = form.is_valid();
      var fmsg     = form.find('.form-msg');
      var action   = form.attr('action');

      if(is_valid) {
        fmsg.addClass('alert alert-info').removeClass('alert-danger alert-success').html('Progressing, please wait...');

        $.ajax({
          url: action,
          type: 'POST',
          data: form.serialize(),
          success: function(res) {          
            if(res.status) {
              fmsg.removeClass('alert-info').addClass('alert-success').html(res.message);
              location.reload();
            } else {
              fmsg.removeClass('alert-info').addClass('alert-danger').html(res.message);
            }
          }
        });
      }
    });

    $(".file-upload input[type=file]").change(function() {
      var target = $(this).closest(".file-upload").find("img");
      readURL(this, target);
    });
});

function readURL(input, target) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(target).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


// file Upload

/*
  By Osvaldas Valutis, www.osvaldas.info
  Available for use under the MIT License
*/

'use strict';

;( function( $, window, document, undefined )
{
  $( '.inputfile' ).each( function()
  {
    var $input   = $( this ),
      $label   = $input.next( 'label' ),
      labelVal = $label.html();

    $input.on( 'change', function( e )
    {
      var fileName = '';

      if( this.files && this.files.length > 1 )
        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
      else if( e.target.value )
        fileName = e.target.value.split( '\\' ).pop();

      if( fileName )
        $label.find( '.archive-name' ).html( fileName );
      else
        $label.html( labelVal );
    });

    // Firefox bug fix
    $input
    .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
    .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
  });
})( jQuery, window, document );

// file upload end


//  audio code

//   var music = document.getElementById("music");
// var playButton = document.getElementById("play");
// var pauseButton = document.getElementById("pause");
// var playhead = document.getElementById("elapsed");
// var timeline = document.getElementById("slider");
// var timer = document.getElementById("timer");
// var duration;
// // pauseButton.style.visibility = "hidden";

// var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;
// music.addEventListener("timeupdate", timeUpdate, false);

// function timeUpdate() {
//   var playPercent = timelineWidth * (music.currentTime / duration);
//   playhead.style.width = playPercent + "px";

//   var secondsIn = Math.floor(((music.currentTime / duration) / 3.5) * 100);
//   if (secondsIn <= 9) {
//     timer.innerHTML = "0:0" + secondsIn;
//   } else {
//     timer.innerHTML = "0:" + secondsIn;
//   }
// }

// playButton.onclick = function() {
//   music.play();
//   playButton.style.visibility = "hidden";
//   pause.style.visibility = "visible";
// }

// pauseButton.onclick = function() {
//   music.pause();
//   playButton.style.visibility = "visible";
//   pause.style.visibility = "hidden";
// }

// music.addEventListener("canplaythrough", function () {
//   duration = music.duration;
// }, false);

// audio code end
