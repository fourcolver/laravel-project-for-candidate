<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Argon | Festanstellung Send Mail
		</title>
		@extends('layouts.admin_dashboard')
		@section('content')
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-page-title">
									Home / Festanstellung Send Mail
								</h3>
							</div>
						</div>
					</div>
				
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m--margin-top-20 m--margin-bottom-30">

									<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="freelancer_send_mail" name="freelancer_send_mail">
										{{ csrf_field() }}
									<div class="row align-items-center">
										<div class="col-xl-9">
											<input type="hidden" name="freelancer_id" id="freelancer_id" value="{{$festanstellung}}" >	
											<div class="form-group m-form__group row align-items-center">
												<label class="form-control">
												@foreach($users_data as $users)
												<label>{{ $users->email }}, </label>
												@endforeach
												</label>
											</div>

											<div class="form-group m-form__group row align-items-center">
												<label>
													Subject
												</label>
												<input type="text" name="freelancer_mail_sub" id="freelancer_mail_sub" class="form-control" >
											</div>

											<div class="form-group m-form__group row align-items-center">
												<label>Body</label>
												<textarea class="form-control" style="min-height: 300px;" name="freelancer_mail_body" id="freelancer_mail_body">{{$title}}</textarea>
											</div>

											<div class="form-group m-form__group row align-items-center">
												<button type="submit" id="send_mail_freelancer" class="btn btn-primary">Send</button>
											</div>

										</div>

										<div class="col-xl-2">
											<h3>Placeholder</h3>

											((Name))<br/>
											((Email))
										</div>
										
									</div>
									</form>
								</div>
								<!--end: Search Form -->
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<!-- end:: Body -->

	<!-- end::Quick Sidebar -->		    
    <!-- begin::Scroll Top -->
	<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
		<i class="la la-arrow-up"></i>
	</div>
	<!-- end::Scroll Top -->
	@endsection
	@section('js')

	<script type="text/javascript">
		$(document).ready(function(){

		$('#send_mail_freelancer').on('click',function(){
			

			$('#freelancer_send_mail').validate({


				submitHandler:function(form){
			$('#send_mail_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            $.ajax({
                url: 'send',
                type: "POST",
                data: $(form).serialize(),
                success: function(response, status, xhr, $form) {
                	
                    $('#send_mail_freelancer').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    var res = $.parseJSON(response);
                    if(res.status == 'error'){
                      swal('Error',res.message,'error');
                    }
                    else{
                      swal('Success',res.message,'success');
                      setTimeout(function() {
                        window.location.href = "../kandidaten";
                        }, 2000);
                    }    
                    
                },
                error: function(data){
                  $('#m_signup_employee').addClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                var errors = data.responseJSON;
                $.each(errors, function(key, val){
                  $('.'+key).show().html(val);
                  $('.'+key).css('color','red');
                });
          }
            });
        }
    });
	});
	});
	</script>
    <!-- <script src="{{asset('/js/employee.js')}}" type="text/javascript"></script> -->
   
	@endsection