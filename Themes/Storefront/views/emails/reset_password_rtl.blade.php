<!DOCTYPE html>
<html lang="en" style="-ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                    -webkit-print-color-adjust: exact;"
>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
    </head>

    <body dir="rtl" style="font-family: 'Open Sans', sans-serif;
                        font-size: 15px;
                        min-width: 320px;
                        margin: 0;"
    >
        <table style="border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="padding: 0;">
                        <table style="border-collapse: collapse; width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="background: {{ mail_theme_color() }}; text-align: center;">
                                        @if (is_null($logo))
                                            <h5 style="font-size: 30px;
                                                    line-height: 36px;
                                                    margin: 0;
                                                    padding: 30px 15px;
                                                    text-align: center;"
                                            >
                                                <a href="{{ route('home') }}" style="font-family: 'Open Sans', sans-serif;
                                                                                    font-weight: 400;
                                                                                    color: #ffffff;
                                                                                    text-decoration: none;"
                                                >
                                                    {{ setting('store_name') }}
                                                </a>
                                            </h5>
                                        @else
                                            <div style="display: flex;
                                                        height: 64px;
                                                        width: 200px;
                                                        align-items: center;
                                                        justify-content: center;
                                                        margin: auto;
                                                        padding: 16px 15px;"
                                            >
                                                <img src="{{ $logo }}" style="max-height: 100%; max-width: 100%;" alt="logo">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 40px 15px;">
                        <table style="border-collapse: collapse;
                                    min-width: 320px;
                                    max-width: 600px;
                                    width: 100%;
                                    margin: auto;"
                        >
                            <tr>
                                <td style="padding: 0;">
                                    <h4 style="font-family: 'Open Sans', sans-serif;
                                            font-weight: 400;
                                            font-size: 21px;
                                            line-height: 26px;
                                            margin: 0 0 15px;
                                            color: #555555;"
                                    >
                                        {{ trans('storefront::mail.hello', ['name' => $user->first_name]) }}
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        {{ trans('user::mail.received_a_password_reset_request') }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 30px 0; text-align: center;">
                                    <a href="{{ $url }}" style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 400;
                                                                text-decoration: none;
                                                                display: inline-block;
                                                                background: {{ mail_theme_color() }};
                                                                color: #fafafa;
                                                                padding: 11px 30px;
                                                                border: none;
                                                                border-radius: 3px;
                                                                outline: 0;"
                                    >
                                        {{ trans('user::mail.reset_password') }}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 16px;
                                                line-height: 26px;
                                                color: #666666;
                                                display: block;"
                                    >
                                        {{ trans('user::mail.no_further_action_is_required') }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 23px 0 0;">
                                    <span style="font-family: 'Open Sans', sans-serif;
                                                font-weight: 400;
                                                font-size: 15px;
                                                line-height: 24px;
                                                display: block;
                                                padding: 5px 0 10px;
                                                color: #666666;
                                                border-top: 1px solid #e9e9e9;"
                                    >
                                        {{ trans('user::mail.if_you\’re_having_trouble') }}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0;">
                                    <a href="{{ $url }}" style="font-family: 'Open Sans', sans-serif;
                                                                font-weight: 400;
                                                                font-size: 16px;
                                                                line-height: 26px;
                                                                text-decoration: underline;
                                                                color: #31629f;
                                                                word-break: break-all;"
                                    >
                                        {{ $url }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 15px 0; background: #f1f3f7; text-align: center;">
                        <span style="font-family: 'Open Sans', sans-serif;
                                    font-weight: 400;
                                    font-size: 16px;
                                    line-height: 26px;
                                    display: inline-block;
                                    color: #555555;
                                    padding: 0 15px;"
                        >
                            &copy; {{ date('Y') }}
                            <a target="_blank" href="{{ route('home') }}" style="text-decoration: none; color: #31629f;">
                                {{ setting('store_name') }}.
                            </a>
                            {{ trans('storefront::mail.all_rights_reserved') }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
