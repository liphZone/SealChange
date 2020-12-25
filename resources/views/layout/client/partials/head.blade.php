<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ config('app.name') }} - @yield('title') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="AdminTemplate/assets/vendors/css/vendor.bundle.addons.css">

    <link rel="stylesheet" href="AdminTemplate/assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="AdminTemplate/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="AdminTemplate/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="AdminTemplate/assets/images/favicon.png" />

<style>
    body {
    font-family: Open Sans;
}

@-webkit-keyframes animatetop {
    from {
        top: -300px;
        opacity: 0;
    }
    to {
        top: 0;
        opacity: 1;
    }
}

@keyframes animatetop {
    from {
        top: -300px;
        opacity: 0;
    }
    to {
        top: 0;
        opacity: 1;
    }
}

#modal {
    display: block;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    padding-left: 20%;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modalContent {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
}

.modalClose {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.modalClose:hover, .modalClose:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modalHeader {
    padding: 2px 16px;
    background-color: #4a63f0;
    color: white;
}

.modalBody {
    padding: 2px 16px;
}
</style>
</head>