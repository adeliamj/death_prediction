$(document).ready(function () {
    $("#formcek").validate({
        rules: {
            nama: {
                required: true,
            },
            username: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        message:{
            name:{
                required: 'nama wajib diisi',
            },
            username:{
                required: 'username wajib diisi',
            },
            email:{
                required: 'email wajib diisi',
            },
            password:{
                required: 'password wajib diisi',
            },
        },
})
})