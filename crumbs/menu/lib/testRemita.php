<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> Remita - Inline Sample</title>
    <style type="text/css">
        .form-style-1 {
            margin: 10px auto;
            max-width: 400px;
            padding: 20px 12px 10px 20px;
            font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        }

        .form-style-1 li {
            padding: 0;
            display: block;
            list-style: none;
            margin: 10px 0 0 0;
        }

        .form-style-1 label {
            margin: 0 0 3px 0;
            padding: 0px;
            display: block;
            font-weight: bold;
        }

        .form-style-1 input[type=text],
        .form-style-1 input[type=date],
        .form-style-1 input[type=datetime],
        .form-style-1 input[type=number],
        .form-style-1 input[type=search],
        .form-style-1 input[type=time],
        .form-style-1 input[type=url],
        .form-style-1 input[type=email],
        textarea,
        select {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            border: 1px solid #BEBEBE;
            padding: 7px;
            margin: 0px;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;
        }

        .form-style-1 input[type=text]:focus,
        .form-style-1 input[type=date]:focus,
        .form-style-1 input[type=datetime]:focus,
        .form-style-1 input[type=number]:focus,
        .form-style-1 input[type=search]:focus,
        .form-style-1 input[type=time]:focus,
        .form-style-1 input[type=url]:focus,
        .form-style-1 input[type=email]:focus,
        .form-style-1 textarea:focus,
        .form-style-1 select:focus {
            -moz-box-shadow: 0 0 8px #88D5E9;
            -webkit-box-shadow: 0 0 8px #88D5E9;
            box-shadow: 0 0 8px #88D5E9;
            border: 1px solid #88D5E9;
        }

        .form-style-1 .field-divided {
            width: 49%;
        }

        .form-style-1 .field-long {
            width: 100%;
        }

        .form-style-1 .field-select {
            width: 100%;
        }

        .form-style-1 .field-textarea {
            height: 100px;
        }

        .form-style-1 input[type=submit], .form-style-1 input[type=button] {
            background: #f44336;
            padding: 8px 15px 8px 15px;
            border: none;
            color: #fff;
        }

        .form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover {
            background: #e0372b;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }

        .form-style-1 .required {
            color: red;
        }
    </style>
</head>
<body>
<form onsubmit="makePayment()" id="payment-form">
    <ul class="form-style-1">
        <li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" id="js-firstName" name="firstName" class="field-divided" placeholder="First"/>&nbsp;
            <input type="text" id="js-lastName" name="lastName" class="field-divided" placeholder="Last"/>
        </li>
        <li>
            <label>Email <span class="required">*</span></label>
            <input type="email" id="js-email" name="email" class="field-long"/>
        </li>
        <li>
            <label>Narration <span class="required">*</span></label>
            <input type="text" id="js-narration" name="narration" class="field-long"/>
        </li>
        <li>
            <label>Amount <span class="required">*</span></label>
            <input type="number" id="js-amount" name="amount" class="field-long"/>
        </li>
        <li>
            <input type="button" onclick="makePayment()" value="Pay"/>
        </li>
    </ul>
</form>
<?php echo sha512(798431); ?>
<script>
    function setDemoData() {
        var obj = {
            firstName: "Mike",
            lastName: "Oshadami",
            email: "oshadami@specs.com",
            narration: "Test Payment",
            amount: "19999"
        };
        for (var propName in obj) {
            document.querySelector('#js-' + propName).setAttribute('value', obj[propName]);
        }
    }

    function makePayment() {
        var form = document.querySelector("#payment-form");
        var paymentEngine = RmPaymentEngine.init({
            key: 'REVNT05UR0lGVHw0MDgyNTIxNHwxZTI1NGNlNTVhMzkyYTgxYjYyNjQ2ZWIwNWU0YWE4ZTNjOTU0ZWFlODllZGEwMTUwMjYyMTk2ZmFmOGMzNWE5ZGVjYmU3Y2JkOGI5ZWI5YzFmZWMwYTI3MGI5MzA0N2FjZWEzZDhiZjUwNDY5YjVjOGY3M2NhYjQzMTg3NzI4Mg==',
            customerId: form.querySelector('input[name="email"]').value,
            firstName: form.querySelector('input[name="firstName"]').value,
            lastName: form.querySelector('input[name="lastName"]').value,
            email: form.querySelector('input[name="email"]').value,
            amount: form.querySelector('input[name="amount"]').value,
            narration: form.querySelector('input[name="narration"]').value,
            onSuccess: function (response) {
                console.log('callback Successful Response', response);
            },
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            onClose: function () {
                console.log("closed");
            }
        });
         paymentEngine.showPaymentWidget();
    }

    window.onload = function () {
        setDemoData();
    };
</script>
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
</body>
</html>