<?php require __DIR__ . './conect_db.php'; ?>


<?php require __DIR__ . './head_css.php'; ?>

<?php require __DIR__ . './body_nav.php'; ?>



<h3 id="storeNameCart"></h3>

<div class="cartListFrame" id="CLF">
</div>

<div id="sum">
    <button id="cartClearAll">清空購物車</button>
    <p>總金額</p>
    <p id="priceSum">0</p>
    <button id="cartToPay">結帳</button>
</div>



<script>
    let CartFrame = document.querySelector("#CLF")

    let pSum = document.querySelector("#priceSum")

    let storeName = document.querySelector("#storeNameCart");

    fetch("GetCartPage.php")
        .then(r => r.json())
        .then(res => {
            let docFrag = document.createDocumentFragment();
            res.forEach((value, index, array) => {


                while (CartFrame.hasChildNodes()) {
                    CartFrame.removeChild(CartFrame.lastChild);
                }
                let {
                    sid,
                    amount,
                    price,
                    product_name,
                    src,
                    name
                } = value;
                storeName.innerText = name;
                //大框
                let cardrow = document.createElement("div");
                cardrow.classList.add("cardrow");
                //圖片
                let cardimg = document.createElement("div");
                cardimg.classList.add("productimg");
                if (src) {
                    let pic = document.createElement("img");
                    pic.setAttribute("src", `${src}.jpg`);
                    cardimg.appendChild(pic);
                }

                //圖片放入大框

                cardrow.appendChild(cardimg)
                //品名
                let txtbox = document.createElement("div");
                txtbox.classList.add("productName");
                let pName = document.createTextNode(product_name);
                //品名放入大框
                txtbox.appendChild(pName);
                cardrow.appendChild(txtbox);
                //單價
                let priceBox = document.createElement("p");
                priceBox.classList.add("price");
                let priceName = document.createTextNode(price);
                //單價放入大框
                priceBox.appendChild(priceName);
                cardrow.appendChild(priceBox);

                //控制面板
                let ctrlPlate = document.createElement("div");
                ctrlPlate.classList.add("controlPlate");
                //表單
                let ctrlForm = document.createElement("form");
                ctrlForm.classList.add("cartForm");
                //隱藏SID輸入
                let sidFrame = document.createElement("input");
                sidFrame.setAttribute("type", "hidden");
                sidFrame.setAttribute("value", sid);
                sidFrame.setAttribute("name", "sid");
                ctrlForm.appendChild(sidFrame);
                //加按鈕
                let plusBTN = document.createElement("button");
                let plusName = document.createTextNode("加");
                plusBTN.appendChild(plusName);
                ctrlForm.appendChild(plusBTN);

                plusBTN.addEventListener("click", (evt) => {
                    evt.preventDefault();
                    cartset(evt);
                })

                //數量
                let amountDisplay = document.createElement("p");
                amountDisplay.classList.add("num");
                let amountName = document.createTextNode(amount);
                amountDisplay.appendChild(amountName);
                ctrlForm.appendChild(amountDisplay);
                //減按鈕
                let minusBTN = document.createElement("button");
                let minusName = document.createTextNode("減");
                minusBTN.appendChild(minusName);
                ctrlForm.appendChild(minusBTN);

                minusBTN.addEventListener("click", (evt) => {
                    evt.preventDefault();

                    if (evt.target.previousSibling.innerText == 1) {
                        if (!window.confirm("是否要刪除?")) {
                            return
                        }
                    }
                    cartCut(evt);

                })

                //刪除按鈕
                let delBTN = document.createElement("button");
                let delName = document.createTextNode("全部刪除");
                delBTN.classList.add("disb")
                delBTN.appendChild(delName);
                ctrlForm.appendChild(delBTN);

                delBTN.addEventListener("click", (evt) => {
                    evt.preventDefault();
                    if (!window.confirm("是否要刪除?")) {
                        return
                    }
                    cartClear(evt)
                })

                //表單放入大框
                ctrlPlate.appendChild(ctrlForm);
                cardrow.appendChild(ctrlPlate);
                //總金額
                let totalPrice = document.createElement("div");
                totalPrice.classList.add("totalprice");
                let TPName = document.createTextNode(price * amount);
                totalPrice.appendChild(TPName);
                cardrow.appendChild(totalPrice);
                docFrag.appendChild(cardrow);
            })
            CartFrame.appendChild(docFrag);

            let tSum = 0;
            for (let i = 0; i < CartFrame.childNodes.length; i++) {
                let plusP = CartFrame.childNodes[i].lastChild.innerText;
                tSum += Number(plusP);
            }
            pSum.innerText = tSum;

        })
    let cartCountBox = document.querySelector("#cartcount")


    //增加
    async function cartset(evt) {

        let FM = evt.target.parentNode

        const FD = new FormData(FM);
        // console.log("+1")
        fetch('cart.php', {
                method: 'POST',
                body: FD
            })
            .then(r => r.json())
            .then(
                res => {
                    cartCountBox.innerText = res;
                    let numnow = Number(evt.target.nextSibling.innerText)
                    evt.target.nextSibling.innerText = numnow + 1;

                    let sum = evt.target.parentNode.parentNode.nextSibling.innerText;
                    let price = evt.target.parentNode.parentNode.previousSibling.innerText;

                    evt.target.parentNode.parentNode.nextSibling.innerText = price * (numnow + 1);

                    let tSum = 0;
                    for (let i = 0; i < CartFrame.childNodes.length; i++) {
                        let plusP = CartFrame.childNodes[i].lastChild.innerText;
                        tSum += Number(plusP);
                    }
                    pSum.innerText = tSum;
                }
            )
    }
    //減少
    async function cartCut(evt) {

        let FM = evt.target.parentNode

        const FD = new FormData(FM);
        // console.log("-1")
        fetch('cartminus.php', {
                method: 'POST',
                body: FD
            })
            .then(r => r.json())
            .then(
                res => {
                    cartCountBox.innerText = res;
                    let numnow = Number(evt.target.previousSibling.innerText);
                    evt.target.previousSibling.innerText = numnow - 1;

                    let sum = evt.target.parentNode.parentNode.nextSibling.innerText;
                    let price = evt.target.parentNode.parentNode.previousSibling.innerText;

                    evt.target.parentNode.parentNode.nextSibling.innerText = price * (numnow - 1);

                    let tSum = 0;
                    for (let i = 0; i < CartFrame.childNodes.length; i++) {
                        let plusP = CartFrame.childNodes[i].lastChild.innerText;
                        tSum += Number(plusP);
                    }
                    pSum.innerText = tSum;
                    if (numnow == 1) {
                        CartFrame.removeChild(evt.target.parentNode.parentNode.parentNode);
                    }
                    if (!CartFrame.hasChildNodes()) {
                        alert("購物車已無商品，回到商品頁");
                        location.href = "index.php";
                    }

                }
            )
    }
    //清空
    async function cartClear(evt) {
        let FM = evt.target.parentNode
        const FD = new FormData(FM);
        fetch('cartclear.php', {
                method: 'POST',
                body: FD
            })
            .then(r => r.json())
            .then(
                res => {

                    cartCountBox.innerText = res;

                    let numnow = Number(evt.target.previousSibling.innerText);
                    evt.target.previousSibling.previousSibling.innerText = 0;

                    let sum = evt.target.parentNode.parentNode.nextSibling.innerText;
                    let price = evt.target.parentNode.parentNode.previousSibling.innerText;

                    evt.target.parentNode.parentNode.nextSibling.innerText = 0;

                    CartFrame.removeChild(evt.target.parentNode.parentNode.parentNode);

                    let tSum = 0;
                    for (let i = 0; i < CartFrame.childNodes.length; i++) {
                        let plusP = CartFrame.childNodes[i].lastChild.innerText;
                        tSum += Number(plusP);
                    }
                    pSum.innerText = tSum;
                    if (!CartFrame.hasChildNodes()) {
                        alert("購物車已無商品，回到商品頁");
                        location.href = "index.php";
                    }


                }
            )
    }

    let clearAllCart = document.querySelector("#cartClearAll")

    clearAllCart.addEventListener("click", (evt) => {
        evt.preventDefault();
        if (!window.confirm("是否要清除購物車?")) {
            evt.preventDefault();
            return;
        }
        clearCart();
    })

    function clearCart() {
        fetch("clearCartAll.php")
        location.href = "index.php";
    }

    let payBTN = document.querySelector("#cartToPay");

    payBTN.addEventListener("click", (evt) => {
        evt.preventDefault();
        if (!window.confirm("是否要結帳?")) {
            evt.preventDefault();
            return;
        }
        cartPay();
    })

    function cartPay() {
        let totalPrize = pSum.innerText;
        let FD = new FormData();
        FD.append("price",totalPrize);
        fetch("fromCartToPay.php",{

            method: 'POST',
            body: FD, 


        }).then(r => r.json()).then(
            (res) => {
                //沒登入
                if (res.code === 1) {

                    alert(res.error);
                    location.href = "login.php";
                }
                

                location.href = "Order.php";

            })
        // location.href = "index.php";

    }
</script>








</body>

</html>