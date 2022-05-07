'use strict';
// DOM
window.addEventListener('load', () => {
    const selectEstado = document.querySelectorAll('select[data-id]');
    const _token = document.querySelector('[name=_token]').value;
    selectEstado.forEach(element => {
        element.addEventListener('change', async() => {
            const estado = element.value;
            const id_api = element.dataset.id;
            if (estado) {
                const read = await ajax(`_token=${_token}&id_api=${id_api}&estado=${estado}`);
                element.value = read;
                element.disabled = true;
            } else {
                element.disabled = true;
            }
        })
    });

    const ajax = (data) => {
        return new Promise((resolve, reject) => {
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText) {
                        resolve(this.responseText);
                    } else {
                        resolve(false);
                    }
                }
            };
            xhttp.open("POST", '/ajaxEstado', false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(data);
        });
    }
})