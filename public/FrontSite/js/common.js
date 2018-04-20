$(function () {

    $('.sakyan-select-language').select2({})
    $(window).resize(function () {
        $('.sakyan-select-language').select2({
        })
    });
    $('.fixed-container').on('click', function (e) {
        var topOffset = $("#contact-container").offset().top - 200;

        $('html, body').animate({
            scrollTop: topOffset,
            offset: {top: 200}
        }, 400);
    })

    // Add smooth scrolling to all links in navbar + footer link
    $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
    $(window).scroll(function () {
        $(".slideanim").each(function () {
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
    
    $('.sakyan-select-language').unbind().on('change',function(e){
        
        var url = $(this).data('seturl')+'/'+$(this).val();
        var form = $('#ref-form');
            form.attr('action',url);
            form.append('<input type="hidden" name="prevPath" value="'+$(this).data('currentpath')+'">');
            form.append('<input type="hidden" name="params" value="'+$(this).data('params')+'">');
            form.submit()
    })
    $('#custom-id a').each(function(e){
        var url      = window.location.href;
        if(url == $(this).attr('href')){
           $(this).closest('li').addClass('active'); 
        }
        
    })

})