cart.forEach(item => {
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${item.name}</td>
        <td>1</td> <!-- Jumlah selalu diatur menjadi 1 -->
        <td>${item.price}</td>
        <td>${item.price}</td>
    `;
    receiptBody.appendChild(row);
    totalPrice += item.price;
});
