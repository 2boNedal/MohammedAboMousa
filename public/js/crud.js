function showSuccessMessage(message = 'Success') {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message
    });
}

function showErrorMessage(message = 'Error') {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message
    });
}

function store(url, data) {
    axios.post(url, data)
        .then(function (response) {
            showSuccessMessage(response.data.message ?? 'Stored successfully');
        })
        .catch(function (error) {
            showErrorMessage(error.response?.data?.message ?? 'Store failed');
        });
}

function storeRoute(url, data) {
    axios.post(url, data)
        .then(function (response) {
            showSuccessMessage(response.data.message ?? 'Updated successfully');
        })
        .catch(function (error) {
            showErrorMessage(error.response?.data?.message ?? 'Update failed');
        });
}

function destroy(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This record will be deleted',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url)
                .then(function (response) {
                    showSuccessMessage(response.data.message ?? 'Deleted successfully');
                    location.reload();
                })
                .catch(function (error) {
                    showErrorMessage(error.response?.data?.message ?? 'Delete failed');
                });
        }
    });
}