//Функция обработки Ajax запросов
function getAjaxRequest(adress, params, check, callback) {
    xmlhttp.open('POST', adress, true);
    if (check == true) {
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200) {
                callback(xmlhttp.responseText);
            }
        }
    }

    xmlhttp.send(params);
}
/*Создаем объект для работы аснхронными запросами*/
function getXmlHttp() {

    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

var xmlhttp = getXmlHttp();
// Отлавливаем нажатие клавиш и обрабатываем ответы сервера
document.addEventListener('click', function (event) {
    event = event || window.event;
    if (event.target.getAttribute("id") == "btn-register") {
        var name = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var submit = document.getElementById("btn-register").getAttribute("name");
        var adress = '/beejee/register';
        var params = 'username=' + name + "&email=" + email + "&password=" + password + "&submit=" + submit;
        getAjaxRequest(adress, params, true, function (response) {
            if (response != 200) {
                document.getElementById("nameerr").innerHTML = "";
                document.getElementById("emailerr").innerHTML = "";
                document.getElementById("passworderr").innerHTML = "";
                document.getElementById("emailerr").innerHTML = "";
                var errors = JSON.parse(response);
                if (errors['name'] != undefined) {
                    document.getElementById("nameerr").innerHTML = errors['name'];
                }
                if (errors['email'] != undefined) {
                    document.getElementById("emailerr").innerHTML = errors['email'];
                }
                if (errors['password'] != undefined) {
                    document.getElementById("passworderr").innerHTML = errors['password'];
                }
                if (errors['existemail'] != undefined) {
                    document.getElementById("emailerr").innerHTML = errors['existemail'];
                }
            } else {
                document.getElementById("success").innerHTML = "Теперь вы можеть оставить задачу";
            }
        })

    }
    if (event.target.getAttribute("id") == "btn-autorization") {
        var email = document.getElementById("email-a").value;
        var password = document.getElementById("password-a").value;
        var submit = document.getElementById("btn-autorization").getAttribute("name");
        var adress = '/beejee/autorization';
        var params = "email=" + email + "&password=" + password + "&submit=" + submit;
        getAjaxRequest(adress, params, true, function (response) {
            if (response != 401) {
                document.getElementById("form-a").style.visibility = "hidden";
                document.getElementById("form-a").style.opacity = 0;
                document.getElementById("autorization-form").style.visibility = "hidden";
                document.getElementById("autorization-form").style.opacity = 0;
                document.getElementById("user").innerHTML = response;
                document.getElementById("btn-task").classList.remove('disabled');
            } else {
                document.getElementById("autoerror").innerHTML = "Вы ввели неправильные регистрационные данные!";
                document.getElementById("btn-task").classList.addClass('disabled');
            }
        })

    }
    if (event.target.getAttribute("id") == "add" || event.target.getAttribute("id") == "add-preview") {
        var myForm = document.getElementById("bodytask");
        var form = new FormData(myForm);
        var adress = '/beejee/newtask';
        getAjaxRequest(adress, form, false, function (response) {
            myForm.reset();
        });

    }
    if (event.target.className == "edit btn btn-success btn-sm") {
        var id = event.target.getAttribute("id");
        var idtask = id.substring(0, id.indexOf("b"));
        var text = document.getElementById(idtask + "a").value;
        var adress = '/beejee/edit';
        var params = "text=" + text + "&id=" + idtask;
        getAjaxRequest(adress, params, true, function (response) {
        })

    }
    if (event.target.getAttribute("id") == "exit") {
        var adress = '/beejee/exit';
        var params = 'exit=' + "true";
        getAjaxRequest(adress, params, true, function (response) {
            window.location.reload();
        })
    }
});
document.addEventListener("change", function (event) {
    event = event || window.event;
    if (event.target.className == "change") {
        var id = event.target.getAttribute("id");
        if (event.target.getAttribute("value") == 1) {
            event.target.setAttribute("value", 0);
            var status = 1;
        } else {
            event.target.setAttribute("value", 1);
            var status = 0;
        }
        var idtask = id.substring(0, id.indexOf("c"));
        var adress = '/beejee/status';
        var params = "id=" + idtask + "&status=" + status;
        getAjaxRequest(adress, params, true, function (response) {
        })
    }
    if (event.target.getAttribute("id") == "check") {

        if (event.target.getAttribute("value") == 1) {
            event.target.setAttribute("value", 0);
            var status = 1;
        } else {
            event.target.setAttribute("value", 1);
            var status = 0;
        }
        var status = document.getElementById("check").value;
        var search = document.getElementById("search").value;
        var adress = '/beejee/search';
        var params = "search=" + search + "&status=" + status;
        getAjaxRequest(adress, params, true, function (response) {
            document.getElementById("s-task").innerHTML = response;
        })
    }
})
window.onload = function () {
    document.getElementById("search").oninput = function (event) {
        event = event || window.event;
        var status = document.getElementById("check").value;
        var search = event.target.value;
        var adress = '/beejee/search';
        var params = "search=" + search + "&status=" + status;
        getAjaxRequest(adress, params, true, function (response) {
            document.getElementById("s-task").innerHTML = response;
        })
    }
}