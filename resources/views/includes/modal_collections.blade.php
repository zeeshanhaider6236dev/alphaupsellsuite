@foreach ($collections as $collect)
    <li class="product_search_item">
        <label class="product_label col_pad">
            <input class="customchkbox selectorClass" {{ in_array(str_replace(config('shopifyApi.strings.graphQlCollectionIdentifier'),'',$collect['node']['id']),$tabValues) ? 'checked' : ''  }} type="checkbox" value="{{ str_replace(config('shopifyApi.strings.graphQlCollectionIdentifier'),'',$collect['node']['id']) }}">
            <div class="product_info">
                <div style="" class="product_img">
                    <img src="{{ optional($collect['node']['image'])['src']  ? $collect['node']['image']['src'] : asset('assets/img/collection.jpg') }}">
                </div>
                <p class="product_title">{{ $collect['node']['title'] }}</p>
            </div>
        </label>
    </li>
@endforeach
<li>
    <div class="pagination justify-content-center my-2 pagination-sm">
        @if($links != null)
            @if ($links['hasPreviousPage'])
                <a href="{{ route('search',[$tabType,$collections[0]['cursor'],'before'])."?query=".$query."&tabValues=".implode(',',$tabValues) }}" class="page-link prodLink" >« Previous</a>    
            @endif
            @if ($links['hasNextPage'])
                <a href="{{ route('search',[$tabType,$collections[count($collections)-1]['cursor']])." ?query=".$query."&tabValues=".implode(',',$tabValues) }}" class="page-link prodLink" >Next »</a>
            @endif
        @endif
    </div>
</li>
