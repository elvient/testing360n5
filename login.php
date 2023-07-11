<?php 
session_start();

if (isset($_SESSION['token'])) {
    header('Location: index.php');
} else { ?>
<html>
<head>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login">
        <h1>Sign In</h1>
        <form id="lg-form" action="functions/login.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username" required="required" />
            <input type="password" name="password" id="password" placeholder="Password" required="required" />
            <button id="login" class="btn btn-primary btn-block btn-large">Sign In</button>
        </form>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#login").click(function(e) {

            var action = $("#lg-form").attr('action');
            var form_data = {
                action: 'login',
                username: $("#username").val(),
                password: $("#password").val()
            };

            $.ajax({
                url: action,
                type: "POST",
                data: form_data,
                success: function(response)
                {
                    if (response) {
                        window.location.reload();
                    } else {
                        alert('Login tidak berhasil!')
                    }
                }
            });

            e.preventDefault();
        });
    })
</script>
</html>
<?php } ?>
