<!-- <div class="design_inpage">
    <div class="p_upsell">
        <div class="timer_title">
            <p>15% OFF! Timer until the offer expires:</p>
        </div>
        <div class="in_page_product">
            <div class="upsell_img">
                <img src="{{$product_image}}" alt="cream">
            </div>
            <div class="upsell_title">
                <h4>{{Illuminate\Support\Str::limit($product_title,40)}}</h4>
                <select name="product_variants">
                    @foreach($aProductValues as $aProductValue)
                        <option value="{{$aProductValue['node']['id']}}">{{$aProductValue['node']['title']}}</option>
                    @endforeach
                </select>
                <p>$25.00 <span>$35.00</span></p>
            </div>
            <div class="upsell_btn">
                <input type="button" value="Add To Cart">
            </div>
        </div>
    </div>
</div> -->