const selectProduct = document.querySelector("#products_id_select");
const tableProductBody = document.querySelector("#table-products-tbody");
const idTransaction = {
    ...document.querySelector(".edit-transaction").dataset,
}["id"];

let products = [];

const getProducts = async () => {
    let response = await fetch("/products/get/all");
    let data = await response.json();
    products = data;

    response = await fetch(`/transactions/get/${idTransaction}`);
    data = await response.json();

    data.map((product) => {
        const { products_id } = product;

        products = products.filter((item) => item.id !== products_id);
    });

    selectProduct.innerHTML = '<option value="" selected>Choose One</option>';

    products.map((product) => {
        const { id, name, price, purchase_price, status } = product;

        if (status == 1) {
            selectProduct.innerHTML += `
                <option value="${id}" selected>${name}</option>
            `;
        }
    });
};

getProducts();

const updateTotalPrice = () => {
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
