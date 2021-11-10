@push('componentCss')
    <style>
        .ppu_heading_style{
            font-family: {{ isset($upsell) ? $upsell->setting['heading_font_family'] : $setting['heading_font_family'] }} !important ;
            font-size:   {{ isset($upsell) ? $upsell->setting['heading_font_size'].'px' : $setting['heading_font_size'].'px' }} !important;
            color:       {{ isset($upsell) ? $upsell->setting['heading_color'] : $setting['heading_color'] }}!important;
            text-align:  {{ isset($upsell) ? $upsell->setting['heading_align'] : $setting['heading_align'] }} !important;                
        }
        .toggle_product_title{
            color:  {{ isset($upsell) ? $upsell->setting['product_title_color'] : $setting['product_title_color'] }}!important;
            text-align: {{ isset($upsell) ? $upsell->setting['heading_align'] : $setting['heading_align'] }} !important;
        }
        .product_sale_price
        {
            color: {{ isset($upsell) ? $upsell->setting['sale_price_color'] : $setting['sale_price_color'] }}!important;
        }
        .custom_upsell_background_color
        {
            background-color: {{isset($upsell) ? $upsell->setting['my_upsell_background_color'] : $setting['upsell_background_color'] }}!important;
        }
        .ppu_button 
        {
            background-color: {{ isset($upsell) ? $upsell->setting['button_background_color'] : $setting['button_background_color']}}!important;
            color: {{isset($upsell)? $upsell->setting['button_text_color']:$setting['button_text_color']}}!important;
            border-color: {{isset($upsell) ? $upsell->setting['button_border_color'] : $setting['button_border_color']}}!important;
        }
        .ppu_button:hover
        {
            background-color: {{isset($upsell) ? $upsell->setting['button_hover_background_color'] : $setting['button_hover_background_color'] }}!important;;
            color: {{ isset($upsell) ? $upsell->setting['button_hover_text_color'] : $setting['button_hover_text_color'] }}!important;
        }
        .fixed_price_off
        {
            display: none;
        }
        .discount_offer_style
        {
            color: {{ isset($upsell) ? $upsell->setting['discount_text_color'] : $setting['discount_text_color'] }}!important;
            background-color: {{ isset($upsell) ? $upsell->setting['discount_background_color'] : $setting['discount_background_color'] }}!important;
        }
        .post_timer
        {
            display: @isset($upsell) {{ $upsell->setting['time_limit_toggler'] == 1 ? 'flex' : 'none' }} @endisset;
            background:{{ isset($upsell) ? $upsell->setting['thank_you_timer_text_bg_color'] : $setting['thank_you_timer_text_bg_color'] }} !important;
        }
        .toggle_product_title
        {
            display: @isset($upsell) {{ $upsell->setting['show_ppu_product_title'] == 0 ? 'none' : '' }} @endisset
        }
        .toggle_varient_selection
        {
            display : @isset($upsell) {{ $upsell->setting['show_ppu_varient_selection'] == 0 ? 'none' : '' }} @endisset
        }
        .alpha_upsell_model_picker{
            overflow: hidden !important;
        }
        .alpha_tab_content{
            max-height: 100% !important;
            overflow: scroll !important;
        }
        div.productSearchBox ul.product_search{
            max-height: 100% !important;
            overflow-y: scroll !important;
        }
        div.productSearchBox{
            padding-bottom: 16px !important;
        }
        p.offer_text{
            color:{{ isset($upsell) ? $upsell->setting['thank_you_timer_text_color'] : $setting['thank_you_timer_text_color'] }} !important;
        }
        p.display_timer_counter{
            color:{{ isset($upsell) ? $upsell->setting['thank_you_timer_color'] : $setting['thank_you_timer_color'] }} !important;
        }
        a.arrow-icon{
            color:{{ isset($upsell) ? $upsell->setting['arrow_icon_color'] : $setting['arrow_icon_color'] }} ;
            background-color:{{ isset($upsell) ? $upsell->setting['arrow_icon_background_color'] : $setting['arrow_icon_background_color'] }};
        }
        a.arrow-icon:hover{
            background: {{ isset($upsell) ? $upsell->setting['arrow_icon_background_color'] : $setting['arrow_icon_background_color'] }} !important;
        }

    </style>
@endpush

@push('componentJs')
    <script>

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        // dots[slideIndex-1].className += " active";
        }
    </script>
@endpush

@push('componentJs')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
    <script>
         
        $(function(){
            $("#delete_button_auto" ).on( "click", function() {
                 $(".delete.autoButton.ppu-auto-button" ).trigger("click");
            });
            $(document).on('click','.end_date', function() {
               $('.end_date').css({'background-color': '#fffdfd'});
            });
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });
            $('input[name="ppu_heading"]').keyup(function(e){
                $('.ppu_heading_style').html($(this).val());
            });
             $('input[name="thank_you_timer_text"]').keyup(function(e){
                $('.offer_text').html($(this).val());
            });
            $('input[name="thank_you_timer_text_bg_color"]').change(function(e){
                setProperty('.post_timer',"background-color",`${$(this).val()}`);
            });
            $('input[name="thank_you_timer_color"]').change(function(e){
                setProperty('.display_timer_counter',"color",`${$(this).val()}`);
            });
            $('input[name="thank_you_timer_text_color"]').change(function(e){
                console.log($(this).val())
                setProperty('.offer_text',"color",`${$(this).val()}`);
            });
            $('input[name="thank_you_timer_bg_color"]').change(function(e){
                setProperty('.post_timer','background-color',`${$(this).val()}`);
            });
            $('input[name="arrow_icon_color"]').change(function(e){
                setProperty('.arrow-icon','color',`${$(this).val()}`);
            });
            $('input[name="arrow_icon_background_color"]').change(function(e){
                setProperty('.arrow-icon','background-color',`${$(this).val()}`);
            });
            $('select[name="heading_font_family"]').change(function(e){
                setProperty('.ppu_heading_style',"font-family",`${$(this).val()}`);
            });
            $('input[name="heading_font_size"]').change(function(e){
                setProperty('.ppu_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_color"]').change(function(e){
                setProperty('.ppu_heading_style',"color",`${$(this).val()}`);
            });
            $('select[name="heading_align"]').change(function(e){
                setProperty('.ppu_heading_style',"text-align",`${$(this).val()}`);
            });
            $('input[name="ppu_button_text"]').keyup(function(e){
                $('.ppu_button').val($(this).val());
            });
            $('select[name="show_ppu_product_title"]').change(function(e){
                setProperty('.ppu_heading_style',"text-align",`${$(this).val()}`);
            });
            $('input[name="time_limit_toggler"]').change(function(e){
                if($(this).is(':checked')){
                    $(".offer_timer").css("display","flex");
                    $('input[name="time_limit_toggler"]').val(1);
                }else{
                    $(".offer_timer").hide();
                    $('input[name="time_limit_toggler"]').val(0);
                }
            });
            $('input[name="timer_duration"]').on('keyup change',function(e){               
                 $('.display_timer_counter').html($(this).val());
            });
            $('input[name="timer_text-thank-you"]').on('keyup change',function(e){               
                 $('.timer-text-thank-you').html($(this).val());
            });
            $('select[name="timer_font_family"]').change(function(e){
                setProperty('.time_display',"font-family",`${$(this).val()}`);
            });
            $('input[name="timer_font_size"]').change(function(e){
                setProperty('.time_display',"font-size",`${$(this).val()}px`);
            });
            $('input[name="show_ppu_product_title"]').change(function(e){
                if($(this).is(':checked')){
                    $(".toggle_product_title").show();
                    $('input[name="show_ppu_product_title"]').val(1);
                }else{
                    $(".toggle_product_title").hide();
                    $('input[name="show_ppu_product_title"]').val(0);
                }
            });
            $('input[name="show_ppu_varient_selection"]').change(function(e){
                if($(this).is(':checked')){
                    $(".toggle_varient_selection").show();
                    $('input[name="show_ppu_varient_selection"]').val(1);
                }else{
                    $(".toggle_varient_selection").hide();
                    $('input[name="show_ppu_varient_selection"]').val(0);
                }
            });
            $('input[name="product_title_color"]').change(function(e){
                setProperty('.toggle_product_title','color',`${$(this).val()}`);
            });
            $('input[name="my_upsell_background_color"]').change(function(e){
                setProperty('.custom_upsell_background_color','background-color',`${$(this).val()}`);
            });
            $('input[name="sale_price_color"]').change(function(e){
                setProperty('.product_sale_price','color',`${$(this).val()}`);
            });
            $('input[name="button_border_color"]').change(function(e){
                setProperty('.ppu_button','border-color',`${$(this).val()}`);
            });
            $('input[name="button_text_color"]').change(function(e){
                setProperty('.ppu_button','color',`${$(this).val()}`);
            });
            $('input[name="button_background_color"]').change(function(){
                    setProperty('.ppu_button ','background-color',`${$(this).val()}`);
            });
              $('input[name="arrow-icon-background-color"]').change(function(){
                    setProperty('.arrow-icon ','background-color',`${$(this).val()}`);
            });
              $('input[name="arrow-icon-color"]').change(function(){
                    setProperty('.arrow-icon ','color',`${$(this).val()}`);
            });
            $('input[name="button_hover_text_color"]').change(function(e){
                let value = $(this).val();
                $('.ppu_button_1').hover(function(){
                    setProperty('.ppu_button_1',"color",value);
                },function(){
                    setProperty('.ppu_button_1',"color",$('input[name="button_text_color"]').val());
                });
                $('.ppu_button_2').hover(function(){
                    setProperty('.ppu_button_2',"color",value);
                },function(){
                    setProperty('.ppu_button_2',"color",$('input[name="button_text_color"]').val());
                });
                $('.ppu_button_3').hover(function(){
                    setProperty('.ppu_button_3',"color",value);
                },function(){
                    setProperty('.ppu_button_3',"color",$('input[name="button_text_color"]').val());
                });
                $('.ppu_button_4').hover(function(){
                    setProperty('.ppu_button_4',"color",value);
                },function(){
                    setProperty('.ppu_button_4',"color",$('input[name="button_text_color"]').val());
                });
            });
            $('input[name="button_hover_background_color"]').change(function(e){
                let value = $(this).val();
                $('.ppu_button_1').hover(function(){
                    setProperty('.ppu_button_1',"background-color",value);
                },function(){
                    setProperty('.ppu_button_1',"background-color",$('input[name="button_background_color"]').val());
                });
                $('.ppu_button_2').hover(function(){
                    setProperty('.ppu_button_2',"background-color",value);
                },function(){
                    setProperty('.ppu_button_2',"background-color",$('input[name="button_background_color"]').val());
                });
                $('.ppu_button_3').hover(function(){
                    setProperty('.ppu_button_3',"background-color",value);
                },function(){
                    setProperty('.ppu_button_3',"background-color",$('input[name="button_background_color"]').val());
                });
                $('.ppu_button_4').hover(function(){
                    setProperty('.ppu_button_4',"background-color",value);
                },function(){
                    setProperty('.ppu_button_4',"background-color",$('input[name="button_background_color"]').val());
                });
            });
            $('input[name="work_on_desktop"]').change(function(e){
                if($(this).is(':checked')){
                    $('input[name="work_on_desktop"]').val(1);
                }else{
                    $('input[name="work_on_desktop"]').val(0);
                }
            });
            $('input[name="work_on_mobile"]').change(function(e){
                if($(this).is(':checked')){
                    $('input[name="work_on_mobile"]').val(1);
                }else{
                    $('input[name="work_on_mobile"]').val(0);
                }
            });
            $('input[name="upsell_discount"]').on('keyup change',function(e){               
                 $('.discount_offer').html($(this).val()+'%Off');
                 $('.fixed_price_off').html('$'+$(this).val()+' Off');
            });
            $('select[name="discount_price_option"]').change(function(e){
                if($(this).val()=='No Discount'){
                    $('input[name="upsell_discount"]').val('0');
                    $('.discount_offer').hide();
                    $('.fixed_price_off').hide();
                }
                else if($(this).val()=='Fixed Price Off')
                {
                    $('.discount_offer').hide();
                    $('.fixed_price_off').show();
                }
                else{
                    $('input[name="upsell_discount"]').val();
                    $('.fixed_price_off').hide();                    
                    $('.discount_offer').show();                    
                }
            });
            $('input[name="discount_text_color"]').change(function(){
                setProperty('.discount_offer_style ','color',`${$(this).val()}`);
            });
            $('input[name="discount_background_color"]').change(function(){
                setProperty('.discount_offer_style ','background-color',`${$(this).val()}`);
            });
            var id = '';
            var upsell_add_route = '';
            @isset($upsell)
                $(".updateUpsell").click(function(e){
                    let element = $(this);
                    addSpinner($(element));
                    ajaxRequest("{{ route('upsell.update',$upsell) }}",function(response){
                        $(element).empty().html('Update').prop('disabled',false);
                    },'POST',$(".upsellForm").serialize());
                });
            @else
                $(".saveUpsell").click(function(e){
                    console.log('hello')
                    let element = $(this);
                    addSpinner($(element));
                    if(id == ''){
                        upsell_add_route = "{{ route('upsell.store',$upsellType) }}";
                    }
                    else{
                        var upsell_update_route = "{{ route('upsell.update','') }}";
                        upsell_add_route = upsell_update_route+'/'+id;
                    }
                    ajaxRequest(upsell_add_route,function(response){
                        if(response.status){
                           var update = $(element).empty().html('Update').prop('disabled',false);
                           id = response.upsell_id;
                         }
                        else if(response.errors){
                            $(element).empty().html('Save').prop('disabled',false);
                        }
                        
                    },'POST',$(".upsellForm").serialize());
                });
            @endisset
        });
    </script>
@endpush
