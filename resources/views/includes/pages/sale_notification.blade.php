@push('componentCss')

    <style>
            .product_title
            {
                color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['product_title_color']: $upsellType->setting['product_title_color'] }} !important;
                font-size: {{ $upsellType->setting['product_title_font_size'] }} !important;
                font-weight: {{ $upsellType->setting['product_title_weight'] }} !important;
            }
            .customer_name
            {
                color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['text_color'] : $upsellType->setting['text_color'] }} !important;
                font-size: {{ $upsellType->setting['text_font_size'] }} !important;
                font-weight: {{ $upsellType->setting['text_weight'] }} !important;
            }
            .timer_display
            {
                color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['timer_color'] : $upsellType->setting['timer_color'] }} !important;
            }
            .popup_n1_btn
            {
                color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['cross_icon_color'] : $upsellType->setting['cross_icon_color'] }} !important;
                background-color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['cross_icon_background_color'] : $upsellType->setting['cross_icon_background_color'] }} !important;
            }
            .popup_n_1 
            {
                background-color: {{ isset($saleNotificationUpsell) ? $saleNotificationUpsell->setting['background_color'] : $upsellType->setting['background_color'] }} !important;
            }
    </style>
@endpush


@push('componentJs')
    <script src="https://unpkg.com/vanilla-picker@2"></script>
    <script>
        $(function(){
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });
            $('input[name="product_title_font_size"]').on('keyup change',function(e){               
                setProperty('.product_title',"font-size",`${$(this).val()}px`);
            });
            $('select[name="product_title_weight"]').on('keyup change',function(e){               
                setProperty('.product_title',"font-weight",`${$(this).val()}`);
            });
            $('input[name="text_font_size"]').on('keyup change',function(e){               
                setProperty('.customer_name',"font-size",`${$(this).val()}px`);
            });
            $('select[name="text_weight"]').on('keyup change',function(e){               
                setProperty('.customer_name',"font-weight",`${$(this).val()}`);
            });
            $('input[name="product_title_color"]').on('change',function(e){               
                setProperty('.product_title',"color",`${$(this).val()}`);
            });
            $('input[name="background_color"]').on('change',function(e){               
                setProperty('.notification_display_style',"background-color",`${$(this).val()}`);
            });
            $('input[name="timer_color"]').on('change',function(e){               
                setProperty('.timer_display',"color",`${$(this).val()}`);
            });
            $('input[name="text_color"]').on('change',function(e){               
                setProperty('.customer_name',"color",`${$(this).val()}`);
            });
            $('input[name="cross_icon_color"]').on('change',function(e){               
                setProperty('.popup_n1_btn',"color",`${$(this).val()}`);
            });
            $('input[name="cross_icon_background_color"]').on('change',function(e){               
                setProperty('.popup_n1_btn',"background-color",`${$(this).val()}`);
            });
            $('input[name="repeat_cycle"]').change(function(e){
                if($(this).is(':checked')){
                    $('input[name="repeat_cycle"]').val(1);
                }else{
                    $('input[name="repeat_cycle"]').val(0);
                }
            });
            $('input[name="hide_on_mobile"]').change(function(e){
                if($(this).is(':checked')){
                    $('input[name="hide_on_mobile"]').val(1);
                }else{
                    $('input[name="hide_on_mobile"]').val(0);
                }
            });
            @isset($upsell)
                $(".updateUpsell").click(function(e){
                    let element = $(this);
                    addSpinner($(element));
                    ajaxRequest("{{ route('upsell.update',$upsell) }}",function(response){
                        $(element).empty().html('Update');
                    },'POST',$(".upsellForm").serialize());
                });
            @else
                $(".saveUpsell").click(function(e){
                    let element = $(this);
                    addSpinner($(element));
                    ajaxRequest("{{ route('upsell.store',$upsellType) }}",function(response){
                        $(element).empty().html('Save');
                    },'POST',$(".upsellForm").serialize());
                });
            @endisset
        });
    </script>
@endpush