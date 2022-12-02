    // バリデーション
    (function() {
        var form = document.querySelector('#form1');
        form.addEventListener('submit', function(event) {
            form.querySelectorAll('.form-control').forEach(function(elm) {
                var required = elm.required;
                var maxlen = elm.getAttribute('data-maxlen');
                var maxnum = elm.getAttribute('data-maxnum');
                var regexp = elm.getAttribute('data-regexp');
                if ((required && (elm.value.length == 0)) ||
                    (maxlen && (maxlen < elm.value.length)) ||
                    (maxnum && (maxnum < Number(elm.value))) ||
                    (regexp && !(elm.value.match(regexp)))) {
                    elm.classList.add('is-invalid');
                    elm.classList.remove('is-valid');
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    elm.classList.add('is-valid');
                    elm.classList.remove('is-invalid');
                }
            });
        });
    })();