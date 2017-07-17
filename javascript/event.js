function previewFile() {
    var preview = document.querySelector('img');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

document.addEventListener('click', function (event) {
    event = event || window.event;
    if (event.target.getAttribute("id") == "reg") {
        document.getElementById("form-r").style.visibility = "visible";
        document.getElementById("form-r").style.opacity = 1;
        document.getElementById("registration-form").style.visibility = "visible";
        document.getElementById("registration-form").style.opacity = 0.5;
    }
    if (event.target.getAttribute("id") == "auto") {
        document.getElementById("form-a").style.visibility = "visible";
        document.getElementById("form-a").style.opacity = 1;
        document.getElementById("autorization-form").style.visibility = "visible";
        document.getElementById("autorization-form").style.opacity = 0.5;
    }
    if (event.target.getAttribute("id") == "exitauto") {
        document.getElementById("form-a").style.visibility = "hidden";
        document.getElementById("form-a").style.opacity = 0;
        document.getElementById("autorization-form").style.visibility = "hidden";
        document.getElementById("autorization-form").style.opacity = 0;

    }
    if (event.target.getAttribute("id") == "exitreg") {
        document.getElementById("form-r").style.visibility = "hidden";
        document.getElementById("registration-form").style.visibility = "hidden";
        document.getElementById("registration-form").style.opacity = 0;
        document.getElementById("form-r").style.opacity = 0;
    }
    if (event.target.getAttribute("id") == "btn-preview") {
        document.getElementById("block1").style.display = "none";
        document.getElementById("preview").style.display = "block";
        var task = document.getElementById("textarea").value;
        document.getElementById("preview-task").innerHTML = task;
        previewFile();

    }
    if (event.target.getAttribute("id") == "exitpreview") {
        document.getElementById("block1").style.display = "block";
        document.getElementById("preview").style.display = "none";
    }
    if (event.target.getAttribute("id") == "tasks") {
        document.location.href = "/beejee/alltask";
    }
    if (event.target.getAttribute("id") == "tasks") {
        document.location.href = "/beejee/alltask";
    }
})