<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <title>Document</title>
    <style>
        #form-col{
            padding: 40px 20px 60px;
            background:white;
        }
        body{
            margin-top:20px;
            background:#eee;
        }
        .avatar.avatar-xl {
            width: 5rem;
            height: 5rem;
        }
        .avatar {
            width: 2rem;
            height: 2rem;
            line-height: 2rem;
            border-radius: 50%;
            display: inline-block;
            background: #ced4da no-repeat center/cover;
            position: relative;
            text-align: center;
            color: #868e96;
            font-weight: 600;
            vertical-align: bottom;
        }
        .card {
            background-color: #fff;
            border: 0 solid #eee;
            border-radius: 0;
        }
        .card {
            margin-bottom: 30px;
            -webkit-box-shadow: 2px 2px 2px rgba(0,0,0,0.1), -1px 0 2px rgba(0,0,0,0.05);
            box-shadow: 2px 2px 2px rgba(0,0,0,0.1), -1px 0 2px rgba(0,0,0,0.05);
        }
        .card-body {
            padding: 1.25rem;
        }
        .tile-link {
            position: absolute;
            cursor: pointer;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            z-index: 30;
        }
        #contacts-row{
            height: 400px; 
            overflow: auto;
        }
    </style>
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 p-4">
        <div class="h3 text-secondary mb-4 text-center">Contacts List</div>
        <div class="form-group">
                <input type="text" class="form-control" id="keyword" aria-describedby="" placeholder="Enter a keyword...">
        </div>
        <div class="row" id="contacts-row">

        </div>
    </div>
    <div class="col-md-4" id="form-col">
        <div class="h3 text-center text-secondary">Create New Contact</div>
        <form id="myForm" class="mt-5">
            <div class="form-group">
                <input type="email" class="form-control" id="email" aria-describedby="" placeholder="Email Address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="fullname" aria-describedby="" placeholder="Fullname...">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="username" aria-describedby="" placeholder="Username...">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="phoneNumber" aria-describedby="" placeholder="Phone Number">
            </div>
            <button id="submit-btn" type="button" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
  </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        loadContacts("");

        function loadContacts(word) {
            $.ajax({
                    type: "POST",
                    url: "contacts",
                    data: {
                        keyword:word
                    },
                    success: function (response) {
                        $(response['contacts']).each(function() {
                            let item = setContact(this);
                            $("#contacts-row").append(item);
                            // console.log(item);
                        });
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
        }
        function setContact(contact) {
            return `    
                <div class="col-md-6">                       
                    <div class="card">
                    <div class="card-body">
                    <div class="media align-items-center"><span style="background-image: url(https://ui-avatars.com/api/?name=${contact['username']})" class="avatar avatar-xl mr-3"></span>
                        <div class="media-body overflow-hidden">
                        <h5 class="card-text mb-0">${contact['fullname']}</h5>
                        <p class="card-text text-uppercase text-muted">${contact['username']}</p>
                        <p class="card-text email-text">
                        ${contact['email']}<br><abbr title="Phone">P:  </abbr> ${contact['phone_number']}
                        </p>
                        </div>
                    </div><a href="#" class="tile-link"></a>
                    </div>
                </div>
            </div>`
        }
        $("#submit-btn").on("click", function () {
            let formData = {
                email: $("#email").val(),
                fullname: $("#fullname").val(),
                username: $("#username").val(),
                phoneNumber: $("#phoneNumber").val()
            };

            $.ajax({
                type: "POST",
                url: "contact",
                data: formData,
                success: function (response) {
                    $("#contacts-row").empty();
                    loadContacts("");
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        $("#keyword").on("input", function() {
            $("#contacts-row").empty();
            loadContacts($(this).val())
        })
    });
</script>
</html>