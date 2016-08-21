Vue.filter('displayMedia', function(value) {

     if(String(value).match(/.*\.(png|jpe?g|gif)(\?.*)?$/i)) {
         return '<img src="' + IMG_BASE_URL + value + '" class="admin-thumb img-responsive">';
     } else if(String(value).match(/.*\.(pdf|doc|docx)(\?.*)?$/i)) {
         return '<a href="' + FILES_BASE_URL + value + '" class="">' + value + '</a>';
     } else {
         return value;
     }
 });

 Vue.directive('ajax', {
    params: ['complete'],

    bind: function () {
        this.el.addEventListener(
            'submit', this.onSubmit.bind(this)
        );
    },

    onSubmit: function (e) {
        e.preventDefault();
        var requestType = this.getRequestType();
        var data = this.getFormData();
        console.log(requestType);
        console.log(this.el.action);
        console.log(data);
        this.vm
            .$http[requestType](this.el.action, data)
            .then(this.onComplete, this.onError);
    },

    onComplete: function (response) {
        console.log('onComplete');
        console.log(response.body);
        this.$dispatch('formSubmitted', JSON.parse(response.body));
    },

    onError: function (response) {
        console.log('error');
        // console.log(response.data);
    },

    getRequestType: function () {
        return this.el.method.toLowerCase();
    },
    getFormData: function() {
        // You can use $(this.el) in jQuery and you will get the same thing.
        var serializedData = $(this.el).serializeArray();
        var objectData = {};
        $.each(serializedData, function() {
            if (objectData[this.name] !== undefined) {
                if (!objectData[this.name].push) {
                    objectData[this.name] = [objectData[this.name]];
                }
                objectData[this.name].push(this.value || '');
            } else {
                objectData[this.name] = this.value || '';
            }
        });
        return objectData;
    },
});
