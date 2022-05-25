var App = (function(){

    var self = this;


    this.uri_segment = function (segment) {

        var url = window.location.href;
        var seg = url.split('/');
        return seg[segment+2];

    };

    this.is_page = function (page,segment='') {

        var url = window.location.href;
        var $url = url.split('/');

        if(segment!='') {
            $url = $url[segment+2];
        } else {
            $url = $url.pop();
        }

        if($url === page)
            return true;

    };

    this.modal = function (params) {

        bootbox.dialog({
            title: params.title,
            message: params.msg,
            size: params.size ? params.size : 'large',
            onEscape: true,
            backdrop: true,
            buttons: params.buttons ? params.buttons : {
                cancel: {
                    label: 'Close',
                    className: 'btn-light',
                    callback : function () {
                        if(params.cancel) {
                            params.cancel();
                        }

                        bootbox.hideAll();
                    }
                }
            },
            onShown : function (e) {
                if(params.shown) {
                    params.shown();
                }
            }
        })

    };

    this.click = function (elem,fn) {

        $(document).on('click',elem,function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            fn(this,e);
        });

    };

    this.change = function (elem,fn) {

        $(document).on('change',elem,function (e) {

            e.preventDefault();
            e.stopImmediatePropagation();
            fn(this,e);

        });

    };

    this.redirect = function (url='') {

        window.location.href = base_url + url;
    };

    this.request = function (params) {

        $.ajax({
            method: params.method ? params.method : "POST",
            url: params.url ? base_url + params.url : base_url,
            data: params.data,
            dataType : params.type ? params.type : 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).done(function (data) {
            params.success(data);
        }).fail(function (data) {
            self.swal({
                title: "ERROR!",
                text: "An unknown error occured, please try again!",
                confirmButtonColor: "#DD6B55",
                type: "warning"
            });
        });

    };

    this.swal = function (params) {

        Swal.fire({
            title: params.title,
            text: params.text,
            confirmButtonColor: params.confirmBtnColor === true ? params.confirmBtnColor : '#1ab394',
            confirmButtonText: params.confirmTxt || 'Okay',
            showCancelButton: params.showCancel
        }).then((result) => {

            if (result.isConfirmed) {
                if(params.callback) {
                    params.callback();
                }
            }
        })

    };

    this.throwError = function (error) {

        self.swal({
            title: "ERROR!",
            text: error || "An unknown error occured, please try again!",
            confirmButtonColor: "#DD6B55",
            type: "warning"
        });

    };

    this.validation = function (validation,callback) {

        validation.validate().then(function(status) {
            if (status == 'Valid') {

                callback();

            } else {
                swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function() {
                    KTUtil.scrollTop();
                });
            }
        });

    };

    this.money_format = function (num) {
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'GBP',

            // These options are needed to round to whole numbers if that's what you want.
            //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
        });

        return formatter.format(num);
    };

    this.blockPage = function () {

        KTApp.blockPage({
            overlayColor: '#000000',
            state: 'danger',
            message: 'Please wait...'
        });

    };

    this.unblockPage = function () {

        KTApp.unblockPage();

    };

    this.block = function (el) {

        KTApp.block(el,{});

    };

    this.block = function (el) {

        KTApp.unblock(el);

    };

    this.init = function () {

        //

    };

});

let app = new App();
app.init();