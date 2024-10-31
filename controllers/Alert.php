<?php
class Alert
{
    public function showAlert($message, $type = 'success')
    {
        $icon = $type; // Set the SweetAlert icon type based on the parameter
        $bgColor = $type === 'error' ? '#f8d7da' : '#d4edda'; // Red for error, green for success

        echo "<script>
            Swal.fire({
                icon: '$icon',
                title: '$message',
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'bottom-end',
                background: '$bgColor'
            });
        </script>";
    }
}
