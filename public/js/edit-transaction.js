const selectVoucher = document.querySelector("#voucher_id");
const tableProductBody = document.querySelector("#table-products-tbody");
const idTransaction = {
    ...document.querySelector(".edit-transaction").dataset,
}["id"];

const getVouchers = async () => {
    let response = await fetch("/vouchers/get/all");
    let data = await response.json();
    vouchers = data;

    response = await fetch(`/voucher-usages/get/${idTransaction}`);
    data = (await response.json())[0]["vouchers_id"];
    console.log(data);

    selectVoucher.innerHTML = '<option value="0">Choose One</option>';

    vouchers.map((voucher) => {
        let { id, code, start_date, end_date, status } = voucher;
        start_date = start_date.split("-");
        end_date = end_date.split("-");

        start_date = new Date(
            parseInt(start_date[0]),
            parseInt(start_date[1]),
            parseInt(start_date[2])
        );
        end_date = new Date(
            parseInt(end_date[0]),
            parseInt(end_date[1]),
            parseInt(end_date[2])
        );

        let day = new Date().getDate();
        let month = new Date().getMonth();
        let year = new Date().getFullYear();

        let today = new Date(year, month + 1, day);

        if (today >= start_date && today <= end_date && status == "1") {
            selectVoucher.innerHTML += `
                <option value="${id}" ${
                id === data ? "selected" : ""
            }>${code}</option>
            `;
        }
    });
};

getVouchers();

const updateTotalPrice = () => {
    let percent = 100;
    let totalPrice = 0;
    let totalPurchasePrice = 0;

    const tr = [...tableProductBody.children];
    const subTotal = document.querySelector("#sub_total");
    const total = document.querySelector("#total");
    const purchaseTotal = document.querySelector("#total_purchase");

    tr.forEach((e) => {
        const prices = [...e.children[2].children];
        totalPrice += parseInt(prices[1].value);
        totalPurchasePrice += parseInt(prices[3].value);
    });

    const selectedVoucher = parseInt(
        [...selectVoucher.selectedOptions][0].value
    );
    if (selectedVoucher != 0) {
        const { disc_value } = vouchers.find(
            (voucher) => voucher.id === selectedVoucher
        );
        const discValue = parseInt(disc_value);

        if (discValue != 0) percent = discValue;
    }

    totalPrice = totalPrice * (percent / 100);
    totalPurchasePrice = totalPurchasePrice * (percent / 100);

    subTotal.value = totalPrice;
    total.value = totalPrice;
    purchaseTotal.value = totalPurchasePrice;
};

const updatePrice = (e) => {
    const qty = parseInt(e.value);
    const priceSatuan = parseInt(
        e.parentElement.parentElement.children[2].children[0].value
    );
    const priceTotal = e.parentElement.parentElement.children[2].children[1];
    const pricePurchaseSatuan = parseInt(
        e.parentElement.parentElement.children[2].children[2].value
    );
    const pricePurchaseTotal =
        e.parentElement.parentElement.children[2].children[3];

    priceTotal.value = qty * priceSatuan;
    pricePurchaseTotal.value = qty * pricePurchaseSatuan;

    updateTotalPrice();
};
