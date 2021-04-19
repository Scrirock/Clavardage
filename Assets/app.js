setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        const message = JSON.parse(xhr.responseText);
        const divMessage = document.querySelector("#containerMessage");
        divMessage.innerHTML = "";

        message.forEach(message => {
            divMessage.innerHTML += `
                <div class="containerMessage">
                    <div class="userPost">${message.user}: </div>
                    <div class="messagePost">${message.message}</div>
                    <div class="datePost">${message.datePost}</div>
                </div>
            `;
        });
    };

    xhr.open('GET', './api/Messages');
    xhr.send();
}, 1000);

const form = document.querySelector('#post form');
document.body.addEventListener('keypress', function(event) {
    if (event.key === "Enter"){
        const message = form.querySelector('textarea[name="message"]').value;

        let xhrPost = new XMLHttpRequest();
        xhrPost.onload = function () {
            const response = JSON.parse(xhrPost.responseText);
        }

        const messageData = {
            'message': message,
        };

        xhrPost.open('POST', './api/Messages');
        xhrPost.setRequestHeader('Content-Type', 'application/json');
        xhrPost.send(JSON.stringify(messageData));
        form.querySelector('textarea[name="message"]').value = "";
    }
});

const valid = document.getElementById("valid");
valid.addEventListener('click', function(event) {
    const username = document.querySelector('#changeUsername').value;

    let xhrUserChange = new XMLHttpRequest();
    xhrUserChange.onload = function () {
        const response = JSON.parse(xhrUserChange.responseText);
    }

    const userChange = {
        'userChange': username,
    };

    xhrUserChange.open('POST', './api/Messages');
    xhrUserChange.setRequestHeader('Content-Type', 'application/json');
    xhrUserChange.send(JSON.stringify(userChange));
    document.querySelector('#changeUsername').value = "";

    document.cookie = "username="+username+"; expires=Thu, 18 Dec 2900 12:00:00 UTC; path=/";

});

if(document.cookie.length > 0){
    let regSepCookie = new RegExp('(; )', 'g');
    let cookies = document.cookie.split(regSepCookie);

    for(let i = 0; i < cookies.length; i++){
        let regInfo = new RegExp('=', 'g');
        let infos = cookies[i].split(regInfo);
        if(infos[0] === "username"){
            document.getElementById("divCreate").style.display = "none";
        }
    }
}

const create = document.getElementById("create");
create.addEventListener('click', function(event) {
    const username = document.querySelector('#createUser').value;

    let xhrUser = new XMLHttpRequest();
    xhrUser.onload = function () {
        const response = JSON.parse(xhrUser.responseText);
    }

    const userData = {
        'user': username,
    };

    xhrUser.open('POST', './api/Messages');
    xhrUser.setRequestHeader('Content-Type', 'application/json');
    xhrUser.send(JSON.stringify(userData));
    document.getElementById("divCreate").style.display = "none";

    document.cookie = "username="+username+"; expires=Thu, 18 Dec 2900 12:00:00 UTC; path=/";
});