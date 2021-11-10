@foreach ($products as $key => $product)
    <li class="product_search_item">
        <label class="product_label">
            <input class="customchkbox selectorClass" {{ in_array(str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product['node']['id']),$tabValues) ? 'checked' : ''  }} type="checkbox" value="{{ str_replace(config('shopifyApi.strings.graphQlProductIdentifier'),'',$product['node']['id']) }}">
            <div class="product_info">
                <div style="" class="product_img">
                    <img src="{{ optional($product['node']['featuredImage'])['src']  ? $product['node']['featuredImage']['src'] : asset('assets/img/defaultpic.png') }}">
                </div>
                <p class="product_title">{{ $product['node']['title'] }}
                </p>
            </div>
        </label>
    </li>
@endforeach
<li>
    <div class="pagination justify-content-center my-2 pagination-sm">
        @if($links != null)
            @if ($links['hasPreviousPage'])
                <a href="{{ route('search',[$tabType,$products[0]['cursor'],'before'])."?query=".$query."&tabValues=".implode(',',$tabValues) }}" class="page-link prodLink" >« Previous</a>    
            @endif
            @if ($links['hasNextPage'])
                <a href="{{ route('search',[$tabType,$products[count($products)-1]['cursor']])."?query=".$query."&tabValues=".implode(',',$tabValues) }}" class="page-link prodLink" >Next »</a>
            @endif
        @endif
    </div>
</li>
