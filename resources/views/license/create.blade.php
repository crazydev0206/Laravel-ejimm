<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Roboto:400,500&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Activate FleetCart</title>

    <style>
        html {
            min-width: 320px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-size: 15px;
            position: relative;
            display: flex;
            background: #f1f3f7;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            overflow-y: auto;
        }

        h1, h2, h3, h4, h5, h6, ul, li, p {
            margin: 0;
            padding: 0;
        }

        /* typography */

        h1, h2, h3, h4, h5, h6 {
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            color: #444444;
        }

        h1 {
            font-size: 36px;
            line-height: 44px;
        }

        h2 {
            font-size: 30px;
            line-height: 36px;
        }

        h3 {
            font-size: 24px;
            line-height: 29px;
        }

        h4 {
            font-size: 21px;
            line-height: 26px;
        }

        h5 {
            font-size: 19px;
            line-height: 23px;
        }

        h6 {
            font-size: 16px;
            line-height: 20px;
        }

        /* form */

        form {
            overflow: hidden;
        }

        .form-group label {
            font-family: 'Open Sans', sans-serif;
        }

        .form-group .input-icon {
            position: absolute;
            font-size: 21px;
            color: #444444;
            left: 5px;
            top: 6px;
            width: 30px;
            text-align: center;
            transition: 200ms ease-in-out;
        }

        .form-control {
            font-size: 15px;
            box-shadow: none;
            height: 40px;
            padding: 6px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 3px;
            outline: 0;
        }

        .form-control:focus {
            border-color: rgba(0, 104, 225, 0.8);
            box-shadow: none;
            transition: 200ms ease-in-out;
        }

        .form-control:focus + .input-icon {
            color: #0068e1;
        }

        .has-error .form-control,
        .has-error .form-control:focus {
            border-color: #ff3366;
        }

        .has-error .form-control + .input-icon {
            color: #ff3366;
        }

        .help-block {
            display: block;
            margin-top: 5px;
            color: #ff3366;
        }

        .has-error .help-block {
            color: #ff3366;
        }

        /* button */

        .btn {
            font-size: 15px;
            padding: 10px 20px;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: 200ms ease-in-out;
        }

        .btn-primary {
            background: #0068e1;
            border: none;
            outline: 0;
        }

        .btn-primary:active,
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active:focus {
            background: #0059bd;
            outline: 0;
        }

        /* alert */

        .alert {
            border: none;
            color: #555555;
            font-size: 15px;
            padding: 12px 15px;
            border-radius: 3px;
        }

        .alert .close {
            top: 4px;
            right: 0;
            outline: 0;
            opacity: 0.5;
            color: #626060;
            text-shadow: none;
            font-weight: normal;
            transition: 200ms ease-in-out;
        }

        .alert .close:hover {
            opacity: 0.9;
        }

        .alert .alert-text {
            display: block;
            margin: 6px 20px 0 45px;
        }

        .alert-icon {
            float: left;
            width: 30px;
            height: 30px;
            display: table;
            border-radius: 50%;
            text-align: center;
        }

        .alert-icon > i {
            font-size: 18px;
            display: table-cell;
            vertical-align: middle;
        }

        .alert-success {
            background: #deedee;
            border-left: 3px solid #37bc9b;
        }

        .alert-success .alert-icon {
            background: #c5e6e2;
        }

        .alert-success .alert-icon > i {
            color: #37bc9b;
        }

        .alert-danger {
            background: #f2e8ee;
            border-left: 3px solid #ff3366;
        }

        .alert-danger .alert-icon {
            background: #f4ced5;
        }

        .alert-danger .alert-icon > i {
            color: #ff3366;
        }

        .login-page {
            width: 360px;
            margin: auto;
            padding: 40px 0;
        }

        .login-wrapper {
            position: relative;
            background: #ffffff;
            border-radius: 3px;
            padding: 15px;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.15);
            z-index: 0;
        }

        .login-wrapper .bg-blue {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            height: 80px;
            background: #0068e1;
            overflow: hidden;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            z-index: -1;
        }

        .login-wrapper .bg-blue .reflection {
            position: absolute;
            left: -105px;
            top: 0;
            height: 300px;
            width: 300px;
            background: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
            transform: rotate(50deg);
        }

        .login-wrapper .form-inner {
            background: #ffffff;
            border-radius: 3px;
            border: 1px solid #e9e9e9;
            margin: 15px 0 0;
            padding: 0 15px 10px;
        }

        .login-wrapper h3 {
            margin: 15px 0;
        }

        .login-wrapper p {
            margin-bottom: 20px;
        }

        .login-wrapper .form-group {
            position: relative;
        }

        .login-wrapper .form-group label > span {
            color: #fc4b4b;
            margin-left: 4px;
        }

        .login-wrapper .form-control {
            padding-left: 36px;
        }

        .login-wrapper button {
            display: table;
            margin: 20px auto 5px;
            padding-left: 60px;
            padding-right: 60px;
        }

        .login-wrapper a {
            display: table;
            margin-top: 10px;
            color: #0068e1;
        }

        .login-wrapper a:hover {
            text-decoration: underline;
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading:after {
            position: absolute;
            content: "";
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            height: 16px;
            width: 16px;
            border: 2px solid #fff;
            border-radius: 100%;
            border-right-color: transparent;
            border-top-color: transparent;
            animation: spinAround 600ms infinite linear;
        }

        .btn-loading.btn-default:after {
            border: 2px solid #0068e1;
            border-right-color: transparent;
            border-top-color: transparent;
        }

        @keyframes spinAround {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(359deg);
            }
        }
    </style>
</head>
<body>
    <div class="login-page">
        @if (session()->has('error'))
            <div class="alert alert-danger fade in alert-dismissable clearfix">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <div class="alert-icon">
                    <i class="fa fa-exclamation" aria-hidden="true"></i>
                </div>

                <span class="alert-text">{{ session('error') }}</span>
            </div>
        @endif

        <div class="login-wrapper">
            <div class="bg-blue">
                <div class="reflection"></div>
            </div>

            <div class="form-inner clearfix">
                <h3 class="text-center">Activation</h3>
                <p class="text-center">Enter your purchase code to activate FleetCart</p>

                <form method="POST" action="{{ route('license.store') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" name="purchase_code" class="form-control" placeholder="Purchase Code">

                        <div class="input-icon">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </div>

                        {!! $errors->first('purchase_code', '<span class="help-block error">:message</span>') !!}
                    </div>

                    <button type="submit" class="btn btn-primary" data-loading>Activate</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>
        $(document).on('click', '[data-loading]', function (e) {
            var button = $(e.currentTarget);

            if (button.is('i')) {
                button = button.parent();
            }

            if (button.hasClass('disabled')) {
                return e.preventDefault();
            }

            button.data('loading-text', button.html())
                .addClass('btn-loading')
                .button('loading');
        });
    </script>
</body>
</html>
