@if(currentUser()->isAdmin)
<div id="changePassword" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 40%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="post"
                      id="adminPasswordReset" action="{{route('admin.changePassword')}}">
                    {{ csrf_field() }}
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                Old Password:
                            </label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>
                                New Password:
                            </label>
                            <input type="password" name="new_password" class="form-control" id="new_password" required>
                        </div>
                        <div class="col-lg-6">
                            <label>
                                New Password Confirmation:
                            </label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@section('inline-js')
    <script type="text/javascript">
        $('#adminPasswordReset').on('submit', function() {
            $.ajax({
                dataType: 'json',
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function () {
                    swal('Success', 'Password has been changed', 'success');
                    setTimeout(function () {
                        window.location.replace('');
                    }, 2000);
                },
                error: function(xhr) {
                    var error;
                    if(xhr.responseJSON.new_password) {
                        error = xhr.responseJSON.new_password.join("\n")
                    } else if(xhr.responseJSON.password) {
                        error = xhr.responseJSON.password.join("\n")
                    }
                    swal('Error', error, 'error');
                }
            });
            return false;
        })
    </script>
@append
@endif