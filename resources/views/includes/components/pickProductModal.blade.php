 @push('componentCss')
    <style>
        .save[disabled],.cancel[disabled] {
            cursor: not-allowed;
        }

        .alpha_model_content{
            height: 100vh !important;
        }

        /* .modal-content.select_model{
            width: 60% !important;
            height: 100% !important;


        }
        .container.tab-pane.active{
            height: auto !important;

        }
        .product_search{
            max-height: unset !important;
        } */
    </style>
 @endpush
 <div id="product_modal" class="modal fade" role="dialog">
    <div class="modal-dialog alpha_model_dialog">
        <!-- Modal content-->
        <div class="modal-content select_model alpha_model_content" >
            <div class="modal-header">
                <h4 class="modal-title">Select Products</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body alpha_upsell_model_picker">
                <!-------------Tabs--------------->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#p-1" data-type="products">
                            <i class="fa fa-snowflake-o"></i>Product
                        </a>
                    </li>
                    @if($upsellType->name != "Native Post Purchase")
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#p-2" data-type="collections">
                                <i class="fa fa-server"></i>
                                Collections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#p-3" data-type="tags">
                                <i class="fa fa-hashtag"></i>
                                Tags
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content alpha_tab_content">
                    <!----------------------Tab-1--------------------->
                    <div id="p-1" data-type="products" class="container tab-pane active"><br>
                        <div class="form-group">
                            <div class="search">
                                <span class="search_wrapper">
                                    <input class="searchField" placeholder="Search Products">
                                    <span class="search_icon">
                                        <i class="fa fa-search text-primary searchButton"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <!----------search-close------------------>
                        <div class="productSearchBox">
                            <div class="productOverlay">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <ul class="product_search">
                            </ul>
                        </div>
                    </div>
                    <!----------------------Tab-2--------------------->
                    <div id="p-2" data-type="collections" class="container tab-pane fade"><br>
                        <div class="form-group">
                            <div class="search">
                                <span class="search_wrapper">
                                    <input class="searchField" placeholder="Search Collections">
                                    <span class="search_icon">
                                        <i class="fa fa-search text-primary searchButton"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <!----------search-close------------------>
                        <div class="productSearchBox">
                            <div class="productOverlay">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <ul class="product_search">
                            </ul>
                        </div>
                    </div>
                    <!----------------------Tab-3--------------------->
                    <div id="p-3" data-type="tags" class="container tab-pane fade"><br>
                        <div class="form-group">
                            <div class="search">
                                <span class="search_wrapper">
                                    <input class="searchField" placeholder="Search Tags">
                                    <span class="search_icon">
                                        <i class="fa fa-search text-primary searchButton"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <!----------search-close------------------>
                        <div class="productSearchBox">
                            <div class="productOverlay">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <ul class="product_search">
                            </ul>
                        </div>
                    </div>
                    <!----------tabs-close------------------>
                </div>
                <!-------------Tabs-close--------------->
            </div>
            <div class="modal-footer">
                <button type="button" class="save selectProduct">Select Product</button>
                <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
 @push('componentJs')
    <script>
        let container = ".pickedTriggerOn";
        let inputkey = "T";
        $(".pickTProduct").click(function(){
            $(".searchField").val('');
            container = ".pickedTriggerOn";
            inputkey = "T";
            search();
        });
        $(".pickAProduct").click(function(){
            $(".searchField").val('');
            container = ".pickedAppearOn";
            inputkey = "A";
            search();
        });
        $(".pickDProduct").click(function(){
            $(".searchField").val('');
            container = ".pickedDownSell";
            inputkey = "D";
            search();
        });
        $(document).on('click','.page-link',function(e){
            e.stopPropagation();
            e.preventDefault(true);
            search($(this));
        });
        $('.searchField').on('keyup', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var keyCode = e.keyCode;
            (e.keyCode === 13 || $(this).val() == '' ) ? search() : '';
            return true;
        });
        $(".searchButton").click(function(){
            search();
        });
        function search(element = null){
            let selector = $("#product_modal .tab-pane.active");
            $(selector).find('.product_search').html('');
            $(selector).find('.productOverlay').show();
            let tabValues = $(`${container} input[name="${inputkey+$(selector).data('type')}[]"]`).map(function(){return $(this).val();}).get();
            let url = element ? $(element).attr('href') : `{{ route('search',['','']) }}/${$(selector).data('type')}?query=${$(selector).find('.searchField').val()}&tabValues=${tabValues.join(',')}`;
            ajaxRequest(url,function(response){
                $(selector).find('.productOverlay').hide();
                $(selector).find('.product_search').html(response);
            });
        }
        $("#product_modal .nav-tabs a").on('shown.bs.tab',function(){
            search();
        });
        $("#product_modal .nav-tabs a").on('hide.bs.tab',function(){
            $(`#product_modal .tab-pane[data-type="${$(this).data('type')}"]`).find('.product_search').html('');
        });
        $(".selectProduct").on('click',function(e){
            processModal();
        }); 
        function processModal(){
            $("#product_modal").modal('show');
            let selector = $("#product_modal .tab-pane.active");
            let type = $(selector).data('type');
            let inputName = "";
            let productssCount = $(`${container} input[name="${inputkey}products[]"]`).length;
            let collectionsCount = $(`${container} input[name="${inputkey}collections[]"]`).length;
            let tagsCount = $(`${container} input[name="${inputkey}tags[]"]`).length;
            let flag = false;
            switch (type) {
                case 'collections':
                    (productssCount || tagsCount) ? flag = true : '';
                    inputName = 'collections'
                    break;
                case 'tags':
                    (productssCount || collectionsCount) ? flag = true : '';
                    inputName = 'tags'
                    break;            
                default:
                    (collectionsCount || tagsCount) ? flag = true : '';
                    inputName = "products";
                    break;
            }
            if(flag){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: "You Can Only Add Products From One Category For A Single Upsell.",
                });
                return;
            }
            let html = "";
            $('.customchkbox:checked').each(function(index,element){
                let flag2 = false;
                $(`${container} input[name="${inputkey+type}[]"]`).each(function(index){
                    ($(this).val() == $(element).val()) ? flag2 = true : '';                    
                });
                if(flag2){
                    return;
                }
                let parent = $(element).closest('.product_label');
                html += `<div class="box_shado mt">
                            <input class="tabValues" type="hidden" name="${inputkey+inputName}[]" value="${$(element).val()}"/>
                            <input class="tabValues" type="hidden" name="${inputkey+inputName}images[]" value="${$(parent).find('.product_img img').attr('src')}"/>
                            <input class="tabValues" type="hidden" name="${inputkey+inputName}titles[]" value="${$(parent).find('.product_title').html()}"/>
                            <div class="row">
                                <div class="img_box col-md-2">
                                    <img src="${$(parent).find('.product_img img').attr('src')}">
                                </div>
                                <div class="img_name col-md-8">
                                    <p>
                                        ${$(parent).find('.product_title').html()}
                                    </p>
                                </div>
                                <div class="img_btn col-md-2">
                                    <button type="button" class="delete float-right deleteItem">Delete</button>
                                </div>
                            </div>
                        </div>`;
            });
            $(`${container}`).append(html);
            $("#product_modal").modal('hide');
        }
        $(document).on('click','.deleteItem',function(){
            $(this).closest('.box_shado').remove();
        });
        $(document).on('click','.removeAll',function(){
            $(this).closest('.select_bg').find('.itemContainer').empty();
        });

        $(".autoButton").click(function(){
            if($(this).hasClass('autoTrue')){
                $(this).toggleClass(["autoTrue",'delete','save']);
                $(".pickAProduct").prop('disabled',false);
                $(".pickAProduct+.removeAll").prop('disabled',false);
                $(".autoHidden").val("0");
            }else{
                $(this).toggleClass(["autoTrue",'delete','save']);
                $(".pickAProduct").prop('disabled',true);
                $(".pickAProduct+.removeAll").prop('disabled',true);
                $(".pickedAppearOn").empty();
                $(".autoHidden").val("1");
            }
        });
    </script>
 @endpush