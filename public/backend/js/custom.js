$(function(){
    $('#password-update-btn').on('click', function(e){
        e.preventDefault();
        // alert(222)
        const npassword = $('#npassword').val();
        const confirm_password = $('#confirm_password').val();
        if(npassword !== confirm_password)
        {
            $('#npassword').after("<span class='text-danger'>The password confirmation does not match.</span>");
        }else{
            $('#update-password-form').trigger('submit');
        }
    })
   
})