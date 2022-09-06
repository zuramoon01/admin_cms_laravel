const selectProduct = document.querySelector("#products_id_select");
const tableProductBody = document.querySelector("#table-products-tbody");

let products = [];

const getProducts = async () => {
    const response = await fetch("/products/get/all");
    const data = await response.json();
    products = data;

    updateSelectProduct();
};

getProducts();

const updateSelectProduct = () => {
    selectProduct.innerHTML = '<option value="" selected>Choose One</option>';

    products.map((product) => {
        const { id, name, status } = product;

        if (status == 1) {
            selectProduct.innerHTML += `
                <option value="${id}" selected>${name}</option>
            `;
        }
    });
};

const addProduct = () => {
    const product = [...selectProduct.selectedOptions][0];
    const qty = parseInt(document.querySelector("#add-product-qty").value);

    if (!qty || product.value === "") {
        return;
    }

    let newProduct = products.find(
        (item) => item.id == parseInt(product.value)
    );

    product.remove();

    products = products.filter((item) => item.id !== newProduct.id);

    if (newProduct) {
        const { id, name, price, purchase_price } = newProduct;

        tableProductBody.innerHTML += `
            <tr>
                <td>
                    <input type="hidden" class="form-control" id="product_id" name="product_id[]" value="${id}">
                    <input type="text" class="form-control" id="product_name" name="product_name[]" value="${name}" readonly>
                </td>
                <td>
                    <input type="number" class="form-control" id="qty" name="qty[]" min="0" max="5" onchange="updatePrice(this)" onkeydown="updatePrice(this)" value="${qty}">
                </td>
                <td>
                    <input type="hidden" class="form-control" id="price_satuan" name="price_satuan[]" value="${price}">
                    <input type="hidden" class="form-control" id="price_total" name="price_total[]" value="${
                        price * qty
                    }">
                    <input type="hidden" class="form-control" id="price_purchase_satuan" name="price_purchase_satuan[]" value="${purchase_price}">
                    <input type="text" class="form-control" id="price_purchase_total" name="price_purchase_total[]" value="${
                        purchase_price * qty
                    }" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger mb-3" onclick="removeProduct(this)"><i class="fas fa-trash"></i> Remove</button>
                </td>
            </tr>
        `;

        updateTotalPrice();
    }
};

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

    subTotal.value = `${totalPrice}`;
    total.value = `${totalPrice}`;
    purchaseTotal.value = `${totalPurchasePrice}`;
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

removeProduct = async (e) => {
    e.parentElement.parentElement.remove();

    const id = e.parentElement.parentElement.children[0].children[0].value;

    const response = await fetch(`/products/get/${id}`);
    const data = await response.json();

    products = [...products, data];

    updateSelectProduct();
    updateTotalPrice();
};
