<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>040_pages</title>
    <link rel="stylesheet" href="reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
    

        .disb {
            display: block;
        }

        .sbar {
            width: 80%;
            display: flex;
            justify-content: center;
            margin: 10px auto;

        }

        #IPSEARCH {
            border-radius: 10px;
            padding: 0 5px;
            width: 340px;
            height: 40px;
            line-height: 40px;
            font-size: 36px;
        }

        img {
            width: 100%;
        }

        #cardFrame {
            width: 60%;
            display: flex;
            background-color: #ccc;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin: 0 auto;
        }

        .col {
            width: 25%;
            padding: 10px 10px;


        }

        .cardtest {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            background-color: #3c3;
            aspect-ratio: 2/3;
            justify-content: space-around;
            padding: 0 3%;
        }

        .cardtest .imgFR {
            height: 70%;
            width: 80%;
        }

        h3 {
            font-size: 24px;
            line-height: 30px;
            text-align: center;
        }

        p {
            text-align: center;
            /* width: 100%; */
            word-wrap: break-word;
        }

        #btnFR {
            display: flex;
            width: 500px;
            justify-content: space-around;
            margin: 20px auto;
        }

        .btnpage {
            cursor: pointer;
            border: 1px solid red;
            width: 20px;
            height: 20px;
            text-align: center;
        }

        .nav {
            display: flex;
            height: 50px;
            width: 100%;
            background-color: #cfc;
            justify-content: end;
            align-items: center;
            padding: 0 5%;
            position: sticky;
            top: 0;
        }

        .nav2 {
            background-color: #ccf;
        }

        .LOGIN {
            margin: 0 2%;
        }

        .LOGOUT {
            margin: 0 2%;
        }

        fieldset {
            width: fit-content;
            border: 3px dotted aqua;
            border-radius: 10px;
            margin: 20px auto;
        }

        legend {
            border: 3px dotted aqua;
            border-radius: 10px;
            padding: 5px 20px;
        }

        .st {
            width: 400px;
            border-bottom: 3px double #F0F;
            padding-bottom: 10px;
            margin: 20px;

        }

        .title {
            width: 100px;
            float: left;
            text-align: right;
            padding-right: 10px;
        }

        textarea {
            border-width: 2px;
        }

        .btn {
            text-align: center;
        }

        .cartListFrame {
            width: 80%;
            margin: 2% auto;
        }

        .cardrow {
            background-color: #ecc;
            height: 150px;
            display: flex;
            padding: 2%;
        }

        .productimg {
            width: 20%;
            border: 1px red solid;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .productName {
            width: 45%;
            border: 1px red solid;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
        }

        .controlPlate {
            border: 1px red solid;
            width: 15%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .price {
            width: 10%;
            border: 1px red solid;
            justify-content: center;
            display: flex;
            align-items: center;
        }

        /* .price::before{
            content:'單價:'
        } */
        .totalprice {
            display: flex;
            border: 1px red solid;
            align-items: center;
            width: 10%;
            justify-content: space-around;
        }

        .cartForm {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            line-height: 50px;

        }

        #sum {
            width: 10%;
            height: 20%;
            background-color: #cfc;
            position: fixed;
            right: 0;
            top: 40%;
            flex-direction: column;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .orderAllFrame {
            /* background-color: #cfc; */
            width: 90%;
            margin: 0 auto;
        }

        .orderframe {
            background-color: #ccc;
            width: 100%;
            margin: 5px auto;
            border-radius: 20px;
            text-align: center;
            overflow: hidden;
        }

        .orderInfo {
            display: flex;
            /* justify-content: space-between; */
            padding: 0 2%;
            height: 50px;
            align-items: center;
        }

        .orderInfo>* {
            width: 20%;
        }

        .txtACenter {
            text-align: center;
        }


        .orderD {
            cursor: pointer;
            color: #00F;
        }

        .orderdetail {
            /* height: 600px; */
            transition: 1s;
            background-color: #eee;
            /* padding: 10px; */
            display: none;
        }

        .orderProductFrame {
            width: 65%;
            padding: 10px;
            background-color: #cff;
        }

        .orderProductInfo {
            width: 35%;
            background-color: #cfc;
            /* height: 100%; */
            padding: 10px;
        }

        .orderProductInfo>div {
            margin: 20px 0;
        }

        .orderProduct {
            width: 100%;
            background-color: #fcf;
            margin: 1% auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
        }

        .productImg {
            width: 20%;
            line-height: 0;
        }

        .orderProduct h3 {
            font-size: 20px;
        }

        .opintxt {
            height: 100%;
            display: flex;
            flex-direction: column;
            line-height: 24px;
        }

        .opinfotxt {
            display: flex;
            flex-direction: column;
            line-height: 30px;
        }

        .orderPS {
            text-align: justify;
        }

        .orderTitleh2 {
            font-size: 28px;
            margin: 10px 0;
            font-weight: 700;

        }

        .storeControlOrderBTN {
            margin: 5px;
        }

        .orderNum {
            width: 10%;
        }
    </style>


</head>

<body>