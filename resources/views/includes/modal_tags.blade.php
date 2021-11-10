@foreach ($tags as $tag)
    <li class="product_search_item">
        <label class="product_label col_pad">
            <input class="customchkbox selectorClass" {{ in_array($tag['node'],$tabValues) ? 'checked' : ''  }}  type="checkbox" value="{{ $tag['node'] }}">
            <div class="product_info">
                <div style="" class="product_img">
                    <img src="{{ asset('assets/img/tag2.png') }}">
                </div>
                <p class="product_title">{{ $tag['node'] }}</p>
            </div>
        </label>
    </li>
@endforeach
<li>
    <div class="pagination justify-content-center my-2 pagination-sm">
        {{ $tags->appends(['query' => $query , 'tabValues' => implode(',',$tabValues)])->links() }}
    </div>
</li>
