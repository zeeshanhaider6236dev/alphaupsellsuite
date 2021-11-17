@push('componentCss')
<style>
    .incart_heading_style{
        @php
            if(isset($upsell)):
                $heading_align = $upsell['setting']['heading_align'];
            else:
                $heading_align = $setting['heading_align'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $heading_color = $upsell['setting']['heading_color'];
            else:
                $heading_color = $setting['heading_color'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $timer_font_size = $upsell['setting']['timer_font_size'];
            else:
                $timer_font_size = $setting['timer_font_size'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $timer_font_family = $upsell['setting']['timer_font_family'];
            else:
                $timer_font_family = $setting['timer_font_family'];
            endif;
        @endphp
        font-family: {{ $timer_font_family }} !important ;
        font-size: {{ $timer_font_size.'px' }} !important;
        color: {{ $heading_color }}!important;
        text-align: {{ $heading_align }} !important;
    }

    .incart_timer{
        @php
            if(isset($upsell)):
                $heading_font_family = $upsell['setting']['heading_font_family'];
            else:
                $heading_font_family = $setting['heading_font_family'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $heading_font_size = $upsell['setting']['heading_font_size'];
            else:
                $heading_font_size = $setting['heading_font_size'];
            endif;
        @endphp
        font-family: {{ $heading_font_family }} !important ;
        font-size: {{ $heading_font_size.'px' }} !important;
    }
    .product_title_color_style{
        @php
            if(isset($upsell)):
                $product_title_color = $upsell['setting']['product_title_color'];
            else:
                $product_title_color = $setting['product_title_color'];
            endif;
        @endphp
        color: {{ $product_title_color }}!important;
    }
    .p_upsell.upsell_background_color{
        @php
            if(isset($upsell)):
                $upsell_background_color = $upsell['setting']['upsell_background_color'];
            else:
                $upsell_background_color = $setting['upsell_background_color'];
            endif;
        @endphp
        background-color: {{ $upsell_background_color }} !important;
    }
    .sale_price_color_style{
        @php
            if(isset($upsell)):
                $sale_price_color = $upsell['setting']['sale_price_color'];
            else:
                $sale_price_color = $setting['sale_price_color'];
            endif;
        @endphp
        color: {{ $sale_price_color }}!important;
    }
    .compare_price_color_style{
        @php
            if(isset($upsell)):
                $compare_price_color = $upsell['setting']['compare_price_color'];
            else:
                $compare_price_color = $setting['compare_price_color'];
            endif;
        @endphp
        color: {{ $compare_price_color }}!important;
    }
    .incart_button{
        @php
            if(isset($upsell)):
                $button_border_color = $upsell['setting']['button_border_color'];
            else:
                $button_border_color = $setting['button_border_color'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $button_text_color = $upsell['setting']['button_text_color'];
            else:
                $button_text_color = $setting['button_text_color'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $button_background_color = $upsell['setting']['button_background_color'];
            else:
                $button_background_color = $setting['button_background_color'];
            endif;
        @endphp
        border-color: {{ $button_border_color }} !important;
        color: {{ $button_text_color }} !important;
        background-color: {{ $button_background_color }} !important;
    }
    .incart_button:hover{
        @php
            if(isset($upsell)):
                $button_hover_text_color = $upsell['setting']['button_hover_text_color'];
            else:
                $button_hover_text_color = $setting['button_hover_text_color'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $button_hover_background_color = $upsell['setting']['button_hover_background_color'];
            else:
                $button_hover_background_color = $setting['button_hover_background_color'];
            endif;
        @endphp
        color: {{ $button_hover_text_color }}!important;
        background-color: {{ $button_hover_background_color }} !important;
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
    span.aus_timer_duration{
        background-color: {{ isset($upsell) ? $upsell['setting']['timer_text_bg_color'] : $setting['timer_text_bg_color'] }};
        color: {{ isset($upsell) ? $upsell['setting']['timer_text_color'] : $setting['timer_text_color'] }};
        text-align: center;
        margin:5px;
        padding: 2px 6px;
        border-radius: 3px;
    }
    span.timer-colon-aus {
        color: {{ isset($upsell) ? $upsell['setting']['timer_text_bg_color'] : $setting['timer_text_bg_color'] }}!important;
    }
</style>
@endpush
@push('componentJs')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
    <script>
        $(function(){
            $(document).on('click','.end_date', function() {
               $('.end_date').css({'background-color': '#fffdfd'});
            });
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });
            $('input[name="incart_heading"]').keyup(function(e){
                $('.incart_heading_style').html($(this).val());
            });
            $('select[name="heading_font_family"]').change(function(e){
                setProperty('.incart_heading_style',"font-family",`${$(this).val()}`);
            });
            $('input[name="heading_font_size"]').keyup(function(e){
                setProperty('.incart_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_font_size"]').change(function(e){
                setProperty('.incart_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_color"]').change(function(e){
                setProperty('.incart_heading_style',"color",`${$(this).val()}`);
            });
            $('select[name="heading_align"]').change(function(e){
                setProperty('.incart_heading_style',"text-align",`${$(this).val()}`);
            });
            $('input[name="count_down_timer"]').change(function(e){
                if($(this).is(':checked')){
                    $(".incart_timer-aus").show();
                    $('input[name="count_down_timer"]').val(1);
                }else{
                    $(".incart_timer-aus").hide();
                    $('input[name="count_down_timer"]').val(0);
                }
            });
            $('input[name="show_product_title"]').change(function(e){
                if($(this).is(':checked')){
                    $(".product_title").show();
                    $('input[name="show_product_title"]').val(1);
                }else{
                    $(".product_title").hide();
                    $('input[name="show_product_title"]').val(0);
                }
            });
            $('input[name="show_variant_selection"]').change(function(e){
                if($(this).is(':checked')){
                    $(".variant_option").show();
                    $('input[name="show_variant_selection"]').val(1);
                }else{
                    $(".variant_option").hide();
                    $('input[name="show_variant_selection"]').val(0);
                }
            });
            $('input[name="show_compare_price"]').change(function(e){
                if($(this).is(':checked')){
                    $(".compare_price").show();
                    $('input[name="show_compare_price"]').val(1);
                }else{
                    $(".compare_price").hide();
                    $('input[name="show_compare_price"]').val(0);
                }
            });
            $('input[name="time_duration_minutes"]').keyup(function(e){
                $('#time_duration').html($(this).val());
            });
            $('select[name="timer_font_family"]').change(function(e){
                setProperty('.incart_timer',"font-family",`${$(this).val()}`);
            });
            $('input[name="timer_font_size"]').keyup(function(e){
                setProperty('.incart_timer',"font-size",`${$(this).val()}px`);
            });
            $('input[name="timer_font_size"]').change(function(e){
                setProperty('.incart_timer',"font-size",`${$(this).val()}px`);
            });
            $('input[name="button_text"]').keyup(function(e){
                $('.incart_button').html($(this).val());
                $('.incart_button').val($(this).val());
            });
            $('input[name="product_title_color"]').change(function(e){
                setProperty('.product_title_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="upsell_background_color"]').change(function(e){
                setProperty('.p_upsell.upsell_background_color',"background-color",`${$(this).val()}`);
            });
            $('input[name="sale_price_color"]').change(function(e){
                setProperty('.sale_price_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="compare_price_color"]').change(function(e){
                setProperty('.compare_price_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="button_border_color"]').change(function(e){
                setProperty('.button_border_color',"border-color",`${$(this).val()}`);
            });
            $('input[name="button_text_color"]').change(function(e){
                setProperty('.button_text_color',"color",`${$(this).val()}`);
            });
            $('input[name="button_background_color"]').change(function(e){
                setProperty('.button_background_color',"background-color",`${$(this).val()}`);
            });
             $('input[name="timer_text_bg_color"]').change(function(e){
                setProperty('.timer-bg-color-aus',"background-color",`${$(this).val()}`);
            });
             $('input[name="timer_text_bg_color"]').change(function(e){
                setProperty('.timer-colon-aus',"color",`${$(this).val()}`);
            });
             $('input[name="timer_text_color"]').change(function(e){
                setProperty('.timer-bg-color-aus',"color",`${$(this).val()}`);
            });
            $('.incart_button').hover(function(){
                    setProperty('.incart_button',"color",$('input[name="button_hover_text_color"]').val());
                },function(){
                    setProperty('.incart_button',"color",$('input[name="button_text_color"]').val());
            });
            $('.incart_button').hover(function(){
                    setProperty('.incart_button',"background-color",$('input[name="button_hover_background_color"]').val());
                },function(){
                    setProperty('.incart_button',"background-color",$('input[name="button_background_color"]').val());
            });
            $('input[name="button_hover_text_color"]').change(function(e){
                let value = $(this).val();
                $('.incart_button').hover(function(){
                    setProperty('.incart_button',"color",value);
                },function(){
                    setProperty('.incart_button',"color",$('input[name="button_text_color"]').val());
                });
            });
            $('input[name="button_hover_background_color"]').change(function(e){
                let value = $(this).val();
                $('.incart_button').hover(function(){
                    setProperty('.incart_button',"background-color",value);
                },function(){
                    setProperty('.incart_button',"background-color",$('input[name="button_background_color"]').val());
                });
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
                    let element = $(this);
                    let element_innerText = element.text();
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
                           var update = $(element).empty().html('Update');
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
