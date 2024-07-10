document.addEventListener('DOMContentLoaded', function() {
    // Elemento donde mostraremos el total
    const totalElemento = document.getElementById('total');
    // Elemento para mostrar la lista de productos seleccionados
    const listaProductos = document.querySelector('.lista-productos');

    // Obtener todos los botones de seleccionar
    const botonesSeleccionar = document.querySelectorAll('.receta_boton');

    // Inicializar el total y la lista de productos seleccionados
    let total = 0;
    const productosSeleccionados = new Map(); // Usaremos un Map para almacenar productos y cantidades

    // Función para manejar clic en botones de seleccionar
    botonesSeleccionar.forEach(boton => {
        boton.addEventListener('click', function() {
            const receta = this.closest('.receta');
            const nombre = receta.querySelector('.receta__nombre').textContent;
            const precio = obtenerPrecio(nombre); // Obtener el precio según el nombre (simulado)
            const cantidad = parseInt(receta.querySelector('.receta_cantidad').value);

            if (cantidad <= 0) {
                alert('Selecciona al menos una unidad del producto.');
                return;
            }

            const subtotal = precio * cantidad;

            if (this.classList.contains('seleccionado')) {
                this.classList.remove('seleccionado');
                total -= subtotal;
                productosSeleccionados.delete(nombre); // Eliminar producto del mapa
            } else {
                this.classList.add('seleccionado');
                total += subtotal;
                productosSeleccionados.set(nombre, cantidad); // Agregar producto al mapa con su cantidad
            }

            // Actualizar el texto del total
            totalElemento.textContent = `Total de productos: $${total.toFixed(2)}`;

            // Actualizar la lista de productos seleccionados
            actualizarListaProductos();
        });
    });

    // Función simulada para obtener el precio del producto
    function obtenerPrecio(nombre) {
        // Implementa la lógica para obtener el precio del producto seleccionado
        // Por ahora, usaremos precios simulados para los productos
        switch (nombre) {
            case 'Empanadas Caseras':
                return 10.00;
            case 'Lechona':
                return 15.00;
            case 'Pollo al Curry':
                return 12.00;
            case 'Cup Cakes de Vainilla':
                return 8.00;
            case 'Postre de Café':
                return 6.00;
            case 'Guarnición de Zanahoria':
                return 5.00;
            default:
                return 0.00;
        }
    }

    // Función para actualizar la lista de productos seleccionados
    function actualizarListaProductos() {
        // Limpiar la lista actual
        listaProductos.innerHTML = '';

        // Iterar sobre el Map de productos seleccionados y agregar cada uno como un nuevo elemento de lista
        productosSeleccionados.forEach((cantidad, producto) => {
            const itemLista = document.createElement('li');
            itemLista.textContent = `${producto} x ${cantidad}`;

            // Botón para eliminar el producto seleccionado
            const btnEliminar = document.createElement('button');
            btnEliminar.textContent = 'Eliminar';
            btnEliminar.addEventListener('click', function() {
                // Obtener el precio del producto a eliminar
                const precioProducto = obtenerPrecio(producto);

                // Actualizar el total y la lista de productos seleccionados
                total -= precioProducto * cantidad;
                totalElemento.textContent = `Total de productos: $${total.toFixed(2)}`;
                productosSeleccionados.delete(producto);
                actualizarListaProductos();
            });

            itemLista.appendChild(btnEliminar);
            listaProductos.appendChild(itemLista);
        });
    }

    // Mostrar la lista de productos inicialmente
    actualizarListaProductos();
});