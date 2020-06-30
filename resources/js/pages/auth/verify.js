jQuery(document).ready(function () {

    var logoutFunction = function(){
        axios.post('/logout')
            .then(function(response){
                response.status === 204 ? window.location.replace('/'):'';
            })
            .catch(function(error){
                console.log(error.response)
                window.swal.fire({
                    icon: 'error',
                    title: 'Oops! We were unable to complete your request!',
                    text: 'Please refresh page and try again!'
                })
            });
    }

    var logoutBtn = $('.btn-logout');
    logoutBtn.on('click', function(ev){
        ev.preventDefault();
        window.swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'Until you verify your email address you will not be able to login.',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I am sure!'
        }).then(function(result){
            if (result.value) {
                logoutFunction();
            }
        })

    })
})
