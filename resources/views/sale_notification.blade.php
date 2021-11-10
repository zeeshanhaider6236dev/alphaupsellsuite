@extends('vendor.shopify-app.layouts.default')
@section('content')
@if($saleNotificationUpsell)
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 top">
            <a href="{{ route('home').'?tab=menu1' }}"><i class="fa fa-angle-left"></i>Offers</a>
            <div class="row">
                <div class="col-md-7 top_left">
                  <h3>Update an offer</h3>
                </div>
                <div class="col-md-5 top_right">
                    <a href="{{ route('home') }}" class="cancel">Cancel</a>
                    <button type="button" class="save updateUpsell">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
	@include('includes.upsell_header')
@endif
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
						</ul>
						<!----------------Tab-panes----------------->
						<div class="tab-content mt-3">
							<div id="home" class="tab-pane active">
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Layout</h4>
											<p>Layout provides you to pick a pre-built layout for notification.</p>
										</div>
										<div class="col-md-7 offer_right">
											<div class="form-group">
												<label style="cursor:pointer;" for="rectangle_notification">
													@php
														if($saleNotificationUpsell):
															if($saleNotificationUpsell['setting']['notificationLayout']==config('upsell.strings.layout_options')[0]):
																$notificationLayout = $saleNotificationUpsell['setting']['notificationLayout'];
																$checked = "checked";
															else:
																$notificationLayout = config('upsell.strings.layout_options')[0];
															endif;
														else:
															$notificationLayout = config('upsell.strings.layout_options')[0];
															$checked = "checked";
														endif;
													@endphp	
														<input type="radio" value="{{ $notificationLayout }}" name="notificationLayout" style="width:auto;cursor:pointer;" id="rectangle_notification" @isset($checked){{ $checked }} @php unset($checked); @endphp  @endisset /> {{ config('upsell.strings.layout_options')[0] }}
												</label>
											</div>
											<div class="popup_n_1 popup_bg notification_display_style">
												<div class="popup_n1_img">
													<img src="{{asset('assets/img/bag.png')}}">
												</div>
												<div class="popup_n1_heading">
													<h5 class="customer_name">Aaradhya Smith From USA, purchased 2</h5>
													<h3 class="product_title">Calvin Klein Girls Handbag</h3>
													<p class="timer_display">10 Minutes Ago</p>
												</div>
												<div class="popup_n1_close">
													<button class="popup_n1_btn">
														<i class="far fa-times cross-icon"></i>
													</button>
												</div>
											</div>
											<div class="form-group">
												<label style="cursor:pointer;" for="round_notification">
													@php
														if($saleNotificationUpsell):
															if($saleNotificationUpsell['setting']['notificationLayout']==config('upsell.strings.layout_options')[1]):
																$notificationLayout = $saleNotificationUpsell['setting']['notificationLayout'];
																$checked = "checked";
															else:
																$notificationLayout = config('upsell.strings.layout_options')[1];
															endif;
														else:
															$notificationLayout = config('upsell.strings.layout_options')[1];
															$checked = "checked";
														endif;
													@endphp	
														<input type="radio" value="{{ $notificationLayout }}" name="notificationLayout" style="width:auto;cursor:pointer;" id="round_notification" @isset($checked){{ $checked }} @php unset($checked); @endphp @endisset /> {{ config('upsell.strings.layout_options')[1] }}
												</label>
											</div>
											<div class="popup_n_1 popup_bg popup_n_2 notification_display_style">
												<div class="popup_n2_img">
													<img src="{{asset('assets/img/lipstick.png')}}">
												</div>
												<div class="popup_n1_heading">
													<h5 class="customer_name">Stuthi Sajiv From INDIA, purchased 5</h5>
													<h3 class="product_title">Matte Mac Lipstik</h3>
													<p class="timer_display">5 Minutes Ago</p>
												</div>
												<div class="popup_n2_close">
													<button class="popup_n1_btn">
														<i class="far fa-times cross-icon"></i>
													</button>
												</div>
											</div>
											<div class="form-group">
												<label style="cursor:pointer;" for="rounded_notification">
													@php
														if($saleNotificationUpsell):
															if($saleNotificationUpsell['setting']['notificationLayout']==config('upsell.strings.layout_options')[2]):
																$notificationLayout = $saleNotificationUpsell['setting']['notificationLayout'];
																$checked = "checked";
															else:
																$notificationLayout = config('upsell.strings.layout_options')[2];
															endif;
														else:
															$notificationLayout = config('upsell.strings.layout_options')[2];
															$checked = "checked";
														endif;
													@endphp	
													<input type="radio" value="{{ $notificationLayout }}" name="notificationLayout" style="width:auto;cursor:pointer;" id="rounded_notification" @isset($checked){{ $checked }} @php unset($checked); @endphp @endisset  /> {{ config('upsell.strings.layout_options')[2] }}
												</label>
											</div>
											<div class="popup_n_1 popup_bg notification_display_style">
												<div class="popup_n2_img">
													<img src="{{asset('assets/img/perfume.png')}}">
												</div>
												<div class="popup_n1_heading">
													<h5 class="customer_name">Vansh Vairaj From USA, purchased 1</h5>
													<h3 class="product_title">DIOR Sweet Smells Perfume</h3>
													<p class="timer_display">4 Minutes Ago</p>
												</div>
												<div class="popup_n1_close">
													<button class="popup_n1_btn">
														<i class="far fa-times cross-icon"></i>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Notification Settings</h4>
											<p>Settings relevant to the kind of notification to be displayed on your store.</p>
										</div>
										<div class="col-md-7 offer_right">
											<div class="row">
												<p class="f_input">
													<label>Initial Notification Display Time 
														<span class="input_span">(In Seconds)</span>
													</label><br>
													@php
														if($saleNotificationUpsell):
															$initial_notification_display_time = $saleNotificationUpsell['setting']['initial_notification_display_time'];
														else:
															$initial_notification_display_time = $upsellType->setting['initial_notification_display_time'];
														endif;
													@endphp
													<input type="number" value="{{ $initial_notification_display_time }}" min="1" name="initial_notification_display_time">
												</p>
												<p class="f_input">
													<label>Delay Time Between 2 Notifications 
														<span class="input_span">(In Seconds)</span>
													</label><br>
													@php
														if($saleNotificationUpsell):
															$delay_time_between_notification = $saleNotificationUpsell['setting']['delay_time_between_notification'];
														else:
															$delay_time_between_notification = $upsellType->setting['delay_time_between_notification'];
														endif;
													@endphp
													<input type="number" value="{{ $delay_time_between_notification }}" min="1" name="delay_time_between_notification">
												</p>
											</div>
											<div class="row mt-2">
												<p class="f_select">
													<label>Select Animation </label><br>
													<select name="animation_type">
														@foreach (config('upsell.strings.animation') as $animation)
															<option 
																@if($saleNotificationUpsell)
																	@if($saleNotificationUpsell['setting']['animation_type']==$animation)
																		{{ "selected" }}
																	@endif
																@elseif ($upsellType->setting['animation_type'] == $animation)
																		{{ "selected" }}
																@endif
															 	value="{{$animation}}">
																{{ $animation }}
															</option>
														@endforeach
													</select>
												</p>
											</div>
											<div class="row">
												<div class="custom-control custom-checkbox">
													@php
														if($saleNotificationUpsell):
															$repeat_cycle = $saleNotificationUpsell['setting']['repeat_cycle'];
														else:
															$repeat_cycle = $upsellType->setting['repeat_cycle'];
														endif;
													@endphp
													<input type="checkbox" class="custom-control-input" value="{{ $repeat_cycle }}" id="defaultCheckedDisabled9" name="repeat_cycle" @if($repeat_cycle)  checked @endif />
													<label class="custom-control-label" for="defaultCheckedDisabled9">Repeat Cycle</label>
												</div>
												<div class="custom-control custom-checkbox">
													@php
														if($saleNotificationUpsell):
															$hide_on_mobile = $saleNotificationUpsell['setting']['hide_on_mobile'];
														else:
															$hide_on_mobile = $upsellType->setting['hide_on_mobile'];
														endif;
													@endphp
													<input type="checkbox" class="custom-control-input" id="defaultCheckedDisabled10" name="hide_on_mobile" value="{{ $hide_on_mobile }}"  @if($hide_on_mobile) checked @endif/>
													<label class="custom-control-label" for="defaultCheckedDisabled10">Hide On Mobile </label>
												</div>
											</div>
											<div class="row">
												<h3 class="c_popup">Choose Popup Position</h3>
												<div class="">
													<label for="bottom_left_display" class="radio-inline" style="cursor:pointer;">
														@php
															if($saleNotificationUpsell):
																if($saleNotificationUpsell['setting']['popup_position']==config('upsell.strings.pop_up_position')[0]):
																	$popup_position = $saleNotificationUpsell['setting']['popup_position'];
																	$checked_popup = "checked";
																else:
																	$popup_position = config('upsell.strings.pop_up_position')[0];
																endif;
															else:
																$popup_position = config('upsell.strings.pop_up_position')[0];
																$checked_popup = "checked";
															endif;
														@endphp	
														<input name="popup_position" value="{{ $popup_position }}" id="bottom_left_display" type="radio" style="width: auto;" @isset($checked_popup) {{ $checked_popup }} @php unset($checked_popup); @endphp @endisset> {{ config('upsell.strings.pop_up_position')[0] }}  
													</label>&nbsp; &nbsp;
												</div>
												<div class="">
													<label for="bottom_right_display" style="cursor:pointer;">
														@php
															if($saleNotificationUpsell):
																if($saleNotificationUpsell['setting']['popup_position']==config('upsell.strings.pop_up_position')[1]):
																	$popup_position = $saleNotificationUpsell['setting']
																	['popup_position'];
																	$checked_popup = "checked";
																else:
																	$popup_position = config('upsell.strings.pop_up_position')[1];
																endif;
															else:
																$popup_position = config('upsell.strings.pop_up_position')[1];
																$checked_popup = "checked";
															endif;
														@endphp	
														<input name="popup_position" value="{{ $popup_position }}" id="bottom_right_display" type="radio" style="width: auto;" @isset($checked_popup) {{ $checked_popup }} @php unset($checked_popup); @endphp @endisset /> 
														{{ config('upsell.strings.pop_up_position')[1] }}  
													</label>&nbsp; &nbsp;
												</div>
												<div class="">
													<label for="top_left_display" style="cursor:pointer;">
														@php
															if($saleNotificationUpsell):
																if($saleNotificationUpsell['setting']['popup_position']==config('upsell.strings.pop_up_position')[2]):
																	$popup_position = $saleNotificationUpsell['setting']['popup_position'];
																	$checked_popup = "checked";
																else:
																	$popup_position = config('upsell.strings.pop_up_position')[2];
																endif;
															else:
																$popup_position = config('upsell.strings.pop_up_position')[2];
																$checked_popup = "checked";
															endif;
														@endphp	
														<input name="popup_position" value="{{ $popup_position }}" id="top_left_display" type="radio" style="width: auto;" @isset($checked_popup) {{ $checked_popup }} @php unset($checked_popup); @endphp @endisset /> 
														{{ config('upsell.strings.pop_up_position')[2] }}  
													</label>&nbsp; &nbsp;
												</div>
												<div class="">
													<label for="top_right_display" style="cursor:pointer;">
														@php
															if($saleNotificationUpsell):
																if($saleNotificationUpsell['setting']['popup_position']==config('upsell.strings.pop_up_position')[3]):
																	$popup_position = $saleNotificationUpsell['setting']['popup_position'];
																	$checked_popup = "checked";
																else:
																	$popup_position = config('upsell.strings.pop_up_position')[3];
																endif;
															else:
																$popup_position = config('upsell.strings.pop_up_position')[3];
																$checked_popup = "checked";
															endif;
														@endphp	
														<input name="popup_position" value="{{ $popup_position }}" id="top_right_display" type="radio" style="width: auto;" @isset($checked_popup) {{ $checked_popup }} @php unset($checked_popup); @endphp @endisset /> 
														{{ config('upsell.strings.pop_up_position')[3] }}  
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container offer">
									<div class="row">
										<div class="col-md-5 offer_left">
											<h4>Text & Style Format</h4>
											<p>The text allows you to customize the text displayed on notifications. Add relevant style and color to the interface of notifications.</p>
										</div>
										<div class="col-md-7 offer_right">
											<div class="row">
												<p class="f_input">
													<label>Product Title Font Size 
														<span class="input_span">(px)</span>
													</label><br>
													@php
														if($saleNotificationUpsell):
															$product_title_font_size = $saleNotificationUpsell['setting']['product_title_font_size'];
														else:
															$product_title_font_size = $upsellType->setting['product_title_font_size'];
														endif;
													@endphp 
													<input type="number" name="product_title_font_size" value="{{ $product_title_font_size }}" min="1">
												</p>
												<p class="f_input">
													<label>Text Font Size 
														<span class="input_span">(px)</span>
													</label><br>
													@php
														if($saleNotificationUpsell):
															$text_font_size = $saleNotificationUpsell['setting']['text_font_size'];
														else:
															$text_font_size = $upsellType->setting['text_font_size'];
														endif;
													@endphp 
													<input type="number" name="text_font_size" value="{{ $text_font_size }}" min="1">
												</p>
											</div>
											<div class="row mt-2">
												<p class="f_input">
													<label>Product Title Weight</label><br>
													<select name="product_title_weight">
														@foreach (config('upsell.strings.font_weight') as $fontWeight)
															<option  value="{{$fontWeight}}" 
																@if($saleNotificationUpsell	)
																	@if($saleNotificationUpsell['setting']['product_title_weight'] == $fontWeight)
																		{{ "selected" }}
																	@endif
																@elseif($upsellType->setting['product_title_weight'] == $fontWeight)
																	{{ "selected" }}
																@endif
															> 
																{{ $fontWeight }}
															</option>
														@endforeach
													</select>
												</p>
												<p class="f_input">
													<label>Text Weight</label><br>
													<select name="text_weight">
														@foreach (config('upsell.strings.font_weight') as $fontWeight)
															<option  value="{{$fontWeight}}" 
																@if($saleNotificationUpsell)
																	@if($saleNotificationUpsell['setting']['text_weight'] == $fontWeight)
																		{{ "selected" }}
																	@endif
																@elseif($upsellType->setting['text_weight'] == $fontWeight)
																	{{ "selected" }}
																@endif
															> 
															{{ $fontWeight }}
															</option>
														@endforeach
													</select>
												</p>
											</div>
											<div class="row mt-2">
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$product_title_color = $saleNotificationUpsell['setting']['product_title_color'];
														else:
															$product_title_color = $upsellType->setting['product_title_color'];
														endif;
													@endphp
													<a href="#" data-id="product_title_color" class="buttoncolor colorpicker" style="background:{{ $product_title_color }};">
													</a>
													<input value="{{ $product_title_color }}" type="hidden" name="product_title_color">
													<p>Select Product Title Color</p>
												</div>
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$background_color = $saleNotificationUpsell['setting']['background_color'];
														else:
															$background_color = $upsellType->setting['background_color'];
														endif;
													@endphp
													<a href="#" data-id="background_color" class="buttoncolor colorpicker" style="background:{{ $background_color }};"></a>
													<input value="{{ $background_color }}" type="hidden" name="background_color">
													<p>Select Background Color</p>
												</div>
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$timer_color = $saleNotificationUpsell['setting']['timer_color'];
														else:
															$timer_color = $upsellType->setting['timer_color'];
														endif;
													@endphp
													<a href="#" data-id="timer_color" class="buttoncolor colorpicker" style="background:{{ $timer_color }};"></a>
													<input value="{{ $timer_color }}" type="hidden" name="timer_color">
													<p>Select Timer Color</p>
												</div>
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$text_color = $saleNotificationUpsell['setting']['text_color'];
														else:
															$text_color = $upsellType->setting['text_color'];
														endif;
													@endphp
													<a href="#" data-id="text_color" class="buttoncolor colorpicker" style="background:{{ $text_color }};"></a>
													<input value="{{ $text_color }}" type="hidden" name="text_color">
													<p>Select Text Color</p>
												</div>
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$cross_icon_color = $saleNotificationUpsell['setting']['cross_icon_color'];
														else:
															$cross_icon_color = $upsellType->setting['cross_icon_color'];
														endif;
													@endphp
													<a href="#" data-id="cross_icon_color" class="buttoncolor colorpicker" style="background:{{ $cross_icon_color }};"></a>
													<input value="{{ $cross_icon_color }}" type="hidden" name="cross_icon_color">
													<p>Select Cross Icon Color</p>
												</div>
												<div class="f_input_color mt-3">
													@php
														if($saleNotificationUpsell):
															$cross_icon_background_color = $saleNotificationUpsell['setting']['cross_icon_background_color'];
														else:
															$cross_icon_background_color = $upsellType->setting['cross_icon_background_color'];
														endif;
													@endphp
													<a href="#" data-id="cross_icon_background_color" class="buttoncolor colorpicker" style="background:{{ $cross_icon_background_color }};"></a>
													<input value="{{ $cross_icon_background_color }}" type="hidden" name="cross_icon_background_color">
													<p>Select Cross Button Background Color</p>
												</div>
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
@include('includes.pages.sale_notification',[ "setting" => $upsellType->setting ])
@endsection
