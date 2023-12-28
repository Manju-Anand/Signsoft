Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(function (e) {
    Array.from(e.querySelectorAll(".password-addon")).forEach(function (r) {
        r.addEventListener("click", function (r) {
            var o = e.querySelector(".password-input");
            "password" === o.type ? (o.type = "text") : (o.type = "password");
        });
    });
});
Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(function (s) {
    Array.from(s.querySelectorAll(".password-addon")).forEach(function (t) {
        t.addEventListener("click", function (t) {
            var e = s.querySelector(".password-input");
            "password" === e.type ? (e.type = "text") : (e.type = "password");
        });
    });
});
