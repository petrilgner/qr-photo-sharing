<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZACHYŤTE MOMENT</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    <!-- Optional: Dropzone Theme (if you want a different look) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/themes/dark.min.css">
    <style>
        /* Optional: Custom styles */
        .dropzone {
            border: 2px dashed #645F42;
            border-radius: 5px;
            background: #f3f4f6;
            padding: 20px;
        }
        .dropzone .dz-message {
            font-weight: bold;
            color: #645F42;
        }
        .btn-primary {
            background-color: #645F42;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">ZDIEĽAJTE S NAMI VAŠE FOTKY & VIDEÁ Z NAŠEJ SVADBY</h2>

    <!-- Optional Name Field -->
    <div class="form-group">
        <label for="name">Vaše meno (nepovinné):</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Zadajte svoje meno">
    </div>

    <!-- Dropzone Form -->
    <form action="/upload-submit" class="dropzone" id="my-dropzone">
        @csrf
        <!-- Fallback for browsers without JavaScript enabled -->
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

    <!-- Submit Button -->
    <div class="text-center mt-4">
        <button id="submit-button" class="btn btn-primary btn-lg">Odoslať všetky súbory</button>
    </div>

    <div class="small text-center mt-4">Mari & Peťo</div>
</div>

<!-- Bootstrap and jQuery JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Dropzone JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    // Disable autoDiscover, otherwise Dropzone will try to attach twice.
    Dropzone.autoDiscover = false;

    // Initialize Dropzone
    const myDropzone = new Dropzone("#my-dropzone", {
        url: "/upload-submit", // URL to handle the upload
        autoProcessQueue: false, // Disable auto-processing to control it manually
        maxFiles: 10, // Maximum number of files
        maxFilesize: 200, // Maximum file size in MB
        uploadMultiple: true,
        parallelUploads: 100,
        acceptedFiles: "image/*,video/*", // Accept images and videos only
        addRemoveLinks: true, // Show remove links
        dictDefaultMessage: "Pretiahnite sem obrázky alebo videá na nahratie",
        dictRemoveFile: "Odstrániť", // Text for remove link
        init: function () {
            // Reference to Dropzone instance
            const dz = this;

            // Event listener for the submit button
            document.getElementById("submit-button").addEventListener("click", function () {
                // Append the optional name to form data
                const name = document.getElementById('name').value;
                dz.options.params = { name: name };

                // Manually process the queue on submit button click
                dz.processQueue();
            });

            // Handling successful upload
            dz.on("success", function (file, response) {
                console.log("File uploaded successfully:", response);
            });

            // Handling upload error
            dz.on("error", function (file, errorMessage) {
                console.error("Error uploading file:", errorMessage);
            });

            // Handling queue complete (when all files have been processed)
            dz.on("queuecomplete", function () {

                window.location.replace("/dakujeme");
            });
        }
    });
</script>

</body>
</html>
