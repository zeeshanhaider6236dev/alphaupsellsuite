{{-- @dd( $upsellType->setting['work_on_desktop']) --}}
@extends('vendor.shopify-app.layouts.default')
@section('content')
@include('includes.upsell_header')
<div class="container-fluid">
	<div class="container">
		<div class="col-md-12 tabs">
			<div class="tabs">
				<div class="tab_bg">
					<form class="upsellForm">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#home">
                                    <i class="fas fa-cogs"></i>Configuration
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#menu1">
									<i class="fa fa-image"></i>Preview
								</a>
							</li>
							<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu-fbt-video">
                                <i class="fas fa-video"></i>Video Guide
                                </a>
                            </li>
						</ul>
						<!----------------Tab-panes----------------->
						<div class="tab-content mt-3">
							<div id="home" class="tab-pane active">
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Offer Name</h4>
											<p>This is an internal name and won't appear on the frontend.</p>
										</div>
										<div class="col-md-7 offer_right">
											<label>Name:</label><br>
											<input type="text" placeholder="Enter Offer Name...!!" id="offer_name" name="name" @isset($upsell) value = "{{ $upsell->name }}"@endisset>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Select Target Products</h4>
											<p>
											Target products are those products, on which you want to show an offer. When an order of customer is completed, then an offer will be shown on those products.
											</p>
										</div>
										<div class="col-md-7 offer_right select_bg">
											<div class="row mt-2">
												<div class="col-md-4 select_left">
													<h3>Upsell will Trigger on...</h3>
												</div>
												<div class="col-md-8 select_right">
													<button type="button" class="save pickTProduct" data-toggle="modal"
														data-target="#product_modal">Pick a Product</button>
													<button type="button" class="cancel removeAll">Remove All</button>
												</div>
											</div>
											<hr>
											<div class="pickedTriggerOn itemContainer">
												@isset($upsell)
                                                    @if($upsell->Tproducts->count())
                                                        @foreach ($upsell->Tproducts as $tProduct)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Tproducts[]" value="{{ $tProduct->shopify_product_id }}">
                                                                <input class="tabValues" type="hidden" name="Tproductsimages[]" value="{{ $tProduct->shopify_product_image }}">
                                                                <input class="tabValues" type="hidden" name="Tproductstitles[]" value="{{ $tProduct->shopify_product_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{  $tProduct->shopify_product_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{  $tProduct->shopify_product_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Tcollections->count())
                                                        @foreach ($upsell->Tcollections as $tCollection)
                                                            <input class="tabValues" type="hidden" name="Tcollections[]" value="{{ $tCollection->shopify_collection_id }}">
                                                            <input class="tabValues" type="hidden" name="Tcollectionsimages[]" value="{{ $tCollection->shopify_collection_image }}">
                                                            <input class="tabValues" type="hidden" name="Tcollectionstitles[][]" value="{{ $tCollection->shopify_collection_title }}">

                                                            <div class="box_shado mt">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{  $tCollection->shopify_collection_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{  $tCollection->shopify_collection_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Ttags->count())
                                                        @foreach ($upsell->Ttags as $tTags)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Ttags[]" value="{{ $tTags->shopify_tag_id }}">
                                                                <input class="tabValues" type="hidden" name="Ttagsimages[]" value="{{ $tTags->shopify_tag_image }}">
                                                                <input class="tabValues" type="hidden" name="Ttagstitles[]" value="{{ $tTags->shopify_tag_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{  $tTags->shopify_tag_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{  $tTags->shopify_tag_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endisset
											</div>
										</div>
									</div>
								</div>
								<div class="container upsel_p">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Select Upsell Products</h4>
											<p>
											Upsell products are those products, which you want to show in the offer. When customers will add targeted product to order, then upsell products will be shown on thank you page.
											</p>
										</div>
										<div class="col-md-7 offer_right select_bg">
											<div class="row mt-2">
												<div class="col-md-4 select_left">
													<h3>Upsell will Appear on...</h3>
												</div>
												<div class="col-md-8 select_right">
													<input class="autoHidden" type="hidden" name="auto" value="0">
													<button type="button" class="save pickAProduct" data-toggle="modal"
														data-target="#product_modal">Pick a Product</button>
													<button type="button" class="cancel removeAll">Remove All</button>
												</div>
											</div>
											<hr>
											<div class="pickedAppearOn itemContainer">
												 @isset($upsell)
                                                    @if($upsell->Aproducts->count())
                                                        @foreach ($upsell->Aproducts as $aProduct)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Aproducts[]" value="{{ $aProduct->shopify_product_id }}">
                                                                <input class="tabValues" type="hidden" name="Aproductsimages[]" value="{{ $aProduct->shopify_product_image }}">
                                                                <input class="tabValues" type="hidden" name="Aproductstitles[]" value="{{ $aProduct->shopify_product_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aProduct->shopify_product_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aProduct->shopify_product_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Acollections->count())
                                                        @foreach ($upsell->Acollections as $aCollection)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Acollections[]" value="{{ $aCollection->shopify_collection_id }}">
                                                                <input class="tabValues" type="hidden" name="Acollectionsimages[]" value="{{ $aCollection->shopify_collection_image }}">
                                                                <input class="tabValues" type="hidden" name="Acollectionstitles[]" value="{{ $aCollection->shopify_collection_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aCollection->shopify_collection_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aCollection->shopify_collection_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @elseif($upsell->Atags->count())
                                                        @foreach ($upsell->Atags as $aTags)
                                                            <div class="box_shado mt">
                                                                <input class="tabValues" type="hidden" name="Atags[]" value="{{ $aTags->shopify_tag_id }}">
                                                                <input class="tabValues" type="hidden" name="Atagsimages[]" value="{{ $aTags->shopify_tag_image }}">
                                                                <input class="tabValues" type="hidden" name="Atagstitles[]" value="{{ $aTags->shopify_tag_title }}">
                                                                <div class="row">
                                                                    <div class="img_box col-md-2">
                                                                        <img src="{{ $aTags->shopify_tag_image }}">
                                                                    </div>
                                                                    <div class="img_name col-md-8">
                                                                        <p>{{ $aTags->shopify_tag_title }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="img_btn col-md-2">
                                                                        <button type="button" class="delete float-right deleteItem">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endisset
											</div>
										</div>
									</div>
								</div>
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Discount Details</h4>
											<p>Choose the discount type here whether you want to apply discount in percentage, a fix price or no discount.</p>
										</div>
										<div class="col-md-7 offer_right">
											<div class="row">
												<div class="col-md-6 discount_left">
													<label>Discount Type:</label><br>
													<select name="discount_price_option">
														<option
															@if(isset($upsell))
                                                                {{ $upsell->setting['discount_price_option'] == "% Off" ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['upsell_discount_type'] == "% Off" ? "selected" : '' }}
                                                            @endif
															value="% Off">% Off
														</option>
														<option
															@if(isset($upsell))
                                                                {{ $upsell->setting['discount_price_option'] == "Fixed Price Off" ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['upsell_discount_type'] == "Fixed Price Off" ? "selected" : '' }}
                                                            @endif
															value="Fixed Price Off">Fixed Price Off
														</option>
														<option
															@if(isset($upsell))
                                                                {{ $upsell->setting['discount_price_option'] == "No Discount" ? "selected" : '' }}
                                                            @else
                                                                {{ $upsellType->setting['upsell_discount_type'] == "No Discount" ? "selected" : '' }}
                                                            @endif
															values="No Discount">No Discount
														</option>
													</select>
												</div>
												<div class="col-md-6 discount_left">
													<label>Discount Value:</label><br>
													<input type="number" value=
														@if(isset($upsell))
															"{{$upsell->setting['upsell_discount']}}"
														@else
															"{{$upsellType->setting['upsell_discount']}}"
														@endif
														min="0" name="upsell_discount">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Optional Settings</h4>
											<p></p>
										</div>
										<div class="col-md-7 select_bg display">
											<h4>Work on device:</h4>
											<p>
												<div class="row">
													<div class="form-check form_float ml-3">
														<input
															@if(isset($upsell))
																{{ $upsell->setting['work_on_desktop']  ? "checked" : '' }}
															@else
																{{ $upsellType->setting['work_on_desktop']  ? "checked" : '' }}
															@endif
															name="work_on_desktop" type="checkbox" class="form-check-input" id="formCheck-1"
															style="height: 20px;" class="work_on_desktop" value="1" checked>
														<label class="form-check-label" for="formCheck-1">Desktop</label>
													</div>
													<div class="form-check form_float">
														<input
															@if(isset($upsell))
																{{ $upsell->setting['work_on_mobile']  ? "checked" : '' }}
															@else
																{{ $upsellType->setting['work_on_mobile']  ? "checked" : '' }}
															@endif
															name="work_on_mobile" type="checkbox" class="form-check-input" id="formCheck-3"
															style="height: 20px;" class="work_on_mobile" value="1" checked>
														<label class="form-check-label" for="formCheck-3">Mobile</label>
													</div>
												</div>
											</p>
											<hr>
											<h4>Schedule:</h4>
											<div class="row">
												<div class="col-md-6 discount_left">
													<label>Start Date:</label><br>
													<input value=
														@if(isset($upsell))
															"{{ $upsell->setting['start_date']}}"
														@else
															"{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
														@endif
														name="start_date" type="date">
												</div>
												<div class="col-md-6 discount_left">
													<label>End Date:</label><br>
													<input class="end_date"	name="end_date" type="date" style="background-color: #dadada;">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-------------------tab-1-close--------------------->
							<div id="menu1" class="tab-pane fade p-0"><br>
								<div class="container-fluid">
									<div class="container">
										<div class="row">
											<div class="col-md-6">
												<div class="design_input">
													<h3>Title</h3>
													<p class="h_input">
														<label>Heading</label><br>
														<input type="text" value=
														@if(isset($upsell))
															"{{ $upsell->setting['ppu_heading'] }}"
														@else
															"{{ $upsellType->setting['ppu_heading'] }}"
														@endif
														name="ppu_heading" type="text" placeholder="15% OFF! Timer until the offer expires:">
													</p>
													<div class="col-md-12 font">
														<div class="row">
															<p class="f_input">
																<label>Font family</label><br>
																<select name="heading_font_family">
																	@foreach (config('upsell.strings.fontFamily') as $family)
																		<option
																		@if(isset($upsell))
																			{{ $upsell->setting['heading_font_family'] == $family ? "selected" : '' }}
																		@else
																			{{ $upsellType->setting['heading_font_family'] == $family ? "selected" : '' }}
																		@endif
																		 value="{{ $family }}">
																			{{ $family }}
																		</option>
																	@endforeach
																</select>
															</p>
															<p class="f_input">
																<label>Font Size</label><br>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['heading_font_size'] }}"
																	@else
																		"{{ $upsellType->setting['heading_font_size'] }}"
																	@endif
																	name="heading_font_size" type="number" value="22" min="12">
															</p>
														</div>
													</div>
													<div class="col-md-12 font">
														<div class="row">
															<div class="f_input_color">
																<label>Color</label><br>
																<a href="#" data-id="heading_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['heading_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['heading_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['heading_color'] }}"
																	@else
																		"{{ $upsellType->setting['heading_color'] }}"
																	@endif
																	type="hidden" name="heading_color">
																<p>Text Color </p>
															</div>
															<p class="f_input">
																<label>Text Align</label><br>
																<select name="heading_align">
																	<option
																		@if(isset($upsell))
																			{{ $upsell->setting['heading_align'] == "left" ? "selected" : '' }}
																		@else
																			{{ $upsellType->setting['heading_align'] == "left" ? "selected" : '' }}
																		@endif
																		value="left">Left
																	</option>
																	<option
																		@if(isset($upsell))
																			{{ $upsell->setting['heading_align'] == "center" ? "selected" : '' }}
																		@else
																			{{ $upsellType->setting['heading_align'] == "center" ? "selected" : '' }}
																		@endif
																		value="center">Center
																	</option>
																	<option
																		@if(isset($upsell))
																			{{ $upsell->setting['heading_align'] == "right" ? "selected" : '' }}
																		@else
																			{{ $upsellType->setting['heading_align'] == "right" ? "selected" : '' }}
																		@endif
																		value="right">Right
																		</option>
																</select>
															</p>
														</div>
													</div>
													<h3>Countdown Sales Timer</h3>
													<div class="custom-control custom-checkbox">
														<input name="time_limit_toggler" type="checkbox" class="custom-control-input" id="defaultCheckedDisabled2"
														@if(isset($upsell))
															{{$upsell->setting['time_limit_toggler']== 1 ? "checked" : ''}}
														@else
															{{$upsellType->setting['time_limit']== 1 ? "checked" : ''}}
														@endif
														value=
														@if(isset($upsell))
															"{{$upsell->setting['time_limit_toggler']}}"
														@else
															"{{$upsellType->setting['time_limit']}}"
														@endif
														>
														<label class="custom-control-label" for="defaultCheckedDisabled2">Add a Time Limit To The Offer</label>
													</div>

														<p class="h_input">
														<label> Timer Text</label><br>
														<input type="text" name="thank_you_timer_text" value=
                                                        @if(isset($upsell))
                                                            "{{$upsell->setting['thank_you_timer_text']}}"
                                                        @else
                                                            "{{$upsellType->setting['thank_you_timer_text']}}"
                                                        @endif
                                                        />
														</p>
														<div class="col-md-12 font">
														<div class="row">
														<div class="f_input_color">
																<a href="#" data-id="thank_you_timer_text_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['thank_you_timer_text_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['thank_you_timer_text_color'] }};"
																	@endif
																>
																</a>
																<input name="thank_you_timer_text_color" type="hidden" value=
                                                                    @if(isset($upsell))
                                                                        "{{ $upsell->setting['thank_you_timer_text_color'] }} "
                                                                    @else
                                                                        "{{ $upsellType->setting['thank_you_timer_text_color'] }} "
                                                                    @endif
                                                                />
																<p>Timer Text Color </p>
														</div>
														<div class="f_input_color">
																<a href="#" data-id="thank_you_timer_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['thank_you_timer_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['thank_you_timer_color'] }};"
																	@endif
																>
																</a>
																<input name="thank_you_timer_color" type="hidden" value=
                                                                @if(isset($upsell))
                                                                    "{{$upsell->setting['thank_you_timer_color']}}"
                                                                @else
                                                                    "{{$upsellType->setting['thank_you_timer_color']}}"
                                                                @endif
                                                                />
																<p>Timer Color </p>
														</div>
														<div class="f_input_color">
																<a href="#" data-id="thank_you_timer_text_bg_color" class="buttoncolor colorpicker" style=
                                                                    @if(isset($upsell))
                                                                        "background-color:{{ $upsell->setting['thank_you_timer_text_bg_color'] }};"
                                                                    @else
                                                                        "background-color:{{ $upsellType->setting['thank_you_timer_text_bg_color'] }};"
                                                                    @endif
                                                                >
																</a>
																<input name="thank_you_timer_text_bg_color" type="hidden" value=
                                                                @if(isset($upsell))
                                                                    "{{$upsell->setting['thank_you_timer_text_bg_color']}}"
                                                                @else
                                                                    "{{$upsellType->setting['thank_you_timer_text_bg_color']}}"
                                                                @endif
                                                                />
																<p>Timer background Color </p>
														</div>

													</div>
													</div>
													<p class="h_input">
														<label>Timer Duration In Minutes</label><br>
														<input type="number" name="timer_duration" value=
															@if(isset($upsell))
																"{{$upsell->setting['timer_duration']}}"
															@else
																"{{$upsellType->setting['timer_duration']}}"
															@endif
															name="timer_duration">
													</p>
													<div class="col-md-12 font">
														<div class="row">
															<p class="f_input">
																<label>Font family</label><br>
																<select name="timer_font_family">
																	@foreach (config('upsell.strings.fontFamily') as $family)
																		<option
																			@if(isset($upsell))
																				{{ $upsell->setting['timer_font_family'] == $family ? "selected" : '' }}
																			@else
																				{{ $upsellType->setting['timer_font_family'] == $family ? "selected" : '' }}
																			@endif
																			value="{{ $family }}">
																			{{ $family }}
																		</option>
																	@endforeach
																</select>
															</p>
															<p class="f_input">
																<label>Font Size</label><br>
																<input type="number" value=
																	@if(isset($upsell))
																		"{{$upsell->setting['timer_font_size']}}"
																	@else
																		"{{$upsellType->setting['timer_font_size']}}"
																	@endif
																	min="12" name="timer_font_size">
															</p>
														</div>
													</div>
													<h3 class="mt-4">Translation</h3>
													<p class="h_input">
														<label>Button Text</label><br>
														<input type="text" value=
															@if(isset($upsell))
																"{{$upsell->setting['ppu_button_text']}}"
															@else
																"{{$upsellType->setting['button_text']}}"
															@endif
															name="ppu_button_text">
													</p>
													<div class="col-md-12">
														<div class="row">
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" name="show_ppu_product_title" id="defaultCheckedDisabled5"
																	@if(isset($upsell))
																		{{$upsell->setting['show_ppu_product_title']==1 ? 'checked':''}}
																	@else
																		{{$upsellType->setting['show_product_title']==1 ? 'checked':''}}
																	@endif
																	value=
																	@if(isset($upsell))
																		"{{$upsell->setting['show_ppu_product_title']}}"
																	@else
																		"{{$upsellType->setting['show_product_title']}}"
																	@endif
																	>
																<label class="custom-control-label" for="defaultCheckedDisabled5">Show Product Title</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" value=
																	@if(isset($upsell))
																		"{{$upsell->setting['show_ppu_varient_selection']}}"
																	@else
																		"{{$upsellType->setting['show_varient_selection']}}"
																	@endif
																	class="custom-control-input" id="defaultCheckedDisabled3" name ="show_ppu_varient_selection"
																	@if(isset($upsell))
																		{{$upsell->setting['show_ppu_varient_selection']==1 ? 'checked':''}}
																	@else
																		{{$upsellType->setting['show_varient_selection']==1 ? 'checked':''}}
																	@endif
																	>
																<label class="custom-control-label" for="defaultCheckedDisabled3">Show Variant Selection</label>
															</div>
														</div>
													</div>
													<h3 class="mt-4">Color Settings</h3>
													<div class="col-md-12 font">
														<div class="row">
															<div class="f_input_color mt-3">
																<a href="#" data-id="product_title_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['product_title_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['product_title_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['product_title_color'] }}"
																	@else
																		"{{ $upsellType->setting['product_title_color'] }}"
																	@endif
																	type="hidden" name="product_title_color">
																<p>Product Title </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="my_upsell_background_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['my_upsell_background_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['upsell_background_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['my_upsell_background_color'] }}"
																	@else
																		"{{ $upsellType->setting['upsell_background_color'] }}"
																	@endif
																 type="hidden" name="my_upsell_background_color">
																<p>Upsell Background </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="sale_price_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['sale_price_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['sale_price_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['sale_price_color'] }}"
																	@else
																		"{{ $upsellType->setting['sale_price_color'] }}"
																	@endif
																	type="hidden" name="sale_price_color">
																<p>Sale Price </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="discount_text_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['discount_text_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['discount_text_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['discount_text_color'] }}"
																	@else
																		"{{ $upsellType->setting['discount_text_color'] }}"
																	@endif
																	type="hidden" name="discount_text_color">
																<p>Discount Text </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="discount_background_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['discount_background_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['discount_background_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['discount_background_color'] }}"
																	@else
																		"{{ $upsellType->setting['discount_background_color'] }}"
																	@endif
																	type="hidden" name="discount_background_color">
																<p>Discount Background </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="button_border_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['button_border_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['button_border_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['button_border_color'] }}"
																	@else
																		"{{ $upsellType->setting['button_border_color'] }}"
																	@endif
																	type="hidden" name="button_border_color">
																<p>Button Border Color</p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="button_text_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['button_text_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['button_text_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['button_text_color'] }}"
																	@else
																		"{{ $upsellType->setting['button_text_color'] }}"
																	@endif
																	type="hidden" name="button_text_color">
																<p>Button Text</p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="button_hover_text_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['button_hover_text_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['button_hover_text_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['button_hover_text_color'] }}"
																	@else
																		"{{ $upsellType->setting['button_hover_text_color'] }}"
																	@endif
																	type="hidden" name="button_hover_text_color">
																<p>Button Hover Text </p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="button_background_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['button_background_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['button_background_color'] }};"
																	@endif
																>
																</a>
																<input value=
																	@if(isset($upsell))
																		"{{ $upsell->setting['button_background_color'] }}"
																	@else
																		"{{ $upsellType->setting['button_background_color'] }}"
																	@endif
																	type="hidden" name="button_background_color">
																<p>Button background</p>
															</div>
                                                            <div class="f_input_color mt-3">
                                                                <a href="#" data-id="button_hover_background_color" class="buttoncolor colorpicker" style=
                                                                    @if(isset($upsell))
                                                                        "background-color:{{ $upsell->setting['button_hover_background_color'] }};"
                                                                    @else
                                                                        "background-color:{{ $upsellType->setting['button_hover_background_color'] }};"
                                                                    @endif
                                                                >
                                                                </a>
                                                                <input value=
                                                                    @if(isset($upsell))
                                                                        "{{ $upsell->setting['button_hover_background_color'] }}"
                                                                    @else
                                                                        "{{ $upsellType->setting['button_hover_background_color'] }}"
                                                                    @endif
                                                                    type="hidden" name="button_hover_background_color">
                                                                <p>Button Hover Background</p>
                                                            </div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="arrow_icon_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['arrow_icon_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['arrow_icon_color'] }};"
																	@endif
																>
																</a>
																<input name="arrow_icon_color" type="hidden" value=
                                                                @if(isset($upsell))
                                                                    "{{ $upsell->setting['arrow_icon_color'] }}"
                                                                @else
                                                                    "{{ $upsellType->setting['arrow_icon_color'] }}"
                                                                @endif
                                                                />
																<p>Icon Color</p>
															</div>
															<div class="f_input_color mt-3">
																<a href="#" data-id="arrow_icon_background_color" class="buttoncolor colorpicker" style=
																	@if(isset($upsell))
																		"background-color:{{ $upsell->setting['arrow_icon_background_color'] }};"
																	@else
																		"background-color:{{ $upsellType->setting['arrow_icon_background_color'] }};"
																	@endif
																>
																</a>
																<input name="arrow_icon_background_color" type="hidden" value=
                                                                @if(isset($upsell))
                                                                    "{{ $upsell->setting['arrow_icon_background_color'] }}"
                                                                @else
                                                                    "{{ $upsellType->setting['arrow_icon_background_color'] }}"
                                                                @endif
                                                                />
																<p>Icon Background Color</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="design_p_inpage">
													<div class="design_inpage_post custom_upsell_background_color">
														<div class="top_head_post">
															<div class="post_timer offer_timer" style="width: 200px;">
																<p  class="offer_timer time_display offer_text"style="font-size:15px !important;">Offer End Soon:&nbsp;</p>
																<p  class="offer_timer time_display display_timer_counter "style="font-size:15px !important;">
																	@if(isset($upsell))
																		{{$upsell->setting['timer_duration']}}
																	@else
																		{{$upsellType->setting['timer_duration']}}
																	@endif
																</p>
																<p  class="offer_timer time_display display_timer_counter "style="font-size:15px !important;">:00</p>
															</div>
															<h3 class="ppu_heading_style">
																@if(isset($upsell))
																	{{ $upsell->setting['ppu_heading'] }}
																@else
																	{{ $upsellType->setting['ppu_heading'] }}
																@endif
															</h3><br>
														</div>
														<div class="body_post">
															<div class="slideshow-container">
																<div class="mySlides">
																	<div class="post">
																		<div class="post_p">
																			<div class="post_img">
																				<img src="{{asset('assets/img/m-1-2.webp')}}" alt="shoes">
																			</div>
																			<div class="post_detail">
																				<h4 class="toggle_product_title">Women Pumps Comfort High Heels</h4>
																				<p class="product_sale_price">{{ $currency }}39.95
																				<span class="discount_offer discount_offer_style">
																					@if(isset($upsell))
																						{{$upsell->setting['upsell_discount']}}% Off
																					@else
																						{{$upsellType->setting['upsell_discount']}}% Off
																					@endif
																				</span>
																				<span class="fixed_price_off discount_offer_style">
																					@if(isset($upsell))
																						${{$upsell->setting['upsell_discount']}}Off
																					@else
																						${{$upsellType->setting['upsell_discount']}}Off
																					@endif
																				</span>
																				</p>
																				<select class="toggle_varient_selection">
																					<option>Yellow</option>
																					<option>Blue</option>
																					<option>Red</option>
																				</select>
																				<input type="button" value=
																					@if(isset($upsell))
																						"{{$upsell->setting['ppu_button_text']}}"
																					@else
																						"{{$upsellType->setting['button_text']}}"
																					@endif
																				   class="ppu_button ppu_button_1" style=
																					@if(isset($upsell))
																						"color:{{$upsell->setting['button_text_color']}};"
																					@else
																						"color:{{$upsellType->setting['button_text_color']}};"
																					@endif
																				>
																			</div>
																		</div>
																	</div>
																	<div class="post">
																		<div class="post_p">
																			<div class="post_img">
																				<img src="{{asset('assets/img/m-6-2.jpg')}}" alt="shoes">
																			</div>
																			<div class="post_detail">
																				<h4 class="toggle_product_title">Women's handbag Female leather shoulder bag..!!</h4>
																				<p class="product_sale_price">{{ $currency }}29.95
																				<span class="discount_offer discount_offer_style">
																					@if(isset($upsell))
																						{{$upsell->setting['upsell_discount']}}% Off
																					@else
																						{{$upsellType->setting['upsell_discount']}}% Off
																					@endif
																				</span>
																				<span class="fixed_price_off discount_offer_style">
																					@if(isset($upsell))
																						${{$upsell->setting['upsell_discount']}} Off
																					@else
																						${{$upsellType->setting['upsell_discount']}} Off
																					@endif
																				</span>
																				</p>
																				<select class="toggle_varient_selection">
																					<option>Black</option>
																					<option>Blue</option>
																					<option>Red</option>
																				</select>
																				<input type="button" value=
																					@if(isset($upsell))
																						"{{$upsell->setting['ppu_button_text']}}"
																					@else
																						"{{$upsellType->setting['button_text']}}"
																					@endif
																					class="ppu_button ppu_button_2" style=
																					@if(isset($upsell))
																						"color:{{$upsell->setting['button_text_color']}};"
																					@else
																						"color:{{$upsellType->setting['button_text_color']}};"
																					@endif
																				>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="mySlides">
																	<div class="post">
																		<div class="post_p">
																			<div class="post_img">
																				<img src="{{asset('assets/img/m-1-3.webp')}}" alt="shoes">
																			</div>
																			<div class="post_detail">
																				<h4 class="toggle_product_title">Women Pumps Comfort High Heels</h4>
																				<p class="product_sale_price">$39.95
																				<span class="discount_offer discount_offer_style">{{$upsellType->setting['upsell_discount']}}% Off</span>
																				<span class="fixed_price_off discount_offer_style">${{$upsellType->setting['upsell_discount']}} Off</span>
																				</p>
																				<select class="toggle_varient_selection">
																					<option>Black</option>
																					<option>Blue</option>
																					<option>Red</option>
																				</select>
																				<select class="toggle_varient_selection">
																					<option>24</option>
																					<option>26</option>
																					<option>28</option>
																				</select>
																				<input type="button" value=
																					@if(isset($upsell))
																						"{{$upsell->setting['ppu_button_text']}}"
																					@else
																						"{{$upsellType->setting['button_text']}}"
																					@endif
																				    class="ppu_button ppu_button_3" style=
																					@if(isset($upsell))
																						"color:{{$upsell->setting['button_text_color']}};"
																					@else
																						"color:{{$upsellType->setting['button_text_color']}};"
																					@endif
																					>
																			</div>
																		</div>
																	</div>
																	<div class="post">
																		<div class="post_p">
																			<div class="post_img">
																				<img src="{{asset('assets/img/m-1-5.jpg')}}" alt="shoes">
																			</div>
																			<div class="post_detail">
																				<h4 class="toggle_product_title">Women Pumps Comfort High Heels</h4>
																				<p class="product_sale_price">$39.95
																				<span class="discount_offer discount_offer_style">
																					@if(isset($upsell))
																						{{$upsell->setting['upsell_discount']}}% Off
																					@else
																						{{$upsellType->setting['upsell_discount']}}% Off
																					@endif
																				</span>
																				<span class="fixed_price_off discount_offer_style">
																					@if(isset($upsell))
																						${{$upsell->setting['upsell_discount']}} Off
																					@else
																						${{$upsellType->setting['upsell_discount']}} Off
																					@endif
																				</span>
																				</p>
																				<select class="toggle_varient_selection">
																					<option>White</option>
																					<option>Blue</option>
																					<option>Red</option>
																				</select>
																				<input type="button" value=
																				 	@if(isset($upsell))
																						"{{$upsell->setting['ppu_button_text']}}"
																					@else
																						"{{$upsellType->setting['button_text']}}"
																					@endif
																				  class="ppu_button ppu_button_4" style=
																					@if(isset($upsell))
																						"color:{{$upsell->setting['button_text_color']}};"
																					@else
																						"color:{{$upsellType->setting['button_text_color']}};"
																					@endif
																				>
																			</div>
																		</div>
																	</div>
																</div>
																<a class="prev arrow-icon" onclick="plusSlides(-1)">❮</a>
																<a class="next arrow-icon" onclick="plusSlides(1)">❯</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-----------------Tab-2-Close----------------->
							<div id="menu-fbt-video" class="tab-pane fade p-0"><br><div class="container-fluid">
                        	<div class="container">
                             <div class="row">
                              <div class="col-md-12">
                                 <iframe width="100%" height="515" src="https://www.youtube.com/embed/RTT0t7WM22g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                        	</div>
                        	</div>
                     		</div>



						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>

@include('includes.components.pickProductModal')
@include('includes.pages.ppu',[ "setting" => $upsellType->setting ])
@endsection


