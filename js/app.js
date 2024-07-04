// Arreglo para los objetos de cada servicio
const servicios = [
    {
        nombre: "Maquetación a la medida",
        descripcion: "Maquetación única y personalizada que se adapta específicamente a la marca.",
        servicio: "Maquetación",
        paquete: "advanced"
    },
    {
        nombre: "Maquetación con plantilla",
        descripcion: "Maquetación mediante la selección de plantillas predefinidas con la opción de añadir combinar o quitar componentes",
        servicio: "Maquetación",
        paquete: "growth"
    },
    {
        nombre: "Personalize emails using contact attributes",
        descripcion: "Inserción del nombre del destinatario en el asunto y/o de los datos básicos en el contenido",
        servicio: "personalize emails",
        paquete: "growth"
    },
    {
        nombre: "Personalized groups of contacts by segments",
        descripcion: "Envío de mensajes en base al comportamiento de los destinatarios.",
        servicio: "personalize emails",
        paquete: "advanced"
    },
    {
        nombre: "Mantenimiento de la base de datos",
        descripcion: "Depuración de: usuarios inactivos, rebotes suaves y duros, bajas",
        servicio: "contacts",
        paquete: "growth"
    },
    {
        nombre: "Envío de E-mails de marketing",
        descripcion: "E-mails de marketing masivos para campañas de promoción, venta, newsletter, etc.",
        servicio: "sending service",
        paquete: "growth"
    },
    {
        nombre: "Envío de E-mails transaccionales",
        descripcion: "Se activan después de que el usuario ejecuta alguna acción como, compra de un artículo, registro de un formulario, carrito abandonado, etc.",
        servicio: "sending service",
        paquete: "advanced"
    },
    {
        nombre: "Envío de E-mails de Automatización",
        descripcion: "Se activan de forma automática desde la plataforma, basados en el comportamiento de usuarios como, mensajes de bienvenida, e-mails de cumpleaños",
        servicio: "sending service",
        paquete: "advanced"
    }
];

// ARRAY METHODS

//FIND para filrar por tipo de paquetes
let tipoPaquete;

tipoPaquete = servicios.filter( propiedad => propiedad.paquete == 'growth');

// SPREAD OPERATOR para agregar nuevos productos al arreglo
const nuevoProducto = {nombre:"Reporte básico de métricas", descripcion:"Número de aperturas, clics, tasa de entregabilidad, número de bajas y número de rebotes ", servicio: "Reportes", paquete: "growth"};
const servicios2 = {nuevoProducto, ...servicios};
console.table(servicios2);

// Función para consultar los detalles del servicio
const consultarDetallesServicios = nombre => {
    for (let detallesServicios of servicios){
        if (detallesServicios.nombre === nombre){
            console.log(detallesServicios.descripcion)
        }
    }
}


console.table(tipoPaquete)
consultarDetallesServicios("Mantenimiento de la base de datos");