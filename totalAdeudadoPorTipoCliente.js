let invoices = [
  {
    customer: {
      name: "Coca Cola",
      type: "B2B"
    },
    paid: false,
    items: [
      { subtotal: 1234.44, description: 'asdfg' },
      { subtotal: 5678.88, description: 'qwerty' }
    ]
  },
  {
    customer: {
      name: "Juan Perez",
      type: "B2C"
    },
    paid: false,
    items: [
      { subtotal: 5556.54, description: 'asdfg' },
      { subtotal: 9632.21, description: 'qwerty' }
    ]
  },
  {
    customer: {
      name: "John Smith",
      type: "B2C"
    },
    paid: true,
    items: [
      { subtotal: 1234.44, description: 'asdfg' },
      { subtotal: 5678.88, description: 'qwerty' }
    ]
  },
  {
    customer: {
      name: "Esteban Quito",
      type: "B2C"
    },
    paid: false,
    items: [
      { subtotal: 895.7, description: 'asdfg' },
      { subtotal: 8542.34, description: 'qwerty' },
      { subtotal: 9674.95, description: 'qwerty' }
    ]
  }
];

let impagas= invoices.filter(invoices=>invoices.paid === false);

let DeudaPorTipoDeCliente = Object.entries(impagas.reduce((acc, impaga)=> {
  let type = impaga.customer.type;
  let subtotal = impaga.items.reduce((accSubtotal,item) => accSubtotal + item.subtotal,0);
  acc[type] = acc[type] ? (acc[type] + subtotal) : subtotal;
  return acc;
  },{})).map(([type, subtotal])=>({tipocliente:type,total:subtotal.toFixed(2)}));


console.log(DeudaPorTipoDeCliente);
