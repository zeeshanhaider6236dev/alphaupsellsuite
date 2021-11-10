<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 top">
            <a href="{{ route('home').'?tab=menu1' }}"><i class="fa fa-angle-left"></i>Offers</a>
            <div class="row">
                <div class="col-md-7 top_left">
                    @if (isset($upsell))
                        <h3>Update an offer</h3>
                    @else
                        <h3>Create an offer</h3>
                    @endif
                </div>
                <div class="col-md-5 top_right">
                    <a href="{{ route('home').'?tab=menu1' }}" class="cancel">Cancel</a>
                    @isset($upsell)
                        <button type="button" class="save updateUpsell">Update</button>
                    @else
                        <button type="button" class="save saveUpsell">Save</button>
                    @endisset
                </div>
            </div>
        </div>  
    </div>
</div>