@push('componentCss')
<style>
    .live_p
    {
        position:sticky;
        top:20px;
    }
    .fbt_heading_style{
        font-family:@if (isset($upsell))
                        {{ $upsell->setting['heading_font_family'] }} !important ;
                    @else
                        {{ $setting['heading_font_family'] }} !important ;
                    @endif

        font-size:  @if (isset($upsell))
                        {{ $upsell->setting['heading_font_size'].'px' }} !important;
                    @else
                        {{ $setting['heading_font_size'].'px' }} !important;
                    @endif
        color:      @if (isset($upsell))
                        {{ $upsell->setting['heading_color'] }}!important;
                    @else
                        {{ $setting['heading_color'] }}!important;
                    @endif
        text-align: @if (isset($upsell))
                        {{ $upsell->setting['heading_align'] }} !important;
                    @else
                        {{ $setting['heading_align'] }} !important;
                    @endif
    }
    .product_title_color_style{
        color:  @if (isset($upsell))
                    {{ $upsell->setting['product_title_color'] }}!important;
                @else
                    {{ $setting['product_title_color'] }}!important;
                @endif
    }
    .sale_price_color_style{
        color:  @if (isset($upsell))
                    {{ $upsell->setting['sale_price_color'] }}!important;
                @else
                    {{ $setting['sale_price_color'] }}!important;
                @endif
        @if (isset($upsell))
            @if (!$upsell->setting['show_original_total_price'])
                display:none;
            @endif
        @endif
    }
    .compare_price_color_style{
        color:  @if (isset($upsell))
                    {{ $upsell->setting['compare_price_color'] }}!important;
                @else
                    {{ $setting['compare_price_color'] }}!important;
                @endif
        @if (isset($upsell))
            @if (!$upsell->setting['show_compare_price_available'])
                display:none;
            @endif
        @endif
    }
    .notify-badge
    {
        @if (isset($upsell))
            @if (!$upsell->setting['show_sale_badge_on_image'])
                display:none;
            @endif
        @endif
    }
    .fbt_button{
        border-color:   @if (isset($upsell))
                            {{ $upsell->setting['button_border_color'] }} !important;
                        @else
                            {{ $setting['button_border_color'] }} !important;
                        @endif
        color:  @if (isset($upsell))
                    {{ $upsell->setting['button_text_color'] }} !important;
                @else
                    {{ $setting['button_text_color'] }} !important;
                @endif
        background-color: @if (isset($upsell))
                            {{ $upsell->setting['button_background_color'] }} !important;
                        @else
                            {{ $setting['button_background_color'] }} !important;
                        @endif
    }
    .fbt_button:hover{
        color:  @if (isset($upsell))
                    {{ $upsell->setting['button_hover_text_color'] }}!important;
                @else
                    {{ $setting['button_hover_text_color'] }}!important;
                @endif

        background-color:   @if (isset($upsell))
                                {{ $upsell->setting['button_hover_background_color'] }} !important;
                            @else
                                {{ $setting['button_hover_background_color'] }} !important;
                            @endif
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
</style>
@endpush
@push('componentJs')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
    <script>
        $("#delete_button_auto").on( "click", function() {
            $( "#ppu_button" ).trigger( "click" );
        });
        $(function(){
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });
            $('input[name="fbt_heading"]').keyup(function(e){
                $('.fbt_heading_style').html($(this).val());
            });
            $('select[name="heading_font_family"]').change(function(e){
                setProperty('.fbt_heading_style',"font-family",`${$(this).val()}`);
            });
            $('input[name="heading_font_size"]').keyup(function(e){
                setProperty('.fbt_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_font_size"]').change(function(e){
                setProperty('.fbt_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_color"]').change(function(e){
                setProperty('.fbt_heading_style',"color",`${$(this).val()}`);
            });
            $('select[name="heading_align"]').change(function(e){
                setProperty('.fbt_heading_style',"text-align",`${$(this).val()}`);
            });
            $('input[name="button_text"]').keyup(function(e){
                $('.fbt_button').html($(this).val());
            });
            $('input[name="this_item"]').keyup(function(e){
                $('.this_item').html($(this).val());
            });
            $('input[name="sale_badge_text"]').keyup(function(e){
                $('.sale_badge').html($(this).val());
            });
            $('input[name="total_price_text"]').keyup(function(e){
                $('.total_price').html($(this).val());
            });
            $('input[name="product_title_color"]').change(function(e){
                setProperty('.product_title_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="sale_price_color"]').change(function(e){
                setProperty('.sale_price_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="compare_price_color"]').change(function(e){
                setProperty('.compare_price_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="button_text_color"]').change(function(e){
                setProperty('.fbt_button',"color",`${$(this).val()}`);
            });
            $('input[name="button_background_color"]').change(function(e){
                setProperty('.fbt_button',"background-color",`${$(this).val()}`);
            });
            $('.fbt_button').hover(function(){
                    setProperty('.fbt_button',"color",$('input[name="button_hover_text_color"]').val());
                },function(){
                    setProperty('.fbt_button',"color",$('input[name="button_text_color"]').val());
            });
            $('.fbt_button').hover(function(){
                    setProperty('.fbt_button',"background-color",$('input[name="button_hover_background_color"]').val());
                },function(){
                    setProperty('.fbt_button',"background-color",$('input[name="button_background_color"]').val());
            });
            $('input[name="button_hover_text_color"]').change(function(e){
                let value = $(this).val();
                $('.fbt_button').hover(function(){
                    setProperty('.fbt_button',"color",value);
                },function(){
                    setProperty('.fbt_button',"color",$('input[name="button_text_color"]').val());
                });
            });
            $('input[name="button_hover_background_color"]').change(function(e){
                let value = $(this).val();
                $('.fbt_button').hover(function(){
                    setProperty('.fbt_button',"background-color",value);
                },function(){
                    setProperty('.fbt_button',"background-color",$('input[name="button_background_color"]').val());
                });
            });
            $('input[name="show_original_total_price"]').change(function(){
                if($(this).is(':checked')){
                    $(".sale_price_color_style").show();
                }else{
                    $(".sale_price_color_style").hide();
                }
            });
            $('input[name="show_compare_price_available"]').change(function(){
                if($(this).is(':checked')){
                    $(".compare_price_color_style").show();
                }else{
                    $(".compare_price_color_style").hide();
                }
            });
            $('input[name="show_sale_badge_on_image"]').change(function(){
                if($(this).is(':checked')){
                    $(".sale_badge").show();
                }else{
                    $(".sale_badge").hide();
                }
            });
            $(document).on('click','.fbt_end_date', function() {
               $('.fbt_end_date').css({'background-color': '#fffdfd'});
            });
            var id = '';
            var upsell_add_route = '';
            @isset($upsell)
                $(".updateUpsell").click(function(e){
                    let element = $(this);
                    let element_innerText = element.text();
                    addSpinner($(element));
                    ajaxRequest("{{ route('upsell.update',$upsell) }}",function(response){
                        $(element).empty().html('Update').prop('disabled',false);
                    },'POST',$(".upsellForm").serialize());
                });
            @else
                $(".saveUpsell").click(function(e){
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
                        console.log(response.errors)
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
        @isset($upsell)
            var upsell = {!! $upsell !!}
            if(upsell.auto){
                var flag = true;
            }
            else{
                var flag = false;
            }
        @else
            var flag = false;
        @endisset
        $('.ppu-auto-button').on('click',function(){
            var html = `<div class="box_shado mt" style="display: flex; align-items: center;"><div class="img_box col-md-2" style="width: 100%;"> <img src="https://i.ibb.co/zP4drmC/Pngtree-artificial-intelligence-chip-icon-for-4864546.png" alt="error loading image "></div><div><span>Our AI analysis the previous purchases in your store through data mining algorithm & produce memory graph with recommended products that are usually added.</span></div><div class="img_btn col-md-2"><button id="delete_button_auto"type="button" class="delete float-right">Delete</button></div></div>`

            if(!flag){
                $("#auto-collapse-box").css('display','block')
                $("#auto-collapse-box").html(html);
                flag = true;
            }
            else{
                $("#auto-collapse-box").css('display','none')
                $("#auto-collapse-box").html('');
                flag = false;
            }
        });
        $(document).on('click','#delete_button_auto',function(){
            $('.ppu-auto-button')[0].click()
        });
    </script>
@endpush
