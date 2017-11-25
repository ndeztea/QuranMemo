<!DOCTYPE html>
<html>
    <head>
        <style>
        .password{
            font-size:24px;
            text-align: center;
        }
        .order-detail{
            border: 1px solid #ddd;
            background-color: #eee;
            padding: 15px;
        }
        .order-detail .price,.order-detail .rekening{
            font-size: 27px;
            border: 1px dashed #cbbda3;
            background-color: #fff7e9;
            text-align: center;
            margin: 20px 0px;
            padding: 5px;
        }
        hr{
            border-top: 1px solid #848484;
        }
        .btn-green {
            background-color: #00978A;
            color: #fff;
            font-size: 14px;
            /* margin-left: 3px; */
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 14px;
            width: 96%;
            font-size: 22px;
        }
        table {
            max-width: 600px;
        }
        </style>

    </head>
    <body>
        <table style="width:100%">
            <tr>
                <td style="background-color: #00978A;padding: 13px;" >
                    <img src="{{url('assets/images/main_logo.png')}}"/>
                </td>
            </tr>
            <tr>
                <td>@yield('content')</td>
            </tr>
        </table>
        
    </body>
</html>