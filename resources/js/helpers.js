export default {
    toastSaveSuccessMessage() {
        Toast.fire({
            icon: 'success',
            title: "Data has been successfuly saved!"
        });
    },
    toastMissingRequiredFields() {
        Toast.fire({
            icon: 'error',
            title: 'Opps! A required field is missing',
        });
    },
    toastBackendValidationErrors(response){
        //console.log(response);
        let errTitle = 'Opps!';
        if ( response.hasOwnProperty('message') ) {
            errTitle = response.message;
        }

        let errKey = null;
        if ( response.hasOwnProperty('errors') ) {
            errKey = Object.keys(response.errors)[0];
        }

        let errMsg = 'Something went wrong! Please try again';
        if ( errKey != null ) {
            errMsg = response.errors[errKey][0]
        }

        // global window instance @swal.js
        Toast.fire({
            icon: 'error',
            title: errTitle,
            text: errMsg
        });
    },
    /**
     * @param {*} callback = callback store action
     * @param {*} payload = payload passed on callback store action
     * @param {*} payload.vm = instance of vue
     */
    confirmDeleteSwal(callback, payload) {
        // global window instance @swal.js
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            // icon: 'warning',
            width: 400,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.value && payload.vm) {
                payload.vm.$store.dispatch(callback, payload);
            }
        })
    },
}