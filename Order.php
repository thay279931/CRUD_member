<?php require __DIR__ . './conect_db.php'; ?>

<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './body_nav.php'; ?>

<h2 class="txtACenter orderTitleh2">未確認訂單</h2>
<div id="orderUnCheck" class="orderAllFrame">
    <p>無未確認訂單</p>
</div>
<h2 class="txtACenter orderTitleh2">等待中訂單</h2>
<div id="orderChecked" class="orderAllFrame">
    <p>無等待中訂單</p>
</div>
<h2 class="txtACenter orderTitleh2">已完成訂單</h2>
<div id="orderComplete" class="orderAllFrame">
    <p>無已完成訂單</p>
</div>
<h2 class="txtACenter orderTitleh2">已取消訂單</h2>
<div id="orderCanceled" class="orderAllFrame">
    <p>無已取消訂單</p>
</div>

<script>
    //未接單
    let unCheckOrderFrame = document.querySelector("#orderUnCheck")
    //已接單未完成
    let checkedOrderFrame = document.querySelector("#orderChecked")
    //已完成訂單
    let completeOrderFrame = document.querySelector("#orderComplete")
    //已取消訂單
    let canceledOrderFrame = document.querySelector("#orderCanceled")


    fetch("getOrderPage.php").then(r => r.json()).then(res => {
        console.log(res);
        if (res.code == 1) {
            alert(res.error);
            location.href = "login.php";
        }
        //未接單袋
        let docFragForUnCheck = document.createDocumentFragment();
        //已接單未完成袋
        let docFragForChecked = document.createDocumentFragment();
        //已完成袋
        let docFragForCompleted = document.createDocumentFragment();
        //已取消袋
        let docFragForCanceled = document.createDocumentFragment();

        //-1不動  正數互換 0 不動
        //order_time     recept_time    complete_time
        res.reverse().sort((a, b) => {
            let A = new Date(a.recept_time)
            let B = new Date(b.recept_time)

            if (b.recept_time == null) {
                return 1;
            } else {
                return   B- A;
            }
        })

        res.sort((a, b) => {
            let A = new Date(a.recept_time)
            let B = new Date(b.recept_time)
            let C = new Date(a.complete_time)
            let D = new Date(b.complete_time)

            if (b.complete_time == null) {
                return B - A;
            } else {
                return D - C;
            }
        })



        // console.log(b.complete_time)
        // console.log(a.complete_time)
        // let A = new Date(a.complete_time)
        // let B =  new Date(b.complete_time)
        // console.log(A)
        // console.log(B)
        // console.log(A-B)
        // console.log(B-A)

        console.log(res)

        res.forEach(element => {
            let {
                SID,
                complete_time,
                coupon_sid,
                memo,
                order_finish,
                order_time,
                order_total,
                recept_time,
                review,
                sale,
                shop_order_status,
                name,
                cartList
            } = element;

            //訂單最外框
            let orderframe = document.createElement("div");
            orderframe.classList.add("orderframe");
            //上半
            let orderInfo = document.createElement("div");
            orderInfo.classList.add("orderInfo");
            if (shop_order_status == 0 && order_finish == 0) {
                orderInfo.style.backgroundColor = "#CC0";
            } else if (shop_order_status == 1 && order_finish == 0) {
                orderInfo.style.backgroundColor = "#F05";
            } else if (shop_order_status == 1 && order_finish == 1) {
                orderInfo.style.backgroundColor = "#0C5";
            }




            //下訂時間
            let orderdate = document.createElement("div");
            orderdate.classList.add("orderdate");
            let orderdateh4 = document.createElement("h4");
            let orderdateh4Intxt;
            let orderdatepIntxt;
            if (shop_order_status == 0 && order_finish == 0) {
                orderdateh4Intxt = document.createTextNode("下訂時間");
                orderdatepIntxt = document.createTextNode(order_time);
            } else if (shop_order_status == 1 && order_finish == 0) {
                orderdateh4Intxt = document.createTextNode("接單時間");
                orderdatepIntxt = document.createTextNode(recept_time);
            } else if (shop_order_status == 1 && order_finish == 1) {
                orderdateh4Intxt = document.createTextNode("完成時間");
                orderdatepIntxt = document.createTextNode(complete_time);
            } else if (shop_order_status == 0 && order_finish == 1) {
                orderdateh4Intxt = document.createTextNode("取消時間");
                orderdatepIntxt = document.createTextNode(complete_time);
            }
            orderdateh4.appendChild(orderdateh4Intxt);
            let orderdatep = document.createElement("p");
            orderdatep.appendChild(orderdatepIntxt);
            orderdate.appendChild(orderdateh4);
            orderdate.appendChild(orderdatep);
            orderInfo.appendChild(orderdate);
            //合計金額
            let totalPrice = document.createElement("div");
            totalPrice.classList.add("totalPrice");
            let totalPriceh4 = document.createElement("h4");
            let totalPriceh4Intxt = document.createTextNode("合計金額");
            totalPriceh4.appendChild(totalPriceh4Intxt);
            let totalPricep = document.createElement("p");
            let totalPricepIntxt = document.createTextNode(sale);
            totalPricep.appendChild(totalPricepIntxt);
            totalPrice.appendChild(totalPriceh4);
            totalPrice.appendChild(totalPricep);
            orderInfo.appendChild(totalPrice);
            //店名
            let shopName = document.createElement("p");
            shopName.classList.add("shopName");
            let shopNameIntxt = document.createTextNode(name);
            shopName.appendChild(shopNameIntxt);
            orderInfo.appendChild(shopName);
            //評價
            let reviewPoint = document.createElement("p");
            let reviewPointIntxt = document.createTextNode(review);
            reviewPoint.appendChild(reviewPointIntxt);
            orderInfo.appendChild(reviewPoint);
            //訂單詳細
            let kuwasii = document.createElement("p");
            kuwasii.classList.add("orderD");
            let kuwasiiIntxt = document.createTextNode("訂單詳細");
            kuwasii.appendChild(kuwasiiIntxt);
            orderInfo.appendChild(kuwasii); {
                let status = 0;
                kuwasii.addEventListener("click", (evt) => {
                    let downSide = evt.target.parentNode.nextSibling;
                    if (status == 0) {
                        downSide.style.display = "flex";
                        status = 1;
                    } else {
                        downSide.style.display = "none";
                        status = 0;
                    }
                })
            }


            //上半放入大框
            orderframe.appendChild(orderInfo);
            //下半
            let orderdetail = document.createElement("div");
            orderdetail.classList.add("orderdetail");
            //下半左半
            let orderProductFrame = document.createElement("div");
            orderProductFrame.classList.add("orderProductFrame");
            //資料袋
            let docFragForOrderProduct = document.createDocumentFragment();
            //商品詳細資料
            cartList.forEach(element => {
                let {
                    amount,
                    product_name,
                    src,
                    product_price,
                    product_sid
                } = element;
                //商品總框
                let orderProduct = document.createElement("div");
                orderProduct.classList.add("orderProduct");
                //商品圖框
                let productImg = document.createElement("div");
                productImg.classList.add("productImg");
                //商品圖
                let pic = document.createElement("img");
                pic.setAttribute("src", `${src}.jpg`);
                productImg.appendChild(pic);
                orderProduct.appendChild(productImg);
                //產品名
                let productName = document.createElement("h3");
                let productNameIntxt = document.createTextNode(product_name);
                productName.appendChild(productNameIntxt);
                orderProduct.appendChild(productName);
                //單價
                let orderPPrice = document.createElement("div");
                orderPPrice.classList.add("orderPPrice");
                orderPPrice.classList.add("orderNum");
                //單價內容
                //標題
                let orderPPricep1 = document.createElement("p");
                let orderPPricep1txt = document.createTextNode("價格");                
                orderPPricep1.appendChild(orderPPricep1txt);
                //內文
                let orderPPricep2 = document.createElement("p");
                let orderPPricep2txt = document.createTextNode(product_price);
                orderPPricep2.appendChild(orderPPricep2txt);
                orderPPrice.appendChild(orderPPricep1);
                orderPPrice.appendChild(orderPPricep2);
                orderProduct.appendChild(orderPPrice);
                //數量
                let orderPAmount = document.createElement("div");
                orderPAmount.classList.add("orderPAmount");
                orderPAmount.classList.add("orderNum");
                //數量內容
                //標題
                let orderPAmountp1 = document.createElement("p");
                let orderPAmountp1txt = document.createTextNode("數量");
                orderPAmountp1.appendChild(orderPAmountp1txt);
                //內文
                let orderPAmountp2 = document.createElement("p")
                let orderPAmountp2txt = document.createTextNode(amount);
                orderPAmountp2.appendChild(orderPAmountp2txt);
                orderPAmount.appendChild(orderPAmountp1);
                orderPAmount.appendChild(orderPAmountp2);
                orderProduct.appendChild(orderPAmount);
                //總價
                let orderPTotalprice = document.createElement("div");
                orderPTotalprice.classList.add("orderPTotalprice");
                orderPTotalprice.classList.add("orderNum");
                //總價內容
                //標題
                let orderPTotalpricep1 = document.createElement("p");
                let orderPTotalpricep1txt = document.createTextNode("總價");
                orderPTotalpricep1.appendChild(orderPTotalpricep1txt);
                //內文
                let orderPTotalpricep2 = document.createElement("p");
                let orderPTotalpricep2txt = document.createTextNode(amount * product_price);
                orderPTotalpricep2.appendChild(orderPTotalpricep2txt);
                orderPTotalprice.appendChild(orderPTotalpricep1);
                orderPTotalprice.appendChild(orderPTotalpricep2);
                orderProduct.appendChild(orderPTotalprice);
                docFragForOrderProduct.appendChild(orderProduct);
            });
            //商品明細放入
            orderProductFrame.appendChild(docFragForOrderProduct);
            //下左半放入下半
            orderdetail.appendChild(orderProductFrame);
            //右半外框
            let orderProductInfo = document.createElement("div");
            orderProductInfo.classList.add("orderProductInfo");
            //下訂時間
            let infoChild01 = document.createElement("div");
            infoChild01.classList.add("opinfotxt");
            let IC01p1 = document.createElement("p");
            let IC01p1Txt = document.createTextNode("下訂時間");
            IC01p1.appendChild(IC01p1Txt);
            let IC01p2 = document.createElement("p");
            let IC01p2Txt = document.createTextNode(order_time);
            IC01p2.appendChild(IC01p2Txt);
            infoChild01.appendChild(IC01p1);
            infoChild01.appendChild(IC01p2);
            orderProductInfo.appendChild(infoChild01);
            //接單時間
            if (shop_order_status == 1) {
                let infoChild02 = document.createElement("div");
                infoChild02.classList.add("opinfotxt");
                let IC02p1 = document.createElement("p");
                let IC02p1Txt = document.createTextNode("接單時間");
                IC02p1.appendChild(IC02p1Txt);
                let IC02p2 = document.createElement("p");
                let IC02p2Txt = document.createTextNode(recept_time);
                IC02p2.appendChild(IC02p2Txt);
                infoChild02.appendChild(IC02p1);
                infoChild02.appendChild(IC02p2);
                orderProductInfo.appendChild(infoChild02);
            }
            //完成時間
            if (order_finish == 1) {
                let infoChild03 = document.createElement("div");
                infoChild03.classList.add("opinfotxt");
                let IC03p1 = document.createElement("p");
                let IC03p1Tx
                if (shop_order_status == 0) {
                    IC03p1Txt = document.createTextNode("取消時間");
                } else if (shop_order_status == 1) {
                    IC03p1Txt = document.createTextNode("完成時間");
                }
                IC03p1.appendChild(IC03p1Txt);
                let IC03p2 = document.createElement("p");
                let IC03p2Txt = document.createTextNode(complete_time);
                IC03p2.appendChild(IC03p2Txt);
                infoChild03.appendChild(IC03p1);
                infoChild03.appendChild(IC03p2);
                orderProductInfo.appendChild(infoChild03);
            }
            //使用優惠
            let infoChild04 = document.createElement("div");
            infoChild04.classList.add("opinfotxt");
            let IC04p1 = document.createElement("p");
            let IC04p1Txt = document.createTextNode("使用優惠");
            IC04p1.appendChild(IC04p1Txt);
            let IC04p2 = document.createElement("p");
            let IC04p2Txt = document.createTextNode("使用的優惠");
            IC04p2.appendChild(IC04p2Txt);
            infoChild04.appendChild(IC04p1);
            infoChild04.appendChild(IC04p2);
            orderProductInfo.appendChild(infoChild04);
            //備註
            let infoChild05 = document.createElement("div");
            infoChild05.classList.add("opinfotxt");
            let IC05p1 = document.createElement("p");
            let IC05p1Txt = document.createTextNode("備註");
            IC05p1.appendChild(IC05p1Txt);
            let IC05p2 = document.createElement("p");
            IC05p2.classList.add("orderPS")
            let IC05p2Txt = document.createTextNode(memo);
            IC05p2.appendChild(IC05p2Txt);
            infoChild05.appendChild(IC05p1);
            infoChild05.appendChild(IC05p2);
            orderProductInfo.appendChild(infoChild05);

            if (shop_order_status == 0 && order_finish == 0) {
                //取消
                let orderToCancel = document.createElement("button");
                orderToCancel.classList.add("storeControlOrderBTN");
                let orderToCancelTxt = document.createTextNode("取消訂單");
                orderToCancel.appendChild(orderToCancelTxt);
                orderProductInfo.appendChild(orderToCancel);
                orderToCancel.addEventListener("click", () => {
                    if (confirm("是否確定取消訂單?")) {
                        let FD = new FormData()
                        FD.append("order_sid", SID);
                        FD.append("confirm", 0);
                        FD.append("whoCanceled", 0);
                        fetch("Store_ConfirmOrder.php", {
                            method: 'POST',
                            body: FD,
                        }).then().then(res => {
                            alert("取消成功")
                            location.reload();
                        })
                    } else return;
                })

            }
















            //下右半放入下半
            orderdetail.appendChild(orderProductInfo);
            //下半放入大框
            orderframe.appendChild(orderdetail);
            //           shop_order_status	   order_finish
            //             店家接單狀態	         訂單完成狀態
            // 未接單           0                   0
            // unCheckOrderFrame|||||||||||||docFragForUnCheck
            // 已接單未完成      1                  0
            // checkedOrderFrame|||||||||||||docFragForChecked
            // 已完成訂單       1                   1
            // completeOrderFrame|||||||||||||docFragForCompleted
            // 已取消訂單       0                   1
            // canceledOrderFrame|||||||||||||docFragForCanceled
            //      框                              袋


            //大框放入資料袋  篩選
            if (shop_order_status == 0 && order_finish == 0) {
                docFragForUnCheck.appendChild(orderframe)
            }
            if (shop_order_status == 1 && order_finish == 0) {
                docFragForChecked.appendChild(orderframe)
            }
            if (shop_order_status == 1 && order_finish == 1) {
                docFragForCompleted.appendChild(orderframe)
            }
            if (shop_order_status == 0 && order_finish == 1) {
                docFragForCanceled.appendChild(orderframe)
            }
        });
        //資料袋放入顯示框
        if (docFragForUnCheck.hasChildNodes()) {
            while (unCheckOrderFrame.hasChildNodes()) {
                unCheckOrderFrame.removeChild(unCheckOrderFrame.lastChild);
            }
            unCheckOrderFrame.appendChild(docFragForUnCheck);
        }

        if (docFragForChecked.hasChildNodes()) {
            while (checkedOrderFrame.hasChildNodes()) {
                checkedOrderFrame.removeChild(checkedOrderFrame.lastChild);
            }
            checkedOrderFrame.appendChild(docFragForChecked);
        }

        if (docFragForCompleted.hasChildNodes()) {
            while (completeOrderFrame.hasChildNodes()) {
                completeOrderFrame.removeChild(completeOrderFrame.lastChild);
            }
            completeOrderFrame.appendChild(docFragForCompleted);
        }

        if (docFragForCanceled.hasChildNodes()) {
            while (canceledOrderFrame.hasChildNodes()) {
                canceledOrderFrame.removeChild(canceledOrderFrame.lastChild);
            }
            canceledOrderFrame.appendChild(docFragForCanceled);
        }
    })
</script>