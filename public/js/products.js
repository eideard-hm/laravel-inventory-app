const price = document.querySelector('#price');
const quantity = document.querySelector('#quantity');
const totalElement = document.querySelector('#totalProduct');
const formElement = document.querySelector('#form-add_Product');
const addProductsElement = document.querySelector('#add');
const tableElement = document.getElementById('products-invoice');
const footerTableElement = document.getElementById('product-invoice-footer');

let nameProduct = document.getElementById('idInvoice').value;
let invoiceDetail = [];
/**
 * Función que sirve para cargar el precio de un producto al momento de seleccionarlo
 *
 * @param {Event} e Información del evento
 */
const loadPriceProduct = (e) => {
    const productId = e.target.value;
    const productSelected = products.filter(product => product.id == productId);
    price.value = productSelected[0].price;
    nameProduct = productSelected[0].name;
    totalProduct();
}

/**
 * Función que se encarga de sacar el total del producto automaticamente. Se ejecuta al momento
 * en que cambia el valor del del producto, cantidad o precio
 */
const totalProduct = () => {
    totalElement.value = price.value * quantity.value;
}

/**
 * Función que sirve para agregar productos a la factura
 */
const addProducts = () => {
    const formData = new FormData(formElement);
    //construir el arreglo que se va a pasar al arreglo
    let elementInserted = formData.get('product[]');
    let findElement = invoiceDetail.find(product => product.id == elementInserted);

    //si es diferente de vacio quiere decir que el producto ya existe dentro de la
    //la factura
    console.log(findElement)

    if (findElement !== undefined) {
        let quantity = parseFloat(findElement.quantity) + parseFloat(formData.get('quantity[]'));
        let products = {
            id: elementInserted,
            name: nameProduct,
            quantity,
            price: formData.get('price[]'),
            total: (quantity * parseFloat(formData.get('price[]')))
        }
        //vamos a insertar los valores dentro del arreglo
        let index = invoiceDetail.indexOf(findElement);
        if (index !== -1) {
            invoiceDetail.splice(index, 1, { ...products });
            Swal.fire("Modificación exitosa!", `La información del producto ${products.name} modificado exitosamente!`, "success");
        }
    } else {
        //se quiere insertar un nuevo elemento
        let products = {
            id: elementInserted,
            name: nameProduct,
            quantity: formData.get('quantity[]'),
            price: formData.get('price[]'),
            total: formData.get('totalProduct')
        }
        //construir el arreglo de objetos con los datos del producto
        invoiceDetail.push({ ...products });
        Swal.fire(
            'Producto',
            `El producto ${products.name} agregado exitosamente a la factura`,
            'success'
        )
    }
    formElement.reset();
    renderProductsInvoice();
}

const renderProductsInvoice = () => {
    localStorage.setItem('invoice', JSON.stringify(invoiceDetail));
    if (invoiceDetail.length > 0) {
        tableElement.innerHTML = '';
        invoiceDetail.forEach(product => {
            let tr = document.createElement('tr');
            tr.innerHTML += `
                            <td>${product['id']}</td>
                            <td>${product['name']}</td>
                            <td>${product['quantity']}</td>
                            <td>$ ${product['price']}</td>
                            <td>$ ${product['total']}</td>
                            `;
            let td = document.createElement('tr');
            td.classList.add('acciones')
            let btnDelete = document.createElement('button');
            let btnEdit = document.createElement('button');
            btnDelete.innerText = 'Eliminar'
            btnEdit.innerText = 'Editar'
            btnDelete.classList.add('btn', 'btn-danger', 'me-3', 'delete');
            btnEdit.classList.add('btn', 'btn-primary', 'edit');
            btnDelete.setAttribute('data-id', product['id'])
            btnEdit.setAttribute('data-id', product['id'])
            td.appendChild(btnDelete);
            td.appendChild(btnEdit);
            tr.appendChild(td);
            tableElement.appendChild(tr);
        })

        //calcular cantidad, total de los productos agregados a la factura
        let cantidad = invoiceDetail.reduce((total, product) => {
            return total += parseFloat(product.quantity);
        }, 0);

        let total = invoiceDetail.reduce((total, product) => {
            return total += parseFloat(product.total);
        }, 0)

        footerTableElement.innerHTML = `
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col">${cantidad}</th>
                                            <th scope="col"></th>
                                            <th scope="col">$ ${total}</th>
                                            <th scope="col"></th>
                                        </tr>
                                        `;
    } else {
        let tr = document.createElement('tr');
        tr.innerText = 'No se ha añadido ningun producto en la factura';
        tr.classList.add('text-center')
        tableElement.appendChild(tr);
    }
}

const eliminarElemento = (arr = [], item) => {
    console.log(arr)
    console.log(item)
    let i = arr.indexOf(item);
    console.log(i);

    if (i !== -1) {
        arr.splice(i, 1);
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Producto eliminado correctamente de la factura',
            showConfirmButton: false,
            timer: 1500
        })
        renderProductsInvoice();
    }
}

const removeProduct = (e) => {
    if (e.target.classList[3] === 'delete') {
        const productDelete = invoiceDetail.find(product => product.id == e.target.dataset.id);
        if (productDelete !== undefined) {
            Swal.fire({
                title: `Eliminar producto ${productDelete.name}`,
                text: `Esta seguro de eliminar el producto ${productDelete.name}`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarElemento(invoiceDetail, productDelete);
                }
            })
        }
    }
}

/**
 * Eventos
 */

document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('invoice')) {
        invoiceDetail = JSON.parse(localStorage.getItem('invoice'));
        renderProductsInvoice();
    }
    tableElement.addEventListener('click', removeProduct)
})

document.querySelector('#products').addEventListener('input', loadPriceProduct);
price.addEventListener('input', totalProduct);
quantity.addEventListener('input', totalProduct);

addProductsElement.addEventListener('click', addProducts)
