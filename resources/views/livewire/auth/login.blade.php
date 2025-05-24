<div class="containerx">

    <div class="center">
        <img src="{{asset('logo/logo.webp')}}" alt="Icon"
             style="width: 180px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -250%);"
        >

{{--        <h2>Please Log In</h2>--}}
        <form wire:submit.prevent="login">
            <input type="email" placeholder="email" wire:model.live="email">
            <input type="password" placeholder="password" wire:model.live="password">
            <h2>&nbsp;</h2>
            <button type="submit" class="button">
                Login
            </button>
        </form>

        <h2>&nbsp;</h2>
    </div>

    <style>


        *,*:before,*:after{box-sizing:border-box}

        body{
            min-height:100vh;
            font-family: 'Raleway', sans-serif;
        }

        .containerx{
            position:absolute;
            width:100% !important;
            height:100%;
        }

        .center{
            position:absolute;
            width:400px;
            height:400px;
            top:50%;left:50%;
            margin-left:-200px;
            margin-top:-200px;
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding:30px;
            opacity:1;
            transition:all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
            transition-delay:0s;
            color:#333;

            input{
                width:100%;
                padding:15px;
                margin:5px;
                border-radius:1px;
                border:1px solid #ccc;
                font-family:inherit;
            }
        }

        .button {
            background-color: black; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            display: block;
            margin: auto;
        }
    </style>
</div>


