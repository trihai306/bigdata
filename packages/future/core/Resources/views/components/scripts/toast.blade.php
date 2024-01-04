<div class="toast position-absolute  end-0 show" style="z-index: 9999999;top: 60px" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
    <div class="toast-header">
        <span class="avatar avatar-xs me-2" >
            <i class="fa fa-info-circle"></i>
        </span>
        <strong class="me-auto">Mallory Hulme</strong>
        <small>11 mins ago</small>
        <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Hello, world! This is a toast message.
    </div>
</div>

<script>
    // Get the toast element
    var toast = document.querySelector('.toast');

    // Check if the body has the 'dark' class
    if (document.body.dataset.bsTheme === 'dark') {
        // If yes, add the 'toast-dark' class to the toast
        toast.classList.add('bg-dark');
    }

    // Make the toast draggable
    toast.draggable = true;

    // Define the dragstart event handler
    toast.addEventListener('dragstart', function (event) {
        // The dataTransfer.setData() method sets the data type and the value of the dragged data
        event.dataTransfer.setData('text/plain', getComputedStyle(event.target).cssText);
    });

    // Define the dragover event handler
    document.body.addEventListener('dragover', function (event) {
        // Prevent default to allow drop
        event.preventDefault();
    });

    // Define the drop event handler
    document.body.addEventListener('drop', function (event) {
        // Prevent default action (prevent file from being opened)
        event.preventDefault();

        // Move the toast to the new location
        toast.style.left = (event.clientX - toast.offsetWidth / 2) + 'px';
        toast.style.top = (event.clientY - toast.offsetHeight / 2) + 'px';
    });
</script>

<script>
    function showToast(title, time, message) {
        // Get the toast element
        var toast = document.querySelector('.toast');

        // Set the title, time, and message
        toast.querySelector('.me-auto').textContent = title;
        toast.querySelector('small').textContent = time;
        toast.querySelector('.toast-body').textContent = message;

        // Show the toast
        toast.classList.add('show');

        // Check if the body has the 'dark' class
        if (document.body.dataset.bsTheme === 'dark') {
            // If yes, add the 'toast-dark' class to the toast
            toast.classList.add('bg-dark');
        }
    }

    function hideToast() {
        // Get the toast element
        var toast = document.querySelector('.toast');

        // Hide the toast
        toast.classList.remove('show');
    }
    hideToast();
</script>
