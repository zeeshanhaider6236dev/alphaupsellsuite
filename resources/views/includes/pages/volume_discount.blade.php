@push('componentCss')
<style>
    .volume_discount_heading_style{
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
        @php
            if(isset($upsell)):
                $heading_color = $upsell['setting']['heading_color'];
            else:
                $heading_color = $setting['heading_color'];
            endif;
        @endphp
        @php
            if(isset($upsell)):
                $heading_align = $upsell['setting']['heading_align'];
            else:
                $heading_align = $setting['heading_align'];
            endif;
        @endphp
        font-family: {{ $heading_font_family }} !important ;
        font-size: {{ $heading_font_size.'px' }} !important;
        color: {{ $heading_color }}!important;
        text-align: {{ $heading_align }} !important;
    }
    .quantity_color_style{
        @php
            if(isset($upsell)):
                $quantity_color = $upsell['setting']['quantity_color'];
            else:
                $quantity_color = $setting['quantity_color'];
            endif;
        @endphp
        color: {{ $quantity_color }}!important;
    }
    .best_deal_color_style{
        @php
            if(isset($upsell)):
                $best_deal_color = $upsell['setting']['best_deal_color'];
            else:
                $best_deal_color = $setting['best_deal_color'];
            endif;
        @endphp
        color: {{ $best_deal_color }}!important;
    }
    .original_total_price_style{
        @php
            if(isset($upsell)):
                $original_total_price_color = $upsell['setting']['original_total_price_color'];
            else:
                $original_total_price_color = $setting['original_total_price_color'];
            endif;
        @endphp
        color: {{ $original_total_price_color }}!important;
    }
    .discount_total_price_style{
        @php
            if(isset($upsell)):
                $discount_total_price_color = $upsell['setting']['discount_total_price_color'];
            else:
                $discount_total_price_color = $setting['discount_total_price_color'];
            endif;
        @endphp
        color: {{ $discount_total_price_color }}!important;
    }
    .discount_badge_text_style{
        @php
            if(isset($upsell)):
                $discount_badge_text_color = $upsell['setting']['discount_badge_text_color'];
            else:
                $discount_badge_text_color = $setting['discount_badge_text_color'];
            endif;
        @endphp
        color: {{ $discount_badge_text_color }}!important;
    }
    .discount_badge_background_style{
        @php
            if(isset($upsell)):
                $discount_badge_background = $upsell['setting']['discount_badge_background'];
            else:
                $discount_badge_background = $setting['discount_badge_background'];
            endif;
        @endphp
        background-color: {{ $discount_badge_background }} !important;
    }
    .volum_bg1{
        @php
            if(isset($upsell)):
                $background_color = $upsell['setting']['background_color'];
            else:
                $background_color = $setting['background_color'];
            endif;
        @endphp
        background-color: {{ $background_color }} !important;
    }
    .volum_bg2{
        @php
            if(isset($upsell)):
                $background_color = $upsell['setting']['background_color'];
            else:
                $background_color = $setting['background_color'];
            endif;
        @endphp
        background-color: {{ $background_color }} !important;
    }
    .volum_bg3{
        @php
            if(isset($upsell)):
                $background_color = $upsell['setting']['background_color'];
            else:
                $background_color = $setting['background_color'];
            endif;
        @endphp
        background-color: {{ $background_color }} !important;
    }
    .live_p{
        @php
            if(isset($upsell)):
                $container_background_color = $upsell['setting']['container_background_color'];
            else:
                $container_background_color = $setting['container_background_color'];
            endif;
        @endphp
        background-color: {{ $container_background_color }} !important;
    }
    .alpha-upsell-deal-delete {
        margin-top: 35px;
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
    $(document).ready(function() {
    var count = 0;
    $(document).on('click','.addNewVolume',function(){
            count++;
            let addVolume;
            let appendVolume = '.pickVolume';
            addVolume = `<div class="row bg_hover volumeDiv">
                            <div class="offer_qty col-md-2">
                                <label>Quantity:</label><br>
                                <input type="number" value="{{ $upsellType->setting['quantity'] }}" min="1" name="quantity[]">
                            </div>
                            <div class="offer_disc col-md-3">
                                <label>Discount:</label><br>
                                <input type="number" value="{{ $upsellType->setting['discount'] }}" name="discount[]">
                                <select name="offer[]">
                                    <option value="{{ $upsellType->setting['offer'] }}" selected>% Off</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                </select>
                            </div>
                            <div class="offer_most col-md-7">
                                <div class="row">
                                <div class="col-md-6">
                                <label>Best Deal</label><br>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="hidden" class="class_two" name="bestdeal[]" value="0">
                                    <input type="checkbox" class="custom-control-input customValue" id="defaultInline1${count}">
                                    <label class="custom-control-label" for="defaultInline1${count}"></label>
                                </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <i class="far fa-trash-alt alpha-upsell-deal-delete" title="click to delete deal"></i>
                                </div>
                                </div>
                            </div>
                          </div>`;
                        $(`${appendVolume}`).append(addVolume);



       });
});

        $(function(){
            $(".colorpicker").each(function(index,element){
                new Picker(element).onChange = function(color) {
                    $(element).css({background : color.hex});
                    $(`input[name=${$(element).data('id')}]`).val(color.hex).trigger('change');
                };
            });
            $('input[name="volume_discount_heading"]').keyup(function(e){
                $('.volume_discount_heading_style').html($(this).val());
            });
            $('select[name="heading_font_family"]').change(function(e){
                setProperty('.volume_discount_heading_style',"font-family",`${$(this).val()}`);
            });
            $('input[name="heading_font_size"]').keyup(function(e){
                setProperty('.volume_discount_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_font_size"]').change(function(e){
                setProperty('.volume_discount_heading_style',"font-size",`${$(this).val()}px`);
            });
            $('input[name="heading_color"]').change(function(e){
                setProperty('.volume_discount_heading_style',"color",`${$(this).val()}`);
            });
            $('select[name="heading_align"]').change(function(e){
                setProperty('.volume_discount_heading_style',"text-align",`${$(this).val()}`);
            });
            $('input[name="quantity_color"]').change(function(e){
                setProperty('.quantity_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="best_deal_color"]').change(function(e){
                setProperty('.best_deal_color_style',"color",`${$(this).val()}`);
            });
            $('input[name="original_total_price_color"]').change(function(e){
                setProperty('.original_total_price_style',"color",`${$(this).val()}`);
            });
            $('input[name="discount_total_price_color"]').change(function(e){
                setProperty('.discount_total_price_style',"color",`${$(this).val()}`);
            });
            $('input[name="discount_badge_text_color"]').change(function(e){
                setProperty('.discount_badge_text_style',"color",`${$(this).val()}`);
            });
            $('input[name="discount_badge_background"]').change(function(e){
                setProperty('.discount_badge_background_style',"background-color",`${$(this).val()}`);
            });
            $('input[name="background_color"]').change(function(e){
                setProperty('.volum_bg',"background-color",`${$(this).val()}`);
            });
            $('input[name="container_background_color"]').on('change',function(){
                console.log('h')
                setProperty(".live_p","background-color",`${$(this).val()}`)
            });
            $(document).on('click',"#defaultInline0", function(){
               if ($("#defaultInline0").is(":checked")) {
                    $('#defaultInline0').val('1');
                } else {
                    $('#defaultInline0').val('0');
                }
            });
            // $(document).on('click',"#defaultInline1", function(){
            //    if ($("#defaultInline1").is(":checked")) {
            //         $('#defaultInline1').val('1');
            //     } else {
            //         $('#defaultInline1').val('0');
            //     }
            // });

            $(document).on('change','#defaultInline1', function(){
                if($(this).closest('.volumeDiv').find('[type=checkbox]').is(":checked"))
                {
                   $(this).closest('.volumeDiv').find('[type=hidden]').val('1');
                }
                else
                {
                    $(this).closest('.volumeDiv').find('[type=hidden]').val('0');
                }
             });

            // $(document).on('click',"#defaultInline2", function(){
            //    if ($("#defaultInline2").is(":checked")) {
            //         $('#defaultInline2').val('1');
            //     } else {
            //         $('#defaultInline2').val('0');
            //     }
            // });

            $(document).on('change','#defaultInline2', function(){
                if($(this).closest('.volumeDiv').find('[type=checkbox]').is(":checked"))
                {
                   $(this).closest('.volumeDiv').find('[type=hidden]').val('1');
                }
                else
                {
                    $(this).closest('.volumeDiv').find('[type=hidden]').val('0');
                }
             });

            // $(document).on('click',"#defaultInline3", function(){
            //    if ($("#defaultInline3").is(":checked")) {
            //         $('#defaultInline3').val('1');
            //     } else {
            //         $('#defaultInline3').val('0');
            //     }
            // });

            $(document).on('change','#defaultInline3', function(){
                if($(this).closest('.volumeDiv').find('[type=checkbox]').is(":checked"))
                {
                   $(this).closest('.volumeDiv').find('[type=hidden]').val('1');
                }
                else
                {
                    $(this).closest('.volumeDiv').find('[type=hidden]').val('0');
                }
             });

            $(document).on('change','.customValue', function(){
                if($(this).closest('.volumeDiv').find('[type=checkbox]').is(":checked"))
                {
                   $(this).closest('.volumeDiv').find('[type=hidden]').val('1');
                }
                else
                {
                    $(this).closest('.volumeDiv').find('[type=hidden]').val('0');
                }
             });
            $('.volum_bg1').hover(function(){
                    setProperty('.volum_bg1',"background-color",$('input[name="hover_background_color"]').val());
                },function(){
                    setProperty('.volum_bg1',"background-color",$('input[name="background_color"]').val());
            });
            $('.volum_bg2').hover(function(){
                    setProperty('.volum_bg2',"background-color",$('input[name="hover_background_color"]').val());
                },function(){
                    setProperty('.volum_bg2',"background-color",$('input[name="background_color"]').val());
            });
            $('.volum_bg3').hover(function(){
                    setProperty('.volum_bg3',"background-color",$('input[name="hover_background_color"]').val());
                },function(){
                    setProperty('.volum_bg3',"background-color",$('input[name="background_color"]').val());
            });


            $(document).on('click','.deleteVolume',function(){
                $(this).closest('.volumeDiv').remove();
            });


            $(document).on('click','.alpha-upsell-deal-delete',function() {
                if(document.querySelectorAll('.alpha-upsell-deal-delete').length > 1){
                    $(this).closest(".volumeDiv").remove();
                }

            });

            $(document).on('click','#end_date', function() {
               $('#end_date').css({'background-color': '#fffdfd'});
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
