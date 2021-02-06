export default class Forms {

    static $doc = $(document);

    /**
     * GET value input
     * @param idForm
     * @param idInput
     * @returns {*|string|undefined|jQuery}
     */
    static getValue(idForm, idInput){
        return  ($(idForm).find(idInput).val()).trim();
    }

    /**
     * set input value
     * @param idForm
     * @param idInput
     * @param value
     */
    static setValue(idForm, idInput, value){
        $(idForm).find(idInput).val(value);
    }



    /**
     * Make the request Ajax
     * @param method
     * @param url
     * @param dynamic_function
     * @param data
     */
    static requestAjax(method, url, dynamic_function, data = []) {

        if(method === 'GET' || method === 'get'){
            fetch(
                url,
                {
                    headers: {
                        "Content-Type":"application/json",
                        "Accept":"application/json, text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                }
            ).then(response => response.json())

                .then(response => {

                    dynamic_function(response);

                }).catch(error => {
                console.log(error)
            });

        }else{

            fetch(
                url,
                {
                    headers: {
                        "Content-Type":"application/json",
                        "Accept":"application/json, text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                    body: JSON.stringify(data),
                }
            ).then(response => response.json())

                .then(response => {

                    dynamic_function(response);

                }).catch(error => {
                console.log(error)
            });
        }

    }


    /**
     *
     * @param idForm
     * @param idInput
     */
    static submitWithEnter(idForm, idInput) {

        Forms.$doc.on('keypress', `${idForm} ${idInput}`, function (event) {

            if(event.which === 13){

                event.preventDefault();

                $(idForm).find("#submit").click();
            }
        });
    }

    static scrollToBottomFunc() {

        const body = $('html, body');

        body.stop().animate({
            scrollTop: body.get(0).scrollHeight
        }, 50);
    }

    /**
     *
     * @param data
     */
    static contentMessages(data){

        const content_messages = $('.message');

        content_messages.append(`
                    <li class="p-2 mb-2 bg-light rounded">
                        <span class="d-block font-weight-bold">${ data["user_name"] }</span>
                        <span class="d-block">${ data["body"] }</span>
                         <span class="d-block small">${ data["created_at"] }</span>
                    </li>
           `);



    }
}
