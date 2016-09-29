{include file="tpl/head.tpl"}
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">
سیستم مدیریت محتوای تحت وب گاتریا
    </div>
    <div class="body bg-gray">
    <form method="post" action="/login/{$redirect}" id="loginform">

            <div class="form-group">
                <input type="text" name="user" required class="form-control" placeholder="نام کاربری"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" required class="form-control" placeholder="کلمه عبور"/>
            </div>


            <button type="submit" class="btn bg-blue btn-block" >
                ورود
            </button>

            <p><a href="/forgot">
                    کلمه عبور خود را فراموش کرده ام
            </a></p>


    </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#loginform').bootstrapValidator();
        });
    </script>
    <div class="margin text-center">

        <span>
                              تمامی حقوق نـرمـ افـزار متعلق به
                  <a href="http://gatriya.com/" target="_blank">
                      گاتریا
                  </a>
است.
        </span>
        <br>
        Gatriya CMS {jdate("Y",strtotime( "now" ))} <i class="fa fa-copyright"></i>
    </div>
</div>


</body>
