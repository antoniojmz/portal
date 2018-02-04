var errorRut = 0;
var SnippetLogin = function() {
    var e = $("#m_login"),
        i = function(e, i, a) {
            var t = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(), t.prependTo(e), t.animateClass("fadeIn animated"), t.find("span").html(a)
        },
        a = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signin"), e.addClass("m-login--signup"), e.find(".m-login__signup").animateClass("flipInX animated")
        },
        t = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signup"), e.addClass("m-login--signin"), e.find(".m-login__signin").animateClass("flipInX animated")
        },
        r = function() {
            e.removeClass("m-login--signin"), e.removeClass("m-login--signup"), e.addClass("m-login--forget-password"), e.find(".m-login__forget-password").animateClass("flipInX animated")
        },
        n = function() {
            $("#m_login_forget_password").click(function(e) {
                e.preventDefault(), r()
            }), $("#m_login_forget_password_cancel").click(function(e) {
                e.preventDefault(), t()
            }), 
            $("#m_login_signup_cancel").click(function(e) {
                e.preventDefault(), t()
            })
        },
        l = function() {
            $("#m_login_signin_submit").click(function(e) {
                e.preventDefault();
                var a = $(this),
                t = $("#FormLogin");
                t.validate({ 
                    rules: {
                        'usrUserName': {
                            required: !0
                        },
                        'usrPassword': {
                            required: !0
                        },
                        'g-recaptcha-response': {
                            required: !0
                        }
                    },
                    messages:{
                        'usrUserName': "Se requiere este campo.",
                        'usrPassword': "Se requiere este campo.",
                        'g-recaptcha-response': "Se requiere este campo."
                    }
                })
                if (errorRut==0){ 
                t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), t.ajaxSubmit({
                        url: "/login",
                      success: function(e, r, n, l) {
                            setTimeout(function() {
                                var response = JSON.parse(e);
                                if(response.code==200){
                                    grecaptcha.reset(widgetId1);
                                    grecaptcha.reset(widgetId2);
                                    window.location.href = response.des_code;
                                }else{
                                    a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), i(t, "danger", response.des_code)
                                }
                            }, 2e3)
                        }
                    }))
                }
            })
        },
        o = function() {
            $("#m_login_forget_password_submit").click(function(a) {
                a.preventDefault();
                var r = $(this),
                    n = $("#FormRecuperacion");
                n.validate({ 
                    rules: {
                        'email': {
                            required: !0,
                            email: !0
                        },
                        'g-recaptcha-response':{
                            required: !0,
                        }
                    },
                    messages:{
                        'email': {
                            required: "Se requiere este campo.",
                            email: "Ingrese una dirección de correo válida."
                        },
                        'g-recaptcha-response': "Se requiere este campo."
                    }
                }), n.valid() && (r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), n.ajaxSubmit({
                    url: "/admin/recuperar",
                    success: function(a, l, s, o) {
                        setTimeout(function() {
                            var response = JSON.parse(rhtmlspecialchars(s.responseText).split("\n").join(""));
                            if(response.code==200){
                                r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n.clearForm(), n.validate().resetForm(), t();
                                var a = e.find(".m-login__signin form");
                                a.clearForm(), a.validate().resetForm(), i(a, "success", response.des_code)
                            }else{
                                r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), n.clearForm(), n.validate().resetForm(), t();
                                var a = e.find(".m-login__signin form");
                                a.clearForm(), a.validate().resetForm(), i(a, "danger", response.des_code)
                            }
                            grecaptcha.reset(widgetId1);
                            grecaptcha.reset(widgetId2);
                        }, 2e3)
                    }
                }))
            })
        };
    return {
        init: function() {
            n(), l(), /* s(),*/ o()
        }
    }
}();

var verificarRut = function(control){
    var res = Valida_Rut(control);
    var format = formateaRut(control.val(), res);
    if (format != false){
        errorRut = 0;       
        $("#ErrorRut").text("");
        return format;
    }else{
        errorRut = 1;       
        $("#ErrorRut").text("Rut invalido");
        return control.val();
    }
}

jQuery(document).ready(function() {
    SnippetLogin.init();
    $("#usrUserName").focusout(function() {
        var valid = $("#usrUserName").val();
        if (valid.length > 0){
            var res = verificarRut($("#usrUserName"));
            $("#usrUserName").val(res);
        }
    });
});