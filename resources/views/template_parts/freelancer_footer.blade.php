<!-- begin::Footer -->
<div id="attachcv" class="modal fade" role="dialog">
  <div class="modal-dialog col-lg-6" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="margin-left: -20px;">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method="post" action="{{url('freelancer/upload/')}}/{{ Session::get('freelancer_id') }}" name="upload_file" id="upload_file" enctype="multipart/form-data">
          {{ csrf_field() }}
          Select file : <input type='file' name='attach_doc' id='attach_doc' class='form-control' required=""><br>
          <span id="errormessage"></span>
          <p style="color: red">* Please Select Only Doc and Pdf File</p>
          <button class="btn btn-primary" id="upload" name="upload" type="submit">Upload</button>
        </form>
      </div>
 
    </div>

    </div>
        </div>
        <div id="changeProfile" class="modal fade" role="dialog">
        	<div class="modal-dialog .col-lg-6">
          	<!-- Modal content-->
          	<div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload Profile Pic</h4>
            </div>
            <div class="modal-body">
              <!-- Form -->
              <form method="post" name="upload_pic" action="{{url('dashboard/profile/update')}}" id="upload_pic" enctype="multipart/form-data">
                {{ csrf_field() }}
                Select file : <input type='file' name='attach_pic' id='attach_pic' class='form-control' required=""><br>
                <span id="errormessage"></span>
                <p style="color: red">* Please Select Only Png and jpg format</p>
                <button class="btn btn-primary" id="upload_profile" name="upload_profile" type="submit">Upload</button>
              </form>
            </div>
       
          </div>

          </div>
    </div>
			<footer class="m-grid__item m-footer" style="position: absolute; margin: 0px; bottom: 0;">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
                2018 &copy; @Registered
               
              </span>
						</div>
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
</div>
</div>
		<!-- end:: Page -->
    		        <!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
				</ul>
			</div>
		</div>
		<!-- end::Quick Sidebar -->	
		<!-- begin::Quick Nav -->	
    	<!--begin::Base Scripts -->
		<script src="{{url('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
		<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
		<!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
		<script src="{{url('assets/demo/default/custom/components/datatables/base/data-freelancer_pofile.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
		<script src="{{url('assets/app/js/script.js')}}" type="text/javascript"></script>
		<script type="text/javascript">
    		$('input[name="hourly_rate"]').click(function(){ 
    			if($(this).val()=='other')
    			{
    				$('#hourly_rate_other_input').show();
    			}
    			else
    			{
    				$('#hourly_rate_other_input').hide();
    			}
			});
			$('input[name="freelancer_roles"]').click(function(){ 
    			if($(this).val()=='other')
    			{
    				$('#freelancer_roles_other_input').show();
    			}
    			else
    			{
    				$('#freelancer_roles_other_input').hide();
    			}
    		});
		</script>
		<style type="text/css">
		.m-aside-left--minimize .m-aside-menu .m-menu__nav {
		padding: 30px 0 30px 0; width: 6%; }
		#TaskModal {
		display:none;
		}	
		.comment_div li{
		width:100%!important;
		}
		.m-quick-sidebar__content{
		padding: 61px 14px;
		}
    @media (min-width: 1200px) {
      .col-lg-6
      {
        width: 40% !important;
      }
    }
		</style>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>