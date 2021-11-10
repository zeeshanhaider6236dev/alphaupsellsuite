@push('componentCss')
	<style type="text/css">
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
        .top_head_post h3{
        	color: @if (isset($upsell))
                        {{ $upsell->setting['user_heading_text_color'] }} !important ;
                    @else
                        {{ $setting['user_heading_text_color'] }} !important ;
                    @endif;
        }
        span.price_3{
        	color: @if (isset($upsell))
                        {{ $upsell->setting['badge_color'] }} !important ;
                    @else
                        {{ $setting['badge_color'] }} !important ;
                    @endif;
        }
        .native-setting-btn{
            border: 1px solid gray !important;
            background: none !important;
            color: black !important;
        }
	</style>
@endpush

@push('componentJs')
	<script type="text/javascript">
        // ========================================
        $('input[name="native_post_purchase_heading"]').on('keyup',function(){
            $('.message1').html($(this).val());
        })
        $('#defaultCheckedDisabled2').change(function(e){
            if($(this).is(':checked')){
                $("#timer-hide-show").show();
                $('#defaultCheckedDisabled2').val(1);
            }else{
                $("#timer-hide-show").hide();
                $('#defaultCheckedDisabled2').val(0);
            }
        });
        $('input[name="time_limit_duration"]').on('keyup change',function(e){
            $('#timer-hide-show').html($(this).val()+':00');
        });
        $('select[name="font_size"]').change(function(e){
            if($(this).val() == "Large"){
                setProperty('.message1',"font-size",`17px`);
                setProperty('#timer-hide-show',"font-size",`17px`);
            }
            else{
                setProperty('.message1',"font-size",`16px`);
                setProperty('#timer-hide-show',"font-size",`16px`);
            }
        });
        $('select[name="text_align"]').change(function(e){
            if($(this).val() == "Center"){
                setProperty('.alignment',"justify-content",`center`);
            }
            else if($(this).val() == "Left"){
                setProperty('.alignment',"justify-content",`left`);
            }
            else if($(this).val() == "Right"){
                setProperty('.alignment',"justify-content",`right`);
            }
        });
        $('select[name="text_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.message1',"color",`black`);
                setProperty('#timer-hide-show',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.message1',"color",`red`);
                setProperty('#timer-hide-show',"color",`red`);	}
            else if($(this).val() == "Green"){
                setProperty('.message1',"color",`green`);
                setProperty('#timer-hide-show',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.message1',"color",`#b88700`);
                setProperty('#timer-hide-show',"color",`#b88700`);
            }
        });
        $('#defaultCheckedDisabled1').change(function(e){
            if($(this).is(':checked')){
                setProperty('.post_timer',"background",`#ededed`);
                $('#defaultCheckedDisabled1').val(1);
            }else{
                setProperty('.post_timer',"background",`none`);
                $('#defaultCheckedDisabled1').val(0);
            }
        });
        $('#defaultCheckedDisabled4').change(function(e){
            if($(this).is(':checked')){
                setProperty('.post_timer',"border",`1px solid #d6d6d6 `);
                $('#defaultCheckedDisabled4').val(1);
            }else{
                setProperty('.post_timer',"border",`none`);
                $('#defaultCheckedDisabled4').val(0);
            }
        });
        $('#defaultCheckedDisabled6').change(function(e){
            if($(this).is(':checked')){
                $('.native_quantity').show();
                $('#defaultCheckedDisabled6').val(1);
            }else{
                $('.native_quantity').hide();
                $('#defaultCheckedDisabled6').val(0);
            }
        });
        $('#defaultCheckedDisabled5').change(function(e){
            if($(this).is(':checked')){
                $('.native_variants' 	).show();
                $('#defaultCheckedDisabled5').val(1);
            }else{
                $('.native_variants').hide();
                $('#defaultCheckedDisabled5').val(0);
            }
        });
        $('select[name="user_heading_font_size"]').change(function(e){
            if($(this).val() == "Large"){
                setProperty('.native_user_msg',"font-size",`17px`);
            }
            else{
                setProperty('.native_user_msg',"font-size",`16px`);
            }
        });
        $('select[name="user_heading_text_align"]').change(function(e){
            if($(this).val() == "Center"){
                setProperty('.native_user_msg',"text-align",`center`);
            }
            else if($(this).val() == "Left"){
                setProperty('.native_user_msg',"text-align",`left`);
            }
            else if($(this).val() == "Right"){
                setProperty('.native_user_msg',"text-align",`right`);
            }
        });
        $('select[name="user_heading_text_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.native_user_msg',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.native_user_msg',"color",`red`);
            }
            else if($(this).val() == "Green"){
                setProperty('.native_user_msg',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.native_user_msg',"color",`#b88700`);
            }
        });
        $('select[name="text_font_size"]').change(function(e){
            if($(this).val() == "Large"){
                setProperty('.native_user_tag_line',"font-size",`17px`);
            }
            else{
                setProperty('.native_user_tag_line',"font-size",`16px`);
            }
        });
        $('select[name="text_heading_align"]').change(function(e){
            if($(this).val() == "Center"){
                setProperty('.native_user_tag_line',"text-align",`center`);
            }
            else if($(this).val() == "Left"){
                setProperty('.native_user_tag_line',"text-align",`left`);
            }
            else if($(this).val() == "Right"){
                setProperty('.native_user_tag_line',"text-align",`right`);
            }
        });
        $('select[name="text_heading_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.native_user_tag_line',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.native_user_tag_line',"color",`red`);
            }
            else if($(this).val() == "Green"){
                setProperty('.native_user_tag_line',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.native_user_tag_line',"color",`#b88700`);
            }
        });
        $('textarea[name="user_welcome_msg"]').on('keyup',function(){
            $('.native_user_msg').html($(this).val().replaceAll('{customer.Name}','David'));
        });
        $('textarea[name="text_tagline_message"]').on('keyup',function(){
            $('.native_user_tag_line').html($(this).val().replaceAll('{customer.Name}','David'));
        });
        $('select[name="price_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.price_2',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.price_2',"color",`red`);
            }
            else if($(this).val() == "Green"){
                setProperty('.price_2',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.price_2',"color",`#b88700`);
            }
        });
        $('select[name="compare_at_price_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.price_1	',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.price_1	',"color",`red`);
            }
            else if($(this).val() == "Green"){
                setProperty('.price_1	',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.price_1	',"color",`#b88700`);
            }
        });
        $('select[name="badge_color"]').change(function(e){
            if($(this).val() == "Default"){
                setProperty('.price_3	',"color",`black`);
            }
            else if($(this).val() == "Red"){
                setProperty('.price_3	',"color",`red`);
            }
            else if($(this).val() == "Green"){
                setProperty('.price_3	',"color",`green`);
            }
            else if($(this).val() == "Yellow"){
                setProperty('.price_3	',"color",`#b88700`);
            }
        });
        $('input[name="accept_offer_text"]').on('keyup',function(){
            $('.pay_btn').val($(this).val()+' . $89.99');
        });
        $('input[name="decline_offer_text"]').on('keyup',function(){
            $('.decline').val($(this).val());
        });

        $('.aus_cross_icon').on('click',function(){
            $(this).parent().parent().hide();
        });
        // ========================================
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
	            // upsell_add_route = "{{ route('upsell.store',$upsellType) }}";
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
	</script>
@endpush
